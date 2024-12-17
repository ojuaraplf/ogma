<?php

class Exportarvhsys_model extends CI_Model
{
    public function fetchFechamentoMes($FMC_Mes)
    {
        //$FMC_Mes = $this->input->post('mesano');

        $db = $this->load->database('default', TRUE);
        $db->select('*');
        $db->from("ogvw_ogfn_FMC_FechamentoMes");
        $db->where('FMC_Mes = ', $FMC_Mes);
        $db->order_by("PES_Nome DESC", "PJT_APELIDO");

        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchFechamentoMesEstat($FMC_Mes)
    {
        $db = $this->load->database('default', TRUE);
        $db->select('*');
        $db->from("ogvw_ogfn_FMC_FechamentoMesEstat");
        $db->where('FMC_Mes = ', $FMC_Mes);

        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }    

    public function sendToContaspagar($FMC_Mes)
    {
 
        $db = $this->load->database('default', TRUE);

        $db->select('*');
        $db->from("ogvw_ogfn_FMC_FechamentoMes");
        $db->where('FMC_Mes = ', $FMC_Mes);
        $db->where('FMC_CBRCodigo = 79');
        $db->where("CBR_VhSysClienteId > ", '0');
        $db->where("PJT_VhSysCCustoId > ", '0');
        $db->where("FMC_VhSysLancamentoId =", NULL);
        $db->order_by("PES_Nome DESC", "PJT_APELIDO");

        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }

    }

    public function atualizaFechamentoMes($id, $data)
    {
        $this->db->where('FMC_Codigo', $id);
        $this->db->update("ogfn_FMC_FechamentoMesConsultor", $data);
        return true;
    }


    public function deleteContaspagarVHSys($FMC_Codigos)
    {
 
        $codigos = explode(",",$FMC_Codigos);
        
        $db = $this->load->database('default', TRUE);
        $db->select('*');
        $db->from("ogvw_ogfn_FMC_FechamentoMes");
        $db->where_in("FMC_Codigo", $codigos );

        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
      }

    }

    public function updateContaspagarOgma($id)
    {
        $this->db->set('FMC_VhSysLancamentoId', null);
        $this->db->where('FMC_Codigo', $id);
        $this->db->update('ogfn_FMC_FechamentoMesConsultor');
    }    
    
}
