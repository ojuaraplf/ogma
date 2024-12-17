<?php

	class StcLista_model extends CI_Model {

		public function fetchStc() {

			$query = $this->db->query("SELECT * FROM ogsv_STC_StatusChamado;");
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function fetchEditaStc($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_STC_StatusChamado");
			$db->where("STC_Codigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function UpdateStc($id, $data)
		{
			$this->db->where('STC_Codigo', $id);
			$this->db->update("ogsv_STC_StatusChamado", $data);
			return true;
		}
	
		public function salvarStc($data)
		{
			$this->db->insert("ogsv_STC_StatusChamado", $data);
			return true;
		}
	}

