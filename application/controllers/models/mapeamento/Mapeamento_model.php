<?php
class Mapeamento_model extends CI_Model
{


    public function fetchPJT_CODIGO($PJF_CODIGO)
    {
        $db = $this->load->database('default', TRUE);
        $db->select('PJT_CODIGO, PJF_CODIGO, PJF_IDENTIFICACAOFASE');
        $db->where("PJF_CODIGO", $PJF_CODIGO);
        $db->from("ogm_projetofase");
        $query = $db->get();


        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }



    public function fetchogm_projeto()
    {
        $db = $this->load->database('default', TRUE);
        $db->select('PJT_CODIGO, PJT_TITULO');
        $db->from("ogm_projeto");
        $db->order_by("PJT_TITULO");
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchogm_projetofase($PJT_CODIGO)
    {
        $db = $this->load->database('default', TRUE);
        $db->select('PJF_CODIGO, PJF_IDENTIFICACAOFASE');
        $db->where("PJT_CODIGO", $PJT_CODIGO);
        $db->from("ogm_projetofase");
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    public function updateIMPLANTACAO($data)
    {

        $db = $this->load->database('map', TRUE);
        $db->where('CHV_IMPLANTACAO', $data['CHV_IMPLANTACAO']);
        $q = $db->get('IMPLANTACAO');
        if ($q->num_rows() > 0) {
            $db->where('CHV_IMPLANTACAO', $data['CHV_IMPLANTACAO']);
            $db->update('IMPLANTACAO', $data);
        } else {
            $db->set('CHV_IMPLANTACAO', $data['CHV_IMPLANTACAO']);
            $db->insert('IMPLANTACAO', $data);
        }
        return true;












        $db = $this->load->database('map', TRUE);
        $db->insert('IMPLANTACAO', $data);
        return true;
    }


    public function fetchLOCAL_BD()
    {
        $db = $this->load->database('map', TRUE);
        $db->select('*');
        $db->from("LOCAL_BD");
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchTIPO_OBJETO()
    {
        $db = $this->load->database('map', TRUE);
        $db->select('*');
        $db->from("TIPO_OBJETO");
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchIMPLANTACAO()
    {
        $db = $this->load->database('map', TRUE);
        $db->select('*');
        $db->from("IMPLANTACAO");
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function fetchOBJETO()
    {
        $db = $this->load->database('map', TRUE);
        $db->select('*');
        $db->from("OBJETO");
        $db->order_by("DSC_OBJETO");
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function updateOBJETO($data)
    {
        $db = $this->load->database('map', TRUE);
        $db->where('CHV_OBJETO', $data['CHV_OBJETO']);
        $q = $db->get('OBJETO');
        if ($q->num_rows() > 0) {
            $db->where('CHV_OBJETO', $data['CHV_OBJETO']);
            $db->update('OBJETO', $data);
        } else {
            $db->set('CHV_OBJETO', $data['CHV_OBJETO']);
            $db->insert('OBJETO', $data);
        }
        return true;
    }

    public function fetchOBJETO_RELACIONAMENTO($CHV_OBJETO_ORIGEM)
    {
        $db = $this->load->database('map', TRUE);
        $db->select('*');
        $db->from("OBJETO_RELACIONAMENTO");
        $db->where("CHV_OBJETO_ORIGEM", $CHV_OBJETO_ORIGEM);
        $query = $db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }






    // public function fetchMAP_INDICADOR()
    // {
    //     $db = $this->load->database('map', TRUE);
    //     $db->select('*');
    //     $db->from("MAP_INDICADOR");
    //     $db->order_by("DSC_INDICADOR");
    //     $query = $db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return array();
    //     }
    // }
    // public function fetchMAP_OBJETO_RELACIONAMENTO($CHV_OBJETO_ORIGEM)
    // {
    //     $db = $this->load->database('map', TRUE);
    //     $db->select('*');
    //     $db->from("MAP_OBJETO_RELACIONAMENTO");
    //     $db->where("CHV_OBJETO_ORIGEM", $CHV_OBJETO_ORIGEM);
    //     $query = $db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return array();
    //     }
    // }

    // public function fetchObjeto($CHV_OBJETO)
    // {
    //     $db = $this->load->database('map', TRUE);
    //     $db->select('*');
    //     $db->from("MAP_OBJETO");
    //     $db->where("CHV_OBJETO", $CHV_OBJETO);
    //     $query = $db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->row();
    //     } else {
    //         return array();
    //     }
    // }






    public function updateOBJETO_RELACIONAMENTO($arrayCHV_OBJETO_DESTINO, $CHV_OBJETO_ORIGEM)
    {

        $db = $this->load->database('map', TRUE);

        $db->where('CHV_OBJETO_ORIGEM', $CHV_OBJETO_ORIGEM);
        $db->delete('OBJETO_RELACIONAMENTO');

        foreach ($arrayCHV_OBJETO_DESTINO as $key => $value) {
            $array = array(
                'CHV_OBJETO_ORIGEM' => $CHV_OBJETO_ORIGEM,
                'CHV_OBJETO_DESTINO' => $value,
                'CHV_IMPLANTACAO' => 1
            );

            $db->insert("OBJETO_RELACIONAMENTO", $array);
        }
    }
}
