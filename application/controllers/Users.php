<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

   public function __construct(){

     parent:: __construct();
     $this->load->helper(array('form','url','text'));
     $this->load->library(array('form_validation','session'));
      //$this->load->model('users_m');
	 $this->load->database();

     if(!isset($this->session->logged_in)){
       return redirect(base_url('login'));
     }

   }

	public function index()
	{
      $this->data['page_name'] = "create_manager";
      $this->load->view('admin_index',$this->data);;
	}

    public function create_manager(){
      $this->data['title'] = " Create Managers Role";
      $this->data['page_name'] = "create_manager";
      $this->load->view('admin_index',$this->data);;
    }


}