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
    <title>wDiscovery</title>

    <?php $this->load->view('include/headerTop') ?>
    <style>
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
                        <h4 class="page-title"> APONTAR HORAS </h4>
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
            <br />
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Apontamento de Horas</h4>
                                <div class="border-top"></div>
                                <br />

                                <div class="row mb-3">
                                    <div class="col-11">
                                        <label for="" class="text-left control-label col-form-label">Atividade</label>
                                        <select class="form-control" id="comboboxAtividadesColaborador">
                                        </select>
                                        <div class="invalid-feedback">
                                            <span id=""> Nenhuma atividade selecionada. </span>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label for="" class="text-left control-label col-form-label">&nbsp;</label>
                                        <button class="btn btn-primary btn-block" id="buttonDetalhesAtividade">Detalhes
                                        </button>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label"> Data </label>
                                        <input type="text" class="form-control" id="inputTextLCT_DATA" />
                                        <div class="invalid-feedback">
                                            <span id=""> Data incorreta. </span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="" class="text-left control-label col-form-label"> Hora Inicial </label>
                                        <input type="text" class="form-control" id="inputTextLCT_HORAINICIO" />

                                        <div class="invalid-feedback">
                                            <span id="spanHoraInicialError"> Hora incorreta. </span>
                                        </div>

                                    </div>
                                    <div class="col-3">

                                        <label for="" class="text-left control-label col-form-label"> Hora Final </label>
                                        <input type="text" class="form-control" id="inputTextLCT_HORAFIM" />

                                        <div class="invalid-feedback">
                                            <span id="spanHoraFinalError"> Hora incorreta. </span>
                                        </div>

                                    </div>
                                    <div class="col-2">
                                        <label for="inputTextLCT_PORCENTAGEMNOVA" class="text-left control-label col-form-label"> %
                                            Feita </label>
                                        <input type="number" class="form-control" id="inputTextLCT_PORCENTAGEMNOVA" />
                                        <div class="invalid-feedback">
                                            <span id="spanHoraFinalError"> Necessário editar % feita. </span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-2">
                    <label for="" class="text-left control-label col-form-label"> Chamado </label>
                    <input type="text" class="form-control" id="inputTextLCT_CODCHAMADO" />
                  </div> -->
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label"> Qtdade Horas </label>
                                        <input type="text" class="form-control" id="inputTextLCT_TEMPO" disabled />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label"> Descriçao do trabalho </label>
                                        <textarea class="form-control" rows="2" id="textareaLCT_DESCRICAO"></textarea>
                                        <div class="invalid-feedback">
                                            <span id=""> Necessário preencher a descrição da Atividade </span>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-primary" id="btnInsertNewApontamentoHora"> Apontar Hora</button>
                                <br /><br />
                                <div class="border-top"></div>
                                <label for="" class="text-left control-label col-form-label"> Lançamentos do dia </label>
                                <table style="text-align: center;" class="table table-sm table-bordered" id="tableAtividadesColaboradorDia">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 25%;"> Atividade</th>
                                            <th style="width: 25%;"> Inicio</th>
                                            <th style="width: 25%;"> Fim</th>
                                            <th style="width: 25%;"> Horas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Apontamento de Horas da Atividade</h4>
                                <div class="border-top"></div>
                                <br />

                                <table style="text-align: center;" class="table table-sm table-bordered" id="tableApontamentoHorasDaAtividade">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 25%;"> Colaborador </th>
                                            <th style="width: 25%;"> Descrição </th>
                                            <th style="width: 25%;"> QTHora </th>
                                            <th style="width: 25%;"> Porcentagem </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <?php $this->load->view('include/headerBottom') ?>
        <?php $this->load->view('include/defaults') ?>
        <?php $this->load->view('modal/modalAvisoCampoVazio') ?>
        <?php $this->load->view('modal/modalApontamentoHoraSucesso') ?>
        <?php $this->load->view('modal/modalApontarHorasDescricaoAtividade') ?>
        <?php $this->load->view('modal/modalApontamentoHoraPeriodoExiste') ?>


    </div>

    <script type="text/javascript">
        // fetchAtividadesReferenteColaborador();
        $(document).ready(function() {

            // $('#texteditor').trumbowyg();

            // $('#texteditor').trumbowyg({8
            // 	changeActiveDropdownIcon: true,
            // 	autogrow: true
            // });


            $('#inputTextLCT_DATA').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "dd/mm/yyyy",
                orientation: "bottom",
                maxViewMode: 1
            });


            // $('#liConsultoria').addClass('selected');
            // $('#liConsultoriaApontarHoras').addClass('active');
            // $('#ulConsultoria').addClass('in');

            $('#liApontarHoras').removeClass('active');
            $('#liApontarHoras').removeClass('selected');
        });


        loadSpinner();

        var atividadesArray = [];
        var ATG_CODIGO = 0;
        // var LCT_PORCENTAGEMANTIGA = 0;
        var selectedComboboxAtividade = "";
        var selectedAtividade = "";

        $.when(fetchAtividadesReferenteColaborador()).done(function(r1) {
            var html = [];
            atividadesArray = r1;
            for (var i = 0; i <= r1.length - 1; i++) {
                html.push('<option value="' + r1[i].ATG_CODIGO + '">' + r1[i].PJT_APELIDO + ' - ' + r1[i].ATG_ORDEM + ' - ' + r1[i].ATG_DESCRICAO + '</option>')
            }
            $('#comboboxAtividadesColaborador').append(html);


            setupComboboxAtividadesColaborador();
            removeSpinner();


        });

        var inputTextPorcentagemUpdated = false;

        $("#inputTextLCT_PORCENTAGEMNOVA").on("input", function() {
            inputTextPorcentagemUpdated = true;
            $(this).removeClass('is-invalid');
        });

        $('#inputTextLCT_PORCENTAGEMNOVA').focusout(function() {
            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {
                $(this).val(Math.max(Math.min(value, 100), selectedAtividade["ATG_PORCENTAGEMAPRONTADA"]));

            }
        });

        function setupComboboxAtividadesColaborador() {
            $('#comboboxAtividadesColaborador').editableSelect({
                effects: 'fade'
            }).on('select.editable-select', function(e, li) {



                selectedComboboxAtividade = atividadesArray[li.index()].PJT_APELIDO + ' - ' + atividadesArray[li.index()].ATG_ORDEM + ' - ' + atividadesArray[li.index()].ATG_DESCRICAO;


                selectedAtividade = atividadesArray[li.index()];
                ATG_CODIGO = li.val();

                fetchApontamentoHorasDaAtividade(ATG_CODIGO);


                LCT_PORCENTAGEMANTIGA = atividadesArray[li.index()].ATG_PORCENTAGEMAPRONTADA;


                $('#inputTextLCT_PORCENTAGEMNOVA').val(LCT_PORCENTAGEMANTIGA);

                $('#comboboxAtividadesColaborador').removeClass('is-invalid');


            });
        }

        function fetchApontamentoHorasDaAtividade(ATG_CODIGO) {
            $("#tableApontamentoHorasDaAtividade > tbody").html("");
            $.ajax({
                url: "<?php echo base_url(); ?>consultoria/apontarHoras/fetchApontamentoHorasDaAtividade",
                type: 'POST',
                data: {
                    ATG_CODIGO: ATG_CODIGO
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);

                    var html = [];

                    for (var i = data.length - 1; i >= 0; i--) {

                        html.push('<tr>');
                        html.push('<td>' + data[i].COLABORADOR + '</td>');
                        html.push('<td>' + data[i].LCT_DESCRICAO + '</td>');
                        html.push('<td>' + data[i].LCT_TEMPO + '</td>');
                        html.push('<td>' + data[i].LCT_PORCENTAGEMNOVA + '</td>');
                        html.push('</tr>');
                    }

                    $('#tableApontamentoHorasDaAtividade').append(html);
                }
            });
        }



        function fetchAtividadesReferenteColaborador() {
            return $.ajax({
                url: "<?php echo base_url(); ?>consultoria/apontarHoras/fetchAtividadesReferenteColaborador",
                type: 'POST',
                data: {
                    AEA_CBRCODIGO: <?php echo $this->session->userdata('userCodigo'); ?>
                },
                dataType: 'json',
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            });
        }

        function fetchApondamentoDia(LCT_DATA) {
            $.ajax({
                url: "<?php echo base_url(); ?>consultoria/apontarHoras/fetchApondamentoDia",
                type: 'POST',
                data: {
                    CBR_CODIGO: <?php echo $this->session->userdata('userCodigo'); ?>,
                    LCT_DATA: LCT_DATA.split("/").reverse().join("-")
                },
                dataType: 'json',
                success: function(data) {
                    $("#tableAtividadesColaboradorDia > tbody").html("");
                    var html = [];

                    for (var i = data.length - 1; i >= 0; i--) {

                        html.push('<tr>');
                        html.push('<td>' + data[i].ATG_DESCRICAO + '</td>');
                        html.push('<td>' + data[i].LCT_HORAINICIO + '</td>');
                        html.push('<td>' + data[i].LCT_HORAFIM + '</td>');
                        html.push('<td>' + data[i].LCT_TEMPO + '</td>');
                        html.push('</tr>');
                    }

                    $('#tableAtividadesColaboradorDia').append(html);
                }
            });
        }

        $('#inputTextLCT_DATA').change(function() {

            fetchApondamentoDia($(this).val());
        });


        $('#inputTextLCT_HORAINICIO').change(function() {
            $('#spanHoraInicialError').text('Hora incorreta.');

            var isValid = /^([0-1][0-9]|2[0-3]):([0-5][0-9])$/.test($(this).val());
            if (!isValid) {
                $(this).addClass('is-invalid');
            } else {

                $(this).removeClass('is-invalid');
                if ($('#inputTextLCT_HORAFIM').val().length == 5 && $('#inputTextLCT_HORAFIM').val() <= $(this).val()) {
                    $(this).addClass('is-invalid');
                    $('#inputTextLCT_HORAFIM').addClass('is-invalid');
                    $('#spanHoraFinalError').text('Hora final está inferior à hora inicial.');
                    $('#spanHoraInicialError').text('Hora inicial está superior à hora final');
                    $('#inputTextLCT_TEMPO').val("");
                } else {
                    $('#inputTextLCT_HORAINICIO').removeClass('is-invalid');
                    $('#inputTextLCT_HORAFIM').removeClass('is-invalid');

                    var LCT_TEMPO = (new Date("1970-1-1 " + $('#inputTextLCT_HORAFIM').val()) - new Date("1970-1-1 " + $('#inputTextLCT_HORAINICIO').val())) / 1000 / 60 / 60;
                    if (!isNaN(LCT_TEMPO)) {
                        $('#inputTextLCT_TEMPO').val(LCT_TEMPO.toFixed(2));
                    }


                }
            }
        });
        $('#inputTextLCT_DATA').change(function() {
            if ($(this).val().length == 10) {
                $(this).removeClass('is-invalid');
            }
        });

        $('#textareaLCT_DESCRICAO').change(function() {
            if ($(this).val().length >= 1) {
                $(this).removeClass('is-invalid');
            }
        });

        $('#inputTextLCT_HORAFIM').change(function() {

            $('#spanHoraFinalError').text('Hora incorreta.');

            var isValid = /^([0-1][0-9]|2[0-3]):([0-5][0-9])$/.test($(this).val());
            if (!isValid) {
                $(this).addClass('is-invalid');
            } else {

                $(this).removeClass('is-invalid');
                if ($('#inputTextLCT_HORAINICIO').val().length == 5 && $('#inputTextLCT_HORAINICIO').val() >= $(this).val()) {
                    $(this).addClass('is-invalid');
                    $('#inputTextLCT_TEMPO').val("");
                    $('#inputTextLCT_HORAINICIO').addClass('is-invalid');
                    $('#spanHoraFinalError').text('Hora final está inferior à hora inicial.');
                    $('#spanHoraInicialError').text('Hora inicial está superior à hora final');
                } else {
                    $('#inputTextLCT_HORAINICIO').removeClass('is-invalid');
                    $('#inputTextLCT_HORAFIM').removeClass('is-invalid');

                    var LCT_TEMPO = (new Date("1970-1-1 " + $('#inputTextLCT_HORAFIM').val()) - new Date("1970-1-1 " + $('#inputTextLCT_HORAINICIO').val())) / 1000 / 60 / 60;
                    if (!isNaN(LCT_TEMPO)) {
                        $('#inputTextLCT_TEMPO').val(LCT_TEMPO.toFixed(2));
                    }
                }
            }
        });

        $("#inputTextLCT_HORAINICIO, #inputTextLCT_HORAFIM").mask("Hh:Mm", {
            translation: {
                'H': {
                    pattern: /[0-2]/,
                    optional: false
                },
                'h': {
                    pattern: /[0-9]/,
                    optional: false
                },
                'M': {
                    pattern: /[0-5]/,
                    optional: false
                },
                'm': {
                    pattern: /[0-9]/,
                    optional: false
                }
            },
            placeholder: "HH:MM"
        });

        $("#inputTextLCT_DATA").mask("Dd/Mm/AAAA", {
            translation: {
                'D': {
                    pattern: /[0-3]/,
                    optional: false
                },
                'd': {
                    pattern: /[0-9]/,
                    optional: false
                },
                'M': {
                    pattern: /[0-1]/,
                    optional: false
                },
                'm': {
                    pattern: /[0-9]/,
                    optional: false
                },
                'A': {
                    pattern: /[0-9]/,
                    optional: false
                },
            },
            placeholder: "DD/MM/AAAA"
        });


        $('#buttonDetalhesAtividade').click(function() {

            if ($('#comboboxAtividadesColaborador').val() != selectedComboboxAtividade || selectedComboboxAtividade == "") {
                $('#comboboxAtividadesColaborador').addClass('is-invalid');
                return;
            }


            $('#modalApontarHorasDescricaoAtividade').modal('show');


            $('#textAreaATG_DetalheDescritivo').val(selectedAtividade["ATG_DetalheDescritivo"]);
            $('#inputTextATG_PORCENTAGEMAPRONTADA').val(selectedAtividade["ATG_PORCENTAGEMAPRONTADA"]);
            $('#textareaATG_DESCRICAO').val(selectedAtividade["ATG_DESCRICAO"]);


        });


        function checarSePeriodoExisteLancamento(LCT_DATA, LCT_HORAINICIO, LCT_HORAFIM, CBR_CODIGO) {
            return $.ajax({
                url: "<?php echo base_url(); ?>consultoria/apontarHoras/checarSePeriodoExisteLancamento",
                type: 'POST',
                dataType: 'text',
                data: {
                    LCT_DATA: LCT_DATA,
                    LCT_HORAINICIO: LCT_HORAINICIO,
                    LCT_HORAFIM: LCT_HORAFIM,
                    CBR_CODIGO: CBR_CODIGO
                }

            });
        }


        var isApontandoHoras = false;

        $('#btnInsertNewApontamentoHora').click(function() {

            if (isApontandoHoras == true) {
                return;
            }

            isApontandoHoras = true;

            var LCT_DATA = $('#inputTextLCT_DATA').val().split("/").reverse().join("-");
            var LCT_HORAINICIO = $('#inputTextLCT_HORAINICIO').val();
            var LCT_HORAFIM = $('#inputTextLCT_HORAFIM').val();
            // var LCT_CODCHAMADO = $('#inputTextLCT_CODCHAMADO').val();
            var LCT_TEMPO = $('#inputTextLCT_TEMPO').val();
            var LCT_DESCRICAO = $('#textareaLCT_DESCRICAO').val();

            var LCT_PORCENTAGEMANTIGA = selectedAtividade["ATG_PORCENTAGEMAPRONTADA"];
            var LCT_PORCENTAGEMNOVA = $('#inputTextLCT_PORCENTAGEMNOVA').val();
            var ATG_PORCENTAGEMAPRONTADA = $('#inputTextLCT_PORCENTAGEMNOVA').val();

            var CBR_CODIGO = <?php echo $this->session->userdata('userCodigo'); ?>;
            var LCT_USULogin = "<?php echo $this->session->userdata('userLogin'); ?>";


            if ($('#comboboxAtividadesColaborador').val() != selectedComboboxAtividade || selectedComboboxAtividade == "") {
                isApontandoHoras = false;
                $('#comboboxAtividadesColaborador').addClass('is-invalid');
                return;
            }
            if (LCT_DATA < 10) {
                isApontandoHoras = false;
                $('#inputTextLCT_DATA').addClass('is-invalid');
                return;
            }
            if (LCT_HORAINICIO < 5) {
                isApontandoHoras = false;
                $('#inputTextLCT_HORAINICIO').addClass('is-invalid');
                return;
            }
            if (LCT_HORAFIM < 5) {
                isApontandoHoras = false;
                $('#inputTextLCT_HORAFIM').addClass('is-invalid');
                return;
            }

            if (inputTextPorcentagemUpdated == false) {
                isApontandoHoras = false;
                $('#inputTextLCT_PORCENTAGEMNOVA').addClass('is-invalid');
                return;
            }



            if (LCT_DESCRICAO.length < 1) {
                isApontandoHoras = false;
                $('#textareaLCT_DESCRICAO').addClass('is-invalid');
                return;
            }

            $.when(checarSePeriodoExisteLancamento(LCT_DATA, LCT_HORAINICIO, LCT_HORAFIM, CBR_CODIGO)).done(function(r1) {
                if (r1 != 0) {
                    isApontandoHoras = false;
                    $('#modalApontamentoHoraPeriodoExiste').modal('show');
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>consultoria/apontarHoras/newLancamentoHora",
                        type: 'POST',
                        dataType: 'text',
                        data: {

                            LCT_DATA: LCT_DATA,
                            LCT_HORAINICIO: LCT_HORAINICIO,
                            LCT_HORAFIM: LCT_HORAFIM,

                            LCT_TEMPO: LCT_TEMPO,
                            LCT_DESCRICAO: LCT_DESCRICAO,
                            ATG_CODIGO: ATG_CODIGO,
                            CBR_CODIGO: CBR_CODIGO,
                            LCT_PORCENTAGEMANTIGA: LCT_PORCENTAGEMANTIGA,
                            LCT_PORCENTAGEMNOVA: LCT_PORCENTAGEMNOVA,
                            ATG_PORCENTAGEMAPRONTADA: ATG_PORCENTAGEMAPRONTADA,

                            LCT_USULogin: LCT_USULogin
                        },
                        error: function(e, ts, et) {
                            console.log(e)
                        },
                        success: function(data) {
                            isApontandoHoras = false;
                            fetchApontamentoHorasDaAtividade(ATG_CODIGO);
                            removeSpinner();

                            atividadesArray[getArrayIndexForKey(atividadesArray, "ATG_CODIGO", ATG_CODIGO)].ATG_PORCENTAGEMAPRONTADA = LCT_PORCENTAGEMNOVA;


                            $('#modalApontamentoHoraSucesso').modal('show');
                            // $('#inputTextLCT_PORCENTAGEMNOVA').focusout(function() {
                            //   var value = $(this).val();
                            //   if ((value !== '') && (value.indexOf('.') === -1)) {
                            //     $(this).val(Math.max(Math.min(value, 100), LCT_PORCENTAGEMNOVA));
                            //   }
                            // });
                        }
                    });
                }
            });
        });
    </script>

</body>

</html> 