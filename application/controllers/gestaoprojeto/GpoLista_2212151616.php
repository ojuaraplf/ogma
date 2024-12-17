<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GpoLista extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("gestaoprojeto/GpoLista_model", 'gpom');
    }

    public function GpoRelStEco()
    {
        $UsuLogado = $this->session->userdata("userCodigo");
        $data['listaPjt'] = $this->gpom->fetchselectedPjt(intval($UsuLogado));
        $data['listaGco'] = $this->gpom->fetchselectedGco();
        $data['listaCli'] = $this->gpom->fetchselectedCli();
        $this->load->view('gestaoprojeto/GpoRelStEco', $data);
    }

    public function GpoRelStAva()
    {
        $UsuLogado = $this->session->userdata("userCodigo");
        $data['listaPjt'] = $this->gpom->fetchselectedPjt(intval($UsuLogado));
        $data['listaGco'] = $this->gpom->fetchselectedGco();
        $this->load->view('gestaoprojeto/GpoRelStAva', $data);
    }

    public function RelApp()
    {
        $data['listaPjt'] = $this->gpom->fetchselectedPjt(NULL);
        $data['listaPjf'] = $this->gpom->fetchselectedPJF(NULL);
        $this->load->view('gestaoprojeto/GpoRelApp', $data);
    }
    
    public function FetchLctRelApp() {               

        $pCLICodigo = $this->input->post("aCLICodigo");
        $pPJTCodigo = $this->input->post("aPJTCodigo");
        $pPJFCodigo = $this->input->post("aPJFCodigo");
        $pPeriodoIni = $this->input->post("aPeriodoIni");
        $pPeriodoFim = $this->input->post("aPeriodoFim");
		$data = $this->gpom->FetchLctRelApp($pCLICodigo, $pPJTCodigo, $pPJFCodigo, $pPeriodoIni, $pPeriodoFim);
		echo json_encode($data);		
	}  

    public function fecthPjt($pGPO)
    {
        $data['listaPjt'] = $this->gpom->fetchselectedPjt($pGPO);
        echo json_encode($data);
    }

    public function fecthPJF($pPJT)
    {
        $data['listaPjf'] = $this->gpom->fetchselectedPJF($pPJT);
        echo json_encode($data);
    }

    public function fetchGpoRelStEco()
    {

        $pGPO = $this->input->post("selectedGpo");
        $pPJT = $this->input->post("selectedPjt");
        $pCLI = $this->input->post("selectedCli");
        $pData2 = $this->input->post("textDataFim");
        $pPJTFecha = $this->input->post("checkFchPla");
        $pGPOFecha = $this->input->post("checkFchGpo");

        $data = $this->gpom->ogsv_GPO_RelStEco($pGPO, $pPJT, $pCLI, $pData2, $pPJTFecha, $pGPOFecha );
        echo json_encode($data);
    }

    public function FetchExtrPeriodoChamado()
    {

        $pData1 = $this->input->post("dataDataIni");
        $pData2 = $this->input->post("dataDataFim");
        $selCLI = $this->input->post("selectedCli");

        $data = $this->gpom->ogsv_CHD_ExtrPeriodoChamado( $pData1, $pData2, $selCLI );
        echo json_encode($data);
    }

    public function FetchExtPeProj()
    {

        $pData1 = $this->input->post("dataDataIni");
        $pData2 = $this->input->post("dataDataFim");
        $selCLI = $this->input->post("selectedCli");

        $data = $this->gpom->ogsv_PJT_ExtrPeriodoProjeto( $pData1, $pData2, $selCLI );
        echo json_encode($data);
    }
    
    public function fetchGpoRelStAva()
    {
        $pGPO = $this->input->post("selectedGpo");
        $pPJT = $this->input->post("selectedPjt");
        $pData2 = $this->input->post("textDataFim");
        $pPJTFecha = $this->input->post("checkFchPla");
        $pGPOFecha = $this->input->post("checkFchGpo");

        $data = $this->gpom->ogsv_GPO_RelStAva($pGPO, $pPJT, $pData2, $pPJTFecha, $pGPOFecha );
        echo json_encode($data);
    }

    public function GpoOquefaz()
    {
        // $UsuLogado = $this->session->userdata("userCodigo");
        $this->load->view('gestaoprojeto/GpoOquefaz');
    }

    public function fetchGpoOquefaz()
    {
        $pData = $this->input->post("DataRef");
        $pPJTFecha = $this->input->post("PJTFecha");

        $data = $this->gpom->fetchGpoOquefaz($pData, $pPJTFecha );
        echo json_encode($data);
    }

    public function Expercha()
    {
        $data['listaCli'] = $this->gpom->fetchselectedCli();
        $this->load->view('gestaoprojeto/GpoRelExpercha', $data);
    }

    public function Expeproj()
    {
        $data['listaCli'] = $this->gpom->fetchselectedCli();
        $this->load->view('gestaoprojeto/GpoRelExpeproj', $data);
    }

    public function AtgCroEdita()
    {
        $data['listaPjt'] = $this->gpom->fetchselectedPjt(NULL);
        $data['listaPjf'] = $this->gpom->fetchselectedPJF(NULL);
        $this->load->view('gestaoprojeto/AtgCroEdita', $data);
    }
    
    public function fetchAtgCroEdita()
    {
        $pOptionTipoAtf = $this->input->post("selectedAtf");
        $pPJF = $this->input->post("selectedPjf");
        $data = $this->gpom->ogsv_ATG_Cronograma( $pPJF, $pOptionTipoAtf );
        echo json_encode($data);
    }

    function updateATGCronograma()
	{
		$arrayTableATG = $this->input->post("arrayTableATG");
		$this->gpom->updateATGCronograma($arrayTableATG);
	}
}
