<?php

class CgoLista_model extends CI_Model
{

    public function fetchCgo($pCGOCodigo, $pMostraTudo)
    {
        $vCGOCodigo = $pCGOCodigo == 0 ? NULL : $pCGOCodigo;
        $vMostraTudo = $pMostraTudo == null ? 1 : $pMostraTudo;
        
        $query = $this->db->query("CALL ogrh_CGO_Lista01(?, ?)", array($vCGOCodigo, $vMostraTudo));        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    

    public function fetchCbu()
    {
        $query = $this->db->query("CALL ogrh_CBU_Selecao()");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchSet()
    {
        $query = $this->db->query("CALL ogrh_SET_Lista01()");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function UpdateCargo($pCGO_Codigo, $data)
    {        
            $this->db->where('CGO_Codigo', $pCGO_Codigo);
            $this->db->update("ogrh_CGO_DescricaoCargo", $data);
            return true;
    }

    function InsertCargo($data)
    {        
            $this->db->insert("ogrh_CGO_DescricaoCargo", $data);            
            return true;
    }
    
}