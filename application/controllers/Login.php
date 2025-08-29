<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->login) redirect('dashboard');
		$this->load->model('M_petugas', 'm_petugas');
		$this->load->model('M_admin', 'm_admin');
        $this->load->model('M_pengelola', 'm_pengelola');
        
	}
	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){
		if($this->input->post('role') === 'petugas') $this->_proses_login_petugas($this->input->post('username'));
		elseif($this->input->post('role') === 'admin') $this->_proses_login_admin($this->input->post('username'));
        elseif($this->input->post('role') === 'pengelola') $this->_proses_login_pengelola($this->input->post('username'));
		else {
			?>
			<script>
				alert('role tidak tersedia!')
			</script>
			<?php
		}
	}

	protected function _proses_login_petugas($username){
		$get_petugas = $this->m_petugas->lihat_username($username);
		if($get_petugas){
			if($get_petugas->password == $this->input->post('password')){
				$session = [
					'kode' => $get_petugas->kode,
					'nama' => $get_petugas->nama,
					'username' => $get_petugas->username,
					'password' => $get_petugas->password,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('pemeliharaan');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}

	protected function _proses_login_admin($username){
		$get_pengguna = $this->m_admin->lihat_username($username);
		if($get_pengguna){
			if($get_pengguna->password == $this->input->post('password')){
				$session = [
					'kode' => $get_pengguna->kode,
					'nama' => $get_pengguna->nama,
					'username' => $get_pengguna->username,
					'password' => $get_pengguna->password,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}

	protected function _proses_login_pengelola($username){
		$get_pengelola = $this->m_pengelola->lihat_username($username);
		if($get_pengelola){
			if($get_pengelola->password == $this->input->post('password')){
				$session = [
					'kode' => $get_pengelola->kode,
					'nama' => $get_pengelola->nama,
					'username' => $get_pengelola->username,
					'password' => $get_pengelola->password,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('barang');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}
}