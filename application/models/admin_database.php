<?php

Class Admin_Database extends CI_Model {

	// Insert registration data in database
	public function registration_insert($data) {

		// Query to check whether username already exist or not
		$condition = "Username =" . "'" . $data['Username'] . "'";
		$this->db->select('*');
		$this->db->from('akun');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {

			// Query to insert data in database
			$this->db->insert('akun', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function insert_bahan_baku($data) {
		$this->db->insert('jenis_bahan', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function insert_param_bahan_baku($data) {
		$this->db->insert('parameter_bahan', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}	
	}

}

?>