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
</head>

<body style="background: #eeeeee;">
  <div id="main-wrapper">
    <?php $this->load->view('include/navbarNotificacao') ?>
    <?php $this->load->view('include/asidebar') ?>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Notificações </h4>
            <div class="ml-auto text-right">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page"> Lista</li>
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
                <table id="tableNotifications" class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5%;">#</th>
                      <th>Título</th>
                      <th style="width: 5%;">Ativo</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
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

        var notifications = <?= $notifications; ?>;

        var table = $('#tableNotifications').DataTable({
          data: notifications,
          destroy: true,
          data: notifications,
          searching: true,
          paging: false,
          responsive: true,
          info: false,
          dom: '<"top">rt<"bottom"p><"clear">',
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
          },
          rowId: 'NOT_Codigo',
          columns: [{
              data: "NOT_Codigo",
              defaultContent: ""

            },
            {
              data: "NOT_Titulo",
              defaultContent: ""

            },
            {
              data: "NOT_Habilitada",
              defaultContent: ""

            }
          ],
          initComplete: function(settings, json) {
            removeSpinner();
          },
          order: [],
          columnDefs: [{
            targets: 2,
            render: function(data, type, row) {
              var isChecked = row['NOT_Habilitada'] == 1 ? 'checked' : "";
              var idCheckbox = "checkbox_" + row['NOT_Codigo'];
              var htmlString = '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="' + idCheckbox + '" ' + isChecked + '><label class="custom-control-label" for="' + idCheckbox + '"></label></div>'
              return htmlString;
            }
          }]
        });

        $(document).on('change', '[id^=checkbox]', function(e) {
          const id = e.target.id.split('_').pop();
          const isEnabled = $(this).is(':checked') ? 1 : 0;
          loadBlurSpinner();
          $.when(changeNotificationEnable(id, isEnabled)).done(function() {
            removeSpinner();
          });
        });

        function changeNotificationEnable(id, isEnabled) {
          return $.ajax({
            url: "<?php echo base_url(); ?>configuracao/notificacao/changeEnabledDisabled",
            dataType: 'json',
            type: 'POST',
            data: {
              NOT_Codigo: id,
              NOT_Habilitada: isEnabled
            },
            success: function(x) {
              console.log(x);
            }
          });
        }

        $('#buttonNew').click(function() {
          console.log("CLICK!!!")

          window.open('<?php echo base_url('notificacao/adicionar/') ?>', '_self');
        });
      </script>
</body>

</html>