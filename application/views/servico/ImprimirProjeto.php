<?php 

if (!($this->session->has_userdata('userToken'))) {
    redirect('login');
}
?>
<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>wDiscovery</title>

	<?php $this->load->view('include/headerTop')?>

	<style type="text/css">
	/*	@media print {
			body {-webkit-print-color-adjust: exact;}
		}
		@page {
			size: auto;
			margin: 25mm 25mm 25mm 25mm;  
		} 

		body {
  		-webkit-print-color-adjust: exact !important;
		}
*/

		body { 
			margin: 0px;  
		}
		#header {
			border: 1px solid rgb(200, 200, 200, 1);
			margin-top: 10px;
		}
		#pageToPrint {
			background-color: white;
		}
		.spanDetalheProjetoTitulo {
			font-weight: bold;
			font-size: 16px;
		}

		img {
		  position: absolute;
		  left: 0;
		  right: 0;
		  display: block;
		  margin: auto;
		  top: 0;
		  bottom: 0;
		}


	</style>

</head>
<body style="background: #eeeeee;">
	<div class="container" id="pageToPrint">
		
		<div class="row" id="header">
			<div class="col-3" style="text-align: center;">
				<img class="mx-auto d-block img-fluid" src="<?php echo base_url('assets/img/logoColorido.png')?>">				
			</div>
			<div class="col-8" style="line-height: normal;">
				<span style="font-weight: bold; font-size: 18px;"> wDiscovery </span> <br />
				<span style=" font-size: 12px;"> Av. João Gualberto, 1342. Salas 1501/1502 <br />
				Juvevê, Curitiba PR <br />
				80030-001 <br />
				41 3011-6970 </span>
			</div>
		</div>



		<br />
		<div class="row" style="text-align: center;">
			<div class="col-12">
				<span style="text-align: center; font-size: 20px; font-weight: bold;" id="spanCSI_SERVTITULO">  wD-PPT - Projeto de Treinamento </span>
			</div>
				
			<div class="col-12">
				<span style="color: gray; text-align: center; " id="spanCSI_SERVSUBTITULO" >Plano Específico de Serviço - Plano de Curso </span>
				
			</div>
		</div>


		<div style="padding: 10px;">
			<hr />






			<div class="row">
				<div class="col-9" >
					<span class="spanDetalheProjetoTitulo"> Nome do projeto: </span> <br /> <span class="spanDetalheProjetoConteudo" id="spanPJT_TITULO"> Congelamento de processamento de informações 2018 e início de extração 2019 </span>
				</div>
				<div class="col-3">
					<span class="spanDetalheProjetoTitulo"> Gestor da conta: </span><br /><span class="spanDetalheProjetoConteudo" id="spanCOLABORADOR"> THIAGO SOARES  </span>
				</div>
			</div>

			<br />

			<div class="row">
				<div class="col-9">
					<span class="spanDetalheProjetoTitulo"> Apelido: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_APELIDO"> 0033 PPD SEBRAE MT CONGELAMENTO </span> <br />
				</div>
				<div class="col-3">
					<span class="spanDetalheProjetoTitulo"> Tecnologia BI: </span><br /><span class="spanDetalheProjetoConteudo" id="spanTLG_DESCRICAO"> QLIK VIEW </span>
				</div>
		
			</div>



			<br />

			<div class="row">
				<div class="col-3">
					<span class="spanDetalheProjetoTitulo"> QtHora: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_QTHORA"> 230 </span>
				</div>
				<div class="col-3">
					<span class="spanDetalheProjetoTitulo"> VrHora: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_VRHORA"> R$230,00 </span>
				</div>

			<div class="col-3">
					<span class="spanDetalheProjetoTitulo"> Data Início: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> 30/10/2019 </span>
				</div>
				<div class="col-3">
					<span class="spanDetalheProjetoTitulo"> Data Término: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATATERMINO"> 10/10/2019 </span>
				</div>

			</div>


			<br />



			<div class="row">
				<div class="col-9">
					<span class="spanDetalheProjetoTitulo"> Nome da Organização cliente: </span><br /><span class="spanDetalheProjetoConteudo" id="spana004_razao_social"> SEBRAE MT - SERVIÇOS DE APOIO AS MICRO E PEQUENAS EMPRESAS </span>
				</div>
				<div class="col-3" >
					<span class="spanDetalheProjetoTitulo"> Nome fantasia: </span><br /><span class="spanDetalheProjetoConteudo" id="spana004_nm_fantasia"> SEBRAE/MT </span>
				</div>

			</div>
			<br />
			<div class="row">
				<div class="col-12" style="text-align: justify;">
					<span class="spanDetalheProjetoTitulo"> Pano de comunicação: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_PLACOMUNICACAO"> As partes são notificadas sobre mudanças e/ou correções no projeto, através de e-mails individuais e pela iteração no andamento do chamado. Em necessidade de alterações ou informações mais significativas e/ou de interesse, convocar-se-ão reuniões entre a Equipe de Projeto e as partes interessadas. </span>
				</div>
			</div>



			<hr />
			


			<div id="divFases">






			</div>







			<div class="row">
		    <div class="col-md-1 " style="border: 1px solid black; height: 100px; text-align: center;">
		    	<span style="color: black; font-weight: bold; font-size: 30px; height: 100px; line-height: 100px; " class="align-middle"> 1 </span>
		    </div>
		    
		    <div class="col-md-11">
		    	<div class="row">
		    		<div class="col-12"> 
		    			<span class="spanDetalheProjetoTitulo"> Identificação da Fase: </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_TITULO"> Serviços de suporte à plataforma Qlik do cliente </span>
		    		</div>
		    	</div>
					<br />

					<div class="row">
		    		<div class="col-6">
							<span class="spanDetalheProjetoTitulo"> QtHora: </span><br /><span class="spanDetalheProjetoConteudo" id="spanCLI_NOMEFANTASIA"> 230 </span> <br />
						</div>
						<div class="col-3" style="text-align: right;">
							<span class="spanDetalheProjetoTitulo"> Data Início: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> 30/10/2019 </span>
						</div>
						<div class="col-3" style="text-align: right;">
							<span class="spanDetalheProjetoTitulo"> Data Término: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATATERMINO"> 30/10/2019 </span>
						</div>
		    	</div>
					<br />
		    	<div class="row">
						<div class="col-12" style="text-align: justify;">
							<span class="spanDetalheProjetoTitulo" > Recursos materiais da fase do projeto: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanCBR_CODIGO"> VPN com acesso ao servidor Qlikview/MT. Usuário para acesso ao servidor. Ferramenta Qlikview desktop instalada no servidor. Ferramenta SQL Management para realização de consultas aos bancos de dados. VPN com acesso ao servidor Qlikview/MT. Usuário para acesso ao servidor. Ferramenta Qlikview desktop instalada no servidor. Ferramenta SQL Management para realização de consultas aos bancos de dados. VPN com acesso ao servidor Qlikview/MT. Usuário para acesso ao servidor. Ferramenta Qlikview desktop instalada no servidor. Ferramenta SQL Management para realização de consultas aos bancos de dados. VPN com acesso ao servidor Qlikview/MT. Usuário para acesso ao servidor. Ferramenta Qlikview desktop instalada no servidor. Ferramenta SQL Management para realização de consultas aos bancos de dados.  </span>
						</div>
					</div>
		    </div>
		  </div>
			<br /><br />
			<h4>Equipe do Projeto (Fase) </h4>
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Nome</th>
			      <th scope="col">Função</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td>THIAGO SOARES</td>
			      <td>Consultor BI</td>
			    </tr>
			    <tr>
			      <td>THIAGO SOARES</td>
			      <td>Consultor BI</td>
			    </tr>
			    <tr>
			      <td>THIAGO SOARES</td>
			      <td>Consultor BI</td>
			    </tr>
			    <tr>
			      <td>THIAGO SOARES</td>	
			      <td>Consultor BI</td>
			    </tr>
			  </tbody>
			</table>
			<br />
			<div class="row">
				<div class="col-6">
						<span class="spanDetalheProjetoTitulo">Pessoa focal para a fase: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> ARIANE LIMA </span>
				</div>
				<div class="col-6">
						<span class="spanDetalheProjetoTitulo"> Função/setor na organização cliente:  </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> Gerência de Inteligência Estratégica </span>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-6">
						<span class="spanDetalheProjetoTitulo">Responsável pela homologação da entrega:  </span><br /> <span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> ARIANE LIMA </span>
				</div>
				<div class="col-6">
						<span class="spanDetalheProjetoTitulo"> Função/setor na organização cliente:   </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> Gerência de Inteligência Estratégica </span>
				</div>
			</div>
			<br /><br />
			<h4>Elenco de fornecedores de requisitos </h4>
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Nome</th>
			      <th scope="col">Empresa</th>
						<th scope="col">Função/setor na Organização </th>	
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td>THIAGO SOARES</td>
			      <td>SEBRAE/MT</td>
			      <td>Gerência de Inteligência Estratégica</td>
			    </tr>
			    <tr>
			      <td>THIAGO SOARES</td>
			      <td>SEBRAE/MT</td>
			      <td>Gerência de Inteligência Estratégica</td>
			    </tr>    
			    <tr>
			      <td>THIAGO SOARES</td>
			      <td>SEBRAE/MT</td>
			      <td>Gerência de Inteligência Estratégica</td>
			    </tr>
			  </tbody>
			</table>

			<br />
			<h4>Dependências e responsáveis </h4>
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Dependência</th>
			      <th scope="col">Responsável</th>
						<th scope="col">Data limite </th>	
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td>Acesso às Bases de Dados</td>
			      <td>THIAGO SOARES</td>
			      <td>10/10/20/2019</td>
			    </tr>
			   
			  	 <tr>
			      <td>Acesso às Bases de Dados</td>
			      <td>THIAGO SOARES</td>
			      <td>10/10/20/2019</td>
			    </tr>
			     <tr>
			      <td>Acesso às Bases de Dados</td>
			      <td>THIAGO SOARES</td>
			      <td>10/10/20/2019</td>
			    </tr>
			  </tbody>
			</table>
			<div class="row">
				<div class="col-12" >
					<span class="spanDetalheProjetoTitulo"> Escopo da fase (detalhes que delineiam o que será feito nesta fase de forma indiscutivelmente compreendida pelas partes): </span>
				</div>
				<div class="col-12" style="text-align: justify;">
					<span class="spanDetalheProjetoConteudo" id="spanPJT_TITULO"> 
					Será realizado o congelamento das informações financeiras e físicas do ano de 2018 e o início do processamento das informações de 2019 para as informações financeiras e metas físicas. A data de congelamento deverá ser informada pelo Cliente. Será atualizada a extração do instrumento de Consultorias com nova consulta informada em documento pelo Sebrae Nacional (repassado a wDiscovery pelo Sebrae MT). Os outros instrumentos (Cursos, Palestras, Informações, Orientações, Missões, Feiras, Oficinas, Clínicas, Rodadas) também terão suas extrações atualizadas conforme último documento do Sebrae Nacional sobre o assunto. As novas fórmulas serão conciliadas com os valores das “views” providas pelo Sebrae Nacional no banco local SIAC. Será realizada uma análise mais simplificada dos lançamentos financeiros de “TRANSF. SALDO ENCERRAMENTO EXERCÍCIO”, para o mês de dezembro de 2018, somente considerando as referências a tabela CHISTP do banco de dados RM. </span>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-12" >
					<span class="spanDetalheProjetoTitulo">  Escopo negativo da fase 6 (descrição sucinta de itens que não são/serão considerados como escopo do projeto): </span>
				</div>
				<div class="col-12" style="text-align: justify;">
					<span class="spanDetalheProjetoConteudo" id="spanPJT_TITULO"> 
					Não são considerados no escopo desta fase do projeto: Este escopo não compreende o congelamento das informações em mais de uma vez. Se por ventura o congelamento precisar ser desfeito para reprocessamento os dados de 2018 deverá ser feito outro plano, pois será necessária outra carga de dados de 2018, limpeza dos dados congelados de 2018 para que possa ser refeito sem ocorrer duplicidade de dados e nova carga de início de 2019. Não ocorrerá a atualização das fórmulas e novas regras para os valores dos Limites orçamentários para os anos de 2016,2017,2018 (desatualizado desde 2017, principalmente no Limite Capacitação de Recursos Humanos). Não será realizada uma análise detalhada de lançamentos de “TRANSF. SALDO ENCERRAMENTO EXERCÍCIO” que não estejam padronizados pela tabela do RM “CHISP” para serem retirados do congelamento para não deixarem os valores de Receita zerados no mês de dezembro. Não serão conciliadas as realizações das Metas Físicas locais com os relatórios do SME. </span>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-12">
					<span class="spanDetalheProjetoTitulo"> Requisitos: </span>
				</div>
				<div class="col-12"  style="text-align: justify;">
					<span class="spanDetalheProjetoConteudo" id="spanPJT_TITULO"> 
					Documento do Sebrae Nacional já enviado pela Ariane contendo as últimas versões das consultas atualizadas de cada um dos instrumentos de atendimento citados anteriormente.  Datas definida para a migração do congelamento. Números validados de 2018, financeiro e das metas físicas, pelo Sebrae MT a fim de reduzir o risco de ter que ser realizada uma nova atualização de informações para 2018 e novo congelamento. </span>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-12" >
					<span class="spanDetalheProjetoTitulo">  Entrega da fase (detalhes que delineiam a entrega (produto) desta fase de forma indiscutivelmente compreendida pelas partes): </span>
				</div>
				<div class="col-12" style="text-align: justify;">
					<span class="spanDetalheProjetoConteudo" id="spanPJT_TITULO"> 
					Aplicação Hórus, com os dados de 2018 congelados não sendo mais atualizados e as informações de 2019 sendo atualizadas diariamente.  </span>
				</div>
			</div>








		<br /><br /><br /><br /><br /><br />
		<div class="row">
			<div class="col">
				<button id="btnImprimir"> IMPRIMIR </button>	
			</div>	
		</div>






	<?php $this->load->view('include/headerBottom')?>
	<?php $this->load->view('include/defaults')?>


	<script type="text/javascript">

		fetchProjetoCreated();



		function fetchProjetoCreated() {
			return $.ajax({
				url: "<?php echo base_url(); ?>imprimirProjeto/fetchProjetoCreated",
				type: 'POST',
				data: {
					PJT_CODIGO: 41
				},
				dataType: "json",

				success: function (data) {
					console.log(data);
				}



			});
		}










		$('#btnImprimir').click(function() {
			$('#pageToPrint').printThis({
				importCSS: true,
				importStyle: true



			});
		});

























	</script>


</body>
</html>