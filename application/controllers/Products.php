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
   
        if(!isset($this->session->logged_in)){
          return redirect(base_url('login'));
        }
   
      }


    public function addproduct(){
        $this->data['title'] =  " create products items  ";
        $this->data['page_name'] = "addproduct";
        $this->load->view("admin_index",$this->data);
    
    }

   public function add_multiple_prod(){;
    $this->data['title'] =  " Add Multiple Products   ";
    $this->data['page_name'] = "addmultipleprod";
    $this->load->view("admin_index",$this->data);

  }

}