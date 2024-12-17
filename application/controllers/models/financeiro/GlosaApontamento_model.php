<?php
class GlosaApontamento_model extends CI_Model {


  public function fetchApontamentoHoras($data) {

    $db = $this->load->database('default', TRUE);
    $db->select('*');
    $db->from("ogm_lancamentohoras");

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

  public function fetchCurrentUser($a001_cd_usuario) {

    $db = $this->load->database('default', TRUE);
    $db->select('a001_cd_usuario, a001_nm_usuario');
    $db->from("t001_usuario");

    $db->where("a001_cd_usuario", $a001_cd_usuario);

    $query = $db->get();

    return $query->row();
//    if ($query->num_rows() > 0) {
////      return $query->result_array();
////    } else {
////      return array();
////    }
///
///
  }
  public function updateLancamentoHora($data) {
    $this->db->where('LCT_CODIGO', $data["LCT_CODIGO"]);
    $this->db->update("ogm_lancamentohoras", $data);
    return true;

  }






}