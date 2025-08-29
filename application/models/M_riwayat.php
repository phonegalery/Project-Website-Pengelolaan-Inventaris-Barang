<?php

class M_riwayat extends CI_Model {
	protected $_table = 'barang';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_kode_barang($kode_barang){
		return $this->db->get_where($this->_table, [' kode_barang' => $kode_barang])->result();
	}

	public function hapus($kode_barang){
		return $this->db->delete($this->_table, [' kode_barang' => $kode_barang]);
	}

	 public function getByKodeBarang($kode_barang)
    {
        $query = $this->db->get_where('riwayat_barang', ['kode_barang' => $kode_barang]);
        return $query->result(); // Pastikan ini mengembalikan array
    }

}