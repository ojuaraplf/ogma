<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("login_model", 'lm');
	}

	public function index()
	{
		$this->load->view('Login');
	}

	public function userData()
	{
		$newdata = array(
			'userToken'  => $this->input->post("userToken"),
			'userTipoAcesso'  => $this->input->post("userTipoAcesso"),
			'userCodigo'  => $this->input->post("userCodigo"),
			'userCliente'  => $this->input->post("userCliente"),
			'userName'  => $this->input->post("userName"),
			'userLogin'  => $this->input->post("userLogin")


		);
		$this->session->set_userdata($newdata);
	}


	public function logout()
	{
		$this->session->sess_destroy();
	}


	function performLogin()
	{

		$login = $this->input->post("login");
		$pwd = $this->input->post("pwd");

		$this->lm->performLogin($login, $pwd);

		// echo $login;
		// echo $pwd;
	}

	function fetchUsername()
	{
		$a001_cd_usuario = $this->input->post("a001_cd_usuario");
		$username = $this->lm->fetchUsername($a001_cd_usuario);
		echo $username;
	}
}
