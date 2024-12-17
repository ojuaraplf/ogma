<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FapLista extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("financeiro/FapLista_model", 'flm'); 
    }

    public function FapLista()
    {
        // $UsuLogado = $this->session->userdata("userCodigo");
        $data['listaCli'] = $this->flm->fetchselectedCli();
        $this->load->view('financeiro/FapLista', $data);
    }


    public function FapSemFatura()
    {
        // $UsuLogado = $this->session->userdata("userCodigo");
        $data['listaCli'] = $this->flm->fetchselectedCli();
        $this->load->view('financeiro/FapSemFatura', $data);
    }

    public function FapPreFaturar()
    {
        // $UsuLogado = $this->session->userdata("userCodigo");
        // $data['listaCli'] = $this->flm->fetchselectedCli();
        $this->load->view('financeiro/FapPreFaturar');
    }

    public function FapCriar()
    {
        $data['pIdCLI'] = $this->input->get("aIdCLI");
        $data['pIdPJT'] = $this->input->get("aIdPJT");
        $data['pIdATG'] = $this->input->get("aIdATG");
        $data['pAgCLI'] = $this->input->get("aAgCLI");
        $data['pAgPJT'] = $this->input->get("aAgPJT");
        $data['pAgATG'] = $this->input->get("aAgATG");
        $data['pAgLCT'] = $this->input->get("aAgLCT");
        $data['pData1'] = $this->input->get("aData1");
        $data['pData2'] = $this->input->get("aData2");
        $data['pSfPJT'] = $this->input->get("aSfPJT");
        $data['pSfATG'] = $this->input->get("aSfATG");
        $data['pSfLCT'] = $this->input->get("aSfLCT");

        $vpIdPJT = intval($data['pIdPJT']) ;
       
        $data['cabecaPjt'] = (object)$this->flm->ogfn_FAP_PreFaurar( $data['pIdCLI'], $data['pIdPJT'], $data['pIdATG'], $data['pAgCLI'], $data['pAgPJT'], $data['pAgATG'], $data['pAgLCT'], $data['pData1'], $data['pData2'], $data['pSfPJT'], $data['pSfATG'], $data['pSfLCT'] )[0];

        $data['ogma_PES_Selecao01'] = $this->flm->fetchogco_CLP_Selecao01_DoClienteDoPPx($vpIdPJT);
        
        $this->load->view('financeiro/FapCriar', $data);
    }

    public function FapVisual()
    {
        // $UsuLogado = $this->session->userdata("userCodigo");
        $this->load->view('financeiro/FapVisual');
    }

    public function fetchFapPjtLista()
    {
        $pPJT = $this->input->post("vInputPjt");
        $pData1 = $this->input->post("vData1");
        $pData2 = $this->input->post("vData2");
        $pAgruparPJT = $this->input->post("vAgruparPJT");
        $pSelectCLI = $this->input->post("vSelectedCli");
        $pSoFaturavelPjt = $this->input->post("vSoFaturavelPjt");
        $pSoFaturavelAtg = $this->input->post("vSoFaturavelAtg");
        $pSoFaturavelLct = $this->input->post("vSoFaturavelLct");

        $data = $this->flm->ogfn_FAP_ListaApontamento( $pPJT, $pSelectCLI, $pData1, $pData2, $pAgruparPJT, $pSoFaturavelPjt, $pSoFaturavelAtg, $pSoFaturavelLct );
        echo json_encode($data);
    }

    public function fetchFAPPreFaurar()
    {
        
        $aCLIid = $this->input->post("vCLIid");
        $aPJTid = $this->input->post("vPJTid");
        $aATGid = $this->input->post("vATGid");
        $aAgrupaCLI = $this->input->post("vAgrupaCLI");
        $aAgrupaPJT = $this->input->post("vAgrupaPJT");
        $aAgrupaATG = $this->input->post("vAgrupaATG");
        $aAgrupaLCT = $this->input->post("vAgrupaLCT");
        $aData1 = $this->input->post("vData1");
        $aData2 = $this->input->post("vData2");
        $aSoFaturavelPjt = $this->input->post("vSoFaturavelPjt");
        $aSoFaturavelAtg = $this->input->post("vSoFaturavelAtg");
        $aSoFaturavelLct = $this->input->post("vSoFaturavelLct");
        
        $data = $this->flm->ogfn_FAP_PreFaurar( $aCLIid, $aPJTid, $aATGid, $aAgrupaCLI, $aAgrupaPJT, $aAgrupaATG, $aAgrupaLCT, $aData1, $aData2, $aSoFaturavelPjt, $aSoFaturavelAtg, $aSoFaturavelLct );
        echo json_encode($data);
    }

    public function fetchFapVisual()
    {
        $aFAPStatus = $this->input->post("vFAPStatus");
        $aAbreAponta = $this->input->post("vAbreAponta");

        $data = $this->flm->ogfn_FAP_ListaFapVisual( $aFAPStatus, $aAbreAponta );
        echo json_encode($data);
    }
    
    public function FapRelExtrFatur()
    {
        // $UsuLogado = $this->session->userdata("userCodigo");
        $pPpxAtivo = null;
        $data['listaPjx'] = $this->flm->fetchselectedPPx($pPpxAtivo);
        $this->load->view('financeiro/FapRelExtrFatur', $data);
    }

    public function fecthPjt($vGPO)
    {
        $data['listaPjt'] = $this->flm->fetchselectedPjt($vGPO);
        echo json_encode($data);
    }

    public function fetchExtratoFaturamento()
    {                
        $aPJTCodigo = $this->input->post("pPJTCodigo");
        $aMesMenor = $this->input->post("pMesMenor");
        $aMesMaior = $this->input->post("pMesMaior");
        
        $data = $this->flm->fetchExtratoFaturamento( $aPJTCodigo, $aMesMenor, $aMesMaior);
        echo json_encode($data);
    }

    public function fetchselectedPPx($pPpxAtivo)
    {
        $data['listaPpx'] = $this->flm->fetchselectedPPx($pPpxAtivo);
        echo json_encode($data);
    }

    public function UpdateFapRow()
    {
        $FAP_Codigo = $this->input->post("pFAP_ID");
        $FAP_NfNumero = $this->input->post("pFAP_NF");
        $FAP_ParcelaOrdem = $this->input->post("pPARC_ORDEM");
        $FAP_ParcelaTotal = $this->input->post("pPARC_TOTAL");
        $FAP_STATUS = $this->input->post("pFAP_STATUS");

         $data = array(
            "FAP_NfNumero" => $FAP_NfNumero,
            "FAP_ParcelaOrdem" => $FAP_ParcelaOrdem,
            "FAP_ParcelaTotal" => $FAP_ParcelaTotal,
            "FAP_Status" => $FAP_STATUS
        );
        echo $this->flm->UpdateFapRow($FAP_Codigo, $data);
    }

    public function NewFAP()
    {

        $vFAP_PESrescliCodigo = $this->input->post("pFAP_PESrescliCodigo");

        $data = array(
            "FAP_Codigo" => null,
            "FAP_Descricao" => $this->input->post("pFAP_Descricao"),
            "FAP_NroHoras" => $this->input->post("pFAP_NroHoras"),
            "FAP_PJTCodigo" => $this->input->post("pFAP_PJTCodigo"),
            "FAP_PJTVrHora" => $this->input->post("pFAP_PJTVrHora"),
            "FAP_TORCodigo" => $this->input->post("pFAP_TORCodigo"),
            "FAP_PESrescliCodigo" => $vFAP_PESrescliCodigo == "" ? NULL : $vFAP_PESrescliCodigo,
            "FAP_Valor" => $this->input->post("pFAP_Valor"),
            "FAP_NfNumero" => $this->input->post("pFAP_NfNumero"),
            "FAP_MomEmissao" => $this->input->post("pFAP_MomEmissao"),
            "FAP_MomEmigracao" => $this->input->post("pFAP_MomEmigracao"),
            "FAP_PeriodoInicio" => $this->input->post("pFAP_PeriodoInicio"),
            "FAP_PeriodoTermino" => $this->input->post("pFAP_PeriodoTermino"),
            "FAP_ParcelaOrdem" => $this->input->post("pFAP_ParcelaOrdem"),
            "FAP_ParcelaTotal" => $this->input->post("pFAP_ParcelaTotal"),
            "FAP_Observacao" => $this->input->post("pFAP_Observacao"),
            "FAP_ATGCodigo" => $this->input->post("pFAP_ATGCodigo"),
            "FAP_Status" => $this->input->post("pFAP_Status"),
            "FAP_USUCodigo" => $this->input->post("pFAP_USUCodigo")
        );

        echo $this->flm->NewFAP($data);
    }

    public function fetchNewFAP_controllers() {
        $array = $this->flm->fetchNewFAP_model();
        echo $array;
    }

    public function UpdateFAPiRow()
	{
		$arrayFapItens = $this->input->post("arrayFapItens");
        // print_r($arrayFapItens);
		print_r( $this->flm->NewFAPiRow($arrayFapItens));
	}

    public function FAPApagaItem() {

        $pFAP_ID = $this->input->post("pFAP_ID");
        $this->flm->FAPApagaItem($pFAP_ID);
    }


}