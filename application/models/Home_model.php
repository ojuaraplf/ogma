<?php
class Home_model extends CI_Model
{
	function fetchNotifications()
	{
		$db = $this->load->database('default', true);
		$db->select('*');
		$db->where('NOT_Habilitada', 1);
		$db->order_by('NOT_Codigo', 'ASC');

		$query = $db->get('ogma_NOT_Notificacao');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}
}
