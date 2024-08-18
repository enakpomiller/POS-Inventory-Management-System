<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Products_m extends CI_Model {

   public $tbl_products  = 'tbl_products';
   public $tbl_order = 'tbl_order';
   public $tbl_cart = 'tbl_cart';



   public function createproduct($data){
    return $this->db->insert($this->tbl_products,$data);

   }

   public function updateproducts($data_update){
       $this->db->where('prodID',$data_update['prodID']);
       return $this->db->update($this->tbl_products,$data_update);
   }

   public function productsDetails(){
       $respone = array();
       $this->db->select('*');
       $q = $this->db->get($this->tbl_products);
       $response = $q->result_array();
       return $response;
   }

  public function insert_csv($insert_data){
    return $this->db->insert($this->tbl_products,$insert_data);
  }

  public function createorder($data){
    return $this->db->insert($this->tbl_order,$data);
   }
  
   public function getallorders($userID){
      $this->db->select('tbl_order.orderID,tbl_order.customerID,tbl_products.prodname,tbl_order.prodprice as price,tbl_order.prodqty,tbl_order.prodprice,tbl_order.totalprice');
      $this->db->from($this->tbl_order);
      $this->db->join('tbl_products','tbl_order.prodID = tbl_products.prodID');
      $this->db->where('tbl_order.customerID',$userID);
      $query = $this->db->get()->result();
      return $query;
      
   }


   public function deleteSingleOrderr($where){
        $this->db->where($where);
        return $this->db->delete($this->tbl_order);
   }


   public function getpaymentrecord($userID) {
        $this->db->distinct();
        $this->db->select('tbl_order.orderID,tbl_customers.customerID,tbl_customers.fname,tbl_customers.lname,tbl_order.prodqty,tbl_order.totalprice, tbl_order.prodID,tbl_order.prodprice,tbl_products.prodname');
        $this->db->join('tbl_customers','tbl_order.customerID = tbl_customers.customerID');
        $this->db->join('tbl_products','tbl_order.prodID = tbl_products.prodID');
        $this->db->where('tbl_order.customerID',$userID);
        $query = $this->db->get('tbl_order');
        return $query->result();
  }


  public function sumproduct($where){
     $this->db->select('SUM(totalprice) as sumtotal');
     $this->db->from('tbl_order');
     $this->db->where($where);
     $query = $this->db->get();
     return $query->row();
   }

   public function getcustdetails($data){
      $this->db->select('tbl_customers.fname,tbl_customers.lname,tbl_customers.email,tbl_customers.phone,countries.country,tbl_payment.paymentmethod,tbl_payment.paymentstatus');
      $this->db->from('tbl_customers');
      $this->db->join('countries','countries.id = tbl_customers.country');
      $this->db->join('tbl_payment','tbl_customers.customerID = tbl_payment.customerID');
      $this->db->where('tbl_customers.customerID',$data);
      $query = $this->db->get();
      return $query->row();

  }

  public function insertcustomercart($main_arr){
       $this->db->insert_batch('tbl_cart',$main_arr);
       if($this->db->affected_rows()>0){
         return true;
       }else{
         return false;
       }
      //  $insert_id = $this->db->insert_id();
      //  return $insert_id;
   }

}


?>
