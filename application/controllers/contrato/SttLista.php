<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SttLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("contrato/SttLista_model", 'lstt');
    }

    public function index() {
        $this->load->view('contrato/SttLista');
    }
    
    public function SttEdita($id) {
        $data['ArraySTT'] = $this->lstt->fetchEditaStt($id);
        // print_r($data);
        $this->load->view('contrato/SttEdita', $data);
    }
    
    public function fetchStt() {
        $data = $this->lstt->fetchStt();
        echo json_encode($data);
    }
    
    function UpdateStt()
    {
        $data = array(
            "STT_Descricao" => $this->input->post("STT_Descricao")
            );
            $pSTT_Codigo = $this->input->post("STT_Codigo");
            $this->lstt->updateStt($pSTT_Codigo, $data);
    }

    public function SttCria()
    {             
        $this->load->view('contrato/SttNovo');
    }

    function InsertStt()
    {
        $data = array(
            "STT_Descricao" => $this->input->post("STT_Descricao")
            );
            $this->lstt->InsertStt($data);
    }

}