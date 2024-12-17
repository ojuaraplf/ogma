<?php

	class RelatorioApontamentoHoras_model extends CI_Model {


		public function fetchApontamentoHoras($CBR_CODIGO, $LCT_DATAINCIAL, $LCT_DATAFINAL, $PJT_CODIGO) {

			$db = $this->load->database('default', TRUE);
			$db->select('*');
			$db->from("ogm_vw_lancamentohorasdetalhe");
			$db->where("CBR_CODIGO", $CBR_CODIGO);

			$db->where("LCT_DATA >=", $LCT_DATAINCIAL);
			$db->where("LCT_DATA <=", $LCT_DATAFINAL);


			if ($PJT_CODIGO != null) {
				$db->where("PJT_CODIGO", $PJT_CODIGO);
			}

			$db->order_by("LCT_DATA", "ASC");
			$db->order_by("LCT_HORAINICIO", "DESC");
			$query = $db->get();

			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}


		public function fetchProjetos($CBR_CODIGO) {

			$db = $this->load->database('default', TRUE);
			$db->select('PJT_CODIGO, PJT_APELIDO');
			$db->from("ogm_vw_lancamentohorasdetalhe");
			$db->where("CBR_CODIGO", $CBR_CODIGO);

			$db->group_by("PJT_CODIGO");

			$query = $db->get();

			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}


		public function fetchTotalHoras($CBR_CODIGO, $LCT_DATAINCIAL, $LCT_DATAFINAL, $PJT_CODIGO) {


			$db = $this->load->database('default', TRUE);
			$db->select_sum('LCT_TEMPO');
			$db->from("ogm_vw_lancamentohorasdetalhe");
			$db->where("CBR_CODIGO", $CBR_CODIGO);

			$db->where("LCT_DATA >=", $LCT_DATAINCIAL);
			$db->where("LCT_DATA <=", $LCT_DATAFINAL);


			if ($PJT_CODIGO != null) {
				$db->where("PJT_CODIGO", $PJT_CODIGO);
			}

			$query = $db->get();
			return $query->row();

		}






		public function updateLancamentoHora($data) {
			$this->db->where('LCT_CODIGO', $data["LCT_CODIGO"]);
			$this->db->update("ogm_lancamentohoras", $data);
			return true;

		}

		public function removerLancamentoHora($data) {
			$this->db->where('LCT_CODIGO', $data["LCT_CODIGO"]);
			$this->db->delete("ogm_lancamentohoras");
			return true;

		}




	}
