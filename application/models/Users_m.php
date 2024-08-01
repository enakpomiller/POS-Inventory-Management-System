<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_m extends CI_model {
    public  $tbl_users = 'tbl_users';
    public  $tbl_roles = 'tbl_roletemplate';
    public  $tbl_staffrole = 'tbl_staffrole';
    public  $tbl_privilleges = 'tbl_privilleges';



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

  public function getallusers(){
      return $this->db->get($this->tbl_users)->result();
   }
  public function getallroles(){
   return $this->db->get($this->tbl_roles)->result();

   }

  public function getallstaffrole(){
      return $this->db->get($this->tbl_staffrole)->result();
   }

  public function createprivilleges($data){
      $this->db->insert($this->tbl_privilleges,$data);
      $last_id = $this->db->insert_id();
      return $last_id;

   }

}

?>
