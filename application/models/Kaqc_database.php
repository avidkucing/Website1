<?php

Class Kaqc_Database extends CI_Model {

	//show data List pemeriksaan sampel (LPS)
	public function homepage() {
		$condition = "bahan_terima.ID_Bahan IN (SELECT ID_Bahan FROM jenis_bahan WHERE Jenis = " . "'Baku'" . ")";
		$condition2 = "bahan_terima.ID_Bahan IN (SELECT ID_Bahan FROM jenis_bahan WHERE Jenis = " . "'Kemas'" . ")";
		$condition3 = "bahan_terima.Status = " . "'ACCEPTED'";
		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, jenis_bahan.Satuan');
		$this->db->from('bahan_terima');
		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
		$this->db->order_by('Tanggal_Terima desc, Nomor_LPB desc');
 		$this->db->where($condition3);
		$this->db->where($condition);
		$this->db->or_where($condition2);

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
		$this->db->select('ID_Batch, Nomor_Instruksi, Jumlah_Sampel');
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

	public function instruksi_insert($data) {
		$condition = "Nomor_Instruksi =" . "'" . $data['Nomor_Instruksi'] . "'";
		$this->db->select('*');
		$this->db->from('sampel_bahan_terima');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {

			// Query to insert data in database
			$this->db->insert('sampel_bahan_terima', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function get_data_bahan_terima($value) {
		$condition = "Nomor_LPB = (SELECT Nomor_LPB FROM nomor_batch_bahan WHERE ID_Batch =" . "'" . $value . "'" . ")";
		$this->db->select('bahan_terima.Nomor_LPB, jenis_bahan.Nama_Bahan, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Manufacturer, bahan_terima.Nama_Supplier, bahan_terima.Tanggal_Terima');
		$this->db->from('bahan_terima');
		$this->db->where($condition);
		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');

		$o_bahan = $this->db->get()->result();
		
		//convert object to multiple-array
		$a_bahan = json_decode(json_encode($o_bahan), True);

		return $a_bahan;

	}


	public function get_data_batch_bahan_terima($value) {
		$this->db->select('*');
		$this->db->from('nomor_batch_bahan');
		$this->db->where('ID_Batch', $value);;
		
		$query = $this->db->get();
		$o_batch_row = $query->result();

		//convert object to multiple-array
		$a_batch_row = json_decode(json_encode($o_batch_row), True);

		return $a_batch_row;
	}

	public function get_data_param_bahan_terima($value) {
		$condition = "Kode_Bahan = (SELECT Kode_Bahan FROM jenis_bahan WHERE ID_Bahan = (SELECT ID_Bahan FROM bahan_terima WHERE Nomor_LPB = (SELECT Nomor_LPB FROM nomor_batch_bahan WHERE ID_Batch =" . "'" . $value . "'" . ")))";
		$this->db->select('*');
		$this->db->from('parameter_bahan');
		$this->db->where($condition);
		$this->db->order_by('No', 'asc');
		
		$o_bahan = $this->db->get()->result();

		return $o_bahan;
	}

	public function get_data_analisa_bahan_terima($value) {
		$condition = "ID_Batch = " . "'" . $value . "'";
		$this->db->select('Tanggal_Pemeriksaan, Sisa_Sampel, Merk');
		$this->db->from('analisa_sampel');
		$this->db->where($condition);
		

		$o_bahan = $this->db->get()->result();
		
		$a_bahan = json_decode(json_encode($o_bahan), True);

		return $a_bahan;
	}

	public function get_data_sampel_bahan_terima($value) {
		$condition = "ID_Batch = " . "'" . $value . "'";
		$this->db->select('*');
		$this->db->from('sampel_bahan_terima');
		$this->db->where($condition);
		

		$o_bahan = $this->db->get()->result();
		
		$a_bahan = json_decode(json_encode($o_bahan), True);

		return $a_bahan;
	}

	public function get_data_hasil_analisa_bahan_terima($value) {
		$condition = "Nomor_Analisa = (SELECT Nomor_Analisa FROM analisa_sampel WHERE ID_Batch = " . "'" . $value . "'" . ")";
		$this->db->select('*');
		$this->db->from('hasil_analisa_sampel');
		$this->db->where($condition);
		$this->db->order_by('No', 'asc');
		

		$o_bahan = $this->db->get()->result();
		
		$a_bahan = json_decode(json_encode($o_bahan), True);

		return $a_bahan;
	}
	/*
	public function update_alasan_status($no, $alasan) {
		return $this->db->query("UPDATE nomor_batch_bahan SET Alasan_Status = $alasan WHERE ID_Batch = ". "'" . $value . "'");
	}
	*/
	public function update_status_bahan($data) {
		return $this->db->query("UPDATE nomor_batch_bahan SET STATUS = " . "'" . $data['Status'] . "'" . ", Alasan_Status = " . "'" . $data['Alasan_Status'] . "'" . "WHERE ID_Batch = " . "'" . $data['ID_Batch'] . "'");
		/*
		if ($key == 1){
			return $this->db->query("UPDATE nomor_batch_bahan SET STATUS = 'RELEASE' WHERE ID_Batch = " . "'" . $value . "'");
		} else if ($key == 0) {
			return $this->db->query("UPDATE nomor_batch_bahan SET STATUS = 'REJECT' WHERE ID_Batch = " . "'" . $value . "'");
		} else {
			return FALSE;
		}*/
	}
}

?>