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

        #tableUPC tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-umbrella-outline"></i> Lista de Unidade Padrão do Contrato </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista de Unidade Padrão do Contrato</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid flex-grow-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoUpc">
                            <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tableUPC" class="table table-hover">
                                    <thead>
                                        <tr>                                            
                                            <th id='coUpcCodi'>Código</th>
                                            <th id='coUpcDesc'>Descrição</th>
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
                © 2019 wDiscover Ltda - UpcLista: vs00.02 20240824
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
            
            $('#liUnidadePadraoContrato').addClass('selected');
            $('#liCadastrosBasicosCom').addClass('active');
            $('#ulCadastrosBasicosCom').addClass('in');
            $('#liComercial').addClass('active');
            $('#ulComercial').addClass('in');

            var arrayUpc = [];            
            var table = $('#tableUPC').DataTable({
                "destroy": true,
                "searching": false,
                "retrieve": true,
                "paging": false,
                "sAjaxDataProp": "",
                "responsive": true, // Tabela responsiva
                "info": false, // Remove a informação sobre quantidade de registros
                "ajax": {
                    "url": "<?= base_url('contrato/upcLista/fetchUpc'); ?>",
                    "type": 'POST',
                    "dataType": 'json',
                    complete: function (response) {
                        arrayUpc = response.responseJSON;                        
                    },
                    error: function (e) {
                        console.error(e);
                    }
                },                
                "language": {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                "order": [[0, 'asc']],
                "rowId": 'UPC_Codigo',
                "columns": [
                    {
                        "data": "UPC_Codigo",
                        "defaultContent": "",
                        "className": "text-center", // Centraliza o conteúdo
                        "width": "10%" // Ajusta a largura da coluna
                    },
                    {
                        "data": "UPC_Descricao",
                        "defaultContent": "",
                        "className": "text-left", // Alinha o texto à esquerda
                        "width": "90%" // Ajusta a largura da coluna
                    }
                ],
                "initComplete": function () {
                    removeSpinner();
                }
            });

            $('#tableUPC tbody').on('click', 'tr', function () {
                console.log(arrayUpc[table.row(this).index()]);
                var selectedUpc = arrayUpc[table.row(this).index()];
                window.open('<?= base_url('EditaUnidadeContrato/') ?>' + selectedUpc.UPC_Codigo, '_self');
            });

            $('#btnNovoUpc').click(function() {
                window.open('<?php echo base_url('CriaUnidadeContrato/') ?>', '_self');  
            });

            function setInputTextHints() {

                $('#btnNovoUpc').prop('title', 'Criar novo Unidade Padrão do Contrato.' );
                $('#coUpcCodi').prop('title', 'Código (Id) do Unidade Padrão do Contrato.' );
                $('#coUpcDesc').prop('title', 'Descrição do Unidade Padrão do Contrato.' );
                             
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