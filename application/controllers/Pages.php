<?php 
 
class Pages extends CI_Controller{
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
		$this->load->model('data_lpb');

		if (!(isset($this->session->userdata['logged_in']))) {
			redirect(base_url("User_Authentication"));
		}
	}

	function print_lpb($a, $b, $c, $d){
		$data['tipe'] = $this->session->userdata['logged_in']['tipe'];
		$data['lpb'] = $this->data_lpb->print_lpb($a, $b, $c, $d);
 		$data['lpb_batch'] =$this->data_lpb->print_batch_lpb($a, $b, $c, $d);
		$this->load->view('pages/print_lpb', $data);		
	}

	function edit_lpb($a, $b, $c, $d) {
		$data['lpb'] = $this->data_lpb->print_lpb($a, $b, $c, $d);
 		$data['lpb_batch'] =$this->data_lpb->print_batch_lpb($a, $b, $c, $d);
		$this->load->view('pages/edit_lpb', $data);
	}

	function delete_lpb() {
		$data = array(
				'Nomor_LPB' => $this->input->post('Nomor_LPB'),
				);
		$this->data_lpb->delete($data);
	}

	function error_wip() {
		$this->load->view('errors/wip');
	}
}

?>