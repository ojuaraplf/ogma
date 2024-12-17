<?php

class SttLista_model extends CI_Model {

    public function fetchStt() {
        $query = $this->db->get('ogco_STT_StatusContrato');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    public function fetchEditaStt($id) {
        $query = $this->db->get_where('ogco_STT_StatusContrato', ['STT_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function updateStt($id, $data) {
        return $this->db->update('ogco_STT_StatusContrato', $data, ['STT_Codigo' => $id]);
    }

    public function InsertStt($data) {
        return $this->db->insert('ogco_STT_StatusContrato', $data);           
    }

}


