<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

  private $perPage = 5;

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
    $this->load->library('email');

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

//
public function sendcustemail(){
           $myemail - "enakpomiller8899@gmail.com";
           $code = '2';
  // mail configuration------------------------------
         $config = array();
         $config['useragent'] = "CodeIgniter";
         $config['protocol'] = "smtp";
         $config['smtp_host'] = "ssl://smtp.gmail.com";
         $config['smtp_port'] = "465";
         $config['mailtype'] = 'html';
         $config['smtp_user'] = 'ennaxtechnologies@gmail.com';
         $config['smtp_pass'] = 'Ennax8899xxx';
         $config['charset'] = 'utf-8';

         $config['newline'] = "\r\n";
         $config['wordwrap'] = TRUE;

         $this->email->initialize($config);
         $this->email->set_mailtype("html");
         $this->email->set_newline("\r\n");

         //Email content
         $htmlContent ='<center> <div style="background:#ffffff;width:40%;text-align:center;padding:30px;"><h1> Ennax Technologies</h1> <h2>Tracking Code</h2> <br><h2 style="color:grey;">'.$code.'</h2></div></center>';
         //$htmlContent .= '<p>This email has sent via Gmail SMTP server from CodeIgniter application.</p>';

         //$this->email->to('enakpomiller8899@gmail.com');
         $this->email->set_mailtype("html");
         $this->email->set_newline("\r\n");

         $this->email->to($myemail );
         $this->email->from('ennaxtechnologies@gmail.com','Ennax Tech');
         $this->email->subject(' Tracking ');
         $this->email->message($htmlContent);
         //Send email
         if ($this->email->send()){
             var_dump(" email send");die;

         }else {
             var_dump(( $this->email->print_debugger() )); die;

             }
         #END OF EMAIL
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
      //$this->data['allprod'] = $this->db->get('tbl_products')->result();
    $this->data['allprod'] =  $this->products_m->getallproducts();
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
    $this->data['allorder'] = $this->products_m->getallorders($_SESSION['custID']);
    $this->data['page_name'] = "order";
    $this->load->view("admin_index",$this->data);
  }


  public function process_createorder(){
    $insert_order = [
      'prodID' => $_POST['prodID'],
      'prodprice' => $_POST['prodprice'],
      'prodqty' => $_POST['prodqty'],
      'totalprice' => $_POST['totalprice'],
      'customerID' => $_SESSION['custID']
    ];
    //echo "<pre>"; print_r($insert_order);die;
    $insert = $this->products_m->createorder($insert_order);
    if($insert){
      $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Order Created Successfully']);
      return redirect(base_url('products/order'));
    }else{
      echo " error! unable to create order ";
    }

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


  public  function deleteexpiredproduct($id){
   $val =  $this->db->get_where('tbl_products', array('prodID'=>$id ))->row();

     $insert_arr = [
       'prodname' => $val->prodname,
       'prodprice' => $val->prodprice,
       'prodcategory' => $val->prodcategory,
       'nafdacno' => $val->nafdacno,
       'prodserialno' => $val->prodserialno,
       'prodqty' => $val->prodqty,
       'purchase_date' => $val->purchase_date,
       'expiring_date' => $val->expiring_date,
       'prodbrand' => $val->prodbrand,
       'date_created' => $val->date_created,
       'produnique' => $val->produnique,
       'userID' => $val->userID,
       'barcode' => $val->barcode
     ];

    $insert =  $this->db->insert('tbl_expred_products',$insert_arr);
     if($insert){
      $this->db->where('prodID',$id);
      $del = $this->db->delete('tbl_products');
      if($del){
        echo true;
      }else{
        echo false;
      }
    }else{
      echo " cannot insert record ";
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

  public function deleteorder($id){
    $where =['orderID'=>$id];
    $delete = $this->products_m->deleteSingleOrderr($where);
    if($delete){
      echo true;
    }else{
      echo false;
    }
  }


  public function updateorderqty(){
    $data_arr = ['prodqty' =>$_POST['prodqty']];
    $this->db->where('orderID',$_POST['prodid']);
    $dim = $this->db->update('tbl_order',$data_arr);
    if($dim){
      $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Order Quantity Updated Successfully']);
      return redirect(base_url('products/order'));
    }else{
      echo " cannot update ";
    }

  }

  public function processpayment(){
    if($this->session->office == 'MANAGER' || $this->session->office == 'PHARMACIST'){
      $payment_arr = [
        'customerID' => $_SESSION['custID'],
        'paymentmethod' => $_POST['paymentmethod'],
        'paymentstatus' => $_POST['paymentstatus'],
        'invoice_no' => "PIST-000".$_SESSION['custID'],
        'date' => date('Y-M-D')
      ];
      $exist = $this->db->get_where('tbl_payment',array('customerID',$_SESSION['custID']))->row();
      if($exist){
        // var_dump(" exirted");exit;
        $this->db->where('customerID',$_SESSION['custID']);
        $this->db->update('tbl_payment',$payment_arr);
      }else{
        $payment =  $this->db->insert('tbl_payment',$payment_arr);
        if($payment){

          $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Order Paymnet Successfully']);
          return redirect(base_url('products/invoice'));
        }else{
          echo " cannot create ";
        }
      }
    }else{
      return redirect(base_url('login'));
    }
  }

  public function invoice (){
    if($this->session->office == 'MANAGER' || $this->session->office =='PHARMACIST'){
      $userID = $_SESSION['custID'];
      $where = ['customerID'=>$userID];
      $this->data['sumprice'] = $this->products_m->sumproduct($where);
      $this->data['custdetails'] = $this->products_m->getcustdetails($userID);

      $this->data['order'] = $this->products_m->getpaymentrecord($userID);
       //echo "<pre>"; print_r($this->data['order']);die;
      $this->data['title'] = " Order Invoice ";
      $this->data['page_name'] = "invoice";
      $this->load->view('admin_index',$this->data);
    }else{
      return redirect(base_url('login'));
    }
  }

  public function viewallinvoice (){
    $this->data['articles'] = $this->products_m->getArticles(3, 0); // Initial load with 5 articles
      //echo "<pre>"; print_r($this->data['articles']);exit;
    $this->data['page_name'] = 'viewallinvoice';
    $this->load->view('admin_index',$this->data);

  }


public function searchkey(){
  if($_POST){
       $keyword = $this->input->post('key', TRUE); // TRUE applies XSS filtering
                      //$this->db->like('invoiceNumber',$keyword);
                     //$this->data['getinv'] =  $this->db->get('tbl_cart')->result();
       $this->data['getinv']  = $this->products_m->searchinvoice($keyword);
            //echo "<pre>"; print_r($this->data['getinv']);exit;
           //$this->data['getinv'] = $this->db->get_where('tbl_cart', array('invoiceNumber' => $keyword))->result();
        $this->load->view('pages/loadmore_invoice', $this->data);

       if($this->data['getinv']){
          echo 400;

       }else{
       return false;
       }

 }else{
    var_dump(' load data ');die;
 }

}

  public function loadallinvoice(){


    if($this->session->office == 'MANAGER' || $this->session->office =='PHARMACIST' || $this->session->role =='Supper Admin'){
      $offset = $this->input->post('offset');

      $limit = 3; // Number of articles to load on each click

      $articles = $this->products_m->viewallinvoice($limit, $offset);
      //echo "<pre>"; print_r($articles);die;
      if (!empty($articles)) {
        $html = '';
        foreach ($articles as $article) {
          $html .= '
          <table class="table table-stripe">
          <tr>
          <td class=" w-25"><input type="checkbox"> </td>
          <td align="right"> '.$article->fname.'.</td>
          <td style="position:relative;left:0px;"> '.$article->lname.'.</td>
          <td style="position:relative;left:10px;"> '.$article->paymentstatus.'.</td>
          <td style="position:relative;left:30px;"> '.$article->paymentmethod.'.</td>
          <td style="position:relative;left:90px;"> '.$article->invoiceNumber.'.</td>
          <td style="position:relative;left:60px;"> '.$article->totalprice.'.</td>
          <td align="right"> '.$article->countryName.'.</td>
          <td align="right"> '.date('Y-M-D', strtotime($article->date_created)).'.</td>
          <td>
           <div class="bg-info" style="position:relative;50px;">
             <a href="'.base_url("products/viewcustinvoice/".$article->customerID).'." class="btn btn-danger pr-2 pl-2"><i class="fa fa-trash"></i></a>
             <a href="'.base_url("products/viewcustinvoice/".$article->customerID).'." class="btn btn-info pr-2 pl-2"><i class="fa fa-pencil"></i></a>
             <a href="'.base_url("products/viewcustinvoice/".$article->customerID).'." class="btn btn-primary pr-2 pl-2"><i class="fa fa-eye"></i></a>
            </div>
          </td>
          </tr>
          </tbody>
          ';

        }
        echo $html;
      } else {
        echo 'no_more';
      }

    }else{
      return redirect(base_url('login'));
    }
  }

  public function filter_by_date(){
    $start_date = $this->input->post('start_date');
    $end_date = $this->input->post('end_date');

    if ($start_date && $end_date) {
        $startDate = date('Y-m-d', strtotime($start_date));
        $endDate = date('Y-m-d', strtotime($end_date));
        $data['inv'] = $this->products_m->get_records_by_date($startDate , $endDate);
        
        $counter =1; foreach($data['inv'] as $invoices){
        
           echo '<tr>'.
              '<td class="w-25">'.'<input type="checkbox">'.'</td>'
              .'<td align="right">'.$invoices->fname.'</td>'.
              '<td>'.$invoices->lname.'</td>'.
              '<td>'.$invoices->fname.'</td>'.
              '<td>'.$invoices->fname.'</td>'. 
              '<td>'.$invoices->fname.'</td>'. 
              '<td>'.$invoices->fname.'</td>'. 
              '<td>'.$invoices->fname.'</td>'. 
              '<td>'.$invoices->fname.'</td>'. 
                '<td>'.
                  '<a href="'.base_url("products/viewcustinvoice/".$invoices->customerID).'" class="btn btn-danger pr-2 pl-2"><i class="fa fa-trash"></i> </a>'.
                  '<a href="'.base_url("products/viewcustinvoice/".$article->customerID).'" class="btn btn-info pr-2 pl-2"><i class="fa fa-pencil"></i> </a>'.
                  '<a href="'.base_url("products/viewcustinvoice/".$invoices->customerID).'" class="btn btn-primary pr-2 pl-2"><i class="fa fa-eye"></i> </a>'.
                '</td>'
           .'</tr>';
          
         }
        
    } else {
        echo "Invalid date range.";
    }

}

  public function updateorder(){
    if($this->session->office == 'MANAGER' || $this->session->office == 'PHARMACIST'){
      if($_POST){
        $update_arr = [
          'prodprice' => $_POST['prodprice'],
          'prodqty' => $_POST['prodqty'],
          'totalprice' => (($_POST['prodprice']) * ($_POST['prodqty']))
        ];

        $this->db->where('orderID',$_POST['orderID']);
        $updateord = $this->db->update('tbl_order', $update_arr);
        if($updateord){
          echo true;
          $update_arr2 = ['prodname'=>$_POST['prodname']];
          $this->db->where('prodID',$_POST['prodID']);
          $this->db->update('tbl_products', $update_arr2);

        }else{
          echo false;
        }
      }else{
        return redirect(base_url('products/invoice'));
      }
    }else{
      return redirect(base_url('login'));
    }
  }


//  public function deleteinvoice($id){
//     $delete = $this->products_m->deleteinvoicedetails($id);
//     if($delete){
//        echo true;
//     }else{
//        echo false;
//     }

//  }


 public function deleteinvoice($id)
{
    // Start transaction
    $this->db->trans_begin();

      try {
         echo true;
          // Delete records from tbl_cart
          $this->db->where('customerID', $id);
          $this->db->delete('tbl_cart');

          // Delete records from tbl_customers
          $this->db->where('customerID', $id);
          $this->db->delete('tbl_customers');

          // Delete records from tbl_payment
          $this->db->where('customerID', $id); 
          $this->db->delete('tbl_payment');

          // Delete records from tbl_order
          $this->db->where('customerID', $id);
          $this->db->delete('tbl_order');

          // Commit transaction if all deletions are successful 
          if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
              return false; // Return false on failure
          } else {
              $this->db->trans_commit();
              return true; // Return true on success
          }
          
      } catch (Exception $e) {
          // Rollback on exception
          $this->db->trans_rollback();
          log_message('error', $e->getMessage());
          // return false;
          echo false;
      }
}


public function editcustinvoice($id){
  $this->data['editcustinvoice'] = $this->products_m->getCustinvoice($id);
  $this->data['custinvoice'] = $this->products_m->getCustinvoice($id);
    //echo "<pre>"; print_r($this->data['editcustinvoice']);die;
  $this->data['country'] = $this->products_m->getallcountries();
  $this->data['title'] = 'Edit Customers Invoice';
  $this->data['page_name'] = "editcustinvoice";
  $this->load->view('admin_index',$this->data);
}

public function updatecustbio(){
    $customerID = $this->input->post('customerID', true);
      $update_arr = [
          'fname' => $this->input->post('fname', true),
          'lname' => $this->input->post('lname', yrue),
          'email' => $this->input->post('email', true),
          'phone' => $this->input->post('phone', true),
          'country' => $this->input->post('countries', true)
      ];

     $where = ['customerID'=> $customerID];
     $update_msg = $this->products_m->updatecustbio($update_arr,$where);
    if($update_msg){
      $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Customer bio updated Successfully']);
      return redirect(base_url('products/editcustinvoice/'.$customerID ));
    }else{
      $this->session->set_flashdata('toastr', ['type' => 'error','message' => ' Cannot update, Error occured']);
      return redirect(base_url('products/editcustinvoice/'.$customerID));
    }
    
}

public function updateprodDetails(){
      $update_arr = [
        'prodname' => $this->input->post('prodname', true),
        'prodprice' => $this->input->post('prodprice', true),
        'prodqty' => $this->input->post('prodqty', true),
        'customerID' => $this->input->post('customerID', true)
      ];

      $where = ['cartID' => $this->input->post('cartID')];
     $updateProdDetails = $this->products_m->updateProductsdetails('tbl_cart', $where, $update_arr);
     if($updateProdDetails){
      $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Productsupdated Successfully']);
      return redirect(base_url('products/editcustinvoice/'.$update_arr['customerID'] ));
     }else{
      $this->session->set_flashdata('toastr', ['type' => 'error','message' => ' Cannot update, Error occured']);
      return redirect(base_url('products/editcustinvoice/'.$update_arr['customerID']));
    }
}

public function deletecustinvoice($id){
    $deletcart = $this->db->delete('tbl_cart', array('cartID'=>$id));
    if($deletcart){
     echo true;
    }else{
     echo false;
    }

}

  public function customercart(){
    if($this->session->office == 'MANAGER' || $this->session->office == 'PHARMACIST'){
      if($_POST){
        $main_arr = array();
        $data = $this->input->post();
        for($i=0; $i< sizeof($data['prodname']); $i++){
          $arr = array(
            'customerID' => $_POST['customerID'],
            'invoiceNumber' => $_POST['invoiceNumber'],
            'prodname' => $data['prodname'][$i],
            'prodprice' => $data['prodprice'][$i],
            'prodqty' => $data['prodqty'][$i]
          );
          $main_arr[] = $arr;;
        }
        $insertbulk = $this->products_m->insertcustomercart($main_arr);
        if($insertbulk){
          $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Customer Invoice Saved Successfully']);
          return redirect(base_url('products/invoice'));
        }else{
          $this->session->set_flashdata('toastr', ['type' => 'error','message' => ' An Error Occured']);
          return redirect(base_url('products/invoice'));
        }

      }else{
        return redirect(base_url('products/invoice'));
      }
    }else{
      return redirect(base_url('login'));
    }

  }


  public function viewcustorder($id){
    $this->data['custorder'] = $this->products_m->getCustOrder($id);
    //echo "<pre>"; print_r($this->data['custorder']);die;
    $this->data['title'] = 'Customer Order ';
    $this->data['page_name'] = "viewcustorder";
    $this->load->view('admin_index',$this->data);

  }

  public function viewcustinvoice($id){
    $this->data['custinvoice'] = $this->products_m->getCustinvoice($id);
     //echo "<pre>"; print_r($this->data['custinvoice']);die;
    $this->data['title'] = 'Customer Invoice ';
    $this->data['page_name'] = "viewcustinvoice";
    $this->load->view('admin_index',$this->data);

  }

  public function updatecustorder($id){
    if($_POST){
      $data_arr = [
        'prodprice'=> $_POST['prodprice'],
        'prodqty' => $_POST['prodqty']
      ];
      $where = ['orderID'=> $_POST['orderID']];
      $update = $this->products_m->updatecustorders($where,$data_arr);
      if($update){
        $update_prodname = ['prodname'=>$_POST['prodname']];
        $where = ['prodID'=> $_POST['prodID']];
        $this->products_m->updateprodname($where,$update_prodname);
        $this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Customer Ordr Updated Successfully']);
        return redirect(base_url('products/viewcustorder/'.$id));
      }else{
        $this->session->set_flashdata('toastr', ['type' => 'error','message' => 'Error! unable to update']);
        return redirect(base_url('products/viewcustorder/'.$id));
      }
    }else{
      return redirect(base_url('products/viewcustorder'));
    }
  }


  public function deletecustorder($id){
    $delete = $this->db->delete('tbl_order', array('orderID' => $id));
    if($delete){
      echo true;
    }else{
      echo false;
    }

  }


  // generate matric numbers from here 
  
  public function generate() {
    if($_POST){
  
      $year = $this->input->post('year');
      $departments = explode(',', $this->input->post('departments')); // Split into an array
      $studentsPerDept = $this->input->post('studentsPerDept');
  
      // Call a function to generate matric numbers
      $this->data['matricNumbers'] = $this->generateMatricNumbers($year, $departments, $studentsPerDept);
      $this->data['title'] = 'Customer Invoice ';
      $this->data['page_name'] = "matriculation";
      $this->load->view('admin_index',$this->data);
    }else{
    
      $this->data['title'] = 'Customer Invoice ';
      $this->data['page_name'] = "matriculation";
      $this->load->view('admin_index',$this->data);
    }



}

private function generateMatricNumbers($year, $departments, $studentsPerDept) {
    $matricNumbers = [];
    $shortYear = substr($year, -2); // Get last two digits of the year
 
    foreach ($departments as $deptCode) {
        for ($i = 1; $i <= $studentsPerDept; $i++) {
            $serial = str_pad($i, 3, '0', STR_PAD_LEFT);
            $matricNumbers[] = [
                'matric_number' => "{$shortYear}/{$deptCode}/{$serial}",
                'department' => $deptCode,
            ];
        }
    }
    return $matricNumbers;
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
