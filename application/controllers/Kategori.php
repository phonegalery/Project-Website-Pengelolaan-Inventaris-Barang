<?php

use Dompdf\Dompdf;
class Kategori extends CI_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->data['aktif'] = 'kategori';
        $this->load->model('M_barang', 'm_barang');
        $this->load->model('M_divisi', 'm_divisi');
        $this->load->model('M_penerimaan', 'm_penerimaan');
        $this->load->model('M_detail_terima', 'm_detail_terima');
        $this->load->model('M_kategori', 'm_kategori');
        $this->load->model('M_toko', 'm_toko');
    }

    
    public function index() {
        $this->data['title'] = 'Data Kategori';
        $this->data['all_kategori'] = $this->m_kategori->lihat();
        $this->data['no'] = 1;
        $this->data['toko'] = $this->m_toko->lihat();

        $this->load->view('kategori/lihat', $this->data);
    }

    public function tambah() {
        // Jika yang login adalah petugas, batasi akses
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        $this->data['title'] = 'Tambah Data Kategori';
        $this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('kategori/tambah', $this->data);
    }

    public function proses_tambah() {
        // Hanya admin yang bisa menambahkan data
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        // Ambil data dari form input
        $kodeKategori = $this->input->post('kode_kategori');
        $namaKategori = $this->input->post('nama_kategori');
        $dibuatTgl = $this->input->post('dibuat_tgl');

        // Hitung jumlah stok barang berdasarkan nama kategori
        $jumlah = $this->m_kategori->updateJumlah($kode_kategori);

        // Data yang akan disimpan
        $data_terima = [
            'kode_kategori' => $kodeKategori,
            'nama_kategori' => $namaKategori,
            'jumlah' => $jumlah,  // Diisi otomatis dari perhitungan
            'dibuat_tgl' => $dibuatTgl,
        ];

        // Proses penyimpanan ke database
        if ($this->m_kategori->tambah($data_terima)) {
            $this->session->set_flashdata('success', 'Penambahan <strong>Data Kategori</strong> Berhasil Dibuat!');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambah kategori');
            redirect('kategori/tambah');
        }
    }

    public function ubah($kode_kategori) {
        // Jika yang login adalah petugas, batasi akses
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }

        $this->data['title'] = 'Ubah Kategori';
        $this->data['kategori'] = $this->m_kategori->lihat_kode_kategori($kode_kategori);
        $this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('kategori/ubah', $this->data);
    }

    public function proses_ubah($kode_kategori) {
        // Jika yang login adalah petugas, batasi akses
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }

        $data = [
            'kode_kategori' => $this->input->post('kode_kategori'),
            'nama_kategori' => $this->input->post('nama_kategori'),
            'jumlah' => $this->input->post('jumlah'),
            'dibuat_tgl' => $this->input->post('dibuat_tgl'),
        ];

        if ($this->m_kategori->ubah($data, $kode_kategori)) {
            $this->session->set_flashdata('success', 'Data Kategori <strong>Berhasil</strong> Diubah!');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error', 'Data Kategori <strong>Gagal</strong> Diubah!');
            redirect('kategori');
        }   
    }

    public function hapus($kode_kategori) {
        // Jika yang login adalah petugas, batasi akses
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
            redirect('dashboard');
        }

        if ($this->m_kategori->hapus($kode_kategori)) {
            $this->session->set_flashdata('success', 'Data Kategori <strong>Berhasil</strong> Dihapus!');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error', 'Data Kategori <strong>Gagal</strong> Dihapus!');
            redirect('kategori');
        }
    }



	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_kategori'] = $this->m_kategori->lihat();
		$this->data['title'] = 'Laporan Data Kategori Inventaris Barang';
		$this->data['no'] = 1;
	
		// Set ukuran kertas dan orientasi
		$dompdf->setPaper('A4', 'Landscape');
		
		// Generate HTML dari view dan data yang ada
		$html = $this->load->view('kategori/report', $this->data, true);
		
		// Proses untuk menghasilkan file PDF
		$dompdf->load_html($html);
		$dompdf->render();
		
		// Stream PDF ke browser
		$dompdf->stream('Laporan Data Kategori Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
	
	
}
