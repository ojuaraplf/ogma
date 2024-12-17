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
          <h4 class="page-title">Relatório Apontamento Horas </h4>
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
              <h4 class="card-title">Filtro</h4>
              <div class="border-top"></div>
              <br/>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="" class="text-left control-label col-form-label"> Data Inicial </label>
                  <input type="texit" class="form-control" id="inputTextLCT_DATAINICIAL" autocomplete="off"/>
                </div>
                <div class="col-3">
                  <label for="" class="text-left control-label col-form-label"> Data Final </label>
                  <input type="texit" class="form-control" id="inputTextLCT_DATAFINAL" autocomplete="off"/>
                </div>

                <div class="col-6">
                  <label for="" class="text-left control-label col-form-label"> Projeto </label>
                  <select class="form-control" id="comboboxProjeto">
                  </select>
                </div>


              </div>
              <div class="row">
                <div class="col">
                  <button class="btn btn-primary" id="buttonRelatorio"> Relatório</button>
                </div>
              </div>


              <br/>

              <div id="divRelatorio" class="table-responsive">


                <div class="border-top"></div>
                <br/>
                <div class="row">
                  <div class="col-9">
                    <h4 class="card-title">Relatório Apontamento Horas</h4>
                  </div>
                  <div style="text-align: right;" class="col-3">
                    <h4 style="font-weight: bold;" class="card-title">TOTAL HORAS: <span id="spanTotalHoras"> - </span>
                    </h4>
                  </div>

                </div>


                <br/>
                <!--								<div class="table-responsive">-->


                <table class="table table-sm table-bordered" id="tableApontamentoHoras">
                  <thead>
                  <tr>
                    <th> Data</th>
                    <th> Inicio</th>
                    <th> Fim</th>
                    <th> Tempo</th>
                    <th> Plano de Serviço</th>
                    <th> Atividade</th>
                    <th> Descrição</th>
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
</div>

<?php $this->load->view('include/headerBottom') ?>
<?php $this->load->view('include/defaults') ?>
<?php $this->load->view('modal/modalRelatorioApontamentoHora') ?>
<?php $this->load->view('modal/modalDetalhesApontamentoHoras') ?>
<?php $this->load->view('modal/modalConfirmarRemocaoApontamento') ?>


