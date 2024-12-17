<?php

class RelatoriopjtCheckChamados01_model extends CI_Model
{
    public function fetchRelatoriopjtCheckChamados01($selectedPjt, $pFechaEmPlano, $pIncluiChdInativo )
    {
        $query = $this->db->query("CALL ogsv_PJT_RelatorioCheckChamado01(?, ?, ?)", array($selectedPjt == '' ? null : $selectedPjt, $pFechaEmPlano, $pIncluiChdInativo ));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchPJTSelecao()
    {
        $query = $this->db->query("CALL ogsv_PJT_Selecao04()");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}
