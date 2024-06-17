<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		parent::__construct();
     $this->load->helper(array('form','url','text'));
     $this->load->library(array('form_validation','session'));
	//  $this->load->model(array('login'));
	 $this->load->database();
	 $this->load->model('login_m');
	 
   }

	public function index()
	{
      $this->load->view('admin_login/login');
	}

	public function processlogin(){
			$username   = $this->input->post('username');
			$password   = $this->myhash($this->input->post('password'));
			$AdminExist = $this->login_m->checkuserlogin($username,$password);
			$StaffCheck = $this->db->get_where('tbl_users',array('username'=>$username,'password'=>$this->myhash($password) ))->row();
			if($AdminExist){
				echo  true; 
				$admin_arr = [
					'adminID'   => $AdminExist->adminID,
					'username'  => $AdminExist->username,
					'role'		=> $AdminExist->role,
					'title'		=> $AdminExist->title,
					'firstname'		=> $AdminExist->firstname,
					'logged_in' => TRUE
				];
				$this->session->set_userdata($admin_arr);
				$this->session->set_flashdata('toastr', ['type' => 'success','message' => 'Welcome '.$username ]);
			}else if($StaffCheck){
				echo '400';
			}else{
			 echo false;
			}

	}
    
	public function signout(){
		$this->session->unset_userdata('adminID');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		 redirect(base_url('login'));
	 }
	
   public function myhash($string){
	  return   hash("sha512", $string . config_item("encryption_key"));
	  
	 
	}



}
