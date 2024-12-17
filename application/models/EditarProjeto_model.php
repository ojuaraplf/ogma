<?php

class EditarProjeto_model extends CI_Model
{


  function fetchDocumentLink($PJD_Codigo)
  {
    $this->db->select('PJD_DocumLink');
    $this->db->where('PJD_Codigo', $PJD_Codigo);
    $query = $this->db->get('PJD_DocumentoProjeto');
    if ($query->num_rows() > 0) {
      return $query->row()->PJD_DocumLink;
    } else {
      return false;
    }
  }


  function uploadFile($data)
  {
    print_r($data);
    echo $data["PJD_PJTCodigo"];
    $this->db->insert("PJD_DocumentoProjeto", $data);
    $insert_id = $this->db->insert_id();
    echo $insert_id;
  }



  public function fetchDocumentos($PJD_PJTCodigo)
  {
    $this->db->where('PJD_PJTCodigo', $PJD_PJTCodigo);
    $query = $this->db->get('PJD_DocumentoProjeto');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchProject($idProjeto)
  {
    $this->db->select('*');
    $this->db->where('PJT_CODIGO', $idProjeto);
    $query = $this->db->get('ogm_projeto');
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

  public function fetchTipoOrcamento()
  {
    $query = $this->db->get('ogsv_TOR_TipoOrcamento');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }


  public function fetchStatusChamado()
  {
    $this->db->order_by("STC_Codigo", "DESC");
    $query = $this->db->get('ogsv_STC_StatusChamado');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchCategoriaChamado()
  {
    $this->db->order_by("CHC_Codigo", "DESC");
    $query = $this->db->get('ogsv_CHC_CategoriaChamado');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchPrioridadeChamado()
  {
    $this->db->order_by("CHP_Codigo", "DESC");
    $query = $this->db->get('ogsv_CHP_PrioridadeChamado');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchANS($idProjeto)
  {
    $this->db->where('PJA_PJTCodigo', $idProjeto);
    $query = $this->db->get('ogsv_PJA_ANSProjeto');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchTermosProjeto($idProjeto)
  {
    $this->db->where('PJX_PJTCodigo', $idProjeto);
    $query = $this->db->get('ogsv_PJX_TermosProjeto');

    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return array();
    }
  }

  public function fetchConfiguracaoDoChamado($idProjeto)
  {
    $this->db->where('PJC_PJTCodigo', $idProjeto);
    $query = $this->db->get('ogsv_PJC_ConfChamados');

    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return array();
    }
  }

  public function fetchPlanoDados($idProjeto)
  {
    $this->db->select('*');
    $this->db->where('PJT_CODIGO', $idProjeto);
    $query = $this->db->get('ogm_projetoplanodados');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }
  public function fetchPlanoComunicacao($idProjeto)
  {
    $this->db->select('*');
    $this->db->where('PLC_PJTCodigo', $idProjeto);
    $query = $this->db->get('ogsv_PLC_PlanoComunicacao');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchMonitoramento($idProjeto)
  {
    $this->db->select('*');
    $this->db->where('PJM_PJTCodigo', $idProjeto);
    $query = $this->db->get('ogvw_monitoramentodetalhes');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchEspecieRevisao()
  {
    // $this->db->order_by("STP_CODIGO", "DESC");
    $query = $this->db->get('ogsv_ERM_EpecieRevisaoMonitoramento');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchStatusProjeto()
  {
    $this->db->order_by("STP_CODIGO", "DESC");
    $query = $this->db->get('ogsv_STP_StatusProjeto');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchCatalogoServico($idCatalogo)
  {
    $this->db->select('*');
    $this->db->where('CSI_CODIGO', $idCatalogo);
    $query = $this->db->get('ogm_catalogoservicoitem');
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

  // PRÉ-FATURAMENTO *27/08/2021**************************************
  // Busca Parâmetros do Financeiro do Plano de Serviço 
  public function fetchogsv_PJN_ConfFinanceiro($pPJTCodigo)
  {
    $this->db->select('*');
    $this->db->where('PJN_PJTCodigo', $pPJTCodigo);
    $query = $this->db->get('ogsv_PJN_ConfFinanceiro');
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

  // Busca Parcelas da pré-fatura do Plano de Serviço
  public function fetchogfn_PJE_ParceFatuProjeto($pPJT)
  {
    $this->db->select('*');
    $this->db->where('PJE_PJTCodigo', $pPJT);
    $query = $this->db->get('ogfn_PJE_ParceFatuProjeto');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  public function fetchogco_CLP_Selecao01_DoClienteDoPPx( $pPJT )
  {
      $query = $this->db->query("CALL ogco_CLP_Selecao01_DoClienteDoPPx(?)", array( $pPJT == "0" ? NULL : $pPJT));
      $this->db->close();
      if ($query->num_rows() > 0) {
          return $query->result_array();
      } else {
          return array();
      }
  }

// Salva Parâmetros do Financeiro do Plano de Serviço
  // public function updateogsv_PJN_ConfFinanceiro($data)
  // {
  //   $this->db->replace("ogsv_PJN_ConfFinanceiro", $data);
  //   return true;
  // }

  // Salva Parcelas da pré-fatura do Plano de Serviço
  // public function updateogfn_PJE_ParceFatuProjeto($data)
  // {
  //   $this->db->where('PJE_PJTCodigo', $data["PJE_PJTCodigo"]);
  //   $this->db->update("ogfn_PJE_ParceFatuProjeto", $data);
  //   return true;
  // }

  public function updateConfiguracaoFinanceira($data)
  {
    $this->db->replace("ogsv_PJN_ConfFinanceiro", $data);
    return true;
  }

// *********************************************************************

  public function updateProjeto($data)
  {
    $this->db->where('PJT_CODIGO', $data["PJT_CODIGO"]);
    $this->db->update("ogm_projeto", $data);
    return true;
  }

  public function updateTermosProjeto($data)
  {
    $this->db->where('PJX_PJTCodigo', $data["PJX_PJTCodigo"]);
    $this->db->update("ogsv_PJX_TermosProjeto", $data);
    return true;
  }

  public function updateConfiguracaoDoChamado($data)
  {
    // $this->db->where('PJC_PJTCodigo', $data["PJC_PJTCodigo"]);
    $this->db->replace("ogsv_PJC_ConfChamados", $data);
    return true;
  }

  public function updateParecerGQ($data)
  {
    $this->db->where('PJM_Codigo', $data["PJM_Codigo"]);
    $this->db->update("ogsv_PJM_MonitoramentoProjeto", $data);
    return true;
  }

  public function fetchGestor()
  {
    $query = $this->db->query('call ogrh_CBR_Selecao01();');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  public function fetchCliente()
  {
    $query = $this->db->query('call ogco_CLI_Selecao01(0);');
      
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  // function newPlanoDados($data)
  // {
  //   $arrayPlano = array(
  //     'PLD_ARTEFATO' => $data[0],
  //     'PLD_ARMAZENAMENTO' => $data[1],
  //     'PLD_RESPONSAVEL' => $data[2],
  //     'PLD_ACESSO' => $data[3],
  //     'PLD_DISTRIBUICAO' => $data[4],
  //     'PJT_CODIGO' => $data[5]
  //   );
  //   $this->db->insert("ogm_projetoplanodados", $arrayPlano);
  // }

  function deleteANS($data)
  {
    foreach ($data as $key => $value) {
      $this->db->where('PJA_Codigo', $value);
      $this->db->delete('ogsv_PJA_ANSProjeto');
    }
  }

  function deletePlanoDados($data)
  {
    foreach ($data as $key => $value) {
      $this->db->where('PLD_CODIGO', $value);
      $this->db->delete('ogm_projetoplanodados');
    }
  }

  function DeletedFapParcela($data)
  {
    foreach ($data as $key => $value) {
      $this->db->where('PJE_Codigo', $value);
      $this->db->delete('ogfn_PJE_ParceFatuProjeto');
    }
  }
  
  function deletePlanoComunicacao($data)
  {
    foreach ($data as $key => $value) {
      $this->db->where('PLC_Codigo', $value);
      $this->db->delete('ogsv_PLC_PlanoComunicacao');
    }
  }

  function updateANS($data)
  {
    foreach ($data as $key => $value) {
      if ($value[0] == null) {
        $arrayANS = array(
          'PJA_STCCodigo' => $value[1],
          'PJA_CHCCodigo' => $value[2],
          'PJA_CHPCodigo' => $value[3],
          'PJA_QtHoras' => $value[4],
          'PJA_PJTCodigo' => $value[5]
        );
        $this->db->insert("ogsv_PJA_ANSProjeto", $arrayANS);
      } else {
        $arrayANS = array(
          'PJA_STCCodigo' => $value[1],
          'PJA_CHCCodigo' => $value[2],
          'PJA_CHPCodigo' => $value[3],
          'PJA_QtHoras' => $value[4]
        );
        $this->db->where('PJA_Codigo', $value[0]);
        $this->db->update("ogsv_PJA_ANSProjeto", $arrayANS);
      }
    }
  }


  function updatePlanoComunicacao($data)
  {
    // arrayPlanoComunicacao.push([PLC_Codigo, PLC_Evento, PLC_Responsavel, PLC_Interessado, PLC_Quando, PLC_FomaComunicacao, PLC_PJTCodigo]);
    foreach ($data as $key => $value) {
      if ($value[0] == null) {
        $arrayPlanoDeComunicacao = array(
          'PLC_Evento' => $value[1],
          'PLC_Responsavel' => $value[2],
          'PLC_Interessado' => $value[3],
          'PLC_Quando' => $value[4],
          'PLC_FomaComunicacao' => $value[5],
          'PLC_PJTCodigo' => $value[6]
        );
        $this->db->insert("ogsv_PLC_PlanoComunicacao", $arrayPlanoDeComunicacao);
      } else {
        $arrayPlanoDeComunicacao = array(
          'PLC_Evento' => $value[1],
          'PLC_Responsavel' => $value[2],
          'PLC_Interessado' => $value[3],
          'PLC_Quando' => $value[4],
          'PLC_FomaComunicacao' => $value[5]
        );
        $this->db->where('PLC_Codigo', $value[0]);
        $this->db->update("ogsv_PLC_PlanoComunicacao", $arrayPlanoDeComunicacao);
      }
    }
  }


  function updatePlanoDados($data)
  {
    foreach ($data as $key => $value) {
      if ($value[0] == null) {
        $arrayPlanoDeDados = array(
          'PLD_ARTEFATO' => $value[1],
          'PLD_ARMAZENAMENTO' => $value[2],
          'PLD_RESPONSAVEL' => $value[3],
          'PLD_ACESSO' => $value[4],
          'PLD_DISTRIBUICAO' => $value[5],
          'PJT_CODIGO' => $value[6]
        );
        $this->db->insert("ogm_projetoplanodados", $arrayPlanoDeDados);
      } else {
        $arrayPlanoDeDados = array(
          'PLD_ARTEFATO' => $value[1],
          'PLD_ARMAZENAMENTO' => $value[2],
          'PLD_RESPONSAVEL' => $value[3],
          'PLD_ACESSO' => $value[4],
          'PLD_DISTRIBUICAO' => $value[4]
        );
        $this->db->where('PLD_CODIGO', $value[0]);
        $this->db->update("ogm_projetoplanodados", $arrayPlanoDeDados);
      }
    }
  }

  function updateFapParcela($data)
  {
    foreach ($data as $key => $value) {
      if ($value[0] == null) {
        $arrayFapParcela = array(
          'PJE_ParcelaOrdem' => $value[1],
          'PJE_ParcelaValor' => $value[2],
          'PJE_ParcelaVencimento' => $value[3],
          'PJE_PJTCodigo' => $value[4]
        );
        $this->db->insert("ogfn_PJE_ParceFatuProjeto", $arrayFapParcela);
      } else {
        $arrayFapParcela = array(
          'PJE_ParcelaOrdem' => $value[1],
          'PJE_ParcelaValor' => $value[2],
          'PJE_ParcelaVencimento' => $value[3]
        );
        $this->db->where('PJE_Codigo', $value[0]);
        $this->db->update("ogfn_PJE_ParceFatuProjeto", $arrayFapParcela);
      }
    }
  }

  public function gerarIndicadores($data)
  {

    $this->db->query('call CriaIndMonitIRM_12(' . $data["PJM_PJTCodigo"] . ', ' . $data["CSI_Codigo"] . ', ' . $data["PJM_Codigo"] . ', @res);');

    $conn = $this->db->conn_id;

    do {
      if ($result = mysqli_store_result($conn)) {
        mysqli_free_result($result);
      }
    } while (mysqli_more_results($conn) && mysqli_next_result($conn));

    $sql = 'SELECT @res as res;';
    $res = $this->db->query($sql);


    return $res->row()->res;
  }
  public function fetchIndicadores($PJM_Codigo)
  {
    $res = $this->db->query('select TrazTextoRMonit(' . $PJM_Codigo . ' ) as result;');
    return $res->row()->result;
  }








  function updateMonitoramento($data)
  {
    foreach ($data as $key => $value) {
      if ($value[4] == null) {
        $arrayMonitoramento = array(
          'PJM_PJTCodigo' => $value[0],
          'PJM_DataDaAgendaRevisao' => $value[1],
          'PJM_ERMCodigo' => $value[2],
          'PJM_mDescricaoDaRevisao' => $value[3]
        );
        $this->db->insert("ogsv_PJM_MonitoramentoProjeto", $arrayMonitoramento);
      } else {
        $arrayMonitoramento = array(
          'PJM_PJTCodigo' => $value[0],
          'PJM_DataDaAgendaRevisao' => $value[1],
          'PJM_ERMCodigo' => $value[2],
          'PJM_mDescricaoDaRevisao' => $value[3]
        );
        $this->db->where('PJM_Codigo', $value[4]);
        $this->db->update("ogsv_PJM_MonitoramentoProjeto", $arrayMonitoramento);
      }
    }
  }

  function deleteMonitoramento($data)
  {
    foreach ($data as $key => $value) {
      $this->db->where('PJM_Codigo', $value);
      $this->db->delete('ogsv_PJM_MonitoramentoProjeto');
    }
  }
}
