<?php

if (!($this->session->has_userdata('userToken'))) {
	redirect('login');
}
?>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>wDiscover</title>

	<?php $this->load->view('include/headerTop') ?>
	<style type="text/css">
		html {
			visibility: hidden;
		}
	</style>
</head>

<body style="background: #eeeeee;">
	<div id="main-wrapper">
		<?php $this->load->view('include/navbarProjeto') ?>
		<?php $this->load->view('include/asidebar') ?>
		<div class="page-wrapper">
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 d-flex no-block align-items-center">
						<h4 class="page-title">Planos de serviço</h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Planos de Serviço</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<label for="inputTextFilterName" class="text-left control-label col-form-label"> Procurar projeto </label>
										<input type="text" class="form-control" id="inputTextFilterName" />
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-12">
										<p>Filtrar por:
											<button type="button" class="btn btn-outline-secondary btn-xs btn-tag" value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<button type="button" style="background-color: #fdfd8e;" class="btn btn-xs btn-tag" value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<button type="button" style="background-color: #95e495;" class="btn btn-xs btn-tag" value="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<button type="button" style="background-color: #a6e5fd;" class="btn btn-xs btn-tag" value="21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<button type="button" style="background-color: #d4d4d4;" class="btn btn-xs btn-tag" value="24">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<button type="button" style="background-color: #ff8d87;" class="btn btn-xs btn-tag" value="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<button type="button" style="background-color: #808080;" class="btn btn-xs btn-tag" value="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
										</p>
									</div>
								</div>
								<table id="tableProjetos" class="table table-hover">
									<thead>
										<tr>
											<th style="width: 10%;">Código</th>
											<th style="width: 45%;">Apelido</th>
											<th style="width: 45%;">Status</th>
											<th hidden></th>
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
		<?php $this->load->view('modal/modalNovoProjeto') ?>

		<script type="text/javascript">
			// Variables
			var projectList = <?= $projectList ?>;
			var arrayStatus = [];

			loadSpinner();

			$('#liServico').addClass('selected');
			$('#liServicoProjeto').addClass('active');
			$('#ulServico').addClass('in');

			$(".btn-tag").click(function(eventObject) {
				var value = $(this).val();
				switch (value) {
					case "0":
						table.clear().rows.add(projectList).draw();
						break;

					case "3":
						var filteredData = projectList.filter(project => project.STP_CODIGO == 3 || project.STP_CODIGO == 6 || project.STP_CODIGO == 12 || project.STP_CODIGO == 20);
						table.clear().rows.add(filteredData).draw();
						break;

					case "15":
						var filteredData = projectList.filter(project => project.STP_CODIGO == 15);
						table.clear().rows.add(filteredData).draw();
						break;

					case "21":
						var filteredData = projectList.filter(project => project.STP_CODIGO == 21 || project.STP_CODIGO == 18);
						table.clear().rows.add(filteredData).draw();
						break;

					case "24":
						var filteredData = projectList.filter(project => project.STP_CODIGO == 24);
						table.clear().rows.add(filteredData).draw();
						break;

					case "25":
						var filteredData = projectList.filter(project => project.STP_CODIGO == 25);
						table.clear().rows.add(filteredData).draw();
						break;

					case "9":
						var filteredData = projectList.filter(project => project.STP_CODIGO == 9 || project.STP_CODIGO == 29);
						table.clear().rows.add(filteredData).draw();
						break;
				}
			})

			$("#tableProjetos > tbody").css('cursor', 'pointer');

			var table = $('#tableProjetos').DataTable({
				data: projectList,
				destroy: true,
				searching: true,
				paging: false,
				responsive: true,
				info: false,
				dom: '<"top">rt<"bottom"p><"clear">',
				language: {
					url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				},
				order: [
					[0, "Desc"]
				],
				initComplete: function(settings, json) {
					removeSpinner();
				},
				rowId: 'PJT_CODIGO',
				columns: [{
						data: "PJT_CODIGO",
						defaultContent: ""

					},
					{
						data: "PJT_APELIDO",
						defaultContent: ""

					},
					{
						data: "STP_DESCRICAO",
						defaultContent: ""

					}
				],
				columnDefs: [{
					targets: 2,
					render: function(data, type, row) {
						return getStatusElement(row["STP_CODIGO"], data);
					}
				}, ]
			});

			$('#inputTextFilterName').keyup(function() {
				table.search($(this).val()).draw();
			});

			$('#tableProjetos tbody').on('click', "tr", function() {
				window.open('<?php echo base_url('detalheProjeto/') ?>' + this.id, '_self');
			});

			function getStatusElement(idStatus, data) {
				var backgroundColor = "#FFFFFF";
				var textColor = "#000000"
				switch (idStatus) {
					case "3":
					case "6":
					case "12":
					case "20":
						textColor = "#767602";
						backgroundColor = "#fdfd8e";
						break;

					case "15":
						textColor = "#196119";
						backgroundColor = "#95e495";
						break;

					case "21":
					case "18":
						textColor = "#02597a";
						backgroundColor = "#a6e5fd";
						break;

					case "24":
						textColor = "#414141";
						backgroundColor = "#d4d4d4";
						break;

					case "25":
						textColor = "#870700";
						backgroundColor = "#ff8d87";
						break;

					case "9":
					case "29":
						textColor = "#FFFFFF";
						backgroundColor = "#808080";
						break;
				}
				return '<span style="background-color: ' + backgroundColor + '; color: ' + textColor + '; font-size: 1.1em; font-weight: bold; padding: 12px;" class="badge badge-pill">' + data + '</span> </td>';
			}
		</script>
</body>

</html>