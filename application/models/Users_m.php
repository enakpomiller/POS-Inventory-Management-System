<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_m extends CI_model {
    public  $tbl_users = 'tbl_users';
    public  $tbl_roles = 'tbl_roletemplate';
    public  $tbl_staffrole = 'tbl_staffrole';
    public  $tbl_privilleges = 'tbl_privilleges';
    public  $tbl_country  = "countries ";
    public  $tbl_customers = "tbl_customers";



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

        $this->db->select('tbl_users.userID,tbl_users.plainpassword, tbl_users.fname,tbl_users.lname,tbl_users.phone,tbl_users.username,tbl_users.date_created,tbl_privilleges.office');
        $this->db->from($this->tbl_users);
        $this->db->join('tbl_privilleges','tbl_users.userID = tbl_privilleges.userID');
        $query = $this->db->get()->result();
        return $query;
   }
  public function getallroles(){
   return $this->db->get($this->tbl_roles)->result();

   }



   public function updateuserrecord($userdata){
         //echo "<pre>"; print_r($userdata['user_update']);die;
      $this->db->where('userID',$userdata['user_update']['userID']);
       $query  =  $this->db->update($this->tbl_users,$userdata['user_update']);
         if($query){
             $this->db->where('userID',$userdata['user_update']['userID']);
             return  $this->db->update($this->tbl_privilleges,$userdata['office_arr'] );
         }else{
           echo " cannot update ";
         }


   }

  public function getallstaffrole(){
      return $this->db->get($this->tbl_staffrole)->result();
   }

  public function createprivilleges($data){
      $this->db->insert($this->tbl_privilleges,$data);
      $last_id = $this->db->insert_id();
      return $last_id;

   }

  public function resetpassword($userdata,$where){
      $this->db->where($where);
      return $this->db->update($this->tbl_users,$userdata);
  }

  public function getallcountries(){
      return $this->db->get($this->tbl_country)->result();
  }

  public function CreatCustomer($costumer_arr){
      $this->db->insert('tbl_customers',$costumer_arr);
      $lastID = $this->db->insert_id();
      return $lastID;
  }

}

?>
