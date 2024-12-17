<?php

if (!($this->session->has_userdata('userToken'))) {
  redirect('login');
}
?>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>wD Ogma</title>

    <?php $this->load->view('include/headerTop'); ?>

    <style>
        html {
            visibility: hidden;
        }

        #tableFTA tbody tr {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-light">
    <div id="main-wrapper">
        <?php 
        $this->load->view('include/navBarStatusChamado'); 
        $this->load->view('include/asidebar'); 
        ?>

        <div class="page-wrapper d-flex flex-column min-vh-100">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h3 class="page-title"><i class="mdi mdi-chart-bar" style="color: #FFA500;"></i> Lista de Ferramenta </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista de Ferramenta</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid flex-grow-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoFta">
                            <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                    </div>
					<div class="form-group" style="text-align: right;">
						<label for="inputNEACodigo" class="control-label col-form-label" style="display: block;">Selecione a Área de Negócio</label>
						<select id="inputNEACodigo" class="form-control float-right" style="width: auto; display: inline-block;">
							<option value="">Todas</option>
							<?php foreach ($ArrayNEA as $areaNegocio): ?>
								<option value="<?= $areaNegocio['NEA_Codigo']; ?>"><?= $areaNegocio['NEA_Denominacao']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tableFTA" class="table table-hover">
                                    <thead>
                                        <tr>                                            
                                            <th id='coFtaCodi'>Código</th>
											<th id='coFtaDeno'>Denominação</th>
                                            <th id='coFtaEspe'>Especificação</th>
                                            <th id='coFtaArNe'>AN</th>
                                            <th id='coFtaVers'>Versão</th>
                                            <th id='coFtaDese'>Desenvolvedor</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - FtaLista: vs00.02 2410080930
            </footer>
        </div>
    </div>

    <?php 
    $this->load->view('include/headerBottom'); 
    $this->load->view('include/defaults'); 
    $this->load->view('modal/modalChecklist'); 
    $this->load->view('modal/modalChecklistItemDetalhes'); 
    ?>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            setInputTextHints();
            loadSpinner();
			var pFTACodigo = null;
			var arrayFta = [];    
			var table = null;

			$('#liFerramenta').addClass('selected');            
            $('#liComercial').addClass('active');
            $('#ulComercial').addClass('in');

			var pNEACodigo = $('#inputNEACodigo').val();

			ListaFtas();

			function ListaFtas() {

				console.log('entrou na tabela');
				console.log($('#inputNEACodigo').val());
				var pNEACodigo = $('#inputNEACodigo').val();
				console.log(pFTACodigo);
				console.log(pNEACodigo);

				if ($.fn.DataTable.isDataTable('#tableFTA')) {
					$('#tableFTA').DataTable().destroy();
				}

				table = $('#tableFTA').DataTable({
					"destroy": true,
					"searching": false,
					"retrieve": true,
					"paging": false,
					"sAjaxDataProp": "",
					"responsive": true,
					"info": false,
					"ajax": {
						"url": "<?= base_url('comercial/FtaLista/fetchFta'); ?>",
						"type": 'POST',
						"dataType": 'json',
						"data": function(d) {
							return {
								pNEACodigo: pNEACodigo,
								pFTACodigo: pFTACodigo
							};
						},
						complete: function(response) {
							arrayFta = response.responseJSON;
						},
						error: function(e) {
							console.error(e);
						}
					},
					"language": {
						url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
					},
					"order": [[0, 'asc']],
					"rowId": 'FTA_Codigo',
					"columns": [
						{
							"data": "FTA_Codigo",
							"defaultContent": "",
							"className": "text-center",
							"width": "2%"
						},
						{
							"data": "FTA_Denominacao",
							"defaultContent": "",
							"className": "text-left",
							"width": "25%"
						},
						{
							"data": "FTA_Especificacao",
							"defaultContent": "",
							"className": "text-left",
							"width": "31%"
						},
						{
							"data": "NEA_Acronimo",
							"defaultContent": "",
							"className": "text-left",
							"width": "2%"
						},
						{
							"data": "FTA_UltimaVersao",
							"defaultContent": "",
							"className": "text-left",
							"width": "20%"
						},
						{
							"data": "FTA_Fabricante",
							"defaultContent": "",
							"className": "text-left",
							"width": "20%"
						}
					],
					"initComplete": function () {
						removeSpinner();
					}
				});
			}

			$('#inputNEACodigo').change(function() {
				console.log('mudou a selaçao de área de negócio');
				ListaFtas();
			});

            $('#tableFTA tbody').on('click', 'tr', function () {
                var selectedFta = arrayFta[table.row(this).index()];
                window.open('<?= base_url('EditaFerramenta/') ?>' + selectedFta.FTA_Codigo, '_self');
            });

            $('#btnNovoFta').click(function() {
                window.open('<?php echo base_url('CriaFerramenta/') ?>', '_self');  
            });

            function setInputTextHints() {
                $('#btnNovoFta').prop('title', 'Criar nova Ferramenta.' );
                $('#coFtaCodi').prop('title', 'Código (Id) da Ferramenta.' );
                $('#coFtaDeno').prop('title', 'Denominação da Ferramenta.' );
                $('#coFtaEspe').prop('title', 'Especificação da Ferramenta.' );
                $('#coFtaArNe').prop('title', 'Área de Negócio para a Ferramenta.' );
                $('#coFtaDese').prop('title', 'Desenvolvedor da Ferramenta.' );
                $('#coFtaVers').prop('title', 'Última versão da Ferramenta.' );

                $('[data-toggle="tooltip"]').tooltip({
                    placement: "bottom",
                    boundary: 'window',
                    animation: true,
                    trigger: "hover"
                });
            }
        });
    </script>
</body>

</html>
