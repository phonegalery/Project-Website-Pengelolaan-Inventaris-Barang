<?php
class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // Tambahkan pengecekan role pengelola
        if($this->session->login['role'] != 'petugas' && 
           $this->session->login['role'] != 'admin' && 
           $this->session->login['role'] != 'pengelola') {
            redirect(); // Redirect jika role tidak sesuai
        }
    
        $this->data['aktif'] = 'dashboard';
        $this->load->model('M_barang', 'm_barang');
        $this->load->model('M_customer', 'm_customer');
        $this->load->model('M_divisi', 'm_divisi');
        $this->load->model('M_petugas', 'm_petugas');
        $this->load->model('M_pengeluaran', 'm_pengeluaran');
        $this->load->model('M_penerimaan', 'm_penerimaan');
        $this->load->model('M_admin', 'm_admin');
        $this->load->model('M_pengelola', 'm_pengelola');
        $this->load->model('M_toko', 'm_toko');
        $this->load->model('M_pemeliharaan', 'm_pemeliharaan');
        $this->load->model('M_pengelola', 'm_pengelola');
        
    }
    

    public function index(){
        $this->data['title'] = 'Halaman Dashboard';
        $this->data['jumlah_barang'] = $this->m_barang->jumlah();
        $this->data['jumlah_customer'] = $this->m_customer->jumlah();
        $this->data['jumlah_divisi'] = $this->m_divisi->jumlah();
        $this->data['jumlah_petugas'] = $this->m_petugas->jumlah();
        $this->data['jumlah_admin'] = $this->m_admin->jumlah();
        $this->data['jumlah_pengeluaran'] = $this->m_pengeluaran->jumlah();
        $this->data['jumlah_penerimaan'] = $this->m_penerimaan->jumlah();
        $this->data['jumlah_admin'] = $this->m_admin->jumlah();
        $this->data['jumlah_jenis_barang'] = $this->m_barang->jumlah_jenis_barang(); 
        $this->data['jumlah_pengelola'] = $this->m_pengelola->jumlah();
        $this->data['jumlah_kondisi_perangkat_terakhir'] = $this->m_pemeliharaan->jumlah(); 
        
        $this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('dashboard', $this->data);
    }
}

