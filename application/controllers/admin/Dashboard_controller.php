<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin/Crud');
        $this->user_id=$this->session->userdata(BACKEND_SESS_CODE.'log_id');
        if(empty($this->user_id)==true){
            redirect('admin');
        }
	}

	public function dashboard(){
        $data['user_count']=$this->Crud->Record_count("user_id","va_users_tbl",null);
        $data['product']=$this->Crud->Record_count("id","va_product_tbl",null);
		$this->load->view('admin/dashboard',$data);
	}
}
