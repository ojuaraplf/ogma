<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApontarHoras extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("consultoria/apontarHoras_model", 'ahm');
	}


	public function index()
	{
		$this->load->view('consultoria/ApontarHoras');
	}


	public function fetchAtividadesReferenteColaborador()
	{
		$idColaborador = $this->input->post("AEA_CBRCODIGO");
		$data = $this->ahm->fetchAtividadesReferenteColaborador($idColaborador);
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"AEA_CODIGO" => $key["AEA_CODIGO"],
					"AEA_CBRCODIGO" => $key["AEA_CBRCODIGO"],
					"ATG_CODIGO" => $key["ATG_CODIGO"],
					"ATG_DESCRICAO" => $key["ATG_DESCRICAO"],
					"ATG_ORDEM" => $key["ATG_ORDEM"],
					"ATG_QTHORA" => $key["ATG_QTHORA"],
					"ATG_PORCENTAGEMAPRONTADA" => $key["ATG_PORCENTAGEMAPRONTADA"],
					"ATG_DetalheDescritivo" => $key["ATG_DetalheDescritivo"],
					"PJT_APELIDO" => $key["PJT_APELIDO"]
				)
			);
		}
		echo json_encode($arrayData);
	}




	public function updateDetalhesAtividade()
	{
		$ATG_CODIGO = $this->input->post("ATG_CODIGO");
		$ATG_DetalheDescritivo = $this->input->post("ATG_DetalheDescritivo");
		// $ATG_PORCENTAGEMAPRONTADA = $this->input->post("ATG_PORCENTAGEMAPRONTADA");

		$data = array(
			"ATG_CODIGO" => $ATG_CODIGO,
			"ATG_DetalheDescritivo" => $ATG_DetalheDescritivo
			// "ATG_PORCENTAGEMAPRONTADA" => $ATG_PORCENTAGEMAPRONTADA
		);

		echo $this->ahm->updateDetalhesAtividade($data);
	}


	public function checkIfDateCanToPoint()
	{
		echo json_encode($this->ahm->checkIfDateCanToPoint());
	}



	public function checarSePeriodoExisteLancamento()
	{

		$LCT_DATA = $this->input->post("LCT_DATA");
		$LCT_HORAINICIO = $this->input->post("LCT_HORAINICIO");
		$LCT_HORAFIM = $this->input->post("LCT_HORAFIM");
		$CBR_CODIGO = $this->input->post("CBR_CODIGO");


		$data = array(
			"LCT_DATA" => $LCT_DATA,
			"LCT_HORAINICIO" => $LCT_HORAINICIO,
			"LCT_HORAFIM" => $LCT_HORAFIM,
			"CBR_CODIGO" => $CBR_CODIGO
		);
		echo $this->ahm->checarSePeriodoExisteLancamento($data);
	}








	public function fetchApontamentoHorasDaAtividade()
	{
		$ATG_CODIGO = $this->input->post("ATG_CODIGO");


		$data = $this->ahm->fetchApontamentoHorasDaAtividade($ATG_CODIGO);

		// $arrayData = array();
		// foreach ($data as $key) {
		// 	array_push(
		// 		$arrayData,
		// 		$data = array(
		// 			"LCT_CODIGO" => $key["LCT_CODIGO"],
		// 			"LCT_DATA" => $key["LCT_DATA"],
		// 			"LCT_HORAINICIO" => $key["LCT_HORAINICIO"],
		// 			"LCT_HORAFIM" => $key["LCT_HORAFIM"],
		// 			"LCT_PORCENTAGEMNOVA" => $key["LCT_PORCENTAGEMNOVA"],
		// 			"LCT_TEMPO" => $key["LCT_TEMPO"],
		// 			"ATG_DESCRICAO" => $key["ATG_DESCRICAO"],
		// 			"CBR_CODIGO" => $key["CBR_CODIGO"]
		// 		)
		// 	);
		// }
		echo json_encode($data);
	}









	public function fetchApondamentoDia()
	{
		$idColaborador = $this->input->post("CBR_CODIGO");
		$LCT_DATA = $this->input->post("LCT_DATA");

		$data = $this->ahm->fetchApondamentoDia($idColaborador, $LCT_DATA);

		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"LCT_CODIGO" => $key["LCT_CODIGO"],
					"LCT_DATA" => $key["LCT_DATA"],
					"LCT_HORAINICIO" => $key["LCT_HORAINICIO"],
					"LCT_HORAFIM" => $key["LCT_HORAFIM"],
					"LCT_PORCENTAGEMNOVA" => $key["LCT_PORCENTAGEMNOVA"],
					"LCT_TEMPO" => $key["LCT_TEMPO"],
					"ATG_DESCRICAO" => $key["ATG_DESCRICAO"],
					"CBR_CODIGO" => $key["CBR_CODIGO"],
					"PJT_APELIDO" => $key["PJT_APELIDO"]
				)
			);
		}
		echo json_encode($arrayData);
	}

	public function newLancamentoHora()
	{

		$LCT_DATA = $this->input->post("LCT_DATA");
		$LCT_HORAINICIO = $this->input->post("LCT_HORAINICIO");
		$LCT_HORAFIM = $this->input->post("LCT_HORAFIM");
		$LCT_PORCENTAGEMANTIGA = $this->input->post("LCT_PORCENTAGEMANTIGA");
		$LCT_PORCENTAGEMNOVA = $this->input->post("LCT_PORCENTAGEMNOVA");
		// $LCT_CODCHAMADO = $this->input->post("LCT_CODCHAMADO");
		$LCT_TEMPO = $this->input->post("LCT_TEMPO");
		$LCT_DESCRICAO = $this->input->post("LCT_DESCRICAO");
		$ATG_CODIGO = $this->input->post("ATG_CODIGO");
		$CBR_CODIGO = $this->input->post("CBR_CODIGO");
		$LCT_USULogin = $this->input->post("LCT_USULogin");

		$data = array(
			"LCT_DATA" => $LCT_DATA,
			"LCT_HORAINICIO" => $LCT_HORAINICIO,
			"LCT_HORAFIM" => $LCT_HORAFIM,
			"LCT_PORCENTAGEMANTIGA" => $LCT_PORCENTAGEMANTIGA,
			"LCT_PORCENTAGEMNOVA" => $LCT_PORCENTAGEMNOVA,
			// "LCT_CODCHAMADO" => $LCT_CODCHAMADO,
			"LCT_TEMPO" => $LCT_TEMPO,
			"LCT_DESCRICAO" => $LCT_DESCRICAO,
			"ATG_CODIGO" => $ATG_CODIGO,
			"CBR_CODIGO" => $CBR_CODIGO,
			"LCT_USULogin" => $LCT_USULogin
		);
		$dataAtividade = array(
			"ATG_PORCENTAGEMAPRONTADA" => $LCT_PORCENTAGEMNOVA,
			"ATG_CODIGO" => $ATG_CODIGO,
		);
		echo $this->ahm->newLancamentoHora($data);
		echo $this->ahm->updateAtividadePorcentagem($dataAtividade);
	}
}
