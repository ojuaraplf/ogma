<?php

	class CasLista_model extends CI_Model {

		public function fetchCasLista($aCasAtivo, $aCsiId, $aAbre)
		{
			$pCasAtivo = $aCasAtivo;
			$pCsiId = $aCsiId;
			$pAbre = $aAbre;
			$query = $this->db->query("CALL ogsv_CAS_Selecao02(?, ?, ?)", array( $pCasAtivo, $pCsiId, $pAbre ));

			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function fetchEditaCas($id)
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

		//***** TEMPLATES INICIO */
		public function fetchTemplTAG($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_TAG_TemplateATG");
			$db->where("TAG_CSICodigo", $id);			

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();				
			} else {
				return array();
			}			
		}

		public function fetchTemplTPC($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_TPC_TemplatePLC");
			$db->where("TPC_CSICodigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function fetchTemplTPD($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_TPD_TemplatePLD");
			$db->where("TPD_CSICodigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function fetchTemplTPF($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_TPF_TemplatePJC");
			$db->where("TPF_CSICodigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function fetchTemplTPM($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_TPM_TemplateIRM");
			$db->where("TPM_CSICodigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function fetchTemplTPN($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_TPN_TemplatePJN");
			$db->where("TPF_CSICodigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function fetchTemplTPT($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogsv_TPT_TemplateTextos");
			$db->where("TPT_CSICodigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}
		//***** TEMPLATES FIM */

		//***** COMBOS INÍCIO */
		public function fetchComboATF()
		{
			$query = $this->db->query("Select * from ogsv_ATF_FamiliaAtividade");

			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function fetchComboTOD($pIni1_Fim2)
		{
			$query = $this->db->query("CALL ogfn_TOR_DiasDoMes( ? )", array($pIni1_Fim2));
			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function UpdateCas($id, $data)
		{
			$this->db->where('CSI_CODIGO', $id);
			$this->db->update("ogm_catalogoservicoitem", $data);
			return true;
		}

		public function UpdateTpn($id, $data)
		{
			$this->db->where('TPF_CSICodigo', $id);
			$this->db->update("ogsv_TPN_TemplatePJN", $data);
			return true;
		}
		
		public function UpdateTpf($id, $data)
		{
			$this->db->where('TPF_CSICodigo', $id);
			$this->db->update("ogsv_TPF_TemplatePJC", $data);
			return true;
		}

		function updateTag($data)
		{
			foreach ($data as $key => $value) {
			if ($value[0] == null) {
				$arrayTag = array(
				'TAG_CSICodigo' => $value[1],
				'TAG_Ordem' => $value[2],
				'TAG_Descricao' => $value[3],
				'TAG_Familia' => $value[4],
				'TAG_Fase' => $value[5],
				'TAG_QtHora' => $value[6]
				);
				$this->db->insert("ogsv_TAG_TemplateATG", $arrayTag);
			} else {
				$arrayTag = array(
				'TAG_CSICodigo' => $value[1],
				'TAG_Ordem' => $value[2],
				'TAG_Descricao' => $value[3],
				'TAG_Familia' => $value[4],
				'TAG_Fase' => $value[5],
				'TAG_QtHora' => $value[6]
				);
				$this->db->where('TAG_Codigo', $value[0]);
				$this->db->update("ogsv_TAG_TemplateATG", $arrayTag);
			}
			}
		}

		function deleteTag($data)
		{
		  foreach ($data as $key => $value) {
			$this->db->where('TAG_Codigo', $value);
			$this->db->delete('ogsv_TAG_TemplateATG');
		  }
		}
		
		public function fetchTipoOrcamento()
		{
		  $query = $this->db->get('ogsv_TOR_TipoOrcamento');
		  if ($query->num_rows() > 0) {
			return $query->result_array();
		  } else {
			return array();
		  }
		}
	}

