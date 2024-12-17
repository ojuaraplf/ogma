<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CbrLista extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("administrativo/CbrLista_model", 'cbrli');
    }

    public function CbrLista()
    {               
        $this->load->view('administrativo/CbrLista');
    }

    public function CbrFechaMes()
    {
        $aCBRCodigo = 0;
        $aMostraTudo = 0;        
        $data['Cbres'] = $this->cbrli->fetchCbr($aCBRCodigo, $aMostraTudo);
        $this->load->view('administrativo/CbrFechaMes', $data);
    }
    
    public function CbrEdita($id)
    {
        $data['colaborador'] = $this->cbrli->fetchSingleColaborador($id);
        $data['ogrh_CBU_RemuneraUnidade'] = $this->cbrli->fetchogrh_CBU_RemuneraUnidade();
        $data['ogrh_CGO_DescricaoCargo'] = $this->cbrli->fetchogrh_CGO_DescricaoCargo();
        $data['ogma_PES_Pessoa'] = $this->cbrli->fetchogma_PES_Pessoa();

        $this->load->view('administrativo/CbrEdita', $data);
    }
    
    public function fetchCbr() {

        $pCBRCodigo = $this->input->post("pCBRCodigo");
        $pMostraTudo = $this->input->post("pMostraTudo");
		$data = $this->cbrli->fetchCbr($pCBRCodigo, $pMostraTudo);
		echo json_encode($data);		
	}

    public function FechaMesFech() {

        $aCBRCodigo = $this->input->post("PCBRCodigo");
	    $aMes = $this->input->post("PMes");
	    $aAbreProjeto = $this->input->post("PAbreProjeto");

		$data = $this->cbrli->FechaMesFech($aCBRCodigo, $aMes, $aAbreProjeto);
		echo json_encode($data);		
	}

    public function CbrNovo()
    {
        $data['ogma_PES_Selecao01'] = $this->cbrli->fetchogma_PES_Selecao01();
        $data['ogrh_CBU_RemuneraUnidade'] = $this->cbrli->fetchogrh_CBU_RemuneraUnidade();
        $data['ogrh_CGO_DescricaoCargo'] = $this->cbrli->fetchogrh_CGO_DescricaoCargo();
        $data['ogma_PES_Pessoa'] = $this->cbrli->fetchogma_PES_Pessoa();
        $this->load->view('administrativo/CbrNovo', $data);
    }

    public function fetchPessEmpr() {
		$data = $this->cbrli->fetchogma_PES_Pessoa();
		echo json_encode($data);		
	}

    public function salvarPesNovo()
	{
		$data = array(
		"PES_Nome" => $this->input->post("PES_Nome"),
        "PES_TipoFouJ" => $this->input->post("PES_TipoFouJ"),
        "PES_MomCadastro" => $this->input->post("PES_MomCadastro"),        
        "PES_Apelido" => $this->input->post("PES_Apelido"),		
		"PES_ContEmail" => $this->input->post("PES_ContEmail")
		);
		
		$rPesNova = $this->cbrli->salvarPesNovo($data);		
		echo $rPesNova;
	}

    public function InsertCbrQuick()
	{
		$data = array(
           "CBR_PESCodigo" => $this->input->post("CBR_PESCodigo"),
           "CBR_USULogin" => $this->input->post("CBR_USULogin")
        );
	 	$this->cbrli->InsertCbr($data);
		return true;
	}

    public function InsertCbrAll()
    {
        
        $data = array(
            "CBR_PESCodigo" => $this->input->post("CBR_PESCodigo"),
            "CBR_CBUCodigo" => $this->input->post("CBR_CBUCodigo"),
            "CBR_FlgRemuneraQuebrado" => $this->input->post("CBR_FlgRemuneraQuebrado"),
            "CBR_RemuneraValor" => $this->input->post("CBR_RemuneraValor"),
            "CBR_PESempCodigo" => $this->input->post("CBR_PESempCodigo"),
            "CBR_CGOcodigo" => $this->input->post("CBR_CGOcodigo"),
            "CBR_USULogin" => $this->input->post("CBR_USULogin")
        );

        echo $this->cbrli->InsertCbr($data);
    }

}
