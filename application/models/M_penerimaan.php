p<?php
class M_penerimaan extends CI_Model {
    
    public function lihat(){
        $this->db->select('*');
        $this->db->from('penerimaan');
        // Mengurutkan berdasarkan data terbaru di atas
        $this->db->order_by('created_at', 'DESC')   ;
        $this->db->group_by('no_terima');
        return $this->db->get()->result();
    }

    public function jumlah() {
        
        return $this->db->count_all('penerimaan');
    }
    

    public function lihat_no_terima($no_terima){
        return $this->db->get_where('penerimaan', ['no_terima' => $no_terima])->row();
    }

    public function tambah($data){
        return $this->db->insert('penerimaan', $data);
    }
    public function ubah($data, $no_terima) {
        $this->db->where('no_terima', $no_terima);
        return $this->db->update('penerimaan', $data);
    }

    public function hapus($no_terima){
        return $this->db->delete('penerimaan', ['no_terima' => $no_terima]);
    }
}

