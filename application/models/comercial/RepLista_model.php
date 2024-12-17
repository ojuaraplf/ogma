<?php

class RepLista_model extends CI_Model {

	public function fetchRep() {
		$query = $this->db->query("CALL ogco_REP_Selecao01_Todos()");
		return $query->num_rows() > 0 ? $query->result_array() : [];
	}

	public function fetchEditaRep($id) {
        $query = $this->db->get_where('ogco_REP_RecursoPreco', ['REP_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function updateRep($REP_Codigo, $data) {
        $this->db->where('REP_Codigo', $REP_Codigo);
        return $this->db->update('ogco_REP_RecursoPreco', $data);
    }

    public function insertRep($data) {
        return $this->db->insert('ogco_REP_RecursoPreco', $data);
    }

	public function getCargosDeExecucao() {
        $this->db->where('CGO_FlgExecutaSvco', 1);
        $query = $this->db->get('ogrh_CGO_DescricaoCargo');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    public function GetFerramentas() {
        $query = $this->db->get('ogco_FTA_Ferramenta');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

}
