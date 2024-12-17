<?php

class EmailFaturamento_model extends CI_Model
{
    public function fetchColaborador($LCT_DATA)
    {
        $query = $this->db->query("CALL ogrh_CBR_Selecao02x(?)", array($LCT_DATA));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}