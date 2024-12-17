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
            <h4 class="page-title"> Minhas Atividade </h4>
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

                <table class="table table-sm table-bordered" id="tableAtividadesPendentes">
                  <thead>
                    <tr>
                      <th> Projeto</th>
                      <th> Atividade</th>
                      <th> Status</th>

                      <th> Prazo da ANS </th>
                      <th> Vencimento </th>
                      <th> Prazo corrente</th>

                      <!-- <th> ANS?</th> -->


                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>



                <!-- <br />
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalApontamentoHoras"> ABRIR MODAL </button>
                <br /> -->

              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('include/headerBottom') ?>
  <?php $this->load->view('include/defaults') ?>
  <?php $this->load->view('modal/modalApontamentoHoras') ?>
  <?php $this->load->view('modal/modalApontamentoHoraPeriodoExiste') ?>
  <?php $this->load->view('modal/modalApontamentoHoraSucesso') ?>


  <script type="text/javascript">
    removeSpinner();

    //loadSpinner();
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
    var arrayAtividadesPendentes = [];


    var table = $('#tableAtividadesPendentes').DataTable();
    //

    fetchAtividadesPendentes();
    //function fetchAtividadesPendentes() {
    //    $.ajax({
    //        url: "<?php //echo base_url(); 
                    ?>//consultoria/relatorioAtividadesPendentes/fetchAtividadesPendentes",
    //        type: 'POST',
    //        dataType: 'json',
    //        data: {
    //            CBR_CODIGO: <?php //echo $this->session->userdata('userCodigo'); 
                              ?>//,
    //        },
    //        success: function (data) {
    //            console.log(data);
    //
    //        },
    //        error: function (request, status, error) {
    //            console.log(request.responseText);
    //        }
    //    });
    //}

    $('#tableAtividadesPendentes tbody').on('click', 'td', function() {
      selectedRow = arrayAtividadesPendentes[table.row($(this).closest('tr')).index()];
      // atividadesArray[li.index()].PJT_APELIDO + ' - ' + atividadesArray[li.index()].ATG_ORDEM + ' - ' + atividadesArray[li.index()].ATG_DESCRICAO;



    });


    var selectedRow = "";

    function fetchAtividadesPendentes() {


      loadSpinner();
      // fetchTotalHoras();


      $('#tableAtividadesPendentes').DataTable().clear().destroy();

      table = $('#tableAtividadesPendentes').DataTable({

        "destroy": true,
        "searching": false,
        "autoWidth": false,
        "retrieve": true,
        "paging": false,
        "sAjaxDataProp": "",
        "responsive": true,
        "info": false,
        "ajax": {
          "url": "<?php echo base_url(); ?>consultoria/relatorioAtividadesPendentes/fetchAtividadesPendentes",
          "type": 'POST',
          "data": {
            "CBR_CODIGO": <?php echo $this->session->userdata('userCodigo'); ?>,
          },
          complete: function(response) {
            arrayAtividadesPendentes = JSON.parse(response.responseText);
            console.log(arrayAtividadesPendentes);
            // $('#divRelatorio').show();
          },
          error: function(request, status, error) {
            console.log(request.responseText);
          }
        },
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
        },
        "order": [
          [5, "desc"]
        ],
        "rowId": 'ATG_CODIGO',

        "columns": [
          // {
          //     "data": "LCT_DATA",
          //     "defaultContent": "",
          //     "render": function (data, type, row) {
          //         if (type == 'display' && data != null) {
          //             return data.split("-").reverse().join("/");
          //         }
          //         return data;
          //     }
          // },
          // {
          //     "data": "ATG_CODIGO",
          //     "defaultContent": ""
          // },
          {
            "data": "PJT_APELIDO",
            "defaultContent": "",
            "render": function(data, type, row, meta) {
              if (type === 'display') {
                // data = '<a href="' + data + '">' + data + '</a>';
                data = '<a href="<?php echo base_url('detalheProjeto/') ?>' + row["PJT_CODIGO"] + '">' + data + '</a>';
              }
              return data;
            }
          },
          {
            "data": "ATG_DESCRICAO",
            "defaultContent": "",
            "render": function(data, type, row, meta) {
              if (type === 'display') {
                // data = '<a href="' + data + '">' + data + '</a>';
                data = '<a href="modalApontamentoHoras" data-toggle="modal" data-target="#modalApontamentoHoras">' + row.ATG_CODIGO + ' - ' + data + '</a>';
              }
              return data;
            }

          },
          // {
          //     "data": "CHC_Descricao",
          //     "defaultContent": " - "
          // },
          {
            "data": "STC_Descricao",
            "defaultContent": " - "
          },

          {
            "data": "ATG_AnsPrazo",
            "defaultContent": ""
          },
          {
            "data": "ANS",
            "defaultContent": "",
            "render": function(data, type, row) {
              if (type == 'display' && data != null) {
                var splited = data.split(" ");

                return splited[0].split("-").reverse().join("/") + " " + splited[1];
                // return data;
              }
              return data;
            }
          },
          {
            "data": "HORASAGORAPARAVENCIMENTO",
            "defaultContent": "",
            "render": function(data, type, row) {
              if (type == 'display' && data != null) {


                switch (row.ATG_AnsCriticidade) {
                  case '1':
                    return '<span style="color: green;"> ' + data + ' </span>';
                    break;

                  case '2':
                    return '<span style="color: #cccc00;"> ' + data + ' </span>';
                    break;
                  case '3':
                    return '<span style="color: red;"> ' + data + ' </span>';
                    break;

                  default:
                    return '<span style="color: black;"> ' + data + ' </span>';
                    break;

                }

                // if (row.PORCENTAGEMREALIZADA <= 0) {
                //     return '<span style="color: red;"> ' + data + ' </span>';
                // } else if (row.PORCENTAGEMREALIZADA <= 50) {
                //     return '<span style="color: #cccc00;"> ' + data + ' </span>';
                // } else {
                //     return '<span style="color: green;"> ' + data + ' </span>';
                // }




                //
                // if (parseFloat(row.PORCENTAGEMREALIZADA) == null) {
                //   return '<span style="color: black;"> ' + data + ' </span>';
                // }else if (parseFloat(row.PORCENTAGEMREALIZADA) < 0) {
                //
                //
                // } else if (parseFloat(row.PORCENTAGEMREALIZADA) <= 30) {
                //     return '<span style="color: yellow;"> ' + data + ' </span>';
                // } else {
                //     return '<span style="color: green;"> ' + data + ' </span>';
                // }


                // if (parseFloat(row.PORCENTAGEMREALIZADA) <= 70 && parseFloat(row.PORCENTAGEMREALIZADA) > 0) {
                //     console.log('CHEGO AQUI');
                //     return '<span style="color: green;"> ' + data + ' </span>';
                // } else if (parseFloat(row.PORCENTAGEMREALIZADA) > 70 && parseFloat(row.PORCENTAGEMREALIZADA >= 0)) {
                //     return '<span style="color: yellow;"> ' + data + ' </span>';
                // } else {
                //     return '<span style="color: red;"> ' + data + ' </span>';
                // }







              }
            }
          }

          // {
          //   "data": "PJT_FlgAnsContratada",
          //   "defaultContent": "",
          //   "render":

          //     function(data, type, row) {
          //       if (type == 'display' && data != null) {


          //         if (data == 1) {
          //           return '<i class="fas fa-check"></i>'
          //         } else {
          //           return '';
          //         }
          //       }
          //     }
          // }

        ],
        'initComplete':
          function(settings, json) {
            removeSpinner();
          }

          ,
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
            "width": "7%",
            "targets": [3, 4, 5],

          },
        ]
      });
    }

    //
    //function fetchApontamentoHoras() {
    //    $.ajax({
    //        url: "<?php //echo base_url(); 
                    ?>//consultoria/relatorioApontamentoHoras/fetchProjetos",
    //        type: 'POST',
    //        dataType: 'json',
    //        data: {CBR_CODIGO: <?php //echo $this->session->userdata('userCodigo'); 
                                  ?>//},
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