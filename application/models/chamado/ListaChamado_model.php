<?php

	class ListaChamado_model extends CI_Model {

		public function fetchChamados() {

			$query = $this->db->query("SELECT * FROM ogm_vw_chamadodetalhes;");

			// $this->db->order_by("CHD_Codigo", "DESC");

			// $query = $this->db->get('ogm_vw_chamadodetalhes');


			// print_r($query->result_array());

			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}
	}