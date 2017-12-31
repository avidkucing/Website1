<?php 
 
class Quality_Control extends CI_Controller{
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
		$this->load->model('qc_database');

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}
 	
 	public function index(){
		$data['lps'] = $this->qc_database->homepage();
		$data['lps_batch'] =$this->qc_database->homepage_batch();
		$data['lps_sampel'] =$this->qc_database->homepage_sampel();
		$data['lps_analisa'] =$this->qc_database->homepage_analisa();
		$this->load->view('qc/qc_homepage', $data);
	}

	public function instruksi_sampling_bahan_show($no){
		$data['bahan'] = $this->qc_database->get_data_bahan_terima($no);
		$data['batch'] = $this->qc_database->get_data_batch_bahan_terima($no);
		$this->load->view('qc/qc_instruksi_form', $data);
	}

	public function analisa_sampling_bahan_show($no){
		$data['bahan'] = $this->qc_database->get_data_bahan_terima($no);
		$data['batch'] = $this->qc_database->get_data_batch_bahan_terima($no);
		$data['param'] = $this->qc_database->get_data_param_bahan_terima($no);
		$this->load->view('qc/qc_analisa_form', $data);		
	}

	public function new_instruksi_bahan(){
		$this->form_validation->set_rules('no_ins', 'No. Instruksi', 'trim|required');
		$this->form_validation->set_rules('tgl', 'Tanggal Instruksi', 'trim|required');
		$this->form_validation->set_rules('tgl2', 'EXP Date', 'trim|required');
		$this->form_validation->set_rules('coa', 'COA', 'trim|required');
		$this->form_validation->set_rules('pola', 'Pola Sampling', 'trim|required');
		$this->form_validation->set_rules('wadah', 'Jumlah Wadah yang Disampling', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Sampel', 'trim|required');
		$this->form_validation->set_rules('petugas', 'Petugas Sampling', 'trim|required');
		$this->form_validation->set_rules('rencana', 'Rencana Pemeriksaan Sampel', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Quality_Control/qc_instruksi_form');
		} else {
			$data = array(
				'Nomor_Batch' => $this->input->post('bat'),
				'Nomor_Instruksi' => $this->input->post('no_ins'),
				'Tanggal_Instruksi' => $this->input->post('tgl'),
				'EXP_Date' => $this->input->post('tgl2'),
				'Doc_COA' => $this->input->post('coa'),
				'Pola_Sampling' => $this->input->post('pola'),
				'Jumlah_Wadah' => $this->input->post('wadah'),
				'Jumlah_Sampel' => $this->input->post('jumlah'),
				'Petugas_Sampling' => $this->input->post('petugas'),
				'Rencana_Sampling' => $this->input->post('rencana'),
				'Catatan' => $this->input->post('catatan'),
			);
			$result = $this->qc_database->instruksi_insert($data);
			if ($result == TRUE) {
				$data['message_display'] = 'Instruksi berhasil disimpan !'; // belum bisa tampil
				$data['lps'] = $this->qc_database->homepage();
				$data['lps_batch'] =$this->qc_database->homepage_batch();
				$data['lps_sampel'] =$this->qc_database->homepage_sampel();
				$data['lps_analisa'] =$this->qc_database->homepage_analisa();
				$this->load->view('qc/qc_homepage', $data);
			} else {
				$data['message_display'] = 'Nomor instruksi sudah pernah diinput!';
				$data['bahan'] = $this->qc_database->get_data_bahan_terima($data['Nomor_Batch']);
				$data['batch'] = $this->qc_database->get_data_batch_bahan_terima($data['Nomor_Batch']);
				$this->load->view('qc/qc_instruksi_form', $data);
			}
		}
	}

	public function new_hasil_analisa_bahan() {
		$this->form_validation->set_rules('no_ana', 'Nomor Analisa', 'trim|required');
		$this->form_validation->set_rules('tgl1', 'Tanggal Pemeriksaan', 'trim|required');
		$this->form_validation->set_rules('sisa', 'Sisa Pertinggal', 'trim|required');
		$j = $this->input->post('hasil_row');
			for ($i=1; $i <= $j; $i++) { 
				$this->form_validation->set_rules('hasil'.$i, 'Hasil Pemeriksaan', 'trim|required');
			}


		if ($this->form_validation->run() == FALSE) {
			$data['message_display'] = 'Input kosong!';
			$data['lps'] = $this->qc_database->homepage();
			$data['lps_batch'] =$this->qc_database->homepage_batch();
			$data['lps_sampel'] =$this->qc_database->homepage_sampel();
			$data['lps_analisa'] =$this->qc_database->homepage_analisa();
			$this->load->view('qc/qc_homepage', $data);
		} else {
			$data = array(
				'Nomor_Batch' => $this->input->post('batch'),
				'Nomor_Analisa' => $this->input->post('no_ana'),
				'Tanggal_Pemeriksaan' => $this->input->post('tgl1'),
				'Sisa_Sampel' => $this->input->post('sisa'),
			);
			$result = $this->qc_database->analisa_insert($data);

			if ($result == TRUE) {
				$j = $this->input->post('hasil_row');

				for ($i=1; $i <= $j; $i++) { 
					$data = array(
						'Nomor_Analisa' => $this->input->post('no_ana'),
						'No' => $i,
						'Hasil' => $this->input->post('hasil'.$i),
					);
					$result = $this->qc_database->hasil_insert($data);
				}
				$data['message_display'] = 'Input hasil pemeriksaan sukses!';
				$data['lps'] = $this->qc_database->homepage();
				$data['lps_batch'] =$this->qc_database->homepage_batch();
				$data['lps_sampel'] =$this->qc_database->homepage_sampel();
				$data['lps_analisa'] =$this->qc_database->homepage_analisa();
				$this->load->view('qc/qc_homepage', $data);	
			} else {
				$data['message_display'] = 'Nomor Analisa sudah pernah diinput!';
				$data['bahan'] = $this->qc_database->get_data_bahan_terima($no);
				$data['batch'] = $this->qc_database->get_data_batch_bahan_terima($no);
				$data['param'] = $this->qc_database->get_data_param_bahan_terima($no);
				$this->load->view('qc/qc_analisa_form', $data);		
			}
		}
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