<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){

        parent:: __construct();
        $this->load->helper(array('form','url','text','phpmailer_helper'));
        $this->load->library('form_validation');
        $this->load->library('csvimport');
        $this->load->library('session');
        $this->load->model('users_m');
        $this->load->database();
        $this->load->helper('uuid_helper');
        $this->load->model(array('products_m'));

        if(!isset($this->session->logged_in)){
          return redirect(base_url('login'));
        }

      }


      public function send_eamil() {
         $to = 'ennaxtechnologies@gmail.com';
         $subject = 'INVENTORY';
         $message = 'from inventory';


         if (send_email($to, $subject, $message)) {
             echo 'Message has been sent';
         } else {
             echo 'Message could not be sent.';
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
            $this->data['title'] =  " create products items ";
            $this->data['page_name'] = "addproduct";
            $this->load->view("admin_index",$this->data);
        }


    }

    public function addproduct (){
        if($_POST){
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
                'prodUnique'  => rand(4000000,999999999).date('y-m-d H:i:sa').generate_uuid(),
                'barcode' => $this->barcode()
            ];

              //echo "<pre>"; print_r($product_arr);die;
              //$insert = $this->db->insert('tbl_products',$product_arr);
            $insert  = $this->products_m->createproduct($product_arr);
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
      $this->data['title'] =  " Add Multiple Products";
      $this->data['page_name'] = "addmultipleprod";
      $this->load->view("admin_index",$this->data);

   }

  public function downloadtemp(){

    $usertype = $this->session->userdata('seller_id');
        //csv file name
        $filename = 'bulk_update_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // get data
        $usersData = $this->products_m->productsDetails();

        // file creation
        $file = fopen('php://output', 'w');
        $header = array(
          "PRODUCT NAME",
          "pPRODUCT PRICE",
          "PRODUCT CATEGORY",
          "NAFDAC SERIAL NUMBER",
          "SERIAL NUMBER",
          "QUANTITY",
          "PURCHASE DATE",
          "EXPIRING DATE",
          "BRAND",
          "DATE CREATED",
          "PRODUCT UNIQUE",
          "USER ID",
          "BARCODE"
        );
        fputcsv($file, $header);
        // foreach ($usersData as $key=>$line){
        // 	fputcsv($file,$line);
        // }
        fclose($file);
        exit;
        //end

  }

  public function upload_bulk_products (){
            if(isset($_POST)){
               if(isset($_FILES["csvFile"])) {
                 // var_dump($_FILES);
                 // var_dump($_POST); exit;
                 $config['upload_path'] = 'assets/csvfiles/';
                 $config['allowed_types'] = 'text/plain|text/csv|csv';
                 $config['max_size'] = '2048';
                 $config['file_name'] = 'product_list.csv';
                 $config['mime'] = $_FILES["csvFile"]['type'];
                 $config['overwrite'] = TRUE;
                   
                 //$this->upload->initialize($config);
                 $this->load->library('upload', $config);
                 if(!$this->upload->do_upload("csvFile")) {
                    $error = array('error' => $this->upload->display_errors());
                      $this->upload->display_errors();
                      $this->session->set_flashdata('toastr', ['type' => 'error','message' => 'Error! Please Choose a CSV FILES ']); 
                      return redirect(base_url('products/add_multiple_prod'));
                 } else {

                   $file_data = $this->upload->data();
                   // $file_path =  'uploads/csv/staff_list.csv';
                   $file_path =  'assets/csvfiles/product_list.csv';

                   // $file_path =  $file_data['full_path'];
                   $headers = ["PRODUCT NAME","pPRODUCT PRICE","PRODUCT CATEGORY","NAFDAC SERIAL NUMBER","SERIAL NUMBER","QUANTITY","PURCHASE DATE","EXPIRING DATE","BRAND","DATE CREATED","PRODUCT UNIQUE","USER ID","BARCODE"];
                   // $csv_array = $this->csvimport->get_array($file_path);
                   // echo "<pre>"; var_dump($csv_array); exit;

                   $handle = fopen($file_path, "r");
                   if ($handle) {
                     for ($i = 1; $row = fgetcsv($handle); ++$i) {
                      
                       //$type = $_POST['usertype'];
                       $insert_data = array(
                         "prodname" => $row[0],
                         "prodprice" => $row[1],
                         "prodcategory" => $row[2],
                         "nafdacno" =>$row[3],
                         "prodserialno" =>$row[4],
                         "prodqty" => $row[5],
                         "purchase_date" => $row[6],
                         "expiring_date" => $row[7],
                         "prodbrand" => $row[8],
                         "date_created" => $row[9],
                         "produnique" => rand(4000000,999999999).date('y-m-d H:i:sa').generate_uuid(),
                         "userID" => $this->session->userID,
                         "barcode" =>  $this->barcode()
                       );
                       if($i > 1){
                         $this->products_m->insert_csv($insert_data);
                       }
                     }
                     // echo "<pre>"; var_dump($insert_data); exit;
                     fclose($handle);
                      $this->session->set_flashdata('toastr', ['type' => 'success','message' => 'Bulk Products Created Succssfully ']); 
                       return redirect(base_url('products/add_multiple_prod'));
                   } else {
                      $this->session->set_flashdata('toastr', ['type' => 'error','message' => 'Error! Unable to Upload (CSV) File ']); 
                      return redirect(base_url('products/add_multiple_prod'));
                   }

                 }
               } else {
                    var_dump(" file not found");exit;
                 $this->session->set_flashdata('csv_error', 'Import Error :(  File Not Found');
                 return redirect(base_url('products/add_multiple_prod'));
               }
             }else{
              return redirect(base_url('products/add_multiple_prod'));
             }

  }



  public function viewprod(){
    $this->data['title'] =  " Products Display   ";
    $this->data['allprod'] = $this->db->get('tbl_products')->result();
    $this->data['page_name'] = "viewprod";
    $this->load->view("admin_index",$this->data);
  }

  public function updateproducts(){
        if($_POST){
          $data_update = [
             'prodID' => $_POST['prod_id'],
             'prodname' => $_POST['prodname'],
             'prodprice' => $_POST['prodprice'],
             'prodcategory' => $_POST['prodcategory'],
             'prodqty' => $_POST['prodqty']
          ];
           $updateprod = $this->products_m->updateproducts($data_update);
            if($updateprod){
                $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Product Updated Successfully']);
                return redirect(base_url('products/viewprod'));

             }else{
                $this->session->set_flashdata('toastr', ['type' => 'error','message' => ' Unable to Delete']);
                return redirect(base_url('products/viewprod'));
            }

        }else{
            return redirect(base_url('products/viewprod'));

        }
  }

  public function printbarcode(){
      $this->data['title'] =  "Print Products Barcodes ";
      $this->data['subtitle'] =  " Barcode Display ";
      $this->data['allbarcode'] = $this->db->get('tbl_products')->result();
      $this->data['page_name'] = "printbarcode";
      $this->load->view("admin_index",$this->data);

   }

   public function order(){
       $this->data['title'] = " Create Order ";
       $this->data['allprod'] = $this->db->get('tbl_products')->result();
       $this->data['page_name'] = "order";
       $this->load->view("admin_index",$this->data);
   }


   public function process_createorder(){
         $input_order = [$_POST];
         var_dump($input_order);die;
  
   }
   public function fetch_records(){
      $value = $this->input->post('selected_value');
      $price = $this->db->where('prodID',$value)->get('tbl_products')->row();

      $response =[
        'prodprice'=>$price->prodprice
      ];
      echo json_encode($response);
  
   }


  public  function deleteproduct ($id){
       $this->db->where('prodID',$id);
       $del = $this->db->delete('tbl_products');
       if($del){
          echo true;
        }else{
          echo false;
        }


   }


  public function barcode(){
  	// Generate a random barcode number for demonstration
  	$barcode_number = mt_rand(100000000, 999999999);
  	return  $barcode_number."-".date('YmdHis');

  }

  public function barcodes(){
        $empt = $this->db->get_where('tbl_products',array('barcode'=>'NULL'))->result();
        if($empt){
           foreach($empt as $fetch){
                  $fetch->barcode;
                $insert_barcode =[
                   'barcode' =>'xxxxxxxxxx'
                ];
                $this->db->where('barcode','NULL');
                $this->db->update('tbl_products',$insert_barcode);
            }
        }else{
          echo " not found ";
        }
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
