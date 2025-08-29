<?php

use Dompdf\Dompdf;

class Divisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin') {
            redirect();
        }
        $this->load->model('M_divisi', 'm_divisi');
        $this->load->model('M_toko', 'm_toko');
        $this->data['aktif'] = 'divisi';
    }

    public function index()
    {
        $this->data['title'] = 'Data Divisi';
        $this->data['all_divisi'] = $this->m_divisi->lihat();
        $this->data['no'] = 1;
        $this->data['toko'] = $this->m_toko->lihat();

        $this->load->view('divisi/lihat', $this->data);
    }

    public function tambah()
    {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        $this->data['title'] = 'Tambah Divisi';
        $this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('divisi/tambah', $this->data);
    }

    public function proses_tambah()
    {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        $data = [
            'nama_divisi' => $this->input->post('nama_divisi'),
            'kepala_divisi' => $this->input->post('kepala_divisi'),
            'jumlah_barang' => $this->input->post('jumlah_barang'),
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
        ];

        if ($this->m_divisi->tambah($data)) {
            $this->session->set_flashdata('success', 'Data divisi <strong>Berhasil</strong> Ditambahkan!');
            redirect('divisi');
        } else {
            $this->session->set_flashdata('error', 'Data divisi <strong>Gagal</strong> Ditambahkan!');
            redirect('divisi');
        }
    }

    public function ubah($id)
    {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }

        $this->data['title'] = 'Ubah Data Divisi';
        $this->data['divisi'] = $this->m_divisi->get_by_id($id);

        if (!$this->data['divisi']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            redirect('divisi');
        }
		$this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('divisi/ubah', $this->data);
    }

    public function proses_ubah($id)
    {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }

        $data = [
            'nama_divisi' => $this->input->post('nama_divisi'),
            'kepala_divisi' => $this->input->post('kepala_divisi'),
            'jumlah_barang' => $this->input->post('jumlah_barang'),
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
        ];

        if ($this->m_divisi->ubah($data, $id)) {
            $this->session->set_flashdata('success', 'Data divisi <strong>Berhasil</strong> Diubah!');
            redirect('divisi');
        } else {
            $this->session->set_flashdata('error', 'Data divisi <strong>Gagal</strong> Diubah!');
            redirect('divisi');
        }
    }

    public function hapus($id)
    {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
            redirect('dashboard');
        }

        if ($this->m_divisi->hapus($id)) {
            $this->session->set_flashdata('success', 'Data divisi <strong>Berhasil</strong> Dihapus!');
            redirect('divisi');
        } else {
            $this->session->set_flashdata('error', 'Data divisi <strong>Gagal</strong> Dihapus!');
            redirect('divisi');
        }
    }

    public function export()
    {
        $dompdf = new Dompdf();
        $this->data['all_divisi'] = $this->m_divisi->lihat();
        $this->data['title'] = 'Laporan Data Divisi';
        $this->data['no'] = 1;

        $dompdf->setPaper('A4', 'Landscape');
        $html = $this->load->view('divisi/report', $this->data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Data Divisi Tanggal ' . date('d F Y'), array("Attachment" => false));
    }
}
