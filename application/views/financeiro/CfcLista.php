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

        #tableCFC tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-currency-usd"></i> Lista de Condição de Faturamento </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista de Condição de Faturamento</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid flex-grow-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoCfc">
                            <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tableCFC" class="table table-hover">
                                    <thead>
                                        <tr>                                            
                                            <th id='coCfcCodi'>Código</th>
                                            <th id='coCfcDesc'>Descrição</th>
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
                © 2019 wDiscover Ltda - CfcLista: vs00.02 20240824
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
/*
            $('#liConfiguracao').addClass('selected');
            $('#liStc').addClass('active');
            $('#ulConfiguracao').addClass('in');
*/

            var arrayCfc = [];            
            var table = $('#tableCFC').DataTable({
                "destroy": true,
                "searching": false,
                "retrieve": true,
                "paging": false,
                "sAjaxDataProp": "",
                "responsive": true, // Tabela responsiva
                "info": false, // Remove a informação sobre quantidade de registros
                "ajax": {
                    "url": "<?= base_url('financeiro/CfcLista/fetchCfc'); ?>",
                    "type": 'POST',
                    "dataType": 'json',
                    complete: function (response) {
                        arrayCfc = response.responseJSON;                        
                    },
                    error: function (e) {
                        console.error(e);
                    }
                },
                "language": {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                "order": [[0, 'asc']],
                "rowId": 'CFC_Codigo',
                "columns": [
                    {
                        "data": "CFC_Codigo",
                        "defaultContent": "",
                        "className": "text-center", // Centraliza o conteúdo
                        "width": "10%" // Ajusta a largura da coluna
                    },
                    {
                        "data": "CFC_Descricao",
                        "defaultContent": "",
                        "className": "text-left", // Alinha o texto à esquerda
                        "width": "90%" // Ajusta a largura da coluna
                    }
                ],
                "initComplete": function () {
                    removeSpinner();
                }
            });

            $('#tableCFC tbody').on('click', 'tr', function () {
                console.log(arrayCfc[table.row(this).index()]);
                var selectedCfc = arrayCfc[table.row(this).index()];
                window.open('<?= base_url('EditaCondicaoFaturamento/') ?>' + selectedCfc.CFC_Codigo, '_self');
            });

            $('#btnNovoCfc').click(function() {
                window.open('<?php echo base_url('CriaCondicaoFaturamento/') ?>', '_self');  
            });

            function setInputTextHints() {

                $('#btnNovoCfc').prop('title', 'Criar nova Condição de Faturamento.' );
                $('#coCfcCodi').prop('title', 'Código (Id) da Condição de Faturamento.' );
                $('#coCfcDesc').prop('title', 'Descrição da Condição de Faturamento.' );
                             
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