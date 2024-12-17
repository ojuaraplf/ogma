<?php

class FtaLista_model extends CI_Model {

    public function fetchFta($pNEACodigo = NULL, $pFTACodigo = NULL) {
		$query = $this->db->query("CALL ogco_FTA_ListaFerramentas_01(?, ?)", array($pNEACodigo, $pFTACodigo));
		return $query->num_rows() > 0 ? $query->result_array() : [];
	}

    public function fetchEditaFta($id) {
        $query = $this->db->get_where('ogco_FTA_Ferramenta', ['FTA_Codigo' => $id]);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function updateFta($id, $data) {
        return $this->db->update('ogco_FTA_Ferramenta', $data, ['FTA_Codigo' => $id]);
    }

    public function InsertFta($data) {
        return $this->db->insert('ogco_FTA_Ferramenta', $data);           
    }

	 public function fetchAreaNegocios() {
        $query = $this->db->get('ogco_NEA_AreaNegocio');
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

}


