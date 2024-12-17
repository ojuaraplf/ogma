<?php

class CfcLista_model extends CI_Model {

    public function fetchCfc() {
        $query = $this->db->get('ogfn_CFC_CondicaoFaturamento');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    public function fetchEditaCfc($id) {
        $query = $this->db->get_where('ogfn_CFC_CondicaoFaturamento', ['CFC_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function updateCfc($id, $data) {
        return $this->db->update('ogfn_CFC_CondicaoFaturamento', $data, ['CFC_Codigo' => $id]);
    }

    public function InsertCfc($data) {
        return $this->db->insert('ogfn_CFC_CondicaoFaturamento', $data);      
    }
}


