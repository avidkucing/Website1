<?php

Class Qc_head_database extends CI_Model {

	//show data List pemeriksaan sampel (LPS)
	public function homepage() {
		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, jenis_bahan.Satuan');
		$this->db->from('bahan_terima');
		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
		$this->db->order_by('Tanggal_Terima desc, Nomor_LPB desc');
 		
		$o_lps_rows = $this->db->get()->result();

		return $o_lps_rows;
	}

	public function homepage_batch() {
		$this->db->select('*');
		$this->db->from('nomor_batch_bahan');
		$this->db->order_by('Nomor_Batch', 'desc');
 		
		$query = $this->db->get();
		$o_batch_rows = $query->result();

		return $o_batch_rows;
	}

	public function homepage_sampel(){
		$this->db->select('Nomor_Batch, Nomor_Instruksi, Jumlah_Sampel');
		$this->db->from('sampel_bahan_terima');
		
		$o_lps_rows = $this->db->get()->result();
		
		return $o_lps_rows;
	}

	public function homepage_analisa(){
		$this->db->select('*');
		$this->db->from('analisa_sampel');
		
		$o_lps_rows = $this->db->get()->result();
		
		return $o_lps_rows;
	}

	public function get_data_bahan_terima($value) {
		$this->db->select('bahan_terima.Nomor_LPB, jenis_bahan.Nama_Bahan, jenis_bahan.Kode_Bahan, jenis_bahan.Merk, jenis_bahan.Nama_Manufacturer, jenis_bahan.Nama_Supplier, bahan_terima.Tanggal_Terima');
		$this->db->from('bahan_terima');
		$this->db->where('bahan_terima.Nomor_LPB', $value);
		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');

		$o_bahan = $this->db->get()->result();
		
		//convert object to multiple-array
		$a_bahan = json_decode(json_encode($o_bahan), True);

		return $a_bahan;

	}


	public function get_data_batch_bahan_terima($value) {
		$this->db->select('*');
		$this->db->from('nomor_batch_bahan');
		$this->db->where('Nomor_Batch', $value);;
		
		$query = $this->db->get();
		$o_batch_row = $query->result();

		//convert object to multiple-array
		$a_batch_row = json_decode(json_encode($o_batch_row), True);

		return $a_batch_row;
	}

	public function get_data_param_bahan_terima($value) {
		$condition = "Kode_Bahan = (SELECT Kode_Bahan FROM jenis_bahan WHERE ID_Bahan = (SELECT ID_Bahan FROM bahan_terima WHERE Nomor_LPB = (SELECT Nomor_LPB FROM nomor_batch_bahan WHERE Nomor_Batch =" . "'" . $value . "'" . ")))";
		$this->db->select('*');
		$this->db->from('parameter_bahan');
		$this->db->where($condition);
		
		$o_bahan = $this->db->get()->result();

		return $o_bahan;
	}

	public function get_data_sampel_analisa_bahan_terima($value) {
		$condition = "Nomor_Batch = " . "'" . $value . "'";
		$this->db->select('Tanggal_Pemeriksaan, Sisa_Sampel');
		$this->db->from('analisa_sampel');
		$this->db->where($condition);


		$o_bahan = $this->db->get()->result();
		
		$a_bahan = json_decode(json_encode($o_bahan), True);

		return $a_bahan;
	}

	public function get_data_hasil_analisa_bahan_terima($value) {
		$condition = "Nomor_Analisa = (SELECT Nomor_Analisa FROM analisa_sampel WHERE Nomor_Batch = " . "'" . $value . "'" . ")";
		$this->db->select('*');
		$this->db->from('hasil_analisa_sampel');
		$this->db->where($condition);


		$o_bahan = $this->db->get()->result();
		
		$a_bahan = json_decode(json_encode($o_bahan), True);

		return $a_bahan;
	}

	public function update_status_bahan($value, $key) {
		if ($key == 1){
			return $this->db->query("UPDATE nomor_batch_bahan SET STATUS = 'RELEASE' WHERE Nomor_Batch = " . "'" . $value . "'");
		} else if ($key == 0) {
			return $this->db->query("UPDATE nomor_batch_bahan SET STATUS = 'REJECT' WHERE Nomor_Batch = " . "'" . $value . "'");
		} else {
			return FALSE;
		}
	}
}

?>