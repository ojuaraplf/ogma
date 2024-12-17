<?php

class Defaults_model extends CI_Model {
  



  public function novaInteracao($data) {
    
    $this->db->insert("ogsv_CHI_ChamadoInteracao", $data);
    $insert_id = $this->db->insert_id();


    return $insert_id;
    


  }















  public function fetchTipoMudancaCorrecao() {
		$this->db->select('*');
		$query = $this->db->get('ogsv_MUT_TipoMudancaCorrecao');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
  }

  public function fetch_ogsv_TLG_Tecnologia() {
		$this->db->select('*');
		$query = $this->db->get('ogsv_TLG_Tecnologia');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
  }




  public function fetch_ogm_catalogoservicoitem() {
		$this->db->select('*');
		$query = $this->db->get('ogm_catalogoservicoitem');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
  }
  public function fetch_ogsv_CIL_ItemCatalogoLabel() {
		$this->db->select('*');
		$query = $this->db->get('ogsv_CIL_ItemCatalogoLabel');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
  }
  public function fetchClasseAtividade() {
		$this->db->select('*');
		$query = $this->db->get('ogsv_ATC_ClasseAtividade');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
  }

	public function fetchFamiliaAtividade() {
    $this->db->select('*');
    $this->db->order_by("ATF_FlgDeExecucao", "ASC");
		$query = $this->db->get('ogsv_ATF_FamiliaAtividade');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
  }
 
  public function fetchColaboradores() {
		$this->db->select('a001_cd_usuario, a001_nm_usuario');
		$this->db->where('a001_ind_desat', 0);
		$this->db->order_by('a001_nm_usuario DESC');
		$query = $this->db->get('t001_usuario');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
  }
	public function fetchCargos() {
		$this->db->select('CGO_Codigo, CGO_Titulo');
		//		$this->db->where('a001_ind_desat', 0);
		//		$this->db->order_by('a001_nm_usuario DESC');
		$query = $this->db->get('ogrh_CGO_DescricaoCargo');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
  public function fetchContatoDetalhe() {
		$this->db->select('*');
		$this->db->order_by('a006_nm_contato DESC');
		$query = $this->db->get('ogm_vw_contatodetalhe');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

















  //CHAMADO
  public function fetchStatusChamado() {
    $this->db->order_by("STC_Codigo", "ASC");
    $query = $this->db->get('ogsv_STC_StatusChamado');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchPrioridadeChamado() {
    $this->db->order_by("CHP_Codigo", "ASC");
    $query = $this->db->get('ogsv_CHP_PrioridadeChamado');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchCategoriaChamado() {
    $this->db->order_by("CHC_Codigo", "ASC");
    $query = $this->db->get('ogsv_CHC_CategoriaChamado');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }



  public function fetchRevisaoChecklist() {
    $this->db->select('*');
    $this->db->where('POP_ProcedOrdem', '00.00');

//    $this->db->order_by('a006_nm_contato DESC');
    $query = $this->db->get('ogma_POP_PocedimentoOperacional');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }





  public function fetchCBRFase($PJF_CODIGO) {
    $this->db->select('*');
    $this->db->where('PJF_CODIGO', $PJF_CODIGO);
//    $this->db->order_by('a006_nm_contato DESC');
    $query = $this->db->get('ogm_vw_equipealocadafase');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }















  
  public function updateChamado($data) {

    if ($data["CHD_Codigo"] == "") {
      $this->db->insert("ogsv_CHD_Chamado", $data);
      $insert_id = $this->db->insert_id();
//      $this->db->query('call CriaProxOrdemATG(' . $data["CHD_PJFCodigo"] . ', "' . $data["CHD_Descricao"] . '", ' . $insert_id . ', "' . $data["CHD_MomAbertura"] . '", 5, @projAceita);');
      return $insert_id;
    } else {
      $this->db->where('CHD_Codigo', $data["CHD_Codigo"]);
      $this->db->update("ogsv_CHD_Chamado", $data);
      return $data["CHD_Codigo"];
    }


  }

  function updateChecklist($data) {
    foreach ($data as $key => $value) {
      $arrayChecklist = array(
        'CKL_CheckFeito' => $value[1]);
      $this->db->where('CKL_Codigo', $value[0]);
      $this->db->update("ogma_CKL_CheckListProcedimento", $arrayChecklist);

    }
  }





  public function fetchCheckList($CKL_ProcedCodigoAcro, $CKL_CGOCodigo, $CKL_ProcedCodigo) {
    $this->db->query("call CriaTemplateCKM('". $CKL_ProcedCodigoAcro ."', ". $CKL_ProcedCodigo .", ". $CKL_CGOCodigo .", @res);");
    $conn = $this->db->conn_id;
    do {
      if ($result = mysqli_store_result($conn)) {
        mysqli_free_result($result);
      }
    } while (mysqli_more_results($conn) && mysqli_next_result($conn));

    $sql = 'SELECT @res as res;';
    $res = $this->db->query($sql)->row()->res;

    $this->db->where('CKL_CodigoProcedimento', $res);
    $this->db->order_by('CKL_ProcedOrdem ASC');
    $query = $this->db->get('ogma_CKL_CheckListProcedimento');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }



  public function fetchChecklistDescricao($data) {
    $arrayProcedimento = array();
    foreach ($data as $key => $value) {
      $result = $this->db->query("select TrazDescrPOP('" . $value[0] . "', '". $value[1] ."') as result;")->row()->result;
      $arrayProcedimento[$value[0]] = $result;
    }
    return $arrayProcedimento;
  }


  public function fetchRevisaoMonitoramentoUsuarioQtdade($CBR_CODIGO) {
    $db = $this->db->select('count(distinct(PJM_CODIGO)) as qtdade');
    $db->from("ogvw_revisaomonitoramentogp");
    $db->where("PEQ_CODCBR", $CBR_CODIGO);
    $db->where("PEQ_CODCARGO", 6);
    $db->where("PJM_mMomentoDaRevisao is NOT NULL", NULL, FALSE);
    $db->where("PJM_FlgRevisaoConcluida", 0);
    $query = $db->get();

    return $query->row()->qtdade;

  }







































  public function fetchFasesDetalhes() {
    $this->db->select('PJF_CODIGO, PJT_APELIDO, PJT_CODIGO, CSI_CODIGO, PJF_ORDEMFASE, CSI_CODIGO, CSI_SERVTITULO, CSI_SERVDESCRICAO, CSI_FlgCHDgeraATG');
    $this->db->where("CSI_FlgCHDgeraATG", 1);
    $this->db->where("STP_FlgProjetoAtivo", 1);
    $query = $this->db->get('ogm_vw_projetofasedetalhes');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }


}