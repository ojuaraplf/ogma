<?php

class UpcLista_model extends CI_Model {

    public function fetchUpc() {
        $query = $this->db->get('ogco_UPC_UndidadeContrato');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    public function fetchEditaUpc($id) {
        $query = $this->db->get_where('ogco_UPC_UndidadeContrato', ['UPC_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function updateUpc($id, $data) {
        return $this->db->update('ogco_UPC_UndidadeContrato', $data, ['UPC_Codigo' => $id]);
    }

    public function InsertUpc($data) {
        return $this->db->insert('ogco_UPC_UndidadeContrato', $data);      
    }
}


