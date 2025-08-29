<?php
class M_pemeliharaan extends CI_Model {
    private $_table = 'pemeliharaan'; 

   
   public function lihat(){
    // Mengurutkan berdasarkan waktu data dimasukkan
 $this->db->order_by('created_at', 'DESC'); 
 return $this->db->get($this->_table)->result();
}

   
    public function lihat_id($kode_barang) {
        $query = $this->db->get_where($this->_table, ['kode_barang' => $kode_barang]);
        return $query->row();
    }

    
    public function jumlah() {
        $this->db->select('kondisi_perangkat_terakhir, COUNT(*) as jumlah');
        $this->db->from($this->_table);
        $this->db->group_by('kondisi_perangkat_terakhir');
        $query = $this->db->get();
        return $query->result(); 
    }

    
    public function tambah($data){
        return $this->db->insert($this->_table, $data);
    }

   
    public function ubah($data, $kode_barang) {
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->update($this->_table, $data);
    }

   
    public function hapus($kode_barang) {
        return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
    }

   
    public function get_by_kode($kode_barang) {
        $this->db->where('kode_barang', $kode_barang);
        $query = $this->db->get('barang');
        return $query->row_array();
    }
}
