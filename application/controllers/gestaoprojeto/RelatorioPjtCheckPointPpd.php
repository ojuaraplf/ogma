<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RelatorioPjtCheckPointPpd extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("gestaoprojeto/RelatorioPjtCheckPointPpd_model", 'rm');
    }

    public function RelatorioPjtCheckPointPpd()
    {
        $data['listaPjt'] = $this->rm->fetchPJTSelecao();
        $this->load->view('gestaoprojeto/RelatorioPjtCheckPointPpd', $data);
    }

    public function fetchRelatorioPjtCheckPointPpd()
    {
        $selectedPjt = $this->input->post("selectedPjt");
        $pAbreAtividade = $this->input->post("pAbreAtividade");
        $pNaoFaturavel =  $this->input->post("pNaoFaturavel");
        $pSoServico  =  $this->input->post("pSoServico");
        $pPjtEmExecucao =  $this->input->post("pPjtEmExecucao");
        $data = $this->rm->fetchRelatorioPjtCheckPointPpd($selectedPjt, $pAbreAtividade, $pNaoFaturavel, $pSoServico, $pPjtEmExecucao);
        echo json_encode($data);
    }

}
