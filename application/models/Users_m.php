<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_m extends CI_model {
    public  $tbl_users = 'tbl_users';
    public  $tbl_roles = 'tbl_roletemplate';

    

   public function createusers($array){
      $this->db->insert('tbl_users',$array);
      $last_id = $this->db->insert_id();
      return  $last_id;
   }

  public function CheckUserExist ($usercheck){
    $where = array('username' =>  $usercheck);
    $this->db->where($where);
    return $this->db->get($this->tbl_users)->row();
  }


  public function getallroles(){
   return $this->db->get($this->tbl_roles)->result();

  }


}

?>