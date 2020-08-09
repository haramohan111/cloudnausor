<?php
defined('BASEPATH') or die('Please set up the configuration');

Class Crud extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    /*>>Getting data from table code starts*/
    public function Login($cols,$table_name,$where,$update)
    {
        $response=array();
        if($where)
        {
            $this->db->where($where);
        }
        $query=$this->db->select($cols)->from($table_name)->get();
        $count=$query->num_rows();
        if($count==1){
        $admin=$query->row();
        if($admin->admin_status==1){
            $this->db->update("$table_name", $update);
            $admin_sess_store=array(BACKEND_SESS_CODE.'log_id'=>$admin->admin_id,
                                    BACKEND_SESS_CODE.'log_user'=>$admin->admin_name,
                                    BACKEND_SESS_CODE.'log_email'=>$admin->admin_email);

            $this->session->set_userdata($admin_sess_store);
            return 1;
            }else{
               return 3;
            }
        }else
        {
            return 2;
        }
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

        public function WhereResultLimit($cols,$tbl,$per,$si,$where,$order_by_col,$ord,$group){
        if($where){
            $this->db->where($where);
        }

        if($group){
        $this->db->group_by($group);
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

    public function ManageProduct($select,$tbl1,$tbl2,$tbl3,$match_id1,$match_id2,$join1,$join2,$where,$where1,$order_col,$order_by,$per,$si,$lik_col1,$like1,$lik_col2,$like2,$lik_col3,$like3,$lik_type){
        if($order_col){
        $this->db->order_by($order_col,"$order_by");
        }
        if($where1){
            $this->db->where($where1);
        }
        if($where){
        $this->db->where($where);
        }
        if($per){
        $this->db->limit($per,$si);
        }

        if($like1)
        {
        $this->db->like($lik_col1,$like1,$lik_type);
        }

        if($like2)
        {
        $this->db->like($lik_col2,$like2,$lik_type);
        }

        if($like3)
        {
        $this->db->like($lik_col3,$like3,$lik_type);
        }

        $this->db->select($select);
        $this->db->from($tbl1);
        $this->db->join($tbl2, "$match_id1",$join1);
        if($tbl3){
        $this->db->join($tbl3, "$match_id2",$join2);   
        }
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $count = $query->num_rows();
        if($count>0){
        return $query->result();
        }else{
        return null;
        }
    }

    public function commonInsert($table,$insertdata,$displaymessage,$cols,$where,$orwhere){
        if($where){
        $this->db->where($where);
    }

    if($orwhere){
        $this->db->or_where($orwhere);
    }
        $sql_fetch=$this->db->select($cols)->from($table)->get();
       // echo $this->db->last_query();exit;
        $count=$sql_fetch->num_rows();
       // echo $count;exit;
        if($count <1){
        $response = array();
        if (is_array($insertdata)) {
                    $sql = $this->db->insert_string($table, $insertdata);
                    $insert = $this->db->query($sql);
                        if ($insert) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                        } else {
                           
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Data not inserted';
                        }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
    }else{
           $response[CODE] = 3;
           $response[MESSAGE] = 'fail';
           $response[DESCRIPTION] = 'Given name already exit';
        
    }
    return json_encode($response);
    }

    public function Common_Insert($tbl,$data){
        $res=$this->db->insert("$tbl",$data);
        //echo $this->db->last_query();exit;
        if($res)
            return true;
        else
            return false;
    }

    public function Common_manage($cols,$table,$where,$order_by_col,$ord,$like_col,$like,$or_like_col,$or_like,$col_status,$status,$per,$si){

    if($where)
    {
    $this->db->where($where);
    }
    if($status!='' && $status!=0)
    {
     $this->db->where($col_status,$status);
    } 
    if($like)
    {
    $this->db->like($like_col,$like,'both');
    }
    if($or_like)
    {
    $this->db->or_like($or_like_col,$or_like,'both');
    }
    //$resposne=array();
    //$resposne['code'] = ($count > 0) ? 200 : 204;
    $res=$this->db->limit($per,$si)->select($cols)->from($table)->order_by($order_by_col,$ord)->get();
   //echo $this->db->last_query();exit;
        $count = $res->num_rows();
        if($count>0){
        return $res->result();
        }
        else{
        return null;
        }
   }
  
      public function commonIdRow($select,$tbl,$where){
        $query=$this->db->select($select)->from($tbl)->where($where)->get();
        //echo $this->db->last_query();exit;
        $count=$query->num_rows();
        if($count >0)
            return $query->row();
        else
            return null;
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

        public function DeletePermanante($tbl,$where){
        if($where){
         $this->db->where($where);
        }
         $this->db->delete($tbl);
        $affetcted_rows= $this->db->affected_rows();
        if($affetcted_rows);
        return true;
    }
}
?>