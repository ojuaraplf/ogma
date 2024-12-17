<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RelatorioAtividadesPendentes extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model("consultoria/RelatorioAtividadesPendentes_model", 'rapm');

  }


  public function index() {
    $this->load->view('consultoria/RelatorioAtividadesPendentes');
  }


  public function fetchAtividadesPendentes() {
    $CBR_CODIGO = $this->input->post("CBR_CODIGO");

    $data = $this->rapm->fetchAtividadesPendentes($CBR_CODIGO);
    $arrayData = array();
    foreach ($data as $key) {
      array_push($arrayData, $data = array(
        "AEA_CBRCODIGO" => $key["AEA_CBRCODIGO"],
        "ATG_CODIGO" => $key["ATG_CODIGO"],
        "ATG_DESCRICAO" => $key["ATG_DESCRICAO"],
        "ATG_PORCENTAGEMAPRONTADA" => $key["ATG_PORCENTAGEMAPRONTADA"],
        "ATG_QTHORA" => $key["ATG_QTHORA"],
        "PJF_CODIGO" => $key["PJF_CODIGO"],
        "STC_Descricao" => $key["STC_Descricao"],
        "ATG_CHDCodigo" => $key["ATG_CHDCodigo"],
        "PJT_CODIGO" => $key["PJT_CODIGO"],
        "PJT_FlgAnsContratada" => $key["PJT_FlgAnsContratada"],
        "PJT_APELIDO" => $key["PJT_APELIDO"],
        "ATG_AnsPrazo" => $key["ATG_AnsPrazo"],
				"ANS" => $key["ANS"],
				"ATG_AnsCriticidade" => $key["ATG_AnsCriticidade"],
        "HORASAGORAPARAVENCIMENTO" => $key["HORASAGORAPARAVENCIMENTO"],
        "PORCENTAGEMREALIZADA" => $key["PORCENTAGEMREALIZADA"])
      );
    }
    echo json_encode($arrayData);
  }

}
