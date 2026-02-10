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
		$condition	= "username=" . "'" . $username . "'";
		$select		= array('username');
		$this->db->select($select);
		$this->db->from('tb_pilih');
		$this->db->where($condition);
		$login 	= $this->db->get();
		if ($login->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function datamodel()
	{
		$load	= $this->db->query("SELECT * FROM tb_pilihan ORDER BY no ASC");
		return $load->result_Array();
	}
	public function vote($nisn, $username, $jk_calon)
	{
		$cek = $this->db
			->join('tb_pilihan', 'tb_pilihan.nisn = tb_pilih.nisn')
			->where('tb_pilih.username', $username)
			->where('tb_pilihan.jk', $jk_calon)
			->get('tb_pilih');

		if ($cek->num_rows() > 0) {
			return false;
		}

		$this->db->insert('tb_pilih', [
			'nisn'     => $nisn,
			'username' => $username
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
		return $this->db
			->join('tb_pilihan', 'tb_pilihan.nisn = tb_pilih.nisn')
			->where('tb_pilih.username', $username)
			->group_by('tb_pilihan.jk')
			->get('tb_pilih')
			->num_rows() >= 2;
	}
}
