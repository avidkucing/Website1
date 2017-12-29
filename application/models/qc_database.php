<?php

Class Qc_Database extends CI_Model {

	//show data List pemeriksaan sampel (LPS)
	public function homepage() {
		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, jenis_bahan.Satuan');
		$this->db->from('bahan_terima');
		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');

		$o_lps_rows = $this->db->get()->result();

		return $o_lps_rows;
	}

	public function homepage_batch() {
		$this->db->select('*');
		$this->db->from('nomor_batch_bahan');
		
		$query = $this->db->get();
		$o_batch_rows = $query->result();

		//convert object to multiple-array
		//$a_batch_rows = json_decode(json_encode($o_batch_rows), True);

		/*/convert multiple-array to array of string per nomor_LPB
		$b = 0;
		$batch_rows = array();
		$str_tmp = '';
		foreach ($a_batch_rows as $a => $b) {
			$kode = $a_batch_rows[$a]['Nomor_LPB'];
			if ($a == 0) {
				$cek = $kode;	
			}
			if ($cek != $kode) {
				$str_tmp = '';
			}
			if ($str_tmp == '') {
				$str_tmp = $a_batch_rows[$a]['Nomor_Batch'];	
			} else {
				$str_tmp = $str_tmp . ', ' . $a_batch_rows[$a]['Nomor_Batch'];
			}
			$batch_rows[$kode] = $str_tmp;
			$cek = $kode;
		}*/
		return $o_batch_rows;
	}

	public function homepage_instruksi(){
		$this->db->select('Nomor_Batch, Nomor_Instruksi, Jumlah_Sampel');
		$this->db->from('sampel_bahan_terima');

		$o_lps_rows = $this->db->get()->result();
		
		$a_lps_rows = json_decode(json_encode($o_lps_rows), True);

		return $a_lps_rows;
	}

	public function homepage_analisa(){
		$this->db->select('Nomor_Batch, Nomor_Analisa, Sisa_Sampel');
		$this->db->from('sampel_bahan_terima');

		$o_lps_rows = $this->db->get()->result();
		
		$a_lps_rows = json_decode(json_encode($o_lps_rows), True);

		return $a_lps_rows;
	}

	public function get_data_bahan_terima($value) {
		$this->db->select('bahan_terima.Nomor_LPB, jenis_bahan.Nama_Bahan, jenis_bahan.Kode_Bahan, jenis_bahan.Merk, jenis_bahan.Nama_Manufacturer, jenis_bahan.Nama_Supplier, bahan_terima.Tanggal_Terima, bahan_terima.Jumlah');
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
		$this->db->where('Nomor_LPB', $value);;
		
		$query = $this->db->get();
		$o_batch_rows = $query->result();

		//convert object to multiple-array
		$a_batch_rows = json_decode(json_encode($o_batch_rows), True);

		//convert multiple-array to array of string per nomor_LPB
		$b = 0;
		$batch_rows = array();
		$str_tmp = '';
		foreach ($a_batch_rows as $a => $b) {
			$kode = $a_batch_rows[$a]['Nomor_LPB'];
			if ($a == 0) {
				$cek = $kode;	
			}
			if ($cek != $kode) {
				$str_tmp = '';
			}
			if ($str_tmp == '') {
				$str_tmp = $a_batch_rows[$a]['Nomor_Batch'];	
			} else {
				$str_tmp = $str_tmp . ', ' . $a_batch_rows[$a]['Nomor_Batch'];
			}
			$batch_rows[$kode] = $str_tmp;
			$cek = $kode;
		}
		return $batch_rows;
	}

	public function get_data_param_bahan_terima($value) {
		$condition = "Kode_Bahan = (SELECT Kode_Bahan FROM jenis_bahan WHERE ID_Bahan = (SELECT ID_Bahan FROM bahan_terima WHERE Nomor_LPB = " . "'" . $value . "'" . "))";
		$this->db->select('*');
		$this->db->from('parameter_bahan');
		$this->db->where($condition);
		
		$o_bahan = $this->db->get()->result();

		return $o_bahan;
	}

	public function instruksi_insert($data) {
		$condition = "Nomor_LPB =" . "'" . $data['Nomor_LPB'] . "'";
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

	public function instruksi_update($data) {
		return $this->db->query("UPDATE sampel_bahan_terima SET Nomor_Analisa = " . "'" . $data['Nomor_Analisa'] . "'" . ", Tanggal_Pemeriksaan = " . "'" . $data['Tanggal_Pemeriksaan'] . "'" . ", Sisa_Sampel = " . "'" . $data['Sisa_Sampel'] . "'" . " WHERE Nomor_LPB = " . "'" . $data['Nomor_LPB'] . "'" . "");
	}

	public function hasil_insert($data) {
		 $this->db->set($data);
		 $this->db->insert($this->db->dbprefix . 'hasil_analisa_sampel');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	}
?>