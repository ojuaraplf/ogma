<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpcLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("contrato/UpcLista_model", 'lsUpc');
    }

    public function index() {
        $this->load->view('contrato/UpcLista');
    }
    
    public function UpcEdita($id) {
        $data['ArrayUPC'] = $this->lsUpc->fetchEditaUpc($id);
        // print_r($data);
        $this->load->view('contrato/UpcEdita', $data);
    }
    
    public function fetchUpc() {
        $data = $this->lsUpc->fetchUpc();
        echo json_encode($data);
    }
    
    function UpdateUpc()
    {
        $data = array(
            "UPC_Descricao" => $this->input->post("UPC_Descricao")
            );
            $pUPC_Codigo = $this->input->post("UPC_Codigo");
            $this->lsUpc->updateUpc($pUPC_Codigo, $data);
    }

    public function UpcCria()
    {             
        $this->load->view('contrato/UpcNovo');
    }

    function InsertUpc()
    {
        $data = array(
            "UPC_Descricao" => $this->input->post("UPC_Descricao")
            );
            $this->lsUpc->InsertUpc($data);
    }

}