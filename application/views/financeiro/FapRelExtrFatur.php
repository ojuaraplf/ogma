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
    <title>wD Ogma Pré-faturamento </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        #tableApontamentoHoras tbody tr {
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
                    <h3 class="page-title"> <i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i> Pré-fatura: Extrato </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"> Home</li>
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
                            <h5> Período analisado: </h5>
                                <div class="row">
                                    <div class="col-2">
                                        <label for="eInputDataDe" class="text-left control-label col-form-label"> Desde </label>
                                        <input type="text" id="eInputDataDe" value=<?php echo date('01/2015'); ?> class="form-control" />
                                    </div>
                                    <div class="col-2">
                                        <label for="eInputDataAte" class="text-left control-label col-form-label"> Até </label>
                                        <input type="text" id="eInputDataAte" value=<?php echo date('m/Y'); ?> class="form-control" />
                                    </div>
                                    <div class="col-4">
                                        
                                    </div>
                                    <div class="col-4">
                                        <label for="comboboxPpx" class="text-left control-label col-form-label"> Plano de Serviços </label>
                                        <select class="form-control" id="comboboxPpx">
                                            <option value="0"> Selecione o Plano de Serviço </option>
                                            <?php foreach ($listaPjx as $item): ?>
                                                <option value="<?= $item['CODIGO'] ?>">
                                                    <?= $item['APELIDO'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-3">
                                        <button class="btn btn-primary" id="buttonListar"> Listar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divLista">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">                                
                                    <div class="row">
                                        <div class="col-12">                                            
                                            <small> Apontamentos com ou sem pré-fatura, mês a mês, no período analisado. </small>
                                            <small> Coloque o cursor sobre o título de cada coluna para informações sobre ela. </small>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='colMesAno'> Mês/Ano</th>
                                                <th id='colTraNao'> TRABALHADAS<br/>Não faturáveis</th>
                                                <th id='colTraSim'> TRABALHADAS<br/>Faturáveis</th>                                                                                                
                                                <th id='colTraTot'> TRABALHADAS<br/>Total</th>
                                                <th id='colhAcumu'> ACUMULADAS</th>

                                                <th id='colFatNao'> FATURADAS<br/>Não faturáveis</th>
                                                <th id='colhAcumu'> FATURADAS<br/>Faturáveis</th>
                                                <th id='colhFatur'> FATURADAS<br/>Total</th>

                                                <th id='colhSaldo'> SALDO</th>

                                                <th id='colfFapId'> FAP<br/>Id</th>
                                                <th id='colfFapNf'> NF<br/>Número</th>
                                                <th id='colfFapDt'> Emissão<br/>Data</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                    <b>Versão Beta: 00.20 - 20/08/2022</b><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>

    <script type="text/javascript">
        removeSpinner();
       
        $('#liFinanceiro').addClass('selected');
        $('#liFapExtrato').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divLista').hide();
        $('#divGeral').hide();

        // textos para validação/orientação do preenchimento de alguns principais campos:        
        var vAledataDataIni = 'Informe a mês início do período desejado';
        var vAledataDataFim = 'Informe a mês final do período desejado';
        var vAlertaPpx = 'Selecione o Plano de Serviços.';

        var dataDataIni = null;
        var dataDataFim = null;
        var selectedPpx = null;
        setInputTextHints();

        $('#comboboxPpx').change(function() {
            ListaNaMarra();
        })

        $('#buttonListar').click(function() {
            ListaNaMarra();
        })

        $('#comboboxPpx').select2();
       
        function ListaNaMarra() {

            if ($('#eInputDataDe').val() == "") {
                Swal.fire(
                    'Aviso',
                    vAledataDataIni,
                    'warning'
                )
                return;
            }

            if ($('#eInputDataAte').val() == "") {
                Swal.fire(
                    'Aviso',
                    vAledataDataFim,
                    'warning'
                )
                return;
            }

            if ($('#comboboxPpx').val() == 0) {
                Swal.fire(
                    'Aviso',
                    vAlertaPpx,
                    'warning'
                )
                return;
            }

            var arrayLista = [];
            var table = $('#tableLista').DataTable();
            
            dataDataIni = $('#eInputDataDe').val().substring(3, 7)+'-'+($('#eInputDataDe').val()).substring(0, 2);
            dataDataFim = $('#eInputDataAte').val().substring(3, 7)+'-'+($('#eInputDataAte').val()).substring(0, 2);            
            selectedPpx = ($('#comboboxPpx')[0].selectedIndex == 0) ? 0 : $('#comboboxPpx').val();
            console.log(dataDataIni);
            console.log(dataDataFim);
            console.log(selectedPpx);

            loadSpinner();
            $('#tableLista').DataTable().clear().destroy();
            table = $('#tableLista').DataTable({

                dom: 'Bfrtip',
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
                fixedHeader: true,
                //scrollX: true, comentado porque bagunça entre colunas e cabeçalho.

                ajax: {
                    url: "<?php echo base_url(); ?>financeiro/FapLista/fetchExtratoFaturamento",
                    type: 'POST',
                    data: {
                        pMesMenor: dataDataIni,
                        pMesMaior: dataDataFim,
                        pPJTCodigo: selectedPpx
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [0, "asc"]
                ],
                rowId: '',
                columns: [
                    {
                        "data": "dMESANO",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {
                            return "<span style='display: none;'>" + data.substring(3, 7) + data.substring(0, 2) + "</span>" + data;
                        }
                    },

                    {
                        "data": "hNAOFATURAVEL",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },
                    {
                        "data": "hFATURAVEL",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },
                    {
                        "data": "hTRABALHO",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },

                    {
                        "data": "hACUMULADA",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },

                    {
                        "data": "hFATURADA_N",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },
                    {
                        "data": "hFATURADA_S",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },
                    {
                        "data": "hFATURADA",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },

                    {
                        "data": "hSALDO",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            return data == null ? '0,00' : data;
                        }
                    },
                    {
                        "data": "fapID",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "fapNF",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "fapEMISSAO",
                        "defaultContent": "",
                        className: "text-center"
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                
                columnDefs: [
                    {
                        "width": "6%",
                        "targets": [0],
                    },
                    {
                        "width": "7%",
                        "targets": [1],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                            }
                    },
                    {
                        "width": "7%",
                        "targets": [2],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        "width": "7%",
                        "targets": [3]
                    },
                    {
                        "width": "7%",
                        "targets": [4]
                    },
                    {
                        "width": "7%",
                        "targets": [5],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                            }
                    },
                    {
                        "width": "7%",
                        "targets": [6],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        "width": "7%",
                        "targets": [7]
                    },
                    {
                        "width": "7%",
                        "targets": [8]
                    },
                    {
                        "width": "14%",
                        "targets": [9]
                    },
                    {
                        "width": "15%",
                        "targets": [10]
                    },                    {
                        "width": "15%",
                        "targets": [11]
                    },
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                        },
                        "targets": [1, 2, 3, 4, 5, 6]
                    }
                ],

            });
        }
        
        $('#eInputDataDe').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            orientation: 'bottom'
        });

        $('#eInputDataAte').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            orientation: 'bottom'
        });

        function setInputTextHints() {
        
           $('#eInputDataDe').prop('title', 'Escolha um mês inicial para o período analisado.' );
           $('#eInputDataAte').prop('title', 'Escolha um mês final para o período analisado.' );
           $('#comboboxPpx').prop('title', 'Selecione um Plano de Serviços.\nDigite na pesquisa para facilitar.' );

           $('#colTraNao').prop('title', 'Total de horas trabalhadas no mês,\nem atividades NÃO faturáveis.' );
           $('#colTraSim').prop('title', 'Total de horas trabalhadas no mês,\nem atividades FATURÁVEIS.' );
           $('#colTraTot').prop('title', 'Total de horas trabalhadas no mês.' );
           $('#colhAcumu').prop('title', 'Total de horas trabalhadas acumuladas até o mês.' );
           $('#colhFatur').prop('title', 'Total de horas trabalhadas e pré-faturadas no mês.' );
           $('#colhSaldo').prop('title', 'Saldo de horas até o mês:\nHoras acumuladas -\nHoras pré-faturadas.' );
           $('#colfFapId').prop('title', 'Id da FAP:\nPoderão ter mais de uma FAP emitida para o Plano num mesmo mês.' );
           $('#colfFapNf').prop('title', 'Número da Nota Fiscal (NF):\nPoderão ter mais de uma NF emitida para o plano num mesmo mês.' );
           $('#colfFapDt').prop('title', 'Data de emissão da FAP:\nPoderão ter mais de uma FAP emitida para o Plano num mesmo mês.' );
        
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