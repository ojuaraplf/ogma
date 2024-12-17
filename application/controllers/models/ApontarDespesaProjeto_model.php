<?php
class ApontarDespesaProjeto_model extends CI_Model {
	

	public function fetchApontarDespesaProjeto($idColaborador) {


		$db = $this->load->database('default', TRUE);
		$db->select('*');
		$db->from("ogfn_DSPdespesasprojeto");
		$db->where("DSP_001_cd_usuario", $idColaborador);



		$query = $db->get();
		// $query = $this->db->get('ogfn_DSPdespesasprojeto');


		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}


	}



	public function fetchProjeto() {
		$this->db->order_by("PJT_CODIGO", "ASC");
		$query = $this->db->get('ogm_projeto');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}


	public function updateDespesaProjeto($data) {

		if ($data["DSP_Codigo"] == "") {
			$this->db->insert("ogfn_DSPdespesasprojeto", $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;	
		} else {
			$this->db->where('DSP_Codigo', $data["DSP_Codigo"]);
			$this->db->update("ogfn_DSPdespesasprojeto", $data);
			return $data["DSP_Codigo"];	
		}


			
	}




}