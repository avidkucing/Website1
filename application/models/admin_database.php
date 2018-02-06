<?php

Class Admin_database extends CI_Model {

	public function show_user() {
		$this->db->select('Username, Nama, Tipe_Pegawai');
		$this->db->from('akun');
		$query = $this->db->get()->result();

		return $query;
	}

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

	public function insert_manu_bahan_baku($data) {
		$this->db->insert('manufaktur_bahan', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function insert_supp_bahan_baku($data) {
		$this->db->insert('supplier_bahan', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_data_user($data) {
	    $this->db->select('*');
	    $this->db->from('akun');
	    $this->db->where("Username", $data);
	    
	    return $this->db->get()->result();
	}

	public function update_data_user($data) {
		$this->db->where('Username', $data['Username']);
		$this->db->update('akun', $data);
	}

}

?>