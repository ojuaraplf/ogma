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
    <title>wD Ogma StGeral </title>

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
                        <h4 class="page-title">Extrato por período - Projetos </h4>
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
                                        <label for="eInputDataDe" class="text-left control-label col-form-label"> De: </label>
                                        <input type="date" value="<?php echo date('Y-m-01'); ?>"class="form-control" id="eInputDataDe" />
                                    </div>
                                    <div class="col-2">
                                        <label for="eInputDataAte" class="text-left control-label col-form-label"> Até: </label>
                                        <input type="date" value=<?php echo date('Y-m-t'); ?> class="form-control" id="eInputDataAte" />
                                    </div>
                                    <div class="col-4">
                                        
                                    </div>
                                    <div class="col-4">
                                        <label for="comboboxCLI" class="text-left control-label col-form-label"> Cliente </label>
                                        <select class="form-control" id="comboboxCLI">
                                            <option value="0"> Todos os clientes com Plano de Serviço (PPx) </option>

                                            <?php foreach ($listaCli as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['PESSOA'] ?>
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
                                            <h4 class="card-title">  Projetos </h4>
                                            <small> Lista de projetos com trabalhos (apontamentos) realizados durante o período. </small>
                                            <small> Coloque o cursor sobre o título de cada coluna para informações sobre ela. </small>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='colPlApel'> Plano de Serviço</th>
                                                <th id='colChStat'> Status</th>                                                
                                                <th id='colPlVlHR'> Valor<br/>Hora</th>
                                                <th id='colPjVlTO'> Valor<br/>Total</th>
                                                <th id='colChOrcH'> Orçado<br/>(h)</th>
                                                <th id='colChOrcR'> Orçado<br/>(R$)</th>

                                                <th id='colCpDesd'> INÍCIO<br/>Data</th>
                                                <th id='colCpExeH'> FEITO<br/>(h)</th>
                                                <th id='colCpExeR'> FEITO<br/>(R$)</th>
                                                <th id='colCpAExH'> FAZER<br/>(h)</th>
                                                <th id='colCpAExR'> FAZER<br/>(R$)</th>
                                                <th id='colCpEstH'> OVER<br/>(h)</th>
                                                <th id='colCpEstR'> OVER<br/>(R$)</th>
                                                <th id='colCpCusR'> CUSTO<br/>(R$)</th>

                                                <th id='colCtDesd'> Início<br/>Data</th>
                                                <th id='colCtExeH'> Feito<br/>(h)</th>
                                                <th id='colCtExeR'> Feito<br/>(R$)</th>
                                                <th id='colCtAExH'> Fazer<br/>(h)</th>
                                                <th id='colCtAExR'> Fazer<br/>(R$)</th>
                                                <th id='colCtEstH'> Over<br/>(h)</th>
                                                <th id='colCtEstR'> Over<br/>(R$)</th>
                                                <th id='colCtCusR'> Custo<br/>(R$)</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.20 - 05/06/2022</b><br/>
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
       
        $('#liGpo').addClass('selected');
        $('#liExpeproj').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divLista').hide();
        $('#divGeral').hide();

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAledataDataIni = 'Informe a data início do período desejado';
        var vAledataDataFim = 'Informe a data final do período desejado';
        var vAlertaCli = 'Selecione o cliente.';
        var dataDataIni = null;
        var dataDataFim = null;
        var selectedCli = null;
        setInputTextHints();

        $('#comboboxCLI').change(function() {
            ListaNaMarra();
        })

        $('#buttonListar').click(function() {
            ListaNaMarra();
        })
            
        ListaNaMarra();
       
        function ListaNaMarra() {

            var arrayLista = [];
            var table = $('#tableLista').DataTable();
            dataDataIni = $('#eInputDataDe').val();
            dataDataFim = $('#eInputDataAte').val();
            selectedCli = ($('#comboboxCLI')[0].selectedIndex == 0) ? 0 : $('#comboboxCLI').val();
            console.log(selectedCli);

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
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/FetchExtPeProj",
                    type: 'POST',
                    data: {
                        dataDataIni: dataDataIni,
                        dataDataFim: dataDataFim,
                        selectedCli: selectedCli
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
                    [1, "asc"]
                ],
                rowId: 'ID1',
                columns: [
                    {
                        "data": "PLANO",
                        "defaultContent": "",
                        className: "text-lelft"
                    },
                    {
                        "data": "STATUS",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "VALOR_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VALOR_PJT",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "ORCADO_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "ORCADO_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },

                    {
                        "data": "p_DESDE",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "p_EXECUTADO_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "p_EXECUTADO_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "p_A_EXECUTAR_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "p_A_EXECUTAR_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "p_ESTOURO_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "p_ESTOURO_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "p_CUSTO_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_DESDE",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_EXECUTADO_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_EXECUTADO_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_A_EXECUTAR_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_A_EXECUTAR_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_ESTOURO_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_ESTOURO_R$",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "t_CUSTO_R$",
                        "defaultContent": "",
                        className: "text-right"
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },

                columnDefs: [
                    {
                        "width": "30%",
                        "targets": [0],
                    },
                    {
                        // "width": "5%",
                        "targets": [6],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [7],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [08],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [09],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [10],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [11],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [12],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [13],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [14],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [15],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [16],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [17],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [18],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [19],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [20],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [21],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                        },
                        "targets": [2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20, 21]
                    }
                ],

            });
        }
        
        function setInputTextHints() {
        
            $('#eInputDataDe').prop('title', vAledataDataIni );
            $('#eInputDataAt').prop('title', vAledataDataFim );
            $('#comboboxCLI').prop('title', vAlertaCli );

            $('#colPlApel').prop('title', 'Apelido do Plano de Serviço.\nProjeto.' );
            $('#colChStat').prop('title', 'Status atual do Projeto.' );
            $('#colPlVlHR').prop('title', 'Preço por hora cobrado do cliente no Projeto.' );
            $('#colPjVlTO').prop('title', 'Preço total cobrado do cliente pelo Projeto.' );
            $('#colChOrcH').prop('title', 'Número de horas orçado.\nTotal do esforço estimado em atividades.' );
            $('#colChOrcR').prop('title', 'Preço do orçamento.\nPreço por hora cobrado X Número de horas orçado.');

            $('#colCpDesd').prop('title', 'Data do primeiro apontamento feito em trabalho pelo projeto.\nNO PERÍODO.' );
            $('#colCpExeH').prop('title', 'Número de horas de trabalho já executado no projeto.\nNO PERÍODO.' );
            $('#colCpExeR').prop('title', 'Preço do trabalho já executado no projeto.\nNO PERÍODO.' );
            $('#colCpAExH').prop('title', 'Número de horas do trabalho faltante para completar o número de horas orçado.\nNO PERÍODO.' );
            $('#colCpAExR').prop('title', 'Preço do número de horas do trabalho faltante para completar o número de horas orçado.\nNO PERÍODO.' );
            $('#colCpEstH').prop('title', 'Número de horas do trabalho que excede o número de horas orçado.\nNO PERÍODO.' );
            $('#colCpEstR').prop('title', 'Preço do número de horas do trabalho que excede o número de horas orçado.\nNO PERÍODO.' );
            $('#colCpCusR').prop('title', 'Custo do Trabalho já executado no projeto.\nExecutado(h) X Valor da hora do(s) consultor(es) executor(es).\nNO PERÍODO.' );

            $('#colCtDesd').prop('title', 'Data do primeiro apontamento feito em trabalho pelo projeto.\nNO PROJETO TODO.' );
            $('#colCtExeH').prop('title', 'Número de horas de trabalho já executado no projeto.\nNO PROJETO TODO.' );
            $('#colCtExeR').prop('title', 'Preço do trabalho já executado no projeto.\nNO PROJETO TODO.' );
            $('#colCtAExH').prop('title', 'Número de horas do trabalho faltante para completar o número de horas orçado.\nNO PROJETO TODO.' );
            $('#colCtAExR').prop('title', 'Preço do número de horas do trabalho faltante para completar o número de horas orçado.\nNO PROJETO TODO.' );
            $('#colCtEstH').prop('title', 'Número de horas do trabalho que excede o número de horas orçado.\nNO PROJETO TODO.' );
            $('#colCtEstR').prop('title', 'Preço do número de horas do trabalho que excede o número de horas orçado.\nNO PROJETO TODO.' );
            $('#colCtCusR').prop('title', 'Custo do Trabalho já executado no projeto.\nExecutado(h) X Valor da hora do(s) consultor(es) executor(es).\nNO PROJETO TODO.' );
        
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