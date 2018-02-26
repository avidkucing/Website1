 <?php

Class Gudang_database extends CI_Model {

	//show data LPB
 	public function homepage() {
 		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Supplier, bahan_terima.Nama_Manufacturer, jenis_bahan.Satuan');
 		$this->db->from('bahan_terima');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->where("jenis_bahan.Jenis", "Baku");
 		$this->db->order_by('Nomor_LPB', 'desc');
 		
 		$o_lpb_rows = $this->db->get()->result();

		$this->ubah_format_tanggal($o_lpb_rows);

 		return $o_lpb_rows;
 	}
 	
 	//show data LPB bahan kemas
 	public function homepage_kemas() {
 		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Supplier, bahan_terima.Nama_Manufacturer, jenis_bahan.Satuan');
 		$this->db->from('bahan_terima');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->order_by('Tanggal_Terima desc, Nomor_LPB desc');
 		$this->db->where("jenis_bahan.Jenis", "Kemas");
 		
 		$o_lpb_rows = $this->db->get()->result();
 		
 		$this->ubah_format_tanggal($o_lpb_rows);
	
 		return $o_lpb_rows;
 	}

 	//show data LPB bahan pembantu
 	public function homepage_bantu() {
 		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Supplier, bahan_terima.Nama_Manufacturer, jenis_bahan.Satuan');
 		$this->db->from('bahan_terima');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->order_by('Tanggal_Terima desc, Nomor_LPB desc');
 		$this->db->where("jenis_bahan.Jenis", "Pembantu");
 		
 		$o_lpb_rows = $this->db->get()->result();
 		
 		$this->ubah_format_tanggal($o_lpb_rows);
	
 		return $o_lpb_rows;	
 	}
 	//homepage batch show data batch
 	public function homepage_batch() {
 		$this->db->select('*');
 		$this->db->from('nomor_batch_bahan');
 		$this->db->order_by('Nomor_LPB', 'asc');
 		
 		$query = $this->db->get();
 		$o_batch_rows = $query->result();
 
 		//convert object to multiple-array
 		//$a_batch_rows = json_decode(json_encode($o_batch_rows), True);
		return $o_batch_rows; 
 		
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
 		}
 		return $batch_rows;
 		*/
 	}
 	
 	//revisi stock
 	public function homepage_stock_baku(){
 		$this->db->select('analisa_sampel.Nomor_Analisa, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Manufacturer, nomor_batch_bahan.EXP_Date, nomor_batch_bahan.Jumlah, nomor_batch_bahan.Keterangan, bahan_terima.Nomor_LPB');
 		$this->db->from('nomor_batch_bahan');
 		$this->db->join('bahan_terima', 'bahan_terima.Nomor_LPB = nomor_batch_bahan.Nomor_LPB', 'inner');
 		$this->db->join('analisa_sampel', 'nomor_batch_bahan.ID_Batch = analisa_sampel.ID_Batch', 'inner');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->order_by('Nomor_Analisa desc');
 		$this->db->where("nomor_batch_bahan.Status", "RELEASE");
 		$this->db->where("jenis_bahan.Jenis", "Baku");
 		
 		$o_lpb_rows = $this->db->get()->result();
 		
 		return $o_lpb_rows;	
 	}

 	public function homepage_stock_kemas(){
 		$this->db->select('analisa_sampel.Nomor_Analisa, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Manufacturer, nomor_batch_bahan.EXP_Date, nomor_batch_bahan.Jumlah, nomor_batch_bahan.Keterangan, bahan_terima.Nomor_LPB');
 		$this->db->from('nomor_batch_bahan');
 		$this->db->join('bahan_terima', 'bahan_terima.Nomor_LPB = nomor_batch_bahan.Nomor_LPB', 'inner');
 		$this->db->join('analisa_sampel', 'nomor_batch_bahan.ID_Batch = analisa_sampel.ID_Batch', 'inner');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->order_by('Nomor_Analisa desc');
 		$this->db->where("nomor_batch_bahan.Status", "RELEASE");
 		$this->db->where("jenis_bahan.Jenis", "Kemas");
 		
 		$o_lpb_rows = $this->db->get()->result();
 		
 		return $o_lpb_rows;	
 	}

 	public function homepage_instruksi(){
 		$this->db->select('*');
 		$this->db->from('permintaan_bahan');
 		$this->db->order_by('Nomor_Instruksi', 'desc');
 		
 		$query = $this->db->get();
 		$o_batch_rows = $query->result();

 		$this->ubah_format_tanggal($o_batch_rows);
 
 		//convert object to multiple-array
 		//$a_batch_rows = json_decode(json_encode($o_batch_rows), True);
		return $o_batch_rows; 
 		
 	}

	public function print_lpb($a, $b, $c, $d) {
		$nolpb = $a . '/' . $b . '/' . $c . '/' . $d;
		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, jenis_bahan.Nama_Bahan, bahan_terima.Nama_Supplier, bahan_terima.Nama_Manufacturer, bahan_terima.Nomor_Surat, jenis_bahan.Satuan');
 		$this->db->from('bahan_terima');
 		$this->db->where("Nomor_LPB", $nolpb);
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->order_by('Tanggal_Terima desc, Nomor_LPB desc');
 		
 		$o_lpb_rows = $this->db->get()->result();

 		$this->ubah_format_tanggal($o_lpb_rows);

 		$a_lpb_rows = json_decode(json_encode($o_lpb_rows), True);
 		return $a_lpb_rows;
	}

	public function print_batch_lpb($a, $b, $c, $d) {
		$nolpb = $a . '/' . $b . '/' . $c . '/' . $d;
		$this->db->select('*');
 		$this->db->from('nomor_batch_bahan');
 		$this->db->where("Nomor_LPB", $nolpb);
 		$this->db->order_by('Nomor_LPB', 'desc');
 		
 		$query = $this->db->get();
 		$o_batch_rows = $query->result();
 		$a_batch_rows = json_decode(json_encode($o_batch_rows), True);
		return $a_batch_rows; 
	}

	public function print_instruksi_permintaan($noins) {
		$this->db->select('*');
 		$this->db->from('permintaan_bahan');
 		$this->db->where("Nomor_Instruksi", $noins);
 		$this->db->order_by('Nomor_Instruksi', 'desc');
 		
 		$o_lpb_rows = $this->db->get()->result();
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

 	public function get_data_nomor_analisa($value) {
		$condition = "ID_Batch = ANY (SELECT ID_Batch FROM nomor_batch_bahan WHERE Status = 'RELEASE' AND Nomor_LPB = ANY (SELECT Nomor_LPB FROM bahan_terima WHERE ID_Bahan = ANY (SELECT ID_Bahan FROM jenis_bahan WHERE Kode_Bahan = " . "'" . $value . "'" . ")))";
	 	$this->db->select('Nomor_Analisa');
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
			$ana_rows[$a] = $a_ana_rows[$a]['Nomor_Analisa'];
		}

		//change $a data on array to the value
		$real_ana_rows = array();
		foreach ($ana_rows as $a => $b) {
			$real_ana_rows[$ana_rows[$a]] = $ana_rows[$a];
		}		

		return $real_ana_rows;
	}

	public function cek_stok($value) {
		$condition = "Nomor_Batch = (SELECT Nomor_Batch FROM analisa_sampel WHERE Nomor_Analisa = " . "'" . $value . "'" . ")";
	 	$this->db->select('Jumlah');
	    $this->db->distinct();
	    $this->db->from('nomor_batch_bahan');
	    $this->db->where($condition);

	    return $this->db->get()->result();
	}
	
 	public function konfirmasi_minta_bahan($data) {
 		$this->db->set('Status', 'ACCEPTED');
 		$this->db->set('Nomor_Analisa', $data['Nomor_Analisa']);
 		$this->db->set('Jumlah', $data['Jumlah']);
 		$this->db->where('Nomor_Instruksi', $data['Nomor_Instruksi']);
 		$this->db->update('permintaan_bahan');

 		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
 	}

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

	public function get_data_kode_bahan($value){
 		$this->db->select('Kode_Bahan');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where("Jenis",$value);
	    
	    return $this->db->get()->result();
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
	    $this->db->from('manufaktur_bahan');
	    $this->db->where("Kode_Bahan",$value);
	    
	    return $this->db->get()->result();	
	 }

	 public function get_data_supplier($value) {
	 	$this->db->select('Nama_Supplier');
	    $this->db->distinct();
	    $this->db->from('supplier_bahan');
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
	/*
	public function get_data_nama_manufaktur_from_supplier($value, $value2) {
	 	$condition = "Kode_Bahan = " . "'" . $value . "'" . " AND Nama_Supplier = " . "'" . $value2 . "'";
	 	$this->db->select('Nama_Manufacturer');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where($condition);

	    return $this->db->get()->result();	
	 }

	public function get_data_nama_supplier_from_manufaktur($value, $value2) {
	 	$condition = "Kode_Bahan = " . "'" . $value . "'" . " AND Nama_Manufacturer = " . "'" . $value2 . "'";
	 	$this->db->select('Nama_Supplier');
	    $this->db->distinct();
	    $this->db->from('jenis_bahan');
	    $this->db->where($condition);

	    return $this->db->get()->result();	
	 }
	*/
	 public function cek_batch_bahan($cari) {
	 	// Query to check whether batch already exist or not
		$condition = "Nomor_Batch =" . "'" . $cari . "'";
		$this->db->select('*');
		$this->db->from('nomor_batch_bahan');
		$this->db->where($condition);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function get_id_bahan($cari) {
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