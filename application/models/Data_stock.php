 <?php

Class Data_stock extends CI_Model {
	public function load() {
		$data['stock_baku'] = $this->stock_baku();
		$data['stock_kemas'] = $this->stock_kemas();
 		return $data;
	}

	public function stock_baku(){
 		$this->db->select('analisa_sampel.Nomor_Analisa, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Manufacturer, nomor_batch_bahan.EXP_Date, nomor_batch_bahan.Jumlah, nomor_batch_bahan.Keterangan, bahan_terima.Nomor_LPB, nomor_batch_bahan.ID_Batch');
 		$this->db->from('nomor_batch_bahan');
 		$this->db->join('bahan_terima', 'bahan_terima.Nomor_LPB = nomor_batch_bahan.Nomor_LPB', 'inner');
 		$this->db->join('analisa_sampel', 'nomor_batch_bahan.ID_Batch = analisa_sampel.ID_Batch', 'inner');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->order_by('Nomor_Analisa desc');
 		$this->db->where("nomor_batch_bahan.Status", "RELEASE");
 		$this->db->where("jenis_bahan.Jenis", "Baku");
 		
 		$o_lpb_rows = $this->db->get()->result();

 		$this->ubah_format_tanggal($o_lpb_rows);
 		
 		return $o_lpb_rows;	
 	}

 	public function stock_kemas(){
 		$this->db->select('analisa_sampel.Nomor_Analisa, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Manufacturer, nomor_batch_bahan.EXP_Date, nomor_batch_bahan.Jumlah, nomor_batch_bahan.Keterangan, bahan_terima.Nomor_LPB, nomor_batch_bahan.ID_Batch');
 		$this->db->from('nomor_batch_bahan');
 		$this->db->join('bahan_terima', 'bahan_terima.Nomor_LPB = nomor_batch_bahan.Nomor_LPB', 'inner');
 		$this->db->join('analisa_sampel', 'nomor_batch_bahan.ID_Batch = analisa_sampel.ID_Batch', 'inner');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->order_by('Nomor_Analisa desc');
 		$this->db->where("nomor_batch_bahan.Status", "RELEASE");
 		$this->db->where("jenis_bahan.Jenis", "Kemas");
 		
 		$o_lpb_rows = $this->db->get()->result();

 		$this->ubah_format_tanggal($o_lpb_rows);
 		
 		return $o_lpb_rows;	
 	}

 	public function get_data_stock($data) {
 		$this->db->select('analisa_sampel.Nomor_Analisa, jenis_bahan.Kode_Bahan, bahan_terima.Nama_Manufacturer, nomor_batch_bahan.EXP_Date, nomor_batch_bahan.Jumlah, nomor_batch_bahan.Keterangan, bahan_terima.Nomor_LPB, nomor_batch_bahan.ID_Batch');
 		$this->db->from('nomor_batch_bahan');
 		$this->db->join('bahan_terima', 'bahan_terima.Nomor_LPB = nomor_batch_bahan.Nomor_LPB', 'inner');
 		$this->db->join('analisa_sampel', 'nomor_batch_bahan.ID_Batch = analisa_sampel.ID_Batch', 'inner');
 		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
 		$this->db->where("nomor_batch_bahan.Status", "RELEASE");
 		//$this->db->where("nomor_batch_bahan.Nomor_LPB", $data);
 		
 		$o_lpb_rows = $this->db->get()->result();

 		$this->ubah_format_tanggal($o_lpb_rows);
 		
 		return $o_lpb_rows;	
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