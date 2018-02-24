<?php 
 
class Lpb extends CI_Controller{
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

	public function tambah_lpb() {
		$this->load->view('pages_lpb/tambah_lpb');
	}

	public function print_lpb($a, $b, $c, $d){
		$data['tipe'] = $this->session->userdata['logged_in']['tipe'];
		$data['lpb'] = $this->data_lpb->print_lpb($a, $b, $c, $d);
 		$data['lpb_batch'] =$this->data_lpb->print_batch_lpb($a, $b, $c, $d);
		$this->load->view('pages_lpb/print_lpb', $data);		
	}

	public function edit_lpb($a, $b, $c, $d) {
		$data['lpb'] = $this->data_lpb->print_lpb($a, $b, $c, $d);
 		$data['lpb_batch'] =$this->data_lpb->print_batch_lpb($a, $b, $c, $d);
		$this->load->view('pages_lpb/edit_lpb', $data);
	}

	public function get_data_kode_bahan(){
		$value = $this->input->post("value");
	      $data = $this->data_lpb->get_data_kode_bahan($value);
	      $option ="<option value=''>--Pilih Kode Bahan--</option>";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Kode_Bahan."' >".$d->Kode_Bahan."</option>";
	      }
	      echo $option;
	}

	public function get_data_nama_bahan(){
	      $value = $this->input->post("value");
	      $data = $this->data_lpb->get_data_nama_bahan($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Bahan."' >".$d->Nama_Bahan."</option>";
	      }
	      echo $option;
	}

	public function get_data_manufaktur(){
		  $value = $this->input->post("value");
	      $data = $this->data_lpb->get_data_manufaktur($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Manufacturer."' >".$d->Nama_Manufacturer."</option>";
	      }
	      echo $option;	
	}

	public function get_data_supplier(){
		  $value = $this->input->post("value");
	      $data = $this->data_lpb->get_data_supplier($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Nama_Supplier."' >".$d->Nama_Supplier."</option>";
	      }
	      echo $option;		
	}

	public function get_data_satuan(){
		  $value = $this->input->post("value");
	      $data = $this->data_lpb->get_data_satuan($value);
	      $option ="";
	      foreach($data as $d)
	      {
	         $option .= "<option value='".$d->Satuan."' >".$d->Satuan."</option>";
	      }
	      echo $option;		
	}

	public function delete_lpb() {
		$data = array(
				'Nomor_LPB' => $this->input->post('Nomor_LPB'),
				);
		$this->data_lpb->delete($data);
	}

	public function error_wip() {
		$this->load->view('errors/wip');
	}
}

?>