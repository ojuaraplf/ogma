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
  <title>wD Ogma</title>

  <?php $this->load->view('include/headerTop') ?>


  <style>
    html {
      visibility: hidden;
    }

    #tableSTP tbody tr {
      cursor: pointer;
    }
  </style>


</head>

<body style="background: #eeeeee;">


  <div id="main-wrapper">


    <?php $this->load->view('include/navBarStatusChamado') ?>
    <?php $this->load->view('include/asidebar') ?>

    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Status do Projeto </h4>
            <div class="ml-auto text-right">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                  <li class="breadcrumb-item active" aria-current="page"> Status do Projeto</li>
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

                </div>

                <br />

                <table id="tableSTP" class="table table-hover">
                  <thead>
                    <tr>
                      <th> Código</th>
                      <th> Descrição</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer text-center">
          © 2019 wDiscover Ltda.
        </footer>
      </div>


      <?php $this->load->view('include/headerBottom') ?>
      <?php $this->load->view('include/defaults') ?>
     
      <script type="text/javascript">
        loadSpinner();

        $('#liConfiguracao').addClass('selected');
		    $('#liStp').addClass('active');
	    	$('#ulConfiguracao').addClass('in');

        var arrayStc = [];

        $('#tableSTP').DataTable().clear().destroy();

        var table = $('#tableSTP').DataTable({
          "destroy": true,
          "searching": false,
          "retrieve": true,
          "paging": false,
          "sAjaxDataProp": "",
          "responsive": true,
          "info": false,


          "ajax": {
            "url": "<?php echo base_url(); ?>configuracao/StpLista/fetchStp",
            "type": 'POST',
            "dataType": 'json',

            complete: function(response) {
              console.log(response.responseText);
              console.log(response.responseJSON);
              arrayStc = response.responseJSON

            },
            error: function(e, ts, et) {
              console.log(e)
            },

          },

          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
          },
          "order": [
            [0 ,'asc']
          ],

          "rowId": 'STP_CODIGO',

          "columns": [{
              "data": "STP_CODIGO",
              "defaultContent": ""
            },
            {
              "data": "STP_DESCRICAO",
              "defaultContent": ""
            },
          ],

          'initComplete': function(settings, json) {
            removeSpinner();
          },
          "columnDefs": [
            {
              "width": "5%",
              "targets": 0,

            },
            {
              "width": "80%",
              "targets": 1,

            },
          ]
        });

        var selectedStp = "";
        $(document).on('click', '#tableSTP > tbody > tr ', function() {
          selectedStp = arrayStc[table.row(this).index()];
          window.open('<?php echo base_url('EditaStatusProjeto/') ?>' + selectedStp.STP_CODIGO, '_self');
        });
      </script>


</body>

</html>