<?php

class CpgLista_model extends CI_Model {

    public function fetchCpg() {
        $query = $this->db->get('ogfn_CPG_CondicaoPagamento');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    public function fetchEditaCpg($id) {
        $query = $this->db->get_where('ogfn_CPG_CondicaoPagamento', ['CPG_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function updateCpg($id, $data) {
        return $this->db->update('ogfn_CPG_CondicaoPagamento', $data, ['CPG_Codigo' => $id]);
    }

    public function InsertCpg($data) {
        return $this->db->insert('ogfn_CPG_CondicaoPagamento', $data);      
    }
}


