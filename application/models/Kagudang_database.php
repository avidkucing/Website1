<?php

Class Kagudang_database extends CI_Model {


	public function homepage() {
		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Supplier, bahan_terima.Nama_Manufacturer, jenis_bahan.Satuan');
 		$this->db->from('bahan_terima');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->where("jenis_bahan.Jenis", "Baku");
 		$this->db->order_by('Nomor_LPB', 'asc');
 		
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