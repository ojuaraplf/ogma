<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class StcLista extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("configuracao/StcLista_model", 'lstc');
		}

		public function index() {
			$this->load->view('configuracao/StcLista.php');
		}
    
    public function STCEdita($Id) {

      $Data['status'] = $this->lstc->fetchEditaStc($Id);
      
			$this->load->view('configuracao/StcEdita.php', $Data);
		}
    
    public function fetchStc() {
      $data = $this->lstc->fetchStc();
      $arrayData = array();
      foreach ($data as $key) {
        array_push($arrayData, $data = array(
          "STC_Codigo" => $key["STC_Codigo"],
          "STC_Descricao" => $key["STC_Descricao"],
          "STC_FlgChamadoAtivo" => $key["STC_FlgChamadoAtivo"],
          "STC_FlgRespdadeCliente" => $key["STC_FlgRespdadeCliente"],
          "STC_FlgMostraAvaliacao" => $key["STC_FlgMostraAvaliacao"],
          "STC_FlgMostraTrd" => $key["STC_FlgMostraTrd"],
          "STC_DeAbertura" => $key["STC_DeAbertura"],
          "STC_DeExecucao" => $key["STC_DeExecucao"],
          "STC_FlgMostraOrcamento" => $key["STC_FlgMostraOrcamento"],
          "STC_FlgMostraRetornoNecessario" => $key["STC_FlgMostraRetornoNecessario"],
          "STC_DeAtendimento" => $key["STC_DeAtendimento"],
          "STC_FlgParaFaturamento" => $key["STC_FlgParaFaturamento"],
          "STC_FlgApareceSirius" => $key["STC_FlgApareceSirius"])          
        );
      }
      echo json_encode($arrayData);
    }
    
    public function UpdateStc()
    {
        $STC_Codigo = $this->input->post("STC_Codigo");
        $STC_Descricao = $this->input->post("STC_Descricao");
        $STC_FlgChamadoAtivo = $this->input->post("STC_FlgChamadoAtivo");
        $STC_FlgRespdadeCliente = $this->input->post("STC_FlgRespdadeCliente");
        $STC_FlgMostraAvaliacao = $this->input->post("STC_FlgMostraAvaliacao");
        $STC_FlgMostraTrd = $this->input->post("STC_FlgMostraTrd");
        $STC_DeAbertura = $this->input->post("STC_DeAbertura");
        $STC_DeExecucao = $this->input->post("STC_DeExecucao");
        $STC_FlgMostraOrcamento = $this->input->post("STC_FlgMostraOrcamento");
        $STC_FlgMostraRetornoNecessario = $this->input->post("STC_FlgMostraRetornoNecessario");
        $STC_DeAtendimento = $this->input->post("STC_DeAtendimento");
        $STC_FlgParaFaturamento = $this->input->post("STC_FlgParaFaturamento");
        $STC_FlgApareceSirius = $this->input->post("STC_FlgApareceSirius");
        

        $data = array(
            "STC_Codigo" => $STC_Codigo,
            "STC_Descricao" => $STC_Descricao,
            "STC_FlgChamadoAtivo" => $STC_FlgChamadoAtivo,
            "STC_FlgRespdadeCliente" => $STC_FlgRespdadeCliente,
            "STC_FlgMostraAvaliacao" => $STC_FlgMostraAvaliacao,
            "STC_FlgMostraTrd" => $STC_FlgMostraTrd,
            "STC_DeAbertura" => $STC_DeAbertura,
            "STC_DeExecucao" => $STC_DeExecucao,
            "STC_FlgMostraOrcamento" => $STC_FlgMostraOrcamento,
            "STC_FlgMostraRetornoNecessario" => $STC_FlgMostraRetornoNecessario,
            "STC_DeAtendimento" => $STC_DeAtendimento,
            "STC_FlgParaFaturamento" => $STC_FlgParaFaturamento,
            "STC_FlgApareceSirius" => $STC_FlgApareceSirius
            
        );

        echo $this->lstc->UpdateStc($STC_Codigo, $data);
    }
}



