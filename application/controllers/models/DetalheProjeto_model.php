<?php

class DetalheProjeto_model extends CI_Model
{


	function newFase($data)
	{
		$this->db->insert("ogm_projetofase", $data);
		$insert_id = $this->db->insert_id();
		echo $insert_id;
	}




	function insertTemplateRiscos($data)
	{

		$db = $this->load->database('default', TRUE);
		$db->select("GRS_Versao");
		$db->from("ogsv_GRS_GestaoRisco");
		$db->order_by('GRS_Versao', 'DESC');
		$lastVersaoId = $db->get()->row()->GRS_Versao;


		$db = $this->load->database('default', TRUE);
		$db->select("*");
		$db->from("ogsv_GRI_ItemGRS");
		$db->where('GRI_GRSVersao', $lastVersaoId);
		$arrayRiscosTemplate = $db->get()->result_array();

		array_walk($arrayRiscosTemplate, function (&$item) use ($data) {
			$item['PFR_DescricaoRisco'] = $item['GRI_DescricaoRisco'];
			unset($item['GRI_DescricaoRisco']);
			$item['PFR_Probabilidade'] = $item['GRI_Probabilidade'];
			unset($item['GRI_Probabilidade']);
			$item['PFR_Impacto'] = $item['GRI_Impacto'];
			unset($item['GRI_Impacto']);
			$item['PFR_Exposicao'] = $item['GRI_Esposicao'];
			unset($item['GRI_Esposicao']);
			$item['PFR_GRICodigo'] = $item['GRI_Codigo'];
			unset($item['GRI_Codigo']);
			$item["PFR_PJFCodigo"] = $data;

			unset($item['GRI_GRSVersao']);
		});

		foreach ($arrayRiscosTemplate as &$value) {
			$this->db->insert("ogsv_PJR_RiscoFaseProjeto", $value);
		}
		return $arrayRiscosTemplate;
	}




	public function fetchTotalHorasApontadas($PJT_CODIGO)
	{
		$res = $this->db->query('select TrazTotalHoraApontadaProjeto(' . $PJT_CODIGO . ' ) as result;');
		return $res->row()->result;
	}






	function fetchProjetoCreated($idProjeto)
	{
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

	public function fetchFaseProjeto($idProjeto)
	{
		$this->db->select('*');
		$this->db->where('PJT_CODIGO', $idProjeto);
		$this->db->order_by('PJF_ORDEMFASE', 'DESC');
		$query = $this->db->get('ogm_projetofase');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function fetchNumberFasesFromProject($idProjeto)
	{
		$this->db->select('PJF_CODIGO');
		$this->db->where('PJT_CODIGO', $idProjeto);
		$query = $this->db->get('ogm_projetofase');
		echo $query->num_rows();
	}
}
