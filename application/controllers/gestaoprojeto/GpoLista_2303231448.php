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

        $this->load->view('gestaoprojeto/GpoRelApp');
    }
    
    public function FetchLctRelApp() {               

        $pCLICodigo = $this->input->post("aCLICodigo");
        $pPJTCodigo = $this->input->post("aPJTCodigo");
        $pPJFCodigo = $this->input->post("aPJFCodigo");
        $pCBRCodigo = $this->input->post("aCBRCodigo");
        $pPeriodoIni = $this->input->post("aPeriodoIni");
        $pPeriodoFim = $this->input->post("aPeriodoFim");

		$data = $this->gpom->FetchLctRelApp($pCLICodigo, $pPJTCodigo, $pPJFCodigo, $pCBRCodigo, $pPeriodoIni, $pPeriodoFim);
		echo json_encode($data);		
	}  

    public function fecthProComboCliente()
    {
        $ppCLICodigo = $this->input->post("paCLICodigo");
        $ppPJTCodigo = $this->input->post("paPJTCodigo");
        $ppPJFCodigo = $this->input->post("paPJFCodigo");
        $ppCBRCodigo = $this->input->post("paCBRCodigo");
        $ppAgrupaCLI = $this->input->post("paAgrupaCLI");
        $ppAgrupaPJT = $this->input->post("paAgrupaPJT");
        $ppAgrupaPJF = $this->input->post("paAgrupaPJF");
        $ppAgrupaCBR = $this->input->post("paAgrupaCBR");
        $ppMostraTudo = $this->input->post("paMostraTudo");

        $data['listaCLI'] = $this->gpom->fecthCliPjtPjfCbr( $ppCLICodigo, $ppPJTCodigo, $ppPJFCodigo, $ppCBRCodigo, $ppAgrupaCLI, $ppAgrupaPJT, $ppAgrupaPJF, $ppAgrupaCBR, $ppMostraTudo );
        // $data['listaCLI'] = $this->gpom->fecthCliPjtPjfCbr(0,0,0,0,1,0,0,0,0);
        echo json_encode($data);
    }

    public function fecthProComboPlano()
    {
        $ppCLICodigo = $this->input->post("paCLICodigo");
        $ppPJTCodigo = $this->input->post("paPJTCodigo");
        $ppPJFCodigo = $this->input->post("paPJFCodigo");
        $ppCBRCodigo = $this->input->post("paCBRCodigo");
        $ppAgrupaCLI = $this->input->post("paAgrupaCLI");
        $ppAgrupaPJT = $this->input->post("paAgrupaPJT");
        $ppAgrupaPJF = $this->input->post("paAgrupaPJF");
        $ppAgrupaCBR = $this->input->post("paAgrupaCBR");
        $ppMostraTudo = $this->input->post("paMostraTudo");

        $data['listaPJT'] = $this->gpom->fecthCliPjtPjfCbr( $ppCLICodigo, $ppPJTCodigo, $ppPJFCodigo, $ppCBRCodigo, $ppAgrupaCLI, $ppAgrupaPJT, $ppAgrupaPJF, $ppAgrupaCBR, $ppMostraTudo );
        echo json_encode($data);
    }

    public function fecthProComboFase()
    {
        $ppCLICodigo = $this->input->post("paCLICodigo");
        $ppPJTCodigo = $this->input->post("paPJTCodigo");
        $ppPJFCodigo = $this->input->post("paPJFCodigo");
        $ppCBRCodigo = $this->input->post("paCBRCodigo");
        $ppAgrupaCLI = $this->input->post("paAgrupaCLI");
        $ppAgrupaPJT = $this->input->post("paAgrupaPJT");
        $ppAgrupaPJF = $this->input->post("paAgrupaPJF");
        $ppAgrupaCBR = $this->input->post("paAgrupaCBR");
        $ppMostraTudo = $this->input->post("paMostraTudo");

        $data['listaPJF'] = $this->gpom->fecthCliPjtPjfCbr( $ppCLICodigo, $ppPJTCodigo, $ppPJFCodigo, $ppCBRCodigo, $ppAgrupaCLI, $ppAgrupaPJT, $ppAgrupaPJF, $ppAgrupaCBR, $ppMostraTudo );
        echo json_encode($data);
    }

    public function fecthProComboColabrador()
    {
        $ppCLICodigo = $this->input->post("paCLICodigo");
        $ppPJTCodigo = $this->input->post("paPJTCodigo");
        $ppPJFCodigo = $this->input->post("paPJFCodigo");
        $ppCBRCodigo = $this->input->post("paCBRCodigo");
        $ppAgrupaCLI = $this->input->post("paAgrupaCLI");
        $ppAgrupaPJT = $this->input->post("paAgrupaPJT");
        $ppAgrupaPJF = $this->input->post("paAgrupaPJF");
        $ppAgrupaCBR = $this->input->post("paAgrupaCBR");
        $ppMostraTudo = $this->input->post("paMostraTudo");

        $data['listaCBR'] = $this->gpom->fecthCliPjtPjfCbr( $ppCLICodigo, $ppPJTCodigo, $ppPJFCodigo, $ppCBRCodigo, $ppAgrupaCLI, $ppAgrupaPJT, $ppAgrupaPJF, $ppAgrupaCBR, $ppMostraTudo );
        echo json_encode($data);
    }

    public function fecthPJFCliente($aCLICodigo)
    {
        $pCLICodigo = $aCLICodigo;
        $pPJTCodigo = 0;        
        $pMostraTudo = 0;

        $data['listaPjfCliente'] = $this->gpom->fetchselectedPjf($pCLICodigo, $pPJTCodigo, $pMostraTudo);
        echo json_encode($data);
    }

    public function fecthPJFPlano($aPJTCodigo)
    {
        $pCLICodigo = 0;
        $pPJTCodigo = $aPJTCodigo;        
        $pMostraTudo = 0;

        $data['listaPjfPlano'] = $this->gpom->fetchselectedPjf($pCLICodigo, $pPJTCodigo, $pMostraTudo);
        echo json_encode($data);
    }

    public function fecthCbrCliente($aCLICodigo)
    {        
        $pCLICodigo = $aCLICodigo;
        $pPJTCodigo = 0;
        $pPJFCodigo = 0;
        $pCBRCodigo = 0;
        $pAgrupaCLI = 0;
        $pAgrupaPJT = 0;
        $pAgrupaPJF = 0;
        $pAgrupaCBR = 0;
        $pMostraTudo = 0;
        
        $data['listaCbrCliente'] = $this->gpom->fetchselectedCbr($pCLICodigo, $pPJTCodigo, $pPJFCodigo, $pCBRCodigo, $pAgrupaCLI, $pAgrupaPJT, $pAgrupaPJF, $pAgrupaCBR, $pMostraTudo);
        echo json_encode($data);
    }

    public function fecthCbrPlano($aPJTCodigo)
    {        
        $pCLICodigo = 0;
        $pPJTCodigo = $aPJTCodigo;
        $pPJFCodigo = 0;
        $pCBRCodigo = 0;
        $pAgrupaCLI = 0;
        $pAgrupaPJT = 0;
        $pAgrupaPJF = 0;
        $pAgrupaCBR = 0;
        $pMostraTudo = 0;
        
        $data['listaCbrPlano'] = $this->gpom->fetchselectedCbr($pCLICodigo, $pPJTCodigo, $pPJFCodigo, $pCBRCodigo, $pAgrupaCLI, $pAgrupaPJT, $pAgrupaPJF, $pAgrupaCBR, $pMostraTudo);
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
        $data['listaPjf'] = $this->gpom->fetchselectedPjf(0, 0, 0);
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

    function FetchAtf()
	{
		$data = $this->gpom->FetchAtf();
        echo json_encode($data);
	} 
}
