<?php 
 
class Gudang extends CI_Controller{
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
		$this->load->model('gudang_database');

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}
 
	public function index(){
		$data['lpb'] = $this->gudang_database->homepage();
		$data['lpb_kemas'] = $this->gudang_database->homepage_kemas();
 		$data['lpb_bantu'] = $this->gudang_database->homepage_bantu();
 		$data['lpb_batch'] = $this->gudang_database->homepage_batch();
 		$data['stock_baku'] = $this->gudang_database->homepage_stock_baku();
 		$data['stock_kemas'] = $this->gudang_database->homepage_stock_kemas();
 		$data['ins'] = $this->gudang_database->homepage_instruksi();
 		$this->load->view('gudang/gudang_homepage', $data);
	}

	public function print_lpb_show($a, $b, $c, $d){
		//$value = $this->input->post("value");
		$data['lpb'] = $this->gudang_database->print_lpb($a, $b, $c, $d);
 		$data['lpb_batch'] =$this->gudang_database->print_batch_lpb($a, $b, $c, $d);
		$this->load->view('gudang/print_lpb', $data);		
	}
	
	public function print_permintaan_bahan_show($value){
		$data['ins'] = $this->gudang_database->print_instruksi_permintaan(rawurldecode($value));
		$data['ins_bahan'] = $this->gudang_database->print_permintaan_bahan(rawurldecode($value));
		$this->load->view('gudang/print_instruksi', $data);
	}

	public function tambah_lpb_show(){
		$this->load->view('gudang/tambah_lpb');
	}

	public function get_data_kode_bahan(){
		$value = $this->input->post("value");
	      $data = $this->gudang_database->get_data_kode_bahan($value);
	      $option ="<option value=''>--Pilih Kode Bahan--</option>";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Kode_Bahan."' >".$d->Kode_Bahan."</option>";
	      }
	      echo $option;
	}

	public function get_data_nama_bahan(){
	      $value = $this->input->post("value");
	      $data = $this->gudang_database->get_data_nama_bahan($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Bahan."' >".$d->Nama_Bahan."</option>";
	      }
	      echo $option;
	}

	public function get_data_manufaktur(){
		  $value = $this->input->post("value");
	      $data = $this->gudang_database->get_data_manufaktur($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Manufacturer."' >".$d->Nama_Manufacturer."</option>";
	      }
	      echo $option;	
	}

	public function get_data_supplier(){
		  $value = $this->input->post("value");
	      $data = $this->gudang_database->get_data_supplier($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Supplier."' >".$d->Nama_Supplier."</option>";
	      }
	      echo $option;		
	}

	public function get_data_satuan(){
		  $value = $this->input->post("value");
	      $data = $this->gudang_database->get_data_satuan($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Satuan."' >".$d->Satuan."</option>";
	      }
	      echo $option;		
	}
	/*
	public function get_data_manufaktur_from_supplier(){
		  $kodebahan = $this->input->post("kode");
		  $supplier = $this->input->post("supp");
	      $data = $this->gudang_database->get_data_nama_manufaktur_from_supplier($kodebahan, $supplier);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Manufacturer."' >".$d->Nama_Manufacturer."</option>";
	      }
	      echo $option;
	}
	public function get_data_supplier_from_manufaktur(){
		  $kodebahan = $this->input->post("kode");
		  $manufaktur = $this->input->post("manu");
	      $data = $this->gudang_database->get_data_nama_supplier_from_manufaktur($kodebahan, $manufaktur);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Supplier."' >".$d->Nama_Supplier."</option>";
	      }
	      echo $option;
	}
	*/
	public function get_tahun_lpb() {
		$date = $this->input->post("value");
		$year = substr($date, 0, 4);
		return $year;
	}

	public function new_lpb() {
		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('lpb', 'Nomor LPB', 'trim|required');
		$this->form_validation->set_rules('tgl', 'Tanggal Terima', 'trim|required');
		$this->form_validation->set_rules('surat', 'No. Surat Pesanan', 'trim|required');
		$this->form_validation->set_rules('kode', 'Kode Bahan', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Batch', 'trim|required');
		$this->form_validation->set_rules('manu', 'Nama Manufaktur', 'trim|required');
		$this->form_validation->set_rules('supp', 'Nama Supplier', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis Permintaan', 'trim|required');
		$this->form_validation->set_rules('batch[]', 'Batch', 'trim|required');
		$this->form_validation->set_rules('jumlah[]', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('exp[]', 'EXP. Date', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$data['message_display'] = 'Input kosong!';
			$this->load->view('gudang/tambah_lpb', $data);
		} else {
			/*
			$batch = $this->input->post('batch[]');
			foreach ($batch as $a) {
				//cek batch dobel
				$result_cek = $this->gudang_database->cek_batch_bahan($a);
				if ($result_cek == FALSE) {
					break;
				}
			}
			///////sudah dicek
			if ($result_cek == FALSE) {
				$data['message_display'] = 'Nomor batch sudah ada!';
				$this->load->view('gudang/tambah_lpb', $data);
			} else {*/
			//cari id_bahan di database
			$cari = array(
				'Kode_Bahan' => $this->input->post('kode'),
				'Nama_Bahan' => $this->input->post('nama'),
				//'Nama_Manufacturer' => $this->input->post('manu'),
				//'Nama_Supplier' => $this->input->post('supp'),
			);
			$arr_id_bahan = $this->gudang_database->get_id_bahan($cari);
			if ($arr_id_bahan == FALSE) {
				$data['message_display'] = 'Data kode bahan terduplikat! Tunggu admin memperbaiki!';
				$this->load->view('gudang/tambah_lpb', $data);
			} else {
				//mulai input data
				//$coba = 2;
				foreach($arr_id_bahan as $d)
			      {
			         $id_bahan = $d->ID_Bahan;
			      }
				
				//simpan ke variabel
				$data = array(
					'Nomor_LPB' => $this->input->post('lpb'),
					'ID_Bahan' => $id_bahan,
					'Nama_Manufacturer' => $this->input->post('manu'),
					'Nama_Supplier' => $this->input->post('supp'),
					'Tanggal_Terima' => $this->input->post('tgl'),
					'Nomor_Surat' => $this->input->post('surat'),
					'Status' => 'QUARANTINE',
					'Jenis_Permintaan' => $this->input->post('jenis'),
					//'Jumlah' => $this->input->post('jumlah'),
					);
				//input ke database
				$result = $this->gudang_database->bahan_terima_insert($data);
				if ($result == TRUE) {
					//$data['message_display'] = 'Nomor LPB berhasil ditambahkan !';
					
					$array_batch = $this->input->post('batch[]');
					$array_jumlah = $this->input->post('jumlah[]');
					$array_exp_date = $this->input->post('exp[]');
					$array_ket = $this->input->post('keterangan[]');
					$result =array();
					$b = 0;
					$results = 1;
					foreach ($array_batch as $a => $b) {
						$data = array(
							'Nomor_LPB' => $this->input->post('lpb'),
							'Nomor_Batch' => $array_batch[$a],
							'Jumlah' => $array_jumlah[$a],
							'EXP_Date' => $array_exp_date[$a],
							'keterangan' => $array_ket[$a],
							'Status' => 'QUARANTINE',
						);

						$result[$a] = $this->gudang_database->insert_batch_bahan_baku($data);
						if ($result[$a] == FALSE) {
							$data['message_display'] = 'Gagal menambahkan data batch!';
							$results = 0;
							break;
						}
					}
					if ($results == 0) {
						$data['message_display'] = 'gagal tambah data batch';
						$this->load->view('gudang/tambah_lpb', $data);	
					} else {
						$data['message_display'] = 'Sukses menambahkan data!';
						$data['lpb'] = $this->gudang_database->homepage();
						$data['lpb_kemas'] = $this->gudang_database->homepage_kemas();
 						$data['lpb_bantu'] = $this->gudang_database->homepage_bantu();
							$data['lpb_batch'] =$this->gudang_database->homepage_batch();
 						$data['ins'] = $this->gudang_database->homepage_instruksi();
						$this->load->view('gudang/gudang_homepage', $data);	
					}
				} else {
					$data['message_display'] = 'Nomor LPB sudah ada! Gunakan nomor yang lain!';
					$this->load->view('gudang/tambah_lpb', $data);
				}
			}
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