<?php 
 
class Admin extends CI_Controller{
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
		$this->load->model('admin_database');
		$this->load->model('gudang_database');
		$this->load->model('data_lpb');
		$this->load->model('data_stock');
		$this->load->model('data_permintaan');
		$this->load->model('data_akun');
		$this->load->model('data_bahan');

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}
 
	public function index() {
		$data['akun'] = $this->admin_database->show_user();
		$data['contents'] = $this->load_contents();
		$data['ins'] = $this->gudang_database->homepage_instruksi();
		$this->load->view('admin/admin_homepage', $data);
	}

	public function load_contents() {
		$data['lpb_baku'] = $this->load->view('contents/lpb_baku', $this->data_lpb->load(), TRUE);
		$data['lpb_bantu'] = $this->load->view('contents/lpb_bantu', $this->data_lpb->load(), TRUE);
		$data['lpb_kemas'] = $this->load->view('contents/lpb_kemas', $this->data_lpb->load(), TRUE);
		$data['stock_baku'] = $this->load->view('contents/stock_baku', $this->data_stock->load(), TRUE);
		$data['stock_kemas'] = $this->load->view('contents/stock_kemas', $this->data_stock->load(), TRUE);
		$data['stock_bantu'] = $this->load->view('contents/stock_bantu', $this->data_stock->load(), TRUE);
		$data['permintaan_baku'] = $this->load->view('contents/permintaan_baku', $this->data_permintaan->load(), TRUE);
		$data['bahan'] = $this->load->view('contents/bahan', $this->data_bahan->load(), TRUE);
		$data['akun'] = $this->load->view('contents/akun', $this->data_akun->load(), TRUE);
		return $data;
	}

	// Show registration page
	public function user_registration_show() {
		$this->load->view('admin/registration_form');
	}

	// Validate and store registration data in database
	public function new_user_registration() {
		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('tipe', 'Tipe Pegawai', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('email_value', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/registration_form');
		} else {
			$data = array(
				'Tipe_Pegawai' => $this->input->post('tipe'),
				'Nama' => $this->input->post('nama'),
				'Username' => $this->input->post('username'),
				'Email' => $this->input->post('email_value'),
				'Password' => md5(sha1(md5($this->input->post('password'))))
				);
			$result = $this->admin_database->registration_insert($data);
			if ($result == TRUE) {
				$data['message_display'] = 'Registration Successfully !';
				$this->load->view('admin/admin_homepage');
			} else {
				$data['message_display'] = 'Username already exist!';
				$this->load->view('admin/registration_form', $data);
			}
		}
	}

	public function add_data_bahan(){
		$this->load->view('admin/add_data_bahan');
	}	

	public function add_data_bahan_baku_show(){
		$this->load->view('admin/add_data_bahan_baku_form');
	}

	public function add_data_bahan_kemas_show(){
		$this->load->view('admin/add_data_bahan_kemas_form');	
	}

	public function new_data_bahan() {
		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('kode', 'Kode Bahan Baku', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Bahan Baku', 'trim|required');
		/*$this->form_validation->set_rules('merk', 'Merk', 'trim|required');
		$this->form_validation->set_rules('manufacturer', 'Nama Manufacturer', 'trim|required');
		$this->form_validation->set_rules('supplier', 'Nama Supplier', 'trim|required');*/
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/add_data_bahan_form');
		} else {
			$data = array(
				'Kode_Bahan' => $this->input->post('kode'),
				'Nama_Bahan' => $this->input->post('nama'),
				/*'Nama_Manufacturer' => $this->input->post('manufacturer'),
				'Nama_Supplier' => $this->input->post('supplier'),
				'Merk' => $this->input->post('merk'),*/
				'Satuan' => $this->input->post('satuan'),
				'Jenis' => $this->input->post('jenis'),
				);
			$result = $this->admin_database->insert_bahan_baku($data);
			if ($result == TRUE) {
				$data['message_display'] = 'Add Bahan Baku Sukses !';
				//$this->load->view('admin/add_parameter_spesifikasi_form', $data);
				$this->load->view('admin/add_manu_supp_form', $data);
			} else {
				$data['message_display'] = 'Gagal menambahkan data!';
				$this->load->view('admin/add_data_bahan_form', $data);
			}
		}
	}

	public function new_manu_supp_data_bahan() {
		$this->form_validation->set_rules('kode', 'Kode Bahan Baku', 'trim|required');
		
		$kode = $this->input->post('kode');
		$array_manu = $this->input->post('manu[]');
		$array_supp = $this->input->post('supp[]');
		$result =array();
		$b = 0;
		$results = 1;

		foreach (($array_manu) as $a => $b) {
			$data = array(
			'Kode_Bahan' => $kode,
			'Nama_Manufacturer' => $array_manu[$a],
			);
			$result[$a] = $this->admin_database->insert_manu_bahan_baku($data);
			if ($result[$a] == FALSE) {
				$data['message_display'] = 'Gagal menambahkan data!';
				$results = 0;
				break;
			}
		}

		foreach (($array_supp) as $a => $b) {
			$data = array(
			'Kode_Bahan' => $kode,
			'Nama_Supplier' => $array_supp[$a],
			);
			$result[$a] = $this->admin_database->insert_supp_bahan_baku($data);
			if ($result[$a] == FALSE) {
				$data['message_display'] = 'Gagal menambahkan data!';
				$results = 0;
				break;
			}
		}
		
		if ($results == 0) { //gagal tambah data setelah break;
			$this->load->view('admin/add_manu_supp_form', $data);	
		} else {
			$data['message_display'] = 'Sukses menambahkan data!';
			$this->load->view('admin/add_parameter_spesifikasi_form', $data);	
		}
	}

	public function new_parameter_data_bahan() {
		$this->form_validation->set_rules('kode', 'Kode Bahan Baku', 'trim|required');
		
		$kode = $this->input->post('kode');
		$array_param = $this->input->post('param[]');
		$array_spek = $this->input->post('spek[]');
		$result =array();
		$b = 0;
		$results = 1;

		foreach (($this->input->post('param[]')) as $a => $b) {
			$data = array(
			'Kode_Bahan' => $kode,
			'No' => $a+1,
			'Parameter' => $array_param[$a],
			'Spesifikasi' => $array_spek[$a],
			);
			$result[$a] = $this->admin_database->insert_param_bahan_baku($data);
			if ($result[$a] == FALSE) {
				$data['message_display'] = 'Gagal menambahkan data!';
				$results = 0;
				break;
			}
		}
		
		if ($results == 0) { //gagal tambah data setelah break;
			$this->load->view('admin/add_parameter_spesifikasi_form', $data);	
		} else {
			$data['message_display'] = 'Sukses menambahkan data!';
			$this->load->view('admin/admin_homepage', $data);	
		}
	}

	public function get_data_stock() {
		$value = $this->input->post("value");
	    $data = $this->data_stock->get_data_stock($value);
	    
	    echo json_encode($data);
	}

	public function get_data_permintaan() {
		$value = $this->input->post("value");
	    $data = $this->data_permintaan->get_data_permintaan($value);
	    
	    echo json_encode($data);
	}

	public function update_data_permintaan() {
		$data = array(
				'Nomor_Instruksi' => $this->input->post('noins'),
				'Site_Produksi' => $this->input->post('site'),
				'Tanggal_Permintaan' => $this->input->post('tglminta'),
				);

		$newtgl = str_replace('/', '-', $data['Tanggal_Permintaan']);
		$data['Tanggal_Permintaan'] = date('Y-m-d',strtotime($newtgl));

		$this->data_permintaan->update_data_permintaan($data);
	}

	public function delete_permintaan() {
		$data = array(
				'Nomor_Instruksi' => $this->input->post('noins'),
				);
		$this->data_permintaan->delete_permintaan($data);
	}

	public function get_data_user() {
		$value = $this->input->post("value");
	    $data = $this->admin_database->get_data_user($value);
	    
	    echo json_encode($data);
	}

	public function update_data_user() {
		$data = array(
				'Tipe_Pegawai' => $this->input->post('tipe'),
				'Nama' => $this->input->post('nama'),
				'Username' => $this->input->post('uname'),
				'Password' => md5(sha1(md5($this->input->post('password'))))
				);
		$this->admin_database->update_data_user($data);
	}

	public function update_data_user_nopass() {
		$data = array(
				'Tipe_Pegawai' => $this->input->post('tipe'),
				'Nama' => $this->input->post('nama'),
				'Username' => $this->input->post('uname'),
				);
		$this->admin_database->update_data_user($data);
	}

	public function delete_user() {
		$data = array(
				'Username' => $this->input->post('uname'),
				);
		$this->admin_database->delete_user($data);
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