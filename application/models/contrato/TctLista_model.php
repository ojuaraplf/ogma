<?php

class TctLista_model extends CI_Model {

    public function fetchTct() {
        $query = $this->db->get('ogco_TCT_TipoContrato');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    public function fetchEditaTct($id) {
        $query = $this->db->get_where('ogco_TCT_TipoContrato', ['TCT_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function updateTct($id, $data) {
        return $this->db->update('ogco_TCT_TipoContrato', $data, ['TCT_Codigo' => $id]);
    }

    public function InsertTct($data) {
        return $this->db->insert('ogco_TCT_TipoContrato', $data);      
    }
}


