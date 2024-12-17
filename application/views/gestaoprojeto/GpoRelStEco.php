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
    <title>wD Ogma StEco </title>

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
                        <h4 class="page-title">Relatório Status Econômico </h4>
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
                                    <div class="col-4">
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
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label"> Plano de Serviço (PPx) </label>
                                        <select class="form-control" id="comboboxPPx">
                                            <option value="0"> Todos os Plano de Serviço (PPx) ... </option>

                                            <?php foreach ($listaPjt as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['APELIDO'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
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
                                <div class="row">
                                    <div class="col-2">
                                        <br/><br/>
                                        <input type="checkbox"  id="checkboxFechaPlano" >
                                        <label class="text-left" for="checkboxFechaPlano">Fecha em Plano(s) de Serviço</label>
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
                                <!-- <br />
                                <div class="row">
                                    <div class="col-10">
                                        <!?php foreach ($listaCas as $item): ?>
                                            <input type="checkbox" name="PJTAcronimo" value="<!?= $item['CODIGO'] ?>" checked />
                                            <!?= $item['ACRONIMO'] . str_repeat('&nbsp;', 5) ?>
                                        <!?php endforeach; ?>
                                    </div>
                                </div> -->
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
                                            <h4 class="card-title">  Atividades / Planos de Serviço / Indicadores </h4>
                                            <small> Coloque o cursor sobre o título de cada coluna para informações sobre ela. </small>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='col00gere'> Gerente</th>
                                                <th id='col01plan'> Plano de Serviço</th>
                                                <th id='col02ativ'> Atvde<br/>id</th>
                                                <th id='col03desc'> Atividade<br/>Descrição </th>
                                                <th id='col04cham'> Chamado<br/>id</th>
                                                <th id='col12desd'> Desde<br/>(data)</th>
                                                <th id='col05esfo'> Esforço<br/>(h)</th>
                                                <th id='col06trab'> Trabalho<br/>(h)</th>
                                                <th id='col07hora'> Hora<br/>Unit.</th>
                                                <th id='col14aliq'> Imp.<br/>%</th>
                                                <th id='col08fatn'> Faturável<br/>NÃO</th>
                                                <th id='col09fats'> Faturável<br/>SIM</th>
                                                <th id='col10cust'> Custo<br/>Total</th>
                                                <th id='col11brut'> Lucro<br/>Bruto</th>
                                                <th id='col13copi'> <i class="fas fa-copy"></i> </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.60 - 20/06/2021</b><br/>
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
        $('#liGpoRelStEco').addClass('active');
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
        var selectedCli = null;
        var textDataFim = null;
        var checkFchPla = null;
        var checkFchGpo = null;

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAlertaGco = 'Selecione o gerente do projeto / plano de operação.';
        var vAlertaDt2 = 'Defina uma data final para a lista.';
        var vAlertaFpl = 'Marque para fechar atividades em apenas planos de serviço.';
        var vAlertaFge = 'Marque para fechar planos em apenas gerentes de projeto.';
        var vAlertaPjt = 'Selecione o plano de serviço.';
        var vAlertaCli = 'Selecione o cliente.';
        var vAlertaCplan = 'Coluna do apelido do Plano de Serviço.';
        var vAlertaCativ = 'Coluna do número da atividade.';
        var vAlertaCdesc = 'Coluna da descrição da atividade / chamado.';
        var vAlertaCcham = 'Coluna do número do chamado da atividade.';
        var vAlertaCdesd = 'Coluna do data do primeiro trabalho realizado na atividade/projeto.';
        var vAlertaCesfo = 'Coluna da quantidade de horas presvistas para a atividade / plano.';
        var vAlertaCtrab = 'Coluna da quantidade de horas trabalhadas na atividade / plano.';
        var vAlertaChora = 'Coluna do valor cobra do cliente para a atividade / plano.';
        var vAlertaCfatn = 'Coluna do valor NÃO faturável da atividade / plano.\nO que está deixando de ser faturado.\nJá descontado o imposto.';
        var vAlertaCfats = 'Coluna do valor faturável da atividade / plano.\nO que já foi ou ainda poderá ser faturado.\nJá descontado o imposto.';
        var vAlertaCcust = 'Coluna do valor do custo dos consultores na atividade / plano.';
        var vAlertaCbrut = 'Coluna do valor do lucro bruto da atividade / plano.\nValor faturável - Custo Total.';
        var vAlertaCaliq = 'Coluna da alíquota do imposto.\nInformada na configuração financeira do Plano de Serviços.';
        var vAlertaCcopi = 'Clique no ícone da linha para copiá-la para a área de transferência.';
        
        
        setInputTextHints();

        $('#optionselectedGpo').change(function() {
            console.log(this.value);

            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthPjt/" + this.value,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        var optionsPjtNome = [];
                        optionsPjtNome.push('<option value="0"> Todos os Plano de Serviço (PPx) ... </option>');
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
            selectedCli = ($('#comboboxCLI')[0].selectedIndex == 0) ? 0 : $('#comboboxCLI').val();
            textDataFim = dateToEN( $('#inputTextData2').val() );
            checkFchPla = $('#checkboxFechaPlano').is(":checked") ? 1 : 0;
            checkFchGpo = $('#checkboxFechaGpo').is(":checked") ? 1 : 0;
            
            console.log(selectedGpo);
            console.log(selectedPjt);
            console.log(selectedCli);
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
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fetchGpoRelStEco",
                    type: 'POST',
                    data: {
                        selectedGpo: selectedGpo,
                        selectedPjt: selectedPjt,
                        selectedCli: selectedCli,
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
                        "data": "CHAMADO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "DESDE",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "ESFORCO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "TRABALHO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "VR_HORA",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "ALIQUOTA",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VR_NAOFATURA",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VR_FATSEMIMPOSTO",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VR_CUSTO",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VR_REND",
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
                        "targets": [8,10,11,12,13],
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
            $('#comboboxCLI').prop('title', vAlertaCli );
            $('#inputTextData2').prop('title', vAlertaDt2 );
            $('#checkboxFechaPlano').prop('title', vAlertaFpl );
            $('#checkboxFechaGpo').prop('title', vAlertaFge );
            $('#col01plan').prop('title', vAlertaCplan );
            $('#col02ativ').prop('title', vAlertaCativ );
            $('#col03desc').prop('title', vAlertaCdesc );
            $('#col04cham').prop('title', vAlertaCcham );
            $('#col12desd').prop('title', vAlertaCdesd );
            $('#col05esfo').prop('title', vAlertaCesfo );
            $('#col06trab').prop('title', vAlertaCtrab );
            $('#col07hora').prop('title', vAlertaChora );
            $('#col08fatn').prop('title', vAlertaCfatn );
            $('#col09fats').prop('title', vAlertaCfats );
            $('#col10cust').prop('title', vAlertaCcust );
            $('#col11brut').prop('title', vAlertaCbrut );
            $('#col13copi').prop('title', vAlertaCcopi );
            $('#col14aliq').prop('title', vAlertaCaliq );
            
        
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