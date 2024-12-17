<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CfcLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("financeiro/CfcLista_model", 'lsCfc');
    }

    public function index() {
        $this->load->view('financeiro/CfcLista');
    }
    
    public function CfcEdita($id) {
        $data['ArrayCFC'] = $this->lsCfc->fetchEditaCfc($id);
        // print_r($data);
        $this->load->view('financeiro/CfcEdita', $data);
    }

    public function fetchCfc() {
        $data = $this->lsCfc->fetchCfc();
        echo json_encode($data);
    }
    
    function UpdateCfc()
    {
        $data = array(
            "CFC_Descricao" => $this->input->post("CFC_Descricao")
            );
            $pCFC_Codigo = $this->input->post("CFC_Codigo");
            $this->lsCfc->updateCfc($pCFC_Codigo, $data);
    }

    public function CfcCria()
    {             
        $this->load->view('financeiro/CfcNovo');
    }

    function InsertCfc()
    {
        $data = array(
            "CFC_Descricao" => $this->input->post("CFC_Descricao")
            );
            $this->lsCfc->InsertCfc($data);
    }

}