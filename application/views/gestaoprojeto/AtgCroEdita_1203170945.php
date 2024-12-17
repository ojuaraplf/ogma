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
    <title>wD Ogma AtCro </title>

    <?php $this->load->view('include/headerTop') ?>

    html {
      visibility: hidden;
    }
</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navbarHome') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Edição do Cronograma do Plano de Serviço </h4>
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
                                        <label for="" class="text-left control-label col-form-label"> Plano de Serviço (PPx) </label>
                                        <select class="form-control" id="optionPPx">
                                            <option value="0"> Todos os planos de serviço ... </option>
                                            <?php foreach ($listaPjt as $item): ?>
                                                <option value="<?= $item['CODIGO'] ?>">
                                                    <?= $item['APELIDO'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="optionPJF" class="text-left control-label col-form-label"> Fase(s) do PPx </label>
                                        <select class="form-control" id="optionPJF">
                                            <option value="0"> Todas as fases ... </option>
                                            <?php foreach ($listaPjf as $item): ?>
                                                <option value="<?= $item['FASE_CODIGO'] ?>">
                                                    <?= $item['FASE_DESCRICAO'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="optionTipoAtf" class="text-left control-label col-form-label"> Tipo de Famílias de Atividade </label>
                                        <select class="form-control" name="optionTipoAtf" id="optionTipoAtf">
                                            <option value="tod">Todas as Famílias de Atividade</option>
                                            <option value="exe"> Famílias de execução</option>
                                            <option value="ser" <?php echo "selected" ?> >Famílias de serviço</option>
                                        </select>
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
                                        <div class="col-6">
                                            <h4> Atividades da WBS da Fase Plano de Serviço </h4>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary" style="float: right;" id="buttonSalvar"> Salvar alterações</button>
                                        </div>
                                    </div>
                                    <table id="tableATG" class="display responsive table-sm" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td id='colOrdem'> Ordem </td>
                                                <!-- <td id='colAtgAn'> <i class="mdi mdi-chart-gantt"></i></td> -->
                                                <td id='colAtgId'> Id </td>
                                                <td id='colDescr'> Descrição </td>
                                                <td id='colEsfor'> <i class="mdi mdi-battery"></i></td>
                                                <td id='colTraba'> <i class="mdi mdi-battery-60"></i></td>
                                                <td id='colPla_I'> <i class="mdi mdi-airplane-takeoff"></i></td>
                                                <td id='colTrabI'> <i style="color: green;" class="mdi mdi-timer-sand"></i></td>
                                                <td id='colTrabF'> <i style="color: blue;" class="mdi mdi-timer-sand-empty"></i></td>
                                                <td id='colPla_F'> <i class="mdi mdi-airplane-landing"></i></td>
                                                <td id='colApron'> <i class="mdi mdi-altimeter"></i></td>
                                                
                                                <td id='colConcl'> <i class="mdi mdi-close-box"></i></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                    <b>Versão Beta: 00.60 - 11/10/2021</b><br/>
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
        setInputTextHints();
        removeSpinner();

        $('#liGpo').addClass('selected');
        $('#liAtgCroEdita').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divLista').hide();

        var arrayTableATG = [];

        $('#buttonSalvar').click(function() {
            Swal.fire({
                title: 'Deseja salvar alterações do cronograma na Atividade?',
                text: '',
                showDenyButton: true,
                confirmButtonText: 'Confirmar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                if (result.isConfirmed) {
                    loadBlurSpinner();
                    $.when( SalvartableATG() ).done(function(r1) {                    
                        console.log(r1);
                        Swal.fire(
                            'Alterações salvas.',
                            '',
                            'success'
                        ).then(() => {
                            ListaAtividades();
                        });
                    });
                }
            });
        });



        $('#optionPPx').change(function() {
            console.log(this.value);
            loadSpinner();
            document.getElementById('optionPJF').focus();
            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthPJFPlano/" + this.value,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        var optionsPJFNome = [];
                        // optionsPJFNome.push('<option value="0"> Todas as fases ... </option>');
                        response.listaPjfPlano.forEach(function(e) {
                            optionsPJFNome.push('<option value="' + e.FASE_CODIGO + '"> ' + e.FASE_DESCRICAO + ' </option>')
                        });
                        $('#optionPJF').html(optionsPJFNome);
                        console.log(response);
                        console.log("$('#optionPJF').val()");
                        console.log($('#optionPJF').val());
                        ListaAtividades();
                    }
                });
            removeSpinner();
        });

        $('#optionTipoAtf').change(function() {
            ListaAtividades();
        });

        $('#optionPJF').change(function() {
            ListaAtividades();
        });

        function ListaAtividades() {

            selectedPjf = $('#optionPJF').val();
            console.log(selectedPjf);
            selectedAtf = $('#optionTipoAtf').val();

            loadSpinner();
            $('#tableATG').DataTable().clear().destroy();
            table = $('#tableATG').DataTable({

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
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fetchAtgCroEdita",
                    type: 'POST',
                    data: {
                        selectedPjf: selectedPjf,
                        selectedAtf: selectedAtf
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        console.log(response);
                    }
                },

                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [($('#optionTipoAtf').val()!='tod' ? 5 : 0), "asc"]
                ],
                rowId: 'ATG_CODIGO',
                columns: [
                    {
                        "data": "ATG_ORDEM",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    // {
                    //     "data": "ATG_ATGpredCodigo",
                    //     "defaultContent": "",
                    //     className: "text-center",
                    //     'render': function (data, type, row) {
                    //         return row.ATG_QTHORA == null ? '' : '<input type="text"'  + (row.CONCLUIDA == 1 ? ' disabled ' : '') + 'style="width: 100px;" value=' + row.ATG_ATGpredCodigo + ' class="form-control" id="colAtgAn' + row.ATG_CODIGO + '" />';
                    //     }
                    // },
                    {
                        "data": "ATG_CODIGO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "ATG_DESCRICAO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "ATG_QTHORA",
                        "defaultContent": "",
                        className: "text-center",
                        'render': function (data, type, row) {
                            return row.ATG_QTHORA == null ? '' : '<input type="number"'  + (row.CONCLUIDA == 1 ? ' disabled ' : '') + 'style="width: 100px;" value=' + row.ATG_QTHORA + ' class="form-control" id="colEsfor' + row.ATG_CODIGO + '" />';
                        }
                    },
                    {
                        "data": "TRABALHO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "INICIO",
                        "defaultContent": "",
                        className: "text-center",
                        'render': function (data, type, row) {
                            return row.ATG_QTHORA == null ? '' : '<input type="date"'  + (row.CONCLUIDA == 1 ? ' disabled ' : '') + 'value=' + row.INICIO + ' class="form-control" id="colPlanI' + row.ATG_CODIGO + '" />';
                        },
                    },
                    {
                        "data": "PRIMEIRO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "ULTIMO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "FINAL",
                        "defaultContent": "",
                        className: "text-center",
                        'render': function (data, type, row) {
                            return row.ATG_QTHORA == null ? '' : '<input type="date"' + (row.CONCLUIDA == 1 ? ' disabled ' : '') + 'value=' + row.FINAL + ' class="form-control" id="colPlanF' + row.ATG_CODIGO + '" />';
                        }
                    },
                    {
                        "data": "PER_PRONTO",
                        "defaultContent": "",
                        className: "text-center",
                        'render': function (data, type, row) {
                            return row.ATG_QTHORA == null ? '' : '<input type="range" min="0" max="100" step="1"' + (row.CONCLUIDA == 1 ? ' disabled ' : '') + 'value=' + row.PER_PRONTO + ' class="form-control" id="colApron' + row.ATG_CODIGO + '" />';
                        }
                        
                    },
                    {
                        "data": "CONCLUIDA",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            return row.ATG_QTHORA == null ? '' : '<input type="checkbox"' + (row.CONCLUIDA == 1 ? ' checked ' : '') + 'id="checkboxCONCLUIDA' + row.ATG_CODIGO + '">';
                        }
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                    // $('[id^=colPlan]').datepicker({
                    //     autoclose: true,
                    //     todayHighlight: true,
                    //     format: "dd/mm/yyyy",
                    //     orientation: "bottom",
                    //     startDate: '-3d',
                    //     maxViewMode: 1
                    // });
                },

                columnDefs: [
                    {
                        "width": "3%",
                        "targets": [0],
                    },
                    {
                        "width": "5%",
                        "targets": [1],
                    },
                    {
                        "width": "43%",
                        "targets": [2],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if(rowData.ATG_QTHORA==null) {
                                $(td).css('background-color', 'gray').css('color', 'white');
                            }
                        }
                    },
                    {
                        "width": "2%",
                        "targets": [3],
                        "orderDataType": "dom-text"
                    },
                    {
                        "width": "6%",
                        "targets": [4],
                    },
                    {
                        "width": "8%",
                        "targets": [5]
                    },
                    {
                        "width": "4%",
                        "targets": [6],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('color', MudaDateTime(rowData.PRIMEIRO)<rowData.INICIO ? 'red' :'green');
                        }
                    },
                    {
                        "width": "8%",
                        "targets": [7],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('color', MudaDateTime(rowData.ULTIMO)>rowData.FINAL ? 'red' :'blue');
                        }
                    },
                    {
                        "width": "8%",
                        "targets": [8]
                    },
                    {
                        "width": "10%",
                        "targets": [9],
                        "orderDataType": "dom-text"
                    },
                    {
                        "width": "3%",
                        "targets": [10]
                    }
                ],
                
            });
        }

        function SalvartableATG() {
            console.log("to no salvar");

            arrayTableATG = [];
            $('#tableATG').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                console.log('console.log($tds)');
                console.log($tds);
                var ATG_CODIGO = $tds.eq(1).text();
                // var ATG_ATGpredCodigo = $tds.eq(1).find("input").val();
                var ATG_QTHORA = $tds.eq(3).find("input").val();
                var ATG_MomInicExecucaoInformado = $tds.eq(5).find("input").val();
                var ATG_MomFinalExecucaoInformado = $tds.eq(8).find("input").val();
                var ATG_PORCENTAGEMAPRONTADA = $tds.eq(9).find("input").val();
                var vATG_FlgConcluida = $tds.eq(10).find('input').is(":checked");
                var ATG_FlgConcluida = vATG_FlgConcluida == true ? 1 : 0;
                arrayTableATG.push({ATG_CODIGO:ATG_CODIGO, ATG_QTHORA:ATG_QTHORA, ATG_MomInicExecucaoInformado:ATG_MomInicExecucaoInformado, ATG_MomFinalExecucaoInformado:ATG_MomFinalExecucaoInformado, ATG_PORCENTAGEMAPRONTADA:ATG_PORCENTAGEMAPRONTADA, ATG_FlgConcluida:ATG_FlgConcluida });
            });
            console.log('arrayTableATG');
            console.log(arrayTableATG);
            if(arrayTableATG.length == 0){
                return;
            }
            return $.ajax({
                url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/updateATGCronograma",
                type: 'POST',
                data: {
                    arrayTableATG: arrayTableATG
                },
            });
        }

        function MudaDateTime(pDataVinda) {
            if(pDataVinda == null) {
                return '0000-00-00 00:00:00'
            }
            var dd = pDataVinda.substring(0, 2);
            var mm = pDataVinda.substring(3, 5);
            var yyyy = pDataVinda.substring(6, 10);
            var hh = '12';
            var mn = '00';
            var ss = '00';
            var DataIda = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + mn + ':' + ss;
            return DataIda
        }

        function setInputTextHints() {

            $('#optionPPx').prop('title', 'Selecione o Plano de Serviços para listar as Atividades.' );
            $('#optionPJF').prop('title', 'Selecione a Fase do Plano de Serviços para listar as Atividades.');
            $('#optionTipoAtf').prop('title', 'Selecione o Tipo de Famílias de Ativiade:\nFamílias de serviço: Atividades de execução direta na prestação de serviços;\nFamílias de execução: Atividades de execução direta ou indireta na prestação de serviços.' );
            
            $('#colOrdem').prop('title', 'Número de ordem da Atividade na WBS do Plano de Serviço.' );
            $('#colAtgId').prop('title', 'Id (código) da Atividade.' );
            $('#colAtgAn').prop('title', 'Id (código) da Atividade Predecessora.' );
            $('#colDescr').prop('title', 'Descrição da Atividade.' );
            $('#colEsfor').prop('title', 'Esforço em horas programado para execução da Atividade.' );
            $('#colTraba').prop('title', 'Trabalho em horas já executado para a Atividade.' );
            $('#colPla_I').prop('title', 'Data prevista para início dos trabalhos na Atividade.');
            $('#colTrabI').prop('title', 'Primeiro dia de trabalhos efetivos na execução da Atividade.');
            $('#colTrabF').prop('title', 'Último dia de trabalhos efetivos na execução da Atividade.');
            $('#colPla_F').prop('title', 'Data prevista para término dos trabalhos na Atividade.');
            $('#colApron').prop('title', 'Proporção estimada de aprontamento da Atividade.');
            $('#colConcl').prop('title', 'Atividade Concluída:\nMarcada, significa que atividade foi entregue/concluída.');
            
            
            
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