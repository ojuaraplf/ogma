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
	<title>Ogma Cliente</title>

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
					<h3 class="page-title"><i class="mdi mdi-account-star"></i> Lista de Clientes</h>
					<div class="ml-auto text-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Lista de Clientes</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="card-body">
			<div class="card" style="background-color: #eeeeee;">
				<div class="col-12">
					<button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoCliente"> <i class="mdi mdi-plus-circle-outline"></i> </button>
				</div>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row" id="divLista">
				<div class="col-md-12">								
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-6">
									<label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
									<input type="text" class="form-control" id="inputTextFiltro"/>
								</div>
							</div>

							<table id="tableCliLista" class="table table-hover table-sm table-bordered" >
								<thead>
									<tr>
										<th id='TitCliNome'>Razão Social / Nome</th>
										<th id='TitCliCodi'>Código</th>
										<th id='TitCliCnpj'>CNPJ/CPF</th>
										<th id='TitCliNPes'><i class="mdi mdi-account-multiple"></i></th>
										<th id='TitCliNPjt'><i class="mdi mdi-math-compass"></i></th>
										<th id='TitCliHTra'><i class="mdi mdi-rowing"></i></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer text-center">
				© 2021 wDiscover - Versão 00.05 (beta)
			</footer>
		</div>

	</div>

	<?php $this->load->view('include/headerBottom') ?>
	<?php $this->load->view('include/defaults') ?>

	<script type="text/javascript">

		removeSpinner();
		setInputTextHints();

	   	$('#liComercial').addClass('selected');
    	$('#liCliLista').addClass('active');
        $('#ulComercial').addClass('in');

		function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableCliLista");
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

		var $rows = $('#tableCliLista tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});

		optionMostraTudo = 1;
		listarCli();
		
		function listarCli() {

			loadSpinner();
			$('#tableCliLista').DataTable().clear().destroy();
			table = $('#tableCliLista').DataTable({
				// dom: 'Bfrtip',
				dom: '<"html5buttons"B>Tfgitp',
				buttons: [{
						extend: 'pdf',
						className: 'btn-primary',
						exportOptions: {
						columns: ':not(.notexport)'
						}
					},
					{
						extend: 'print',
						className: 'btn-primary'
					},
					{
						extend: 'excel',
						className: 'btn-primary'
					}
				],
				
				destroy: true,
				searching: false,
				autoWidth: false,
				retrieve: true,
				paging: false,
				sAjaxDataProp: "",
				responsive: true,
				info: false,

				ajax: {
					url: "<?php echo base_url(); ?>comercial/CliLista/fetchCliLista",
					type: 'POST',
					data: {
						optionMostraTudo: optionMostraTudo
					},
					complete: function(response) {
						arrayLista = JSON.parse(response.responseText);
						$('#divLista').show();
						console.log(response);
					}
				},

				language: {
					url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				},
				order: [
					[0, "asc"]
				],
				rowId: 'CODIGO',
				columns: [
					{
						"data": "PESSOA",
						"defaultContent": "",
						className: "text-left"
					},
					{
						"data": "CODIGO",
						"defaultContent": "",
						className: "text-center"
					},
					{
						"data": "CPF/CNPJ",
						"defaultContent": "",
						className: "text-center"
					},
					{
						"data": "NRO_PES",
						"defaultContent": "",
						className: "text-center"
					},
					{
						"data": "NRO_PJT",
						"defaultContent": "",
						className: "text-center"
					},
					{
						"data": "NRO_HORAS",
						"defaultContent": "",
						className: "text-right"
					}
				],
				'initComplete': function(settings, json) {
					removeSpinner();
				},
				columnDefs: [
					{
						"width": "50%",
						"targets": [0],
					},
					{
						"width": "5%",
						"targets": [1],
					},
					{
						"width": "10%",
						"targets": [2],
					},
					{
						"width": "1%",
						"targets": [3],
					},
					{
						"width": "1%",
						"targets": [4],
					},
					{
						"width": "1%",
						"targets": [5],
					},
				],

			});
		}

		var selectedCliente = "";
        $(document).on('click', '#tableCliLista > tbody > tr ', function() {
          selectedCliente = arrayLista[table.row(this).index()];
          window.open('<?php echo base_url('CliEdita/') ?>' + selectedCliente.CODIGO, '_self');
        });

		$('#btnNovoCliente').click(function() {
            window.open('<?php echo base_url('CliNovo/') ?>', '_self');  
        });

        function setInputTextHints() {
            $('#btnNovoCliente').prop('title', 'Criar novo Cliente.' );
			
			
			$('#TitCliNome').prop('title', 'Razão Social ou nome do Clente.');
			$('#TitCliCodi').prop('title', 'Código do Cliente enquanto Pessoa no Cadastro de Pessoas.');
			$('#TitCliCnpj').prop('title', 'Número do CNPJ ou do CPF do Cliente, informado no Cadastro de Pessoas.');
			$('#TitCliNPes').prop('title', 'Quantidade de Membros do Cliente.\nPessoas cadastradas e vinculadas a ele no Ogma.');
			$('#TitCliNPjt').prop('title', 'Quantiade de Planos de Serviços que o cliente tem ou já teve na wD.');
			$('#TitCliHTra').prop('title', 'Trabalho em horas que o cliente deu ou tem dado à wD.');

			
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