<?php

class CliLista_model extends CI_Model {

    public function Fetchogco_CLI_Selecao01( $pMostraTudo )
    {
        $query = $this->db->query("CALL ogco_CLI_Selecao01(?)", array( $pMostraTudo == NULL ? "1" : $pMostraTudo));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchEditaCli($id)
    {
        $db = $this->load->database('default', true);
        $db->select('*');
        $db->from("ogco_CLI_Cliente");
        $db->join('ogma_PES_Pessoa', 'ogma_PES_Pessoa.PES_Codigo = ogco_CLI_Cliente.CLI_PESCodigo');
        $db->where("CLI_PESCodigo", $id);

        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function UpdateCliEdita($id, $data)
    {
        $this->db->where('CLI_PESCodigo', $id);
        $this->db->update("ogco_CLI_Cliente", $data);
        return true;
    }

    public function fetchogma_PES_Selecao01( $FouJ, $CliTipo)
    {
        $query = $this->db->query("CALL ogma_PES_Selecao01(?,?)", array( $FouJ, $CliTipo ));
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function FechCLP_Selecao02_DoCliente($pCLI)
    {
        $query = $this->db->query("CALL ogco_CLP_Selecao02_DoCliente(?)", array( $pCLI == "0" ? NULL : $pCLI) );
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function DeletedCliPessoa($data)
    {
      foreach ($data as $key => $value) {
        $this->db->where('CLP_Codigo', $value);
        $this->db->delete('ogco_CLP_ClientePessoas');
      }
    }

    function updateCliPessoa($data)
    {
      foreach ($data as $key => $value) {
        if ($value[0] == null) {
          $arrayCliPessoa = array(
            'CLP_PESCodigo' => $value[1],
            'CLP_Cargo' => $value[2],
            'CLP_CLICodigo' => $value[3]
          );
          $this->db->insert("ogco_CLP_ClientePessoas", $arrayCliPessoa);
        } else {
          $arrayCliPessoa = array(
            'CLP_PESCodigo' => $value[1],
            'CLP_Cargo' => $value[2]
          );
          $this->db->where('CLP_Codigo', $value[0]);
          $this->db->update("ogco_CLP_ClientePessoas", $arrayCliPessoa);
        }
      }
    }

    public function salvarCliNovo($data)
    {
        $this->db->insert("ogco_CLI_Cliente", $data);
        return true;
    }

    public function salvarClpNovo($data)
    {        
        print_r($data);
        $this->db->insert("ogco_CLP_ClientePessoas", $data);
        return true;
    }

    public function salvarPesNovo($data)
    {
        $this->db->insert("ogma_PES_Pessoa", $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

}