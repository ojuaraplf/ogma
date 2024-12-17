<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ListaChamado extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("chamado/listaChamado_model", 'lcm');

		}


		public function index() {
			$this->load->view('chamado/ListaChamado');


		}




    public function fetchChamados() {
      $data = $this->lcm->fetchChamados();
      $arrayData = array();
      foreach ($data as $key) {
        array_push($arrayData, $data = array(
          "CHD_Codigo" => $key["CHD_Codigo"],
          "CHD_Descricao" => $key["CHD_Descricao"],
          "CHD_PJFCodigo" => $key["CHD_PJFCodigo"],
          "CHD_CHPCodigo" => $key["CHD_CHPCodigo"],
          "STC_Descricao" => $key["STC_Descricao"],
          "PJT_APELIDO" => $key["PJT_APELIDO"],
          "CHD_MomAbertura" => $key["CHD_MomAbertura"],
          "CHD_CHCCodigo" => $key["CHD_CHCCodigo"],
          "CHD_STCCodigo" => $key["CHD_STCCodigo"],
          "CHD_TextoSolicitacao" => $key["CHD_TextoSolicitacao"],
          "CHD_PFR_Codigo" => $key["CHD_PFR_Codigo"],
          "CHD_AvalGrauSatisfacao" => $key["CHD_AvalGrauSatisfacao"],
          "CHD_AvalParecer" => $key["CHD_AvalParecer"],
          "CHD_MomAprvcao" => $key["CHD_MomAprvcao"],
          "CHD_MomNovoStatus" => $key["CHD_MomNovoStatus"],
          "CHD_CBRCodigo" => $key["CHD_CBRCodigo"],
          "CHD_QtHora" => $key["CHD_QtHora"],
          "CHD_CHDCodigoAssociado" => $key["CHD_CHDCodigoAssociado"])
        );
      }
      echo json_encode($arrayData);
    }





	}
