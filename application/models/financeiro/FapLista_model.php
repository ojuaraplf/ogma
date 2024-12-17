<?php

class FapLista_model extends CI_Model
{

    public function ogfn_FAP_PreFaurar($pCLIid, $pPJTid, $pATGid, $pAgrupaCLI, $pAgrupaPJT, $pAgrupaATG, $pAgrupaLCT, $pData1, $pData2, $pSoFaturavelPjt, $pSoFaturavelAtg, $pSoFaturavelLct )
    {
        $aCLIid = $pCLIid == 0 ? NULL : $pCLIid;
        $aPJTid = $pPJTid == 0 ? NULL : $pPJTid;
        $aATGid = $pATGid == 0 ? NULL : $pATGid;
        $aAgrupaCLI = $pAgrupaCLI;
        $aAgrupaPJT = $pAgrupaPJT;
        $aAgrupaATG = $pAgrupaATG;
        $aAgrupaLCT = $pAgrupaLCT;
        $aData1 = $pData1 == "0" ? NULL : $pData1;
        $aData2 = $pData2 == "0" ? NULL : $pData2;
        $aSoFaturavelPjt = $pSoFaturavelPjt;
        $aSoFaturavelAtg = $pSoFaturavelAtg;
        $aSoFaturavelLct = $pSoFaturavelLct;

        $query = $this->db->query("CALL ogfn_FAP_PreFaurar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array( $aCLIid, $aPJTid, $aATGid, $aAgrupaCLI, $aAgrupaPJT, $aAgrupaATG, $aAgrupaLCT, $aData1, $aData2, $aSoFaturavelPjt, $aSoFaturavelAtg, $aSoFaturavelLct ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ogfn_FAP_ListaFapVisual( $pFAPStatus, $pAbreAponta )
    {
        $aFAPStatus = $pFAPStatus;
        $aAbreAponta = $pAbreAponta;

        $query = $this->db->query("CALL ogfn_FAP_ListaFapVisual(?, ?)", array( $aFAPStatus, $aAbreAponta ));
        
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

    public function fetchselectedPPx( $pPpxAtivo )
    {
        $query = $this->db->query("CALL ogsv_PPx_Selecao01(?)", array( $pPpxAtivo));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchExtratoFaturamento( $pPJTCodigo, $pMesMenor, $pMesMaior  )
    {
        $aPJTCodigo = $pPJTCodigo == 0 ? null : $pPJTCodigo;
        $aMesMenor = $pMesMenor == null ? '1990-01' : $pMesMenor;
        $aMesMaior = $pMesMaior == null ? '2025-12' : $pMesMaior;
        
        $query = $this->db->query("CALL ogfn_FAP_ExtratoFaturamento(?, ?, ?)", array( $aPJTCodigo, $aMesMenor, $aMesMaior));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchselectedCli()
    {
        $query = $this->db->query("CALL ogco_CLI_Selecao02()");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchogco_CLP_Selecao01_DoClienteDoPPx( $pPJT )
    {
        $query = $this->db->query("CALL ogco_CLP_Selecao01_DoClienteDoPPx(?)", array( $pPJT == "0" ? NULL : $pPJT));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function UpdateFapRow($id, $data)
    {
        $this->db->where('FAP_Codigo', $id);
        $this->db->update("ogfn_FAP_PreFatura", $data);
        return true;
    }
    
    public function NewFAP($data)
    {
        $this->db->insert("ogfn_FAP_PreFatura", $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function NewFAPiRow($data)
    {
        foreach ($data as $value){
            $this->db->insert("ogfn_FAPi_PreFaturaItem", $value);
        }
        $query = $this->db->query("SELECT FAPi_FAPCodigo FROM ogfn_FAPi_PreFaturaItem WHERE FAPi_FAPCodigo = ?", array($data[0]["FAPi_FAPCodigo"]));
        return $query->num_rows();
        //print_r($data[0]["FAPi_FAPCodigo"]);
    }

    public function FAPApagaItem($pFAP) {

        echo 'to no moddel';
        echo $pFAP;
        $this->db->where('FAP_Codigo', $pFAP);
        $this->db->delete('ogfn_FAP_PreFatura');
        return true;

    }


}
