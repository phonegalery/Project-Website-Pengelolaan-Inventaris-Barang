<?php

use Dompdf\Dompdf;

class Riwayat extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if (
            $this->session->login['role'] != 'petugas' && 
            $this->session->login['role'] != 'admin' && 
            $this->session->login['role'] != 'pengelola'
        ) {
            redirect();
        }
        $this->data['aktif'] = 'riwayat';

        $this->load->model('M_riwayat', 'm_riwayat');
        $this->load->model('M_kategori', 'm_kategori');
        $this->load->model('M_toko', 'm_toko');
    }

    public function index() {
        $this->data['title'] = 'Data Riwayat';
        $this->data['all_riwayat'] = $this->m_riwayat->lihat();
       // $this->data['jenis_barang'] = $this->m_kategori->lihat();
        $this->data['toko'] = $this->m_toko->lihat();
        $this->data['no'] = 1;

        $this->load->view('barang/lihat', $this->data);
    }

    public function tambah() {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        $this->data['title'] = 'Tambah Barang';
        $this->data['kategori'] = $this->m_kategori->lihat();
        $this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('barang/tambah', $this->data);
    }

    public function proses_tambah() {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('dashboard');
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 15000;
        $config['file_name'] = time() . '_' . $_FILES['gambar_barang']['name'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar_barang')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('barang/tambah');
        } else {
            $uploadData = $this->upload->data();
            $gambar_barang = $uploadData['file_name'];
        }

        $kode_kategori = $this->input->post('kode_kategori');
        $kategori = $this->m_kategori->get_kategori($kode_kategori);

        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'jenis_barang' => $kategori->nama_kategori,
            'pegawai' => $this->input->post('pegawai'),
            'jabatan' => $this->input->post('jabatan'),
            'divisi' => $this->input->post('divisi'),
            'status' => $this->input->post('status'),
            'merk' => $this->input->post('merk'),
            'type' => $this->input->post('type'),
            'kondisi' => $this->input->post('kondisi'),
            'kode_kategori' => $kode_kategori,
            'gambar_barang' => $gambar_barang,
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
        ];

        if ($this->m_barang->tambah($data)) {
            $this->m_kategori->updateJumlah($data['kode_kategori']);
            $this->session->set_flashdata('success', 'Data Barang berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Data Barang gagal ditambahkan.');
        }

        redirect('barang');
    }

    public function ubah($kode_barang) {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('dashboard');
        }
    
        $this->data['title'] = 'Riwayat Barang';
        $this->data['barang'] = $this->m_barang->lihat_id($kode_barang);
    
        $this->data['kategori'] = $this->m_kategori->lihat();
        $this->data['selected_kategori'] = $this->data['barang']->jenis_barang;
        $this->data['toko'] = $this->m_toko->lihat();
        $this->load->view('barang/ubah', $this->data);
    }
    
    public function proses_ubah($kode_barang) {
        $kode_kategori = $this->input->post('kode_kategori');
        $kategori = $this->m_kategori->get_kategori($kode_kategori);
    
        if (!$kategori) {
            $this->session->set_flashdata('error', 'Kategori tidak valid.');
            redirect('barang/ubah/' . $kode_barang);
        }
    
        $gambar_lama = $this->input->post('gambar_lama');
        if (!empty($_FILES['gambar_barang']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 15000;
            $config['file_name'] = time() . '_' . $_FILES['gambar_barang']['name'];
    
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar_barang')) {
                $uploadData = $this->upload->data();
                $gambar_barang = $uploadData['file_name'];
                if ($gambar_lama && file_exists('./uploads/' . $gambar_lama)) {
                    unlink('./uploads/' . $gambar_lama);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('barang/ubah/' . $kode_barang);
            }
        } else {
            $gambar_barang = $gambar_lama;
        }
    
        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'jenis_barang' => $kategori->nama_kategori,
            'pegawai' => $this->input->post('pegawai'),
            'jabatan' => $this->input->post('jabatan'),
            'divisi' => $this->input->post('divisi'),
            'status' => $this->input->post('status'),
            'merk' => $this->input->post('merk'),
            'type' => $this->input->post('type'),
            'kondisi' => $this->input->post('kondisi'),
            'kode_kategori' => $kode_kategori,
            'gambar_barang' => $gambar_barang,
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
        ];
    
        $barang_lama = $this->m_barang->lihat_id($kode_barang);
        $kode_kategori_lama = $barang_lama->kode_kategori;
    
        if ($this->m_barang->ubah($data, $kode_barang)) {
            if ($kode_kategori_lama != $data['kode_kategori']) {
                $this->m_kategori->updateJumlah($kode_kategori_lama);
            }
            $this->m_kategori->updateJumlah($data['kode_kategori']);
    
            $this->session->set_flashdata('success', 'Data Barang berhasil Diubah!');
            redirect('barang');
        } else {
            $this->session->set_flashdata('error', 'Barang gagal diubah.');
            redirect('barang');
        }
    }
    
    public function hapus($kode_barang) {
        if ($this->session->login['role'] == 'petugas') {
            $this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
            redirect('dashboard');
        }

        $barang = $this->m_barang->lihat_id($kode_barang);

        if ($this->m_barang->hapus($kode_barang)) {
            $this->m_kategori->updateJumlah($barang->kode_kategori);
            $this->session->set_flashdata('success', 'Barang berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Barang gagal dihapus.');
        }

        redirect('barang');
    }

    
    public function get_data_barang() {
        // Pastikan konten response adalah JSON
        header('Content-Type: application/json');
    
        // Ambil data dari POST
        $kode_barang = $this->input->post('kode_barang');
    
        // Validasi input
        if (!$kode_barang || !preg_match('/^[a-zA-Z0-9]+$/', $kode_barang)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kode perangkat tidak valid'
            ]);
            exit;
        }
    
        // Ambil data perangkat dari model
        $data = $this->m_barang->get_by_kode($kode_barang);
    
        // Cek apakah data ditemukan
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
    
        // Hentikan eksekusi setelah memberikan respons
        exit;
    }
    

    public function export() {
        $jenis_barang = $this->input->get('jenis_barang');

        if (!$jenis_barang) {
            show_error('Parameter jenis perangkat tidak tersedia.', 400, 'Bad Request');
        }

        if ($jenis_barang === 'all') {
            $all_barang = $this->m_barang->get_all_data();
        } else {
            $all_barang = $this->m_barang->get_by_jenis_barang($jenis_barang);
        }

        if (empty($all_barang)) {
            show_error('Data tidak ditemukan untuk jenis perangkat tersebut.', 404, 'Not Found');
        }

        foreach ($all_barang as $barang) {
            if (!empty($barang->gambar_barang) && file_exists('./uploads/' . $barang->gambar_barang)) {
                $barang->base64Image = 'data:image/' . pathinfo($barang->gambar_barang, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents('./uploads/' . $barang->gambar_barang));
            } else {
                $barang->base64Image = null;
            }
        }

        $data['all_barang'] = $all_barang;
        $data['jenis_barang'] = $jenis_barang === 'all' ? 'Semua Data Barang' : $jenis_barang;
        $data['title'] = 'Laporan Barang';

        $html = $this->load->view('barang/report', $data, true);
        $dompdf = new Dompdf();

        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);

        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();

        $filename = 'Laporan_' . str_replace(' ', '_', $data['jenis_barang']) . '_' . date('d_m_Y') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => false]);
    }


    
    public function generate_pdf() {
        $all_barang = $this->Barang_model->get_all_barang(); 
        foreach ($all_barang as $index => $barang) {
            
            $imagePath = FCPATH . 'uploads/' . $barang->gambar_barang;
    
            
            echo "Path gambar: " . $imagePath . "<br>";
    
            
            if (!file_exists($imagePath)) {
                echo "File tidak ditemukan: " . $imagePath . "<br>"; 
                $barang->base64Image = null;
            } else {
                // Baca file gambar
                $imageData = file_get_contents($imagePath);
                if ($imageData !== false) {
                    // Encode gambar ke Base64
                    $base64String = base64_encode($imageData);
                    $barang->base64Image = 'data:image/png;base64,' . $base64String;
                } else {
                    echo "Gagal membaca file gambar: " . $imagePath . "<br>"; // 
                    $barang->base64Image = null;
                }
            }
        }
    
      
        $data['all_barang'] = $all_barang;
        $data['title'] = "Laporan Barang";
    
        
        $this->load->view('laporan/pdf', $data);
    }
    
    

}