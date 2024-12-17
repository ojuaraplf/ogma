<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class TorLista extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("configuracao/TorLista_model", 'lmtor');
		}

		public function TorLista() {
			$this->load->view('configuracao/TorLista');
		}
    
    public function fetchTorLista()
    {
        $pTOR_Codigo = $this->input->post("vTOR_Codigo");
        $pIncluirDesativa = $this->input->post("vIncluirDesativa");
        $data = $this->lmtor->fetchTorLista($pTOR_Codigo, $pIncluirDesativa );
        echo json_encode($data);
    }

    public function TorEdita($pTOR_Codigo) {

      $pIncluirDesativa = 0;
      //$pTOCoptId = NULL;
      //$pTOBoptId = NULL;
      
      $Data['TorEdita'] = $this->lmtor->fetchTorEdita($pTOR_Codigo, $pIncluirDesativa);
      //$Data['OptTOB'] = $this->lmtor->fetchTOB($pTOBoptId);
      //$Data['OptTOC'] = $this->lmtor->fetchTOC($pTOCoptId);

      // print_r($Data['OptTOC']);
			$this->load->view('configuracao/TorEdita.php', $Data);
		}

    public function TorNovo() {
      // $pTOCoptId = NULL;
      // $pTOBoptId = NULL;
      // $Data['OptTOB'] = $this->lmtor->fetchTOB($pTOBoptId);
      // $Data['OptTOC'] = $this->lmtor->fetchTOC($pTOCoptId);
			$this->load->view('configuracao/TorNovo.php');
		}

    public function SelTOC() {
      $data = $this->lmtor->fetchTOC(NULL);
      $arrayData = array();
      foreach ($data as $key) {
        array_push(
          $arrayData,
          $data = array(
            "TOC_Codigo" => $key["TOC_Codigo"],
            "TOC_Descricao" => $key["TOC_Descricao"],
            "TOC_Descritivo" => $key["TOC_Descritivo"]
          )
        );
      }
      echo json_encode($arrayData);
    }

    public function SelTOB() {
      $data = $this->lmtor->fetchTOB(NULL);
      $arrayData = array();
      foreach ($data as $key) {
        array_push(
          $arrayData,
          $data = array(
            "TOB_Codigo" => $key["TOB_Codigo"],
            "TOB_Descricao" => $key["TOB_Descricao"],
            "TOB_Descritivo" => $key["TOB_Descritivo"]
          )
        );
      }
      echo json_encode($arrayData);
    }
    
    public function UpdateTor()
    {
          $data = array(
             "TOR_Codigo" => $this->input->post("TOR_Codigo"),
             "TOR_Nome" => $this->input->post("TOR_Nome"),
             "TOR_Descricao" => $this->input->post("TOR_Descricao"),
             "TOR_OptClasseFaturamento" => $this->input->post("TOR_OptClasseFaturamento"),
             "TOR_OptBaseFaturamento" => $this->input->post("TOR_OptBaseFaturamento"),
             "TOR_FlgAtgFaturavel" => $this->input->post("TOR_FlgAtgFaturavel")
        );
        echo $this->lmtor->UpdateTor($this->input->post("TOR_Codigo"), $data);
    }

    public function NewTor()
    {   
         $data = array(
            "TOR_Nome" => $this->input->post("TOR_Nome"),
            "TOR_Descricao" => $this->input->post("TOR_Descricao"),
            "TOR_OptClasseFaturamento" => $this->input->post("TOR_OptClasseFaturamento"),
            "TOR_OptBaseFaturamento" => $this->input->post("TOR_OptBaseFaturamento"),
            "TOR_FlgAtgFaturavel" => $this->input->post("TOR_FlgAtgFaturavel")
        );

      echo $this->lmtor->NewTor($data);
    }
}