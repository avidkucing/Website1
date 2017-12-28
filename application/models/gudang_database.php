<?php

Class Gudang_Database extends CI_Model {

	// Insert registration data in database
	public function get_kode_bahan() {

		$this->db->select('Kode_Bahan');
		$this->db->distinct();
		$this->db->from('jenis_bahan');

		$query = $this->db->get();
		$o_kode_rows = $query->result();

		//convert object to multiple-array
		$a_kode_rows = json_decode(json_encode($o_kode_rows), True);

		//convert multiple-array to array
		$b = 0;
		$kode_rows = array();
		foreach ($a_kode_rows as $a => $b) {
			$kode_rows[$a] = $a_kode_rows[$a]['Kode_Bahan'];
		}

		//change $a data on array to the value
		$real_kode_rows = array();
		foreach ($kode_rows as $a => $b) {
			$real_kode_rows[$kode_rows[$a]] = $kode_rows[$a];
		}		

		return $real_kode_rows;
	}

	 public function get_data_nama_bahan($value) {
	    $this->db->select('Nama_Bahan');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where("Kode_Bahan",$value);
	    
	    return $this->db->get()->result();
	 }

	 public function get_data_manufaktur($value) {
	 	$this->db->select('Nama_Manufacturer');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where("Kode_Bahan",$value);
	    
	    return $this->db->get()->result();	
	 }

	 public function get_data_supplier($value) {
	 	$this->db->select('Nama_Supplier');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where("Kode_Bahan",$value);
	    
	    return $this->db->get()->result();		
	 }

	 public function get_data_satuan($value) {
	 	$this->db->select('Satuan');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where("Kode_Bahan",$value);
	    
	    return $this->db->get()->result();		
	 }

	 public function cari_id_bahan($cari) {
	 	$this->db->select('ID_Bahan');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where($cari);
	    $this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	 }

	 public function bahan_terima_insert($data) {
	 	// Query to check whether username already exist or not
		$condition = "Nomor_LPB =" . "'" . $data['Nomor_LPB'] . "'";
		$this->db->select('*');
		$this->db->from('bahan_terima');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			// Query to insert data in database
			$this->db->insert('bahan_terima', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	 }

	 public function insert_batch_bahan_baku($data){
	 	$this->db->insert('nomor_batch_bahan', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	 }
}

?>