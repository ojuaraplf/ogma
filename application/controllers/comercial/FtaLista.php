<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FtaLista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("comercial/FtaLista_model", 'lfta');
    }

    public function index() {
		$data['ArrayNEA'] = $this->lfta->fetchAreaNegocios();
        $this->load->view('comercial/FtaLista', $data);
    }
    
    public function FtaEdita($id) {
        $data['ArrayFTA'] = $this->lfta->fetchEditaFta($id);
		$data['ArrayNEA'] = $this->lfta->fetchAreaNegocios();
        // print_r($data);
        $this->load->view('comercial/FtaEdita', $data);
    }
    
	public function FtaCria()
    {          
		$data['ArrayNEA'] = $this->lfta->fetchAreaNegocios();
        $this->load->view('comercial/FtaNovo', $data);
    }

    public function fetchFta() {
		$pNEACodigo = $this->input->post('pNEACodigo') ? $this->input->post('pNEACodigo') : NULL;
		$pFTACodigo = $this->input->post('pFTACodigo') ? $this->input->post('pFTACodigo') : NULL;
		$data = $this->lfta->fetchFta($pNEACodigo, $pFTACodigo);
		echo json_encode($data);
	}

    function UpdateFta()
    {
        $data = array(
            "FTA_Denominacao" => $this->input->post("FTA_Denominacao"),
            "FTA_NEACodigo" => $this->input->post("FTA_NEACodigo"),
            "FTA_UltimaVersao" => $this->input->post("FTA_UltimaVersao"),
            "FTA_Especificacao" => $this->input->post("FTA_Especificacao"),
            "FTA_Fabricante" => $this->input->post("FTA_Fabricante"),
            "FTA_Representante" => $this->input->post("FTA_Representante")
            );
            $pFTA_Codigo = $this->input->post("FTA_Codigo");
            $this->lfta->updateFta($pFTA_Codigo, $data);
    }

    function InsertFta()
    {
        $data = array(
            "FTA_Denominacao" => $this->input->post("FTA_Denominacao"),
            "FTA_NEACodigo" => $this->input->post("FTA_NEACodigo"),
            "FTA_UltimaVersao" => $this->input->post("FTA_UltimaVersao"),
            "FTA_Especificacao" => $this->input->post("FTA_Especificacao"),
            "FTA_Fabricante" => $this->input->post("FTA_Fabricante"),
            "FTA_Representante" => $this->input->post("FTA_Representante")
            );
            $this->lfta->InsertFta($data);
    }

    public function fetchAreaNegocios() {
        $data = $this->lfta->fetchAreaNegocios();
        echo json_encode($data);
    }

}
