<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RepLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('url');
        $this->load->model('comercial/RepLista_model', 'lrep');
    }

    public function index() {
       $this->load->view('comercial/RepLista');
    }

    public function RepEdita($id) {
		$data['ArrayREP'] = $this->lrep->fetchEditaRep($id);
		$data['ArrayCGO'] = $this->lrep->getCargosDeExecucao();
		$data['ArrayFTA'] = $this->lrep->GetFerramentas();
		//print_r($data);
		$this->load->view('comercial/RepEdita', $data);
    }

    public function RepNovo() {
		$data['ArrayFTA'] = $this->lrep->GetFerramentas();
		$data['ArrayCGO'] = $this->lrep->getCargosDeExecucao();
        $this->load->view('comercial/RepNovo', $data);
    }

    public function fetchRep() {
        $data = $this->lrep->fetchRep();
        echo json_encode($data);
    }

    public function fetchEditaRep($id) {
        $data = $this->lrep->fetchEditaRep($id);
        echo json_encode($data);
    }

    public function updateRep() {
		$REP_Codigo = $this->input->post('REP_Codigo');
		$data = [
			'REP_CGOCodigo' => $this->input->post('REP_CGOCodigo') === null || $this->input->post('REP_CGOCodigo') === '' ? null : $this->input->post('REP_CGOCodigo'),
			'REP_FTACodigo' => $this->input->post('REP_FTACodigo') === null || $this->input->post('REP_FTACodigo') === '' ? null : $this->input->post('REP_FTACodigo'),
			'REP_UNVCodigo' => $this->input->post('REP_UNVCodigo'),
			'REP_VendaPreco' => $this->input->post('REP_VendaPreco')
		];

		if ($this->lrep->updateRep($REP_Codigo, $data)) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Falha ao atualizar os Recursos e Preços.']);
		}
	}

    public function insertRep() {
        $data = [
            'REP_CGOCodigo' => $this->input->post('REP_CGOCodigo') === null || $this->input->post('REP_CGOCodigo') === '' ? null : $this->input->post('REP_CGOCodigo'),
			'REP_FTACodigo' => $this->input->post('REP_FTACodigo') === null || $this->input->post('REP_FTACodigo') === '' ? null : $this->input->post('REP_FTACodigo'),
			'REP_UNVCodigo' => $this->input->post('REP_UNVCodigo'),
			'REP_VendaPreco' => $this->input->post('REP_VendaPreco')
        ];
        if ($this->lrep->insertRep($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao inserir os Recursos e Preços.']);
        }
    }
}
