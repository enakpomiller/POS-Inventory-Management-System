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
     $this->load->library('form_validation');
	 $this->load->library('session');
     $this->load->model('users_m');
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

	public function assign_role(){
		if($this->session->role == "Supper Admin" || $this->session->role == 'Staff'){
			$this->data['title'] = " Assign Roles to Users";
			$this->data['getroles'] = $this->users_m->getallroles();
			$this->data['staffrole'] = $this->users_m->getallstaffrole();
			$this->data['page_name'] = "assign_role";
			$this->load->view('admin_index',$this->data);
		}else{
			$this->session->set_flashdata('toastr', ['type' => 'error','message' => ' Access Denied ' ]);
			return redirect(base_url('login'));
		}

	}


	public function create_manager(){
		$this->data['title'] = " Create User Account ";
		$this->data['page_name'] = "create_manager";
		$this->load->view('admin_index',$this->data);;

    }

   public function process_manager(){

      	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      		  $rules = $this->manager_rules();
      			$this->form_validation->set_rules($rules);
      			if($this->form_validation->run() == TRUE){
      			  $usercheck = $_POST['username'];
      			  $UserExist = $this->users_m->CheckUserExist($usercheck);
      		       if($_POST['password'] != $_POST['confpass']){
      			     echo '401';
      			   }elseif($UserExist){
				     echo '400';
				   }else{
      				 echo true;
      					$data_input = [
      						'fname'  =>  $this->input->post('fname'),
      						'lname'  =>  $this->input->post('lname'),
      						'phone'  =>  $this->input->post('phone'),
      						'username'=> $this->input->post('username'),
      						'password'=> $this->myhash($this->input->post('password')),
      						'date_created' => date('y-m-d H:i:sa'),
							'plainpassword' => $this->input->post('password')
      					];
      					$getlastID = $this->users_m->createusers($data_input);

      					$_SESSION['userID'] = $getlastID;

      			     }
    			}else{
    				$this->data['title'] = " Create Managers Account ";
    				$this->data['page_name'] = "create_manager";
    				$this->load->view('admin_index',$this->data);;
    			}
    			}else{
    			 return redirect(base_url('users/create_manager'));
    		}

    }

	public function manageusers(){
        $this->data['title'] = " All Users";
		$this->data['allusers'] = $this->users_m->getallusers();
		$this->data['roles'] = $this->users_m->getallstaffrole();
		$this->data['page_name'] = "viewusers";
		$this->load->view('admin_index',$this->data);
	
	}

  public function updateusers(){
      if(isset($_POST)){

		$supper_array = array(
			'user_update' => array(
				'userID' => $_POST['userID'],
				'fname' => $_POST['fname'],
				'lname' => $_POST['lname'],
				'phone' => $_POST['phone'],
				'username' => $_POST['username'],
			),
			'office_arr' => array(
				'office' => $_POST['office']
			)
		);
		
	
		    if(!empty($_POST['office'] == "MANAGER" )){
			
				$x['result'] = $this->db->get('tbl_roletemplate')->result();
				$input_arr = [];
				foreach($x['result'] as $rows){
					$input_arr[] = $rows->roleID;
					}
				
					$user_roles_json = json_encode($input_arr);
					$update_arr =[
						'user_roles' => $user_roles_json
					];
					
					$this->db->where('userID',$_POST['userID']);
					$this->db->update('tbl_privilleges',$update_arr);

			}elseif(!empty($_POST['office'] == "INVENTORY MANAGER" )){
				    $x['result'] = $this->db->get_where('tbl_roletemplate',array('roleID'=>'2'))->row();
				    $dim = $x['result']->roleID;
					$input_arr = [];
					$input_arr[] = $dim;
				    $user_roles_json = json_encode($input_arr);
					$update_arr =[
						'user_roles' => $user_roles_json
					   ];
		          
				   $this->db->where('userID',$_POST['userID']);
				   $this->db->update('tbl_privilleges',$update_arr);

			} elseif(!empty($_POST['office'] == "ACCOUNTANT" )){
				   $dim = $this->db->get_where('tbl_roletemplate',array('roleID'=>'3'))->row()->roleID;

				   $input_arr = [];
				   $input_arr[] = $dim;
				   $user_roles_json = json_encode($input_arr);
				   $update_arr =[
					'user_roles' => $user_roles_json
				   ];
					
				$this->db->where('userID',$_POST['userID']);
				$this->db->update('tbl_privilleges',$update_arr);
			}
			
			
		
		  $updateuser = $this->users_m->updateuserrecord($supper_array);
		  if($updateuser){
			$this->session->set_flashdata('toastr', ['type' => 'success','message' => ' User Record Updated Successfully']);
			return redirect(base_url('users/manageusers'));
		  }else{
			$this->session->set_flashdata('toastr', ['type' => 'error','message' => ' An Error Occured']);
			return redirect(base_url('users/manageusers'));
		  }

	  }else{
	   return redirect(base_url('users/manageusers'));
	  }
  }
   
  public function deleteproduct($id){
	 $delete = $this->db->delete('tbl_users', array('userID' => $id));
	 if($delete){
	    echo true;
	  }else{
	    echo false;
	   }

   }
	public function processstaffrole(){
		if($this->input->post('type')==1){

				$data_arr = [
					'userID'  => $_POST['userid'],
					'office'  => $_POST['office'],
					'user_roles' => json_encode($_POST['roles'])
				];
			$privillege_id =  $this->users_m->createprivilleges($data_arr);
			if($privillege_id){
				echo true;
			 }else{
				echo false;
			}

		}else{

			$this->data['title'] = " Assign Roles to Users";
			$this->data['getroles'] = $this->users_m->getallroles();
			$this->data['staffrole'] = $this->users_m->getallstaffrole();
			$this->data['page_name'] = "assign_role";
			$this->load->view('admin_index',$this->data);
		}

	}



	public function manager_rules() {
		$rules = array(
			array(
				'label' => 'First Name',
				'field' => 'fname',
				'rules' => 'trim|required'
			),
			array(
				'label' => 'Last Name',
				'field' => 'lname',
				'rules' => 'trim|required'
			),
			array(
				'label' => 'Phone Number',
				'field' => 'phone',
				'rules' => 'trim|required'
			),
			array(
				'label' => 'Username',
				'field' => 'username',
				'rules' => 'trim|required'
			),
			array(
				'label' => 'Password',
				'field' => 'password',
				'rules' => 'trim|required'
			),
			array(
				'label' => 'Confirm Password',
				'field' => 'confpass',
				'rules' => 'trim|required'
			)
		);
		return $rules;
	}


	// public function manager_rules() {
	// 	$rules = array(
	// 		array(
	// 			'label' => 'First Name',
	// 			'field' => 'fname',
	// 			'rules' => 'trim|required|min_length[3]|max_length[50]'
	// 		),
	// 		array(
	// 			'label' => 'Last Name',
	// 			'field' => 'lname',
	// 			'rules' => 'trim|required|min_length[3]|max_length[50]'
	// 		),
	// 		array(
	// 			'label' => 'Phone Number',
	// 			'field' => 'phone',
	// 			'rules' => 'trim|required|min_length[10]|max_length[15]'
	// 		),
	// 		array(
	// 			'label' => 'Username',
	// 			'field' => 'username',
	// 			'rules' => 'trim|required|min_length[3]|max_length[20]'
	// 		),
	// 		array(
	// 			'label' => 'Password',
	// 			'field' => 'password',
	// 			'rules' => 'trim|required|min_length[6]'
	// 		),
	// 		array(
	// 			'label' => 'Confirm Password',
	// 			'field' => 'confpass',
	// 			'rules' => 'trim|required|matches[password]|min_length[6]'
	// 		)
	// 	);
	// 	return $rules;
	// }


 public function resetpassword($id){
 
		$userID = $id;
		$password = $this->generatePassword();
			$passsword_arr = [
				'password' => $this->myhash($password),
				'plainpassword' => $password
			];
			 
		$where = ['userID'=>$userID];
		$passwordReset = $this->users_m->resetpassword($passsword_arr,$where);
		if($passwordReset){
			$this->session->set_flashdata('toastr', ['type' => 'success','message' => ' Password Reset Was Successfully']);
			return redirect(base_url('users/manageusers'));
		}else{
			$this->session->set_flashdata('toastr', ['type' => 'error','message' => ' Unble to reset Pasword']);
			return redirect(base_url('users/manageusers'));
		}
	
 }



 function generatePassword(){
	$rand = rand(100, 999);
	$alpha = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	$consonant = array("B", "C", "D", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z");
	$vowel = array("a", "e", "i", "o", "u");
	$rand2 = rand(0, 9);

	return $alpha[mt_rand(0, count($alpha)-1)] . $vowel[mt_rand(0, count($vowel)-1)] . strtolower($consonant[mt_rand(0, count($consonant)-1)]) . $vowel[mt_rand(0, count($vowel)-1)] . $rand;
}


 public function myhash($string){
    return hash("sha512", $string . config_item("encryption_key"));
 }

}
