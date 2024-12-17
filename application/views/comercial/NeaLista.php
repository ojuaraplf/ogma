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

        #tableNEA tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-briefcase" style="color: #0000FF;"></i> Lista de Áreas de Negócio </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista de Áreas de Negócio</li>
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
				
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tableNEA" class="table table-hover">
                                    <thead>
                                        <tr>                                            
                                            <th id='coFtaCodi'>Código</th>
											<th id='coFtaDeno'>Denominação</th>
                                            <th id='coFtaEspe'>Especificação</th>
                                            <th id='coFtaArNe'>Acrônimo</th>
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
                © 2019 wDiscover Ltda - NeaLista: vs00.02 2410080930
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
			var pNEACodigo = null;
			var arrayNea = [];    
			var table = null;

            $('#liAreaNegocio').addClass('selected'); // Para a página atual
			$('#liCadastrosBasicosCom').addClass('active'); // Para o subitem do menu
			$('#ulCadastrosBasicosCom').addClass('in'); // Para expandir o submenu correspondente
			$('#liComercial').addClass('active'); // Para o item do menu específico
			$('#ulComercial').addClass('in'); // Para expandir o menu específico

			ListaNeas();

			function ListaNeas() {

				table = $('#tableNEA').DataTable({
					"destroy": true,
					"searching": false,
					"retrieve": true,
					"paging": false,
					"sAjaxDataProp": "",
					"responsive": true,
					"info": false,
					"ajax": {
						"url": "<?= base_url('comercial/NeaLista/fetchNea'); ?>",
						"type": 'POST',
						"dataType": 'json',
						complete: function(response) {
							arrayNea = response.responseJSON;
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
							"data": "NEA_Codigo",
							"defaultContent": "",
							"className": "text-center",
							"width": "2%"
						},
						{
							"data": "NEA_Denominacao",
							"defaultContent": "",
							"className": "text-left",
							"width": "25%"
						},
						{
							"data": "NEA_Especificacao",
							"defaultContent": "",
							"className": "text-left",
							"width": "31%"
						},
						{
							"data": "NEA_Acronimo",
							"defaultContent": "",
							"className": "text-left",
							"width": "2%"
						}
					],
					"initComplete": function () {
						removeSpinner();
					}
				});
			}

            $('#tableNEA tbody').on('click', 'tr', function () {
                var selectedNea = arrayNea[table.row(this).index()];
                window.open('<?= base_url('EditaAreaNegocio/') ?>' + selectedNea.NEA_Codigo, '_self');
            });

            $('#btnNovoFta').click(function() {
                window.open('<?php echo base_url('CriaAreaNegocio/') ?>', '_self');  
            });

            function setInputTextHints() {

                $('#btnNovoFta').prop('title', 'Criar nova Área de Negócio.' );

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
