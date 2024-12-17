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

        #tableREP tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-tune-vertical" style="color: #FF00FF;"></i> Lista Recursos & Preços </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista Recursos & Preços</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid flex-grow-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoRep">
                            <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tableREP" class="table table-hover">
                                    <thead>
                                        <tr>                                            
                                            <th id='coRepCodi'>Código</th>
											<th id='coRepDesc'>Descrição</th>
                                            <th id='coRepUnid'>Unidade</th>
                                            <th id='coRepValo'>Valor (R$)</th>
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
                © 2019 wDiscover Ltda - RepLista: vs00.02 2410080930
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
			var arrayRep = [];    
			var table = null;

			$('#liListaRecursoPreco').addClass('selected');            
            $('#liComercial').addClass('active');
            $('#ulComercial').addClass('in');

			ListaReps();

			function ListaReps() {

				table = $('#tableREP').DataTable({
					"destroy": true,
					"searching": false,
					"retrieve": true,
					"paging": false,
					"sAjaxDataProp": "",
					"responsive": true,
					"info": false,
					"ajax": {
						"url": "<?= base_url('comercial/RepLista/fetchRep'); ?>",
						"type": 'POST',
						"dataType": 'json',
						complete: function(response) {
							arrayRep = response.responseJSON;
						},
						error: function(e) {
							console.error(e);
						}
					},
					"language": {
						url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
					},
					"order": [[0, 'asc']],
					"rowId": 'REP_Codigo',
					"columns": [
						{
							"data": "REP_Codigo",
							"defaultContent": "",
							"className": "text-center",
							"width": "1%"
						},
						{
							"data": "Descricao_Combinada",
							"defaultContent": "",
							"className": "text-left",
							"width": "79%"
						},
						{
							"data": "REP_UNVCodigo",
							"defaultContent": "",
							"className": "text-left",
							"width": "12%"
						},
						{
							"data": "REP_VendaPreco",
							"defaultContent": "",
							"className": "text-right",
							"width": "8%",
							render: function(data, type, row) {
								return formatarMilhar(data);
							}
						}
					],
					"initComplete": function () {
						removeSpinner();
					}
				});
			}

            $('#tableREP tbody').on('click', 'tr', function () {
                var selectedRep = arrayRep[table.row(this).index()];
                window.open('<?= base_url('EditaRecursoPreco/') ?>' + selectedRep.REP_Codigo, '_self');
            });

            $('#btnNovoRep').click(function() {
                window.open('<?php echo base_url('CriaRecursoPreco/') ?>', '_self');  
            });

            function setInputTextHints() {

                $('#btnNovoRep').prop('title', 'Criar nova Área de Negócio.' );

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
