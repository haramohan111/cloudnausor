<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Frontend_model','f');
        $this->datetime = date('Y-m-d H:i:s');

    } 
	public function index()
	{
		$this->data['result']=$this->f->WhereResultLimit('*',"va_product_tbl",null,null,null,"id","ASC");
		$this->load->view('welcome_message',$this->data);
	}
}
