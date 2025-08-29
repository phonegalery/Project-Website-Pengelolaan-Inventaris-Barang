<?php

class M_admin extends CI_Model{
	protected $_table = 'admin';
	public function lihat() {
		// Mengurutkan berdasarkan kolom waktu (data terbaru di atas)
		$this->db->order_by('created_at', 'DESC'); // <-- INI YANG BARU
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}

	public function simpan_admin($data){
		$this->db->insert('admin', $data); // Simpan ke tabel 'admin'
	}

	// Fungsi untuk mencari admin berdasarkan username
	public function lihat_username($username){
		return $this->db->get_where('admin', ['username' => $username])->row();
	}
	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id){
		return $this->db->delete($this->_table, ['id' => $id]);
	}
}