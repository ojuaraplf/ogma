<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DetalheProjeto extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("detalheProjeto_model", 'dpm');

		}


		public function index() {
			$this->load->view('servico/DetalheProjeto');
		}

		function fetchProjetoCreated() {
			$idProjeto = $this->input->post("PJT_CODIGO");
			$projeto = $this->dpm->fetchProjetoCreated($idProjeto);
			echo json_encode($projeto);
		}

		public function fetchFaseProjeto() {
			$idProjeto = $this->input->post("PJT_CODIGO");
			$data = $this->dpm->fetchFaseProjeto($idProjeto);
			$arrayData = array();
			foreach ($data as $key) {
				array_push($arrayData, $data = array(
					"PJF_CODIGO" => $key["PJF_CODIGO"],
					"PJF_ORDEMFASE" => $key["PJF_ORDEMFASE"],
					"PJF_IDENTIFICACAOFASE" => $key["PJF_IDENTIFICACAOFASE"],
					"PJF_DATAINICIO" => $key["PJF_DATAINICIO"],
					"PJF_DATATERMINO" => $key["PJF_DATATERMINO"])
				);
			}
			echo json_encode($arrayData);
		}

		public function newFase() {
			$PJF_ORDEMFASE = $this->input->post("PJF_ORDEMFASE");
			$PJF_IDENTIFICACAOFASE = $this->input->post("PJF_IDENTIFICACAOFASE");
			$PJT_CODIGO = $this->input->post("PJT_CODIGO");
			$PJF_DATAINICIO = $this->input->post("PJF_DATAINICIO");
			// $PJF_DATATERMINO = $this->input->post("PJF_DATATERMINO");
			$data = array(
				"PJF_ORDEMFASE" => $PJF_ORDEMFASE,
				"PJF_IDENTIFICACAOFASE" => $PJF_IDENTIFICACAOFASE,
				"PJF_DATAINICIO" => $PJF_DATAINICIO,
				// "PJF_DATATERMINO" => $PJF_DATATERMINO,
				"PJT_CODIGO" => $PJT_CODIGO

			);
			$this->dpm->newFase($data);
		}




		public function insertTemplateRiscos() {
			$PJF_CODIGO = $this->input->post("PJF_CODIGO");

			$this->dpm->insertTemplateRiscos($PJF_CODIGO);
		}






    function fetchTotalHorasApontadas() {
      $PJT_CODIGO = $this->input->post("PJT_CODIGO");
      echo $this->dpm->fetchTotalHorasApontadas($PJT_CODIGO);
    }



		function fetchNumberFasesFromProject() {
			$idProjeto = $this->input->post("PJT_CODIGO");
			$this->dpm->fetchNumberFasesFromProject($idProjeto);

		}


	}
