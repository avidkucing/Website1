<?php

Class Qc_Database extends CI_Model {

	//show data List pemeriksaan sampel (LPS)
	public function homepage() {
		$this->db->select('bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, jenis_bahan.Satuan');
		$this->db->from('bahan_terima');
		$this->db->join('jenis_bahan', 'bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan', 'inner');
		//$query = $this->db->query('SELECT bahan_terima.Nomor_LPB/*nomor*/, bahan_terima.Nomor_LPB, bahan_terima.Tanggal_Terima, jenis_bahan.Kode_Bahan, bahan_terima.Nomor_LPB/*batch*/, jenis_bahan.Nama_Supplier, jenis_bahan.Nama_Manufacturer, bahan_terima.Jumlah, jenis_bahan.Satuan, bahan_terima.Status FROM bahan_terima INNER JOIN jenis_bahan ON bahan_terima.ID_Bahan = jenis_bahan.ID_Bahan');
		$o_lps_rows = $this->db->get()->result();

		$a_lps_rows = json_decode(json_encode($o_lps_rows), True);
		return $a_lps_rows;
	}

}

?>