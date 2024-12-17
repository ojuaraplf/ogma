<?php

class RelatorioAtividadesPendentes_model extends CI_Model {


  public function fetchAtividadesPendentes($CBR_CODIGO) {

    $db = $this->load->database('default', TRUE);
    $db->select('*');
    $db->from("ogvw_atividadealocadacolaborador");
    $db->where("AEA_CBRCODIGO", $CBR_CODIGO);
    // $db->where("STP_FlgProjetoAtivo", 1);
    // $db->where("ATG_FlgConcluida", 0);
    // $db->where("STC_FlgChamadoAtivo", 1);
    // $db->where("CSI_FlgControlaPrazoANS", 1);



  //  $db->where_not_in("PJT_STATUS", array(21, 24, 25));
  //  $db->where_not_in("CHD_STCCodigo", array(24, 25));

    $db->order_by("ATG_FlgPrioridadeEstrategica DESC, PJT_FlgAnsContratada DESC, ANS ASC"); 
//    $db->order_by("HORASAGORAPARAVENCIMENTO", "DESC");
    $query = $db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }


  }
//
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
//
//  public function fetchTotalHoras($CBR_CODIGO, $LCT_DATAINCIAL, $LCT_DATAFINAL, $PJT_CODIGO) {
//
//
//    $db = $this->load->database('default', TRUE);
//    $db->select_sum('LCT_TEMPO');
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
//    $query = $db->get();
//    return $query->row();
//
//  }
//
//
//
//
//
//
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
