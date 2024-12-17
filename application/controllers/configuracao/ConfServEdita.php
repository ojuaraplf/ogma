<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ConfServEdita extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("configuracao/ConfServEdita_model", 'csem');
		}

    public function SvcEdita() {
      $Data['Svc_Edita'] = $this->csem->fetchConfServEdita();
			$this->load->view('configuracao/ConfServEdita.php', $Data);
		}
    
    public function updateConfServEdita()
    {
      $SVC_ApontaLimiteMenor = $this->input->post("SVC_ApontaLimiteMenor");
      $SVC_ApontaLimiteMaior = $this->input->post("SVC_ApontaLimiteMaior");
        $data = array(
          "SVC_ApontaLimiteMenor" => $SVC_ApontaLimiteMenor,
          "SVC_ApontaLimiteMaior" => $SVC_ApontaLimiteMaior
      );
        echo $this->csem->updateConfServEdita($data);
    }

}