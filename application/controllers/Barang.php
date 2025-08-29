<?php

use Dompdf\Dompdf;

class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (
			$this->session->login['role'] != 'petugas' &&
			$this->session->login['role'] != 'admin' &&
			$this->session->login['role'] != 'pengelola'
		) {
			redirect();
		}
		$this->data['aktif'] = 'barang';

		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_kategori', 'm_kategori');
		$this->load->model('M_toko', 'm_toko');
		$this->load->model('M_riwayat', 'm_riwayat');
	}

	public function index()
	{
		$this->data['title'] = 'Data Barang';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['all_kategori'] = $this->m_kategori->lihat();
		$this->data['toko'] = $this->m_toko->lihat();
		$this->data['no'] = 1;

		$this->load->view('barang/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Barang';
		$this->data['kategori'] = $this->m_kategori->lihat();
		$this->data['toko'] = $this->m_toko->lihat();

		// Mengambil data jabatan dan divisi
		$this->data['all_jabatan'] = $this->db->get('jabatan')->result();
		$this->data['all_divisi'] = $this->db->get('divisi')->result();

		$this->load->view('barang/tambah', $this->data);
	}

	public function proses_tambah()
	{
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
			'tgl_masuk' => $this->input->post('tanggal_masuk'),
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

	public function ubah($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		$this->data['kategori'] = $this->m_kategori->lihat();
		$this->data['selected_kategori'] = $this->data['barang']->jenis_barang;
		$this->data['toko'] = $this->m_toko->lihat();

		$this->data['all_jabatan'] = $this->db->get('jabatan')->result();
		$this->data['all_divisi'] = $this->db->get('divisi')->result();

		$this->load->view('barang/ubah', $this->data);
	}

	public function proses_ubah($kode_barang)
	{
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
			'tgl_masuk' => $this->input->post('tanggal_masuk'),
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


	public function hapus($kode_barang)
	{
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

	public function get_data_barang()
	{
		header('Content-Type: application/json');
		$kode_barang = $this->input->post('kode_barang');

		if (!$kode_barang || !preg_match('/^[a-zA-Z0-9]+$/', $kode_barang)) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Kode perangkat tidak valid'
			]);
			exit;
		}

		$data = $this->m_barang->get_by_kode($kode_barang);

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

		exit;
	}

	public function riwayat($kode_barang)
	{
		// ... kode fungsi riwayat
	}

	public function export()
{
    // 1. Ambil kode kategori yang dipilih dari URL (GET parameter)
    $kode_kategori = $this->input->get('kode_kategori');

    $dompdf = new Dompdf();
    $this->data['no'] = 1;
    $kategori_info = null; // Definisikan variabel di awal

    // 2. Logika untuk menentukan data barang yang akan diekspor
    if ($kode_kategori && $kode_kategori != 'semua') {
        // Jika ada kategori spesifik yang dipilih
        $this->data['all_barang'] = $this->m_barang->lihat_by_kategori($kode_kategori);
        $kategori_info = $this->m_kategori->get_kategori($kode_kategori);
        $this->data['title'] = 'Laporan Data Barang Kategori ' . ($kategori_info ? $kategori_info->nama_kategori : 'Tidak Ditemukan');
    } else {
        // Jika pengguna memilih "Semua Data" atau tidak memilih sama sekali
        $this->data['all_barang'] = $this->m_barang->lihat();
        $this->data['title'] = 'Laporan Semua Data Barang';
    }

    // 3. Set ukuran kertas dan orientasi
    $dompdf->setPaper('A4', 'landscape');

    // 4. Generate HTML dari view (pastikan file report untuk barang sudah ada)
    $html = $this->load->view('barang/report', $this->data, true);

    // 5. Proses untuk menghasilkan file PDF
    $dompdf->loadHtml($html);
    $dompdf->set_option('isRemoteEnabled', true); // Penting untuk memuat gambar
    $dompdf->render();

    // 6. Nama file dinamis dan stream PDF ke browser
    $nama_kategori_untuk_file = 'Semua_Kategori'; // Nilai default
    if ($kode_kategori && $kode_kategori != 'semua' && $kategori_info) {
        // Ganti spasi dengan underscore untuk nama file yang bersih
        $nama_kategori_untuk_file = str_replace(' ', '_', $kategori_info->nama_kategori);
    }
    
    $nama_file = 'Laporan_Barang_' . $nama_kategori_untuk_file . '_' . date('d-m-Y') . '.pdf';
    $dompdf->stream($nama_file, ['Attachment' => false]);
}


}