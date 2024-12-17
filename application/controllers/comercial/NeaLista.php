<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NeaLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('url');
        $this->load->model('comercial/NeaLista_model', 'lnea');
    }

    // Método para listar áreas de negócios
    public function index() {
       $data['ArrayNEA'] = $this->lnea->fetchAreaNegocios(); // Puxa todas as áreas de negócio para o select
       $this->load->view('comercial/NeaLista', $data);
    }

    // Método para editar uma área de negócio
    public function NeaEdita($id) {
		$data['ArrayNEA'] = $this->lnea->fetchEditaNea($id); // Busca a área de negócio para edição
		//print_r($data);
		$this->load->view('comercial/NeaEdita', $data);
    }

    // Método para criar uma nova área de negócio
    public function NeaNovo() {
        $this->load->view('comercial/NeaNovo');
    }

    // Método para buscar áreas de negócio via AJAX
    public function fetchNea() {
        $data = $this->lnea->fetchAreaNegocios();
        echo json_encode($data);
    }

    // Método para buscar uma área de negócio para edição via AJAX
    public function fetchEditaNea($id) {
        $data = $this->lnea->fetchEditaNea($id);
        echo json_encode($data);
    }

    // Método para atualizar uma área de negócio
    public function updateAreaNegocios() {
        $NEA_Codigo = $this->input->post('NEA_Codigo'); // Captura o código da área de negócio
        $data = [
            'NEA_Denominacao' => $this->input->post('NEA_Denominacao'),
            'NEA_Especificacao' => $this->input->post('NEA_Especificacao'),
            'NEA_Acronimo' => $this->input->post('NEA_Acronimo')
        ];
        if ($this->lnea->updateAreaNegocios($NEA_Codigo, $data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao atualizar a área de negócio.']);
        }
    }

    // Método para inserir uma nova área de negócio
    public function insertAreaNegocios() {
        $data = [
            'NEA_Denominacao' => $this->input->post('NEA_Denominacao'),
            'NEA_Especificacao' => $this->input->post('NEA_Especificacao'),
            'NEA_Acronimo' => $this->input->post('NEA_Acronimo')
        ];
        if ($this->lnea->insertAreaNegocios($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao inserir a área de negócio.']);
        }
    }
}
