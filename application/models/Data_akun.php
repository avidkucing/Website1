 <?php

Class Data_akun extends CI_Model {
	public function load() {
		$data['akun'] = $this->all_akun();
 		return $data;
	}

	public function all_akun(){
 		$this->db->select('Username, Nama, Tipe_Pegawai');
		$this->db->from('akun');
		$query = $this->db->get()->result();

		return $query;
 	}
}
?>