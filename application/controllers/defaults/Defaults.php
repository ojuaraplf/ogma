<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Defaults extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model("defaults/defaults_model", 'dm');
  }


  public function novaInteracao()
  {
      
    //   echo "AQUIIII KKKKK";
      
    date_default_timezone_set('America/Sao_Paulo');
    $data['CHD_MomAbertura'] = date_create()->format('Y-m-d H:i:s');
    $CHI_CHPCodigo = $this->input->post("CHD_CHPCodigo");
    $CHI_CHCCodigo = $this->input->post("CHD_CHCCodigo");
    $CHI_STCCodigo = $this->input->post("CHD_STCCodigo"); 
    $CHI_CBRCodigo = $this->input->post("CHD_CBRCodigo");
    $CHI_PFR_Codigo = $this->input->post("CHD_PFR_Codigo");
    $CHI_TextoSolicitacao = $this->input->post("CHI_TextoSolicitacao");
    // echo 'kkkk';
    // echo 'printing var' . empty($CHI_TextoSolicitacao) ? NULL : $CHI_TextoSolicitacao . 'eeee';
    // echo empty($CHI_TextoSolicitacao) ? NULL : $CHI_TextoSolicitacao;
    // echo 'hehehe';
    $CHI_USUCodigo = $this->input->post("CHI_USUCodigo");
    $CHI_CHDCodigo = $this->input->post("CHI_CHDCodigo");
    $CHI_MomentoInteracao = date_create()->format('Y-m-d H:i:s');
    $CHI_QtHora = $this->input->post("CHI_QtHora");


    $data = array(
      "CHI_CHPCodigo" => $CHI_CHPCodigo,
      "CHI_CHCCodigo" => $CHI_CHCCodigo,
      "CHI_STCCodigo" => $CHI_STCCodigo,
      "CHI_CBRCodigo" => $CHI_CBRCodigo,
      "CHI_PFR_Codigo" => $CHI_PFR_Codigo,
      "CHI_TextoSolicitacao" => empty($CHI_TextoSolicitacao) ? NULL : $CHI_TextoSolicitacao,
      "CHI_USUCodigo" => $CHI_USUCodigo,
      "CHI_CHDCodigo" => $CHI_CHDCodigo,
      "CHI_QtHora" => $CHI_QtHora,
      "CHI_MomentoInteracao" => $CHI_MomentoInteracao
    );
    echo $this->dm->novaInteracao($data);
  }






  function fetch_ogsv_TLG_Tecnologia()
  {
    $data = $this->dm->fetch_ogsv_TLG_Tecnologia();
    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "TLG_CODIGO" => $key["TLG_CODIGO"],
          "TLG_DESCRICAO" => $key["TLG_DESCRICAO"]
        )
      );
    }
    echo json_encode($arrayData);
  }
  function fetch_ogm_catalogoservicoitem()
  {
    $data = $this->dm->fetch_ogm_catalogoservicoitem();
    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "CSI_CODIGO" => $key["CSI_CODIGO"],
          "CSI_SERVTITULO" => $key["CSI_SERVTITULO"],
          "CSI_AcronimoPlanoServico" => $key["CSI_AcronimoPlanoServico"],
          "CSI_SERVSUBTITULO" => $key["CSI_SERVSUBTITULO"],
          "CSI_SERVDESCRICAO" => $key["CSI_SERVDESCRICAO"],
          "CSI_FlgCHDgeraATG" => $key["CSI_FlgCHDgeraATG"],
          "CSI_DESATIVADO" => $key["CSI_DESATIVADO"]
        )
      );
    }
    echo json_encode($arrayData);
  }
  function fetch_ogsv_CIL_ItemCatalogoLabel()
  {
    $data = $this->dm->fetch_ogsv_CIL_ItemCatalogoLabel();
    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "CIL_CSICodigo" => $key["CIL_CSICodigo"],
          "CIL_ProjAcronimo" => $key["CIL_ProjAcronimo"],
          "CIL_ProjDescricao" => $key["CIL_ProjDescricao"],
          "CIL_ShowDescricao" => $key["CIL_ShowDescricao"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  function fetchTipoMudancaCorrecao()
  {
    $data = $this->dm->fetchTipoMudancaCorrecao();
    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "MUT_Codigo" => $key["MUT_Codigo"],
          "MUT_Descricao" => $key["MUT_Descricao"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  function fetchClasseAtividade()
  {
    $data = $this->dm->fetchClasseAtividade();
    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "ATC_Codigo" => $key["ATC_Codigo"],
          "ATC_Descricao" => $key["ATC_Descricao"]
        )
      );
    }
    echo json_encode($arrayData);
  }



  function fetchContatoDetalhe()
  {
    $data = $this->dm->fetchContatoDetalhe();
    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "a004_cd_cliente" => $key["a004_cd_cliente"],
          "a006_cd_contato" => $key["a006_cd_contato"],
          "a008_cargo" => $key["a008_cargo"],
          "a004_razao_social" => $key["a004_razao_social"],
          "a006_nm_contato" => $key["a006_nm_contato"]
        )
      );
    }
    echo json_encode($arrayData);
  }


  function fetchCargos()
  {

    $data = $this->dm->fetchCargos();
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

  public function fetchFamiliaAtividade()
  {

    $data = $this->dm->fetchFamiliaAtividade();
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "ATF_Codigo" => $key["ATF_Codigo"],
          "ATF_Descricao" => $key["ATF_Descricao"],
          "ATF_FlgAssocianteMuc" => $key["ATF_FlgAssocianteMuc"],
          "ATF_FlgRequerChamado" => $key["ATF_FlgRequerChamado"]
        )
      );
    }
    echo json_encode($arrayData);
  }






  //CHAMADO
  public function fetchStatusChamado()
  {
    $data = $this->dm->fetchStatusChamado();
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
  public function fetchPrioridadeChamado()
  {
    $data = $this->dm->fetchPrioridadeChamado();
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

  public function fetchCategoriaChamado()
  {
    $data = $this->dm->fetchCategoriaChamado();
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

  function fetchColaboradores()
  {

    $data = $this->dm->fetchColaboradores();
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

  function fetchogma_PES_Selecao02()
  {

    $data = $this->dm->fetchogma_PES_Selecao02();
    // $arrayData = array();

    // foreach ($data as $key) {
    //   array_push(
    //     $arrayData,
    //     $data = array(
    //       "CODIGO" => $key["CODIGO"],
    //       "COLABORADOR" => $key["COLABORADOR"]
    //     )
    //   );
    // }
    echo json_encode($data);
  }


  function fetchRevisaoChecklist()
  {
    $data = $this->dm->fetchRevisaoChecklist();
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "POP_Codigo" => $key["POP_Codigo"],
          "POP_ProcedCodigo" => $key["POP_ProcedCodigo"],
          //        "POP_ProcedOrdem" => $key["POP_ProcedOrdem"],
          "POP_ProcedDescricao" => $key["POP_ProcedDescricao"]
        )
        //        "POP_ProcedExplicacao" => $key["POP_ProcedExplicacao"],
        //        "POP_OGCCodigo" => $key["POP_OGCCodigo"],
        //        "POP_CGOCodigo" => $key["POP_CGOCodigo"],
        //        "POP_ProxOrdemSim" => $key["POP_ProxOrdemSim"],
        //        "POP_ProxOrdemNao" => $key["POP_ProxOrdemNao"],
        //        "POP_FlgParaCheckList" => $key["POP_FlgParaCheckList"])
      );
    }
    echo json_encode($arrayData);
  }






  function fetchFasesDetalhes()
  {
    $data = $this->dm->fetchFasesDetalhes();
    $arrayData = array();

    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "PJF_CODIGO" => $key["PJF_CODIGO"],
          "PJT_CODIGO" => $key["PJT_CODIGO"],
          "PJF_ORDEMFASE" => $key["PJF_ORDEMFASE"],
          "PJT_APELIDO" => $key["PJT_APELIDO"],
          "CSI_CODIGO" => $key["CSI_CODIGO"],
          "CSI_SERVTITULO" => $key["CSI_SERVTITULO"],
          "CSI_SERVDESCRICAO" => $key["CSI_SERVDESCRICAO"],
          "CSI_FlgCHDgeraATG" => $key["CSI_FlgCHDgeraATG"]
        )
      );
    }
    echo json_encode($arrayData);
  }

  public function updateChamado()
  {
    $CHD_Codigo = $this->input->post("CHD_Codigo");
    $CHD_Descricao = $this->input->post("CHD_Descricao");
    $CHD_PJFCodigo = $this->input->post("CHD_PJFCodigo");
    $CHD_MomAbertura = $this->input->post("CHD_MomAbertura");
    $CHD_CHPCodigo = $this->input->post("CHD_CHPCodigo");
    $CHD_CHCCodigo = $this->input->post("CHD_CHCCodigo");
    $CHD_STCCodigo = $this->input->post("CHD_STCCodigo");
    $CHD_TextoSolicitacao = $this->input->post("CHD_TextoSolicitacao");
    $CHD_PFR_Codigo = $this->input->post("CHD_PFR_Codigo");
    $CHD_MomNovoStatus = $this->input->post("CHD_MomNovoStatus");
    $CHD_MomAprvcao = $this->input->post("CHD_MomAprvcao");
    $CHD_CBRCodigo = $this->input->post("CHD_CBRCodigo");
    $CHD_QtHora = $this->input->post("CHD_QtHora");
    $CHD_USUCodigo = $this->input->post("CHD_USUCodigo");
    //    $CHD_AvalGrauSatisfacao = $this->input->post("CHD_AvalGrauSatisfacao");
    //    $CHD_AvalParecer = $this->input->post("CHD_AvalParecer");
    $CHD_CHDCodigoAssociado = $this->input->post("CHD_CHDCodigoAssociado");
    $data = array(
      "CHD_Codigo" => $CHD_Codigo,
      "CHD_Descricao" => $CHD_Descricao,
      "CHD_PJFCodigo" => $CHD_PJFCodigo,
      "CHD_MomAbertura" => $CHD_MomAbertura,
      "CHD_CHPCodigo" => $CHD_CHPCodigo,
      "CHD_CHCCodigo" => $CHD_CHCCodigo,
      "CHD_STCCodigo" => $CHD_STCCodigo,
      "CHD_TextoSolicitacao" => $CHD_TextoSolicitacao,
      "CHD_PFR_Codigo" => $CHD_PFR_Codigo,
      "CHD_QtHora" => $CHD_QtHora,
      "CHD_MomNovoStatus" => $CHD_MomNovoStatus == '' ? null : $CHD_MomNovoStatus,
      "CHD_MomAprvcao" => $CHD_MomAprvcao == ''? null: $CHD_MomAprvcao,
      "CHD_CBRCodigo" => $CHD_CBRCodigo,
      "CHD_USUCodigo" => $CHD_USUCodigo,
      //      "CHD_AvalGrauSatisfacao" => $CHD_AvalGrauSatisfacao,
      //      "CHD_AvalParecer" => $CHD_AvalParecer,
      "CHD_CHDCodigoAssociado" => $CHD_CHDCodigoAssociado
    );

    echo $this->dm->updateChamado($data);
  }

  function fetchChecklistDescricao()
  {
    $arrayProcedimento = $this->input->post("arrayProcedimento");
    $data = $this->dm->fetchChecklistDescricao($arrayProcedimento);
    echo json_encode($data);
  }




  public function fetchRevisaoMonitoramentoUsuarioQtdade()
  {
    $CBR_CODIGO = $this->input->post("CBR_CODIGO");
    $data = $this->dm->fetchRevisaoMonitoramentoUsuarioQtdade($CBR_CODIGO);
    echo $data;
  }



  public function fetchCBRFase()
  {
    $PJF_CODIGO = $this->input->post("PJF_CODIGO");
    $data = $this->dm->fetchCBRFase($PJF_CODIGO);
    echo json_encode($data);
  }

  public function fetchGrupoAtividadeFase()
  {
    $PJF_CODIGO = $this->input->post("PJF_CODIGO");
    $data = $this->dm->fetchGrupoAtividadeFase($PJF_CODIGO);
    echo json_encode($data);
  }





































  function updateChecklist()
  {
    $arrayChecklist = $this->input->post("arrayChecklist");
    $this->dm->updateChecklist($arrayChecklist);
  }




  public function fetchCheckList()
  {
    $CKL_ProcedCodigoAcro = $this->input->post("CKL_ProcedCodigoAcro");
    $CKL_CGOCodigo = $this->input->post("CKL_CGOCodigo");
    $CKL_ProcedCodigo = $this->input->post("CKL_ProcedCodigo");

    $data = $this->dm->fetchCheckList($CKL_ProcedCodigoAcro, $CKL_CGOCodigo, $CKL_ProcedCodigo);

    $arrayData = array();
    foreach ($data as $key) {
      array_push(
        $arrayData,
        $data = array(
          "CKL_Codigo" => $key["CKL_Codigo"],
          "CKL_ProcedCodigo" => $key["CKL_ProcedCodigo"],
          "CKL_ProcedOrdem" => $key["CKL_ProcedOrdem"],
          "CKL_ProcedDescricao" => $key["CKL_ProcedDescricao"],
          "CKL_CGOCodigo" => $key["CKL_CGOCodigo"],
          "CKL_ProxOrdemSim" => $key["CKL_ProxOrdemSim"],
          "CKL_ProxOrdemNao" => $key["CKL_ProxOrdemNao"],
          "CKL_CodigoProcedimento" => $key["CKL_CodigoProcedimento"],
          "CKL_ProcedExplicacao" => $key["CKL_ProcedExplicacao"],
          "CKL_CheckFeito" => $key["CKL_CheckFeito"]
        )
      );
    }
    echo json_encode($arrayData);
  }
}
