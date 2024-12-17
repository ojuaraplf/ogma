<?php

class DicLista_model extends CI_Model
{
    public function fetchDicLista($pMES, $pANO, $pCBR, $pGCO, $pPJT )

    {
        $query = $this->db->query("CALL ogsv_DIC_EsfoTrabSem(?, ?, ?, ?, ?, NULL)", array( $pMES, $pANO, $pCBR == "0" ? NULL : $pCBR, $pGCO == "0" ? NULL : $pGCO, $pPJT == "0" ? NULL : $pPJT ));
        
        //$query = $this->db->query("CALL ogsv_DIC_EsfoTrabSem(?, ?, NULL, NULL, NULL, NULL)", array( $pMES, $pANO ));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchselectedMes()
    {
        $query = $this->db->query("CALL ogsv_DIC_SelecaoMeses()");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchselectedCbr()
    {
        $query = $this->db->query("CALL ogrh_CBR_Selecao01()");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchselectedGco()
    {
        $query = $this->db->query("CALL ogsv_GCO_Selecao01()");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchselectedPjt()
    {
        $query = $this->db->query("CALL ogsv_PPx_Selecao01('1')");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}
