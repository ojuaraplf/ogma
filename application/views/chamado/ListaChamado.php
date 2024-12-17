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

    #tableChamados tbody tr {
      cursor: pointer;
    }
  </style>


</head>

<body style="background: #eeeeee;">


  <div id="main-wrapper">


    <?php $this->load->view('include/navBarChamado') ?>
    <?php $this->load->view('include/asidebar') ?>

    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Chamados </h4>
            <div class="ml-auto text-right">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                  <li class="breadcrumb-item active" aria-current="page"> Chamado</li>
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

                <div class="row mb-3">
                  <div class="col-6">
                    <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
                    <input type="text" class="form-control" id="inputTextFiltro"/>
                  </div>
							  </div>

                <div class="row mb-3">

                </div>

                <br />

                <table id="tableChamados" class="table table-hover">
                  <thead>
                    <tr>
                      <th> Código</th>
                      <th> Abertura</th>
                      <th> Descrição</th>
                      <th> PJT Apelido</th>
                      <th> Status</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer text-center">
          © 2019 wDiscovery Ltda.
        </footer>
      </div>


      <?php $this->load->view('include/headerBottom') ?>
      <?php $this->load->view('include/defaults') ?>
      <?php $this->load->view('modal/modalChecklist') ?>
      <?php $this->load->view('modal/modalChecklistItemDetalhes') ?>
      <?php $this->load->view('modal/modalNovoChamado') ?>

      <script type="text/javascript">

        function pesquisa_Tabela(){
          // Declare variables 
            var input, filter, table, tr, td, i;
            input = document.getElementById("inputTextFiltro");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableChamados");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td") ; 
              for(j=0 ; j<td.length ; j++)
              {
              let tdata = td[j] ;
              if (tdata) {
                if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                break ; 
                } else {
                tr[i].style.display = "none";
                }
              } 
              }
            }
        }

        var $rows = $('#tableChamados tbody tr');
        $('#inputTextFiltro').keyup(function() {
          pesquisa_Tabela();
        });


        loadSpinner();

        $('#liServico').addClass('selected');
		    $('#liServicoChamado').addClass('active');
		    $('#ulServico').addClass('in');

        var arrayChamados = [];

        $('#tableChamados').DataTable().clear().destroy();

        var table = $('#tableChamados').DataTable({
          "destroy": true,
          "searching": false,
          "retrieve": true,
          "paging": false,
          "sAjaxDataProp": "",
          "responsive": true,
          "info": false,


          "ajax": {
            "url": "<?php echo base_url(); ?>chamado/listaChamado/fetchChamados",
            "type": 'POST',
            "dataType": 'json',

            complete: function(response) {
              console.log(response.responseText);
              console.log(response.responseJSON);
              arrayChamados = response.responseJSON

            },
            error: function(e, ts, et) {
              console.log(e)
            },

          },

          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
          },
          "order": [
            [0, "Desc"]
          ],
          "rowId": 'CHD_Codigo',


          "columns": [{
              "data": "CHD_Codigo",
              "defaultContent": ""
              // "render": function (data, type, row) {
              //     if (type == 'display' && data != null) {
              //         return data.split("-").reverse().join("/");
              //     }
              //     return data;
              // }
            },
            {
              "data": "CHD_MomAbertura",
              "defaultContent": ""
            },
            {
              "data": "CHD_Descricao",
              "defaultContent": ""
            },

            {
              "data": "PJT_APELIDO",
              "defaultContent": ""
            },
            {
              "data": "STC_Descricao",
              "defaultContent": ""
            },


          ],

          'initComplete': function(settings, json) {
            removeSpinner();
          },
          "columnDefs": [{
              targets: 1,
              render: function(data, type, row) {
                var date = data.split(" ");
                return date[0].split("-").reverse().join("/");

              }
            },
            {
              "width": "5%",
              "targets": 0,

            },
            {
              "width": "10%",
              "targets": 1,

            },
          ]
        });


        var selectedChamado = "";
        $(document).on('click', '#tableChamados > tbody > tr ', function() {

          // window.open('<?php echo base_url('chamado/detalheChamado/') ?>' + selectedChamado.CHD_Codigo, '_self');
          selectedChamado = arrayChamados[table.row(this).index()];
          window.open('<?php echo base_url('detalheChamado/') ?>' + selectedChamado.CHD_Codigo, '_self');

        });
      </script>


</body>

</html>