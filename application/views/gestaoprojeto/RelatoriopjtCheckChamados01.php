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
    <title>Check Chamados</title>

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
                        <h4 class="page-title">Relatório Check Chamados </h4>
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

                                <div class="row mb-3">

                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label"> Plano de Operação </label>
                                        <select class="form-control" id="comboboxPPx">
                                            <option> Listar todos os Planos com chamado ... </option>

                                            <?php foreach ($listaPjt as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['APELIDO'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <input type="checkbox" id="checkboxpFechaEmPlano" checked>
                                        <label class="text-left" for="checkboxpFechaEmPlano">Fecha em Planos</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="checkboxpIncluiChdInativo" checked >
                                        <label class="text-left" for="checkboxpIncluiChdInativo">Inclui chamados inativos</label>
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="buttonRelatorio"> Listar indicadores</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divRelatorio">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Indicadores </h4>
                                            <small> Coloque o cursor sobre o título de cada coluna para informações sobre ela. </small>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableRelatorio">
                                        <thead>
                                            <tr>
                                                <th id='col01descr'> Descrição</th>
                                                <th id='col02chama'> Chamado<br/>(id)</th>
                                                <th id='col03statu'> Status<br/>atual</th>
                                                <th id='col04orcam'> Orçam<br/>(h)</th>
                                                <th id='col05ok'> Ok<br/>(%) </th>
                                                <th id='col06traba'> Trlho<br/>(h)</th>
                                                <th id='col07inici'> Início<br/>(data hora)</th>
                                                <th id='col08vctop'> Vcto<br/>Prev</th>
                                                <th id='col09vctoi'> Vcto<br/>Informado</th>
                                                <th id='col10ev'> EV</th>
                                                <th id='col11preco'> Preço<br/>(R$)</th>
                                                <th id='col12custo'> Custo<br/>(R$)</th>
                                                <th id='col13lucrd'> Lucrdde<br/>(%)</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                    <b>Versão beta: rev00.10 - 05/04/2021</b><br/>
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
    <?php $this->load->view('modal/modalRelatorioApontamentoHora') ?>

    <script type="text/javascript">
        removeSpinner();

        setInputTextHints();

        $('#liGpo').addClass('selected');
        $('#liListaCeckChamado').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divRelatorio').hide();


        var arrayRelatorio = [];
        var table = $('#tableRelatorio').DataTable();
        var selectedPjt = null;

        $('#buttonRelatorio').click(function() {

            selectedPjt = ($('#comboboxPPx')[0].selectedIndex == 0) ? null : $('#comboboxPPx').val();
            
            var pFechaEmPlano = $('#checkboxpFechaEmPlano').is(":checked") ? 1 : 0;
            var pIncluiChdInativo = $('#checkboxpIncluiChdInativo').is(":checked") ? 1 : 0;

            $('#col01descr').text(pFechaEmPlano ==0 && $('#comboboxPPx')[0].selectedIndex != 0 ? "Atividade" : "Plano de Serviço" );

            loadSpinner();
            $('#tableRelatorio').DataTable().clear().destroy();
            table = $('#tableRelatorio').DataTable({
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

                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/RelatoriopjtCheckChamados01/fetchRelatoriopjtCheckChamados01",
                    type: 'POST',
                    data: {
                        selectedPjt: selectedPjt,
                        pFechaEmPlano: pFechaEmPlano,
                        pIncluiChdInativo: pIncluiChdInativo
                    },
                    complete: function(response) {
                        arrayRelatorio = JSON.parse(response.responseText);
                        $('#divRelatorio').show();
                    }
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [1, "asc"]
                ],
                rowId: 'ID1',
                columns: [
                    {
                        "data": "DESCRICAO",
                        "defaultContent": ""
                    },
                    {
                        "data": "CHAMADO",
                        "defaultContent": ""
                    },
                    {
                        "data": "STATUS",
                        "defaultContent": ""
                    },     
                    {
                        "data": "ORCAM (h)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "OK (%)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "TRLHO (h)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "INICIO",
                        "defaultContent": ""
                    },
                    {
                        "data": "VENCTO PREV",
                        "defaultContent": ""
                    },
                    {
                        "data": "VENCTO INFORMADO",
                        "defaultContent": ""
                    },
                    {
                        "data": "EV",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "PRECO (R$)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "CUSTO (R$)",
                        "defaultContent": "",
                        className: "text-right"
                        // number_format($numero, 2, ',','.');
                    },
                    {
                        "data": "LUCRDDE (%)",
                        "defaultContent": "",
                        className: "text-right"
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
               
                columnDefs: [
                    {
                        'orderable': false,
                        'targets': 0
                    },
                    {
                        "width": "25%",
                        "targets": [0],

                    },
                    {
                        "width": "2%",
                        "targets": [10],

                    },
                ],
            });
        });
        
        function copyTapped(txt) {
            var $temp = $("<textarea>");
            $("body").append($temp);
            $temp.val(txt.replace(/\QQ/g, '\n')).select();
            document.execCommand("copy");
            $temp.remove();
            
            Swal.fire(
                'Aviso',
                'Linha copiada!',
                'success'
            )
        }



        function setInputTextHints() {
            $('#checkboxpFechaEmPlano').prop('title', 'Marque se você quiser listar os Planos de Operação e não as atividades.');
            $('#comboboxPPx').prop('title', 'Selecione um PPS específico para ver os indicadores apenas dele ou deixe em Listar todos.');
            $('#checkboxpIncluiChdInativo').prop('title', 'Marque se quiser incluir os chamados inativos na listagem.');
            $('#buttonRelatorio').prop('title', 'Clique para listar - clique também após cada alteração nas opções do cabeçalho.');
            $('#col01descr').prop('title', 'Coluna do título:\nAberto em Chamados: Título da atividade.\nFechado em Plano de Serviço: Apelido do Plano de Operação de Serviço.');
            $('#col02chama').prop('title', 'Coluna do número do chamado:\nAberto em Chamados: Número do Chamado da linha;\nFechado em Plano de Serviço: Maior número de Chamado do Plano de Operação de Serviço.');
            $('#col03statu').prop('title', 'Coluna do Status Atual:\nAberto em Chamados: Status atual do Chamado da linha;\nFechado em Plano de Serviço: Status atual do Plano de Operação de Serviço.');
            $('#col04orcam').prop('title', 'Coluna do Orçamento:\nAberto em Chamados: Esforço previsto para o Chamado/atividade da linha;\nFechado em Plano de Serviço: Total do esforço previsto para os Chamados/atividades do Plano de Operação de Serviço.');
            $('#col05ok').prop('title', 'Coluna do Percentual de Aprontamento:\nAberto em Chamados: Percentual aprontado do esforço orçado para o Chamado/atividade da linha;\nFechado em Plano de Serviço: Percentual aprontado do esforço total orçado para os Chamados/atividades do Plano de Operação de Serviço.');
            $('#col06traba').prop('title', 'Coluna do Trabalho Realizado:\nAberto em Chamados: Trabalho já realizado no Chamado/atividade da linha;\nFechado em Plano de Serviço: Trabalho realizado nos Chamados/atividades do Plano de Operação de Serviço.');
            $('#col07inici').prop('title', 'Coluna do Início dos Trabalhos:\nAberto em Chamados: Data e hora informadas para início da Atividade da linha; se inexistente, data e hora do início do primeiro trabalho realizado na Atividade da linha.\nFechado em Plano de Serviço: Data e hora informadas para início da primeira Atividade do Plano de Operação de Serviço; se inexistente, data e hora do início do primeiro trabalho realizado para o Plano de Operação de Serviço.');
            $('#col08vctop').prop('title', 'Coluna do Vencimento Previsto:\nAberto em Chamados: Data e hora previstas para a entrega do serviço, partindo da data e hora de Início com o tempo em horas do Orçamento para o chamado/atividade da linha.\nFechado em Plano de Serviço: Data e hora previstas para a entrega de todos os serviços, partindo da data e hora de Início com o total de tempo em horas do Orçamento para chamados/atividades (não serve para prever o final).');
            $('#col09vctoi').prop('title', 'Coluna do Vencimento Informado:\nAberto em Chamados: Data e hora estimadas para término da atividade da linha em suas configurações.\nFechado em Plano de Serviço: As maiores data e hora estimadas para o término entre todas as atividades.');
            $('#col10ev').prop('title', 'Coluna do índice de valor agregado: trabalho / esforço aprontado. \nPor convenção:\n- EV entre 0,75 e 1,25, indica andamento ideal do serviço;\n- EV menor que 0,75 indica provável atraso do serviço;\n- EV maior que 1,25 indica provável gasto demasiado no serviço.');
            $('#col11preco').prop('title', 'Coluna do preço: Orçamento X preço hora vendido para o cliente (investimento).');
            $('#col12custo').prop('title', 'Coluna do custo: Trabalho X remuneração hora.');
            $('#col13lucrd').prop('title', 'Coluna do índice da lucratividade: Trabalho X remuneração hora / Orçamento X preço hora vendido.');
            
            
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