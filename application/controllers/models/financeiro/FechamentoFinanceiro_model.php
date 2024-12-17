<?php

class FechamentoFinanceiro_model extends CI_Model {






  public function fetchLancamentoHoras($data) {

    $db = $this->load->database('default', TRUE);
    $db->select('LCT_CODIGO, LCT_DATA, LCT_TEMPO, a001_nm_usuario, LCT_DESCRICAO');
    $db->from("ogm_vw_lancamentohorasdetalhe");

    $db->where("LCT_DATA >=", $data["LCT_DATAINICIAL"]);
    $db->where("LCT_DATA <=", $data["LCT_DATAFINAL"]);


    $db->order_by("LCT_DATA", "ASC");
    $db->order_by("LCT_HORAINICIO", "DESC");

    $query = $db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }


  public function fetchPendenciaFinanceira($data) {

    $db = $this->load->database('default', TRUE);
    $db->select('*');
    $db->from("ogfn_PEF_PendenciasFinanceiras");

    $db->where("PEF_DataGerada >=", $data["PEF_DataGeradaINICIAL"]);
    $db->where("PEF_DataGerada <=", $data["PEF_DataGeradaFINAL"]);


    $db->order_by("PEF_DataGerada", "ASC");
    $query = $db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

}