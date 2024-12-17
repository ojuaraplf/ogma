<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parceiro extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//$this->load->library('curl');
		$this->load->helper('url');
		$this->load->model("administrativo/parceiro_model", 'pes');
	}


	public function index()
	{
		$this->load->view('administrativo/parceiro');
	}


	public function listaparceiros()
	{
		$retorno = $this->pes->listaparceiros();

		$arrayData = array();

		foreach ($retorno as $resultados) {
			array_push(
				$arrayData,
				$retorno = array(
					"PES_Codigo" => $resultados["PES_Codigo"],
					"PAR_Vhsys_Id_Cliente" => $resultados["PAR_Vhsys_Id_Cliente"],
					"PES_NOME" => $resultados["PES_NOME"],
					"PES_CnpjCpf" => $resultados["PES_CnpjCpf"]
				)
			);
		}

		echo json_encode($arrayData);
	}


	public function listasemelhantes()
	{

		$primeironome = $this->input->post("PRIMEIRONOME");	
		
		$retorno = $this->pes->listasemelhantes($primeironome);

		$arrayData = array();

		foreach ($retorno as $resultados) {
			array_push(
				$arrayData,
				$retorno = array(
					"PES_Codigo" => $resultados["PES_Codigo"],
					"PES_Nome" => $resultados["PES_Nome"],
					"PES_CnpjCpf" => $resultados["PES_CnpjCpf"],
					"PES_ContEmail" => $resultados["PES_ContEmail"],
					"Login" => $resultados["Login"],
					"CBR_REF" => $resultados["CBR_REF"],
					"CBR_PESempCodigo" => $resultados["CBR_PESempCodigo"],
					"CBR_VhSysClienteId" => $resultados["CBR_VhSysClienteId"]
				)
			);
		}

		//echo ' >>>>>>>>>>> ' . $arrayData;
		echo json_encode($arrayData);
	}


	public function consultaws()
	{
		$idParceiro = $this->input->post('idparceiro');
		//echo $this->curl->consultaws($idParceiro);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vhsys.com/v2/clientes/" . $idParceiro,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => 1,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Access-Token: KVeMbfINgdNWEXHPDUCgBADCXUVBgd",
              "Secret-Access-Token: wdaUMoM97fTwPYeOoALznhByEvDgcW",
              "Content-Type: application/json"
            ),
        ));

		$response = curl_exec($curl);

		$retorno = json_decode($response);
	
		if (curl_error($curl)) {
			echo 'Erro: ' . curl_error($curl);
			return false;
		}
		curl_close($curl);
		//print_r($retorno->data);
		//return $response;
		
		echo $response;
		
	}


	public function consultaws_status()
	{
		$idParceiro = $this->input->post('idparceiro');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vhsys.com/v2/clientes/" . $idParceiro,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => 1,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Access-Token: KVeMbfINgdNWEXHPDUCgBADCXUVBgd",
              "Secret-Access-Token: wdaUMoM97fTwPYeOoALznhByEvDgcW",
              "Content-Type: application/json"
            ),
        ));

		$response = curl_exec($curl);
		//$json = json_decode($response);
		//echo $json->status;

	    $j_lista = json_decode($response);
 
    	echo $j_lista->status;
		//return $json;
	}


	public function checarPESCnpjCpf()
	{
		$PES_CnpjCpf = $this->input->post("PES_CnpjCpf");
		$data = $this->pes->checarPESCnpjCpf($PES_CnpjCpf);

		$arrayData = array();

		if(count($data) == 0) {
			array_push(
				$arrayData,
				$data = array(
					"PES_Codigo" => 0,
					"CBR_PESCodigo" => 0,
					"CBR_VhSysClienteId" => 0
				)
			);
		} else {
			foreach ($data as $resultados) {
				array_push(
					$arrayData,
					$data = array(
						"PES_Codigo" => $resultados["PES_Codigo"],
						"CBR_PESCodigo" => $resultados["CBR_PESCodigo"],
						"CBR_VhSysClienteId" => $resultados["CBR_VhSysClienteId"]
					)
				);
			}
		}
		
		echo json_encode($arrayData);
		
	}


	public function cadastraPesPessoa()
	{
		$PES_Nome = $this->input->post("PES_Nome");
		$PES_CnpjCpf = $this->input->post("PES_CnpjCpf");
		$PES_Apelido = $this->input->post("PES_Apelido");
		$PES_EndLogradouro = $this->input->post("PES_EndLogradouro");
		$PES_EndNumero = $this->input->post("PES_EndNumero");
		$PES_EndBairro = $this->input->post("PES_EndBairro");
		$PES_EndCEP = $this->input->post("PES_EndCEP");

		$data = array(
			"PES_Nome" => $PES_Nome,
			"PES_CnpjCpf" => $PES_CnpjCpf,
			"PES_Apelido" => $PES_Apelido,
			"PES_EndLogradouro" => $PES_EndLogradouro,
			"PES_EndNumero" => $PES_EndNumero,
			"PES_EndBairro" => $PES_EndBairro,
			"PES_EndCEP" => $PES_EndCEP
		);
		
		//console.log($data);
		echo $this->pes->cadastraPesPessoa($data);
	}

	/*
	public function cadastraParceiro()
	{
		$ogsv_PAR_Parceiro = $this->input->post("ogsv_PAR_Parceiro");
		$PAR_TipoParceria = $this->input->post("PAR_TipoParceria");
		$PAR_Vhsys_Id_Cliente = $this->input->post("PAR_Vhsys_Id_Cliente");

		$data = array(
			"PAR_PESCodigo" => $ogsv_PAR_Parceiro,
			"PAR_TipoParceria" => $PAR_TipoParceria,
			"PAR_Vhsys_Id_Cliente" => $PAR_Vhsys_Id_Cliente
		);

		echo $this->pes->cadastraParceiro($data);
	}
	*/

	public function atualizaFuncionario()
    {
        $CBR_PESCodigo = $this->input->post("CBR_PESCodigo");
		$CBR_VhSysClienteId = $this->input->post("CBR_VhSysClienteId");

        $data = array(
			"CBR_VhSysClienteId" => $CBR_VhSysClienteId
        );

        echo $this->pes->atualizaFuncionario($CBR_PESCodigo, $data);
    }

	public function cadastraFuncionario()
	{
		
		$CBR_PESCodigo = $this->input->post("CBR_PESCodigo");
		$CBR_VhSysClienteId = $this->input->post("CBR_VhSysClienteId");

		$data = array(
			"CBR_PESCodigo" => $CBR_PESCodigo,
			"CBR_VhSysClienteId" => $CBR_VhSysClienteId
		);

		echo $this->pes->cadastraFuncionario($data);

	}

}
