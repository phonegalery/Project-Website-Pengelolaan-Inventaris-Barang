<?php

use Dompdf\Dompdf;

class Penerimaan extends CI_Controller{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->data['aktif'] = 'penerimaan';
        $this->load->model('M_barang', 'm_barang');
        $this->load->model('M_divisi', 'm_divisi');
        $this->load->model('M_penerimaan', 'm_penerimaan');
        $this->load->model('M_detail_terima', 'm_detail_terima');
        $this->load->model('M_toko', 'm_toko');
    }

    public function index(){
        $this->data['title'] = 'Transaksi Penerimaan';
        $this->data['all_penerimaan'] = $this->m_penerimaan->lihat();
        $this->data['no'] = 1;
        $this->data['toko'] = $this->m_toko->lihat();

        $this->load->view('penerimaan/lihat', $this->data);
    }

    public function tambah(){
        if ($this->session->login['role'] == 'petugas'){
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        $this->data['title'] = 'Tambah Transaksi';
    
        $this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('penerimaan/tambah', $this->data);
    }

    public function proses_tambah(){
        // Hanya admin yang bisa menambahkan barang
        if ($this->session->login['role'] == 'petugas'){
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        $data_terima = [
            'no_terima' => $this->input->post('no_terima'),
            'tgl_terima' => $this->input->post('tgl_terima'),
            'jam_terima' => $this->input->post('jam_terima'),
            'nama_barang' => $this->input->post('nama_barang'),
            'jenis_barang' => $this->input->post('jenis_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'supplier' => $this->input->post('supplier'),
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
        ];

        if ($this->m_penerimaan->tambah($data_terima)) {
            $this->session->set_flashdata('success', 'Penambahan <strong>Data Barang </strong> Berhasil Dibuat!');
            redirect('penerimaan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambah penerimaan');
            redirect('penerimaan/tambah');
        }
    }

    /**
     * FUNGSI UBAH - SUDAH BENAR
     * Menerima ID, mengambil data dari DB, dan menampilkannya di form
     */
    public function ubah($no_terima){
        if ($this->session->login['role'] == 'petugas'){
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }

        $this->data['title'] = 'Ubah Data Penerimaan';
        $this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
        $this->data['toko'] = $this->m_toko->lihat();

        $this->load->view('penerimaan/ubah', $this->data);
    }

    /**
     * FUNGSI PROSES_UBAH - TELAH DIPERBAIKI
     * Menerima ID, mengambil data dari form, dan memanggil model untuk update
     */
   /**
     * FUNGSI PROSES_UBAH - PERBAIKAN FINAL
     * Menerima ID, mengambil data dari form, dan memanggil model untuk update
     */
    public function proses_ubah($no_terima){
        // Memeriksa hak akses pengguna
        if ($this->session->login['role'] == 'petugas'){
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }

        // Menyiapkan array berisi data dari form yang akan diupdate
        $data_terima = [
            'nama_barang' => $this->input->post('nama_barang'),
            'jenis_barang' => $this->input->post('jenis_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'supplier' => $this->input->post('supplier'),
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
        ];

        // INI ADALAH BARIS YANG DIPERBAIKI (sebelumnya baris 102)
        // Memanggil fungsi ubah dari model dengan parameter yang benar:
        // 1. Array data yang akan diupdate ($data_terima)
        // 2. ID record yang akan diupdate ($no_terima)
        if ($this->m_penerimaan->ubah($data_terima, $no_terima)) {
            // Jika berhasil
            $this->session->set_flashdata('success', 'Data Penerimaan Barang <strong>Berhasil</strong> Diperbarui!');
            redirect('penerimaan');
        } else {
            // Jika gagal
            $this->session->set_flashdata('error', 'Data Penerimaan Barang <strong>Gagal</strong> Diperbarui!');
            redirect('penerimaan/ubah/' . $no_terima);
        }
    }

    public function detail($no_terima){
        $this->data['title'] = 'Detail Penerimaan';
        $this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
        $this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
        $this->data['no'] = 1;

        $this->load->view('penerimaan/detail', $this->data);
    }

    public function hapus($no_terima){
        if ($this->m_penerimaan->hapus($no_terima) && $this->m_detail_terima->hapus($no_terima)) {
            $this->session->set_flashdata('success', 'Data Penerimaan Barang <strong>Berhasil</strong> Dihapus!');
            redirect('penerimaan');
        } else {
            $this->session->set_flashdata('error', 'Invoice Penerimaan <strong>Gagal</strong> Dihapus!');
            redirect('penerimaan');
        }
    }

    public function get_all_barang(){
        $data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
        echo json_encode($data);
    }

    public function keranjang_barang(){
        $this->load->view('penerimaan/keranjang');
    }

    public function export(){
        $dompdf = new Dompdf();
        $this->data['all_penerimaan'] = $this->m_penerimaan->lihat();
        $this->data['title'] = 'Laporan Data Penerimaan Inventaris Barang';
        $this->data['no'] = 1;

        $dompdf->setPaper('A4', 'Landscape');
        $html = $this->load->view('penerimaan/report', $this->data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
    }

    public function export_detail($no_terima){
        $dompdf = new Dompdf();
        $this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
        $this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
        $this->data['title'] = 'Laporan Detail Penerimaan';
        $this->data['no'] = 1;

        $dompdf->setPaper('A4', 'Landscape');
        $html = $this->load->view('penerimaan/detail_report', $this->data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Detail Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
    }
}