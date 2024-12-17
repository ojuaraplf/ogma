<?php
class Financeiro_model extends CI_Model {
	
	

	public function fetchFinanceiro() {




		// $this->db->where('a033_dt_lcto_financeiro', '2018-01-12');
		// $this->db->order_by("a033_cd_lcto_financeiro", "DESC");
		$query = $this->db->get('ogm_vw_financeiro');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}


	}






}


