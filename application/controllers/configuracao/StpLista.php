<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class StpLista extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("configuracao/StpLista_model", 'lstp');
		}

		public function index() {
			$this->load->view('configuracao/StpLista.php');
		}
    
    public function STPEdita($Id) {

      $Data['status'] = $this->lstp->fetchEditaStp($Id);
      
			$this->load->view('configuracao/StpEdita.php', $Data);
		}
    
    public function fetchStp() {
      $data = $this->lstp->fetchStp();
      $arrayData = array();
      foreach ($data as $key) {
        array_push($arrayData, $data = array(
          "STP_CODIGO" => $key["STP_CODIGO"],
          "STP_DESCRICAO" => $key["STP_DESCRICAO"],
          "STP_FlgEditaPjtCabecalho" => $key["STP_FlgEditaPjtCabecalho"],
          "STP_FlgEditaFasCabecalho" => $key["STP_FlgEditaFasCabecalho"],
          "STP_FlgEditaFasDeclaEscopo" => $key["STP_FlgEditaFasDeclaEscopo"],
          "STP_FlgEditaFasExecucao" => $key["STP_FlgEditaFasExecucao"],
          "STP_FlgEditaFasPartesInteressadas" => $key["STP_FlgEditaFasPartesInteressadas"],
          "STP_FlgEditaFasContingencias" => $key["STP_FlgEditaFasContingencias"],
          "STP_FlgEditaFasAgenda" => $key["STP_FlgEditaFasAgenda"],
          "STP_FlgEditaFasHomologacao" => $key["STP_FlgEditaFasHomologacao"],
          "STP_FlgApontaHora" => $key["STP_FlgApontaHora"],
          "STP_FlgProjetoAtivo" => $key["STP_FlgProjetoAtivo"],
          "STP_FlgProjetoEmExecucao" => $key["STP_FlgProjetoEmExecucao"],
          "STP_FlgProjetoParaFaturamento" => $key["STP_FlgProjetoParaFaturamento"])
        );
      }
      echo json_encode($arrayData);
    }
    
    public function UpdateStp()
    {

        $STP_CODIGO = $this->input->post("STP_CODIGO");
        $STP_DESCRICAO = $this->input->post("STP_DESCRICAO");
        $STP_FlgEditaPjtCabecalho = $this->input->post("STP_FlgEditaPjtCabecalho");
        $STP_FlgEditaFasCabecalho = $this->input->post("STP_FlgEditaFasCabecalho");
        $STP_FlgEditaFasDeclaEscopo = $this->input->post("STP_FlgEditaFasDeclaEscopo");
        $STP_FlgEditaFasExecucao = $this->input->post("STP_FlgEditaFasExecucao");
        $STP_FlgEditaFasPartesInteressadas = $this->input->post("STP_FlgEditaFasPartesInteressadas");
        $STP_FlgEditaFasContingencias = $this->input->post("STP_FlgEditaFasContingencias");
        $STP_FlgEditaFasAgenda = $this->input->post("STP_FlgEditaFasAgenda");
        $STP_FlgEditaFasHomologacao = $this->input->post("STP_FlgEditaFasHomologacao");
        $STP_FlgApontaHora = $this->input->post("STP_FlgApontaHora");
        $STP_FlgProjetoAtivo = $this->input->post("STP_FlgProjetoAtivo");
        $STP_FlgProjetoEmExecucao = $this->input->post("STP_FlgProjetoEmExecucao");
        $STP_FlgProjetoParaFaturamento = $this->input->post("STP_FlgProjetoParaFaturamento");

        $data = array(

            "STP_CODIGO" => $STP_CODIGO,
            "STP_DESCRICAO" => $STP_DESCRICAO,
            "STP_FlgEditaPjtCabecalho" => $STP_FlgEditaPjtCabecalho,
            "STP_FlgEditaFasCabecalho" => $STP_FlgEditaFasCabecalho,
            "STP_FlgEditaFasDeclaEscopo" => $STP_FlgEditaFasDeclaEscopo,
            "STP_FlgEditaFasExecucao" => $STP_FlgEditaFasExecucao,
            "STP_FlgEditaFasPartesInteressadas" => $STP_FlgEditaFasPartesInteressadas,
            "STP_FlgEditaFasContingencias" => $STP_FlgEditaFasContingencias,
            "STP_FlgEditaFasAgenda" => $STP_FlgEditaFasAgenda,
            "STP_FlgEditaFasHomologacao" => $STP_FlgEditaFasHomologacao,
            "STP_FlgApontaHora" => $STP_FlgApontaHora,
            "STP_FlgProjetoAtivo" => $STP_FlgProjetoAtivo,
            "STP_FlgProjetoEmExecucao" => $STP_FlgProjetoEmExecucao,
            "STP_FlgProjetoParaFaturamento" => $STP_FlgProjetoParaFaturamento
        );

        echo $this->lstp->UpdateStp($STP_CODIGO, $data);
    }
}



