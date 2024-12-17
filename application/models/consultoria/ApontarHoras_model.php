<?php

class ApontarHoras_model extends CI_Model
{
	public function fetchAtividadesReferenteColaborador($idColaborador)
	{
		// $this->db->order_by("PJT_CODIGO", "DESC");

		$db = $this->load->database('default', TRUE);
		$db->select('*');
		$db->from("ogvw_atividadealocadacolaborador");
		$db->where("AEA_CBRCODIGO", $idColaborador);

		// $query = $this->db->get('vw_equipealocadadetalhe');
		// $query->where("AEA_CBRCODIGO", $idColaborador);

		$query = $db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}










	public function updateDetalhesAtividade($data)
	{
		$this->db->where('ATG_CODIGO', $data["ATG_CODIGO"]);
		$this->db->update("ogm_projetoatividadesfase", $data);
		return true;
	}

	public function updateAtividadePorcentagem($dataAtividade)
	{

		$this->db->where('ATG_CODIGO', $dataAtividade["ATG_CODIGO"]);
		$this->db->update("ogm_projetoatividadesfase", $dataAtividade);

		return true;
	}











	public function checkIfDateCanToPoint()
	{
		$db = $this->load->database('default', TRUE);
		$db->select('*');
		$db->from("ogsv_SVC_ConfigServico");
		$query = $db->get();
		return $query->row();
	}
	



	public function checarSePeriodoExisteLancamento($data)
	{

		$LCT_DATA = $data["LCT_DATA"];
		$LCT_HORAINICIO = $data["LCT_HORAINICIO"];
		$LCT_HORAFIM = $data["LCT_HORAFIM"];
		$CBR_CODIGO = $data["CBR_CODIGO"];

		$query = $this->db->query("select ChecaPeriodo(" . $CBR_CODIGO . ", '" . $LCT_DATA . "', '" . $LCT_HORAINICIO . "', '" . $LCT_HORAFIM . "') as existeLancamento");

		$row = $query->row();
		if (isset($row)) {             //line 26
			return $row->existeLancamento;
		} else {
			echo "does not exist.";
		}
	}




	public function fetchApontamentoHorasDaAtividade($ATG_CODIGO)
	{

		$db = $this->load->database('default', TRUE);
		$db->select('*');
		$db->from("ogm_vw_lancamentohorasdetalhe");
		$db->where("ATG_CODIGO", $ATG_CODIGO);

		$db->order_by("LCT_DATA", "asc");
		$db->order_by("LCT_HORAINICIO", "asc");

		$query = $db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}








	public function fetchApondamentoDia($idColaborador, $LCT_DATA)
	{

		$db = $this->load->database('default', TRUE);
		$db->select('*');
		$db->from("ogm_vw_lancamentohorasdetalhe");
		$db->where("CBR_CODIGO", $idColaborador);
		$db->where("LCT_DATA", $LCT_DATA);
		$db->order_by("LCT_HORAINICIO", "desc");

		$query = $db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}








	public function newLancamentoHora($data)
	{
		$this->db->insert("ogm_lancamentohoras", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
}
