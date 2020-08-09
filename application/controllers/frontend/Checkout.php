<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load form library & helper
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        // Load cart library
        $this->load->library('cart');
        
        // Load product model
        $this->load->model('product');
        
        $this->controller = 'checkout';
        $this->user_id=$this->session->userdata(FRONTEND_SESS_CODE.'log_id');
        $this->load->model('Frontend_model','f');
    }
    
    function index(){
        if(empty($this->user_id)){
            redirect(base_url('login'));
         }

        // Redirect if the cart is empty
        // if($this->cart->total_items() <= 0){
        //     redirect('/');
        // }
        if(!empty($this->user_id)){
        $prodCount=$this->f->Record_count("*","va_cart_tbl",null,['user_id'=>$this->user_id,'cart_status'=>0]);
        if($prodCount==0){
         redirect(base_url());
         } }  
        
        $custData = $data = array();
        
        // If order request is submitted
        $submit = $this->input->post('placeOrder');
        if(isset($submit)){
            // Form field validation rules
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            
            // Prepare customer data
            $custData = array(
                'name'     => strip_tags($this->input->post('name')),
                'email'     => strip_tags($this->input->post('email')),
                'phone'     => strip_tags($this->input->post('phone')),
                'address'=> strip_tags($this->input->post('address'))
            );
            
            // Validate submitted form data
            if($this->form_validation->run() == true){
                // Insert customer data
                $insert = $this->product->insertCustomer($custData);
                
                // Check customer data insert status
                if($insert){
                    // Insert order
                    $order = $this->placeOrder($insert);
                    
                    // If the order submission is successful
                    if($order){
                        $this->session->set_userdata('success_msg', 'Order placed successfully.');
                        redirect($this->controller.'/orderSuccess/'.$order);
                    }else{
                        $data['error_msg'] = 'Order submission failed, please try again.';
                    }
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        
        // Customer data
        $data['custData'] = $custData;
        
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
        
        // Pass products data to the view
        $this->load->view('frontend/'.$this->controller.'/index', $data);
    }
    
    function placeOrder($custID){
        $sub=$this->f->SelectSum('subtotal','va_cart_tbl',['user_id'=>$this->user_id,'cart_status'=>0]);
        // Insert order data
        $ordData = array(
            'customer_id' => $custID,
            'grand_total' => $sub->subtotal,
            'user_id'=>$this->user_id    
        );
        $insertOrder = $this->product->insertOrder($ordData);
        
        if($insertOrder){
            // Retrieve cart data from the session
            $cartItems =  $this->f->InnerJoinResultsearch("*",'va_product_tbl p','va_cart_tbl c','inner','c.product_id=p.id',['user_id'=>$this->user_id,'cart_status'=>0],'rowid','DESC',null,null,null,null);
            
            // Cart items
            $ordItemData = array();
            $i=0;
            foreach($cartItems as $item){
                $ordItemData[$i]['order_id']     = $insertOrder;
                $ordItemData[$i]['product_id']     = $item['id'];
                $ordItemData[$i]['quantity']     = $item['qty'];
                $ordItemData[$i]['sub_total']     = $item["subtotal"];
                $ordItemData[$i]['user_id']     = $this->user_id;
                $ordItemData[$i]['created_on']     = DATE;
                $i++;
            }
            
            if(!empty($ordItemData)){
                // Insert order items
                $insertOrderItems = $this->product->insertOrderItems($ordItemData);
                
                if($insertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();
                    
                    // Return order ID
                    return $insertOrder;
                }
            }
        }
        return false;
    }
    
    function orderSuccess(){

        $cartContent=$this->f->InnerJoinResultsearch("*",'va_product_tbl p','va_cart_tbl c','inner','c.product_id=p.id',['user_id'=>$this->user_id,'cart_status'=>0],'rowid','DESC',null,null,null,null);

        if(!empty($cartContent)  && !empty($this->user_id)){

            foreach($cartContent as $items){

                $update=array('cart_status'=>1);
                $this->f->ArrayUpdate($update,"va_cart_tbl",['user_id'=>$this->user_id],"rowid",null);
               

            }
        }
        $ordID=$this->uri->segment(3);
        // Fetch order data from the database
        $data['order'] = $this->product->getOrder($ordID);
        
        // Load order details view
        $this->load->view('frontend/'.$this->controller.'/order-success', $data);
    }
    
}