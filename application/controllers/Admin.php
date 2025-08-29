<?php

use Dompdf\Dompdf;

class admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'admin';
		$this->load->model('m_admin', 'm_admin');
		$this->load->model('M_toko', 'm_toko');
	}

	public function index(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Managemen admin hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Data admin';
		$this->data['all_admin'] = $this->m_admin->lihat();
		$this->data['no'] = 1;
		$this->data['toko'] = $this->m_toko->lihat();

		$this->load->view('admin/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah admin';
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('admin/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		];

		if($this->m_admin->tambah($data)){
			$this->session->set_flashdata('success', 'Data admin <strong>Berhasil</strong> Ditambahkan!');
			redirect('admin');
		} else {
			$this->session->set_flashdata('error', 'Data admin <strong>Gagal</strong> Ditambahkan!');
			redirect('admin');
		}
	}

	public function ubah($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah admin';
		$this->data['admin'] = $this->m_admin->lihat_id($id);
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('admin/ubah', $this->data);
	}

	public function proses_ubah($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		];

		if($this->m_admin->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data admin <strong>Berhasil</strong> Diubah!');
			redirect('admin');
		} else {
			$this->session->set_flashdata('error', 'Data admin <strong>Gagal</strong> Diubah!');
			redirect('admin');
		}
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		if($this->m_admin->hapus($id)){
			$this->session->set_flashdata('success', 'Data admin <strong>Berhasil</strong> Dihapus!');
			redirect('admin');
		} else {
			$this->session->set_flashdata('error', 'Data admin <strong>Gagal</strong> Dihapus!');
			redirect('admin');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_admin'] = $this->m_admin->lihat();
		$this->data['title'] = 'Laporan Data admin';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('admin/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data admin Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}