<?php

class M_divisi extends CI_Model
{
    protected $_table = 'divisi';

    public function lihat()
    {
        return $this->db->get($this->_table)->result();
    }

    public function jumlah()
    {
        return $this->db->get($this->_table)->num_rows();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function ubah($data, $id)
    {
        return $this->db->where('id', $id)->update($this->_table, $data);
    }

    public function hapus($id)
    {
        return $this->db->delete($this->_table, ['id' => $id]);
    }
}
	