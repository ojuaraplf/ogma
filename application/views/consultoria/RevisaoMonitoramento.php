<?php

if (!($this->session->has_userdata('userToken'))) {
  redirect('login');
}
?>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>wDiscovery</title>

  <?php $this->load->view('include/headerTop') ?>


  <!--  <style>-->
  <!---->
  <!--    #tableApontamentoHoras tbody tr {-->
  <!--      cursor: pointer;-->
  <!--    }-->
  <!---->
  <!--    html {-->
  <!--      visibility: hidden;-->
  <!--    }-->
  <!--  </style>-->


</head>

<body style="background: #eeeeee;">


<div id="main-wrapper">


  <?php $this->load->view('include/navbarHome') ?>
  <?php $this->load->view('include/asidebar') ?>

  <div class="page-wrapper">
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <h4 class="page-title"> Revisão Monitoramento </h4>
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
    <br/>


    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Revisão de Monitoramento</h4>
              <div class="border-top"></div>
              <br/>

              <!--              <h4> Revisões de Monitoramento </h4>-->
              <table id="tableMonitoramento" class="table table-bordered table-sm">
                <thead>
                <tr>
                  <th style="width: 20%;"> Data</th>
                  <th style="width: 20%;"> Espécie</th>
                  <th style="width: 52%;"> Descrição</th>
                  <th style="width: 8%; text-align: center;" id="addMonitoramento"></th>
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
</div>

<?php $this->load->view('include/headerBottom') ?>
<?php $this->load->view('include/defaults') ?>

<?php $this->load->view('modal/modalDetalhesRevisao') ?>
<?php $this->load->view('modal/modalConfirmarConcluirRevisao') ?>
<?php $this->load->view('modal/modalChecklist') ?>
<?php $this->load->view('modal/modalChecklistItemDetalhes') ?>


