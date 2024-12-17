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

        #tableCTM tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-umbrella-outline" style="color: #00FF00;"></i> Lista de Contrato Master </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista de Contrato Master</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid flex-grow-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoCtm" disabled>
                            <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tableCTM" class="table table-hover">
                                    <thead>
                                        <tr>                                            
                                            <th id='coCtmCodi'>Código</th>
											<th id='coCtmData'>Data da</br>Requisição</th>
											<th id='coCtmClie'>Cliente</th>
                                            <th id='coCtmTipo'>Tipo de</br>Contrato</th>
                                            <th id='coCtmStat'>Status</th>
											<th id='coCtmUnid'>Unidade</br>Padrão</th>                                          
                                            <th id='coCtmTtHo'>Total</br>Horas</th>                                          
                                            <th id='coCtmTtRs'>Total</br>R$</th>                                          
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
                © 2019 wDiscover Ltda - CtmLista: vs00.03 202409240911
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

            $('#liContratoMaster').addClass('selected');            
            $('#liComercial').addClass('active');
            $('#ulComercial').addClass('in');
            
			console.log('formatarReais(1234567.00)');
			console.log(formatarReais(1234567.00));


            var arrayCtm = [];            
            var table = $('#tableCTM').DataTable({
                "destroy": true,
                "searching": false,
                "retrieve": true,
                "paging": false,
                "sAjaxDataProp": "",
                "responsive": true,
                "info": false,
                "ajax": {
                    "url": "<?= base_url('contrato/CtmLista/GetContratosMaster'); ?>",
                    "type": 'GET',
                    "dataType": 'json',
					"dataSrc": '',
                    complete: function (response) {
                        arrayCtm = response.responseJSON;                        
                    },
                    error: function (e) {
                        console.error(e);
                    }
                },                
                "language": {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                "order": [[0, 'asc']],
                "rowId": 'CTM_Codigo',
                "columns": [
                    {
                        "data": "CTM_NumeroWD",
                        "defaultContent": "",
                        "className": "text-center",
                        "width": "8%"
                    },
					{
                        "data": "CTM_DataRequisicao",
                        "defaultContent": "",
                        "className": "text-center",
                        "width": "8%"
                    },
					{
                        "data": "CLI_NomeCod",
                        "defaultContent": "",
                        "className": "text-left",
                        "width": "23%"
                    },
                    {
                        "data": "TCT_NomeCod",
                        "defaultContent": "",
                        "className": "text-left",
                        "width": "15%"
                    },
                    {
                        "data": "STT_NomeCod",
                        "defaultContent": "",
                        "className": "text-left",
                        "width": "15%"
                    },
					{
                        "data": "UPC_NomeCod",
                        "defaultContent": "",
                        "className": "text-left",
                        "width": "15%"
                    },
					{
                        "data": "CTM_QtdeHoraTotal",
                        "defaultContent": "",
                        "className": "text-right",
                        "width": "8%"
                    },  
					{
                        "data": "CTM_ValorTotal",
                        "defaultContent": "",
                        "className": "text-right",
                        "width": "8%"
					}
                ],
				"columnDefs": [
					{
						"targets": 7,
						"data": "CTM_ValorTotal",
						"defaultContent": "",
						"className": "text-right",
						"width": "8%",
						"render": function(data, type, row) {							
							console.log("Dado recebido:", data);
							var formatado = formatarReais(data);
							console.log("Valor formatado:", formatado);
							return formatado;
						}
					}
					
				],
                "initComplete": function () {
                    removeSpinner();
                }
            });

            $('#tableCTM tbody').on('click', 'tr', function () {
                console.log(arrayCtm[table.row(this).index()]);
                var selectedCtm = arrayCtm[table.row(this).index()];
                window.open('<?= base_url('EditaContratoMaster/') ?>' + selectedCtm.CTM_Codigo, '_self');
            });

            $('#btnNovoCtm').click(function() {
                window.open('<?php echo base_url('CriaContratoMaster/') ?>', '_self');  
            });

            function setInputTextHints() {

                $('#btnNovoCtm').prop('title', 'Criar novo Contrato Master.' );
                             
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
