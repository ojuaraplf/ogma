<?php

class Parceiro_model extends CI_Model
{

	  public function listaparceiros()
	  {
		  $db = $this->load->database('default', TRUE);
		  $db->select('*');
      $db->from("ogvw_listaparceiros_vhsys");
      $where = "PES_CnpjCpf is  NOT NULL";
      $db->where($where);
      //$db->order_by("FLAG_VHSYS", "PES_NOME");
      $db->order_by("PES_NOME desc");

		  $query = $db->get();
		  if ($query->num_rows() > 0) {
			  return $query->result_array();
		  } else {
			  return array();
		  }
	  }


	  public function listasemelhantes($primeironome)
	  {
      $db = $this->load->database('default', TRUE);

      //echo "entramos aqui";
      
		  $db->select('*');
      $db->from('ogvw_ogma_pessoaatibutosfuncionais');
      $db->like('pes_nome', $primeironome);
      //$db->order_by("PES_NOME desc");
      

      $query = $db->get();
      
		  if ($query->num_rows() > 0) {
			  return $query->result_array();
		  } else {
			  return array();
		  }
	  }

    public function fetchVHSysParceiroCategoria()
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vhsys.com/v2/categorias-clientes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => 1,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Access-Token: KVeMbfINgdNWEXHPDUCgBADCXUVBgd",
                "Secret-Access-Token: wdaUMoM97fTwPYeOoALznhByEvDgcW",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
      
        $json = json_decode($response);

    }


    public function checarPESCnpjCpf($PES_CnpjCpf)
    {
      
      //$this->db->select('PES_Codigo');
      $this->db->where('PES_CnpjCpf', $PES_CnpjCpf);
      $query = $this->db->get('ogvw_ogma_PES_Funcionario_vhsys');

      if ($query->num_rows() > 0) {
        return $query->result_array();
      } else {
        return array();
      }
      
    }

    public function cadastraPesPessoa($data)
    {
      $this->db->insert("ogma_PES_Pessoa", $data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
    }

    /*
    public function cadastraParceiro($data)
    {
      $this->db->insert("ogsv_PAR_Parceiro", $data);
    }
    */

    public function atualizaFuncionario($id, $data)
    {
        $this->db->where('CBR_PESCodigo', $id);
        $this->db->update("ogrh_CBR_Funcionario", $data);
        return true;
    }

    public function cadastraFuncionario($data)
    {
        $this->db->insert("ogrh_CBR_Funcionario", $data);
        return true;
    }
}