<?php
class M_barang extends CI_Model {
    protected $_table = 'barang';
public function lihat() {
    // Mengurutkan berdasarkan kolom waktu (data terbaru di atas)
    $this->db->order_by('created_at', 'DESC'); // <-- INI YANG BARU
    $query = $this->db->get($this->_table);
    return $query->result();
}
    public function jumlah() {
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }

    public function lihat_id($kode_barang) {
        $query = $this->db->get_where($this->_table, ['kode_barang' => $kode_barang]);
        return $query->row();
    }

    public function lihat_by_kategori($kode_kategori) {

    $query = $this->db->get_where($this->_table, ['kode_kategori' => $kode_kategori]);
    return $query->result();
}

    public function lihat_nama_perangkat($nama_perangkat) {
        $query = $this->db->select('*');
        $query = $this->db->where(['nama_perangkat' => $nama_perangkat]);
        $query = $this->db->get($this->_table);
        return $query->row();
    }

    public function tambah($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function ubah($data, $kode_barang) { 
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->update($this->_table, $data);
    }

    public function hapus($kode_barang) {
        return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
    }

    public function get_kategori() {
        return $this->db->get('kategori')->result();
    }

    public function jumlah_jenis_barang() {
        $this->db->select('jenis_barang, COUNT(*) as jumlah');
        $this->db->group_by('jenis_barang');
        return $this->db->get($this->_table)->result();
    }


   
    public function get_total_by_kategori($kode_kategori) {
        $this->db->select_sum('jumlah');
        $this->db->where('kode_kategori', $kode_kategori);
        $result = $this->db->get('barang')->row();
        return $result->jumlah ?? 0; 
    }

public function get_all_data()
{
    return $this->db->get('barang')->result();
}


public function get_by_jenis_barang($jenis_barang)
{
    $this->db->where('jenis_barang', $jenis_barang);
    return $this->db->get('barang')->result();
}

public function get_by_kode($kode_barang) {
    $this->db->where('kode_barang', $kode_barang);
    return $this->db->get('barang')->row();
}

public function getByKodeBarang($kode_barang, $table = 'pemeliharaan')
{
    return $this->db->get_where($table, ['kode_barang' => $kode_barang])->result();
}


    }
        