<?php
class EditarFase_model extends CI_Model
{



	public function fetchFase($idFase)
	{
		$this->db->select('*');
		$this->db->where('PJF_CODIGO', $idFase);
		$query = $this->db->get('ogm_projetofase');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function fetchProjeto($idProjeto)
	{
		$db = $this->load->database('default', TRUE);
		$db->select('PJT_APELIDO, PJT_DATAINICIO, PJT_DATATERMINO, a004_nm_fantasia, PJT_ITEMCAS');
		$db->from("ogm_vw_projetodetalhe");
		$db->where("PJT_CODIGO", $idProjeto);
		$query = $db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}





	public function fetchFamiliaAtividade()
	{
		$this->db->select('*');
		$query = $this->db->get('ogsv_ATF_FamiliaAtividade');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	public function fetchEquipeFase($idFase)
	{

		$this->db->select('*');
		$this->db->where('PJF_CODIGO', $idFase);
		$query = $this->db->get('ogm_projetoequipefase');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	public function fetchAtividadesFase($idFase)
	{
		$this->db->select('*');
		$this->db->where('PJF_CODIGO', $idFase);
		$this->db->order_by('ATG_ORDEM', 'ASC');
		$query = $this->db->get('ogm_vw_atividadedetalhes');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}



	public function fetchDependenciaEResponsaveis($idFase)
	{

		$this->db->select('*');
		$this->db->where('PJF_CODIGO', $idFase);
		$query = $this->db->get('ogm_projetodependenciaresponsaveisfase');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	public function fetchFornecedorRequisitoFase($idFase)
	{

		$this->db->select('*');
		$this->db->where('PJF_CODIGO', $idFase);
		$query = $this->db->get('ogm_projetofornecedorrequisitofase');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	public function fetch_ogsv_PJL_TecnologiaFase($idFase)
	{

		$this->db->select('*');
		$this->db->where('PJL_PJFCodigo', $idFase);
		$query = $this->db->get('ogsv_PJL_TecnologiaFase');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}



	public function fetchRiscoFase($idFase)
	{

		$this->db->select('*');
		$this->db->where('PFR_PJFCodigo', $idFase);
		$query = $this->db->get('ogsv_PJR_RiscoFaseProjeto');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function updateRiscos($data)
	{
		foreach ($data as $key => $value) {
			if ($value[0] == null) {
				$arrayRiscos = array(
					'PFR_DescricaoRisco' => $value[1],
					'PFR_Probabilidade' => $value[2],
					'PFR_Impacto' => $value[3],
					'PFR_Exposicao' => $value[4],
					'PFR_PJFCodigo' => $value[5]
				);
				$this->db->insert("ogsv_PJR_RiscoFaseProjeto", $arrayRiscos);
			} else {
				$arrayRiscos = array(
					'PFR_Codigo' => $value[0],
					'PFR_DescricaoRisco' => $value[1],
					'PFR_Probabilidade' => $value[2],
					'PFR_Impacto' => $value[3],
					'PFR_Exposicao' => $value[4],
					'PFR_PJFCodigo' => $value[5]
				);
				$this->db->where('PFR_Codigo', $value[0]);
				$this->db->update("ogsv_PJR_RiscoFaseProjeto", $arrayRiscos);
			}
		}
	}


	function deleteRiscos($data)
	{

		foreach ($data as $key => $value) {
			$this->db->where('PFR_Codigo', $value);
			$this->db->delete('ogsv_PJR_RiscoFaseProjeto');
		}
	}




















	function updateEquipe($data)
	{
		$this->db->where('PJF_CODIGO', $data[0][2]);
		$this->db->delete('ogm_projetoequipefase');

		foreach ($data as $key => $value) {
			$arrayEquipe = array(
				'PEQ_CODCBR' => $value[0],
				'PEQ_CODCARGO' => $value[1],
				'PJF_CODIGO' => $value[2]
			);

			$this->db->insert("ogm_projetoequipefase", $arrayEquipe);
		}
	}











	public function fetchCatalogoServicoItemDetalhes($idProjeto)
	{
		$db = $this->load->database('default', TRUE);
		$db->select('PJT_ITEMCAS');
		$db->from("ogm_projeto");
		$db->where("PJT_CODIGO", $idProjeto);
		$casItemId = $db->get()->row()->PJT_ITEMCAS;

		$db = $this->load->database('default', TRUE);
		$db->select('*');
		$db->from("ogm_catalogoservicoitem");
		$db->where("CSI_CODIGO", $casItemId);
		$query = $db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}













	public function saveGrupoAtividadesDetalhes($data)
	{
		$this->db->where('ATG_CODIGO', $data["ATG_CODIGO"]);
		$this->db->update("ogm_projetoatividadesfase", $data);
		return true;
	}


	public function saveEquipeAlocada($data, $ATG_CODIGO)
	{
		$this->db->where('ATG_CODIGO', $ATG_CODIGO);
		$this->db->delete('ogm_projetoequipealocadaatividade');

		foreach ($data as $key => $value) {
			$arrayEquipeAlocada = array(
				'AEA_CBRCODIGO' => $value,
				'ATG_CODIGO' => $ATG_CODIGO
			);

			$this->db->insert("ogm_projetoequipealocadaatividade", $arrayEquipeAlocada);
		}
	}

	public function fetchEquipeAlocadaAtividade($idAtividade)
	{
		$this->db->select('*');
		$this->db->where('ATG_CODIGO', $idAtividade);
		$query = $this->db->get('ogm_projetoequipealocadaatividade');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}
	public function fetchGrupoAtividadesDetalhes($idAtividade)
	{
		$this->db->select('*');
		$this->db->where('ATG_CODIGO', $idAtividade);
		$query = $this->db->get('ogm_projetoatividadesfase');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}


		// $this->db->select('*');
		// $this->db->where('ATG_CODIGO', $idAtividade);
		// $query = $this->db->get('projetoatividadesfase');
		// if ($query->num_rows() > 0) {
		// 	return $query->result_array();
		// } else {
		// 	return array();
		// }
	}















	public function fetchEquipeFaseAlocada($idFase)
	{

		$this->db->select('*');
		$this->db->where('PJF_CODIGO', $idFase);
		$query = $this->db->get('ogm_vw_equipealocadafase');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

































	function deleteDetalhesAtividades($data)
	{



		foreach ($data as $key => $value) {
			$this->db->where('ATG_CODIGO', $value);
			$this->db->delete('ogm_projetoequipealocadaatividade');
		}
	}

	function deleteAtividades($data)
	{



		foreach ($data as $key => $value) {
			$this->db->where('ATG_CODIGO', $value);
			$this->db->delete('ogm_projetoatividadesfase');
		}
	}

	function updateAtividades($data)
	{

		foreach ($data as $key => $value) {
			if ($value[4] == null) {
				if ($value[2] == null) {
					$arrayAtividades = array(
						'ATG_ORDEM' => $value[0],
						'ATG_DESCRICAO' => $value[1],
						'ATG_QTHORA' => null,
						'ATG_ISENTA' => 0,
						'ATG_ATFCodigo' => 1,
						'PJF_CODIGO' => $value[3],
						'ATG_PORCENTAGEMAPRONTADA' => 0
					);
				} else {
					$arrayAtividades = array(
						'ATG_ORDEM' => $value[0],
						'ATG_DESCRICAO' => $value[1],
						'ATG_QTHORA' => $value[2],
						'ATG_ISENTA' => 0,
						'ATG_ATFCodigo' => 1,
						'PJF_CODIGO' => $value[3],
						'ATG_PORCENTAGEMAPRONTADA' => 0
					);
				}
				$this->db->insert("ogm_projetoatividadesfase", $arrayAtividades);

				if ($value[2] != null) {
					$insert_id = $this->db->insert_id();

					$momVencimento = $this->db->query('select TrazPrazoMomFinal("' . $value[5] . '", ' . $value[2] . ') as momVencimento;');
					$ATG_MomVctoANS = $momVencimento->row()->momVencimento;

					$this->db->set("ATG_MomVctoANS", $ATG_MomVctoANS);
					$this->db->where('ATG_CODIGO', $insert_id);
					$this->db->update('ogm_projetoatividadesfase');
				}
			} else {

				if ($value[2] == null) {
					$arrayAtividades = array(
						'ATG_ORDEM' => $value[0],
						'ATG_DESCRICAO' => $value[1],
						'ATG_QTHORA' => null,
						'PJF_CODIGO' => $value[3]
					);
				} else {
					$arrayAtividades = array(
						'ATG_ORDEM' => $value[0],
						'ATG_DESCRICAO' => $value[1],
						'ATG_QTHORA' => $value[2],
						'PJF_CODIGO' => $value[3]
					);
				}
				$this->db->where('ATG_CODIGO', $value[4]);
				$this->db->update("ogm_projetoatividadesfase", $arrayAtividades);
			}
		}
	}






	public function fetchTotalHorasApontadas($PJF_CODIGO)
	{
		$res = $this->db->query('select TrazTotalHoraApontadaFase(' . $PJF_CODIGO . ' ) as result;');
		return $res->row()->result;
	}

	public function fetchDataFinal($ATG_MomInicExecucao, $ATG_QTHORA)
	{
		$res = $this->db->query('select TrazPrazoMomFinal("' . $ATG_MomInicExecucao . '", ' . $ATG_QTHORA . ' ) as result;');
		return $res->row()->result;
	}







	function updateAtividadesAssociadas($AMC_ATGMucanteCod, $data)
	{
		$this->db->where('AMC_ATGMucanteCod', $AMC_ATGMucanteCod);
		$this->db->delete('ogsv_AMC_MudancaCorrecaoATG');

		foreach ($data as $key => $value) {
			$arrayAtividadesAssociadas = array(
				'AMC_ATGMucanteCod' => $value[0],
				'AMC_ATGMucadaCod' => $value[1],
				'AMC_MUTCodigo' => $value[2]
			);

			$this->db->insert("ogsv_AMC_MudancaCorrecaoATG", $arrayAtividadesAssociadas);
		}
		$this->db->query('call AtualizaVctosMUC(' . $AMC_ATGMucanteCod . ' );');
	}





	function updateDependenciaEResponsaveis($data)
	{
		$this->db->where('PJF_CODIGO', $data[0][3]);
		$this->db->delete('ogm_projetodependenciaresponsaveisfase');

		foreach ($data as $key => $value) {
			$arrayDependenciaEResponsaveis = array(
				'DEP_DESCRICAO' => $value[0],
				'DEP_CLICOD' => $value[1],
				'DEP_DATALIMITE' => $value[2],
				'PJF_CODIGO' => $value[3]
			);

			$this->db->insert("ogm_projetodependenciaresponsaveisfase", $arrayDependenciaEResponsaveis);
		}
	}




	function updateFornecedorRequisito($data)
	{
		$this->db->where('PJF_CODIGO', $data[0][3]);
		$this->db->delete('ogm_projetofornecedorrequisitofase');

		foreach ($data as $key => $value) {
			$arrayFornecedorRequisito = array(
				'PFR_CODCBRCONT' => $value[0],
				'PFR_EMPRESA' => $value[1],
				'PFR_FUNCAO' => $value[2],
				'PJF_CODIGO' => $value[3]
			);

			$this->db->insert("ogm_projetofornecedorrequisitofase", $arrayFornecedorRequisito);
		}
	}


	function updateTecnologias($data, $PJL_PJFCodigo)
	{
		$this->db->where('PJL_PJFCodigo', $PJL_PJFCodigo);
		$this->db->delete('ogsv_PJL_TecnologiaFase');

		if ($data == []) {
			return;
		}
		foreach ($data as $key => $value) {
			$arrayTecnologias = array(
				'PJL_TLGCodigo' => $value[0],
				'PJL_PJFCodigo' => $value[1]
			);

			$this->db->insert("ogsv_PJL_TecnologiaFase", $arrayTecnologias);
		}
	}



	public function fetchAtividadesAssociadas($AMC_ATGMucanteCod)
	{
		$this->db->select('*');
		$this->db->where('AMC_ATGMucanteCod', $AMC_ATGMucanteCod);
		$query = $this->db->get('ogsv_AMC_MudancaCorrecaoATG');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}







	public function fetchColaboradores()
	{
		$this->db->select('a001_cd_usuario, a001_nm_usuario');
		$this->db->where('a001_ind_desat', 0);
		$this->db->order_by('a001_nm_usuario DESC');
		$query = $this->db->get('t001_usuario');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	public function fetchCargos()
	{
		$this->db->select('CGO_Codigo, CGO_Titulo');
		//		$this->db->where('a001_ind_desat', 0);
		//		$this->db->order_by('a001_nm_usuario DESC');
		$query = $this->db->get('ogrh_CGO_DescricaoCargo');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}



	public function updateFase($data)
	{
		$this->db->where('PJF_CODIGO', $data["PJF_CODIGO"]);
		$this->db->update("ogm_projetofase", $data);
		return true;
	}
	public function updateRiscoDetalhes($data)
	{
		$this->db->where('PFR_Codigo', $data["PFR_Codigo"]);
		$this->db->update("ogsv_PJR_RiscoFaseProjeto", $data);
		return true;
	}
	public function fetchContatoDetalhe()
	{
		$this->db->select('*');
		$this->db->order_by('a006_nm_contato DESC');
		$query = $this->db->get('ogm_vw_contatodetalhe');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}














































	function newFase($data)
	{
		$this->db->insert("ogm_projetofase", $data);
		$insert_id = $this->db->insert_id();
		echo $insert_id;
	}


	function fetchNumberFasesFromProject($idProjeto)
	{
		$this->db->select('PJF_CODIGO');
		$this->db->where('PJT_CODIGO', $idProjeto);
		$query = $this->db->get('ogm_projetofase');


		echo $query->num_rows();
	}









	function newFornecedorRequisito($data)
	{

		$arrayFornecedorRequisito = array(
			'PFR_CODCBRCONT' => $data[0],
			'PFR_EMPRESA' => $data[1],
			'PFR_FUNCAO' => $data[2],
			'PJF_CODIGO' => $data[3]
		);
		$this->db->insert("ogm_projetofornecedorrequisitofase", $arrayFornecedorRequisito);
	}


	function newDependenciaEResponsaveis($data)
	{
		$arrayDependenciaEResponsaveis = array(
			'DEP_DESCRICAO' => $data[0],
			'DEP_CBRCOD' => $data[1],
			'DEP_DATALIMITE' => $data[2],
			'PJF_CODIGO' => $data[3]
		);
		$this->db->insert("ogm_projetodependenciaresponsaveisfase", $arrayDependenciaEResponsaveis);
	}
}
