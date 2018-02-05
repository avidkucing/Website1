<?php 
 
class Ka_Gudang extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		//Load helper url
		$this->load->helper('url');

		// Load form helper library
		$this->load->helper('form');

		// Load table library
		$this->load->library('table');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('kagudang_database');

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}
 
	public function index(){
		$data['lpb'] = $this->kagudang_database->homepage();
		$data['lpb_kemas'] = $this->kagudang_database->homepage_kemas();
 		$data['lpb_batch'] = $this->kagudang_database->homepage_batch();
 		$data['lpb_bantu'] = $this->kagudang_database->homepage_bantu();
 		$data['stock_baku'] = $this->kagudang_database->homepage_stock_baku();
 		$data['stock_kemas'] = $this->kagudang_database->homepage_stock_kemas();
 		$data['ins'] = $this->kagudang_database->homepage_instruksi();
 		$this->load->view('ka_gudang/ka_gudang_homepage', $data);
	}

	public function print_lpb_show($a, $b, $c, $d){
		//$value = $this->input->post("value");
		$data['lpb'] = $this->kagudang_database->print_lpb($a, $b, $c, $d);
 		$data['lpb_batch'] =$this->kagudang_database->print_batch_lpb($a, $b, $c, $d);
		$this->load->view('ka_gudang/print_lpb', $data);		
	}

	public function print_permintaan_bahan_show($value){
		$data['ins'] = $this->kagudang_database->print_instruksi_permintaan(rawurldecode($value));
		$data['ins_bahan'] = $this->kagudang_database->print_permintaan_bahan(rawurldecode($value));
		$this->load->view('ka_gudang/print_instruksi', $data);
	}

	public function konfirmasi_lpb($a, $b, $c, $d){
		$lpb = $a . "/" . $b . "/"  . $c . "/"  . $d;
		$result = $this->kagudang_database->konfirmasi_lpb($lpb);
		
		if ($result) { //sukses update
			$data['message_display'] = 'Sukses mengupdate data!';
			$data['lpb'] = $this->kagudang_database->homepage();
			$data['lpb_kemas'] = $this->kagudang_database->homepage_kemas();
	 		$data['lpb_batch'] = $this->kagudang_database->homepage_batch();
	 		$data['lpb_bantu'] = $this->kagudang_database->homepage_bantu();
	 		$data['stock_baku'] = $this->kagudang_database->homepage_stock_baku();
	 		$data['stock_kemas'] = $this->kagudang_database->homepage_stock_kemas();
	 		$data['ins'] = $this->kagudang_database->homepage_instruksi();
	 		$this->load->view('ka_gudang/ka_gudang_homepage', $data);
		} else { //gagal update
			$data['message_display'] = 'Gagal mengupdate data!';
			$data['lpb'] = $this->kagudang_database->print_lpb($a, $b, $c, $d);
	 		$data['lpb_batch'] =$this->kagudang_database->print_batch_lpb($a, $b, $c, $d);
			$this->load->view('ka_gudang/print_lpb', $data);
		}
	}

	public function logout() {

		// Removing session data
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['logout_message'] = 'Successfully Logout';
		$this->load->view('login_form', $data);
	}
}
?>