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

		// Cek login dulu
		$user = $this->User_Model->login($username, $password);

		if (!$user) {
			$this->session->set_flashdata('failed', 'Username atau Password Salah');
			redirect('user/login');
		}

		// Cek apakah sudah pernah voting (pakai method lama)
		$valid = $this->User_Model->valid($username);

		if ($valid == true) {
			$this->session->set_flashdata(
				'block',
				'Anda sudah pernah melakukan voting. Akun Anda sekarang dinonaktifkan. Jika merasa belum pernah voting, silakan hubungi pengurus.'
			);
			redirect('user/login');
		}

		// Jika aman → login
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

		$username = $this->session->userdata('username');
		$role     = $this->session->userdata('role');
		$jk_user  = $this->session->userdata('jk');

		$data['username'] = $username;

		if ($role == 'siswa') {
			$data['datacalon'] = $this->User_Model->datacalon_by_jk($jk_user);
		}

		if ($role == 'dpp') {

			$sudah = $this->User_Model->jk_sudah_dipilih($username);
			$jk_sudah = array_column($sudah, 'jk_pilihan');

			if (!in_array('L', $jk_sudah)) {
				$data['datacalon'] = $this->User_Model->datacalon_by_jk('L');
			} elseif (!in_array('P', $jk_sudah)) {
				$data['datacalon'] = $this->User_Model->datacalon_by_jk('P');
			} else {
				redirect('user/viewlogout');
			}
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
		$role     = $this->session->userdata('role');

		// ambil JK calon
		$calon = $this->db->where('nisn', $nisn)
			->get('tb_pilihan')
			->row();

		$this->User_Model->vote($nisn, $username, $calon->jk);

		// tandai hadir 1x saja
		$this->User_Model->hadir($username);

		if ($role == 'dpp') {
			if ($this->User_Model->guru_selesai_vote($username)) {
				redirect('user/viewlogout');
			} else {
				redirect('user/index'); // tampil JK berikutnya
			}
		} else {
			redirect('user/viewlogout');
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
