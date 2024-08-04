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

	public function index(){
      $this->load->view('admin_login/login');
	}

	public function processlogin(){
			$username   = $this->input->post('username', true);
			$password   = $this->myhash($this->input->post('password', true));

			 $AdminExist = $this->login_m->checkuserlogin($username,$password);;
			 $StaffCheck = $this->db->get_where('tbl_users',array('username'=>$username,'password'=>$password ))->row();
			if($AdminExist){
				//echo json_encode(['status' => true]);
				$admin_arr = [
					'adminID'   => $AdminExist->adminID,
					'username'  => $AdminExist->username,
					'role'		=> $AdminExist->role,
					'title'		=> $AdminExist->title,
					'firstname'		=> $AdminExist->firstname,
					'role' => 'Supper Admin',
					'logged_in' => TRUE
				];
				$this->session->set_userdata($admin_arr);
				$this->session->set_flashdata('toastr', ['type' => 'success','message' => 'Welcome '.$username ]);
				return redirect(base_url('dashboard'));
			}elseif($StaffCheck){
							  //echo json_encode(['status' => '400']);
							 $staff_arr = [
								'userID'   => $StaffCheck->userID,
								'username'  => $StaffCheck->username,
								'firstname'		=> $StaffCheck->fname,
								'lastname' => $StaffCheck->lname,
								 'phone' => $StaffCheck->phone,
								'role' => 'Staff',
								'office' => $this->db->get_where('tbl_privilleges',array('userID'=>$StaffCheck->userID))->row()->office,
								'logged_in' => TRUE
							];
						
							$this->session->set_userdata($staff_arr);
							$this->session->set_flashdata('toastr', ['type' => 'success','message' => 'Welcome '.$username ]);
							return redirect(base_url('dashboard'));
						}
			else{
			    //echo json_encode(['status' => false]);
				$this->session->set_flashdata('toastr', ['type' => 'error','message' => ' Wrong Usernamexx or Password ' ]);
				return redirect(base_url('login'));
			}

	}

	public function signout(){
		$this->session->unset_userdata('adminID');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect(base_url('login'));
	 }

   public function myhash($string){
	  return  hash("sha512", $string . config_item("encryption_key"));


	}



}
