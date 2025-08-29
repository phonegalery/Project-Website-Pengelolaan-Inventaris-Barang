<?php
class M_kategori extends CI_Model {
    
    public function lihat(){
        // Mengurutkan berdasarkan data terbaru di atas
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('kategori')->result();
    }

    public function jumlah($kode_kategori = null)
    {
        if (!empty($kode_kategori)) {
            $this->db->where('kode_kategori', $kode_kategori);
        }
        return $this->db->count_all_results('kategori');
    }

    public function lihat_kode_kategori($kode_kategori) {
        return $this->db->get_where('kategori', ['kode_kategori' => $kode_kategori])->row();
    }

    public function tambah($data){
        return $this->db->insert('kategori', $data);
    }

    public function hapus($kode_kategori){
        return $this->db->delete('kategori', ['kode_kategori' => $kode_kategori]);
    }

    public function ubah($data, $kode_kategori) {
        $this->db->where('kode_kategori', $kode_kategori);
        return $this->db->update('kategori', $data);
    }

    public function get_kategori($kode_kategori) {
        return $this->db->get_where('kategori', ['kode_kategori' => $kode_kategori])->row();
    }
  

    public function updateJumlah($kode_kategori) {
        
        $this->db->select('COUNT(*) as jumlah');
        $this->db->where('kode_kategori', $kode_kategori);
        $query = $this->db->get('barang'); 
        $result = $query->row();
    

        $this->db->set('jumlah', $result->jumlah);
        $this->db->where('kode_kategori', $kode_kategori);
        $this->db->update('kategori');
    }
    
    
}
