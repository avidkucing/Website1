<?php 
 
class Ka_Quality_Control extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		//Load helper url
		$this->load->helper('url');

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		//Load table library
		$this->load->library('table');

		// Load database
		$this->load->model('kaqc_database');

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}


 	public function index(){
		$data['lps'] = $this->kaqc_database->homepage();
		$data['lps_batch'] =$this->kaqc_database->homepage_batch();
		$data['lps_instruksi'] =$this->kaqc_database->homepage_instruksi();
		$data['lps_analisa'] =$this->kaqc_database->homepage_analisa();
		$this->load->view('kaqc/kaqc_homepage', $data);
	}


	public function logout() {

		// Removing session data
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login_form', $data);
	}


}
?>
