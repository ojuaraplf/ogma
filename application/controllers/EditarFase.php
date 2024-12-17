<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditarFase extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model("editarFase_model", 'efm');
  }


  public function index()
  {
    $this->load->view('servico/EditarFase');
  }

  function fetchProjeto()
  {
    $idProjeto = $this->input->post("PJT_CODIGO");
    $projeto = $this->efm->fetchProjeto($idProjeto);
    echo json_encode($projeto);
  }


  public function fetchFase()
  {
    $idFase = $this->input->post("PJF_CODIGO");
    $fase = $this->efm->fetchFase($idFase);
    echo json_encode($fase);
  }

	public function fetchAtgItemGrande()
	{
	  $idFase = $this->input->post("PJF_CODIGO");
	  $data = $this->efm->fetchAtgItemGrande($idFase);
	  echo json_encode($data);
	}

  public function fetchEquipeFase()
  {
    $idFase = $this->input->post("PJF_CODIGO");

    $data = $this->efm->fetchEquipeFase($idFase);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "PEQ_CODIGO" => $key["PEQ_CODIGO"],
          "PEQ_CODCBR" => $key["PEQ_CODCBR"],
          "PEQ_CODCARGO" => $key["PEQ_CODCARGO"],
          "PJF_CODIGO" => $key["PJF_CODIGO"],
          "PEQ_MomIniAtuacao" => $key["PEQ_MomIniAtuacao"],
          "PEQ_MomFimAtuacao" => $key["PEQ_MomFimAtuacao"]     
        )
      );
    }
    echo json_encode($arrayData);
  }
  
  public function fetchFamiliaAtividade()
  {

    $data = $this->efm->fetchFamiliaAtividade();
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "ATF_Codigo" => $key["ATF_Codigo"],
          "ATF_Descricao" => $key["ATF_Descricao"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  public function fetchAtividadesFase()
  {
    $idFase = $this->input->post("PJF_CODIGO");

    $data = $this->efm->fetchAtividadesFase($idFase);
    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "ATG_CODIGO" => $key["ATG_CODIGO"],
          "ATG_ORDEM" => $key["ATG_ORDEM"],
          "ATG_DESCRICAO" => $key["ATG_DESCRICAO"],
          "ATG_QTHORA" => $key["ATG_QTHORA"],
          "ATG_ISENTA" => $key["ATG_ISENTA"],
          "ATG_ATFCodigo" => $key["ATG_ATFCodigo"],
          "ATG_ATCCodigo" => $key["ATG_ATCCodigo"],
          "ATG_CBRCodigo" => $key["ATG_CBRCodigo"],
          "ATG_FlgConcluida" => $key["ATG_FlgConcluida"],
          "ATG_DetalheDescritivo" => $key["ATG_DetalheDescritivo"],
          "HLATIVIDADE" => $key["HLATIVIDADE"],
          "ATG_PORCENTAGEMAPRONTADA" => $key["ATG_PORCENTAGEMAPRONTADA"],
          "ATG_MomInicExecucaoInformado" => $key["ATG_MomInicExecucaoInformado"],
          "ATG_MomFinalExecucaoInformado" => $key["ATG_MomFinalExecucaoInformado"],
          "ATG_FlgPrioridadeEstrategica" => $key["ATG_FlgPrioridadeEstrategica"],
          "ATG_FlgAtividadeAuditoriaRealizada" => $key["ATG_FlgAtividadeAuditoriaRealizada"],
          "ATG_TemMucante" => $key["ATG_TemMucante"],
          "ATF_FlgDeExecucao" => $key["ATF_FlgDeExecucao"],
          "ATF_FlgAssocianteMuc" => $key["ATF_FlgAssocianteMuc"],
          "PJF_CODIGO" => $key["PJF_CODIGO"]
        )
      );
    }
    echo json_encode($arrayData);
  }


  public function fetchDependenciaEResponsaveis()
  {
    $idFase = $this->input->post("PJF_CODIGO");

    $data = $this->efm->fetchDependenciaEResponsaveis($idFase);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "DEP_CODIGO" => $key["DEP_CODIGO"],
          "DEP_DESCRICAO" => $key["DEP_DESCRICAO"],
          "DEP_CLICOD" => $key["DEP_CLICOD"],
          "DEP_DATALIMITE" => $key["DEP_DATALIMITE"],
          "PJF_CODIGO" => $key["PJF_CODIGO"]
        )
      );
    }
    echo json_encode($arrayData);
  }


  public function fetchFornecedorRequisitoFase()
  {
    $idFase = $this->input->post("PJF_CODIGO");

    $data = $this->efm->fetchFornecedorRequisitoFase($idFase);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "PFR_CODIGO" => $key["PFR_CODIGO"],
          "PFR_PESCodigo" => $key["PFR_PESCodigo"],
          "PFR_EMPRESA" => $key["PFR_EMPRESA"],
          "PFR_FUNCAO" => $key["PFR_FUNCAO"],
          "PJF_CODIGO" => $key["PJF_CODIGO"],
          "PRF_FlgRecebeEmail" => $key["PRF_FlgRecebeEmail"],
          "PRF_FlgPessoaFocal" => $key["PRF_FlgPessoaFocal"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  public function fetch_ogsv_PJL_TecnologiaFase()
  {
    $idFase = $this->input->post("PJF_CODIGO");

    $data = $this->efm->fetch_ogsv_PJL_TecnologiaFase($idFase);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "PJL_PJFCodigo" => $key["PJL_PJFCodigo"],
          "PJL_TLGCodigo" => $key["PJL_TLGCodigo"]

        )
      );
    }
    echo json_encode($arrayData);
  }

  function updateAtividadesAssociadas()
  {
    $arrayAtividadesAssociadas = $this->input->post("arrayAtividadesAssociadas");
    $AMC_ATGMucanteCod = $this->input->post("AMC_ATGMucanteCod");
    $this->efm->updateAtividadesAssociadas($AMC_ATGMucanteCod, $arrayAtividadesAssociadas);
  }




  function updateRiscos()
  {
    $arrayRiscos = $this->input->post("arrayRiscos");
    $this->efm->updateRiscos($arrayRiscos);
  }


  public function fetchAtividadesAssociadas()
  {

    $AMC_ATGMucanteCod = $this->input->post("AMC_ATGMucanteCod");

    $data = $this->efm->fetchAtividadesAssociadas($AMC_ATGMucanteCod);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "AMC_ATGMucanteCod" => $key["AMC_ATGMucanteCod"],
          "AMC_ATGMucadaCod" => $key["AMC_ATGMucadaCod"],
          "AMC_MUTCodigo" => $key["AMC_MUTCodigo"]
        )
      );
    }
    echo json_encode($arrayData);
  }




  public function fetchRiscoFase()
  {

    $idFase = $this->input->post("PJF_CODIGO");

    $data = $this->efm->fetchRiscoFase($idFase);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "PFR_Codigo" => $key["PFR_Codigo"],
          "PFR_DescricaoRisco" => $key["PFR_DescricaoRisco"],
          "PFR_Probabilidade" => $key["PFR_Probabilidade"],
          "PFR_Impacto" => $key["PFR_Impacto"],
          "PFR_Exposicao" => $key["PFR_Exposicao"],
          "PFR_PJFCodigo" => $key["PFR_PJFCodigo"],
          "PFR_MedidaMitigacao" => $key["PFR_MedidaMitigacao"],
          "PFR_GRICodigo" => $key["PFR_GRICodigo"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  function deleteRiscos()
  {
    $arrayDeletedRiscos = $this->input->post("arrayDeletedRiscos");
    $this->efm->deleteRiscos($arrayDeletedRiscos);
  }







  function fetchCatalogoServicoItemDetalhes()
  {
    $idProjeto = $this->input->post("PJT_CODIGO");
    $projeto = $this->efm->fetchCatalogoServicoItemDetalhes($idProjeto);
    echo json_encode($projeto);
  }







  public function updateFase()
  {
    $PJF_CODIGO = $this->input->post("PJF_CODIGO");
    $PJF_IDENTIFICACAOFASE = $this->input->post("PJF_IDENTIFICACAOFASE");
    $PJF_DATAINICIO = $this->input->post("PJF_DATAINICIO");
    $PJF_DATATERMINO = $this->input->post("PJF_DATATERMINO");
    $PJF_QTHORA = $this->input->post("PJF_QTHORA");
    $PJF_RECURSOSMATERIAIS = $this->input->post("PJF_RECURSOSMATERIAIS");

    $PJF_CODFOCALCLI = $this->input->post("PJF_CODFOCALCLI");
    $PJF_FUNCAOFOCAL = $this->input->post("PJF_FUNCAOFOCAL");
    $PJF_CONTATOHOMOLOGENTREGA = $this->input->post("PJF_CONTATOHOMOLOGENTREGA");
    $PJF_FUNCCONTATOHOMOLOG = $this->input->post("PJF_FUNCCONTATOHOMOLOG");

    $PJF_ESCOPO = $this->input->post("PJF_ESCOPO");
    $PJF_ESCOPONEGATIVO = $this->input->post("PJF_ESCOPONEGATIVO");
    $PJF_REQUISITOS = $this->input->post("PJF_REQUISITOS");
    $PJF_ENTREGAFASE = $this->input->post("PJF_ENTREGAFASE");
    $PJF_ItemWbsParaChamados = $this->input->post("PJF_ItemWbsParaChamados");
    // $PJF_PRIVACIDADE = $this->input->post("PJF_PRIVACIDADE");


    $data = array(
      "PJF_CODIGO" => $PJF_CODIGO,
      "PJF_IDENTIFICACAOFASE" => $PJF_IDENTIFICACAOFASE,
      "PJF_DATAINICIO" => $PJF_DATAINICIO,
      "PJF_DATATERMINO" => $PJF_DATATERMINO,
      "PJF_QTHORA" => $PJF_QTHORA,
      "PJF_RECURSOSMATERIAIS" => $PJF_RECURSOSMATERIAIS,
      "PJF_CODFOCALCLI" => $PJF_CODFOCALCLI,
      "PJF_FUNCAOFOCAL" => $PJF_FUNCAOFOCAL,
      "PJF_CONTATOHOMOLOGENTREGA" => $PJF_CONTATOHOMOLOGENTREGA,
      "PJF_FUNCCONTATOHOMOLOG" => $PJF_FUNCCONTATOHOMOLOG,
      "PJF_ESCOPO" => $PJF_ESCOPO,
      "PJF_ESCOPONEGATIVO" => $PJF_ESCOPONEGATIVO,
      "PJF_REQUISITOS" => $PJF_REQUISITOS,
      "PJF_ENTREGAFASE" => $PJF_ENTREGAFASE,
      "PJF_ItemWbsParaChamados" => $PJF_ItemWbsParaChamados
      // "PJF_PRIVACIDADE" => $PJF_PRIVACIDADE
    );

    echo $this->efm->updateFase($data);
  }
  public function updateRiscoDetalhes()
  {
    $PFR_Codigo = $this->input->post("PFR_Codigo");
    $PFR_MedidaMitigacao = $this->input->post("PFR_MedidaMitigacao");

    $data = array(
      "PFR_Codigo" => $PFR_Codigo,
      "PFR_MedidaMitigacao" => $PFR_MedidaMitigacao
    );

    echo $this->efm->updateRiscoDetalhes($data);
  }

  function fetchColaboradores()
  {

    $data = $this->efm->fetchColaboradores();
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
  function fetchCargos()
  {

    $data = $this->efm->fetchCargos();
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "CGO_Codigo" => $key["CGO_Codigo"],
          "CGO_Titulo" => $key["CGO_Titulo"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  function updateEquipe()
  {

    $arrayEquipe = $this->input->post("arrayEquipe");

    $this->efm->updateEquipe($arrayEquipe);
  }


  public function saveGrupoAtividadesDetalhes()
  {

    $ATG_CODIGO = $this->input->post("ATG_CODIGO");
    $ATG_ISENTA = $this->input->post("ATG_ISENTA");
    $ATG_ATFCodigo = $this->input->post("ATG_ATFCodigo");
    $ATG_CBRCodigo = $this->input->post("ATG_CBRCodigo");
    $ATG_QTHORA = $this->input->post("ATG_QTHORA");
    $ATG_MomInicExecucaoInformado = $this->input->post("ATG_MomInicExecucaoInformado");
    $ATG_MomFinalExecucaoInformado = $this->input->post("ATG_MomFinalExecucaoInformado");
    $ATG_FlgPrioridadeEstrategica = $this->input->post("ATG_FlgPrioridadeEstrategica");
    $ATG_FlgTemporaria = $this->input->post("ATG_FlgTemporaria");
    $ATG_FlgConcluida = $this->input->post("ATG_FlgConcluida");
    $ATG_DetalheDescritivo = $this->input->post("ATG_DetalheDescritivo");
    
    $data = array(
      "ATG_CODIGO" => $ATG_CODIGO,
      "ATG_ISENTA" => $ATG_ISENTA,
      "ATG_ATFCodigo" => $ATG_ATFCodigo == 0 ? null : $ATG_ATFCodigo,
      "ATG_CBRCodigo" => $ATG_CBRCodigo,
      "ATG_QTHORA" => $ATG_QTHORA,
      "ATG_MomInicExecucaoInformado" => $ATG_MomInicExecucaoInformado,
      "ATG_MomFinalExecucaoInformado" => $ATG_MomFinalExecucaoInformado,
      "ATG_FlgPrioridadeEstrategica" => $ATG_FlgPrioridadeEstrategica,
      "ATG_FlgTemporaria" => $ATG_FlgTemporaria,      
      "ATG_FlgConcluida" => $ATG_FlgConcluida,
      "ATG_DetalheDescritivo" => $ATG_DetalheDescritivo
      
    );

    echo $this->efm->saveGrupoAtividadesDetalhes($data);
  }

  function fetchTotalHorasApontadas()
  {
    $PJF_CODIGO = $this->input->post("PJF_CODIGO");
    echo $this->efm->fetchTotalHorasApontadas($PJF_CODIGO);
  }

  public function fetchEquipeAlocadaAtividade()
  {
    $idAtividade = $this->input->post("ATG_CODIGO");

    $data = $this->efm->fetchEquipeAlocadaAtividade($idAtividade);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "AEA_CODIGO" => $key["AEA_CODIGO"],
          "AEA_CBRCODIGO" => $key["AEA_CBRCODIGO"],
          "ATG_CODIGO" => $key["ATG_CODIGO"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  public function fetchGrupoAtividadesDetalhes()
  {

    $idAtividade = $this->input->post("ATG_CODIGO");
    $atividade = $this->efm->fetchGrupoAtividadesDetalhes($idAtividade);
    echo json_encode($atividade);


    // $data = $this->efm->fetchGrupoAtividadesDetalhes($idAtividade);
    // $arrayData = array();

    // foreach ($data as $key){
    //   array_push($arrayData, $data = array(
    // 							"ATG_CODIGO" => $key["ATG_CODIGO"],
    // 							"ATG_ISENTA" => $key["ATG_ISENTA"],
    // 							"ATG_EXECUCAO" => $key["ATG_EXECUCAO"])
    // 	);
    // }
    // echo json_encode($arrayData);
  }


  function saveEquipeAlocada()
  {
    $arrayEquipeAlocada = $this->input->post("arrayEquipeAlocada");
    $ATG_CODIGO = $this->input->post("ATG_CODIGO");
    $this->efm->saveEquipeAlocada($arrayEquipeAlocada, $ATG_CODIGO);
  }


  function deleteAtividades()
  {
    $deletedAtividades = $this->input->post("deletedAtividades");
    $this->efm->deleteAtividades($deletedAtividades);
  }

  function deleteDetalhesAtividades()
  {
    $arrayToDelete = $this->input->post("arrayToDelete");
    $this->efm->deleteDetalhesAtividades($arrayToDelete);
  }

  function updateAtividades()
  {
    $arrayAtividades = $this->input->post("arrayAtividades");
    echo $this->efm->updateAtividades($arrayAtividades);
  }


  public function fetchEquipeFaseAlocada()
  {
    $idFase = $this->input->post("PJF_CODIGO");

    $data = $this->efm->fetchEquipeFaseAlocada($idFase);
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "PEQ_CODIGO" => $key["PEQ_CODIGO"],
          "PEQ_CODCBR" => $key["PEQ_CODCBR"],
          "PEQ_CODCARGO" => $key["PEQ_CODCARGO"],
          "PJF_CODIGO" => $key["PJF_CODIGO"],
          "COLABORADOR" => $key["COLABORADOR"]
        )
      );
    }
    echo json_encode($arrayData);
  }


  function updateDependenciaEResponsaveis()
  {
    $arrayDependenciaEResponsaveis = $this->input->post("arrayDependenciaEResponsaveis");
    $this->efm->updateDependenciaEResponsaveis($arrayDependenciaEResponsaveis);
  }


  function updateFornecedorRequisito()
  {
    $arrayToInsertPFR =  $this->input->post("arrayToInsertPFR");
    $arrayToUpdatePFR =  $this->input->post("arrayToUpdatePFR");
    $arrayToDeletePFR =  $this->input->post("arrayToDeletePFR");

    $this->efm->updateFornecedorRequisito($arrayToInsertPFR, $arrayToUpdatePFR, $arrayToDeletePFR);
  }

  function updateTecnologias()
  {

    $arrayTecnologias = $this->input->post("arrayTecnologias");
    $PJL_PJFCodigo = $this->input->post("PJL_PJFCodigo");

    $this->efm->updateTecnologias($arrayTecnologias, $PJL_PJFCodigo);
  }


  public function newFase()
  {
    $PJF_ORDEMFASE = $this->input->post("PJF_ORDEMFASE");
    $PJF_IDENTIFICACAOFASE = $this->input->post("PJF_IDENTIFICACAOFASE");

    $data = array(
      "PJF_ORDEMFASE" => $PJF_ORDEMFASE,
      "PJF_IDENTIFICACAOFASE" => $PJF_IDENTIFICACAOFASE
    );
    $this->efm->newFase($data);
  }
















































  // public function newFase() {
  // 	$PJF_ORDEMFASE = $this->input->post("PJF_ORDEMFASE");
  // 	$PJF_IDENTIFICACAOFASE = $this->input->post("PJF_IDENTIFICACAOFASE");
  // 	$PJF_DATAINICIO = $this->input->post("PJF_DATAINICIO");
  // 	$PJF_DATATERMINO = $this->input->post("PJF_DATATERMINO");
  // 	$PJF_QTHORA = $this->input->post("PJF_QTHORA");
  // 	$PJF_RECURSOSMATERIAIS = $this->input->post("PJF_RECURSOSMATERIAIS");

  // 	$PJF_CODFOCALCLI = $this->input->post("PJF_CODFOCALCLI");
  // 	$PJF_FUNCAOFOCAL = $this->input->post("PJF_FUNCAOFOCAL");
  // 	$PJF_CONTATOHOMOLOGENTREGA = $this->input->post("PJF_CONTATOHOMOLOGENTREGA");
  // 	$PJF_FUNCCONTATOHOMOLOG = $this->input->post("PJF_FUNCCONTATOHOMOLOG");

  // 	$PJF_ESCOPO = $this->input->post("PJF_ESCOPO");
  // 	$PJF_ESCOPONEGATIVO = $this->input->post("PJF_ESCOPONEGATIVO");
  // 	$PJF_REQUISITOS = $this->input->post("PJF_REQUISITOS");


  // 	$PJT_CODIGO = $this->input->post("PJT_CODIGO");


  // 	$data = array(
  // 			"PJF_ORDEMFASE" => $PJF_ORDEMFASE,
  // 			"PJF_IDENTIFICACAOFASE" => $PJF_IDENTIFICACAOFASE,
  // 			"PJF_DATAINICIO" => $PJF_DATAINICIO,
  // 			"PJF_DATATERMINO" => $PJF_DATATERMINO,
  // 			"PJF_QTHORA" => $PJF_QTHORA,
  // 			"PJF_RECURSOSMATERIAIS" => $PJF_RECURSOSMATERIAIS,
  // 			"PJF_CODFOCALCLI" => $PJF_CODFOCALCLI,
  // 			"PJF_FUNCAOFOCAL" => $PJF_FUNCAOFOCAL,
  // 			"PJF_CONTATOHOMOLOGENTREGA" => $PJF_CONTATOHOMOLOGENTREGA,
  // 			"PJF_FUNCCONTATOHOMOLOG" => $PJF_FUNCCONTATOHOMOLOG,
  // 			"PJF_ESCOPO" => $PJF_ESCOPO,
  // 			"PJF_ESCOPONEGATIVO" => $PJF_ESCOPONEGATIVO,
  // 			"PJF_REQUISITOS" => $PJF_REQUISITOS,
  // 			"PJT_CODIGO" => $PJT_CODIGO

  // 		);


  // 	$this->aefm->newFase($data);


  // }

  function fetchNumberFasesFromProject()
  {
    $idProjeto = $this->input->post("PJT_CODIGO");
    $this->efm->fetchNumberFasesFromProject($idProjeto);
  }

























  // function fetchContato() {
  // 	// echo "string";
  // 	$data = $this->aefm->fetchContato();
  // 	$arrayData = array();

  // 	foreach ($data as $key){
  // 	  array_push($arrayData, $data = array(
  // 								"a006_cd_contato" => $key["a006_cd_contato"],
  // 								"a006_nm_contato" => $key["a006_nm_contato"])
  // 		);
  // 	}
  // 	echo json_encode($arrayData);
  // }


  function newDependenciaEResponsaveis()
  {


    $arrayDependenciaEResponsaveis = $this->input->post("arrayDependenciaEResponsaveis");
    foreach ($arrayDependenciaEResponsaveis as $key => $value) {
      $this->efm->newDependenciaEResponsaveis($value);
    }
    echo $arrayDependenciaEResponsaveis[0][3];
  }


  function newFornecedorRequisito()
  {

    $arrayFornecedorRequisito = $this->input->post("arrayFornecedorRequisito");
    foreach ($arrayFornecedorRequisito as $key => $value) {
      $this->efm->newFornecedorRequisito($value);
    }
    echo $arrayFornecedorRequisito[0][4];
  }
}
