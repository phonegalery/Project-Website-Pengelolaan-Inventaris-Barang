<?php

use Dompdf\Dompdf;

class Petugas extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'petugas';
		$this->load->model('M_petugas', 'm_petugas');
		$this->load->model('M_toko', 'm_toko');
	}

	public function index(){
		$this->data['title'] = 'Data Petugas';
		$this->data['all_petugas'] = $this->m_petugas->lihat();
		$this->data['no'] = 1;
		$this->data['toko'] = $this->m_toko->lihat();

		$this->load->view('petugas/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Petugas';
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('petugas/tambah', $this->data);
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

		if($this->m_petugas->tambah($data)){
			$this->session->set_flashdata('success', 'Data Petugas <strong>Berhasil</strong> Ditambahkan!');
			redirect('petugas');
		} else {
			$this->session->set_flashdata('error', 'Data Petugas <strong>Gagal</strong> Ditambahkan!');
			redirect('petugas');
		}
	}

	public function ubah($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah Petugas';
		$this->data['petugas'] = $this->m_petugas->lihat_id($id);
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('petugas/ubah', $this->data);
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

		if($this->m_petugas->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Petugas <strong>Berhasil</strong> Diubah!');
			redirect('petugas');
		} else {
			$this->session->set_flashdata('error', 'Data Petugas <strong>Gagal</strong> Diubah!');
			redirect('petugas');
		}
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}

		if($this->m_petugas->hapus($id)){
			$this->session->set_flashdata('success', 'Data Petugas <strong>Berhasil</strong> Dihapus!');
			redirect('petugas');
		} else {
			$this->session->set_flashdata('error', 'Data Petugas <strong>Gagal</strong> Dihapus!');
			redirect('petugas');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_petugas'] = $this->m_petugas->lihat();
		$this->data['title'] = '<h3><center>Laporan Data Petugas</center></h3>';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('petugas/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Petugas Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}