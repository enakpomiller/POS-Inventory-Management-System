<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Products_m extends CI_Model {

   public $tbl_products  = 'tbl_products';
   public $tbl_order = 'tbl_order';



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
      $this->db->select('tbl_order.orderID,tbl_products.prodname,tbl_order.prodprice as price,tbl_order.prodqty,tbl_order.prodprice,tbl_order.totalprice');
      $this->db->from($this->tbl_order);
      $this->db->join('tbl_products','tbl_order.prodID = tbl_products.prodID');
      $this->db->where('tbl_order.userID',$userID);
      $query = $this->db->get()->result();
      return $query;
      
   }

   public function deleteSingleOrderr($where){
    
        $this->db->where($where);
        return $this->db->delete($this->tbl_order);
   }

}


?>
