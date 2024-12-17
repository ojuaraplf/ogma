<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CgoLista extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("administrativo/CgoLista_model", 'cgoli');
    }

    public function CgoLista()
    {        
        $this->load->view('administrativo/CgoLista');
    }
    
    public function fetchCgo() {

        $aCGOCodigo = $this->input->post("pCGOCodigo");
        $aMostraTudo = $this->input->post("pMostraTudo");
		$data = $this->cgoli->fetchCgo($aCGOCodigo, $aMostraTudo);
		echo json_encode($data);		
	}

    public function CgoEdita($pCGOCodigo)
    {
        $aCGOCodigo = $pCGOCodigo;
        $aMostraTudo = 1;

        $data['ArrayCargo'] = $this->cgoli->fetchCgo($aCGOCodigo, $aMostraTudo);
        $data['ArraySetor'] = $this->cgoli->fetchSet();
        $data['ArrayUnida'] = $this->cgoli->fetchCbu();
 
        $this->load->view('administrativo/CgoEdita', $data);
    }

    public function CgoNovo()
    {     
        $data['ArraySetor'] = $this->cgoli->fetchSet();
        $data['ArrayUnida'] = $this->cgoli->fetchCbu();
        $this->load->view('administrativo/CgoNovo', $data);
    }

    function UpdateCargo()
    {
        $data = array(
            "CGO_Titulo" => $this->input->post("CGO_Titulo"),
            "CGO_PapelMissao" => $this->input->post("CGO_PapelMissao"),
            "CGO_Atribuicoes" => $this->input->post("CGO_Atribuicoes"),        
            "CGO_FormacaoMinima" => $this->input->post("CGO_FormacaoMinima"),		
            "CGO_FormExperDesejavel" => $this->input->post("CGO_FormExperDesejavel"),
            "CGO_ExperMinima" => $this->input->post("CGO_ExperMinima"),
            "CGO_SETCodigo" => $this->input->post("CGO_SETCodigo"),
            "CGO_CBUCodigo" => $this->input->post("CGO_CBUCodigo"),
            "CGO_FlgGerenciaPpx" => $this->input->post("CGO_FlgGerenciaPpx"),
            "CGO_FlgExecutaSvco" => $this->input->post("CGO_FlgExecutaSvco")
            );

            $pCGO_Codigo = $this->input->post("CGO_Codigo");
            $this->cgoli->UpdateCargo($pCGO_Codigo, $data);
    }

    function InsertCargo()
    {
        $data = array(
            "CGO_Titulo" => $this->input->post("CGO_Titulo"),
            "CGO_PapelMissao" => $this->input->post("CGO_PapelMissao"),
            "CGO_Atribuicoes" => $this->input->post("CGO_Atribuicoes"),        
            "CGO_FormacaoMinima" => $this->input->post("CGO_FormacaoMinima"),		
            "CGO_FormExperDesejavel" => $this->input->post("CGO_FormExperDesejavel"),
            "CGO_ExperMinima" => $this->input->post("CGO_ExperMinima"),
            "CGO_SETCodigo" => $this->input->post("CGO_SETCodigo"),
            "CGO_CBUCodigo" => $this->input->post("CGO_CBUCodigo"),
            "CGO_FlgGerenciaPpx" => $this->input->post("CGO_FlgGerenciaPpx"),
            "CGO_FlgExecutaSvco" => $this->input->post("CGO_FlgExecutaSvco")
            );

            $this->cgoli->InsertCargo($data);
    }

}
