<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CliLista extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("comercial/CliLista_model", 'mcli');
	}

	public function CliLista() {
		$this->load->view('comercial/CliLista');
	}

	public function fetchCliLista()
    {
        $pMostraTudo = $this->input->post("optionMostraTudo");
		
        $data = $this->mcli->Fetchogco_CLI_Selecao01($pMostraTudo);
        echo json_encode($data);
    }

    public function CliEdita($Id) {
		$Data['CliEdita'] = $this->mcli->fetchEditaCli($Id);
		$this->load->view('comercial/CliEdita', $Data);
	}

	public function UpdateCliEdita()	{

		$vCLI_PESCodigo = $this->input->post("vCLI_PESCodigo");
		$vCLI_VhSysClienteId = $this->input->post("vCLI_VhSysClienteId");

		$data = array(
			"CLI_PESCodigo" => $vCLI_PESCodigo,
			"CLI_VhSysClienteId" => $vCLI_VhSysClienteId
		);
		echo $this->mcli->UpdateCliEdita($vCLI_PESCodigo, $data);
		
	}

	public function CliNovo() {

		$FouJ = null;
		$CliTipo = 'CLI';

		$data['ogma_PES_Selecao01'] = $this->mcli->fetchogma_PES_Selecao01($FouJ, $CliTipo);
		$this->load->view('comercial/CliNovo', $data);
	}

	public function fetchPessoaDoCLiente()
    {
        $pCLI = $this->input->post("pCLICodigo");
        $data = $this->mcli->FechCLP_Selecao02_DoCliente($pCLI);
        echo json_encode($data);
    }

	public function fetchPessoaParaCLiente()
    {
		$FouJ = $this->input->post("pFouJ");
		$CliTipo = $this->input->post("pCliTipo");

		$FouJ = $FouJ == '0' ? null : $FouJ;
		$CliTipo = $CliTipo == '0' ? null : $CliTipo;
		
        $data = $this->mcli->fetchogma_PES_Selecao01($FouJ, $CliTipo);
        echo json_encode($data);
    }
	
	public function AdicionaCli()
    {
        $vCLI_PESCodigo = $this->input->post("vCLI_PESCodigo");
        $vCLI_VhSysClienteId = $this->input->post("vCLI_VhSysClienteId");
        
         $data = array(
            "CLI_PESCodigo" => $vCLI_PESCodigo,
            "CLI_VhSysClienteId" => $vCLI_VhSysClienteId
        );

        echo $this->mcli->AdicionaCli($data);
    }

	function updateCliPessoa()
	{
		$arrayCliPessoa = $this->input->post("arrayCliPessoa");
		$this->mcli->updateCliPessoa($arrayCliPessoa);
	}

	function DeletedCliPessoa()
	{
		$arrayDeletedCliPessoa = $this->input->post("arrayDeletedCliPessoa");
		$this->mcli->DeletedCliPessoa($arrayDeletedCliPessoa);
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
		
		$rPesNova = $this->mcli->salvarPesNovo($data);		
		echo $rPesNova;
	}

	public function salvarCliNovo()
	{
		$data = array(
		"CLI_PESCodigo" => $this->input->post("CLI_PESCodigo")
	);
		
		$this->mcli->salvarCliNovo($data);
		return true;
	}

	public function salvarClpNovo()
	{
		$data = array(
		"CLP_CLICodigo" => $this->input->post("CLP_CLICodigo"),
		"CLP_PESCodigo" => $this->input->post("CLP_PESCodigo")
	);
		$this->mcli->salvarClpNovo($data);
		return true;
	}
}