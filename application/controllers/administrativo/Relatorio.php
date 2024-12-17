<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relatorio extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("administrativo/relatorio_model", 'rm');
    }

    public function relatorioFechaMes()
    {
        $data['listaColaborador'] = $this->rm->fetchColaborador();
        $this->load->view('administrativo/relatorio/RelatorioFechaMes', $data);
    }

    public function fetchRelatorioFechaMes()
    {
        $selectedColaborador = $this->input->post("selectedColaborador");
        $selectedMes = $this->input->post("selectedMes");
        $pAbreProjeto = $this->input->post("pAbreProjeto");
        $data = $this->rm->fetchRelatorioFechaMes($selectedColaborador, $selectedMes, $pAbreProjeto);
        echo json_encode($data);
    }

    public function saveRelatorioFechaMes()
    {
        $arrayRowFechar = $this->input->post("arrayRowFechar");
        echo $this->rm->saveRelatorioFechaMes($arrayRowFechar);
    }
}
