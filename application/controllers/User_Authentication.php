<?php

//session_start(); //we need to start session in order to access it through CI

Class User_Authentication extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//Load helper url
		$this->load->helper('url');

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('login_database');
	}

	// Show login page
	public function index() {
		$this->load->view('login_form');
	}

	// Check for user login process
	public function user_login_process() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				$this->load->view('admin_page');
			}else{
				$this->load->view('login_form');
			}
		} else {
			$data = array(
			'username' => $this->input->post('username'),
			'password' => md5(sha1(md5($this->input->post('password'))))
			);
			$result = $this->login_database->login($data);
			if ($result == TRUE) {
				$username = $this->input->post('username');
				$result = $this->login_database->read_user_information($username);
				if ($result != false) {
					$session_data = array(
					'username' => $result[0]->Username,
					'email' => $result[0]->Email,
					'nama' => $result[0]->Nama,
					'tipe' => $result[0]->Tipe_Pegawai,
					);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
					// Classify view based on tipe pegawai account
					if ($result[0]->Tipe_Pegawai == 'Administrator') {
						redirect(base_url("Admin"));
					} else if ($result[0]->Tipe_Pegawai == 'Gudang') {
						redirect(base_url("Gudang"));
					} else if ($result[0]->Tipe_Pegawai == 'Quality Control') {
						redirect(base_url("Quality_Control"));
					} else if ($result[0]->Tipe_Pegawai == 'Kepala Bagian Quality Control') {
						redirect(base_url("Ka_Quality_Control"));
					}
				}
			} else {
				$data = array(
				'error_message' => 'Invalid Username or Password'
				);
				$this->load->view('login_form', $data);
			}
		}
	}

	// Logout from admin page
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