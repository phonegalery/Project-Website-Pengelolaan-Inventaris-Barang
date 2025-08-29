<?php

use Dompdf\Dompdf;
class Pemeliharaan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->data['aktif'] = 'pemeliharaan';
        $this->load->model('M_barang', 'm_barang');
        $this->load->model('M_divisi', 'm_divisi');
        $this->load->model('M_penerimaan', 'm_penerimaan');
        $this->load->model('M_detail_terima', 'm_detail_terima');
        $this->load->model('M_kategori', 'm_kategori');
        $this->load->model('M_toko', 'm_toko');
        $this->load->model('M_pemeliharaan', 'm_pemeliharaan');
        
    }


    public function index(){
        $this->data['title'] = 'Data Pemeliharaan';
        $this->data['all_pemeliharaan'] = $this->m_pemeliharaan->lihat();
        $this->data['no'] = 1;
        $this->data['toko'] = $this->m_toko->lihat();

        $this->load->view('pemeliharaan/lihat', $this->data);
    }
    
    public function tambah()
{
    // Cek role untuk akses
    if ($this->session->login['role'] == 'pengelola') {
        $this->session->set_flashdata('error', 'Tambah data hanya untuk petugas!');
        redirect('dashboard');
    }

    // Load model yang dibutuhkan
    $this->load->model('m_barang');
    $this->load->model('m_toko');

    // Ambil data dari database
    $this->data['barang'] = $this->m_barang->get_all_data(); // Data barang
    $this->data['toko'] = $this->m_toko->lihat(); // Data toko
    $this->data['petugas'] = $this->db->get('petugas')->result(); // Data petugas

    // Set judul halaman
    $this->data['title'] = 'Tambah Data Pemeliharaan';

    // Load view
    $this->load->view('pemeliharaan/tambah', $this->data);
}

    
    public function proses_tambah() {
        if ($this->session->login['role'] == 'pengelola') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }
    
        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'pegawai ' => $this->input->post('pegawai'),
            'jabatan ' => $this->input->post('jabatan'),
            'divisi ' => $this->input->post('divisi'),
            'tgl_barang_masuk' => $this->input->post('tgl_barang_masuk'),
            'kondisi_perangkat_terakhir' => $this->input->post('kondisi_perangkat_terakhir'),
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
            'petugas' => $this->input->post('petugas'),
            'tgl_pemeliharaan_selanjutnya' => $this->input->post('tgl_pemeliharaan_selanjutnya'),
            
        ];
    
        if ($this->m_pemeliharaan->tambah($data)) {
            $this->session->set_flashdata('success', 'Data Pemeliharaan <strong>Berhasil</strong> Ditambahkan!');
            redirect('pemeliharaan');
        } else {
            $this->session->set_flashdata('error', 'Data Pemeliharaan <strong>Gagal</strong> Ditambahkan!');
            redirect('pemeliharaan/tambah');
        }
    }
    
    
    public function ubah($kode_barang) {
        // Cek apakah user adalah admin
        if ($this->session->login['role'] == 'pengelola') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }
    
        
        $this->data['title'] = 'Ubah Data Pemeliharaan';
        $this->data['pemeliharaan'] = $this->m_pemeliharaan->lihat_id($kode_barang);
        if (!$this->data['pemeliharaan']) {
            show_404();
        }
    
        
        $this->data['data_petugas'] = $this->db->get('petugas')->result();
    
        
        $this->data['toko'] = $this->m_toko->lihat(); 
        $this->load->view('pemeliharaan/ubah', $this->data);
    }
    
    
    
    public function proses_ubah($kode_barang) {
        // Jika yang login adalah petugas, batasi akses
        if ($this->session->login['role'] == 'pengelola') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }

        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'pegawai ' => $this->input->post('pegawai'),
            'jabatan ' => $this->input->post('jabatan'),
            'divisi ' => $this->input->post('divisi'),
            'tgl_barang_masuk' => $this->input->post('tgl_barang_masuk'),
            'kondisi_perangkat_terakhir' => $this->input->post('kondisi_perangkat_terakhir'),
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
            'petugas' => $this->input->post('petugas'),
            'tgl_pemeliharaan_selanjutnya' => $this->input->post('tgl_pemeliharaan_selanjutnya'),
            
        ];
    
        if ($this->m_pemeliharaan->ubah($data, $kode_barang)) {
            $this->session->set_flashdata('success', 'Data Pemeliharaan <strong>Berhasil</strong> Diubah!');
            redirect('pemeliharaan');
        } else {
            $this->session->set_flashdata('error', 'Data Pemeliharaan <strong>Gagal</strong> Diubah!');
            redirect('pemeliharaan');
        }
    }
    public function hapus($kode_pemeliharaan) {
        // Jika yang login adalah petugas, batasi akses
        if ($this->session->login['role'] == 'pengelola') {
            $this->session->set_flashdata('error', 'Hapus data hanya untuk admin dan petugas!');
            redirect('dashboard');
        }

        if ($this->m_pemeliharaan->hapus($kode_pemeliharaan)) {
            $this->session->set_flashdata('success', 'Data Pemeliharaan <strong>Berhasil</strong> Dihapus!');
            redirect('pemeliharaan');
        } else {
            $this->session->set_flashdata('error', 'Data Pemeliharaan <strong>Gagal</strong> Dihapus!');
            redirect('pemeliharaan');
        }
    }

    public function get_data_barang() {
        
        $kode_barang = $this->input->post('kode_barang');

       
        $this->load->model('M_barang');

        
        $data = $this->M_barang->get_by_kode($kode_barang);

        
        if ($data) {
           
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
    

    public function getPetugasByName()
    {
        $nama_petugas = $this->input->post('petugas'); 
        $petugas = $this->db->get_where('petugas', ['nama' => $nama_petugas])->row();
    
        if ($petugas) {
            echo json_encode($petugas); 
        } else {
            echo json_encode(null); 
        }
    }
    
    public function updatePemeliharaan($id)
    {
        // Ambil data input dari form
        $kondisi_terakhir = $this->input->post('kondisi_perangkat_terakhir');
        $data_pemeliharaan = [
            'kode_barang' => $this->input->post('kode_barang'),
            'kondisi_perangkat_terakhir' => $kondisi_terakhir,
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
            'tanggal_pemeliharaan' => $this->input->post('tanggal_pemeliharaan'),
        ];
    
        // Ambil kondisi perangkat sebelumnya dari database
        $pemeliharaan_lama = $this->Pemeliharaan_model->getById($id);
    
        // Update data pemeliharaan
        $this->Pemeliharaan_model->update($id, $data_pemeliharaan);
    
        // Cek jika kondisi berubah dari "Butuh Perbaikan" menjadi "Sudah Diperbaiki"
        if ($pemeliharaan_lama['kondisi_perangkat_terakhir'] === 'Butuh Perbaikan' && $kondisi_terakhir === 'Sudah Diperbaiki') {
            $kode_barang = $data_pemeliharaan['kode_barang'];
    
            // Update jumlah perbaikan di tabel riwayat_barang
            $this->db->set('jumlah_perbaikan', 'jumlah_perbaikan + 1', FALSE);
            $this->db->where('kode_barang', $kode_barang);
            $this->db->update('riwayat_barang');
        }
    
        // Redirect atau tampilkan pesan sukses
        $this->session->set_flashdata('success', 'Data pemeliharaan berhasil diperbarui.');
        redirect('pemeliharaan');
    }
    
    
    public function export() {
        $data['all_pemeliharaan'] = $this->m_pemeliharaan->lihat();
        $data['title'] = '<h3><center>Laporan Data Pemeliharaan Barang</center></h3>';
        $data['no'] = 1;
    
        // Path ke logo perusahaan di folder uploads/gambar
        $logoPath = FCPATH . 'uploads/logo.png'; // Pastikan nama file logo adalah 'logo.png'
    
        // Validasi apakah file logo ada
        if (file_exists($logoPath)) {
            $data['base64Logo'] = 'data:image/' . pathinfo($logoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($logoPath));
        } else {
            $data['base64Logo'] = null; // Jika logo tidak ditemukan
        }
    
        // Load view report sebagai HTML
        $html = $this->load->view('pemeliharaan/report', $data, true);
    
        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', false); // Tidak perlu mengaktifkan remote karena menggunakan localhost
        $dompdf->setPaper('A4', 'landscape');
    
        // Masukkan HTML ke Dompdf
        $dompdf->loadHtml($html);
    
        // Render menjadi PDF
        $dompdf->render();
    
        // Output hasil PDF ke browser
        $dompdf->stream('Laporan_Data_Pemeliharaan_Inventaris_Barang_' . date('d_m_Y') . '.pdf', array("Attachment" => false));
    }
    

   
}
