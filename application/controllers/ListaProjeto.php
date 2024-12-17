<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListaProjeto extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("listaProjeto_model", 'lpm');
	}

	public function index()
	{
		$data["projectList"] = json_encode($this->lpm->fetchProjects());
		$this->load->view('servico/ListaProjeto', $data);
	}


	public function fetchProjects()
	{
		$data = $this->lpm->fetchProjects();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"PJT_CODIGO" => $key["PJT_CODIGO"],
					"PJT_VhSysCCustoId" => $key["PJT_VhSysCCustoId"],
					"PJT_TITULO" => $key["PJT_TITULO"],
					"PJT_APELIDO" => $key["PJT_APELIDO"],
					"PJT_STATUS" => $key["PJT_STATUS"],
					"STP_DESCRICAO" => $key["STP_DESCRICAO"]
				)
			);
		}
		echo json_encode($arrayData);
	}












	public function fetchStatusProjeto()
	{
		$data = $this->lpm->fetchStatusProjeto();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"STP_CODIGO" => $key["STP_CODIGO"],
					"STP_DESCRICAO" => $key["STP_DESCRICAO"]
				)
			);
		}
		echo json_encode($arrayData);
	}

	public function fetchCatalogoServico()
	{
		$data = $this->lpm->fetchCatalogoServico();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"CSI_CODIGO" => $key["CSI_CODIGO"],
					"CSI_SERVTITULO" => $key["CSI_SERVTITULO"],
					"CSI_AcronimoPlanoServico" => $key["CSI_AcronimoPlanoServico"],
					"CSI_FlgGeraPJAAutomatica" => $key["CSI_FlgGeraPJAAutomatica"],
					"CSI_FlgGeraPLDAutomatica" => $key["CSI_FlgGeraPLDAutomatica"]
				)
			);
		}
		echo json_encode($arrayData);
	}
	public function newProjeto()
	{
		$PJT_TITULO = $this->input->post("PJT_TITULO");
		$PJT_APELIDO = $this->input->post("PJT_APELIDO");
		$PJT_DATAINICIO = $this->input->post("PJT_DATAINICIO");
		$PJT_ITEMCAS = $this->input->post("PJT_ITEMCAS");
		$idRevisao = $this->lpm->fetchLastRevisaoCatalago();
		$dataFase = array(
			"PJF_IDENTIFICACAOFASE" => $PJT_TITULO,
			"PJF_ORDEMFASE" => 1,
			"PJF_DATAINICIO" => $PJT_DATAINICIO
		);
		$data = array(
			"PJT_TITULO" => $PJT_TITULO,
			"PJT_APELIDO" => $PJT_APELIDO,
			"PJT_DATAINICIO" => $PJT_DATAINICIO,
			"PJT_ITEMCAS" => $PJT_ITEMCAS,
			"CAS_CODIGO" => $idRevisao,
			"PJT_STATUS" => 3,
			"PJT_TECNOLOGIA" => 0
		);
		echo $this->lpm->newProjeto($data, $dataFase);
	}






	public function insertTemplatePlanoDeDados()
	{
		$PJT_CODIGO = $this->input->post("PJT_CODIGO");
		$CSI_CODIGO = $this->input->post("CSI_CODIGO");
		$data = array(
			"PJT_CODIGO" => $PJT_CODIGO,
			"CSI_CODIGO" => $CSI_CODIGO
		);
		$this->lpm->insertTemplatePlanoDeDados($data);
	}

	public function insertTemplateANS()
	{
		$PJT_CODIGO = $this->input->post("PJT_CODIGO");

		$this->lpm->insertTemplateANS($PJT_CODIGO);
	}
	public function insertTemplateChecklist()
	{
		$PJT_CODIGO = $this->input->post("PJT_CODIGO");

		$this->lpm->insertTemplateChecklist($PJT_CODIGO);
	}
}
