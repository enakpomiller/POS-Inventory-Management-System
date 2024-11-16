
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php

class Dashboard_m extends CI_Model{
    public $tbl_order = 'tbl_order';


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


    // public function getArticles($limit, $offset) {
    //     $this->db->distinct();
    //     $this->db->limit($limit, $offset);
    //     $this->db->select('
    //         countries.country as countryName,
    //         tbl_cart.invoiceNumber,
    //         tbl_cart.prodname,
    //         tbl_cart.prodprice,
    //         tbl_cart.prodqty,
    //         tbl_customers.customerID,
    //         tbl_customers.fname,
    //         tbl_customers.lname,
    //         tbl_customers.country,
    //         tbl_cart.date_created,
    //         tbl_customers.phone,
    //         SUM(tbl_order.totalprice) as totalprice' // Aggregate total price if needed
    //     );

    //     // Joins
    //     $this->db->from('tbl_customers');
    //     $this->db->join('tbl_cart', 'tbl_customers.customerID = tbl_cart.customerID', 'inner');
    //     $this->db->join('countries', 'tbl_customers.country = countries.id', 'left');
    //     $this->db->join('tbl_order', 'tbl_customers.customerID = tbl_order.customerID', 'inner');

    //     // Group by customer to avoid duplicates
    //     $this->db->group_by('tbl_customers.customerID');

    //     // Execute the query and return the results
    //     return $this->db->get()->result();
    // }






}
