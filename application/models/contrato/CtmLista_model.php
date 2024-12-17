<?php

class CtmLista_model extends CI_Model {

    public function GetContratosMaster($pCTM_Codigo) {
        try {
            // Executa o procedimento armazenado
            $query = $this->db->query("CALL ogco_CTM_ListaContratoMaster(?)", array($pCTM_Codigo));
            
            // Recupera o resultado
            $result = $query->result_array();
            $query->free_result(); // Libera o resultado
            
            // Consome quaisquer resultados adicionais
            while ($this->db->conn_id->more_results()) {
                $this->db->conn_id->next_result(); 
            }
            
            return !empty($result) ? $result : [];
            
        } catch (Exception $e) {
            // Em caso de erro, loga a mensagem de erro e retorna um array vazio
            log_message('error', 'Erro ao executar o procedimento armazenado: ' . $e->getMessage());
            return [];
        }
    }

    public function getStatusContratos() {
        // Consulta a tabela e consome resultados anteriores
        $this->db->conn_id->next_result(); 
        $query = $this->db->get('ogco_STT_StatusContrato');
        return $query->result_array();
    }

    public function getTiposContratos() {
        $this->db->conn_id->next_result(); 
        $query = $this->db->get('ogco_TCT_TipoContrato');
        return $query->result_array();
    }

    public function getCondicaoFaturamento() {
        $this->db->conn_id->next_result(); 
        $query = $this->db->get('ogfn_CFC_CondicaoFaturamento');
        return $query->result_array();
    }

    public function getCondicaoPagamento() {
        $this->db->conn_id->next_result(); 
        $query = $this->db->get('ogfn_CPG_CondicaoPagamento');
        return $query->result_array();
    }

    public function getUnidadesContrato() {
        $this->db->conn_id->next_result(); 
        $query = $this->db->get('ogco_UPC_UndidadeContrato');
        return $query->result_array();
    }

    public function getColaboradores($pCBRCodigo = null, $pMostraTudo = 0) {
        $query = $this->db->query("CALL ogrh_CBR_Lista01(?, ?)", array($pCBRCodigo, $pMostraTudo));
        $result = ($query->num_rows() > 0) ? $query->result_array() : [];
        
        // Liberando resultados e consumindo adicionais
        $query->free_result(); 
        while ($this->db->conn_id->more_results()) {
            $this->db->conn_id->next_result(); 
        }
        
        return $result;
    }

    public function getClientes() {
        $query = $this->db->query("CALL ogco_CLI_Selecao04_Todos()");
        $result = ($query->num_rows() > 0) ? $query->result_array() : [];
        
        // Liberando resultados e consumindo adicionais
        $query->free_result(); 
        while ($this->db->conn_id->more_results()) {
            $this->db->conn_id->next_result(); 
        }
        
        return $result;
    }

    public function getPessoasDoCliente($clienteCodigo = null) {
        $sql = "CALL ogco_CLP_Selecao02_DoCliente(?)";
        $query = $this->db->query($sql, array($clienteCodigo));
        $result = ($query->num_rows() > 0) ? $query->result_array() : [];
        
        // Liberando resultados e consumindo adicionais
        $query->free_result(); 
        while ($this->db->conn_id->more_results()) {
            $this->db->conn_id->next_result(); 
        }
        
        return $result;
    }

    // TABELA DE PARCELAS
    public function getParcelasDoContratoMaster($ctmCodigo) {
        $sql = "CALL ogco_CTP_ListaParcelas(?)";
        $query = $this->db->query($sql, array($ctmCodigo));
        $result = ($query->num_rows() > 0) ? $query->result_array() : [];
        
        // Liberando resultados e consumindo adicionais
        $query->free_result(); 
        while ($this->db->conn_id->more_results()) {
            $this->db->conn_id->next_result(); 
        }
        
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

    // TABELA DE RECURSOS CONTRATADOS
    public function getRecursosDoContratoMaster($ctmCodigo, $ctrCodigo = null) {
        $sql = "CALL ogco_CTR_Selecao01_Todos(?, ?)";
        $query = $this->db->query($sql, array($ctmCodigo, $ctrCodigo)); // Passando ambos os parâmetros

        $result = ($query->num_rows() > 0) ? $query->result_array() : [];
        
        // Liberando resultados da consulta
        $query->free_result();

        // Consumindo quaisquer resultados adicionais
        while ($this->db->conn_id->more_results()) {
            $this->db->conn_id->next_result();
        }

        return $result;
    }

    public function getRecursosGeral() {
		$query = $this->db->query("CALL ogco_REP_Selecao01_Todos()");
		$result = ($query->num_rows() > 0) ? $query->result_array() : [];
		$query->free_result();
		while ($this->db->conn_id->more_results()) {
			$this->db->conn_id->next_result();
		}
		return $result;
	}


	public function inserirRecurso($CTR_Codigo, $recurso) {
        $data = [
            'CTR_Codigo' => $CTR_Codigo,
            'CTR_CTMCodigo' => $recurso['CTR_CTMCodigo'],
            'CTR_REPCodigo' => $recurso['CTR_REPCodigo'],
            'CTR_Quantidade' => $recurso['CTR_Quantidade'],
            'CTR_VendaPreco' => $recurso['CTR_VendaPreco']
        ];
        $this->db->insert('ogco_CTR_CttMasterRecursos', $data);
    }

	public function atualizarRecurso($recurso) {
        $data = [
            'CTR_REPCodigo' => $recurso['CTR_REPCodigo'],
            'CTR_Quantidade' => $recurso['CTR_Quantidade'],
            'CTR_VendaPreco' => $recurso['CTR_VendaPreco']
        ];
        $this->db->where('CTR_Codigo', $recurso['CTR_Codigo']);
        $this->db->update('ogco_CTR_CttMasterRecursos', $data);
    }

	public function excluirRecurso($CTP_Codigo) {
        $this->db->where('CTR_Codigo', $CTP_Codigo);
        $this->db->delete('ogco_CTR_CttMasterRecursos');
    }
}
