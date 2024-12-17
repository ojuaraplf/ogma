<?php

	if (!($this->session->has_userdata('userToken'))) {
		redirect('login');
	}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>wD Ogma Pessoa</title>

	<?php $this->load->view('include/headerTop') ?>
	<style type="text/css">

		.rowPessoa {
			cursor: pointer;
		}

		html {
			visibility: hidden;
		}


	</style>


</head>


<body style="background: #eeeeee;">
<div id="main-wrapper">


	<?php $this->load->view('include/navbarHome') ?>
	<?php $this->load->view('include/asidebar') ?>


	<div class="page-wrapper">
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h3 class="page-title"><i class="mdi mdi-account"></i> Lista de Pessoas</h3>
					<div class="ml-auto text-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Lista de Pessoas</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<br/>

		<div class="card-body">
			<div class="card" style="background-color: #eeeeee;">
				<div class="col-12">
				<button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovaPessoa"> <i class="mdi mdi-plus-circle-outline"></i> </button>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-6">
									<label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
									<input type="text" class="form-control" id="inputTextFiltro"/>
								</div>
							</div>

							<br/>

							<table id="tablePesLista" class="table table-hover table-sm table-bordered" >
								<thead>
								<tr>
									<th id='TitPesNome'>Nome / Razão Social</th>
									<th id='TitPesCodigo'>Código</th>
									<th id='TitPesTipo'>Tipo</th>
									<th id='TitPesCNPJ'>CPF / CNPJ</th>
									<th id='TitPesColab'><i class="mdi mdi-account-convert"></i></th>
									<th id='TitPesClient'><i class="mdi mdi-account-star"></i></th>
									<th id='TitPesPesCli'><i class="mdi mdi-account-multiple"></i></th>
									<th id='TitPesOgma'><i class="mdi mdi-account-network"></i></th>
									<th id='TitPesSirius'><i class="mdi mdi-account-network"></i></th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer text-center">
				© 2019 wDiscovery Ltda.
			</footer>
		</div>

	</div>

	<?php $this->load->view('include/headerBottom') ?>
	<?php $this->load->view('include/defaults') ?>

	<script type="text/javascript">

       setInputTextHints();

	   	$('#liAdministracao').addClass('selected');
    	$('#liPesLista').addClass('active');
        $('#ulAdministrativo').addClass('in');

		function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tablePesLista");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td") ; 
				for(j=0 ; j<td.length ; j++)
				{
				let tdata = td[j] ;
				if (tdata) {
					if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
					break ; 
					} else {
					tr[i].style.display = "none";
					}
				} 
				}
			}
		}

		var $rows = $('#tablePesLista tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});


		loadSpinner();
		PesListaTabela();

		$(document).on('click', '#tablePesLista > tbody > tr ', function () {
			window.open('<?php echo base_url("PesEdita/")?>' + $(this).attr("id"), '_self');
		});

		$('#btnNovaPessoa').click(function() {
            window.open('<?php echo base_url('PesNovo/') ?>', '_self');  
        });

		function PesListaTabela() {
			var PES_TipoFouJ;
			var PES_CnpjCpf;
			var PES_Nome;
			var CBR_PESCodigo;
			var USU_FlgPodeAcessarOgma;
			var USU_FlgPodeAcessarSirius;
			var CLI_PESCodigo;
			var CLP_PESCodigo;


			$.ajax({
				url: "<?php echo base_url(); ?>administrativo/PesLista/Fetch_PES_Pessoa",
				dataType: 'json',
				success: function (data) {
					console.log(data);

					var html = "";
					for (var i = data.length - 1; i >= 0; i--) {
						
						PES_TipoFouJ = 'Jurídica';
						PES_CnpjCpf = '';
						PES_Nome = '';
						CBR_PESCodigo = '';
						CLI_PESCodigo = '';
						CLP_PESCodigo = '';
						USU_FlgPodeAcessarOgma = '';
						USU_FlgPodeAcessarSirius = '';						

						if (data[i].PES_TipoFouJ == "F") {
							PES_TipoFouJ = 'Física';
						}

						if (data[i].PES_CnpjCpf != "" && data[i].PES_CnpjCpf != null && data[i].PES_CnpjCpf != "null") { 
							PES_CnpjCpf = data[i].PES_CnpjCpf;
						}
						if (data[i].PES_Nome != "" && data[i].PES_Nome != null && data[i].PES_Nome != "null") { 
							PES_Nome = data[i].PES_Nome.toUpperCase();
						}
						 	if (data[i].USU_FlgPodeAcessarOgma == 1) { 
								USU_FlgPodeAcessarOgma = '<i class="mdi mdi-account-network"></i>' ;
						}
						if (data[i].USU_FlgPodeAcessarSirius == 1) { 
							USU_FlgPodeAcessarSirius = '<i class="mdi mdi-account-network"></i>' ;
						}
						if (data[i].CBR_PESCodigo != null) { 
							CBR_PESCodigo = '<i class="mdi mdi-account-convert"></i>' ;
						}
						if (data[i].CLI_PESCodigo != null) { 
							CLI_PESCodigo = '<i class="mdi mdi-account-alert"></i>' ;
						}
						if (data[i].CLP_PESCodigo != null) { 
							CLP_PESCodigo = '<i class="mdi mdi-account-multiple"></i>' ;
						}

						html += '<tr class="rowPessoa" id="' + data[i].PES_Codigo + '">';
						html += '<td>' + PES_Nome + '</td>';
						html += '<td>' + data[i].PES_Codigo + '</td>';
						html += '<td>' + PES_TipoFouJ + '</td>';
						html += '<td>' + PES_CnpjCpf + '</td>';
						html += '<td>' + CBR_PESCodigo + '</td>';
						html += '<td>' + CLI_PESCodigo + '</td>';
						html += '<td>' + CLP_PESCodigo + '</td>';
						html += '<td>' + USU_FlgPodeAcessarOgma + '</td>';
						html += '<td>' + USU_FlgPodeAcessarSirius + '</td>';
						html += '<tr>';
					}
					$('#tablePesLista tbody').html(html)
					removeSpinner();
				}
			});
		}

        function setInputTextHints() {
            $('#inputTextFiltro').prop('title', 'Experimente digitar o que procura aqui.');
			$('#btnNovaPessoa').prop('title', 'Criar nova Pessoa.');
			
			
			$('#TitPesAtivo').prop('title', 'A Pessoa está ativa.\nAinda é considerada por nós.');
			$('#TitPesOgma').prop('title', 'A Pessoa é usuária do Ogma.\nSeu dia-a-dia é muito mais produtivo.');
			$('#TitPesSirius').prop('title', 'A Pessoa é usuária do Sirius.\nNosso Sistema de Abertura Chamados.');
			$('#TitPesColab').prop('title', 'A Pessoa faz parte da Equipe wD.\nCom certeza, já financiou um bolo pra galera.');
			$('#TitPesClient').prop('title', 'A Pessoa é honrosa cliente wD.');
			$('#TitPesPesCli').prop('title', 'A Pessoa é membro colaboradora\nde algum dos honrosos cliente wD.');			
		
			
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

	</script>
</body>
</html>