	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller {

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

		private $perPage = 5;

	   public function __construct(){

	     parent:: __construct();
	     $this->load->helper(array('form','url','text'));
	     $this->load->library(array('form_validation','session'));
		   $this->load->model('dashboard_m');
	     $this->load->database();

		 if(!$this->session->logged_in){
		     return redirect(base_url('login'));
		 }

	   }

		public function index() {
			$this->data['articles'] = $this->dashboard_m->getArticles(3, 0); // Initial load with 5 articles
			//echo "<pre>"; print_r($this->data['articles']);die;
			$this->data['page_name'] = "dashboard";
			$this->data['country'] = $this->db->get('countries')->result();

			$this->load->view('admin_index',$this->data);;

		}


		public function loadMoreArticles() {
		  if($this->session->role=='Supper Admin' || $this->session->office == 'PHARMACIST'){
			$offset = $this->input->post('offset');
	        $limit = 5; // Number of articles to load on each click

	        $articles = $this->dashboard_m->getArticles($limit, $offset);
	        if (!empty($articles)) {
	            $html = '';
	            foreach ($articles as $article) {
	                $html .= '
	                      <table class="table table-stripe ">

							<tr>
							  <td><input type="checkbox"> </td>
							  <td align="right"> '.$article->fname.'.</td>
							  <td style="position:relative;left:30px;"> '.$article->lname.'.</td>
							  <td style="position:relative;left:60px;"> '.$article->paymentstatus.'.</td>
							  <td style="position:relative;left:90px;"> '.$article->paymentmethod.'.</td>
							  <td style="position:relative;left:90px;"> '.$article->invoiceNumber.'.</td>
							  <td style="position:relative;left:70px;"> '.$article->totalprice.'.</td>
							  <td align="right"> '.$article->countryName.'.</td>
							  <td align="center"> '.date('Y-M-D', strtotime($article->date_created)).'.</td>
							  <td>
						        <a href=".'.("products/viewcustorder/".$article->customerID).'." class="btn btn-info pr-2 pl-2"><i class="fa fa-eye"></i></a>
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
	        // $offset = $this->input->post('offset');
	        // $limit = 5; // Number of articles per load

	        // $data['articles'] = $this->dashboard_m->getArticles($limit, $offset);
	        // $this->load->view('load_more_view', $data);
	    }

	  function updatecustomer(){
	    var_dump($_POST);die;
	   }
	}
