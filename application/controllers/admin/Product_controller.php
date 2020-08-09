<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/Crud');
        $this->user_id=$this->session->userdata(BACKEND_SESS_CODE.'log_id');
        if(empty($this->user_id)==true){
            redirect('admin');
        }
    }   
    
    public function Add_product(){
       $this->form_validation->set_rules('pname','Product name','required|trim');
       $this->form_validation->set_rules('sku','Product sku','required|trim|numeric');
       $this->form_validation->set_rules('stock','Stock','required|trim|numeric');
       $this->form_validation->set_rules('price','Price','required|trim');
        $this->form_validation->set_rules('image','Image','required|trim');
        if($this->form_validation->run() == false){
          $this->load->view('admin/product/add_product');
        }
        else{
        extract($_POST);
           // print_r($_POST);exit;
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        // $config['file_name']=rand(1000,9999).date('dmY');
        $config['max_size'] = 3000;
        $config['encrypt_name'] = true;  
        $this->load->library('upload', $config);

        if($this->upload->do_upload('image')) {
        $fname=$this->upload->data('file_name');

        $data['name'] = $pname;
        $data['sku'] = $sku;
        $data['stock'] = $stock;
        $data['image'] = $fname;
        $data['price'] = $price;
        $data['created_on'] = DATE;


         $where=array("name"=>$data['product_name']);
        
        $count = $this->Crud->Record_count('id','va_product_tbl',$where);
        
        if($count>0){
            $this->session->set_flashdata('failed', 'Product already added');
            redirect('admin/product/add_product'); 
        }else{

        $sucess=$this->Crud->Common_Insert('va_product_tbl',$data);


        if($sucess ==1)
        {
            $this->session->set_flashdata('success', 'Product name '.$pname.' added Sucessfully');
            redirect('admin/product/add_product'); 
        }
        else
        {
            $this->session->set_flashdata('failed', 'Product not added');
            redirect('admin/product/add_product');
        }
        }
        } else {
            $error=$this->upload->display_errors();
            $rdata['error']=$error;
            $this->load->view('admin/product/add_product',$rdata);

        }
    }
    }

    public function get_submenu(){  
        $did=$this->input->post('did');
       // echo $did;exit;
        $where=array("menu_id"=>$did);
        $res=$this->Crud->WhereResultLimit("*","va_submenu_tbl",null,null,$where,"id",'ASC',null);
        //print_r($res);exit;
        if(!empty($res)){
            //echo "100";exit;
           echo '<option>Select</option>';
        
        foreach($res as $res){
            echo '<option value='.$res->id.'>'.ucwords($res->submenu).'</option>';
        }
        }else{
            echo '200';
        }
    }

    // public function get_result(){  
    //     $cid=$this->input->post('did');
    //     $this->session->set_userdata("store_menu_id",$cid);
        
    //     //$get_submenu_count=$this->get_submenu_data();
    //     // echo $get_submenu_count.'//';
    //     // if($get_submenu_count !==200){
    //     //   $id=0;
    //     // }else{
    //     //   $id=$get_submenu_count;
    //     // }
    //     //  echo $id;exit;
    //     $where=array("menu_id"=>$cid,"submenu_id"=>0);
    //     $count=$this->Crud->Record_count("id","va_price_type_tbl",$where);
    //     if(!empty($count)){
    //     echo  'Please enter '. $count .' price';
    //     }else{
    //         echo 'Not available prices please fill price type in header price menu';
    //     }
    // }

    // public function get_submenu_data(){  
    //     $did=$this->input->post('gid');
    //     $where=array("submenu_id"=>$did);
    //     $count=$this->Crud->Record_count("id","va_price_type_tbl",$where);

    //     if(!empty($count)){
    //                 //echo $count;exit;
    //     echo  'Please enter '. $count .' price';exit;
    //     }else{
    //         echo 'Not available prices please fill price type in header price menu';exit;
    //     }
    // }

    public function manage_product(){      
        extract($_POST);
        if(isset($search)){
            if(!empty($search)){
                  $this->session->set_userdata('search_menu',$search);
            }else{
                  $this->session->unset_userdata('search_menu',$search);
            }
        }

        $search_user=$this->session->userdata('search_menu');

        $base_url = base_url('admin/menu/manage_menu');
        $count_rows = $this->Crud->Record_count('id','va_menu_tbl',null);
        $config['total_rows']=$count_rows;
        $config['per_page'] = 1000;
        $config = $this->my_lab->mypagination($base_url, $config['total_rows'], $config['per_page']);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $si= $this->uri->segment(4,0);
        $table='va_product_tbl';
        $cols='*';
        $order_by_col='id';         
        $data['result']=$this->Crud->Common_manage($cols,$table,null,$order_by_col,"ASC","user_email",$search_user,"user_mobile",$search_user,null,null,$config['per_page'],$si);
       // print_r($data['result']);exit;
        $this->load->view('admin/product/manage_product',$data);
    }

    public function edit_product(){
        $uid=base64_decode($this->uri->segment(4));
        //echo $uid;exit;

        $data['result']=$this->Crud->commonIdRow("*","va_product_tbl",['id'=>$uid]);
        //print_r($data['result']);

        $this->load->view('admin/product/edit_product',$data);

    }


    public function update_product(){
       $this->form_validation->set_rules('pname','Product name','required|trim');
       $this->form_validation->set_rules('sku','Product sku','required|trim|numeric');
       $this->form_validation->set_rules('stock','Stock','required|trim|numeric');
       $this->form_validation->set_rules('price','Price','required|trim');
        if($this->form_validation->run() == false){
            extract($_POST);
            $this->session->set_flashdata('failed', validation_errors());
            redirect($update_url);
        }
        else{
//echo "hello";exit;
        extract($_POST);


            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
           // $config['file_name']=rand(1000,9999).date('dmY');
            $config['max_size'] = 3000;
            $config['encrypt_name'] = true;  
            $this->load->library('upload', $config);

            if($this->upload->do_upload('image')) {

            
                $cols=array("image");
                $where=array("id"=>base64_decode($user_where));
                $del_img=$this->Crud->WhereRowFetch($cols,"va_product_tbl",$where);
                $path="upload/";
                unlink("$path".$del_img->image);

            
            $data['name'] = $pname;
            $data['sku'] = $sku;
            $data['stock'] = $stock;
            $data['image']=$this->upload->data('file_name');
            $data['price'] = $price;
            $data['updated_on'] = DATE;

            }   else {
            // $error=$this->upload->display_errors();
            // $this->session->set_flashdata('failed', $error);
            // redirect($update_url);
            $data['name'] = $pname;
            $data['sku'] = $sku;
            $data['stock'] = $stock;
            $data['price'] = $price;
            $data['updated_on'] = DATE;
        }

            $where=array("id"=>base64_decode($user_where));
            $res=$this->Crud->ArrayUpdate($data,"va_product_tbl",$where,"id",null);

            if($res == true)
            {
            $this->session->set_flashdata('success', 'Product Updated successfully');
            redirect($update_url); 

            }
            else
            {
            $this->session->set_flashdata('failed', 'Product not updated');
            redirect($update_url);
            }


        }

    }

    public function product_act_inact(){
        extract($_POST);
            if(isset($active)){
                $count_multiple = count($multiple);
                if($count_multiple == 0){
                    $this->session->set_flashdata('failure','Please select record');
                    redirect("admin/product/manage_product");            
                }
                $arr1 = array();    
                foreach($multiple as $name) {
                    $where=array("id"=>$name);
                    $update=array('status'=>1);
                  $resp=$this->Crud->ArrayUpdate($update,"va_product_tbl",$where,"id",null);
                    if($resp==1) {
                            $arr1[] = 1;
                        }
                    } if(count($arr1)) {
                          $this->session->set_flashdata('success','The Records You Selected activated Successfully');
                          redirect("admin/product/manage_product");
                           } else {
                          $this->session->set_flashdata('failure','The Records You Selected not activated');
                          redirect("admin/product/manage_product");
                           }       
                    }

           if(isset($inactive)){
                $count_multiple = count($multiple);
                if($count_multiple == 0){
                    $this->session->set_flashdata('failure','Please select record');
                    redirect("admin/redeem/manage_redeem");            
                }
                $arr1 = array();    
                foreach($multiple as $name) {
                    $where=array("id"=>$name);
                    $update=array('status'=>2);
                    $resp=$this->Crud->ArrayUpdate($update,"va_product_tbl",$where,"id",null);
                    if($resp==1) {
                         $arr1[] = 1;
                        }
                    } if(count($arr1)) {
                       $this->session->set_flashdata('success','The Records You Selected inactive Successfully');
                       redirect("admin/product/manage_product");
                        } else {
                       $this->session->set_flashdata('failure','The Records You Selected not inactive');
                        redirect("admin/product/manage_product");
                        }       
                }

            if(isset($delete)){
                $count_multiple = count($multiple);
                if($count_multiple == 0){
                    $this->session->set_flashdata('failure','Please select record');
                    redirect("admin/product/manage_product");            
                }
                $arr1 = array();    
                foreach($multiple as $name) {
                    $where="id=$name";

                    $resp=$this->Crud->DeletePermanante("va_product_tbl",$where);
                    if($resp==1) {
                          $arr1[] = 1;
                        }
                    }
                    if(count($arr1)) {
                        $this->session->set_flashdata('success','The Records You Selected Deleted Successfully');
                                redirect("admin/product/manage_product");
                    } else {
                        $this->session->set_flashdata('failure','The Records You Selected not deleted');
                                redirect("admin/product/manage_product");
                    }       
                }
    }

    public function productRefresh()
    {
        $this->session->unset_userdata('search_pmenu');
        $this->session->unset_userdata('search_psubmenu');
        $this->session->unset_userdata('search_product');
        redirect("admin/product/manage_product");
    }

 }   