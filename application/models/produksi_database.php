<?php

Class Produksi_database extends CI_Model {

	
 	public function homepage() {
 		
 	}

 	public function homepage_instruksi($nama){
 		$this->db->select('*');
 		$this->db->from('permintaan_bahan');
 		$this->db->where("Site_Produksi", $nama);
 		$this->db->order_by('Nomor_Instruksi', 'desc');
 		
 		$query = $this->db->get();
 		$o_batch_rows = $query->result();
 		$this->ubah_format_tanggal($o_batch_rows);
 		
 		//convert object to multiple-array
 		//$a_batch_rows = json_decode(json_encode($o_batch_rows), True);
		return $o_batch_rows; 
 		
 	}


 	public function print_instruksi_permintaan($noins) {
		$this->db->select('*');
 		$this->db->from('permintaan_bahan');
 		$this->db->where("Nomor_Instruksi", $noins);
 		$this->db->order_by('Nomor_Instruksi', 'desc');
 		
 		$o_lpb_rows = $this->db->get()->result();
 		$this->ubah_format_tanggal($o_lpb_rows);
 		
 		$a_lpb_rows = json_decode(json_encode($o_lpb_rows), True);
 		return $a_lpb_rows;
 	}

 	public function print_permintaan_bahan($noins) {
 		$this->db->select('*');
 		$this->db->from('bahan_minta');
 		$this->db->where("Nomor_Instruksi", $noins);
 		$this->db->order_by('Kode_Bahan', 'desc');
 		
 		$o_lpb_rows = $this->db->get()->result();
 		

 		$a_lpb_rows = json_decode(json_encode($o_lpb_rows), True);
 		return $a_lpb_rows;
 	}

 	public function print_jenis_bahan($noins) {
 		$condition = "Kode_Bahan = ANY (SELECT Kode_Bahan FROM bahan_minta WHERE Nomor_Instruksi = " . "'" . $noins ."'" . ")";
 		$this->db->select('*');
 		$this->db->from('jenis_bahan');
 		$this->db->where($condition);
 		$this->db->order_by('Kode_Bahan', 'desc');
 		
 		$o_lpb_rows = $this->db->get()->result();
 		

 		$a_lpb_rows = json_decode(json_encode($o_lpb_rows), True);
 		return $a_lpb_rows;	
 	}

 	public function get_kode_bahan() {

		$this->db->select('Kode_Bahan');
		$this->db->distinct();
		$this->db->from('jenis_bahan');
		$this->db->where('Jenis', 'Baku');

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
		$dump_kode = array ('' => '--Pilih Opsi Bahan Baku--');
		$real_kode_rows = $dump_kode + $real_kode_rows;
		return $real_kode_rows;
	}

	public function get_data_nomor_analisa($value) {
		$condition = "Nomor_Batch = ANY (SELECT Nomor_Batch FROM nomor_batch_bahan WHERE Status = 'RELEASE' AND Nomor_LPB = ANY (SELECT Nomor_LPB FROM bahan_terima WHERE ID_Bahan = ANY (SELECT ID_Bahan FROM jenis_bahan WHERE Kode_Bahan = " . "'" . $value . "'" . ")))";
	 	$this->db->select('Nomor_analisa');
	    $this->db->distinct();
	    $this->db->from('analisa_sampel');
	    $this->db->where($condition);
	    $query = $this->db->get();
		$o_ana_rows = $query->result();

	    //convert object to multiple-array
		$a_ana_rows = json_decode(json_encode($o_ana_rows), True);
		//print_r($a_ana_rows);
		//convert multiple-array to array
		$b = 0;
		$ana_rows = array();
		foreach ($a_ana_rows as $a => $b) {
			$ana_rows[$a] = $a_ana_rows[$a]['Nomor_analisa'];
		}

		//change $a data on array to the value
		$real_ana_rows = array();
		foreach ($ana_rows as $a => $b) {
			$real_ana_rows[$ana_rows[$a]] = $ana_rows[$a];
		}		

		return $real_ana_rows;
	}

	public function get_data_satuan($value) {
		$this->db->select('Satuan');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where("Kode_Bahan",$value);
	    
	    return $this->db->get()->result();
	}

	public function get_data_exp_date($value){
		$condition = "Nomor_Batch = ANY (SELECT Nomor_Batch FROM analisa_sampel WHERE Nomor_Analisa = " . "'" . $value . "'" . ")";
	 	$this->db->select('EXP_Date');
	    $this->db->distinct();
	    $this->db->from('sampel_bahan_terima');
	    $this->db->where($condition);
	    
	    return $this->db->get()->result();
	}

	public function get_data_jumlah($value){
		$condition = "Nomor_Batch = (SELECT Nomor_Batch FROM analisa_sampel WHERE Nomor_Analisa = " . "'" . $value . "'" . ")";
	 	$this->db->select('Jumlah');
	    $this->db->distinct();
	    $this->db->from('nomor_batch_bahan');
	    $this->db->where($condition);
	    
	    return $this->db->get()->result();
	}

	public function bahan_minta_insert($data){
		// Query to check whether username already exist or not
		$condition = "Nomor_Instruksi =" . "'" . $data['Nomor_Instruksi'] . "'";
		$this->db->select('*');
		$this->db->from('permintaan_bahan');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			// Query to insert data in database
			$this->db->insert('permintaan_bahan', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function insert_array_bahan_baku($data){
		$this->db->insert('bahan_minta', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function cek_stok($value) {
		$condition = "Nomor_Batch = (SELECT Nomor_Batch FROM analisa_sampel WHERE Nomor_Analisa = " . "'" . $value . "'" . ")";
	 	$this->db->select('Jumlah');
	    $this->db->distinct();
	    $this->db->from('nomor_batch_bahan');
	    $this->db->where($condition);

	    return $this->db->get()->result();
	}

	public function update_stok($value, $key){
		return $this->db->query("UPDATE nomor_batch_bahan SET Jumlah = " . "'" . $value . "'"  . " WHERE Nomor_Batch = (SELECT Nomor_Batch FROM analisa_sampel WHERE Nomor_Analisa = " . "'" . $key . "'" . ")");
	}

	public function ubah_format_tanggal($data){
	 	
 		if (isset($data[0]->Tanggal_Terima)) {
		    foreach($data as $key => $value)
		    	{
					$data[$key]->Tanggal_Terima = date('d/m/Y',strtotime($value->Tanggal_Terima));
				}
		}
		if (isset($data[0]->Tanggal_Permintaan)) {
		    foreach($data as $key => $value)
		    	{
					$data[$key]->Tanggal_Permintaan = date('d/m/Y',strtotime($value->Tanggal_Permintaan));
				}
		}
	 }
}
	

?>