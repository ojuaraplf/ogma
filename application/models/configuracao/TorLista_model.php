<?php

	class TorLista_model extends CI_Model {

		public function fetchTorLista( $pTOR_Codigo, $pIncluirDesativa )
		{
			$aTOR_Codigo = $pTOR_Codigo == "" ? NULL : $pTOR_Codigo ;
			$aIncluirDesativa = $pIncluirDesativa == NULL ? 0 : $pIncluirDesativa ;
	
			$query = $this->db->query("CALL ogfn_TOR_Lista01(?, ?)", array( $aTOR_Codigo, $aIncluirDesativa ));
		
			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function fetchTorEdita( $pTOR_Codigo, $pIncluirDesativa )
		{
			$aTOR_Codigo = $pTOR_Codigo == "" ? NULL : $pTOR_Codigo ;
			$aIncluirDesativa = $pIncluirDesativa == NULL ? 0 : $pIncluirDesativa ;
			
			$query = $this->db->query("CALL ogfn_TOR_Lista01(?, ?)", array( $aTOR_Codigo, $aIncluirDesativa ));

			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return array();
			}
		}

		public function fetchTOC($pTOCId)
		{
			$aTOCId = $pTOCId == 0 ? NULL : $pTOCId;
			$query = $this->db->query("CALL ogfn_TOR_ListaTOC(?)", array($aTOCId));
		
			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function fetchTOB($pTOBId)
		{
			$aTOBId = $pTOBId == 0 ? NULL : $pTOBId;
			$query = $this->db->query("CALL ogfn_TOR_ListaTOB(?)", array($aTOBId));
			// print_r($query->result_array());
			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function UpdateTor($id, $data)
		{
			$this->db->where('TOR_Codigo', $id);
			$this->db->update("ogsv_TOR_TipoOrcamento", $data);
			return true;
		}

		public function NewTor($data)
		{
			$this->db->insert("ogsv_TOR_TipoOrcamento", $data);
			return true;
		}

		// public function fetchEditaUsu($id)
		// {
		// 	$db = $this->load->database('default', true);
		// 	$db->select('*');
		// 	$db->from("ogma_USU_Usuario");
		// 	$db->join('ogma_PES_Pessoa', 'ogma_PES_Pessoa.PES_Codigo = ogma_USU_Usuario.USU_PESCodigo');
		// 	$db->where("USU_PESCodigo", $id);

		// 	$query = $db->get();
		// 	if ($query->num_rows() > 0) {
		// 		return $query->row();
		// 	} else {
		// 		return false;
		// 	}
		// }

		// public function UpdateTor($id, $data)
		// {
		// 	$this->db->where('USU_PESCodigo', $id);
		// 	$this->db->update("ogma_USU_Usuario", $data);
		// 	return true;
		// }
	
		// public function AdicionaUsu($data)
		// {
		// 	$this->db->insert("ogma_USU_Usuario", $data);
		// 	return true;
		// }

		// public function fetchogma_PES_Selecao01()
		// {
		// 	$query = $this->db->query("CALL ogma_PES_Selecao01('F','USU')");
		// 	$this->db->close();
		// 	if ($query->num_rows() > 0) {
		// 		return $query->result_array();
		// 	} else {
		// 		return array();
		// 	}
		// }
	}

