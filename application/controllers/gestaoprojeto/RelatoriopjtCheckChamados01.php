<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RelatoriopjtCheckChamados01 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("gestaoprojeto/RelatoriopjtCheckChamados01_model", 'rm');
    }

    public function RelatoriopjtCheckChamados01()
    {
        $data['listaPjt'] = $this->rm->fetchPJTSelecao();
        $this->load->view('gestaoprojeto/RelatoriopjtCheckChamados01', $data);
    }

    public function fetchRelatoriopjtCheckChamados01()
    {
        $selectedPjt = $this->input->post("selectedPjt");
        $pFechaEmPlano = $this->input->post("pFechaEmPlano");
        $pIncluiChdInativo =  $this->input->post("pIncluiChdInativo");
        $data = $this->rm->fetchRelatoriopjtCheckChamados01($selectedPjt, $pFechaEmPlano, $pIncluiChdInativo);
        echo json_encode($data);
    }

}
