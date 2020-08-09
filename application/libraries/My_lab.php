<?php 
Class My_lab{
    public function mypagination($base_url, $total_rows, $per_page){
            $config=array(
                            'base_url'          => $base_url,
                            //'uri_segment'     => 4,
                            'per_page'          => $per_page,
                            //'use_page_numbers'    =>true,
                            'total_rows'        => $total_rows,
                            'full_tag_open'     => "<ul class='pagination pagination-sm m-0 float-right'>",
                            'full_tag_close'    => '</ul>',
                            'first_link'        => '<span class="page-link">First</span>',
                            'last_link'         => '<span class="page-link">Last</span>',
                            'num_links'         => 3,
                            'next_link'         => '<span class="page-link">Next</span>',
                            'prev_link'         => '<span class="page-link">Prev</span>',
                            'first_tag_open'    => '<li class="page-item">',
                            'first_tag_close'   => '</li>',
                            'last_tag_open'     => '<li class="page-item">',
                            'last_tag_close'    => '</li>',
                            'next_tag_open'     => '<li class="page-item">',
                            'next_tag_close'    => '</li>',
                            'prev_tag_open'     => '<li class="page-item">',
                            'prev_tag_close'    => '</li>',
                            'num_tag_open'      => '<li class="page-item"><span class="page-link">',
                            'num_tag_close'     => '</span></li>',
                            'cur_tag_open'      => "<li class='page-item active'><span class='page-link'><a>",
                            'cur_tag_close'     => '</a></span></li>'
                        );
            return $config;
        }


    public function send_user_email($to,$from,$subject,$message){ 
    $config=array(
                // 'protocol' => 'smtp', 
                // 'smtp_host' => 'ssl://smtp.googlemail.com', 
                // 'smtp_port' => 465, 
                // 'smtp_user' => 'sbhagaban999@gmail.com', 
                // 'smtp_pass' => '',
                'charset'=>'utf-8',
                'newline'=> "\r\n",
                'mailtype'=>'html',
                'validation'=> true
     );
                $this->load->library('email');
                $this->email->initialize($config);
                $this->email->to($to);
                $this->email->from($from);
                $this->email->subject($subject);
                $this->email->message($message);
      if($this->email->send())
      {
       return true;
      }
      else
      {
       return false;
      }
    }  

}
 ?>