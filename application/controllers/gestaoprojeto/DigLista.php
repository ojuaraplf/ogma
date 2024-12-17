<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DigLista extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("gestaoprojeto/DigLista_model", 'dgm');
    }

    public function DigLista()
    {
        $UsuLogado = $this->session->userdata("userCodigo");
        $data['listaMes'] = $this->dgm->fetchselectedMes();
        $data['listaCbr'] = $this->dgm->fetchselectedCbr();
        $data['listaPjt'] = $this->dgm->fetchselectedPjt(intval($UsuLogado));
        $data['listaGco'] = $this->dgm->fetchselectedGco();
        $this->load->view('gestaoprojeto/DigLista', $data);
    }

    public function fecthPjt($vPJT)
    {
        $data['listaPjt'] = $this->dgm->fetchselectedPjt($vPJT);
        echo json_encode($data);
    }

    public function fetchDigLista()
    {
        // $pMES = date('m',strtotime($this->input->post("selectedMes")));
        // $pANO = date('Y',strtotime($this->input->post("selectedMes")));
        $pMES = substr($this->input->post("selectedMes"), 5, 2);
        $pANO = substr($this->input->post("selectedMes"), 0, 4);
        $pCBR = $this->input->post("selectedCbr");
        // $pCBR = null;
        $pGCO = $this->input->post("selectedGco");
        $pPJT = $this->input->post("selectedPjt");
        $pPJTFecha = $this->input->post("selectedPjtFecha");

        // echo json_encode(date('m',strtotime($pMES)));
        // echo $pMES;
        // echo $pANO;
        
        //echo $pCBR;
        //echo $pGCO;
        // echo $pPJT;
        
        $data = $this->dgm->fetchDigLista($pMES, $pANO, $pCBR, $pGCO, $pPJT, $pPJTFecha );
        echo json_encode($data);
    }


    // public function fetchDigGeralLista()
    // {
    //     $pMES = substr($this->input->post("selectedMes"), 5, 2);
    //     $pANO = substr($this->input->post("selectedMes"), 0, 4);
    //     $pCBR = null;
    //     $pGCO = $this->input->post("selectedGco");
    //     $pPJT = null;
        
    //     $data = $this->dgm->fetchDigLista($pMES, $pANO, $pCBR, $pGCO, $pPJT );
    //     echo json_encode($data);
    // }

}
