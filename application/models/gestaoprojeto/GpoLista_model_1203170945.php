<?php

class GpoLista_model extends CI_Model
{
    public function ogsv_GPO_RelStEco( $pGPO, $pPJT, $pCLI, $pData2, $pPJTFecha, $pGPOFecha ) {
        
        $pGPO = $pGPO == "0" ? NULL : $pGPO;
        $pPJT = $pPJT == "0" ? NULL : $pPJT;
        $pCLI = $pCLI == "0" ? NULL : $pCLI;
        $pData2 = $pData2 == NULL ? date("Y-m-d") : $pData2;
        $pPJTFecha = $pPJTFecha == NULL ? "0" : $pPJTFecha ;
        $pGPOFecha = $pGPOFecha == NULL ? "0" : $pGPOFecha ;

        $query = $this->db->query("CALL ogsv_ATG_RelStEco01(?, ?, ?, ?, ?, ?)", array( $pGPO, $pPJT, $pCLI, $pData2, $pPJTFecha, $pGPOFecha ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ogsv_CHD_ExtrPeriodoChamado( $pData1, $pData2, $selCLI ) {
        
        $pData1 = $pData1 == NULL ? date("Y-m-d") : $pData1;
        $pData2 = $pData2 == NULL ? date("Y-m-d") : $pData2;
        $selCLI = $selCLI == 0 ? NULL : $selCLI;

        
        $query = $this->db->query("CALL ogsv_CHD_ExtrPeriodoChamado(?, ?, ?)", array( $pData1, $pData2, $selCLI ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ogsv_PJT_ExtrPeriodoProjeto( $pData1, $pData2, $selCLI ) {
        
        $pData1 = $pData1 == NULL ? date("Y-m-d") : $pData1;
        $pData2 = $pData2 == NULL ? date("Y-m-d") : $pData2;
        $selCLI = $selCLI == 0 ? NULL : $selCLI;

        
        $query = $this->db->query("CALL ogsv_PJT_ExtrPeriodoProjeto(?, ?, ?)", array( $pData1, $pData2, $selCLI ));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ogsv_GPO_RelStAva( $pGPO, $pPJT, $pData2, $pPJTFecha, $pGPOFecha ) {
        
        $pGPO = $pGPO == "0" ? NULL : $pGPO;
        $pPJT = $pPJT == "0" ? NULL : $pPJT;
        $pData2 = $pData2 == NULL ? date("Y-m-d") : $pData2;
        $pPJTFecha = $pPJTFecha == NULL ? "0" : $pPJTFecha ;
        $pGPOFecha = $pGPOFecha == NULL ? "0" : $pGPOFecha ;

        $query = $this->db->query("CALL ogsv_ATG_RelStAva01(?, ?, ?, ?, ?)", array( $pGPO, $pPJT, $pData2, $pPJTFecha, $pGPOFecha ));
        
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

    public function fetchselectedPjt( $pGPO )
    {
        $query = $this->db->query("CALL ogsv_PJT_Selecao06Gestor(?)", array( $pGPO == "0" ? NULL : $pGPO));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function fetchselectedPjtCliente( $pCLI )
    {
        $query = $this->db->query("CALL ogsv_PJT_Selecao06Cliente(?)", array( $pCLI == "0" ? NULL : $pCLI));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchselectedPjf( $aCLICodigo, $aPJTCodigo, $aMostraTudo )
    {

        $pCLICodigo = $aCLICodigo == "0" ? null : $aCLICodigo;
        $pPJTCodigo = $aPJTCodigo == "0" ? null : $aPJTCodigo;        
        $pMostraTudo = $aMostraTudo;

        $query = $this->db->query("CALL ogsv_PJF_Lista06(?, ?, ?)", array( $pCLICodigo, $pPJTCodigo, $pMostraTudo ));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fecthCliPjtPjfCbr( $aCLICodigo, $aPJTCodigo, $aPJFCodigo, $aCBRCodigo, $aAgrupaCLI, $aAgrupaPJT, $aAgrupaPJF, $aAgrupaCBR, $aMostraTudo )
    {        
        $pCLICodigo = $aCLICodigo == 0 ? NULL : $aCLICodigo;
        $pPJTCodigo = $aPJTCodigo == 0 ? NULL : $aPJTCodigo;
        $pPJFCodigo = $aPJFCodigo == 0 ? NULL : $aPJFCodigo;
        $pCBRCodigo = $aCBRCodigo == 0 ? NULL : $aCBRCodigo;
        $pAgrupaCLI = $aAgrupaCLI == 0 ? NULL : $aAgrupaCLI;
        $pAgrupaPJT = $aAgrupaPJT == 0 ? NULL : $aAgrupaPJT;
        $pAgrupaPJF = $aAgrupaPJF == 0 ? NULL : $aAgrupaPJF;
        $pAgrupaCBR = $aAgrupaCBR == 0 ? NULL : $aAgrupaCBR;
        $pMostraTudo = $aMostraTudo;

        $query = $this->db->query("CALL ogsv_CBR_Lista06(?, ?, ?, ?, ?, ?, ?, ?, ?)", array( $pCLICodigo, $pPJTCodigo, $pPJFCodigo, $pCBRCodigo, $pAgrupaCLI, $pAgrupaPJT, $pAgrupaPJF, $pAgrupaCBR, $pMostraTudo ));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchGpoOquefaz( $pData, $pPJTFecha )
    {
        $query = $this->db->query("CALL ogsv_PJT_OqueFazNaSemana(?, ?)", array( $pData == NULL ? date('Y-m-d') : $pData, $pPJTFecha));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function FetchLctRelApp($pCLICodigo, $pPJTCodigo, $pPJFCodigo, $pCBRCodigo, $pPeriodoIni, $pPeriodoFim)
    {
        $pCLICodigo = $pCLICodigo == 0 ? NULL : $pCLICodigo;
        $pPJTCodigo = $pPJTCodigo == 0 ? NULL : $pPJTCodigo;
        $pPJFCodigo = $pPJFCodigo == 0 ? NULL : $pPJFCodigo;
        $pCBRCodigo = $pCBRCodigo == 0 ? NULL : $pCBRCodigo;        
        
        $query = $this->db->query("CALL ogfn_LCT_RelApp(?, ?, ?, ?, ?, ?)", array($pCLICodigo, $pPJTCodigo, $pPJFCodigo, $pCBRCodigo, $pPeriodoIni, $pPeriodoFim));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ogsv_ATG_Cronograma( $pPJF, $pOptionTipoAtf) {
        $pPJF = $pPJF == "0" ? NULL : $pPJF;
        $query = $this->db->query("CALL ogsv_ATG_Cronograma01(?, ?)", array( $pPJF, $pOptionTipoAtf));
        
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function updateATGCronograma($data) {
        foreach ($data as $value) {
            $this->db->where('ATG_CODIGO', $value["ATG_CODIGO"]);
            $this->db->update("ogm_projetoatividadesfase", $value);
        }
    }
}
