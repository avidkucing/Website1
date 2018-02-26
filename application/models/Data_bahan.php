 <?php

Class Data_bahan extends CI_Model {
	public function load() {
		$data['bahan'] = $this->bahan();
 		return $data;
	}

	public function bahan(){
 		$this->db->select('*');
 		$this->db->from('jenis_bahan');
 		
 		$o_lpb_rows = $this->db->get()->result();
 		
 		return $o_lpb_rows;	
 	}
}
?>