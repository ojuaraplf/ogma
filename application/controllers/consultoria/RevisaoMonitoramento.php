<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RevisaoMonitoramento extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model("consultoria/RevisaoMonitoramento_model", 'rahm');

  }


  public function index() {
    $this->load->view('consultoria/RevisaoMonitoramento');
  }


//  public function fetchApontamentoHoras() {
//    $CBR_CODIGO = $this->input->post("CBR_CODIGO");
//    $LCT_DATAINICIAL = $this->input->post("LCT_DATAINICIAL");
//    $LCT_DATAFINAL = $this->input->post("LCT_DATAFINAL");
//    $PJT_CODIGO = $this->input->post("PJT_CODIGO");
//
//    $data = $this->rahm->fetchApontamentoHoras($CBR_CODIGO, $LCT_DATAINICIAL, $LCT_DATAFINAL, $PJT_CODIGO);
//    $arrayData = array();
//    foreach ($data as $key) {
//      array_push($arrayData, $data = array(
//        "LCT_CODIGO" => $key["LCT_CODIGO"],
//        "ATG_DESCRICAO" => $key["ATG_DESCRICAO"],
//        "ATG_CODIGO" => $key["ATG_CODIGO"],
//        "LCT_DATA" => $key["LCT_DATA"],
//        "LCT_HORAINICIO" => $key["LCT_HORAINICIO"],
//        "LCT_HORAFIM" => $key["LCT_HORAFIM"],
//        "LCT_CODCHAMADO" => $key["LCT_CODCHAMADO"],
//        "LCT_TEMPO" => $key["LCT_TEMPO"],
////				"LCT_PORCENTAGEMNOVA" => $key["LCT_PORCENTAGEMNOVA"],
//        "LCT_DESCRICAO" => $key["LCT_DESCRICAO"])
//      );
//    }
//    echo json_encode($arrayData);
//  }
//
//
//  public function fetchProjetos() {
//    $CBR_CODIGO = $this->input->post("CBR_CODIGO");
//    $data = $this->rahm->fetchProjetos($CBR_CODIGO);
//    $arrayData = array();
//    foreach ($data as $key) {
//      array_push($arrayData, $data = array(
//        "PJT_CODIGO" => $key["PJT_CODIGO"],
//        "PJT_APELIDO" => $key["PJT_APELIDO"])
//      );
//    }
//    echo json_encode($arrayData);
//  }
//
//
  public function fetchRevisaoUsuario() {
    $CBR_CODIGO = $this->input->post("CBR_CODIGO");
//    $LCT_DATAINICIAL = $this->input->post("LCT_DATAINICIAL");
//    $LCT_DATAFINAL = $this->input->post("LCT_DATAFINAL");
//    $PJT_CODIGO = $this->input->post("PJT_CODIGO");

    $data = $this->rahm->fetchRevisaoUsuario($CBR_CODIGO);

//		$arrayData = array();
//		foreach ($data as $key){
//			array_push($arrayData, $data = array(
//				"LCT_TIME" => $key["LCT_TIME"])
//			);
//		}
    echo json_encode($data);
//		$data = $this->rahm->fetchTotalHoras($CBR_CODIGO, $LCT_DATAINICIAL, $LCT_DATAFINAL, $PJT_CODIGO);
//
//		echo json_encode($data);
  }

  function fetchIndicadores() {
    $PJM_Codigo = $this->input->post("PJM_Codigo");
    echo $this->rahm->fetchIndicadores($PJM_Codigo);
  }


//
//
  public function concluirRevisao() {
    $PJM_Codigo= $this->input->post("PJM_Codigo");
    echo $this->rahm->concluirRevisao($PJM_Codigo);

  }
//
//public function updateLancamentoHora() {
//
//    $LCT_CODIGO = $this->input->post("LCT_CODIGO");
//    $LCT_DATA = $this->input->post("LCT_DATA");
//    $LCT_HORAINICIO = $this->input->post("LCT_HORAINICIO");
//    $LCT_HORAFIM = $this->input->post("LCT_HORAFIM");
//    $LCT_CODCHAMADO = $this->input->post("LCT_CODCHAMADO");
//    $LCT_TEMPO = $this->input->post("LCT_TEMPO");
//    $LCT_DESCRICAO = $this->input->post("LCT_DESCRICAO");
//    $ATG_CODIGO = $this->input->post("ATG_CODIGO");
//    $CBR_CODIGO = $this->input->post("CBR_CODIGO");
//
//    $data = array(
//      "LCT_CODIGO" => $LCT_CODIGO,
//      "LCT_DATA" => $LCT_DATA,
//      "LCT_HORAINICIO" => $LCT_HORAINICIO,
//      "LCT_HORAFIM" => $LCT_HORAFIM,
//      "LCT_CODCHAMADO" => $LCT_CODCHAMADO,
//      "LCT_TEMPO" => $LCT_TEMPO,
//      "LCT_DESCRICAO" => $LCT_DESCRICAO,
//      "ATG_CODIGO" => $ATG_CODIGO,
//      "CBR_CODIGO" => $CBR_CODIGO
//    );
//    echo $this->rahm->updateLancamentoHora($data);
//
//  }
//  public function removerLancamentoHora() {
//
//    $LCT_CODIGO = $this->input->post("LCT_CODIGO");
//
//    $data = array(
//      "LCT_CODIGO" => $LCT_CODIGO,
//
//    );
//    echo $this->rahm->removerLancamentoHora($data);
//
//
//  }


}
