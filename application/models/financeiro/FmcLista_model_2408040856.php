<?php

class FmcLista_model extends CI_Model
{

    public function fetchFmcPrePagar($pGCOCodigo, $pCBRCodigo, $pCLICodigo, $pPJTCodigo, $pATGCodigo, $pAgrupaCBR, $pAgrupaCLI, $pAgrupaPJT, $pAgrupaATG, $pAgrupaLCT, $pDataDe, $pDataAte )
    {

        $aGCOCodigo = $pGCOCodigo == 0 ? NULL : $pGCOCodigo;
        $aCBRCodigo = $pCBRCodigo == 0 ? NULL : $pCBRCodigo;
        $aCLICodigo = $pCLICodigo == 0 ? NULL : $pCLICodigo;
        $aPJTCodigo = $pPJTCodigo == 0 ? NULL : $pPJTCodigo;
        $aATGCodigo = $pATGCodigo == 0 ? NULL : $pATGCodigo;
        $aAgrupaCBR = $pAgrupaCBR;
        $aAgrupaCLI = $pAgrupaCLI;
        $aAgrupaPJT = $pAgrupaPJT;
        $aAgrupaATG = $pAgrupaATG;
        $aAgrupaLCT = $pAgrupaLCT;
        $aDataDe = $pDataDe == "0" ? NULL : $pDataDe;
        $aDataAte = $pDataAte == "0" ? NULL : $pDataAte;

        $query = $this->db->query("CALL ogrh_FMC_PrePagar__(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array( $aGCOCodigo, $aCBRCodigo, $aCLICodigo, $aPJTCodigo, $aATGCodigo, $aAgrupaCBR, $aAgrupaCLI, $aAgrupaPJT, $aAgrupaATG, $aAgrupaLCT, $aDataDe, $aDataAte ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchAptmtosDaAtg($pATGCodigo, $pLCTCodigo )
    {        
        $query = $this->db->query("CALL ogfn_FMG_AptmtosDaAtg(?, ?)", array( $pATGCodigo, $pLCTCodigo ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    
    public function fetchFmcFechar($pData1, $pData2 )
    {        
        $query = $this->db->query("CALL ogrh_FMC_FechaPagamento(?, ?)", array( $pData1, $pData2 ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function fetchGlosasColaboradorMes($aCBRCodigo, $aMes)
    {        
        $query = $this->db->query("CALL ogrh_FMG_ListaGlosasColaboradorMes(?, ?)", array( $aCBRCodigo, $aMes ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchFmcFolha($aMes)
    {        
        $query = $this->db->query("CALL ogrh_FMC_FecharFolha(?)", array( $aMes ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function fetchselectedGco($pGpoMes)
    {
        $query = $this->db->query("CALL ogsv_GCO_GpPpxComTrabalho(?)", array($pGpoMes));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchInfoFaturamento($FMCi_LCTMes, $FMCi_CBRCodigo) {
        $query = $this->db->query("CALL ofrh_CBR_InfoFaturamentoMes(?, ?)", array($FMCi_LCTMes, $FMCi_CBRCodigo));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function NewFMC($data)
    {
        $this->db->initialize();
        $this->db->insert("ogfn_FMC_FechamentoMesConsultor", $data[0]);
        return true;
    }

    public function NewFMCiRow($data)
    {
        foreach ($data as $value){
            $this->db->insert("ogfn_FMCi_FechtoMesCbrItem", $value);
        }
        $query = $this->db->query("SELECT FMCi_FMCCodigo FROM ogfn_FMCi_FechtoMesCbrItem WHERE FMCi_FMCCodigo = ?", array($data[0]["FMCi_FMCCodigo"]));
        return $query->num_rows();
    }

    public function NewFMGRow($data)
    {
        foreach ($data as $value){
            $this->db->insert("ogfn_FMG_FechtoMesCbrGlosa", $value);
        }
        return true;
    }  
}