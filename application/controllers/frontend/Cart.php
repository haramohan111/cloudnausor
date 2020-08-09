<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        
        // Load product model
        $this->load->model('product');

         $this->load->model('Frontend_model','f');
    }
    
    function index(){
          $this->session->set_userdata("cart_login",$this->uri->segment("1"));
        $data = array();
        
        // Retrieve cart data from the session
        // $data['cartItems'] = $this->cart->contents();
         $cartContent=$this->cart->contents();

        $user_id=$this->session->userdata(FRONTEND_SESS_CODE.'log_id');

        if(!empty($user_id)){


          //$data['cartItems']=$this->f->WhereResultArray("*","va_cart_tbl",null,null,['user_id'=>$user_id],null,null);
          $data['cartItems']=$this->f->InnerJoinResultsearch("*",'va_product_tbl p','va_cart_tbl c','inner','c.product_id=p.id',['user_id'=>$user_id,'cart_status'=>0],'rowid','ASC',null,null,null,null);
          $data['subtotal']=$this->f->SelectSum('subtotal','va_cart_tbl',['user_id'=>$user_id,'cart_status'=>0]);
          $this->cart->destroy();
          // if($data['subtotal']->subtotal==0){
          //   redirect('/');
          // }

        }else{

            $data['cartItems'] = $this->cart->contents();

        }

        if(!empty($cartContent)  && !empty($user_id)){

            foreach($cartContent as $items){

               $prodCount=$this->f->Record_count("*","va_cart_tbl",['product_id'=>$items['id'],'user_id'=>$user_id,'cart_status'=>0]);

               if($prodCount>0){
                 //$this->cart->destroy();

               $getData=$this->f->WhereRowFetch("*","va_cart_tbl",['product_id'=>$items['id'],'cart_status'=>0]);

               $getData->qty;
               $getData->price;
               $getData->subtotal;

                $update=array(
                          'qty'=>($items['qty'])+($getData->qty),
                          'subtotal'=>($items['subtotal']*$items['qty'])+($items['subtotal']*$getData->qty),
                            );
                $this->f->ArrayUpdate($update,"va_cart_tbl",['product_id'=>$items['id'],'user_id'=>$user_id],"rowid",null);
               }else{
                 //$this->cart->destroy();
                $data_ins=array(
                          'product_id'=>$items['id'],
                          'qty'=>$items['qty'],
                          'price'=>$items['price'],
                          'subtotal'=>$items['subtotal'],
                          'name'=>$items['name'],
                          'user_id'=>$user_id,
                          'created_on'=>DATE
                          );
               $this->f->Common_Insert("va_cart_tbl",$data_ins);
               }

            }
        }
        // Load the cart view
        $this->load->view('frontend/cart/index', $data);
    }

    
    function removeItem(){

        $rowid = $this->input->get('cart_id');
        if(!Is_numeric($rowid)){
        // Remove item from cart
        $remove = $this->cart->remove($rowid);
        
        // Redirect to the cart page
         } else {
           $remove = $this->f->MultipleTblDelete("va_cart_tbl",['rowid'=>$rowid]);
         }

          echo $remove?'ok':'err';
    }

        function incItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('cart_id');
        $qty = $this->input->get('qty');
        
        if(!Is_numeric($rowid)){
          //echo $qty;exit;
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty+1
            );
            $update = $this->cart->update($data);
        }
        } else {
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );

         $res =$this->f->WhereRowFetch(["qty","price","subtotal"],"va_cart_tbl",['rowid'=>$rowid]);
         //echo $res->qty;exit;
         $get_qty=$qty+1;
         $get_dubtotal=($res->price)*$get_qty;
         $update = $this->f->ArrayUpdate(['qty'=>$get_qty,'subtotal'=>$get_dubtotal],"va_cart_tbl",['rowid'=>$rowid],"rowid",null);

        }
      }
        
        // Return response
        echo $update?'ok':'err';
    }

  function decItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('cart_id');
        $qty = $this->input->get('qty');
        
        if($qty>1){

        if(!Is_numeric($rowid)){
          //echo $qty;exit;
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty-1
            );
            $update = $this->cart->update($data);
        }
        } else {
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
         $res =$this->f->WhereRowFetch(["qty","price","subtotal"],"va_cart_tbl",['rowid'=>$rowid]);
         $get_qty=$qty-1;
         $get_dubtotal=($res->price)*$get_qty;
         $update = $this->f->ArrayUpdate(['qty'=>$get_qty,'subtotal'=>$get_dubtotal],"va_cart_tbl",['rowid'=>$rowid],"rowid",null);  
        }
      }
    }else{
        echo "err";
    }
        
        // Return response
        echo $update?'ok':'err';
    }
    
}