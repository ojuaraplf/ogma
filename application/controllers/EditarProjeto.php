<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditarProjeto extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model("editarProjeto_model", 'epm');
	}

	public function index()
	{
		$this->load->view('servico/EditarProjeto');
	}


	public function downloadFile($PJD_Codigo)
	{
		$PJD_DocumLink = $this->epm->fetchDocumentLink($PJD_Codigo);

		$this->load->library('ftp');
		$config['hostname'] = 'ftp.wdiscovery.com.br';
		$config['username'] = 'wdiscov';
		$config['password'] = 'maur@i01vD09';
		$config['debug']    = TRUE;

		$this->ftp->connect($config);

		$array = explode('/', $PJD_DocumLink);
		$filename = strtolower(end($array)); // Now a variable. 


		$this->ftp->download($PJD_DocumLink, "./uploads/" . $filename);

		$data = $this->curl_get_contents(base_url() . 'uploads/' . $filename);
		@unlink("uploads/" . $filename);
		force_download($filename, $data);
	}

	public function curl_get_contents($url)
	{

		echo "CHEGOU AQUI";
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}


	public function uploadFile()
	{
		$folder = $this->input->post("folder");
		$PJD_DocumTitulo = $this->input->post("PJD_DocumTitulo");
		$PJD_PJTCodigo = $this->input->post("PJD_PJTCodigo");
		if (isset($_FILES["uploadFile"]["name"])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|docx|txt|xlsx|xls';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('uploadFile')) {
				echo $this->upload->display_errors();
			} else {
				$data = $this->upload->data();

				$filename = $data["file_name"];
				$source = 'uploads/' . $filename;

				$this->load->library('ftp');

				$config['hostname'] = 'ftp.wdiscovery.com.br';
				$config['username'] = 'wdiscov';
				$config['password'] = 'maur@i01vD09';
				$config['debug']    = TRUE;

				$this->ftp->connect($config);

				$destination = "";

				if ($this->ftp->list_files('WDPlanos/' . $folder . '/') == FALSE) {
					$this->ftp->mkdir('WDPlanos/' . $folder . '/', DIR_WRITE_MODE);
					$destination = 'WDPlanos/' . $folder . '/' . $filename;
				} else {
					$destination = 'WDPlanos/' . $folder . '/' . $filename;
				}

				$this->ftp->upload($source, $destination);
				$this->ftp->close();
				@unlink($source);

				$data = array(
					"PJD_DocumTitulo" => $PJD_DocumTitulo,
					"PJD_PJTCodigo" => $PJD_PJTCodigo,
					"PJD_DocumLink" => $destination
				);
				$this->epm->uploadFile($data);
			}
		}
	}

	public function fetchDocumentos()
	{
		$PJD_PJTCodigo = $this->input->post("PJD_PJTCodigo");
		$data = $this->epm->fetchDocumentos($PJD_PJTCodigo);
		echo json_encode($data);
	}

	public function fetchPessoaDoCLiente()
	{
		$pPJT = $this->input->post("PJT_CODIGO");
		$data = $this->epm->fetchogco_CLP_Selecao01_DoClienteDoPPx($pPJT);
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"CODIGO" => $key["CODIGO"],
					"NOME" => $key["NOME"]
				)
			);
		}
		echo json_encode($arrayData);
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


	public function fetchStatusChamado()
	{
		$data = $this->epm->fetchStatusChamado();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"STC_Codigo" => $key["STC_Codigo"],
					"STC_Descricao" => $key["STC_Descricao"],
					"STC_FlgChamadoAtivo" => $key["STC_FlgChamadoAtivo"]
				)
			);
		}
		echo json_encode($arrayData);
	}
	
	public function fetchCategoriaChamado()
	{
		$data = $this->epm->fetchCategoriaChamado();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"CHC_Codigo" => $key["CHC_Codigo"],
					"CHC_Descricao" => $key["CHC_Descricao"]
				)
			);
		}
		echo json_encode($arrayData);
	}
	public function fetchPrioridadeChamado()
	{
		$data = $this->epm->fetchPrioridadeChamado();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"CHP_Codigo" => $key["CHP_Codigo"],
					"CHP_Descricao" => $key["CHP_Descricao"]
				)
			);
		}
		echo json_encode($arrayData);
	}
	public function fetchANS()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");
		//			echo $idProjeto;
		$data = $this->epm->fetchANS($idProjeto);
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"PJA_Codigo" => $key["PJA_Codigo"],
					"PJA_STCCodigo" => $key["PJA_STCCodigo"],
					"PJA_PJTCodigo" => $key["PJA_PJTCodigo"],
					"PJA_CHCCodigo" => $key["PJA_CHCCodigo"],
					"PJA_CHPCodigo" => $key["PJA_CHPCodigo"],
					"PJA_QtHoras" => $key["PJA_QtHoras"],
					"PJA_FlgContratada" => $key["PJA_FlgContratada"],
					"PJA_ANI_Codigo" => $key["PJA_ANI_Codigo"]
				)
			);
		}
		echo json_encode($arrayData);
	}

	public function fetchTermosProjeto()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");
		//			echo $idProjeto;
		$data = $this->epm->fetchTermosProjeto($idProjeto);
		// $arrayData = array();
		// foreach ($data as $key) {
		// 	array_push($arrayData, $data = array(
		// 		"PJX_Codigo" => $key["PJX_Codigo"],
		// 		"PJX_PJTCodigo" => $key["PJX_PJTCodigo"],
		// 		"PJX_TextoTermoKickoff" => $key["PJX_TextoTermoKickoff"],
		// 		"PJX_TextoTRD" => $key["PJX_TextoTRD"])
		// 	);
		// }
		echo json_encode($data);
	}

	public function fetchConfiguracaoDoChamado()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");
		$data = $this->epm->fetchConfiguracaoDoChamado($idProjeto);
		echo json_encode($data);
	}

	public function fetchConfiguracaoFinanceira()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");
		$data = $this->epm->fetchogsv_PJN_ConfFinanceiro($idProjeto);
		echo json_encode($data);
	}

	public function fetchFapParcela()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");
		$data = $this->epm->fetchogfn_PJE_ParceFatuProjeto($idProjeto);
		echo json_encode($data);
	}

	public function fetchPlanoDados()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");

		$data = $this->epm->fetchPlanoDados($idProjeto);
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"PLD_CODIGO" => $key["PLD_CODIGO"],
					"PLD_ARTEFATO" => $key["PLD_ARTEFATO"],
					"PLD_ARMAZENAMENTO" => $key["PLD_ARMAZENAMENTO"],
					"PLD_RESPONSAVEL" => $key["PLD_RESPONSAVEL"],
					"PLD_ACESSO" => $key["PLD_ACESSO"],
					"PLD_DISTRIBUICAO" => $key["PLD_DISTRIBUICAO"],
					"PJT_CODIGO" => $key["PJT_CODIGO"]
				)
			);
		}
		echo json_encode($arrayData);
	}

	public function fetchPlanoComunicacao()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");

		$data = $this->epm->fetchPlanoComunicacao($idProjeto);
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"PLC_Codigo" => $key["PLC_Codigo"],
					"PLC_Evento" => $key["PLC_Evento"],
					"PLC_Responsavel" => $key["PLC_Responsavel"],
					"PLC_Interessado" => $key["PLC_Interessado"],
					"PLC_Quando" => $key["PLC_Quando"],
					"PLC_FomaComunicacao" => $key["PLC_FomaComunicacao"],
					"PLC_PJTCodigo" => $key["PLC_PJTCodigo"]
				)
			);
		}
		echo json_encode($arrayData);
	}
	

	public function fetchMonitoramento()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");

		$data = $this->epm->fetchMonitoramento($idProjeto);
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"PJM_Codigo" => $key["PJM_Codigo"],
					"PJM_PJTCodigo" => $key["PJM_PJTCodigo"],
					"PJM_DataDaAgendaRevisao" => $key["PJM_DataDaAgendaRevisao"],
					"PJM_ERMCodigo" => $key["PJM_ERMCodigo"],
					"ERM_Descricao" => $key["ERM_Descricao"],
					"PJM_mDescricaoDaRevisao" => $key["PJM_mDescricaoDaRevisao"],
					"PJM_ParecerGQ" => $key["PJM_ParecerGQ"],
					"PJM_ParecerGP" => $key["PJM_ParecerGP"],
					"PJM_FlgRevisaoConcluida" => $key["PJM_FlgRevisaoConcluida"],
					"PJM_mMomentoDaRevisao" => $key["PJM_mMomentoDaRevisao"]
				)
			);
		}
		echo json_encode($arrayData);
	}

	public function fetchEspecieRevisao()
	{
		$data = $this->epm->fetchEspecieRevisao();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"ERM_Codigo" => $key["ERM_Codigo"],
					"ERM_Descricao" => $key["ERM_Descricao"]
				)
			);
		}
		echo json_encode($arrayData);
	}


	function fetchProject()
	{
		$idProjeto = $this->input->post("PJT_CODIGO");
		$projeto = $this->epm->fetchProject($idProjeto);
		echo json_encode($projeto);
	}

	public function fetchStatusProjeto()
	{
		$data = $this->epm->fetchStatusProjeto();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
					"STP_CODIGO" => $key["STP_CODIGO"],
					"STP_DESCRICAO" => $key["STP_DESCRICAO"]
				)
			);
		}
		echo json_encode($arrayData);
	}


	function fetchCatalogoServico()
	{
		$idCatalogo = $this->input->post("CSI_CODIGO");
		$itemCatalogo = $this->epm->fetchCatalogoServico($idCatalogo);
		echo json_encode($itemCatalogo);
	}

	function fetchGestor()
	{
		$data = $this->epm->fetchGestor();
		$arrayData = array();
		foreach ($data as $key) {
			array_push(
				$arrayData,
				$data = array(
				    "CODIGO" => $key["CODIGO"],
                    "COLABORADOR" => $key["COLABORADOR"]
				)
			);
		}
		echo json_encode($arrayData);
	}

	function fetchCliente()
	{
		$data = $this->epm->fetchCliente();
		echo json_encode($data);
	}

	function updateProjeto()
	{
		$PJT_CODIGO = $this->input->post("PJT_CODIGO");
		$PJT_TITULO = $this->input->post("PJT_TITULO");
		$PJT_APELIDO = $this->input->post("PJT_APELIDO");
		$PJT_VhSysCCustoId = $this->input->post("PJT_VhSysCCustoId");
		//echo "vhsys > " . $PJT_VhSysCCustoId;
		$CBR_CODIGO = $this->input->post("CBR_CODIGO");
		// $PJT_TECNOLOGIA = $this->input->post("PJT_TECNOLOGIA");
		$PJT_QTHORA = $this->input->post("PJT_QTHORA");
		$PJT_VRHORA = $this->input->post("PJT_VRHORA");
		$PJT_DATAINICIO = $this->input->post("PJT_DATAINICIO");
		$PJT_DATATERMINO = $this->input->post("PJT_DATATERMINO");
		$CLI_CODIGO = $this->input->post("CLI_CODIGO");
		$PJT_PLACOMUNICACAO = $this->input->post("PJT_PLACOMUNICACAO");		
		$PJT_EscopoDoPlano = $this->input->post("PJT_EscopoDoPlano");
		$PJT_TREINAMENTOEQUIPE = $this->input->post("PJT_TREINAMENTOEQUIPE");
		$PJT_STATUS = $this->input->post("PJT_STATUS");

		$data = array(
			"PJT_CODIGO" => $PJT_CODIGO,
			"PJT_TITULO" => $PJT_TITULO,
			"PJT_APELIDO" => $PJT_APELIDO,
			"PJT_VhSysCCustoId" => $PJT_VhSysCCustoId,
			"CBR_CODIGO" => $CBR_CODIGO,

			// "PJT_TECNOLOGIA" => $PJT_TECNOLOGIA,
			"PJT_QTHORA" => $PJT_QTHORA,
			"PJT_VRHORA" => $PJT_VRHORA,
			"PJT_DATAINICIO" => $PJT_DATAINICIO,
			"PJT_DATATERMINO" => $PJT_DATATERMINO,
			"PJT_TREINAMENTOEQUIPE" => $PJT_TREINAMENTOEQUIPE,
			"PJT_EscopoDoPlano" => $PJT_EscopoDoPlano,
			
			"CLI_CODIGO" => ($CLI_CODIGO == null) ? null : $CLI_CODIGO,

			// "CLI_CODIGO" => $CLI_CODIGO,
			"PJT_STATUS" => $PJT_STATUS,
			"PJT_PLACOMUNICACAO" => $PJT_PLACOMUNICACAO
		);

		echo $this->epm->updateProjeto($data);
	}

	function updateTermosProjeto()
	{
		$PJX_PJTCodigo = $this->input->post("PJX_PJTCodigo");
		$PJX_TextoTermoKickoff = $this->input->post("PJX_TextoTermoKickoff");
		$PJX_TextoTRD = $this->input->post("PJX_TextoTRD");
		$PJX_TextoConfidencialidade = $this->input->post("PJX_TextoConfidencialidade");

		$data = array(
			"PJX_PJTCodigo" => $PJX_PJTCodigo,
			"PJX_TextoTermoKickoff" => $PJX_TextoTermoKickoff,
			"PJX_TextoTRD" => $PJX_TextoTRD,
			"PJX_TextoConfidencialidade" => $PJX_TextoConfidencialidade
		);

		echo $this->epm->updateTermosProjeto($data);
	}

	function updateConfiguracaoDoChamado()
	{
		$PJC_PJTCodigo = $this->input->post("PJC_PJTCodigo");
		$PJC_DescrAcolhimento = $this->input->post("PJC_DescrAcolhimento");
		$PJC_FlgMostraPrazo = $this->input->post("PJC_FlgMostraPrazo");
		$PJC_FlgMostraAvaliacao = $this->input->post("PJC_FlgMostraAvaliacao");
		$PJC_FlgMostraTrd = $this->input->post("PJC_FlgMostraTrd");
		$PJC_FlgMostraDocReferencia = $this->input->post("PJC_FlgMostraDocReferencia");
		$PJC_FlgMostraOrcamento = $this->input->post("PJC_FlgMostraOrcamento");
		$PJC_FlgDisparaEmail = $this->input->post("PJC_FlgDisparaEmail");
		$PJC_FlgRecebeChamado = $this->input->post("PJC_FlgRecebeChamado");
		$PJC_OrcaTermoAceite = $this->input->post("PJC_OrcaTermoAceite");
		$PJC_EntrTermoEntrega = $this->input->post("PJC_EntrTermoEntrega");
		
		$data = array(
			"PJC_PJTCodigo" => $PJC_PJTCodigo,
			"PJC_DescrAcolhimento" => $PJC_DescrAcolhimento,
			"PJC_FlgMostraPrazo" => $PJC_FlgMostraPrazo,
			"PJC_FlgMostraAvaliacao" => $PJC_FlgMostraAvaliacao,
			"PJC_FlgMostraTrd" => $PJC_FlgMostraTrd,
			"PJC_FlgMostraDocReferencia" => $PJC_FlgMostraDocReferencia,
			"PJC_FlgMostraOrcamento" => $PJC_FlgMostraOrcamento,
			"PJC_FlgDisparaEmail" => $PJC_FlgDisparaEmail,
			"PJC_FlgRecebeChamado" => $PJC_FlgRecebeChamado,
			"PJC_OrcaTermoAceite" => $PJC_OrcaTermoAceite,
			"PJC_EntrTermoEntrega" => $PJC_EntrTermoEntrega
		);

		echo $this->epm->updateConfiguracaoDoChamado($data);
	}

	function updateConfiguracaoFinanceira()
	{

		$PJN_PJTCodigo = $this->input->post("PJN_PJTCodigo");
		$PJN_CLPCodigo = $this->input->post("PJN_CLPCodigo") == 0 ? null : $this->input->post("PJN_CLPCodigo");		
		$PJN_TORCodigo = $this->input->post("PJN_TORCodigo");
		$PJN_FechmtoPeriInicio = $this->input->post("PJN_FechmtoPeriInicio");
		$PJN_FechmtoPeriInicioMes = $this->input->post("PJN_FechmtoPeriInicioMes");
		$PJN_FechmtoPeriTermino = $this->input->post("PJN_FechmtoPeriTermino");
		$PJN_FechmtoPeriTerminoMes = $this->input->post("PJN_FechmtoPeriTerminoMes");
		$PJN_FechmtoDiaFechar = $this->input->post("PJN_FechmtoDiaFechar");
		$PJN_PagmntoDiasPrazo = $this->input->post("PJN_PagmntoDiasPrazo");
		$PJN_PropostaCaminho = $this->input->post("PJN_PropostaCaminho");
		$PJN_NotaFsclDescricao = $this->input->post("PJN_NotaFsclDescricao");
		$PJN_IndiceImposto = $this->input->post("PJN_IndiceImposto");
		$PJN_ValorTotal = $this->input->post("PJN_ValorTotal");
		$PJN_CentroCustoCliente = $this->input->post("PJN_CentroCustoCliente");
		$PJN_ObsDoFaturamento = $this->input->post("PJN_ObsDoFaturamento");

	
		$data = array(
			"PJN_PJTCodigo" => $PJN_PJTCodigo,
			"PJN_CLPCodigo" => $PJN_CLPCodigo,
			"PJN_TORCodigo" => $PJN_TORCodigo,			
			"PJN_FechmtoPeriInicio" => $PJN_FechmtoPeriInicio,
			"PJN_FechmtoPeriInicioMes" => $PJN_FechmtoPeriInicioMes,
			"PJN_FechmtoPeriTermino" => $PJN_FechmtoPeriTermino,
			"PJN_FechmtoPeriTerminoMes" => $PJN_FechmtoPeriTerminoMes,
			"PJN_FechmtoDiaFechar" => $PJN_FechmtoDiaFechar,
			"PJN_PagmntoDiasPrazo" => $PJN_PagmntoDiasPrazo,
			"PJN_PropostaCaminho" => $PJN_PropostaCaminho,
			"PJN_NotaFsclDescricao" => $PJN_NotaFsclDescricao,
			"PJN_IndiceImposto" => $PJN_IndiceImposto,
			"PJN_CentroCustoCliente" => $PJN_CentroCustoCliente,
			"PJN_ValorTotal" => $PJN_ValorTotal,
			"PJN_ObsDoFaturamento" => $PJN_ObsDoFaturamento
		);

		echo $this->epm->updateConfiguracaoFinanceira($data);
	}

	function updateFapParcela()
	{
		$arrayFapParcela = $this->input->post("arrayFapParcela");
		$this->epm->updateFapParcela($arrayFapParcela);
	}

	// function newPlanoDados()
	// {
	// 	$arrayPlanoDados = $this->input->post("arrayPlanoDados");
	// 	foreach ($arrayPlanoDados as $key => $value) {
	// 		$this->epm->newPlanoDados($value);
	// 	}
	// 	echo $arrayPlanoDados[0][5];
	// }

	function deletePlanoDados()
	{
		$arrayDeletedPlanoDados = $this->input->post("arrayDeletedPlanoDados");
		$this->epm->deletePlanoDados($arrayDeletedPlanoDados);
	}

	
	function DeletedFapParcela()
	{
		$arrayDeletedFapParcela = $this->input->post("arrayDeletedFapParcela");
		$this->epm->DeletedFapParcela($arrayDeletedFapParcela);
	}

	function updatePlanoDados()
	{
		$arrayPlanoDados = $this->input->post("arrayPlanoDados");
		$this->epm->updatePlanoDados($arrayPlanoDados);
	}

	function deletePlanoComunicacao()
	{
		$arrayDeletedPlanoComunicacao = $this->input->post("arrayDeletedPlanoComunicacao");
		$this->epm->deletePlanoComunicacao($arrayDeletedPlanoComunicacao);
	}

	function updatePlanoComunicacao()
	{
		$arrayPlanoComunicacao = $this->input->post("arrayPlanoComunicacao");
		$this->epm->updatePlanoComunicacao($arrayPlanoComunicacao);
	}





	function deleteANS()
	{
		$arrayDeletedANS = $this->input->post("arrayDeletedANS");
		$this->epm->deleteANS($arrayDeletedANS);
	}

	function updateANS()
	{
		$arrayANS = $this->input->post("arrayANS");
		$this->epm->updateANS($arrayANS);
	}



	function gerarIndicadores()
	{
		$PJM_PJTCodigo = $this->input->post("PJM_PJTCodigo");
		$PJM_Codigo = $this->input->post("PJM_Codigo");
		$CSI_Codigo = $this->input->post("CSI_Codigo");

		$data = array(
			"PJM_PJTCodigo" => $PJM_PJTCodigo,
			"PJM_Codigo" => $PJM_Codigo,
			"CSI_Codigo" => $CSI_Codigo
		);

		echo $this->epm->gerarIndicadores($data);
	}


	function fetchIndicadores()
	{
		$PJM_Codigo = $this->input->post("PJM_Codigo");
		echo $this->epm->fetchIndicadores($PJM_Codigo);
	}



	function updateParecerGQ()
	{
		$PJM_Codigo = $this->input->post("PJM_Codigo");
		$PJM_ParecerGQ = $this->input->post("PJM_ParecerGQ");
		$PJM_ParecerGP = $this->input->post("PJM_ParecerGP");


		$data = array(
			"PJM_Codigo" => $PJM_Codigo,
			"PJM_ParecerGQ" => $PJM_ParecerGQ,
			"PJM_ParecerGP" => $PJM_ParecerGP
		);

		echo $this->epm->updateParecerGQ($data);
	}







	function updateMonitoramento()
	{
		$arrayMonitoramento = $this->input->post("arrayMonitoramento");
		$this->epm->updateMonitoramento($arrayMonitoramento);
	}

	function deleteMonitoramento()
	{
		$arrayDeletedMonitoramento = $this->input->post("arrayDeletedMonitoramento");
		$this->epm->deleteMonitoramento($arrayDeletedMonitoramento);
	}
}
