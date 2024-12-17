<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TctLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("contrato/TctLista_model", 'lsTct');
    }

    public function index() {
        $this->load->view('contrato/TctLista');
    }
    
    public function TctEdita($id) {
        $data['ArrayTCT'] = $this->lsTct->fetchEditaTct($id);
        // print_r($data);
        $this->load->view('contrato/TctEdita', $data);
    }
    
    public function fetchTct() {
        $data = $this->lsTct->fetchTct();
        echo json_encode($data);
    }
    
    function UpdateTct()
    {
        $data = array(
            "TCT_Descricao" => $this->input->post("TCT_Descricao")
            );
            $pTCT_Codigo = $this->input->post("TCT_Codigo");
            $this->lsTct->updateTct($pTCT_Codigo, $data);
    }

    public function TctCria()
    {             
        $this->load->view('contrato/TctNovo');
    }

    function InsertTct()
    {
        $data = array(
            "TCT_Descricao" => $this->input->post("TCT_Descricao")
            );
            $this->lsTct->InsertTct($data);
    }

}