<?php
class ListaObjeto_model extends CI_Model
{

    public function fetchOBJETO()
    {
        $db = $this->load->database('map', TRUE);
        $db->order_by("CHV_OBJETO", "DESC");
        $query = $db->get('OBJETO_DETALHES');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}
