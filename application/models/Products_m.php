<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Products_m extends CI_Model {

   public $tbl_products  = 'tbl_products';



   public function createproduct($data){
    return $this->db->insert($this->tbl_products,$data);

   }

   public function updateproducts($data_update){
       $this->db->where('prodID',$data_update['prodID']);
       return $this->db->update($this->tbl_products,$data_update);
   }

}


?>