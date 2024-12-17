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
		$data['RecursosGeral'] = $this->lctm->getRecursosGeral();
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

	public function getParcelasDoContrato() {
        $ctmCodigo = $this->input->post('ctmCodigo');
        $dadosParcelas = $this->lctm->getParcelasDoContratoMaster($ctmCodigo);
		//print_r($dadosParcelas);
		echo json_encode($dadosParcelas);
    }

    public function UpdateContratosMaster() {
		// Coleta os dados do contrato com tratamento para valores nulos
		$dadosContrato = array(
			'CTM_Codigo' => $this->input->post('CTM_Codigo'),
			'CTM_STTCodigo' => $this->input->post('CTM_STTCodigo') ?: 1,
			'CTM_TCTCodigo' => $this->input->post('CTM_TCTCodigo') ?: 1,
			'CTM_UPCCodigo' => $this->input->post('CTM_UPCCodigo') ?: 1,
			'CTM_CFCCodigo' => $this->input->post('CTM_CFCCodigo') ?: 1,
			'CTM_CPGCodigo' => $this->input->post('CTM_CPGCodigo') ?: 1,
			'CTM_DataRequisicao' => $this->input->post('CTM_DataRequisicao'),
			'CTM_DataAceite' => $this->input->post('CTM_DataAceite'),
			'CTM_DataVigenciaIni' => $this->input->post('CTM_DataVigenciaIni'),
			'CTM_DataVigenciaFim' => $this->input->post('CTM_DataVigenciaFim'),
			'CTM_NumeroWD' => $this->input->post('CTM_NumeroWD'),
			'CTM_Descricao' => $this->input->post('CTM_Descricao'),
			'CTM_NumeroCliente' => $this->input->post('CTM_NumeroCliente'),
			'CTM_TituloCliente' => $this->input->post('CTM_TituloCliente'),
			'CTM_Procedimento' => $this->input->post('CTM_Procedimento'),
			'CTM_LinkProposta' => $this->input->post('CTM_LinkProposta'),
			'CTM_LinkContrato' => $this->input->post('CTM_LinkContrato'),
			'CTM_CLICodigo' => $this->input->post('CTM_CLICodigo') ?: null,
			'CTM_CLPCodigo' => $this->input->post('CTM_CLPCodigo') ?: null,
			'CTM_CBRGestorWdCodigo' => $this->input->post('CTM_CBRGestorWdCodigo') ?: null,
			'CTM_CBRFinancWdCodigo' => $this->input->post('CTM_CBRFinancWdCodigo') ?: null,
			'CTM_QtdeHoraTotal' => $this->input->post('CTM_QtdeHoraTotal'),
			'CTM_ValorTotal' => $this->input->post('CTM_ValorTotal'),
			'CTM_CorrecaoIndice' => $this->input->post('CTM_CorrecaoIndice'),
			'CTM_CorrecaoPercent' => $this->input->post('CTM_CorrecaoPercent')
		);

		// Tenta atualizar o contrato e verifica o resultado
		if ($this->lctm->UpdateContratosMaster($dadosContrato)) {
			// Sucesso
			echo json_encode(['status' => 'success']);
		} else {
			// Falha
			echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o contrato.']);
		}
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

	public function UpdateParcelas() {
		$parcelas = $this->input->post('parcelas');
		$linhasFinanRemovidas = $this->input->post('linhasFinanRemovidas');
		$CTM_Codigo = $this->input->post('CTM_Codigo');
		foreach ($parcelas as $parcela) {
			if (empty($parcela['CTP_Codigo']) || $parcela['CTP_Codigo'] === null || $parcela['CTP_Codigo'] === 'null') {
				$this->lctm->inserirParcela($CTM_Codigo, $parcela);
			} else {
				$this->lctm->atualizarParcela($parcela);
			}
		}
		if (!empty($linhasFinanRemovidas)) {
			foreach ($linhasFinanRemovidas as $id) {
				$this->lctm->excluirParcela($id);
			}
		}
		echo json_encode(['status' => 'success']);
	}

	public function getRecursosDoContratoMaster() {
		$ctmCodigo = $this->input->post('ctmCodigo');
		$ctrCodigo = $this->input->post('ctrCodigo') === "" ? null : $this->input->post('ctrCodigo');
		$dadosRecursos = $this->lctm->getRecursosDoContratoMaster($ctmCodigo, $ctrCodigo);
		echo json_encode($dadosRecursos);
	}

	// Function feita apenas para checar o resultado da model
	public function mostrarDadosDeVolta() {
		// Chama a função no model
		$dadosRecursos = $this->lctm->getRecursosGeral(2,null);

		// Verifica se há dados e imprime
		if (!empty($dadosRecursos)) {
			// Pode ser que você queira retornar como JSON para uma chamada AJAX
			echo json_encode($dadosRecursos);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Nenhum recurso encontrado.']);
		}
	}

	public function UpdateRecursos() {
		$recursos = $this->input->post('recursos');
		$linhasRecurRemovidas = $this->input->post('linhasRecurRemovidas');

		// Verifica se há recursos
		if (!empty($recursos)) {
			foreach ($recursos as $recurso) {
				// Se CTR_Codigo estiver vazio ou nulo, insere um novo recurso
				if (empty($recurso['CTR_Codigo']) || $recurso['CTR_Codigo'] === null || $recurso['CTR_Codigo'] === 'null') {
					$this->lctm->inserirRecurso($recurso['CTR_Codigo'], $recurso);
				} else {
					// Se CTR_Codigo existir, atualiza o recurso
					$this->lctm->atualizarRecurso($recurso);
				}
			}
		}

		// Verifica se há linhas removidas e processa as remoções
		if (!empty($linhasRecurRemovidas)) {
			foreach ($linhasRecurRemovidas as $id) {
				$this->lctm->excluirRecurso($id);  // Corrigido o nome da função para excluir recurso
			}
		}

		// Retorna uma resposta de sucesso
		echo json_encode(['status' => 'success']);
	}


}
