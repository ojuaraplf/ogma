<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class UsuLista extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("configuracao/UsuLista_model", 'lmus');
		}

		public function UsuLista() {
			$this->load->view('configuracao/UsuLista');
		}
    
    public function UsuNovo() {
      $data['ogma_PES_Selecao01'] = $this->lmus->fetchogma_PES_Selecao01();
			$this->load->view('configuracao/UsuNovo', $data);
		}

    public function UsuEdita($Id) {
      $Data['usuario'] = $this->lmus->fetchEditaUsu($Id);
			$this->load->view('configuracao/UsuEdita.php', $Data);
		}
    
    public function fetchUsuLista()
    {
        $pUsuCodigo = $this->input->post("vUSUCodigo");
        $pAtivo = $this->input->post("optionboxAtivo");
        $data = $this->lmus->fetchUsuLista($pUsuCodigo, $pAtivo );
        echo json_encode($data);
    }
    
    public function UpdateUsu()
    {
        $USU_PESCodigo = $this->input->post("USU_PESCodigo");
        $USU_Login = $this->input->post("USU_Login");        
        $USU_FlgPodeAcessarOgma = $this->input->post("USU_FlgPodeAcessarOgma");
        $USU_FlgPodeAcessarSirius = $this->input->post("USU_FlgPodeAcessarSirius");
        $USU_FlgPodeEditarPessoa = $this->input->post("USU_FlgPodeEditarPessoa");
        $USU_FlgPodeEditarColaborador = $this->input->post("USU_FlgPodeEditarColaborador");
        $USU_FlgPodeEditarUsuario = $this->input->post("USU_FlgPodeEditarUsuario");
        $USU_FlgPodeAcessarGestaoPlanos = $this->input->post("USU_FlgPodeAcessarGestaoPlanos");
        $USU_FlgPodePreFaturar = $this->input->post("USU_FlgPodePreFaturar");
        $USU_FlgPodePrePagar = $this->input->post("USU_FlgPodePrePagar");
        $USU_FlgRecebeEmail = $this->input->post("USU_FlgRecebeEmail");
        
    
         $data = array(
            "USU_PESCodigo" => $USU_PESCodigo,
            "USU_Login" => $USU_Login,            
            "USU_FlgPodeAcessarOgma" => $USU_FlgPodeAcessarOgma,
            "USU_FlgPodeAcessarSirius" => $USU_FlgPodeAcessarSirius,
            "USU_FlgPodeEditarPessoa" => $USU_FlgPodeEditarPessoa,
            "USU_FlgPodeEditarColaborador" => $USU_FlgPodeEditarColaborador,
            "USU_FlgPodeEditarUsuario" => $USU_FlgPodeEditarUsuario,
            "USU_FlgPodeAcessarGestaoPlanos" => $USU_FlgPodeAcessarGestaoPlanos,
            "USU_FlgPodePreFaturar" => $USU_FlgPodePreFaturar,
            "USU_FlgPodePrePagar" => $USU_FlgPodePrePagar,
            "USU_FlgRecebeEmail" => $USU_FlgRecebeEmail
        );

        echo $this->lmus->UpdateUsu($USU_PESCodigo, $data);
    }

    public function AdicionaUsu()
    {
        $USU_PESCodigo = $this->input->post("USU_PESCodigo");
        $USU_Login = $this->input->post("USU_Login");        
        $USU_FlgPodeAcessarOgma = $this->input->post("USU_FlgPodeAcessarOgma");
        $USU_FlgPodeAcessarSirius = $this->input->post("USU_FlgPodeAcessarSirius");
        $USU_FlgPodeEditarPessoa = $this->input->post("USU_FlgPodeEditarPessoa");
        $USU_FlgPodeEditarColaborador = $this->input->post("USU_FlgPodeEditarColaborador");
        $USU_FlgPodeEditarUsuario = $this->input->post("USU_FlgPodeEditarUsuario");
        $USU_FlgPodeAcessarGestaoPlanos = $this->input->post("USU_FlgPodeAcessarGestaoPlanos");
        $USU_FlgPodePreFaturar = $this->input->post("USU_FlgPodePreFaturar");
        $USU_FlgPodePrePagar = $this->input->post("USU_FlgPodePrePagar");
        $USU_FlgRecebeEmail = $this->input->post("USU_FlgRecebeEmail");
        
         $data = array(
            "USU_PESCodigo" => $USU_PESCodigo,
            "USU_Login" => $USU_Login,
            "USU_FlgPodeAcessarOgma" => $USU_FlgPodeAcessarOgma,
            "USU_FlgPodeAcessarSirius" => $USU_FlgPodeAcessarSirius,
            "USU_FlgPodeEditarPessoa" => $USU_FlgPodeEditarPessoa,
            "USU_FlgPodeEditarColaborador" => $USU_FlgPodeEditarColaborador,
            "USU_FlgPodeEditarUsuario" => $USU_FlgPodeEditarUsuario,
            "USU_FlgPodeAcessarGestaoPlanos" => $USU_FlgPodeAcessarGestaoPlanos,
            "USU_FlgPodePreFaturar" => $USU_FlgPodePreFaturar,
            "USU_FlgPodePrePagar" => $USU_FlgPodePrePagar,
            "USU_FlgRecebeEmail" => $USU_FlgRecebeEmail
        );

        echo $this->lmus->AdicionaUsu($data);
    }

    public function salvarPesNovo()
    {
      $data = array(
      "PES_Nome" => $this->input->post("PES_Nome"),
      "PES_TipoFouJ" => $this->input->post("PES_TipoFouJ"),
      "PES_MomCadastro" => $this->input->post("PES_MomCadastro"),        
      "PES_Apelido" => $this->input->post("PES_Apelido"),		
      "PES_ContEmail" => $this->input->post("PES_ContEmail")
      );
      
      $rPesNova = $this->lmus->salvarPesNovo($data);		
      echo $rPesNova;
    }

	public function salvarUsuNovo()
    {
      $data = array(
      "USU_PESCodigo" => $this->input->post("USU_PESCodigo")
    );
      
      $this->lmus->salvarUsuNovo($data);
      return true;
    }
}