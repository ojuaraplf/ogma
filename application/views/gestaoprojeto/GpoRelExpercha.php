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
                        <h4 class="page-title">Extrato por período - Chamados </h4>
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
                                            <h4 class="card-title"> Chamados/Atividades</h4>
                                            <small> Lista de Chamados com trabalhos (apontamentos) executados durante o período analisado. </small>
                                            <small> Coloque o cursor sobre o título de cada coluna para informações sobre ela. </small>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='colChCodi'> CHD</th>
                                                <th id='colChDesc'> Descrição</th>
                                                <th id='colPlApel'> Plano de Serviço</th>
                                                <th id='colChStat'> Status</th>
                                                <th id='colChResp'> Responsável</th>
                                                <th id='colPlVlHR'> Valor Hora</th>
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
        $('#liExpercha__').addClass('active');
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
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function(data, row, column, node) {
                                    data = $('<p>' + data + '</p>').text();
                                    return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
                                    }
                            }
                        }
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
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/FetchExtrPeriodoChamado",
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
                        "data": "CHAMADO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "DESCRIÇÃO",
                        "defaultContent": "",
                        className: "text-left"
                    },
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
                        "data": "RESPONSÁVEL",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "VALOR_H",
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
                        "width": "24%",
                        "targets": [1],
                    },
                    {
                        // "width": "5%",
                        "targets": [8],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [9],
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
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [15],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
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
                    {
                        // "width": "5%",
                        "targets": [22],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        // "width": "5%",
                        "targets": [23],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                        },
                        "targets": [5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 17, 18, 19, 20, 21, 22, 23]
                    }
                ],

            });
        }
        
        function setInputTextHints() {
        
            $('#eInputDataDe').prop('title', vAledataDataIni );
            $('#eInputDataAt').prop('title', vAledataDataFim );
            $('#comboboxCLI').prop('title', vAlertaCli );

            $('#colChCodi').prop('title', 'Código (Id) do Chamado.' );
            $('#colChDesc').prop('title', 'Descrição do Chamado.' );
            $('#colPlApel').prop('title', 'Apelido do Plano de Serviço.' );
            $('#colChStat').prop('title', 'Status atual do Chamado.' );
            $('#colChResp').prop('title', 'Responsável pelo atendimento à solcitação do Chamado.' );
            $('#colPlVlHR').prop('title', 'Preço por hora cobrado do cliente no Plano de Serviço.' );
            $('#colChOrcH').prop('title', 'Número de horas orçado para o Chamado.' );
            $('#colChOrcR').prop('title', 'Preço do orçamento para o Chamado.');

            $('#colCpDesd').prop('title', 'NO PERÍODO ANALISADO.\nData do primeiro apontamento feito no atendimento à solicitação do chamado.' );
            $('#colCpExeH').prop('title', 'NO PERÍODO ANALISADO.\nNúmero de horas de trabalho já executado no atendimento ao Chamado.' );
            $('#colCpExeR').prop('title', 'NO PERÍODO ANALISADO.\nPreço do trabalho já executado no atendimento ao Chamado.' );
            $('#colCpAExH').prop('title', 'NO PERÍODO ANALISADO.\nNúmero de horas do trabalho faltante para completar o número de horas orçado.' );
            $('#colCpAExR').prop('title', 'NO PERÍODO ANALISADO.\nPreço do número de horas do trabalho faltante para completar o número de horas orçado.' );
            $('#colCpEstH').prop('title', 'NO PERÍODO ANALISADO.\nNúmero de horas do trabalho que excede o número de horas orçado.' );
            $('#colCpEstR').prop('title', 'NO PERÍODO ANALISADO.\nPreço do número de horas do trabalho que excede o número de horas orçado.' );
            $('#colCpCusR').prop('title', 'NO PERÍODO ANALISADO.\nCusto do Trabalho já executado no atendimento ao Chamado.\nExecutado(h) X Valor da hora do(s) consultor(es) executor(es).' );

            $('#colCtDesd').prop('title', 'NO CHAMADO TODO.\nData do primeiro apontamento feito no atendimento à solicitação do chamado.' );
            $('#colCtExeH').prop('title', 'NO CHAMADO TODO.\nNúmero de horas de trabalho já executado no atendimento ao Chamado.' );
            $('#colCtExeR').prop('title', 'NO CHAMADO TODO.\nPreço do trabalho já executado no atendimento ao Chamado.' );
            $('#colCtAExH').prop('title', 'NO CHAMADO TODO.\nNúmero de horas do trabalho faltante para completar o número de horas orçado.' );
            $('#colCtAExR').prop('title', 'NO CHAMADO TODO.\nPreço do número de horas do trabalho faltante para completar o número de horas orçado.' );
            $('#colCtEstH').prop('title', 'NO CHAMADO TODO.\nNúmero de horas do trabalho que excede o número de horas orçado.' );
            $('#colCtEstR').prop('title', 'NO CHAMADO TODO.\nPreço do número de horas do trabalho que excede o número de horas orçado.' );
            $('#colCtCusR').prop('title', 'NO CHAMADO TODO.\nCusto do Trabalho já executado no atendimento ao Chamado.\nExecutado(h) X Valor da hora do(s) consultor(es) executor(es).' );
        
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