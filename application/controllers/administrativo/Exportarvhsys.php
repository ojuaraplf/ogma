<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exportarvhsys extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("administrativo/exportarvhsys_model", 'rm');
    }

    public function index()
    {
        $this->load->view('administrativo/exportarvhsys');
    }

	public function fetchFechamentoMes()
	{
        $FMC_Mes = $this->input->post("FMC_Mes");
        //$FMC_Mes = '2020-12-01';
		$retorno = $this->rm->fetchFechamentoMes($FMC_Mes);

		$arrayData = array();

		foreach ($retorno as $resultados) {
			array_push(
				$arrayData,
				$retorno = array(                  
                    "FMC_Codigo" => $resultados["FMC_Codigo"],
                    "CBR_VhSysClienteId" => $resultados["CBR_VhSysClienteId"],
                    "PES_Nome" => $resultados["PES_Nome"],
                    "FMC_CBRCodigo" => $resultados["FMC_CBRCodigo"],
                    "PJT_TITULO" => $resultados["PJT_TITULO"],
                    "PJT_APELIDO" => $resultados["PJT_APELIDO"],
					"FMC_RemuneraQuant" => $resultados["FMC_RemuneraQuant"],
					"FMC_RemuneraValor" => $resultados["FMC_RemuneraValor"],
					"FMC_FlgRemuneraQuebrado" => $resultados["FMC_FlgRemuneraQuebrado"],
					"FMC_VrTotal" => $resultados["FMC_VrTotal"],
					"FMC_CBUCodigo" => $resultados["FMC_CBUCodigo"],
                    "PJT_VhSysCCustoId" => $resultados["PJT_VhSysCCustoId"],
                    "FMC_VhSysLancamentoId" => $resultados["FMC_VhSysLancamentoId"],
					"FMC_MomFechamento" => $resultados["FMC_MomFechamento"],
                    "FMC_CBRempCodigo" => $resultados["FMC_CBRempCodigo"],
                    "PES_Empresa" => $resultados["PES_Empresa"]                 
				)
			);
		}

		echo json_encode($arrayData);
    }
    

	public function fetchFechamentoMesEstat()
	{
        $FMC_Mes = $this->input->post("FMC_Mes");
        //$FMC_Mes = '2020-12-01';
		$retorno = $this->rm->fetchFechamentoMesEstat($FMC_Mes);

		$arrayData = array();

		foreach ($retorno as $resultados) {
			array_push(
				$arrayData,
				$retorno = array(                  
                    "QTD_COLBOGMA" => $resultados["QTD_COLBOGMA"],
                    "QTD_COLBVHSYS" => $resultados["QTD_COLBVHSYS"],
                    "QTD_PROJETO" => $resultados["QTD_PROJETO"],
                    "QTD_CCUSTO" => $resultados["QTD_CCUSTO"],
                    "VLR_TOT" => $resultados["VLR_TOT"],
                    "TOT_HORAS" => $resultados["TOT_HORAS"],
					"QTD_MIGRADO" => $resultados["QTD_MIGRADO"],
                    "QTD_LINHAS" => $resultados["QTD_LINHAS"],
                    "QTD_LINHAS_MIGRADO" => $resultados["QTD_LINHAS_MIGRADO"]           
				)
			);
		}

		echo json_encode($arrayData);
    }

    
    public function ws_contaspagar($VHSYS_id_fornecedor, $VHSYS_nome_fornecedor, $VHSYS_valor_pag, 
    $VHSYS_id_centro_custos, $VHSYS_centro_custos_pag)
	{

        $hoje = date("Y-m-d");
        //echo $hoje; 

        $data['nome_conta'] = $VHSYS_nome_fornecedor;
        $data['id_categoria'] = "43";
        $data['categoria_pag'] = "Despesa";
        $data['id_banco'] = "479579"; // banco stone
        $data['id_fornecedor'] = $VHSYS_id_fornecedor;
        $data['nome_fornecedor'] = $VHSYS_nome_fornecedor;
        $data['vencimento_pag'] = $hoje;
        $data['valor_pag'] = $VHSYS_valor_pag;
        $data['valor_pago'] = "00.00";
        $data['data_emissao'] = $hoje;
        $data['n_documento_pag'] = "";
        $data['observacoes_pag'] = "Migrado do OGMA [observacoes_pag]";
        $data['id_centro_custos'] = $VHSYS_id_centro_custos; 
        $data['centro_custos_pag'] = $VHSYS_centro_custos_pag; 
        $data['liquidado_pag'] = "Nao";
        $data['data_pagamento'] = "";
        $data['obs_pagamento'] = "Migrado do OGMA [obs_pagamento]";
        $data['forma_pagamento'] = "Ted";
        $data['valor_juros'] = "00.00";
        $data['valor_desconto'] = "00.00";
        $data['valor_acrescimo'] = "00.00";
  
      $curl = curl_init();
      curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.vhsys.com/v2/contas-pagar",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
              "Access-Token: KVeMbfINgdNWEXHPDUCgBADCXUVBgd",
              "Secret-Access-Token: wdaUMoM97fTwPYeOoALznhByEvDgcW",
              "Content-Type: application/json"            
          ),
      ));
  
      $response = curl_exec($curl);
      $erro = curl_error($curl);

      //$resultado = json_decode($response);
      return $response;

    }


    public function ws_contaspagarExcluir($id_conta_pag)
	{

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vhsys.com/v2/contas-pagar/" . $id_conta_pag,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => array(
                "Access-Token: KVeMbfINgdNWEXHPDUCgBADCXUVBgd",
                "Secret-Access-Token: wdaUMoM97fTwPYeOoALznhByEvDgcW",
                "Content-Type: application/json"
            ),
        ));
    
        $response = curl_exec($curl);
        $erro = curl_error($curl);

        //$j_lista = json_decode($response);
        //echo $j_lista->status;
        return $response;
        //return $j_lista->status;

    }


    public function sendToContaspagar()
	{
        $FMC_Mes = $this->input->post("FMC_Mes");
        $mensagem = "Nenhum dado foi migrado.";
        
        $retorno = $this->rm->sendToContaspagar($FMC_Mes);

        foreach ($retorno as $resultados) {
            
            $VHSYS_id_fornecedor = $resultados["CBR_VhSysClienteId"];
            //echo "VHSYS_id_fornecedor " . $VHSYS_id_fornecedor . "</p>";
            $VHSYS_nome_fornecedor = $resultados["PES_Nome"];
            //echo "VHSYS_nome_fornecedor " . $VHSYS_nome_fornecedor . "</p>";
            $VHSYS_valor_pag = $resultados["FMC_VrTotal"];
            //echo "VHSYS_valor_pag " . $VHSYS_valor_pag . "</p>";
            $VHSYS_id_centro_custos = $resultados["PJT_VhSysCCustoId"];
            //echo "VHSYS_id_centro_custos " . $VHSYS_id_centro_custos . "</p>";
            $VHSYS_centro_custos_pag = $resultados["PJT_APELIDO"];
            //echo "VHSYS_centro_custos_pag " . $VHSYS_centro_custos_pag . "</p>";
            
            $data = $this->ws_contaspagar($VHSYS_id_fornecedor, $VHSYS_nome_fornecedor, $VHSYS_valor_pag, $VHSYS_id_centro_custos, $VHSYS_centro_custos_pag);

            //echo $data;

            $json = json_decode($data);
                    
            //echo "----------------------------</p>";
            //echo $resultados["FMC_Codigo"] . "</p>";
            //echo $json->data->id_conta_pag . "</p>";
            $id_conta_pag = $json->data->id_conta_pag;

            $data2 = array(
                "FMC_VhSysLancamentoId" => $id_conta_pag
            );
        
            $updateFMC = $this->rm->atualizaFechamentoMes($resultados["FMC_Codigo"], $data2);
            //echo '</p>migração VHSYS OK: ' . $id_conta_pag . '</p>';
            $mensagem = "Dado(s) migrados.";
            
        }
        
        echo $mensagem;
    }

    
	public function deleteContaspagarVHSys()
    {
        $FMC_Codigos = $this->input->post("FMC_Codigos");
        $resultadoexclusao = "";
		$retorno = $this->rm->deleteContaspagarVHSys($FMC_Codigos);
        $falhas = "";
        $okay = "";

		foreach ($retorno as $resultados) {

            $data = $this->ws_contaspagarExcluir($resultados["FMC_VhSysLancamentoId"]);
            $json = json_decode($data);

            $status = $json->status;

            if ($status == "success") {
                $this->rm->updateContaspagarOgma($resultados["FMC_Codigo"]);
                $okay = "Despesa(s) excluida(s).";
            } else {
                $falhas += $falhas . "Não foi possivel excluir a despesa " . $resultados["FMC_VhSysLancamentoId"] . "<p>";
            } 

            //echo $resultados["FMC_Codigo"] . " > " . $resultados["FMC_VhSysLancamentoId"] . " -> " . $status;

		}

        echo $okay . "<p>" . $falhas;;
    }
    
    
}
