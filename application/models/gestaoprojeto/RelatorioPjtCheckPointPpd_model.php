<?php

class RelatorioPjtCheckPointPpd_model extends CI_Model
{
    public function fetchRelatorioPjtCheckPointPpd($selectedPjt, $pAbreAtividade, $pNaoFaturavel, $pSoServico, $pPjtEmExecucao)
    {
        $query = $this->db->query("CALL ogsv_PJT_RelatorioCheckPointPpd(?, ?, ?, ?, ?)", array($selectedPjt == '' ? null : $selectedPjt, $pAbreAtividade, $pNaoFaturavel, $pSoServico, $pPjtEmExecucao));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchPJTSelecao()
    {
        $query = $this->db->query("CALL ogsv_PJT_Selecao01()");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}
