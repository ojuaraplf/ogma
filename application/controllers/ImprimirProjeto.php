<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImprimirProjeto extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		 $this->load->model("imprimirProjeto_model", 'ipm');

	}

	public function index() {
		$this->load->view('servico/ImprimirProjeto');
	}





	function fetchProjetoCreated() {
		$idProjeto = $this->input->post("PJT_CODIGO");
		$projeto = $this->ipm->fetchProjetoCreated($idProjeto);
		echo json_encode($projeto);
	}




}
