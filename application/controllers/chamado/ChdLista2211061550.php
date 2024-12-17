<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChdLista extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("chamado/ChdLista_model", 'chm');
    }

    public function ChdLista()
    {
        $UsuLogado = $this->session->userdata("userCodigo");
        // $data['listaCbr'] = $this->chm->fetchselectedCbr();
        $data['listaPjt'] = $this->chm->fetchselectedPjt(intval($UsuLogado));
        $data['listaGep'] = $this->chm->fetchselectedGco();
        $data['listaSol'] = $this->chm->fetchselectedSol(null);
        $this->load->view('chamado/ChdLista', $data);
    }

    public function fecthPjt($vPJT)
    {
        $data['listaPjt'] = $this->chm->fetchselectedPjt($vPJT);
        echo json_encode($data);
    }

    public function fecthSol($vPJT)
    {
        $data['listaSol'] = $this->chm->fetchselectedSol($vPJT);
        echo json_encode($data);
    }

    public function fetchChdLista()
    {
        // $pMES = date('m',strtotime($this->input->post("selectedMes")));
        // $pANO = date('Y',strtotime($this->input->post("selectedMes")));
        // $pMES = substr($this->input->post("selectedMes"), 5, 2);
        // $pANO = substr($this->input->post("selectedMes"), 0, 4);
        $pPJT = $this->input->post("selectedPjt");
        $pPJF = $this->input->post("selectedPjf");
        $pGEP = $this->input->post("selectedGep");
        $pSOL = $this->input->post("selectedSol");
        $pAtivo = $this->input->post("optionboxAtivo");
    
        // echo $this->input->post("selectedPjt");
        // echo $pPJF;
        // echo $pGEP;
        // echo $pSOL;
        // echo $pAtivo;

        $data = $this->chm->fetchChdLista($pPJT, $pPJF, $pGEP, $pSOL, $pAtivo );
        echo json_encode($data);
    }

    public function fetchChamados() {
        $data = $this->chm->fetchChamados();
        $arrayData = array();
        foreach ($data as $key) {
          array_push($arrayData, $data = array(
            "CHD_Codigo" => $key["CHD_Codigo"],
            "CHD_Descricao" => $key["CHD_Descricao"],
            "CHD_PJFCodigo" => $key["CHD_PJFCodigo"],
            "CHD_CHPCodigo" => $key["CHD_CHPCodigo"],
            "STC_Descricao" => $key["STC_Descricao"],
            "PJT_APELIDO" => $key["PJT_APELIDO"],
            "CHD_MomAbertura" => $key["CHD_MomAbertura"],
            "CHD_CHCCodigo" => $key["CHD_CHCCodigo"],
            "CHD_STCCodigo" => $key["CHD_STCCodigo"],
            "CHD_TextoSolicitacao" => $key["CHD_TextoSolicitacao"],
            "CHD_PFR_Codigo" => $key["CHD_PFR_Codigo"],
            "CHD_AvalGrauSatisfacao" => $key["CHD_AvalGrauSatisfacao"],
            "CHD_AvalParecer" => $key["CHD_AvalParecer"],
            "CHD_MomAprvcao" => $key["CHD_MomAprvcao"],
            "CHD_MomNovoStatus" => $key["CHD_MomNovoStatus"],
            "CHD_CBRCodigo" => $key["CHD_CBRCodigo"],
            "CHD_QtHora" => $key["CHD_QtHora"],
            "CHD_CHDCodigoAssociado" => $key["CHD_CHDCodigoAssociado"])
          );
        }
        echo json_encode($arrayData);
      }

}
