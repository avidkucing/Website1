<?php

Class Login_database extends CI_Model {
       
	// Read data using username and password
	public function login($data) {

		$condition = "Username =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('akun');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($username) {

		$condition = "Username =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('akun');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

}

?>