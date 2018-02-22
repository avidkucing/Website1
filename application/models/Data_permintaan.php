 <?php

Class Data_permintaan extends CI_Model {
	public function load() {
		$data['permintaan_baku'] = $this->permintaan_baku();
 		return $data;
	}

	public function permintaan_baku(){
 		$this->db->select('*');
 		$this->db->from('permintaan_bahan');
 		$this->db->order_by('Nomor_Instruksi', 'desc');
 		
 		$query = $this->db->get()->result();

 		$this->ubah_format_tanggal($query);

		return $query; 
 	}

 	public function get_data_permintaan($data) {
 		$this->db->select('*');
	    $this->db->from('permintaan_bahan');
	    $this->db->where("Nomor_Instruksi", $data);

	    $query = $this->db->get()->result();
	    
	    $this->ubah_format_tanggal($query);

		return $query;
 	}

 	public function update_data_permintaan($data) {
 		$this->db->where('Nomor_Instruksi', $data['Nomor_Instruksi']);
		$this->db->update('permintaan_bahan', $data);
 	}

 	public function delete_permintaan($data) {
 		$this->db->where('Nomor_Instruksi', $data['Nomor_Instruksi']);
		$this->db->delete('permintaan_bahan');
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