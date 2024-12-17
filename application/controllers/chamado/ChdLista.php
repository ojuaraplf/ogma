<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChdLista extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("chamado/ChdLista_model", 'chm');
    }

    function myArrayContainsId(array $myArray, $id) {
        foreach ($myArray as $element) {
            if ($element['CODIGO'] == $id) {
                return 1;
            }
        }
        return 0;
    }

    public function ChdLista()
    {
        $pGEP = intVal($this->input->get("selectedGep"));
        $pPJT = intVal($this->input->get("selectedPjt"));
        $pPJF = intVal($this->input->get("selectedPjf"));
        $pSOL = intVal($this->input->get("selectedSol"));
        $pAtivo = intVal($this->input->get("optionboxAtivo"));

        $data['listaGep'] = $this->chm->fetchselectedGco();

        $selectedGepIsOnList = $this->myArrayContainsId($data['listaGep'], $pGEP);

        $data['listaPjt'] = $this->chm->fetchselectedPjt($selectedGepIsOnList ? $pGEP : 0);
        $data['listaSol'] = $this->chm->fetchselectedSol($pPJT);
        $data['chdLista'] = $this->chm->fetchChdLista($pPJT, $pPJF, $selectedGepIsOnList ? $pGEP : 0, $pSOL, $pAtivo);
        
        $this->load->view('chamado/ChdLista', $data);
    }
}
