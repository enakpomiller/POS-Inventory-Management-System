<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Products_m extends CI_Model {

   public $tbl_products  = 'tbl_products';
   public $tbl_order = 'tbl_order';
   public $tbl_cart = 'tbl_cart';
   public $tbl_product = 'tbl_products';


   public function getArticles($limit, $offset) {
       $this->db->distinct();
       $this->db->limit($limit, $offset);
       $this->db->select('
       countries.country as countryName,
       tbl_cart.invoiceNumber,
       tbl_cart.prodname,
       tbl_cart.prodprice,
       tbl_cart.prodqty,
       tbl_cart.date_created,

       tbl_customers.customerID,
       tbl_customers.fname,
       tbl_customers.lname,
       tbl_customers.phone,

       tbl_order.totalprice,

       tbl_payment.paymentstatus,
       tbl_payment.paymentmethod

        ');

       //Joins
       $this->db->from('tbl_customers');
       $this->db->join('tbl_cart', 'tbl_customers.customerID = tbl_cart.customerID', 'inner');
       $this->db->join('countries', 'tbl_customers.country = countries.id', 'left');
       $this->db->join('tbl_order', 'tbl_customers.customerID = tbl_order.customerID', 'inner');
       $this->db->join('tbl_payment','tbl_customers.customerID = tbl_payment.customerID');

       $this->db->group_by('tbl_customers.customerID');
       return $this->db->get()->result();
   }


   public function searchinvoice ($key){
        $this->db->select('
        countries.country as countryName,
        tbl_customers.customerID, tbl_customers.fname,tbl_customers.lname,tbl_cart.date_created,
        tbl_cart.invoiceNumber,tbl_cart.prodprice,
        tbl_payment.paymentstatus,tbl_payment.paymentmethod,
        tbl_order.totalprice

        ');

        //Joins
        $this->db->from('tbl_customers');
        $this->db->join('countries', 'tbl_customers.country = countries.id', 'left');
        $this->db->join('tbl_cart','tbl_customers.customerID = tbl_cart.customerID','right');
        $this->db->join('tbl_order', 'tbl_customers.customerID = tbl_order.customerID', 'inner');
        $this->db->join('tbl_payment','tbl_customers.customerID = tbl_payment.customerID');

        $this->db->like('tbl_cart.invoiceNumber',$key);

        return $this->db->get()->result();
  }


   public function getCustinvoice($data){
      
       $this->db->select('
       tbl_customers.customerID,tbl_customers.fname,tbl_customers.lname,tbl_customers.phone,tbl_customers.email,

       tbl_cart.invoiceNumber,tbl_cart.prodname,tbl_cart.prodprice,tbl_cart.prodqty,tbl_cart.date_created,tbl_cart.invoiceNumber,tbl_cart.cartID,
       countries.country,

       tbl_payment.paymentstatus

       ');
       $this->db->from('tbl_customers');
       $this->db->join('tbl_cart','tbl_cart.customerID = tbl_customers.customerID');
       $this->db->join('countries','countries.id = tbl_customers.country');
       $this->db->join('tbl_payment','tbl_customers.customerID = tbl_payment.customerID');
       //$this->db->join('tbl_order','tbl_order.customerID = tbl_customers.customerID');
       //$this->db->group_by('tbl_order.orderID');

       $this->db->where('tbl_customers.customerID',$data);
       $query = $this->db->get()->result();
       return $query;
   }

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

  public function viewallinvoice ($limit, $offset){
     $this->db->distinct();
     $this->db->limit($limit, $offset);

     $this->db->select('
     countries.country as countryName,
     tbl_cart.invoiceNumber,
     tbl_cart.prodname,
     tbl_cart.prodprice,
     tbl_cart.prodqty,
     tbl_cart.date_created,

     tbl_customers.customerID,
     tbl_customers.fname,
     tbl_customers.lname,
     tbl_customers.phone,

     tbl_order.totalprice,

     tbl_payment.paymentstatus,
     tbl_payment.paymentmethod

      ');

     $this->db->from('tbl_customers');
     $this->db->join('tbl_cart', 'tbl_customers.customerID = tbl_cart.customerID', 'inner');
     $this->db->join('countries', 'tbl_customers.country = countries.id', 'left');
     $this->db->join('tbl_order', 'tbl_customers.customerID = tbl_order.customerID', 'inner');
     $this->db->join('tbl_payment','tbl_customers.customerID = tbl_payment.customerID');

        //$this->db->where('tbl_customers.customerID',$data);
     $this->db->group_by('tbl_customers.customerID');
     $query = $this->db->get();
     return $query->result();

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


   public function get_records_by_date($startDate, $endDate) {
        $this->db->where("DATE(date) >=", $startDate);
        $this->db->where("DATE(date) <=", $endDate);
        $query = $this->db->get('tbl_customers'); // Replace 'your_table' with the actual table name
        return $query->result();

    }



//  public function deleteinvoicedetails($id){
//     $this->db->where('customerID',$id);
//     $del = $this->db->delete('tbl_cart');
//     if($del){
//       var_dump($id);die;
//        $this->db->where('customerID',$id);
//        $this->db->delete('tbl_customers');

//       $this->db->where('customerID',$id);
//       $this->db->delete('tbl_payment');
       
//       $this->db->where('customerID',$id);
//       $this->db->delete('tbl_order');
      
//     }else{
//      return false;
//     }
// } 

public function getallcountries(){
   return $this->db->get('countries')->result();
 }

  public function getCustOrder($id) {
        $this->db->select('

        tbl_customers.customerID,
        tbl_customers.fname,
        tbl_customers.lname,
        tbl_customers.phone,
        tbl_customers.country,
        tbl_customers.email,
        tbl_customers.phone,
        tbl_products.prodname,

        tbl_order.prodprice,
        tbl_order.prodqty,
        tbl_order.totalprice,tbl_order.customerID,

        countries.country,

        tbl_order.orderID,tbl_order.prodprice,tbl_order.prodqty,tbl_order.prodID


        ');

        //Joins
        $this->db->from('tbl_customers');
        $this->db->join('tbl_order', 'tbl_customers.customerID = tbl_order.customerID', 'inner');
        $this->db->join('tbl_products','tbl_order.prodID = tbl_products.prodID');
        $this->db->join('countries','tbl_customers.country = countries.id');
         $this->db->where('tbl_order.customerID',$id);
         //$this->db->group_by('tbl_customers.customerID');
        return $this->db->get()->result();
    }


  public function updatecustorders($where,$data_arr){
      $this->db->where($where);
     return $this->db->update('tbl_order',$data_arr);
  }

  public function updateprodname($where,$update_prodname){
     $this->db->where($where);
     return $this->db->update($this->tbl_product,$update_prodname);
  }


  public function updatecustbio($update_arr, $where){
    if(isset($where)){
      $this->db->where($where);
      return $this->db->update('tbl_customers', $update_arr);
    }else{
      return false;
     }
     
  }

  public function updateProductsdetails($table, $where, $prodDetails){
     if(isset($where)){
       $this->db->where($where);
       return $this->db->update($table, $prodDetails);
    }else{
     return false;
    }
  }

  public function deletecustcart($where){
    $this->db->where($where);
    return $this->db->delete($this->tbl_cart);
  }

}


?>
