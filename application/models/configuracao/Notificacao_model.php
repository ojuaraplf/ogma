<?php

class Notificacao_model extends CI_Model
{
	public function fetch()
	{
		$db = $this->load->database('default', true);
		$db->select('*');
		$db->order_by('NOT_Codigo', 'DESC');

		$query = $db->get('ogma_NOT_Notificacao');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	public function insert($data)
	{
		$this->db->insert("ogma_NOT_Notificacao", $data);
		return true;
	}

	public function updateEnabled($data)
	{
		$this->db->where('NOT_Codigo', $data['NOT_Codigo']);
		$this->db->update("ogma_NOT_Notificacao", $data);
		return true;
	}
}
