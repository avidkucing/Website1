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

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}
 
	public function index(){
		$this->load->view('admin/admin_homepage');
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

	public function add_data_bahan_show(){
		$this->load->view('admin/add_data_bahan_form');
	}

	public function new_data_bahan() {
		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('kode', 'Kode Bahan Baku', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Bahan Baku', 'trim|required');
		$this->form_validation->set_rules('merk', 'Merk', 'trim|required');
		$this->form_validation->set_rules('manufacturer', 'Nama Manufacturer', 'trim|required');
		$this->form_validation->set_rules('supplier', 'Nama Supplier', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/add_data_bahan_form');
		} else {
			$data = array(
				'Kode_Bahan' => $this->input->post('kode'),
				'Nama_Bahan' => $this->input->post('nama'),
				'Nama_Manufacturer' => $this->input->post('manufacturer'),
				'Nama_Supplier' => $this->input->post('supplier'),
				'Merk' => $this->input->post('merk'),
				'Satuan' => $this->input->post('satuan'),
				);
			$result = $this->admin_database->insert_bahan_baku($data);
			if ($result == TRUE) {
				$data['message_display'] = 'Add Bahan Baku Sukses !';
				$this->load->view('admin/add_parameter_spesifikasi_form', $data);
			} else {
				$data['message_display'] = 'Gagal menambahkan data!';
				$this->load->view('admin/add_data_bahan_form', $data);
			}
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