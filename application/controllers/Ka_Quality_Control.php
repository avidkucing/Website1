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
		$data['lps_sampel'] =$this->kaqc_database->homepage_sampel();
		$data['lps_analisa'] =$this->kaqc_database->homepage_analisa();
		$this->load->view('kaqc/kaqc_homepage', $data);
	}

	public function instruksi_sampling_bahan_show($no){
		//$no = $a . '/' . $b . '/' . $c . '/' . $d;
		$data['bahan'] = $this->kaqc_database->get_data_bahan_terima($no);
		$data['batch'] = $this->kaqc_database->get_data_batch_bahan_terima($no);
		$this->load->view('kaqc/kaqc_instruksi_form2', $data);
	}

	public function new_instruksi_bahan(){
		$this->form_validation->set_rules('no_ins', 'No. Instruksi', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Sampel', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('kaqc/kaqc_instruksi_form2');
		} else {
			$data = array(
				'ID_Batch' => $this->input->post('bat'),
				'Nomor_Instruksi' => $this->input->post('no_ins'),
				'Jumlah_Sampel' => $this->input->post('jumlah'),
			);
			$result = $this->kaqc_database->instruksi_insert($data);
			if ($result == TRUE) {
				$data['message_display'] = 'Instruksi berhasil disimpan !'; // belum bisa tampil
				
				$data['lps'] = $this->kaqc_database->homepage();
				$data['lps_batch'] =$this->kaqc_database->homepage_batch();
				$data['lps_sampel'] =$this->kaqc_database->homepage_sampel();
				$data['lps_analisa'] =$this->kaqc_database->homepage_analisa();
				$this->load->view('kaqc/kaqc_homepage', $data);
			} else {
				$data['message_display'] = 'Nomor instruksi sudah pernah diinput!';
				$data['bahan'] = $this->kaqc_database->get_data_bahan_terima($data['ID_Batch']);
				$data['batch'] = $this->kaqc_database->get_data_batch_bahan_terima($data['ID_Batch']);
				$this->load->view('kaqc/kaqc_instruksi_form2', $data);
			}
		}
	}

	public function status_sampling_bahan_show($no) {
		$data['bahan'] = $this->kaqc_database->get_data_bahan_terima($no);
		$data['batch'] = $this->kaqc_database->get_data_batch_bahan_terima($no);
		$data['param'] = $this->kaqc_database->get_data_param_bahan_terima($no);
		$data['sampel'] = $this->kaqc_database->get_data_sampel_analisa_bahan_terima($no);
		$data['hasil'] = $this->kaqc_database->get_data_hasil_analisa_bahan_terima($no);
		$this->load->view('kaqc/kaqc_status_form', $data);	
	}

	public function fix_status() {
		$data = array ('Status' => $this->input->post('status'), 'Alasan_Status' => $this->input->post('alasan'), 'ID_Batch' => $this->input->post('bat'));
		$result = $this->kaqc_database->update_status_bahan($data);
		if ($result == TRUE) {
			$data['message_display'] = 'Update Status Berhasil!';
		} else {
			$data['message_display'] = 'Gagal update status!';
		}
		$data['lps'] = $this->kaqc_database->homepage();
		$data['lps_batch'] =$this->kaqc_database->homepage_batch();
		$data['lps_sampel'] =$this->kaqc_database->homepage_sampel();
		$data['lps_analisa'] =$this->kaqc_database->homepage_analisa();
		$this->load->view('kaqc/kaqc_homepage', $data);
	}
	/*
	public function release_bahan($no) {
		$alasan = $this->input->post('alasan');
		$result0 = $this->kaqc_database->update_alasan_status($alasan);
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
	*/

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
