<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtmLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("contrato/CtmLista_model", 'lctm');
    }

    public function index() {
        $this->load->view('contrato/CtmLista');
    }
    
    public function CtmEdita($id) {
        $data['ArrayEditaCTM'] = $this->lctm->GetContratosMaster($id);
	    $data['statusContratos'] = $this->lctm->getStatusContratos();
		$data['unidadesContrato'] = $this->lctm->getUnidadesContrato();
		$data['tiposContratos'] = $this->lctm->getTiposContratos();
		$data['condicoesfaturamento'] = $this->lctm->getCondicaoFaturamento();
		$data['condicoespagamento'] = $this->lctm->getCondicaoPagamento();
		$data['todosClientes'] = $this->lctm->getClientes();
        $this->load->view('contrato/CtmEdita', $data);
    }

	public function imprimirCondicaoFaturamento() {
        // Chama o método do model para obter os dados
        $dadosFaturamento = $this->lctm->getCondicaoFaturamento();

        // Verifica se há dados para imprimir
        if (!empty($dadosFaturamento)) {
            echo "<pre>";
            print_r($dadosFaturamento);
            echo "</pre>";
        } else {
            echo "Nenhum dado encontrado.";
        }
    }
    
    public function GetContratosMaster() {
        $pCTM_Codigo = $this->input->post('ctmCodigo');  // Recebe o parâmetro null ou outro valor
        $data = $this->lctm->GetContratosMaster($pCTM_Codigo);  // Passa o parâmetro para o Model
        echo json_encode($data);
    }
    
    public function listarStatusContratos() {
        $data['statusContratos'] = $this->lctm->getStatusContratos();
        $this->load->view('contrato/listarStatusContratos', $data);
    }




	public function buscarPessoasDoCliente() {
		$clienteCodigo = $this->input->post('clienteCodigo');
		$pessoas = $this->lctm->getPessoasDoCliente($clienteCodigo);
		//print_r($pessoas);
		echo json_encode($pessoas);
	}

	public function buscarDadosPessoaDoCliente() {
		$clpCodigo = $this->input->post('clpCodigo'); // Obtém o ID do responsável
		$clienteCodigo = $this->input->post('clienteCodigo'); // Obtém o ID do cliente
		$dadosResponsavel = $this->lctm->getDadosPessoaDoCliente($clienteCodigo, $clpCodigo);
		print_r($dadosResponsavel);
		//echo json_encode($dadosResponsavel);
	}

	public function buscarColaboradores() {
		$pCBRCodigo = $this->input->post('pCBRCodigo'); // Opcional
		$pMostraTudo = $this->input->post('pMostraTudo'); // Opcional (0 ou 1)
		// log_message('debug', 'pCBRCodigo controller: ' . $pCBRCodigo . ', pMostraTudo: ' . $pMostraTudo);
		$colaboradores = $this->lctm->getColaboradores($pCBRCodigo, $pMostraTudo);
		echo json_encode($colaboradores);
	}

    function UpdateCtm()
    {
        $data = array(            
            "CTM_STTCodigo" => $this->input->post("CTM_STTCodigo"),
            "CTM_TCTCodigo" => $this->input->post("CTM_TCTCodigo"),
            "CTM_UPCCodigo" => $this->input->post("CTM_UPCCodigo"),
            "CTM_CFCCodigo" => $this->input->post("CTM_CFCCodigo"),
            "CTM_CPGCodigo" => $this->input->post("CTM_CPGCodigo"),
            "CTM_DataRequisicao" => $this->input->post("CTM_DataRequisicao"),
            "CTM_CLICodigo" => $this->input->post("CTM_CLICodigo"),
            "CTM_NumeroWD" => $this->input->post("CTM_NumeroWD"),
            "CTM_Descricao" => $this->input->post("CTM_STTCodigo")
            );
            $pCTM_Codigo = $this->input->post("CTM_Codigo");
            $this->lctm->updateCtm($pCTM_Codigo, $data);
    }

    public function CtmCria()
    {             
        $this->load->view('contrato/CtmNovo');
    }

    function InsertCtm()
    {
        $data = array(
            "CTM_STTCodigo" => $this->input->post("CTM_STTCodigo"),
            "CTM_TCTCodigo" => $this->input->post("CTM_TCTCodigo"),
            "CTM_UPCCodigo" => $this->input->post("CTM_UPCCodigo"),
            "CTM_CFCCodigo" => $this->input->post("CTM_CFCCodigo"),
            "CTM_CPGCodigo" => $this->input->post("CTM_CPGCodigo"),
            "CTM_DataRequisicao" => $this->input->post("CTM_DataRequisicao"),
            "CTM_CLICodigo" => $this->input->post("CTM_CLICodigo"),
            "CTM_NumeroWD" => $this->input->post("CTM_NumeroWD"),
            "CTM_Descricao" => $this->input->post("CTM_STTCodigo")
            );
            $this->lctm->InsertCtm($data);
    }

}
