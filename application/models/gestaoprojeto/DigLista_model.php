<?php

class DigLista_model extends CI_Model
{
    public function fetchDigLista($pMES, $pANO, $pCBR, $pGCO, $pPJT, $pPJTFecha )

    {
        $query = $this->db->query("CALL ogsv_DIC_EsfoTrabSem(?, ?, ?, ?, ?, ?)", array( $pMES, $pANO, $pCBR == "0" ? NULL : $pCBR, $pGCO == "0" ? NULL : $pGCO, $pPJT == "0" ? NULL : $pPJT, $pPJTFecha == "0" ? NULL : $pPJTFecha ));
        
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

    public function fetchselectedPjt( $pGCO )

    {
        $query = $this->db->query("CALL ogsv_PJT_Selecao05Gestor(?)", array( $pGCO == "0" ? NULL : $pGCO));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }


}
