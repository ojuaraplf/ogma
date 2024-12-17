<?php

	class StpLista_model extends CI_Model {

		public function fetchStp() {

			$query = $this->db->query("SELECT * FROM ogsv_STP_StatusProjeto;");
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function fetchEditaStp($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_STP_StatusProjeto");
			$db->where("STP_Codigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function UpdateStp($id, $data)
		{
			$this->db->where('STP_Codigo', $id);
			$this->db->update("ogsv_STP_StatusProjeto", $data);
			return true;
		}
	
		public function salvarStp($data)
		{
			$this->db->insert("ogsv_STP_StatusProjeto", $data);
			return true;
		}
	}

