<?php
class User_Model extends CI_Model
{
	public function login($username, $password)
	{
		return $this->db
			->where('username', $username)
			->where('password', $password)
			->get('tb_siswa')
			->row(); // 👈 return DATA, bukan boolean
	}

	public function valid($username)
	{
		$condition = "username=" . "'" . $username . "'";
		$this->db->select('username');
		$this->db->from('tb_pilih');
		$this->db->where($condition);

		$login = $this->db->get();

		return $login->num_rows() > 0;
	}
	public function datamodel()
	{
		$load	= $this->db->query("SELECT * FROM tb_pilihan ORDER BY no ASC");
		return $load->result_Array();
	}
	public function vote($nisn, $username, $jk_calon, $kategori)
	{
		$cek = $this->db
			->where('username', $username)
			->where('kategori', $kategori)
			->get('tb_pilih');

		if ($cek->num_rows() > 0) {
			return false;
		}

		$this->db->insert('tb_pilih', [
			'nisn'        => $nisn,
			'username'    => $username,
			'jk_pilihan'  => $jk_calon,
			'kategori'    => $kategori
		]);

		return true;
	}

	public function hadir($username)
	{
		$update = $this->db->query("UPDATE tb_siswa SET hadir='Hadir' WHERE username='$username'");
		return $update;
	}

	public function datacalon_by_jk($jk)
	{
		return $this->db
			->where('jk', $jk)
			->order_by('no', 'ASC')
			->get('tb_pilihan')
			->result_array();
	}

	public function get_jk_calon($nisn)
	{
		return $this->db
			->select('jk')
			->where('nisn', $nisn)
			->get('tb_pilihan')
			->row()
			->jk;
	}

	public function guru_selesai_vote($username)
	{
		$query = $this->db
			->select('kategori')
			->where('username', $username)
			->group_by('kategori')
			->get('tb_pilih');

		return $query->num_rows() >= 5;
	}

	// public function jk_sudah_dipilih($username)
	// {
	// 	return $this->db
	// 		->select('jk_pilihan')
	// 		->where('username', $username)
	// 		->get('tb_pilih')
	// 		->result_array();
	// }
	public function get_calon($nisn)
	{
		return $this->db
			->where('nisn', $nisn)
			->get('tb_pilihan')
			->row();
	}
	public function datacalon_by_kategori($kategori)
	{
		return $this->db
			->where('kategori', $kategori)
			->order_by('no', 'ASC')
			->get('tb_pilihan')
			->result_array();
	}
	public function kategori_sudah_dipilih($username)
	{
		return $this->db
			->select('kategori')
			->where('username', $username)
			->get('tb_pilih')
			->result_array();
	}

	public function jumlah_vote($username)
	{
		return $this->db
			->where('username', $username)
			->count_all_results('tb_pilih');
	}

	public function selesai_vote($username, $jk, $role)
	{
		$jumlah = $this->jumlah_vote($username);

		// DPP
		if ($role == 'dpp') {
			return $jumlah >= 5;
		}

		// Putra
		if ($jk == 'L') {
			return $jumlah >= 2;
		}

		// Putri
		if ($jk == 'P') {
			return $jumlah >= 3;
		}

		return false;
	}
}
