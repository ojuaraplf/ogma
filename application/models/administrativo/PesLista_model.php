<?php

class PesLista_model extends CI_Model {

  public function Fetch_PES_Pessoa() {
    $this->db->order_by("PES_TipoFouJ,PES_Nome", "DESC");
    $this->db->where('USU_MomDesativado', NULL);
    $this->db->where('CLI_MomDesativa', NULL);
    $this->db->where('CBR_MomDesativa', NULL);
    $this->db->where('PES_MomDesativa', NULL);
    $this->db->join('ogma_USU_Usuario', 'ogma_USU_Usuario.USU_PESCodigo = ogma_PES_Pessoa.PES_Codigo', 'left');
    $this->db->join('ogco_CLI_Cliente', 'ogco_CLI_Cliente.CLI_PESCodigo = ogma_PES_Pessoa.PES_Codigo', 'left');
    $this->db->join('ogrh_CBR_Funcionario', 'ogrh_CBR_Funcionario.CBR_PESCodigo = ogma_PES_Pessoa.PES_Codigo', 'left');
    $this->db->join('ogco_CLP_ClientePessoas', 'ogco_CLP_ClientePessoas.CLP_PESCodigo = ogma_PES_Pessoa.PES_Codigo', 'left');
    
    $query = $this->db->get('ogma_PES_Pessoa');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function updatePesEdita($id, $data)
  {
      $this->db->where('PES_Codigo', $id);
      $this->db->update("ogma_PES_Pessoa", $data);
      return true;
  }

  public function salvarPesNovo($data)
  {
      $this->db->insert("ogma_PES_Pessoa", $data);
      return true;
  }

  public function fetchSinglePesEdita($id)
  {
      $db = $this->load->database('default', true);
      $db->select('*');
      $db->from("ogma_PES_Pessoa");

      $db->where("PES_Codigo", $id);
      $query = $db->get();
      if ($query->num_rows() > 0) {
          return $query->row();
      } else {
          return false;
      }
  }


}


