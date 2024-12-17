<?php
class Login_model extends CI_Model
{

    public function performLogin($login, $pwd)
    {           
        $query = $this->db->query("CALL ogma_USU_Selecao02(?, ?)", array($login, $pwd));
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return [];
        }
        
    }

    /*
    public function performLogin($login, $pwd)
    {
        $this->db->where('USU_Login', $login);
        $this->db->where('USU_FlgPodeAcessarOgma', 1);
        $this->db->join('ogma_PES_Pessoa', 'ogma_PES_Pessoa.PES_Codigo = ogma_USU_Usuario.USU_PESCodigo', 'left');

        $query = $this->db->get('ogma_USU_Usuario');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return [];
        }
    }
    */
}
