<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colaborador extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("administrativo/colaborador_model", 'cm');
    }

    public function listaColaborador()
    {
        $data['listaColaborador'] = $this->cm->fetchColaborador();
        $this->load->view('administrativo/ListaColaborador', $data);
    }

    public function colaborador($id)
    {
        $data['colaborador'] = $this->cm->fetchSingleColaborador($id);
        $data['ogrh_CBU_RemuneraUnidade'] = $this->cm->fetchogrh_CBU_RemuneraUnidade();
        $data['ogrh_CGO_DescricaoCargo'] = $this->cm->fetchogrh_CGO_DescricaoCargo();
        $data['ogma_PES_Pessoa'] = $this->cm->fetchogma_PES_Pessoa();

        $this->load->view('administrativo/Colaborador', $data);
    }

    public function updateColaborador($id)
    {
        $CBR_CBUCodigo = $this->input->post("CBR_CBUCodigo");
        $CBR_FlgRemuneraQuebrado = $this->input->post("CBR_FlgRemuneraQuebrado");
        $CBR_RemuneraValor = $this->input->post("CBR_RemuneraValor");
        $CBR_USULogin = $this->input->post("CBR_USULogin");
        $CBR_PESempCodigo = $this->input->post("CBR_PESempCodigo");
        $CBR_CGOcodigo = $this->input->post("CBR_CGOcodigo");

        $PES_ContEmail = $this->input->post("PES_ContEmail");

        $data = array(
            "CBR_CBUCodigo" => $CBR_CBUCodigo,
            "CBR_FlgRemuneraQuebrado" => $CBR_FlgRemuneraQuebrado,
            "CBR_RemuneraValor" => $CBR_RemuneraValor,
            "CBR_PESempCodigo" => $CBR_PESempCodigo,
            "CBR_CGOcodigo" => $CBR_CGOcodigo,
            "CBR_USULogin" => $CBR_USULogin
        );
        echo $this->cm->updateEmailColaborador($id, $PES_ContEmail);
        echo $this->cm->updateColaborador($id, $data);
    }

    public function novoColaborador()
    {
        $data['ogma_PES_Selecao01'] = $this->cm->fetchogma_PES_Selecao01();
        $data['ogrh_CBU_RemuneraUnidade'] = $this->cm->fetchogrh_CBU_RemuneraUnidade();
        $data['ogrh_CGO_DescricaoCargo'] = $this->cm->fetchogrh_CGO_DescricaoCargo();
        $data['ogma_PES_Pessoa'] = $this->cm->fetchogma_PES_Pessoa();
        $this->load->view('administrativo/NovoColaborador', $data);
    }

    public function salvarColaborador()
    {
        $CBR_PESCodigo = $this->input->post("CBR_PESCodigo");
        $CBR_CBUCodigo = $this->input->post("CBR_CBUCodigo");
        $CBR_FlgRemuneraQuebrado = $this->input->post("CBR_FlgRemuneraQuebrado");
        $CBR_RemuneraValor = $this->input->post("CBR_RemuneraValor");
        $CBR_USULogin = $this->input->post("CBR_USULogin");
        $CBR_PESempCodigo = $this->input->post("CBR_PESempCodigo");
        $CBR_CGOcodigo = $this->input->post("CBR_CGOcodigo");

        $data = array(
            "CBR_PESCodigo" => $CBR_PESCodigo,
            "CBR_CBUCodigo" => $CBR_CBUCodigo,
            "CBR_FlgRemuneraQuebrado" => $CBR_FlgRemuneraQuebrado,
            "CBR_RemuneraValor" => $CBR_RemuneraValor,
            "CBR_PESempCodigo" => $CBR_PESempCodigo,
            "CBR_CGOcodigo" => $CBR_CGOcodigo,
            "CBR_USULogin" => $CBR_USULogin
        );

        echo $this->cm->salvarColaborador($data);
    }
}
