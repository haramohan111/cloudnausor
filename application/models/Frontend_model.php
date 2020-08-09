<?php
defined('BASEPATH') or die('Please set up the configuration');

Class Frontend_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function Login($cols,$table_name,$where,$where1,$or_where,$update){
       // echo "gg";exit;
        if($where)
        {
            $this->db->where($where);
        }
        if($or_where)
        {
            $this->db->or_where($or_where);
        }
        if($where1)
        {
            $this->db->where($where1);
        }
        $query=$this->db->select($cols)->from($table_name)->get();
        //echo $this->db->last_query();exit;
        $count=$query->num_rows();
        if($count==1){
        $user=$query->row();
        // echo $user->user_status ;
        // echo $user->verified_email;exit;
        if($user->user_status==1 && $user->verified_email==1){
              $this->db->update("$table_name", $update);
              $sess_login=array(
                FRONTEND_SESS_CODE.'log_id' => $user->user_id,
                FRONTEND_SESS_CODE.'user_name' => $user->user_name,
                FRONTEND_SESS_CODE.'user_mobile' => $user->user_mobile,
                FRONTEND_SESS_CODE.'user_email' => $user->user_email,
            );
              $this->session->set_userdata($sess_login);
               return 1; //sucess
        } elseif($user->user_status==3) {
               return 3; //user block
        } 
        elseif($user->user_status==2 && $user->verified_email==2) {
               return 4; //user notverified
        }
         } else {
           return 2;//invali user
        }
    }
    
       public function WhereResultLimit($cols,$tbl,$per,$si,$where,$order_by_col,$ord){
        if($where){
            $this->db->where($where);
        }

        if($order_by_col){
            $this->db->order_by($order_by_col,$ord);
        }

        if($per){
        $this->db->limit($per,$si);
        }

        $res=$this->db->select($cols)->from($tbl)->get();
        //echo $this->db->last_query();exit;
        $count = $res->num_rows();
        if($count>0){
        return $res->result();
        }
        else{
        return null;
        }  
    }

    public function WhereResultArray($cols,$tbl,$per,$si,$where,$order_by_col,$ord){
        if($where){
            $this->db->where($where);
        }

        if($order_by_col){
            $this->db->order_by($order_by_col,$ord);
        }

        if($per){
        $this->db->limit($per,$si);
        }

        $res=$this->db->select($cols)->from($tbl)->get();
        //echo $this->db->last_query();exit;
        $count = $res->num_rows();
        if($count>0){
        return $res->result_array();
        }
        else{
        return null;
        }  
    }

        public function SelectSum($col,$tbl,$where){
        if($where){
            $this->db->where($where);
        }
        $this->db->select_sum($col);
        $query = $this->db->get($tbl); 
        //echo $this->db->last_query();exit;
        return $query->row();
    }

    public function Record_count($cols,$table_name,$where)
    {   
    if($where){
        $this->db->where($where);
    }    
        $sql=$this->db->select($cols)
                      ->from($table_name)
                      ->get();
    
        $count=$sql->num_rows();
        //echo $this->db->last_query();exit;
        //echo $count;exit;
        return $count;
    }
    
        public function Common_Insert($tbl,$data){
        $res=$this->db->insert("$tbl",$data);
        //echo $this->db->last_query();exit;
        if($res)
            return true;
        else
            return false;
    }

    public function WhereRowFetch($cols,$table,$where){
        if($where){
            $this->db->where($where);
        }
        $res=$this->db->select($cols)->from($table)->get();
        //echo $this->db->last_query();exit;
        $count = $res->num_rows();
        if($count>0){
        return $res->row();
        }
        else{
        return null;
        }  
    }

        public function ArrayUpdate($update,$tbl,$where,$select,$where1){
        if($where1){
            $this->db->where($where1);
        }
        $sql=$this->db->select($select)->from($tbl)->get();
       //echo $this->db->last_query();exit;
        $count=$sql->num_rows();
        if($count>0){
        $this->db->update($tbl,$update,$where);
         //echo $this->db->last_query();exit;
       if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
        }else{
            return false;
        }
    }

    public function InnerJoinResultsearch($select,$tbl1,$tbl2,$join,$match_id,$where,$order_col,$order_by,$per,$si,$lik_col,$like){
            //$this->db->group_by($group);
        if($order_col){
        $this->db->order_by($order_col,"$order_by");
        }

        if($where){
        $this->db->where($where);
        }
        if($like)
        {
        $this->db->like($lik_col,$like,'both');
        }

        if($per){
        $this->db->limit($per,$si);
        }
        $this->db->select($select);
        $this->db->from($tbl1);
        $this->db->join($tbl2, "$match_id",$join);

        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $count = $query->num_rows();
        if($count>0){
        return $query->result_array();
        }else{
        return null;
        }
    }


    public function MultipleTblDelete($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
        //echo $this->db->last_query();exit;
        return true;
    }

}
?>