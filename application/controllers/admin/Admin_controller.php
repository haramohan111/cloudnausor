<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('admin/Crud');
       // $this->user_id=$this->session->userdata(BACKEND_SESS_CODE.'log_id');
        // if(!empty($this->user_id)==true){
        //     redirect('dashboard');
        // }
    }

	public function index()
	{

		$this->load->view('admin/login');
	}

	public function admin_login(){
        $this->form_validation->set_rules('email','email','required|valid_email',array('required'=>'Email is required','valid_email'=>'Invalid email'));
        $this->form_validation->set_rules('password','password','required',array('required'=>'Password is required'));
        if($this->form_validation->run()==false){
               $this->load->view('admin/login');
        }else{
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $cols=array('admin_id','admin_name','admin_email','admin_status');
        $where=array(
                   'admin_email'=>$email,
                   'admin_password'=>md5($password)
                    );
        $update=array('admin_last_login_date'=>DATE,
                      'admin_last_login_ip'=>$_SERVER['REMOTE_ADDR']
                    );
                    $check=$this->Crud->Login($cols,'cn_admin_tbl',$where,$update);
                    if($check== 1)
                    {
                        //$this->session->set_flashdata('success', 'Login successfully');
                        //print_r($_SESSION);exit;
                        //echo "1";exit;
                        redirect('admin/dashboard');
                        //$this->load->view("superadmin/dashboard");
                    }
                    if($check == 2)
                    {
                        $this->session->set_flashdata('failed', 'The login is invalid.');
                        //echo "2";exit;
                        redirect('admin');
                    }
                    if($check == 3)
                    {
                        $this->session->set_flashdata('failed', 'Your account has been blocked');
                        //echo "3";exit;
                        redirect('admin');
                    } 
           }                    
    }

    public function logout(){
        $this->session->unset_userdata(BACKEND_SESS_CODE.'log_id');
        redirect("admin");
    }
}
