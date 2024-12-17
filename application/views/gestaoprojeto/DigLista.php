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
    <title>wD Ogma Gestão de Recursos </title>

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
                        <h4 class="page-title">Gestão de Recursos - DIG </h4>
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
                                    <div class="col-5">
                                        <label for="" class="text-left control-label col-form-label"> Gerente de Projeto </label>
                                        <select class="form-control" id="optionselectedGco">
                                            <option value="0"> Todos os gerentes ... </option>

                                            <?php foreach ($listaGco as $item): ?>
                                            <option value="<?= $item['CODIGO']?>" <?= $this->session->userdata('userCodigo') == $item['CODIGO'] ? "selected" : "" ?>>
                                                <?= $item['NOME'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-5">
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
                                        <label for="" class="text-left control-label col-form-label"> Ano / mês </label>
                                        <select class="form-control" id="comboboxMes">
                                            <option value="0">  Selecione o ano / mês. </option>

                                            <?php foreach ($listaMes as $item): ?>
                                            <option value="<?= $item['MES'] ?>">
                                                <?= $item['MES'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
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
                                            <h4 class="card-title">Previsões </h4>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='col01cons'> Consultor</th>
                                                <th id='col02plan'> Plano</th>

                                                <th id='col03sem1'> Semana<br/>S1</th>
                                                <th id='col04pre1'> S1<br/>P(%)</th>
                                                <th id='col05rea1'> S1<br/>R(%)</th>
                                                
                                                <th id='col06sem2'> Semana<br/>S2</th>
                                                <th id='col07pre2'> S2<br/>P(%)</th>
                                                <th id='col08rea2'> S2<br/>R(%)</th>
                                                
                                                <th id='col09sem3'> Semana<br/>S3</th>
                                                <th id='col10pre3'> S3<br/>P(%)</th>
                                                <th id='col11rea3'> S3<br/>R(%)</th>
                                                
                                                <th id='col12sem4'> Semana<br/>S4</th>
                                                <th id='col13pre4'> S4<br/>P(%)</th>
                                                <th id='col14rea4'> S4<br/>R(%)</th>
                                                
                                                <th id='col15sem5'> Semana<br/>S5</th>
                                                <th id='col16pre5'> S5<br/>P(%)</th>
                                                <th id='col17rea5'> S5<br/>R(%)</th>
                                                
                                                <th id='col18sem6'> Semana<br/>S6</th>
                                                <th id='col19pre6'> S6<br/>P(%)</th>
                                                <th id='col20rea6'> S6<br/>R(%)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.60 - 23/05/2021</b><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <div class="container-fluid">
                <div class="row" id="divGeral">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Geral </h4>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tablegLista">
                                        <thead>
                                            <tr>
                                                <th id='colg01cons'> Consultor</th>
                                                <th id='colg02plan'> Plano</th>

                                                <th id='colg03sem1'> Semana<br/>S1</th>
                                                <th id='colg04pre1'> S1<br/>P(%)</th>
                                                <th id='colg05rea1'> S1<br/>R(%)</th>
                                                
                                                <th id='colg06sem2'> Semana<br/>S2</th>
                                                <th id='colg07pre2'> S2<br/>P(%)</th>
                                                <th id='colg08rea2'> S2<br/>R(%)</th>
                                                
                                                <th id='colg09sem3'> Semana<br/>S3</th>
                                                <th id='colg10pre3'> S3<br/>P(%)</th>
                                                <th id='colg11rea3'> S3<br/>R(%)</th>
                                                
                                                <th id='colg12sem4'> Semana<br/>S4</th>
                                                <th id='colg13pre4'> S4<br/>P(%)</th>
                                                <th id='colg14rea4'> S4<br/>R(%)</th>
                                                
                                                <th id='colg15sem5'> Semana<br/>S5</th>
                                                <th id='colg16pre5'> S5<br/>P(%)</th>
                                                <th id='colg17rea5'> S5<br/>R(%)</th>
                                                
                                                <th id='colg18sem6'> Semana<br/>S6</th>
                                                <th id='colg19pre6'> S6<br/>P(%)</th>
                                                <th id='colg20rea6'> S6<br/>R(%)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b> Beta </b><br/>
                                </div>
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
        $('#liDigLista').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divLista').hide();
        $('#divGeral').hide();
        

        var arrayLista = [];
        var table = $('#tableLista').DataTable();
        var selectedCbr = null;
        var selectedGco = null;
        var selectedMes = null;
        var selectedPjt = null;


        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAlertaCbr = 'Selecione o colaborador/consultor.';
        var vAlertaGco = 'Selecione o gerente do projeto / plano de operação.';
        var vAlertaMes = 'Selecione o mês e ano.';
        var vAlertaPjt = 'Selecione o plano de serviço.';
        var vAlertaSem = 'Período da semana: data inicial e data final';
        var vAlertaPrv = 'Previsão de disponibilidade do Consultor para o projeto na semana.\nProporção percentual sobre o total disponível na semana.';
        var vAlertaRal = 'Trabalho do Consultor para o projeto na semana.\nProporção percentual do trabalho realizado sobre o total disponível na semana.';

        setInputTextHints();

        $('#optionselectedGco').change(function() {
            console.log(this.value);

            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/DigLista/fecthPjt/" + this.value,
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

            if( $('#comboboxMes').val() == '0' )
                {
                document.getElementById('comboboxMes').focus();
                Swal.fire(
                    'Ops!',
                    vAlertaMes,
                    'warning'
                )
                return;
            }

            //selectedCbr = ($('#optionselectedCbr')[0].selectedIndex == 0) ? 0 : $('#optionselectedCbr').val();
            selectedGco = ($('#optionselectedGco')[0].selectedIndex == 0) ? 0 : $('#optionselectedGco').val();
            selectedMes = ($('#comboboxMes')[0].selectedIndex == 0) ? null : $('#comboboxMes').val();
            selectedPjt = ($('#comboboxPPx')[0].selectedIndex == 0) ? 0 : $('#comboboxPPx').val();
            
            console.log(selectedMes);
            // var pAbreAtividade = $('#checkboxpAbreProjeto').is(":checked") ? 1 : 0;
            

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
                // autoWidth: false,
                retrieve: true,
                paging: false,
                sAjaxDataProp: "",
                responsive: true,
                info: false,

                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/DigLista/fetchDigLista",
                    type: 'POST',
                    data: {
                        selectedCbr: 0,
                        selectedGco: selectedGco,
                        selectedMes: selectedMes,
                        selectedPjt: selectedPjt,
                        selectedPjtFecha: 1
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
                        "data": "CONSULTOR",
                        "defaultContent": ""
                    },
                    {
                        "data": "PLANO",
                        "defaultContent": ""
                    },
                    {
                        "data": "SEM01",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM01P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM01E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM02",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM02P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM02E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM03",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM03P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM03E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM04",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM04P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM04E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM05",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM05P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM05E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM06",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM06P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM06E",
                        "defaultContent": "",
                        className: "text-center"
                    }
                    
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },

            });
  


        // /***************************************************************************************/
        

        loadSpinner();
        $('#tablegLista').DataTable().clear().destroy();
        table = $('#tablegLista').DataTable({
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
            // autoWidth: false,
            retrieve: true,
            paging: false,
            sAjaxDataProp: "",
            responsive: true,
            info: false,

            ajax: {
                url: "<?php echo base_url(); ?>gestaoprojeto/DigLista/fetchDigLista",
                type: 'POST',
                data: {
                    selectedCbr: 0,
                    selectedGco: selectedGco,
                    selectedMes: selectedMes,
                    selectedPjt: selectedPjt,
                    selectedPjtFecha: 0
                },
                complete: function(response) {
                    arrayLista = JSON.parse(response.responseText);
                    $('#divGeral').show();
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
                    "data": "CONSULTOR",
                    "defaultContent": ""
                },
                {
                    "data": "PLANO",
                    "defaultContent": ""
                },
                {
                    "data": "SEM01",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM01P",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM01E",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM02",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM02P",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM02E",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM03",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM03P",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM03E",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM04",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM04P",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM04E",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM05",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM05P",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM05E",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM06",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM06P",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "SEM06E",
                    "defaultContent": "",
                    className: "text-center"
                }
                
            ],
            'initComplete': function(settings, json) {
                removeSpinner();
            },

        });
        });
        





        function setInputTextHints() {
            $('#optionselectedCbr').prop('title', vAlertaCbr );
            $('#optionselectedGco').prop('title', vAlertaGco );
            $('#comboboxMes').prop('title', vAlertaMes );
            $('#comboboxPPx').prop('title', vAlertaPjt );

            $('#col03sem1').prop('title', vAlertaSem );
            $('#col04pre1').prop('title', vAlertaPrv );
            $('#col05rea1').prop('title', vAlertaRal );
            $('#col06sem2').prop('title', vAlertaSem );
            $('#col07pre2').prop('title', vAlertaPrv );
            $('#col08rea2').prop('title', vAlertaRal );
            $('#col09sem3').prop('title', vAlertaSem );
            $('#col10pre3').prop('title', vAlertaPrv );
            $('#col11rea3').prop('title', vAlertaRal );
            $('#col12sem4').prop('title', vAlertaSem );
            $('#col13pre4').prop('title', vAlertaPrv );
            $('#col14rea4').prop('title', vAlertaRal );
            $('#col15sem5').prop('title', vAlertaSem );
            $('#col16pre5').prop('title', vAlertaPrv );
            $('#col17rea5').prop('title', vAlertaRal );
            $('#col18sem6').prop('title', vAlertaSem );
            $('#col19pre6').prop('title', vAlertaPrv );
            $('#col20rea6').prop('title', vAlertaRal );
        
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