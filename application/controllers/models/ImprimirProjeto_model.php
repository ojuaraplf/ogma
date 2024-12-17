<?php
class ImprimirProjeto_model extends CI_Model {





	function fetchProjetoCreated($idProjeto) {
		$db = $this->load->database('default', TRUE);
		$db->select("*");
		$db->from("ogm_vw_projetodetalhe");
		$db->where("PJT_CODIGO", $idProjeto);
		$query = $db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
















}
