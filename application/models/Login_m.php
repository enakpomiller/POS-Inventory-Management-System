<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php 

class Login_m extends CI_Model{
    public $admin_table = "tbl_admin";
    public $tbLusers   = 'tbl_privilleges';



public function checkuserlogin($uname,$pass){
     $where = array('username'=>$uname,'password'=>$pass);
     $this->db->where($where);
     $query = $this->db->get($this->admin_table);
     return $query->row();
            //  if($query->num_rows()==1){
            //    return true;
            //  }else{
            //   return false;
            // }

 }




}
?>