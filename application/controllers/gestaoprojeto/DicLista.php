<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DicLista extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("gestaoprojeto/DicLista_model", 'dlm');
    }

    public function DicLista()
    {
        $data['listaMes'] = $this->dlm->fetchselectedMes();
        $data['listaCbr'] = $this->dlm->fetchselectedCbr();
        $data['listaPjt'] = $this->dlm->fetchselectedPjt();
        $data['listaGco'] = $this->dlm->fetchselectedGco();
        $this->load->view('gestaoprojeto/DicLista', $data);
    }

    public function fetchDicLista()
    {
        // $pMES = date('m',strtotime($this->input->post("selectedMes")));
        // $pANO = date('Y',strtotime($this->input->post("selectedMes")));
        $pMES = substr($this->input->post("selectedMes"), 5, 2);
        $pANO = substr($this->input->post("selectedMes"), 0, 4);
        $pCBR = $this->input->post("selectedCbr");
        $pGCO = $this->input->post("selectedGco");
        $pPJT = $this->input->post("selectedPjt");

        // echo json_encode(date('m',strtotime($pMES)));
        // echo $pMES;
        // echo $pANO;
        
        //echo $pCBR;
        //echo $pGCO;
        // echo $pPJT;
        
        $data = $this->dlm->fetchDicLista($pMES, $pANO, $pCBR, $pGCO, $pPJT );
        echo json_encode($data);
    }

}
