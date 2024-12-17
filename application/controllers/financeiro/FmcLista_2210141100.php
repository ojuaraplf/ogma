<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FmcLista extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("financeiro/FmcLista_model", 'plm'); 
    }

    public function FmcPrePagar()
    {        
        $this->load->view('financeiro/FmcPrePagar');
    }

    
    public function FmcFolha()
    {        
        $this->load->view('financeiro/FmcFolha');
    }
    
    public function FmcFechar()
    {        
        $this->load->view('financeiro/FmcFechar');
    }    
    
    public function fetchFmcPrePagar()
    {        
        $pCBRCodigo = $this->input->post("vCBRid");
        $pCLICodigo = $this->input->post("vCLIid");
        $pPJTCodigo = $this->input->post("vPJTid");
        $pATGCodigo = $this->input->post("vATGid");
        $pAgrupaCBR = $this->input->post("vAgrupaCBR");
        $pAgrupaCLI = $this->input->post("vAgrupaCLI");
        $pAgrupaPJT = $this->input->post("vAgrupaPJT");
        $pAgrupaATG = $this->input->post("vAgrupaATG");
        $pAgrupaLCT = $this->input->post("vAgrupaLCT");
        $pDataDe = $this->input->post("vData1");
        $pDataAte = $this->input->post("vData2");
                
        $data = $this->plm->fetchFmcPrePagar($pCBRCodigo, $pCLICodigo, $pPJTCodigo, $pATGCodigo, $pAgrupaCBR, $pAgrupaCLI, $pAgrupaPJT, $pAgrupaATG, $pAgrupaLCT, $pDataDe, $pDataAte );
        echo json_encode($data);
    }
    
    public function fetchAptmtosDaAtg()
    {        
        $pATGCodigo = $this->input->post("vATGCodigo");
        $pLCTCodigo = $this->input->post("vLCTCodigo");
                        
        $data = $this->plm->fetchAptmtosDaAtg($pATGCodigo, $pLCTCodigo);
        echo json_encode($data);
    }

    
    public function fetchFmcFechar()
    {        
        $pData1 = $this->input->post("aData1");
        $pData2 = $this->input->post("aData2");
                        
        $data = $this->plm->fetchFmcFechar($pData1, $pData2);
        echo json_encode($data);
    }

    
    public function fetchFmcFolha()
    {        
        $pMes = $this->input->post("aMes");

        $data = $this->plm->fetchFmcFolha($pMes);
        echo json_encode($data);
    }    

    public function fetchGlosasColaboradorMes()
    {                
        $aCBRCodigo = $this->input->post("pCBRCodigo");
        $aMes = $this->input->post("pMes");
                        
        $data = $this->plm->fetchGlosasColaboradorMes($aCBRCodigo, $aMes);
        echo json_encode($data);
    }    
    
    public function FmcCriar()
    {
        $data['pIdCBR'] = $this->input->get("aIdCBR");
        $data['pIdCLI'] = $this->input->get("aIdCLI");
        $data['pIdPJT'] = $this->input->get("aIdPJT");
        $data['pIdATG'] = $this->input->get("aIdATG");
        $data['pAgCBR'] = $this->input->get("aAgCBR");
        $data['pAgCLI'] = $this->input->get("aAgCLI");
        $data['pAgPJT'] = $this->input->get("aAgPJT");
        $data['pAgATG'] = $this->input->get("aAgATG");
        $data['pAgLCT'] = $this->input->get("aAgLCT");
        $data['pData1'] = $this->input->get("aData1");
        $data['pData2'] = $this->input->get("aData2");                
       
        $data['cabecaPjt'] = (object)$this->plm->fetchFmcPrePagar( 
            $data['pIdCBR'],
            $data['pIdCLI'],
            $data['pIdPJT'],
            $data['pIdATG'],
            $data['pAgCBR'],
            $data['pAgCLI'],
            $data['pAgPJT'],
            $data['pAgATG'],
            $data['pAgLCT'],
            $data['pData1'],
            $data['pData2'])[0];        
        
        $this->load->view('financeiro/FmcCriar', $data);
    }

    public function NewFMC()
	{        
		$LinhaSalva = $this->input->post("ArrayLinhaTabFmcVisual");                
		print_r( $this->plm->NewFMC($LinhaSalva));
	}

    public function NewFMCiRow()
	{
		$arrayFMCItens = $this->input->post("arrayFmcItens");
        // print_r($arrayFMCItens[0]);
		print_r( $this->plm->NewFMCiRow($arrayFMCItens));
	}

    public function NewFMGRow()
	{
		$arrayFmcGlosa = $this->input->post("arrayFmcGlosa");
        // print_r($arrayFMCItens[0]);
		print_r( $this->plm->NewFMGRow($arrayFmcGlosa));
	}
    
}