<?php

class NeaLista_model extends CI_Model {

    public function fetchEditaNea($id) {
        $query = $this->db->get_where('ogco_NEA_AreaNegocio', ['NEA_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function fetchAreaNegocios() {
        $query = $this->db->get('ogco_NEA_AreaNegocio');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    public function updateAreaNegocios($NEA_Codigo, $data) {
        $this->db->where('NEA_Codigo', $NEA_Codigo);
        return $this->db->update('ogco_NEA_AreaNegocio', $data);
    }

    public function insertAreaNegocios($data) {
        return $this->db->insert('ogco_NEA_AreaNegocio', $data);
    }
}
