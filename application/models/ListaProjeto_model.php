<?php

class ListaProjeto_model extends CI_Model {

  public function fetchProjects() {
    $this->db->order_by("PJT_CODIGO", "ASC");
    $query = $this->db->get('ogm_vw_projetodetalhe');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function fetchStatusProjeto() {
    $this->db->order_by("STP_CODIGO", "DESC");
    $query = $this->db->get('ogsv_STP_StatusProjeto');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }


  public function fetchCatalogoServico() {
    $this->db->select('CSI_CODIGO, CSI_SERVTITULO, CSI_FlgGeraPJAAutomatica, CSI_FlgGeraPLDAutomatica, CSI_AcronimoPlanoServico');
    $this->db->where('CSI_DESATIVADO', 0);
    $query = $this->db->get('ogm_catalogoservicoitem');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }


  public function newProjeto($data, $dataFase) {

    $dbQueryTreinamento = $this->db->query('SELECT TPT_TextoNecessidadeTreinamento FROM ogsv_TPT_TemplateTextos WHERE TPT_CSICodigo = ' . $data["PJT_ITEMCAS"] . ';');

    $this->db->insert("ogm_projeto", $data);
    $insert_id = $this->db->insert_id();

    // $dataFase["PJT_CODIGO"] = $insert_id;
    // $this->db->insert("ogm_projetofase", $dataFase);

    $this->db->where('PJT_CODIGO', $insert_id);
    $this->db->set("PJT_APELIDO", str_pad($insert_id, 4, '0', STR_PAD_LEFT) . ' ' . $data["PJT_APELIDO"] . ' ');
    $this->db->set("PJT_TREINAMENTOEQUIPE", $dbQueryTreinamento->row()->TPT_TextoNecessidadeTreinamento);
    $this->db->update("ogm_projeto");

    return $insert_id;
  }


  public function fetchLastRevisaoCatalago() {
    return $last_row = $this->db->select('*')->order_by('CAS_CODIGO', "desc")->limit(1)->get('ogm_catalogoservico')->row()->CAS_CODIGO;
  }


  function insertTemplatePlanoDeDados($data) {
    $this->db->query('call CriaTemplatePLD(' . $data["PJT_CODIGO"] . ', ' . $data["CSI_CODIGO"] . ' );');
  }


  function insertTemplateANS($data) {
    $this->db->query('call CriaTemplateANS(' . $data . ');');

  }

  function insertTemplateChecklist($data) {
    $this->db->query('call CriaTemplateCKM(' . $data . ');');

  }

}


