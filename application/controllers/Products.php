<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){

        parent:: __construct();
        $this->load->helper(array('form','url','text'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('users_m');
        $this->load->database();
        $this->load->helper('uuid_helper');
   
        if(!isset($this->session->logged_in)){
          return redirect(base_url('login'));
        }
   
      }


    public function addproductxx(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           $rules = $this->addproduct_rules();
           $this->form_validation->set_rules($rules);
           if($this->form_validation->run() === TRUE){
                $product_arr = [
                    'prodname' => $_POST['prodname'],
                    'prodprice' => $_POST['prodprice'],
                    'prodcategory' => $_POST['prodcategory'],
                    'nafdacno' => $_POST['nafdacno'],
                    'prodserialno' => $_POST['prodserialno'],
                    'prodqty' => $_POST['prodqty'],
                    'purchase_date' => $_POST['purchase_date'],
                    'expiring_date' => $_POST['expiring_date'],
                    'prodbrand'  =>  $_POST['prodbrand'],
                    'date_created' => date('M-D-Y H:i:sa'),
                    'prodUnique'  => rand(4000000,999999999).date('y-m-d H:i:sa').generate_uuid()
                ];
                  //echo "<pre>"; print_r($product_arr);exit;
                $insert = $this->db->insert('tbl_products',$product_arr);
                if($insert){
                    echo true; 
                    $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Product Created Succssfully ']);
                    //return redirect(base_url('products/addproduct'));
                }else{
                  echo false; 
                }

             
            }else{
                $this->data['title'] =  " create products items  ";
                $this->data['page_name'] = "addproduct";
                $this->load->view("admin_index",$this->data);
            }
        }else{
            

            $this->data['title'] =  " create products items  ";
            $this->data['page_name'] = "addproduct";
            $this->load->view("admin_index",$this->data);
        }
     
    
    } 

    public function addproduct (){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $product_arr = [
                'userID' => $this->session->userID,
                'prodname' => $_POST['prodname'],
                'prodprice' => $_POST['prodprice'],
                'prodcategory' => $_POST['prodcategory'],
                'nafdacno' => $_POST['nafdacno'],
                'prodserialno' => $_POST['prodserialno'],
                'prodqty' => $_POST['prodqty'],
                'purchase_date' => $_POST['purchase_date'],
                'expiring_date' => $_POST['expiring_date'],
                'prodbrand'  =>  $_POST['prodbrand'],
                'date_created' => date('M-D-Y H:i:sa'),
                'prodUnique'  => rand(4000000,999999999).date('y-m-d H:i:sa').generate_uuid()
            ];
              //echo "<pre>"; print_r($product_arr);exit;
            $insert = $this->db->insert('tbl_products',$product_arr);
            if($insert){
               echo true;
             }else{
               echo false; 
             }
        }else{
            $this->data['title'] =  " Create Products Items  ";
            $this->data['page_name'] = "addproduct";
            $this->load->view("admin_index",$this->data);
        }
    }

   public function add_multiple_prod(){;
    $this->data['title'] =  " Add Multiple Products   ";
    $this->data['page_name'] = "addmultipleprod";
    $this->load->view("admin_index",$this->data);

  }

  public function viewprod(){
    $this->data['title'] =  " Products Display   ";
    $this->data['allprod'] = $this->db->get('tbl_products')->result();
    $this->data['page_name'] = "viewprod";
    $this->load->view("admin_index",$this->data);
  }


  public function addproduct_rules() {
    $rules = array(
        array(
            'label' => 'Product Name',
            'field' => 'prodname',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Product Price',
            'field' => 'prodprice',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Product Category',
            'field' => 'prodcategory',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Nafdac Reg Number',
            'field' => 'nafdacno',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Product Serial Number',
            'field' => 'prodserialno',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Product Quantity',
            'field' => 'prodqty',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Date Purchased',
            'field' => 'purchase_date',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Expiring Date',
            'field' => 'expiring_date',
            'rules' => 'trim|required'
        ),
        array(
            'label' => 'Product Brand',
            'field' => 'prodbrand',
            'rules' => 'trim|required'
        )

    );
    return $rules;
}




}