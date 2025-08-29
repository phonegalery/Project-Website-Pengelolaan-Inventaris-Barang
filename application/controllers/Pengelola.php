<?php

use Dompdf\Dompdf;

class pengelola extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'pengelola' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'pengelola';
		$this->load->model('M_pengelola', 'm_pengelola');
		$this->load->model('M_toko', 'm_toko');
	}

	public function index(){
		if ($this->session->login['role'] == 'pengelola'){
			$this->session->set_flashdata('error', 'Managemen pengelola hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Data pengelola';
		$this->data['all_pengelola'] = $this->m_pengelola->lihat();
		$this->data['no'] = 1;
		$this->data['toko'] = $this->m_toko->lihat();

		$this->load->view('pengelola/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'pengelola'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah pengelola';
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('pengelola/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'pengelola'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		];

		if($this->m_pengelola->tambah($data)){
			$this->session->set_flashdata('success', 'Data pengelola <strong>Berhasil</strong> Ditambahkan!');
			redirect('pengelola');
		} else {
			$this->session->set_flashdata('error', 'Data pengelola <strong>Gagal</strong> Ditambahkan!');
			redirect('pengelola');
		}
	}

	public function ubah($id){
		if ($this->session->login['role'] == 'pengelola'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah pengelola';
		$this->data['pengelola'] = $this->m_pengelola->lihat_id($id);
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('pengelola/ubah', $this->data);
	}

	public function proses_ubah($id){
		if ($this->session->login['role'] == 'pengelola'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		];

		if($this->m_pengelola->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data pengelola <strong>Berhasil</strong> Diubah!');
			redirect('pengelola');
		} else {
			$this->session->set_flashdata('error', 'Data pengelola <strong>Gagal</strong> Diubah!');
			redirect('pengelola');
		}
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'pengelola'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		if($this->m_pengelola->hapus($id)){
			$this->session->set_flashdata('success', 'Data pengelola <strong>Berhasil</strong> Dihapus!');
			redirect('pengelola');
		} else {
			$this->session->set_flashdata('error', 'Data pengelola <strong>Gagal</strong> Dihapus!');
			redirect('pengelola');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_pengelola'] = $this->m_pengelola->lihat();
		$this->data['title'] = 'Laporan Data pengelola';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengelola/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data pengelola Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}