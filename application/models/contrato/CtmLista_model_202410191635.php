<?php

class CtmLista_model extends CI_Model {

    public function GetContratosMaster($pCTM_Codigo) {
        try {
            // Executa o procedimento armazenado
            $query = $this->db->query("CALL ogco_CTM_ListaContratoMaster(?)", array($pCTM_Codigo));
            
            // Recupera o resultado
            $result = $query->result_array();
            
            // Não é necessário chamar next_result() e free_result() para MySQLi se não houver múltiplos result sets
            return !empty($result) ? $result : [];
            
        } catch (Exception $e) {
            // Em caso de erro, você pode logar a mensagem de erro e retornar um array vazio ou null
            log_message('error', 'Erro ao executar o procedimento armazenado: ' . $e->getMessage());
            return [];
        }
    }

	public function getStatusContratos() {
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();     // Avança para o próximo conjunto de resultados
			$this->db->conn_id->store_result();    // Armazena o resultado
		}
		$query = $this->db->get('ogco_STT_StatusContrato');
		return $query->result_array();
	}

	public function getTiposContratos() {
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();     // Avança para o próximo conjunto de resultados
			$this->db->conn_id->store_result();    // Armazena o resultado
		}
		$query = $this->db->get('ogco_TCT_TipoContrato');
		return $query->result_array();
	}

	public function getCondicaoFaturamento() {
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();     // Avança para o próximo conjunto de resultados
			$this->db->conn_id->store_result();    // Armazena o resultado
		}
		$query = $this->db->get('ogfn_CFC_CondicaoFaturamento');
		return $query->result_array();
	}

	public function getCondicaoPagamento() {
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();     // Avança para o próximo conjunto de resultados
			$this->db->conn_id->store_result();    // Armazena o resultado
		}
		$query = $this->db->get('ogfn_CPG_CondicaoPagamento');
		return $query->result_array();
	}

	public function getUnidadesContrato() {
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();     // Avança para o próximo conjunto de resultados
			$this->db->conn_id->store_result();    // Armazena o resultado
		}
		$query = $this->db->get('ogco_UPC_UndidadeContrato');
		return $query->result_array();
	}

	public function getColaboradores($pCBRCodigo = null, $pMostraTudo = 0) {
		$query = $this->db->query("CALL ogrh_CBR_Lista01(?, ?)", array($pCBRCodigo, $pMostraTudo));
		if ($query->num_rows() > 0) {
			$result = $query->result_array(); // Obtém os resultados como array
		} else {
			$result = []; // Retorna array vazio se não houver resultados
		}
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();  // Avança para o próximo conjunto de resultados
		}
		$query->free_result(); // Libera o resultado da memória
		return $result; // Retorna o array com os resultados
	}

	public function getClientes() {
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();     // Avança para o próximo conjunto de resultados
			$this->db->conn_id->store_result();    // Armazena o resultado
		}
        $query = $this->db->query("CALL ogco_CLI_Selecao04_Todos()");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return []; // Retorna array vazio se não houver resultados
        }
        $query->next_result(); 
        $query->free_result();
    }

	public function getPessoasDoCliente($clienteCodigo = null) {
		$sql = "CALL ogco_CLP_Selecao02_DoCliente(?)";
		$query = $this->db->query($sql, array($clienteCodigo));
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = []; // Retorna array vazio se não houver resultados
		}
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();
		}
		$query->free_result(); // Libera o conjunto de resultados
		return $result; // Retorna o array de resultados
	}

	public function getParcelasDoContratoMaster($ctmCodigo) {
		$sql = "CALL ogco_CTP_ListaParcelas(?)";
		$query = $this->db->query($sql, array($ctmCodigo));
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = [];
		}
		if ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();
		}
		$query->free_result();
		return $result;
	}

    public function UpdateContratosMaster($dadosContrato) {
        $this->db->where('CTM_Codigo', $dadosContrato['CTM_Codigo']);
        $this->db->update('ogco_CTM_ContratoMaster', $dadosContrato);
    }

    public function InsertCtm($data) {
        return $this->db->insert('ogco_CTM_ContratoMaster', $data);           
    }

	public function inserirParcela($CTM_Codigo, $parcela) {
		$data = [
			'CTP_Codigo' => $CTP_Codigo,
			'CTP_CTMCodigo' => $parcela['CTP_CTMCodigo'],
			'CTP_Descricao' => $parcela['CTP_Descricao'],
			'CTP_DtaVencimento' => $parcela['CTP_DtaVencimento'],
			'CTP_Valor' => $parcela['CTP_Valor']
		];
		$this->db->insert('ogco_CTP_CttMasterParcela', $data);
	}

	public function atualizarParcela($parcela) {
		$data = [
			'CTP_Descricao' => $parcela['CTP_Descricao'],
			'CTP_DtaVencimento' => $parcela['CTP_DtaVencimento'],
			'CTP_Valor' => $parcela['CTP_Valor']
		];
		$this->db->where('CTP_Codigo', $parcela['CTP_Codigo']);
		$this->db->update('ogco_CTP_CttMasterParcela', $data);
	}

	public function excluirParcela($CTP_Codigo) {
		$this->db->where('CTP_Codigo', $CTP_Codigo);
		$this->db->delete('ogco_CTP_CttMasterParcela');
	}

}
