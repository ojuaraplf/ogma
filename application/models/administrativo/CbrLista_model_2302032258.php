<?php

class CbrLista_model extends CI_Model
{


    public function fetchCbr($pCBRCodigo, $pMostraTudo)
    {
        $pCBRCodigo = $pCBRCodigo == 0 ? NULL : $pCBRCodigo;
        
        $query = $this->db->query("CALL ogrh_CBR_Lista01(?, ?)", array($pCBRCodigo, $pMostraTudo));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchPes()
    {
        $pTipoFouJ = 'F';
        
        $query = $this->db->query("CALL ogma_PES_Selecao02(?)", array($pTipoFouJ));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchSingleColaborador($id)
    {
        $db = $this->load->database('default', true);
        $db->select('*');
        $db->from("ogrh_CBR_Funcionario");

        $db->join('ogma_PES_Pessoa', 'ogma_PES_Pessoa.PES_Codigo = ogrh_CBR_Funcionario.CBR_PESCodigo');

        $db->where("CBR_PESCodigo", $id);
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function fetchogma_PES_Selecao01()
    {
        $query = $this->db->query("CALL ogma_PES_Selecao01(NULL,'CBR')");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function fetchColaborador()
    {
        $query = $this->db->query("CALL ogrh_CBR_Selecao01()");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchogrh_CBU_RemuneraUnidade()
    {
        $query = $this->db->query("CALL ogrh_CBU_Selecao()");
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchogrh_CGO_DescricaoCargo()
    {
        $db = $this->load->database('default', true);
        $db->select('*');
        $db->from("ogrh_CGO_DescricaoCargo");

        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function fetchogma_PES_Pessoa()
    {
        $db = $this->load->database('default', true);
        $db->select('*');
        $db->from("ogma_PES_Pessoa");
        $db->where("PES_TipoFouJ", "J");
        $db->order_by('PES_Nome', 'asc');

        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function updateColaborador($id, $data)
    {
        $this->db->where('CBR_PESCodigo', $id);
        $this->db->update("ogrh_CBR_Funcionario", $data);
        return true;
    }

    public function updateEmailColaborador($id, $PES_ContEmail)
    {
        $this->db->set('PES_ContEmail', $PES_ContEmail);
        $this->db->where('PES_Codigo', $id);
        $this->db->update("ogma_PES_Pessoa");
        return true;
    }

    public function InsertCbr($data)
    {
        $this->db->insert("ogrh_CBR_Funcionario", $data);
        return true;
    }

    public function salvarPesNovo($data)
    {
        $this->db->insert("ogma_PES_Pessoa", $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
}
