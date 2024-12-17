<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RelatorioPjtCheckAva extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("gestaoprojeto/RelatorioPjtCheckAva_model", 'rm');
    }

    public function RelatorioPjtCheckAva()
    {
        $data['listaPjt'] = $this->rm->fetchPPxSelecao();
        $this->load->view('gestaoprojeto/RelatorioPjtCheckAva', $data);
    }

    public function fetchRelatorioPjtCheckAva()
    {
        $selectedPjt = $this->input->post("selectedPjt");
        $pAbreAtividade = $this->input->post("pAbreAtividade");
        $pNaoFaturavel =  $this->input->post("pNaoFaturavel");
        $pSoServico  =  $this->input->post("pSoServico");
        $pPjtEmExecucao =  $this->input->post("pPjtEmExecucao");
        $data = $this->rm->fetchRelatorioPjtCheckAva($selectedPjt, $pAbreAtividade, $pNaoFaturavel, $pSoServico, $pPjtEmExecucao);
        echo json_encode($data);
    }

}
