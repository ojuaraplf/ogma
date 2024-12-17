<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetalheChamado extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model("chamado/detalheChamado_model", 'dcm');
	}


	public function index($id)
	{
		$data['ogsv_CHA_AnexoChamado'] = $this->dcm->fetchAnexoChamado($id);
		$data['ogsv_ATG_SelecaoItemGrande'] = $this->dcm->fetchogsv_ATG_SelecaoItemGrande($id);

		$this->load->view('chamado/DetalheChamado', $data);
	}

	function fetchChamado()
	{
		$CHD_Codigo = $this->input->post("CHD_Codigo");
		$chamado = $this->dcm->fetchChamado($CHD_Codigo);
		echo json_encode($chamado);
	}


	function fetchChamadoInteracao() {
		$CHI_CHDCodigo = $this->input->post("CHI_CHDCodigo");
		$data = $this->dcm->fetchChamadoInteracao($CHI_CHDCodigo);
		echo json_encode($data);
	}

	public function downloadFile($id)
	{
		$CHA_DocumLink = $this->dcm->fetchDocumentLink($id);

		// print_r($CHA_DocumLink);

		$this->load->library('ftp');
		$config['hostname'] = '162.241.61.25';
		$config['username'] = 'wdisco17';
		$config['password'] = 'j4NjP26s2p';
		$config['debug']    = TRUE;

		$this->ftp->connect($config);

		// echo "chegou aqui";
		$array = explode('/', $CHA_DocumLink);
		$filename = strtolower(end($array)); // Now a variable. 


		$this->ftp->download("sirius_uploaded_files/" . $CHA_DocumLink, "./uploads/" . $filename);

		$data = $this->curl_get_contents(base_url() . 'uploads/' . $filename);
		@unlink("uploads/" . $filename);
		force_download($filename, $data);
	}

	public function curl_get_contents($url)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}


}