<script type="text/javascript">
    loadSpinner();
    //$('#divRelatorio').hide();
    //
    //$(document).ready(function () {
    //
    //    document.getElementsByTagName("html")[0].style.visibility = "visible";
    //
    //    $('#inputTextLCT_DATAINICIAL, #inputTextLCT_DATAFINAL, #inputTextLCT_DATA').datepicker({
    //        autoclose: true,
    //        todayHighlight: true,
    //        format: "dd/mm/yyyy",
    //        orientation: "bottom right",
    //        maxViewMode: 1
    //    });
    //});
    //
    //fetchApontamentoHoras();
    //var arrayApontamentoHoras = [];
    //var table = $('#tableApontamentoHoras').DataTable();
    //

    var arrayMonitoramento = [];

    $.when(fetchRevisaoUsuario()).done(function (r1) {

        arrayMonitoramento = r1;

        for (var i = 0; i <= r1.length - 1; i++) {

            console.log(r1[i].PJM_FlgRevisaoConcluida);


            var htmlTableMonitoramento = [];
            htmlTableMonitoramento.push('<tr id="' + r1[i].PJM_Codigo + '">');
            htmlTableMonitoramento.push('<td> <input type="text" class="form-control" id="inputTextData" value="' + r1[i].PJM_DataDaAgendaRevisao.split("-").reverse().join("/") + '" disabled /> </td>');
            htmlTableMonitoramento.push('<td> <input type="text" class="form-control" id="inputTextEspecie" value="' + r1[i].ERM_Descricao + '" disabled /> </td>');
            htmlTableMonitoramento.push('<td> <input type="text" class="form-control" id="inputTextDescricao" value="' + r1[i].PJM_mDescricaoDaRevisao + '" disabled /> </td>');

            htmlTableMonitoramento.push('<td style="text-align: center;"><i id="detalheMonitoramento" class="fas fa-info-circle"></i></td>');
            htmlTableMonitoramento.push('</tr>');
            $('#tableMonitoramento').append(htmlTableMonitoramento.join(''));


            if (r1[i].PJM_FlgRevisaoConcluida == 1) {
                $('[id^=' + r1[i].PJM_Codigo+']').children('td').css("background-color", "lightGray");
            }

        }

        $('[id=detalheMonitoramento]').hover(function () {
            $(this).css("cursor", "pointer");
        });
        removeSpinner();

    });
    $(document).on('click', '#detalheMonitoramento', function () {

        selectedDetalheRevisao = arrayMonitoramento[$(this).parent().parent().index()];
        $('#modalDetalhesRevisao').modal('show');
        $('#inputTextPJM_DataDaAgendaRevisao').val(selectedDetalheRevisao["PJM_DataDaAgendaRevisao"].split("-").reverse().join("/"));
        $('#inputTextPJM_ERMCodigo').val(selectedDetalheRevisao["ERM_Descricao"]);
        $('#inputTextPJM_mDescricaoDaRevisao').val(selectedDetalheRevisao["PJM_mDescricaoDaRevisao"]);


        $("#textAreaPJM_ParecerGQ").attr("disabled", true);
        $("#buttonGerarIndicadores").attr("disabled", true);


        $('#textAreaPJM_ParecerGQ').val(selectedDetalheRevisao["PJM_ParecerGQ"]);
        $('#textAreaPJM_ParecerGP').val(selectedDetalheRevisao["PJM_ParecerGP"]);


        if (selectedDetalheRevisao["PJM_mMomentoDaRevisao"] != null) {
            console.log("Revisão já feita");

            console.log(arrayMonitoramento);
            $('[id^=divAlertReturn]').attr("class", "alert alert-primary");
            $('[id^=divAlertReturn]').text("Carregando...");
            fetchIndicadores(selectedDetalheRevisao["PJM_Codigo"]);
            console.log(selectedDetalheRevisao["PJM_Codigo"]);

        }
        if (selectedDetalheRevisao["PJM_FlgRevisaoConcluida"] == 1) {
            $("#textAreaPJM_ParecerGP").attr("disabled", true);
            $("#buttonConcluirRevisao").attr("disabled", true);
        }
        // console.log(selectedDetalheMonitoramento);
        // $('#modalDetalhesGrupoAtividades').modal('show');
    });


    function fetchIndicadores(PJM_Codigo) {
        $.ajax({
            url: "<?php echo base_url(); ?>consultoria/revisaoMonitoramento/fetchIndicadores",
            dataType: 'text',
            type: 'POST',
            data: {PJM_Codigo: PJM_Codigo},
            success: function(data){

                var formattedString = data.replace(/\;/g, '\n');
                console.log(formattedString);
                $('#textAreaIndicadores').val(formattedString);

                $('[id^=divAlertReturn]').attr("class", "alert alert-light");
                $('[id^=divAlertReturn]').html("&nbsp;");

                // console.log(data.replace(/\;/g, '\n'));
                // console.log("SUCCESS");
            }

        });
    }
    //data: {AEA_CBRCODIGO: <?php //echo $this->session->userdata('userCodigo'); ?>//},

    function fetchRevisaoUsuario() {
        return $.ajax({
            url: "<?php echo base_url(); ?>consultoria/revisaoMonitoramento/fetchRevisaoUsuario",
            type: 'POST',
            dataType: 'json',
            data: {
                CBR_CODIGO: <?php echo $this->session->userdata('userCodigo'); ?>
            }
        });
    }

    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    //
    //var PJT_CODIGO = null;
    //var LCT_DATAINICIAL = "";
    //var LCT_DATAFINAL = "";
    //
    //$('#buttonRelatorio').click(function () {
    //
    //    PJT_CODIGO = $('#comboboxProjeto').val();
    //    LCT_DATAINICIAL = $('#inputTextLCT_DATAINICIAL').val().split("/").reverse().join("-");
    //    LCT_DATAFINAL = $('#inputTextLCT_DATAFINAL').val().split("/").reverse().join("-");
    //
    //    loadSpinner();
    //    fetchTotalHoras();
    //
    //
    //    $('#tableApontamentoHoras').DataTable().clear().destroy();
    //
    //    table = $('#tableApontamentoHoras').DataTable({
    //
    //        "destroy": true,
    //        "searching": false,
    //        "autoWidth": false,
    //        "retrieve": true,
    //        "paging": false,
    //        "sAjaxDataProp": "",
    //        "responsive": true,
    //        "info": false,
    //        "ajax": {
    //            "url": "<?php //echo base_url(); ?>//consultoria/relatorioApontamentoHoras/fetchApontamentoHoras",
    //            "type": 'POST',
    //            "data": {
    //                "CBR_CODIGO": <?php //echo $this->session->userdata('userCodigo'); ?>//,
    //                "LCT_DATAINICIAL": LCT_DATAINICIAL,
    //                "LCT_DATAFINAL": LCT_DATAFINAL,
    //                "PJT_CODIGO": PJT_CODIGO
    //            },
    //            complete: function (response) {
    //                arrayApontamentoHoras = JSON.parse(response.responseText);
    //                $('#divRelatorio').show();
    //            }
    //        },
    //        "language": {
    //            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
    //        },
    //        "order": [
    //            [0, "asc"]
    //        ],
    //        "rowId": 'LCT_CODIGO',
    //
    //        "columns": [
    //            {
    //                "data": "LCT_DATA",
    //                "defaultContent": "",
    //                "render": function (data, type, row) {
    //                    if (type == 'display' && data != null) {
    //                        return data.split("-").reverse().join("/");
    //                    }
    //                    return data;
    //                }
    //            },
    //            {
    //                "data": "LCT_HORAINICIO",
    //                "defaultContent": ""
    //            },
    //            {
    //                "data": "LCT_HORAFIM",
    //                "defaultContent": ""
    //            },
    //            {
    //                "data": "LCT_TEMPO",
    //                "defaultContent": ""
    //            },
    //            {
    //                "data": "ATG_DESCRICAO",
    //                "defaultContent": ""
    //            },
    //            {
    //                "data": "LCT_DESCRICAO",
    //                "defaultContent": ""
    //            }
    //        ],
    //        'initComplete': function (settings, json) {
    //            removeSpinner();
    //        },
    //        "columnDefs": [
    //            // {
    //            // 	targets: [4, 5],
    //            // 	render: function (data, type, row) {
    //            // 		if (data == null) {
    //            // 			return
    //            // 		}
    //            // 		return type === 'display' && data.length > 40 ?
    //            // 			data.substr(0, 40) + '…' :
    //            // 			data;
    //            // 	}
    //            // },
    //            {
    //                "width": "5%", "targets": [0, 1, 2, 3],
    //
    //            },
    //        ]
    //    });
    //});
    //
    //function fetchApontamentoHoras() {
    //    $.ajax({
    //        url: "<?php //echo base_url(); ?>//consultoria/relatorioApontamentoHoras/fetchProjetos",
    //        type: 'POST',
    //        dataType: 'json',
    //        data: {CBR_CODIGO: <?php //echo $this->session->userdata('userCodigo'); ?>//},
    //        success: function (data) {
    //            var html = "";
    //            html += '<option value=""> Todos os projetos </option>';
    //            for (var i = data.length - 1; i >= 0; i--) {
    //                html += '<option value="' + data[i].PJT_CODIGO + '"> ' + data[i].PJT_APELIDO + ' </option>';
    //            }
    //            $('#comboboxProjeto').html(html)
    //        }
    //    });
    //}
    //
    //$("#inputTextLCT_DATAINICIAL, #inputTextLCT_DATAFINAL, #inputTextLCT_DATA").mask("Dd/Mm/AAAA", {
    //    translation: {
    //        'D': {
    //            pattern: /[0-3]/,
    //            optional: false
    //        },
    //        'd': {
    //            pattern: /[0-9]/,
    //            optional: false
    //        },
    //        'M': {
    //            pattern: /[0-1]/,
    //            optional: false
    //        },
    //        'm': {
    //            pattern: /[0-9]/,
    //            optional: false
    //        },
    //        'A': {
    //            pattern: /[0-9]/,
    //            optional: false
    //        },
    //    },
    //    placeholder: "DD/MM/AAAA"
    //});
    //
    //var selectedApontamento = "";
    //$(document).on('click', '#tableApontamentoHoras > tbody > tr ', function () {
    //    $('#modalDetalhesApontamentoHoras').modal('show');
    //    selectedApontamento = arrayApontamentoHoras[table.row(this).index()];
    //    $('#comboboxAtividadesColaborador').val(table.row(this).data()["ATG_CODIGO"]);
    //    $('#inputTextLCT_CODIGOO').val(table.row(this).data()["LCT_CODIGO"]);
    //    $('#inputTextATG_DESCRICAO').val(selectedApontamento.ATG_DESCRICAO);
    //    $('#inputTextLCT_DATA').val(selectedApontamento.LCT_DATA.split("-").reverse().join("/"));
    //    $('#inputTextLCT_TEMPO').val(selectedApontamento.LCT_TEMPO);
    //    $('#inputTextLCT_HORAINICIO').val(selectedApontamento.LCT_HORAINICIO.substring(0, 5));
    //    $('#inputTextLCT_HORAFIM').val(selectedApontamento.LCT_HORAFIM.substring(0, 5));
    //    $('#textareaLCT_DESCRICAO').val(selectedApontamento.LCT_DESCRICAO);
    //    $('#inputTextLCT_CODCHAMADO').val(selectedApontamento.LCT_CODCHAMADO);
    //});
</script>


</body>
</html>