<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class CasLista extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->model("configuracao/CasLista_model", 'lscas');
		}

		public function CasLista() {
			
			$data['pCasAtivo'] = $this->input->get("aCasAtivo");
			$data['pCsiId'] = $this->input->get("aCsiId") == '0' ? null : $this->input->get("aCsiId");
			$data['pCasAbreI'] = $this->input->get("aCasAbreI");
			
			$data['CasCabeca'] = (object)$this->lscas->fetchCasLista($data['pCasAtivo'], $data['pCsiId'], $data['pCasAbreI'] )[0];

			$this->load->view('configuracao/CasLista', $data);
		}

		public function CasEdita( $pCsiId ) {
			
			$aCasAtivo = 3;
			$aCsiId = $pCsiId;
			$aAbrir =  0;
			
			$data['arrayCasEdita'] = $this->lscas->fetchCasLista( $aCasAtivo, $aCsiId, $aAbrir );
			// print_r($data);

			$this->load->view('configuracao/CasEdita', $data);
		}
		
		public function fetchCasLista()
		{
			$CasAtivo = $this->input->post("CasAtivo");
			$CsiId = $this->input->post("CsiId");
        	$pAbre = $this->input->post("pAbre");

			$CsiId = $CsiId == '' ? null : $CsiId;
			$CsiId = NULL;

			$data = $this->lscas->fetchCasLista($CasAtivo, $CsiId, $pAbre );
			echo json_encode($data);
		}

		public function fetchComboATF()
		{
			$data = $this->lscas->fetchComboATF();					
			echo json_encode($data);
		}

		public function fetchComboTOD()
		{
			$pIni1_Fim2 = $this->input->post("aIni1_Fim2");
			$data = $this->lscas->fetchComboTOD($pIni1_Fim2);
			// print_r($data);
			echo json_encode($data);
		}


		public function fetchTemplTAG()
		{
			$aCSICodigo = $this->input->post("pCSICodigo");
			$data = $this->lscas->fetchTemplTAG($aCSICodigo);
			//print_r($data);
			echo json_encode($data);
		}

		public function fetchTemplTPN()
		{
			$aCSICodigo = $this->input->post("pCSICodigo");
			$data = $this->lscas->fetchTemplTPN($aCSICodigo);
			//print_r($data);
			echo json_encode($data);
		}

		public function fetchTemplTPF()
		{
			$aCSICodigo = $this->input->post("pCSICodigo");
			$data = $this->lscas->fetchTemplTPF($aCSICodigo);
			//print_r($data);
			echo json_encode($data);
		}

		
		
		public function UpdateCas()
		{
			  $data = array(				 
				 "CSI_CODIGO" => $this->input->post("CSI_CODIGO"),
				 "CSI_SERVTITULO" => $this->input->post("CSI_SERVTITULO"),
				 "CSI_AcronimoPlanoServico" => $this->input->post("CSI_AcronimoPlanoServico"),
				 "CSI_SERVSUBTITULO" => $this->input->post("CSI_SERVSUBTITULO"),
				 "CSI_SERVDESCRICAO" => $this->input->post("CSI_SERVDESCRICAO"),
				 "CSI_DESATIVADO" => $this->input->post("CSI_DESATIVADO"),
				 "CAS_CODIGO" => $this->input->post("CAS_CODIGO"),
				 "CSI_FlgGeraPJRAutomatica" => $this->input->post("CSI_FlgGeraPJRAutomatica"),
				 "CSI_FlgGeraPJAAutomatica" => $this->input->post("CSI_FlgGeraPJAAutomatica"),
				 "CSI_FlgGeraATGAutomatica" => $this->input->post("CSI_FlgGeraATGAutomatica"),
				 "CSI_FlgGeraPLCAutomatica" => $this->input->post("CSI_FlgGeraPLCAutomatica"),
				 "CSI_FlgGeraPLDAutomatica" => $this->input->post("CSI_FlgGeraPLDAutomatica"),
				 "CSI_FlgGeraTPTAutomatica" => $this->input->post("CSI_FlgGeraTPTAutomatica"),
				 "CSI_FlgGeraPJCAutomatica" => $this->input->post("CSI_FlgGeraPJCAutomatica"),
				 "CSI_FlgGeraPJNAutomatica" => $this->input->post("CSI_FlgGeraPJNAutomatica"),
				 "CSI_FlgCHDgeraATG" => $this->input->post("CSI_FlgCHDgeraATG"),
				 "CSI_FlgEhProjeto" => $this->input->post("CSI_FlgEhProjeto"),
				 "CSI_FlgEhOperacao" => $this->input->post("CSI_FlgEhOperacao"),
				 "CSI_FlgEhOperacaoPps" => $this->input->post("CSI_FlgEhOperacaoPps"),
				 "CSI_FlgEhOperacaoPos" => $this->input->post("CSI_FlgEhOperacaoPos"),
				 "CSI_FlgPzoNaANS" => $this->input->post("CSI_FlgPzoNaANS")
			);
			echo $this->lscas->UpdateCas($this->input->post("CSI_CODIGO"), $data);
		}

		public function UpdateTpn()
		{
			  $data = array(				 
				 "TPF_CSICodigo" => $this->input->post("TPF_CSICodigo"),
				 "TPF_TORCodigo" => $this->input->post("TPF_TORCodigo"),
				 "TPN_FechmtoPeriInicio" => $this->input->post("TPN_FechmtoPeriInicio"),
				 "TPN_FechmtoPeriInicioMes" => $this->input->post("TPN_FechmtoPeriInicioMes"),
				 "TPN_FechmtoPeriTermino" => $this->input->post("TPN_FechmtoPeriTermino"),
				 "TPN_FechmtoPeriTerminoMes" => $this->input->post("TPN_FechmtoPeriTerminoMes"),
				 "TPN_FechmtoDiaFechar" => $this->input->post("TPN_FechmtoDiaFechar"),
				 "TPN_PagmntoDiasPrazo" => $this->input->post("TPN_PagmntoDiasPrazo"),
				 "TPN_PropostaCaminho" => $this->input->post("TPN_PropostaCaminho"),
				 "TPN_NotaFsclDescricao" => $this->input->post("TPN_NotaFsclDescricao"),
				 "TPN_IndiceImposto" => $this->input->post("TPN_IndiceImposto")				 
			);
			echo $this->lscas->UpdateTpn($this->input->post("TPF_CSICodigo"), $data);
		}
		
		public function UpdateTpf()
		{
			  $data = array(				 
				 "TPF_CSICodigo" => $this->input->post("TPF_CSICodigo"),
				 "TPF_DescrAcolhimento" => $this->input->post("TPF_DescrAcolhimento"),
				 "TPF_FlgMostraPrazo" => $this->input->post("TPF_FlgMostraPrazo"),
				 "TPF_FlgMostraAvaliacao" => $this->input->post("TPF_FlgMostraAvaliacao"),
				 "TPF_FlgMostraTrd" => $this->input->post("TPF_FlgMostraTrd"),
				 "TPF_FlgMostraDocReferencia" => $this->input->post("TPF_FlgMostraDocReferencia"),
				 "TPF_FlgMostraOrcamento" => $this->input->post("TPF_FlgMostraOrcamento"),
				 "TPF_FlgDisparaEmail" => $this->input->post("TPF_FlgDisparaEmail"),
				 "TPF_FlgRecebeChamado" => $this->input->post("TPF_FlgRecebeChamado"),
				 "TPF_OrcaTermoAceite" => $this->input->post("TPF_OrcaTermoAceite"),
				 "TPF_EntrTermoEntrega" => $this->input->post("TPF_EntrTermoEntrega")
			);
			echo $this->lscas->UpdateTpf($this->input->post("TPF_CSICodigo"), $data);
		}

		function updateTag()
		{
			$arrayTag = $this->input->post("arrayTag");
			$this->lscas->updateTag($arrayTag);
		}

		function deleteTag()
		{
			$arrayDeleteTag = $this->input->post("arrayDeleteTag");
			$this->lscas->deleteTag($arrayDeleteTag);
		}
		public function fetchTipoOrcamento()
		{
			$data = $this->epm->fetchTipoOrcamento();
			$arrayData = array();
			foreach ($data as $key) {
				array_push(
					$arrayData,
					$data = array(
						"TOR_Codigo" => $key["TOR_Codigo"],
						"TOR_Nome" => $key["TOR_Nome"],
						"TOR_Descricao" => $key["TOR_Descricao"],
						"TOR_FlgFatChkLimiteQtHora" => $key["TOR_FlgFatChkLimiteQtHora"],
						"TOR_FlgFatChkLimitePrazo" => $key["TOR_FlgFatChkLimitePrazo"]
					)
				);
			}
			echo json_encode($arrayData);
		}
}



