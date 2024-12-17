<?php

	class UsuLista_model extends CI_Model {

		public function fetchUsuLista( $pUsuCodigo, $pAtivo )
		{
			$pAtivo = $pAtivo == "2" ? 1 : ( $pAtivo == "1" ? 0 : NULL ) ;
			$pUsuCodigo = $pUsuCodigo == "0" ? NULL : $pUsuCodigo ;

	
			$query = $this->db->query("CALL ogma_USU_Selecao01(?, ?)", array( $pUsuCodigo, $pAtivo ));
		
			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function fetchEditaUsu($id)
		{
			$db = $this->load->database('default', true);
			$db->select('*');
			$db->from("ogma_USU_Usuario");
			$db->join('ogma_PES_Pessoa', 'ogma_PES_Pessoa.PES_Codigo = ogma_USU_Usuario.USU_PESCodigo');
			$db->where("USU_PESCodigo", $id);

			$query = $db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}

		public function UpdateUsu($id, $data)
		{
			$this->db->where('USU_PESCodigo', $id);
			$this->db->update("ogma_USU_Usuario", $data);
			return true;
		}
	
		public function AdicionaUsu($data)
		{
			$this->db->insert("ogma_USU_Usuario", $data);
			return true;
		}

		public function fetchogma_PES_Selecao01()
		{
			$query = $this->db->query("CALL ogma_PES_Selecao01('F','USU')");
			$this->db->close();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

		public function salvarUsuNovo($data)
		{
			$this->db->insert("ogma_USU_Usuario", $data);
			return true;
		}

		public function salvarPesNovo($data)
		{
			$this->db->insert("ogma_PES_Pessoa", $data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}
	}

