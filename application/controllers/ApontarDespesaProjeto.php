<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ApontarDespesaProjeto extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("apontarDespesaProjeto_model", 'adpm');

		}


		public function index() {
			$this->load->view('financeiro/ApontarDespesaProjeto');
		}



		public function fetchProjeto() {
			$data = $this->adpm->fetchProjeto();
			$arrayData = array();
			foreach ($data as $key){
				array_push($arrayData, $data = array(
					"PJT_CODIGO" => $key["PJT_CODIGO"],
					"PJT_APELIDO" => $key["PJT_APELIDO"])
				);
			}
			echo json_encode($arrayData);
		}



		public function fetchApontarDespesaProjeto() {
			$idColaborador = $this->input->post("DSP_001_cd_usuario");
			$data = $this->adpm->fetchApontarDespesaProjeto($idColaborador);
			$arrayData = array();
			foreach ($data as $key) {
				array_push($arrayData, $data = array(
					"DSP_Codigo" => $key["DSP_Codigo"],
					"DST_DataDespesa" => $key["DST_DataDespesa"],
					"DSP_Descricao" => $key["DSP_Descricao"],
					"DSP_ObjetivoDespesa" => $key["DSP_ObjetivoDespesa"],
					"DSP_001_cd_usuario" => $key["DSP_001_cd_usuario"],
					"DSP_PJT_CODIGO" => $key["DSP_PJT_CODIGO"],
					"DSP_IdentificacaoDocumento" => $key["DSP_IdentificacaoDocumento"],
					"DSP_ValorDespesa" => $key["DSP_ValorDespesa"],
					"DSP_Desativado" => $key["DSP_Desativado"],
					"DSP_CobrarCliente" => $key["DSP_CobrarCliente"]
				)
				);
			}
			echo json_encode($arrayData);
		}

		public function updateDespesaProjeto() {

			$DSP_Codigo = $this->input->post("DSP_Codigo");
			$DST_DataDespesa = $this->input->post("DST_DataDespesa");
			$DSP_Descricao = $this->input->post("DSP_Descricao");
			$DSP_ObjetivoDespesa = $this->input->post("DSP_ObjetivoDespesa");
			$DSP_PJT_CODIGO = $this->input->post("DSP_PJT_CODIGO");
			$DSP_IdentificacaoDocumento= $this->input->post("DSP_IdentificacaoDocumento");
			$DSP_ValorDespesa = $this->input->post("DSP_ValorDespesa");
			$DSP_001_cd_usuario = $this->input->post("DSP_001_cd_usuario");


			$data = array(
				"DSP_Codigo" => $DSP_Codigo,
				"DST_DataDespesa" => $DST_DataDespesa,
				"DSP_Descricao" => $DSP_Descricao,
				"DSP_ObjetivoDespesa" => $DSP_ObjetivoDespesa,
				"DSP_PJT_CODIGO" => $DSP_PJT_CODIGO,
				"DSP_IdentificacaoDocumento" => $DSP_IdentificacaoDocumento,
				"DSP_ValorDespesa" => $DSP_ValorDespesa,
				"DSP_001_cd_usuario" => $DSP_001_cd_usuario

			);

			echo $this->adpm->updateDespesaProjeto($data);

		}


	}
