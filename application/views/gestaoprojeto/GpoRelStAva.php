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
    <title>wD Ogma StAva </title>

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
                        <h4 class="page-title">Relatório Análise do Valor Agregado </h4>
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

                                <div class="row">
                                    <div class="col-3">
                                        <label for="" class="text-left control-label col-form-label"> Gerente de Projeto </label>
                                        <select class="form-control" id="optionselectedGpo">
                                            <option value="0"> Todos os gerentes ... </option>

                                            <?php foreach ($listaGco as $item): ?>
                                            <option value="<?= $item['CODIGO']?>" <?= $this->session->userdata('userCodigo') == $item['CODIGO'] ? "selected" : "" ?>>
                                                <?= $item['NOME'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="" class="text-left control-label col-form-label"> Plano de Serviço (PPx) </label>
                                        <select class="form-control" id="comboboxPPx">
                                            <option value="0"> Todos os planos de serviço ... </option>

                                            <?php foreach ($listaPjt as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['APELIDO'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <br/><br/>
                                        <input type="checkbox"  id="checkboxFechaPlano" >
                                        <label class="text-left" for="checkboxFechaPlano">Fecha em plano(s)</label>
                                    </div>
                                    <div class="col-2">
                                        <br/><br/>
                                        <input type="checkbox" id="checkboxFechaGpo" >
                                        <label class="text-left" for="checkboxFechaGpo">Fecha em gerente(s)</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label"> Até </label>
                                        <input type="text" value=<?php echo date('d/m/Y'); ?> class="form-control" id="inputTextData2" />
                                        <div class="invalid-feedback">
                                        <span id=""> Data incorreta. </span>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-12">
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
                                            <h4 class="card-title"> Atividades / Planos de Serviço / Indicadores </h4>
                                            <small> Coloque o cursor sobre o título de cada coluna para informações sobre ela. </small>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='col00gere'> Gerente</th>
                                                <th id='col01plan'> Plano de Serviço<br/>Apelido</th>
                                                <th id='col02ativ'> Atvde<br/>id</th>
                                                <th id='col03desc'> Atividade<br/>Descrição </th>
                                                <th id='col04desd'> Desde<br/>(data)</th>
                                                <th id='col05prto'> Prazo<br/>Total</th>
                                                <th id='col06prve'> Prazo<br/>Ido</th>
                                                <th id='col07nrco'> <i class="fas fa-users"></i> </th>
                                                <th id='col08reme'> Remun.<br/>Média</th>
                                                <th id='col09cont'> ONT<br/>Custo</th>
                                                <th id='col10cuvp'> VP<br/>Custo</th>
                                                <th id='col11cuva'> VA<br/>Custo</th>
                                                <th id='col12cucr'> CR<br/>Custo</th>
                                                <th id='col13iidp'> IDP<br/>Índice</th>
                                                <th id='col14iidc'> IDC<br/>Índice</th>
                                                <th id='col15copi'> <i class="fas fa-copy"></i> </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.80 - 17/07/2021</b><br/>
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
        $('#liGpoRelStAva').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divLista').hide();
        $('#divGeral').hide();

        $('#inputTextData2').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "dd/mm/yyyy",
            orientation: "bottom",
            maxViewMode: 1
        });
        

        var arrayLista = [];
        var table = $('#tableLista').DataTable();
        var selectedGpo = null;
        var selectedPjt = null;
        var textDataFim = null;
        var checkFchPla = null;
        var checkFchGpo = null;

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAlertaGco = 'Selecione o gerente do projeto / plano de operação.';
        var vAlertaDt2 = 'Defina uma data final para a lista.';
        var vAlertaFpl = 'Marque para fechar atividades em apenas planos de serviço.';
        var vAlertaFge = 'Marque para fechar planos em apenas gerentes de projeto.';
        var vAlertaPjt = 'Selecione o plano de serviço.';

        var vAlertacolplan = 'Coluna do apelido do Plano de Serviço.';
        var vAlertacolativ = 'Coluna do código (id) da atividade.';
        var vAlertacoldesc = 'Coluna da descrição da atividade.';
        var vAlertacoldesd = 'Coluna do data do primeiro trabalho realizado na atividade/projeto.';
        var vAlertacolprto = 'Coluna do Prazo Total:\nTotal de horas úteis entre a data inicial e a data final previstas para a atividade/projeto.';
        var vAlertacolprve = 'Coluna do Prazo Vencido:\nTotal de horas úteis entre a data inicial e a data final ou a status date ("Até:") - a que for menor - previstas para a atividade/projeto.';
        var vAlertacolnrco = 'Coluna do Número de Consultores Atuantes na atividade/projeto.';
        var vAlertacolreme = 'Coluna do valor da Remuneração Média paga aos consultores atuantes na atividade/projeto:\n[Remuneração Total / Trabalho Total / Número de Consultores Atuantes].' ;
        var vAlertacolcont = 'Coluna do Valor Orçado No Término (ONT):\nValor do custo orçado total para a atividade/projeto:\n[Esforço Total x Remuneração Média].';
        var vAlertacolcuvp = 'Coluna do Valor Planejado (VP) no orçamento até a Status Date ("Até:"):\nValor do custo orçado até a Status Date ("Até:"):\n[ONT X (Prazo Vencido / Prazo Total)].';
        var vAlertacolcuva = 'Coluna do Valor Agregado (VA) até a Status Date ("Até:"):\n[Esforço Aprontado x Renuneração Média].';
        var vAlertacolcucr = 'Coluna do valor do Custo Real (CR):\n[Trabalho Total X Remuneração/hora do Consultor Atuante].';
        var vAlertacoliidp = 'Coluna do Índice do Desempenho de Prazo (IDP):\n[VA / VP].\n < 1 : Atividade/projeto atrasada(o);\n > 1 : Atividade/projeto adiantada(o);\n = 1 : Atividade/projeto no prazo(o).';
        var vAlertacoliidc = 'Coluna do Índice do Desempenho de Custo (IDP):\n[VA / CR].\n < 1 : Atividade/projeto estourando;\n > 1 : Atividade/projeto economizando;\n = 1 : Atividade/projeto on budget.';
        var vAlertacolcopi = 'Clique no ícone da linha para copiá-la para a área de transferência.';
        
        setInputTextHints();

        $('#optionselectedGpo').change(function() {
            console.log(this.value);

            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthPjt/" + this.value,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        var optionsPjtNome = [];
                        optionsPjtNome.push('<option value="0"> Todos os planos de serviço ... </option>');
                        response.listaPjt.forEach(function(e) {
                            optionsPjtNome.push('<option value="' + e.CODIGO + '"> ' + e.APELIDO + ' </option>')
                        });
                        $('#comboboxPPx').html(optionsPjtNome);
                        console.log(response);
                    }
                });
        });

        $('#buttonListar').click(function() {

            // if( $('#comboboxMes').val() == '0' )
            //     {
            //     document.getElementById('comboboxMes').focus();
            //     Swal.fire(
            //         'Ops!',
            //         vAlertaMes,
            //         'warning'
            //     )
            //     return;
            // }

            selectedGpo = ($('#optionselectedGpo')[0].selectedIndex == 0) ? 0 : $('#optionselectedGpo').val();
            selectedPjt = ($('#comboboxPPx')[0].selectedIndex == 0) ? 0 : $('#comboboxPPx').val();
            textDataFim = dateToEN( $('#inputTextData2').val() );
            checkFchPla = $('#checkboxFechaPlano').is(":checked") ? 1 : 0;
            checkFchGpo = $('#checkboxFechaGpo').is(":checked") ? 1 : 0;
            
            console.log(selectedGpo);
            console.log(selectedPjt);
            console.log(textDataFim);
            console.log(checkFchPla);
            console.log(checkFchGpo);

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

                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fetchGpoRelStAva",
                    type: 'POST',
                    data: {
                        selectedGpo: selectedGpo,
                        selectedPjt: selectedPjt,
                        textDataFim: textDataFim,
                        checkFchPla: checkFchPla,
                        checkFchGpo: checkFchGpo
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                // "scrollX": true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [1, "asc"]
                ],
                rowId: 'ID1',
                columns: [
                    {
                        "data": "GERENTE",
                        "defaultContent": ""
                    },
                    {
                        "data": "PLANO",
                        "defaultContent": ""
                    },
                    {
                        "data": "ATIVIDADE",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "DESCRICAO",
                        "defaultContent": ""
                    },
                    {
                        "data": "DESDE",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "PRAZOTOTAL",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "PRAZOVENCIDO",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "NROCONSU",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "REMMED",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "ONT",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VP",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VA",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "CR",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "IDP",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "IDC",
                        "defaultContent": "",
                        className: "text-right"
                    },

                    {
                        "data": "TXT",
                        "defaultContent": "",
                        'render': function (data, type, row) {
                            var copyTapped = "copyTapped('" + row.TXT + "')";
                            return '<button class="btn btn-clear" id="' + row.id +'" onclick="' + copyTapped + '"> <i class="fas fa-copy"></i> </button>';
                        },
                        className: "text-right"
                    }
                    
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },

                columnDefs: [
                    {
                        "width": "16%",
                        "targets": [1],
                    },
                    {
                        "width": "24%",
                        "targets": [3],
                    },
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                        },
                        "targets": [8,9,10,11,12],
                    }
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
            $('#optionselectedGpo').prop('title', vAlertaGco );
            $('#comboboxPPx').prop('title', vAlertaPjt );
            $('#inputTextData2').prop('title', vAlertaDt2 );
            $('#checkboxFechaPlano').prop('title', vAlertaFpl );
            $('#checkboxFechaGpo').prop('title', vAlertaFge );

            $('#col01plan').prop('title', vAlertacolplan );
            $('#col02ativ').prop('title', vAlertacolativ );
            $('#col03desc').prop('title', vAlertacoldesc );
            $('#col04desd').prop('title', vAlertacoldesd );
            $('#col05prto').prop('title', vAlertacolprto );
            $('#col06prve').prop('title', vAlertacolprve );
            $('#col07nrco').prop('title', vAlertacolnrco );
            $('#col08reme').prop('title', vAlertacolreme );
            $('#col09cont').prop('title', vAlertacolcont );
            $('#col10cuvp').prop('title', vAlertacolcuvp );
            $('#col11cuva').prop('title', vAlertacolcuva );
            $('#col12cucr').prop('title', vAlertacolcucr );
            $('#col13iidp').prop('title', vAlertacoliidp );
            $('#col14iidc').prop('title', vAlertacoliidc );
            $('#col15copi').prop('title', vAlertacolcopi );

            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

        function dateToEN(date) {	
	        return date.split('/').reverse().join('-');
        }

    </script>
</body>

</html> 