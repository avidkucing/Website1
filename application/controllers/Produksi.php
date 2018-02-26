<?php 
 
class Produksi extends CI_Controller{
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
		$this->load->model('produksi_database');

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}
 
	public function index(){
		$data['ins'] = $this->produksi_database->homepage_instruksi($this->session->userdata['logged_in']['nama']);
 		$this->load->view('produksi/produksi_homepage', $data);
	}

	public function form_bahan_show(){
		$this->load->view('produksi/form_bahan');
	}

	public function print_permintaan_bahan_show($a, $b, $c, $d, $e){
		$value = $a . "/" . $b . "/" . $c . "/" . $d . "/" . $e;
		$data['ins'] = $this->produksi_database->print_instruksi_permintaan($value);
		$data['ins_bahan'] = $this->produksi_database->print_permintaan_bahan($value);
		$data['jenis_bahan'] = $this->produksi_database->print_jenis_bahan($value);
		$this->load->view('produksi/print_instruksi', $data);
	}


	public function get_data_nomor_analisa(){
		$value = $this->input->post("value");
	      $data = $this->produksi_database->get_data_nomor_analisa($value);
	      $option ="";
		  $dump_kode = array ('' => '--Pilih Nomor Analisa Bahan--');
		  $data = $dump_kode + $data;
		  //print_r(($data));
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d."' >".$d."</option>";
	      }
	      echo $option;
	}

	public function get_data_satuan(){
		$value = $this->input->post("value");
	      $data = $this->produksi_database->get_data_satuan($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Satuan."' >".$d->Satuan."</option>";
	      }
	      echo $option;	
	}

	public function get_data_exp_date(){
		$value = $this->input->post("value");
	      $data = $this->produksi_database->get_data_exp_date($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->EXP_Date."' >".$d->EXP_Date."</option>";
	      }
	      echo $option;	
	}

	public function get_data_exp_kosong() {
		  foreach($data as $d)
	      {
	         $option .= "<option></option>";
	      }
	      echo $option;		
	}

	public function get_data_jumlah() {
		$value = $this->input->post("value");
	      $data = $this->produksi_database->get_data_jumlah($value);
	      $jumlah ="";

	      foreach($data as $d)
	      {
	         $jumlah = $d->Jumlah;
	      }
	      print_r($jumlah);
	      return $jumlah;
	}


	public function new_permintaan_bahan(){
		$this->form_validation->set_rules('site', 'Site Produksi', 'trim|required');
		$this->form_validation->set_rules('no_ins', 'Nomor Instruksi', 'trim|required');
		$this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('kode[]', 'Kode Bahan', 'trim|required');
		$this->form_validation->set_rules('jumlah[]', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('keterangan[]', 'Keterangan', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$data['message_display'] = 'Input kosong!';
			$this->load->view('produksi/form_bahan', $data);
		} else {
			$data = array(
				'Nomor_Instruksi' => $this->input->post('no_ins'),
				'Site_Produksi' => $this->input->post('site'),
				'Tanggal_Permintaan' => $this->input->post('tgl'),
				'Status'=> 'WAITING',
			);
			$result = $this->produksi_database->bahan_minta_insert($data);
			if ($result == TRUE) {
				$array_kode = $this->input->post('kode[]');
				$array_jumlah = $this->input->post('jumlah[]');
				$array_ket = $this->input->post('keterangan[]');

				$result =array();
				$b = 0;
				$results = 1;
				foreach ($array_kode as $a => $b) {
					$data = array(
						'Nomor_Instruksi' => $this->input->post('no_ins'),
						'Kode_Bahan' => $array_kode[$a],
						'Jumlah' => $array_jumlah[$a],
						'keterangan' => $array_ket[$a],
						'Nomor_Analisa' => '',
					);

					//insert
					$result[$a] = $this->produksi_database->insert_array_bahan_baku($data);
					if ($result[$a] == FALSE) {
						$results = 0;
						break;
					} else {
						/*
						$cek_stok = $this->produksi_database->cek_stok( $array_no_ana[$a]);
						$jumlah ="";

				      	foreach($cek_stok as $c) {
				        	$jumlah = $c->Jumlah;
				      	}

				      	$jumlah = $jumlah - $array_jumlah[$a];
				      	$key = $array_no_ana[$a];
				      	$result[$a] = $this->produksi_database->update_stok($jumlah, $key);
						if ($result[$a] == FALSE) {
							$results = 0;
							break;
						}*/
					} 
				}
				if ($results == 0) {
							$data['message_display'] = 'Gagal menambahkan data bahan baku';
							$this->load->view('produksi/form_bahan', $data);	
						} else {
							$data['message_display'] = 'Sukses menambahkan data permintaan!';
							$data['ins'] = $this->produksi_database->homepage_instruksi($this->session->userdata['logged_in']['nama']);
 							$this->load->view('produksi/produksi_homepage', $data);	
						}
			} else {
				$data['message_display'] = 'Nomor Instruksi sudah ada! Gunakan nomor yang lain!';
				$this->load->view('produksi/form_bahan', $data);
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