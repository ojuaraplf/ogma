<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CpgLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("financeiro/CpgLista_model", 'lsCpg');
    }

    public function index() {
        $this->load->view('financeiro/CpgLista');
    }
    
    public function CpgEdita($id) {
        $data['ArrayCPG'] = $this->lsCpg->fetchEditaCpg($id);
        // print_r($data);
        $this->load->view('financeiro/CpgEdita', $data);
    }

    public function fetchCpg() {
        $data = $this->lsCpg->fetchCpg();
        echo json_encode($data);
    }
    
    function UpdateCpg()
    {
        $data = array(
            "CPG_Descricao" => $this->input->post("CPG_Descricao")
            );
            $pCPG_Codigo = $this->input->post("CPG_Codigo");
            $this->lsCpg->updateCpg($pCPG_Codigo, $data);
    }

    public function CpgCria()
    {             
        $this->load->view('financeiro/CpgNovo');
    }

    function InsertCpg()
    {
        $data = array(
            "CPG_Descricao" => $this->input->post("CPG_Descricao")
            );
            $this->lsCpg->InsertCpg($data);
    }

}