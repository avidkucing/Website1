<?php 
 
class Quality_control_head extends CI_Controller{
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
		$data['lps_sampel'] =$this->kaqc_database->homepage_sampel();
		$data['lps_analisa'] =$this->kaqc_database->homepage_analisa();
		$this->load->view('kaqc/kaqc_homepage', $data);
	}

	public function status_sampling_bahan_show($no) {
		$data['bahan'] = $this->kaqc_database->get_data_bahan_terima($no);
		$data['batch'] = $this->kaqc_database->get_data_batch_bahan_terima($no);
		$data['param'] = $this->kaqc_database->get_data_param_bahan_terima($no);
		$data['sampel'] = $this->kaqc_database->get_data_sampel_analisa_bahan_terima($no);
		$data['hasil'] = $this->kaqc_database->get_data_hasil_analisa_bahan_terima($no);
		$this->load->view('kaqc/kaqc_status_form', $data);	
	}

	public function reject_bahan($no) {
		$result = $this->kaqc_database->update_status_bahan($no, 0);
		if ($result == TRUE) {
			$data['message_display'] = 'Reject Berhasil!';
		} else {
			$data['message_display'] = 'Gagal reject!';
		}
		$data['lps'] = $this->kaqc_database->homepage();
		$data['lps_batch'] =$this->kaqc_database->homepage_batch();
		$data['lps_sampel'] =$this->kaqc_database->homepage_sampel();
		$data['lps_analisa'] =$this->kaqc_database->homepage_analisa();
		$this->load->view('kaqc/kaqc_homepage', $data);
	}
	public function release_bahan($no) {
		$result = $this->kaqc_database->update_status_bahan($no, 1);
		if ($result == TRUE) {
			$data['message_display'] = 'Release Berhasil!';
		} else {
			$data['message_display'] = 'Gagal reject!';
		}
		$data['lps'] = $this->kaqc_database->homepage();
		$data['lps_batch'] =$this->kaqc_database->homepage_batch();
		$data['lps_sampel'] =$this->kaqc_database->homepage_sampel();
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
