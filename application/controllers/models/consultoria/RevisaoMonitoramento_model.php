<?php

class RevisaoMonitoramento_model extends CI_Model {


//  public function fetchApontamentoHoras($CBR_CODIGO, $LCT_DATAINCIAL, $LCT_DATAFINAL, $PJT_CODIGO) {
//
//    $db = $this->load->database('default', TRUE);
//    $db->select('*');
//    $db->from("ogm_vw_lancamentohorasdetalhe");
//    $db->where("CBR_CODIGO", $CBR_CODIGO);
//
//    $db->where("LCT_DATA >=", $LCT_DATAINCIAL);
//    $db->where("LCT_DATA <=", $LCT_DATAFINAL);
//
//
//    if ($PJT_CODIGO != null) {
//      $db->where("PJT_CODIGO", $PJT_CODIGO);
//    }
//
//    $db->order_by("LCT_DATA", "ASC");
//    $db->order_by("LCT_HORAINICIO", "DESC");
//    $query = $db->get();
//
//    if ($query->num_rows() > 0) {
//      return $query->result_array();
//    } else {
//      return array();
//    }
//  }

//
//  public function fetchProjetos($CBR_CODIGO) {
//
//    $db = $this->load->database('default', TRUE);
//    $db->select('PJT_CODIGO, PJT_APELIDO');
//    $db->from("ogm_vw_lancamentohorasdetalhe");
//    $db->where("CBR_CODIGO", $CBR_CODIGO);
//
//    $db->group_by("PJT_CODIGO");
//
//    $query = $db->get();
//
//    if ($query->num_rows() > 0) {
//      return $query->result_array();
//    } else {
//      return array();
//    }
//  }
//

  public function fetchRevisaoUsuario($CBR_CODIGO) {
    $db = $this->load->database('default', TRUE);
    $db->from("ogvw_revisaomonitoramentogp");
    $db->where("PEQ_CODCBR", $CBR_CODIGO);
    $db->where("PEQ_CODCARGO", 6);
    $db->where("PJM_mMomentoDaRevisao is NOT NULL", NULL, FALSE);
    $db->group_by("PJM_CODIGO");
    $db->order_by('PJM_FlgRevisaoConcluida');
    $query = $db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchIndicadores($PJM_Codigo) {
    $res = $this->db->query('select TrazTextoRMonit(' . $PJM_Codigo . ' ) as result;');
    return $res->row()->result;

  }

  public function concluirRevisao($PJM_CODIGO) {
    $this->db->set('PJM_FlgRevisaoConcluida', 1);
    $this->db->where('PJM_CODIGO', $PJM_CODIGO);

    $this->db->update("ogsv_PJM_MonitoramentoProjeto");
    return true;

  }
//  public function updateLancamentoHora($data) {
//    $this->db->where('LCT_CODIGO', $data["LCT_CODIGO"]);
//    $this->db->update("ogm_lancamentohoras", $data);
//    return true;
//
//  }
//
//  public function removerLancamentoHora($data) {
//    $this->db->where('LCT_CODIGO', $data["LCT_CODIGO"]);
//    $this->db->delete("ogm_lancamentohoras");
//    return true;
//
//  }




}