<script type="text/javascript">
    loadSpinner();
    $('#divRelatorio').hide();

    $(document).ready(function () {

        document.getElementsByTagName("html")[0].style.visibility = "visible";

        $('#inputTextLCT_DATAINICIAL, #inputTextLCT_DATAFINAL').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "dd/mm/yyyy",
            orientation: "bottom right",
            maxViewMode: 1
        });
    });

    fetchApontamentoHoras();
    var arrayApontamentoHoras = [];
    var table = $('#tableApontamentoHoras').DataTable();

    function fetchTotalHoras() {
        $.ajax({
            url: "<?php echo base_url(); ?>consultoria/relatorioApontamentoHoras/fetchTotalHoras",
            type: 'POST',
            dataType: 'json',
            data: {
                CBR_CODIGO: <?php echo $this->session->userdata('userCodigo'); ?>,
                LCT_DATAINICIAL: LCT_DATAINICIAL,
                LCT_DATAFINAL: LCT_DATAFINAL,
                PJT_CODIGO: PJT_CODIGO
            },
            success: function (data) {
                if (data.LCT_TEMPO != null) {
                    $('#spanTotalHoras').text(parseFloat(data.LCT_TEMPO).toFixed(2));
                } else {
                    $('#spanTotalHoras').text(" - ");
                }
            }
        });
    }

    var PJT_CODIGO = null;
    var LCT_DATAINICIAL = "";
    var LCT_DATAFINAL = "";

    $('#buttonRelatorio').click(function () {

        PJT_CODIGO = $('#comboboxProjeto').val();
        LCT_DATAINICIAL = $('#inputTextLCT_DATAINICIAL').val().split("/").reverse().join("-");
        LCT_DATAFINAL = $('#inputTextLCT_DATAFINAL').val().split("/").reverse().join("-");

        loadSpinner();
        fetchTotalHoras();

        $('#tableApontamentoHoras').DataTable().clear().destroy();

        table = $('#tableApontamentoHoras').DataTable({

            "destroy": true,
            "searching": false,
            "autoWidth": false,
            "retrieve": true,
            "paging": false,
            "sAjaxDataProp": "",
            "responsive": true,
            "info": false,
            "ajax": {
                "url": "<?php echo base_url(); ?>consultoria/relatorioApontamentoHoras/fetchApontamentoHoras",
                "type": 'POST',
                "data": {
                    "CBR_CODIGO": <?php echo $this->session->userdata('userCodigo'); ?>,
                    "LCT_DATAINICIAL": LCT_DATAINICIAL,
                    "LCT_DATAFINAL": LCT_DATAFINAL,
                    "PJT_CODIGO": PJT_CODIGO
                },
                complete: function (response) {
                    arrayApontamentoHoras = JSON.parse(response.responseText);
                    $('#divRelatorio').show();
                }
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "asc"]
            ],
            "rowId": 'LCT_CODIGO',

            "columns": [
                {
                    "data": "LCT_DATA",
                    "defaultContent": "",
                    "render": function (data, type, row) {
                        if (type == 'display' && data != null) {
                            return data.split("-").reverse().join("/");
                        }
                        return data;
                    }
                },
                {
                    "data": "LCT_HORAINICIO",
                    "defaultContent": ""
                },
                {
                    "data": "LCT_HORAFIM",
                    "defaultContent": ""
                },
                {
                    "data": "LCT_TEMPO",
                    "defaultContent": ""
                },
                {
                    "data": "PJT_APELIDO",
                    "defaultContent": ""
                },
                {
                    "data": "ATG_DESCRICAO",
                    "defaultContent": ""
                },
                {
                    "data": "LCT_DESCRICAO",
                    "defaultContent": ""
                }
            ],
            'initComplete': function (settings, json) {
                removeSpinner();
            },
            "columnDefs": [
                // {
                // 	targets: [4, 5],
                // 	render: function (data, type, row) {
                // 		if (data == null) {
                // 			return
                // 		}
                // 		return type === 'display' && data.length > 40 ?
                // 			data.substr(0, 40) + '…' :
                // 			data;
                // 	}
                // },
                {
                    "width": "5%", "targets": [0, 1, 2, 3],

                },
            ]
        });
    });

    function fetchApontamentoHoras() {
        $.ajax({
            url: "<?php echo base_url(); ?>consultoria/relatorioApontamentoHoras/fetchProjetos",
            type: 'POST',
            dataType: 'json',
            data: {CBR_CODIGO: <?php echo $this->session->userdata('userCodigo'); ?>},
            success: function (data) {
                var html = "";
                html += '<option value=""> Todos os projetos </option>';
                for (var i = data.length - 1; i >= 0; i--) {
                    html += '<option value="' + data[i].PJT_CODIGO + '"> ' + data[i].PJT_APELIDO + ' </option>';
                }
                $('#comboboxProjeto').html(html)
            }
        });
    }

    $("#inputTextLCT_DATAINICIAL, #inputTextLCT_DATAFINAL, #inputTextLCT_DATA").mask("Dd/Mm/AAAA", {
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

    var selectedApontamento = "";
    $(document).on('click', '#tableApontamentoHoras > tbody > tr ', function () {
        $('#modalDetalhesApontamentoHoras').modal('show');
        selectedApontamento = arrayApontamentoHoras[table.row(this).index()];
        $('#comboboxAtividadesColaborador').val(table.row(this).data()["ATG_CODIGO"]);
        $('#inputTextLCT_CODIGOO').val(table.row(this).data()["LCT_CODIGO"]);
        $('#inputTextATG_DESCRICAO').val(selectedApontamento.ATG_DESCRICAO);
        $('#inputTextLCT_DATA').val(selectedApontamento.LCT_DATA.split("-").reverse().join("/"));
        $('#inputTextLCT_TEMPO').val(selectedApontamento.LCT_TEMPO);
        $('#inputTextLCT_HORAINICIO').val(selectedApontamento.LCT_HORAINICIO.substring(0, 5));
        $('#inputTextLCT_HORAFIM').val(selectedApontamento.LCT_HORAFIM.substring(0, 5));
        $('#textareaLCT_DESCRICAO').val(selectedApontamento.LCT_DESCRICAO);
        $('#inputTextLCT_CODCHAMADO').val(selectedApontamento.LCT_CODCHAMADO);
    });
</script>


</body>
</html>