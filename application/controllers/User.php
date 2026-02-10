<?php
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('session'));
		$this->load->model(array('User_Model'));
	}
	public function login()
	{
		if ($this->session->userdata('username')) {
			redirect('user/index');
		}
		$this->load->view('user/head');
		$this->load->view('user/login');
		$this->load->view('user/footer');
	}
	public function loginvalidation()
	{
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$user = $this->User_Model->login($username, $password);

		if (!$user) {
			$this->session->set_flashdata('failed', 'Username atau Password Salah');
			redirect('user/login');
		}

		$this->session->set_userdata([
			'username' => $user->username,
			'jk'       => $user->jk,
			'role'     => $user->role
		]);

		redirect('user/index');
	}



	public function logout()
	{
		$this->session->unset_userdata('username');
		redirect('user/login');
	}
	public function index()
	{
		if (!$this->session->userdata('username')) {
			redirect('user/login');
		}

		$data['username'] = $this->session->userdata('username');
		$jk   = $this->session->userdata('jk');
		$role = $this->session->userdata('role');

		// 🔑 BEDAKAN SISWA & GURU
		if ($role === 'guru') {
			// guru lihat semua kandidat
			$data['datacalon'] = $this->User_Model->datamodel();
		} else {
			// siswa hanya lihat kandidat sesuai JK
			$data['datacalon'] = $this->User_Model->datacalon_by_jk($jk);
		}

		$this->load->view('user/head');
		$this->load->view('user/navbar');
		$this->load->view('user/index', $data);
		$this->load->view('user/footer');
	}

	public function vote()
	{
		if (!$this->session->userdata('username')) {
			redirect('user/login');
		}

		$nisn     = $this->input->post('nisn');
		$username = $this->session->userdata('username');
		$role     = $this->session->userdata('role'); // siswa / guru

		// ambil JK dari kandidat
		$jk_calon = $this->User_Model->get_jk_calon($nisn);

		// simpan vote
		$vote = $this->User_Model->vote($nisn, $username, $jk_calon);

		// sudah pernah vote di JK itu
		if ($vote === false) {
			redirect('user/index');
			exit;
		}

		// siswa langsung selesai
		if ($role === 'siswa') {
			$this->User_Model->hadir($username);
			redirect('user/viewlogout');
			exit;
		}

		// guru harus pilih L & P
		if ($role === 'guru') {
			if ($this->User_Model->guru_selesai_vote($username)) {
				$this->User_Model->hadir($username);
				redirect('user/viewlogout');
			} else {
				redirect('user/index'); // lanjut sesi berikutnya
			}
			exit;
		}
	}

	public function viewlogout()
	{
		if (!$this->session->userdata('username')) {
			redirect('user/login');
		}
		$this->load->view('user/head');
		$this->load->view('user/navbar');
		$this->load->view('user/viewlogout');
		$this->load->view('user/footer');
	}
	public function validasilogout()
	{
		if (!$this->session->userdata('username')) {
			redirect('user/login');
		}
		$this->load->view('user/head');
		$this->load->view('user/navbar');
		$this->load->view('user/validasilogout');
		$this->load->view('user/footer');
	}
}
