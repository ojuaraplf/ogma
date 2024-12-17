<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailFaturamento extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("financeiro/emailFaturamento_model", 'efm');
    }
 
    public function listaColaborador()
    {
        $currentDate = date('Y-m-d', strtotime('-1 month'));
        $data['listaColaborador'] = $this->efm->fetchColaborador($currentDate);
        $this->load->view('financeiro/EmailFaturamento', $data);
    }

    public function fetchEmployeesInPeriod()
    {
        $LCT_DATA = $this->input->post("LCT_DATA");
        $data = $this->efm->fetchColaborador($LCT_DATA);
        echo json_encode($data);
    }
}