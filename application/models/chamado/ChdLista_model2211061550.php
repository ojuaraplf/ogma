<?php

class ChdLista_model extends CI_Model
{   
    public function fetchChdLista($pPJT, $pPJF, $pGEP, $pSOL, $pAtivo )
    {

        $pPJT = $pPJT == "0" ? NULL : $pPJT;
        $pPJF = $pPJF == "0" ? NULL : $pPJF;
        $pGEP = $pGEP == "0" ? NULL : $pGEP;
        $pSOL = $pSOL == "0" ? NULL : $pSOL;
        $pAtivo = $pAtivo == "2" ? "1" : ( $pAtivo == "1" ? "0" : NULL ) ;

        // echo $pPJT;
        // echo $pPJF;
        // echo $pGEP;
        // echo $pSOL;
        // echo $pAtivo;

        $query = $this->db->query("CALL ogsv_CHD_Lista01(?, ?, ?, ?, ?)", array( $pPJT, $pPJF, $pGEP, $pSOL, $pAtivo ));
        // $query = $this->db->query("CALL ogsv_CHD_Lista01(?, ?, ?, ?, ?)", array( $pPJT == "0" ? NULL : $pPJT, $pPJF == "0" ? NULL : $pPJF, $pGEP == "0" ? NULL : $pGEP, $pSOL == "0" ? NULL : $pSOL, $pAtivo == "2" ? "1" : ( $pAtivo == "1" ? "0" : NULL ) ));
        
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

    public function fetchselectedPjt( $pGEP )
    {
        $query = $this->db->query("CALL ogsv_PJT_Selecao05Gestor(?)", array( $pGEP == "0" ? NULL : $pGEP));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchselectedSol( $pPJT )
    {
        $query = $this->db->query("CALL ogsv_PFR_Selecao02_Projeto(?)", array( $pPJT == "0" ? NULL : $pPJT));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchChamados() {

        $query = $this->db->query("SELECT * FROM ogm_vw_chamadodetalhes;");
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}
