<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

  public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Frontend_model','f');
        $this->datetime = date('Y-m-d H:i:s');
    } 
   
  public function Login(){
        $this->load->helper('cookie');
        $this->load->library('encryption');
        // $this->form_validation->set_rules('email','email','required|valid_email',array('required'=>'Email is required','valid_email'=>'Invalid email'));
        //print_r($_POST);exit;
        $this->form_validation->set_rules('email','Mobile Or Email','trim|required',array('required'=>'Email Or Mobile required'));
        $this->form_validation->set_rules('password','password','trim|required',array('required'=>'Password is required'));

        if($this->form_validation->run()==false){
        $data['mresult']=$this->f->WhereResultLimit("*","va_menu_tbl",null,null,["status"=>1],null,null);
        $data['title']= "Login";
        $data['uemail']=$this->encryption->decrypt(get_cookie('uemail'));
        $data['upassword']=$this->encryption->decrypt(get_cookie('upassword'));
        $this->load->view('frontend/login',$data);
        }else{
          //print_r($_POST);exit;
        $email=strip_tags(addslashes($this->input->post('email')));
        $password=strip_tags(addslashes($this->input->post('password')));
         if ($this->input->post("chkremember")=="1")
        {
            $this->input->set_cookie('uemail', $this->encryption->encrypt($email), 86500); /* Create cookie for store emailid */
            $this->input->set_cookie('upassword', $this->encryption->encrypt($password), 86500); /* Create cookie for password */

        }

        $cols=array('user_id','user_name','user_status','user_mobile','user_email','verified_email');
        if(!Is_Numeric($this->input->post('email'))){
            //echo "hi";exit;
        $where=array(
                   'user_email'=>$email,
                   'user_password'=>md5($password)
                    );
        $or_where=null;
        $where1=null;            
                        
        }else{
        $where=array( 
                   'user_mobile' => $email,
                   'user_password'=>md5($password)
                    );
        $or_where=null;
        $where1=null;
      }

        $update=array('last_login_date'=>DATE,
                      'user_last_login_ip'=>$_SERVER['REMOTE_ADDR']
                     );

                    $check=$this->f->Login($cols,'va_users_tbl',$where,$where1,$or_where,$update);
                    //echo $check;exit;
                    $cart=$this->session->userdata("cart_login");
                    //echo $check;exit;
                    if($check==1 && $cart=="cart"){
                        redirect("cart");
                    }

                    if($check==1){
                        redirect(base_url());
                    }
                    if($check==2){
                       $this->session->set_flashdata('failed', 'The login is invalid.');
                        redirect("login");
                    }

                    //echo $check;exit;
                    if($check== 3)
                    {
                        $this->session->set_flashdata('failed', 'You have blocked');
                        redirect('login');
                    }
                    if($check == 4)
                    {
                        $this->session->set_flashdata('failed', 'Please verify email');
                        redirect('login');
                    }
                    // if($check == 5)
                    // {
                    //     $this->session->set_flashdata('failed', 'Your are loging failed');
                    //     redirect('login');
                    // } 

           }
  }

    public function signup(){
        $this->form_validation->set_rules('name','Name','trim|required|regex_match[/^[a-zA-Z .]+$/]|min_length[3]|max_length[30]',array("min_length" => "The name should be more than 3 charecter"));
        $this->form_validation->set_rules('email','Email','trim|valid_email|is_unique[va_users_tbl.user_email]',array("is_unique" => "The Email is already registered"));
        $this->form_validation->set_rules('mobile','Mobile','trim|required|numeric|min_length[10]|max_length[10]|is_unique[va_users_tbl.user_mobile]',array("is_unique" => "The mobile is already registered"));
        $this->form_validation->set_rules('fpassword','Password','trim|required|numeric|min_length[4]|max_length[10]');
        $this->form_validation->set_rules('spassword','Conform password','trim|required|numeric|matches[fpassword]');
        if($this->form_validation->run() == false){
            //redirect("login#");
        $data['title']="Signup"; 
        $this->load->view('frontend/signup',$data);
        //$this->load->view('frontend/template/userVerification',$data);
        }
        else{
          //print_r($_POST);exit;
        extract($_POST);
        $data['veri_code']=session_id();
        $data['user_email']=$email;
        $data['user_mobile']=$mobile;
        $insertdata=array(
                    'user_name'=>ucfirst($name),
                    'user_email'=>$email,
                    'user_mobile'=>$mobile,
                    'user_password'=>md5($fpassword),
                    'registered_on'=>DATE,
                    'signup_verification'=>$data['veri_code']
                );

        $cols=array('user_email','user_mobile');
        $where=array('user_email'=>$email);
        $orwhere=array('user_mobile'=>$mobile);
        //$sucess=$this->f->commonInsert('va_users_tbl',$insertdata,'data inserted Sucessfully',$cols,$where,$orwhere);
               // $insert_decode = json_decode($sucess);

        $sucess=$this->f->Common_Insert("va_users_tbl",$insertdata);
        if($sucess==true){

         $this->session->set_flashdata('success', 'Registration successfully');
         redirect("login");


        }else{
        $this->session->set_flashdata('failed', 'Register failed');
        redirect("signup");
        }

    }
    }

    public function logout(){
    $this->session->unset_userdata(FRONTEND_SESS_CODE.'log_id');
    $this->session->unset_userdata("cart_login");
    redirect("login");
    } 



}
?>