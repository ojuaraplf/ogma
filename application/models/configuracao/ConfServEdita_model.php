<?php

	class ConfServEdita_model extends CI_Model {

		public function fetchConfServEdita()
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_SVC_ConfigServico");
			$db->where("SVC_Codigo", 1);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function updateConfServEdita($data)
		{
			$this->db->where('SVC_Codigo', 1);
			$this->db->update("ogsv_SVC_ConfigServico", $data);
			return true;
		}
	}

