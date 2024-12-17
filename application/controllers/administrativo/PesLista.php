<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesLista extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("administrativo/PesLista_model", 'pes');
	}

	public function index() {
		$this->load->view('administrativo/PesLista');
	}

	public function Fetch_PES_Pessoa() {
		$data = $this->pes->Fetch_PES_Pessoa();
		echo json_encode($data);		
	}

    public function singlePesEdita($id)
    {
        $data['singlePesEdita'] = $this->pes->fetchSinglePesEdita($id);
       
        $this->load->view('administrativo/PesEdita', $data);
    }

	public function singlePesNovo()
    {
        $this->load->view('administrativo/PesNovo');
    }

	public function updatePesEdita($id)
	{

		$PES_Nome = $this->input->post("PES_Nome");
        $PES_TipoFouJ = $this->input->post("PES_TipoFouJ");
        $PES_MomCadastro = $this->input->post("PES_MomCadastro");
        $PES_CnpjCpf = $this->input->post("PES_CnpjCpf");
        $PES_Apelido = $this->input->post("PES_Apelido");
		$PES_EndLogradouro = $this->input->post("PES_EndLogradouro");
		$PES_EndNumero = $this->input->post("PES_EndNumero");
		$PES_EndBairro = $this->input->post("PES_EndBairro");
		$PES_EndComplemento = $this->input->post("PES_EndComplemento");
		$PES_EndCEP = $this->input->post("PES_EndCEP");
		$PES_ContEmail = $this->input->post("PES_ContEmail");
		$PES_ContTelefone1 = $this->input->post("PES_ContTelefone1");
		$PES_ContTelefone2 = $this->input->post("PES_ContTelefone2");
		$PES_ContSkype = $this->input->post("PES_ContSkype");
		$PES_ContFacebook = $this->input->post("PES_ContFacebook");
		$PES_ContLinkedin = $this->input->post("PES_ContLinkedin");

		$data = array(
		"PES_Nome" => $PES_Nome,
        "PES_TipoFouJ" => $PES_TipoFouJ,
        "PES_MomCadastro" => $PES_MomCadastro,
        "PES_CnpjCpf" => $PES_CnpjCpf,
        "PES_Apelido" => $PES_Apelido,
		"PES_EndLogradouro" => $PES_EndLogradouro,
		"PES_EndNumero" => $PES_EndNumero,
		"PES_EndBairro" => $PES_EndBairro,
		"PES_EndComplemento" => $PES_EndComplemento,
		"PES_EndCEP" => $PES_EndCEP,
		"PES_ContEmail" => $PES_ContEmail,
		"PES_ContTelefone1" => $PES_ContTelefone1,
		"PES_ContTelefone2" => $PES_ContTelefone2,
		"PES_ContSkype" => $PES_ContSkype,
		"PES_ContFacebook" => $PES_ContFacebook,
		"PES_ContLinkedin" => $PES_ContLinkedin
		);
		echo $this->pes->updatePesEdita($id, $data);

	}
  
	public function salvarPesNovo()
	{
		$PES_Nome = $this->input->post("PES_Nome");
        $PES_TipoFouJ = $this->input->post("PES_TipoFouJ");
        $PES_MomCadastro = $this->input->post("PES_MomCadastro");
        $PES_CnpjCpf = $this->input->post("PES_CnpjCpf");
        $PES_Apelido = $this->input->post("PES_Apelido");
		$PES_EndLogradouro = $this->input->post("PES_EndLogradouro");
		$PES_EndNumero = $this->input->post("PES_EndNumero");
		$PES_EndBairro = $this->input->post("PES_EndBairro");
		$PES_EndComplemento = $this->input->post("PES_EndComplemento");
		$PES_EndCEP = $this->input->post("PES_EndCEP");
		$PES_ContEmail = $this->input->post("PES_ContEmail");
		$PES_ContTelefone1 = $this->input->post("PES_ContTelefone1");
		$PES_ContTelefone2 = $this->input->post("PES_ContTelefone2");
		$PES_ContSkype = $this->input->post("PES_ContSkype");
		$PES_ContFacebook = $this->input->post("PES_ContFacebook");
		$PES_ContLinkedin = $this->input->post("PES_ContLinkedin");

		$data = array(
		"PES_Nome" => $PES_Nome,
        "PES_TipoFouJ" => $PES_TipoFouJ,
        "PES_MomCadastro" => $PES_MomCadastro,
        "PES_CnpjCpf" => $PES_CnpjCpf,
        "PES_Apelido" => $PES_Apelido,
		"PES_EndLogradouro" => $PES_EndLogradouro,
		"PES_EndNumero" => $PES_EndNumero,
		"PES_EndBairro" => $PES_EndBairro,
		"PES_EndComplemento" => $PES_EndComplemento,
		"PES_EndCEP" => $PES_EndCEP,
		"PES_ContEmail" => $PES_ContEmail,
		"PES_ContTelefone1" => $PES_ContTelefone1,
		"PES_ContTelefone2" => $PES_ContTelefone2,
		"PES_ContSkype" => $PES_ContSkype,
		"PES_ContFacebook" => $PES_ContFacebook,
		"PES_ContLinkedin" => $PES_ContLinkedin
		);

		$this->pes->salvarPesNovo($data);
		return true;
	}
	



	// public function updatePesEdita($id)
    // {
    //     $PES_TipoFouJ = $this->input->post("PES_TipoFouJ");
    //     $PES_Nome = $this->input->post("PES_Nome");
    //     $PES_MomCadastro = $this->input->post("PES_MomCadastro");
    //     $PES_CnpjCpf = $this->input->post("PES_CnpjCpf");
    //     $PES_Apelido = $this->input->post("PES_Apelido");
    //     $PES_EndLogradouro = $this->input->post("PES_EndLogradouro");
	// 	$PES_EndNumero = $this->input->post("PES_EndNumero");
	// 	$PES_EndBairro = $this->input->post("PES_EndBairro");
	// 	$PES_EndComplemento = $this->input->post("PES_EndComplemento");
	// 	$PES_EndCEP = $this->input->post("PES_EndCEP");
	// 	$PES_ContTelefone1 = $this->input->post("PES_ContTelefone1");
	// 	$PES_ContTelefone2 = $this->input->post("PES_ContTelefone2");
	// 	$PES_ContSkype = $this->input->post("PES_ContSkype");
	// 	$PES_ContFacebook = $this->input->post("PES_ContFacebook");
	// 	$PES_ContLinkedin = $this->input->post("PES_ContLinkedin");
	// 	$PES_MomDesativa = $this->input->post("PES_MomDesativa");

    //     $data = array(
    //         "PES_TipoFouJ" => $PES_TipoFouJ,
    //         "PES_Nome" => $PES_Nome,
    //         "PES_MomCadastro" => $PES_MomCadastro,
    //         "PES_CnpjCpf" => $PES_CnpjCpf,
    //         "PES_Apelido" => $PES_Apelido,
    //         "PES_EndLogradouro" => $PES_EndLogradouro,
	// 		"PES_EndNumero" => $PES_EndNumero,
	// 		"PES_EndBairro" => $PES_EndBairro,
	// 		"PES_EndComplemento" => $PES_EndComplemento,
	// 		"PES_EndCEP" => $PES_EndCEP,
	// 		"PES_ContTelefone1" => $PES_ContTelefone1,
	// 		"PES_ContTelefone2" => $PES_ContTelefone2,
	// 		"PES_ContSkype" => $PES_ContSkype,
	// 		"PES_ContFacebook" => $PES_ContFacebook,
	// 		"PES_ContLinkedin" => $PES_ContLinkedin,
	// 		"PES_MomDesativa" => $PES_MomDesativa

    //     );

    //     echo $this->pes->updatePesEdita($id, $data);
    // }


}