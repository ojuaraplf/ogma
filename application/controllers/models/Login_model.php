<?php
class Login_model extends CI_Model
{

	public function performLogin($login, $pwd)
	{


		// echo $login;
		// echo md5($pwd);


		$this->db->select('*');
		$this->db->where('a001_login', $login);
		$this->db->where('a001_senha', $pwd);
		$query = $this->db->get('t001_usuario');
		if ($query->num_rows() > 0) {
			return $query->row()->a001_cd_usuario;
		} else {
			return false;
		}
	}

	public function fetchUsername($a001_cd_usuario)
	{
		$this->db->select('a001_nm_usuario');
		$this->db->where('a001_cd_usuario', $a001_cd_usuario);
		$query = $this->db->get('t001_usuario');
		if ($query->num_rows() > 0) {
			return $query->row()->a001_nm_usuario;
		} else {
			return false;
		}
	}
}
