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
    <?php $this->load->view('include/navbarHome') ?>
    <?php $this->load->view('include/asidebar') ?>
    <br />
    <div class="page-wrapper">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <div class="col-md-6 center">
            <div class="card">
              <div class="card-body">
                <h4> Nova notificação </h4>
                <br />
                <form method="post" id="saveNotification" enctype="multipart/form-data">
                  <div class="col">

                    <div class="form-group row">
                      <label class="col-2 col-form-label">Título</label>
                      <div class="col-10">
                        <input type="text" class="form-control" id="inputTitle" name="inputTitle" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-2 col-form-label">Descrição</label>
                      <div class="col-10">
                        <textarea class="form-control" id="textareaDescription" name="textareaDescription" rows="5" required></textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-2 col-form-label">Habilitada</label>
                      <div class="col-10">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="checkboxEnabled" checked>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-2 col-form-label">Anexo:</label>
                      <div class="col-10">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="inputUploadFile" id="inputUploadFile" accept="image/png, image/jpeg" required>
                          <label class="custom-file-label" for="inputUploadFile" id="labelFile">Escolha o arquivo...</label>
                        </div>
                      </div>
                    </div>

                    <div class="alert alert-danger collapse" id="alert" role="alert">
                      <span id="spanAlertMessage"> </span>
                    </div>
                    <br />
                    <div class="form-group row">
                      <div class="col-10">
                        <input type="submit" id="saveButton" value="Adicionar notificação" class="btn btn-primary" />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer text-center">
        © 2019 wDiscover Ltda.
      </footer>

      <?php $this->load->view('include/headerBottom') ?>
      <?php $this->load->view('include/defaults') ?>

      <script type="text/javascript">
        removeSpinner();

        $('#inputUploadFile').change(function() {
          $('#labelFile').text($('#inputUploadFile')[0].files[0].name)
        });

        $('#saveNotification').on('submit', function(e) {
          e.preventDefault();
          $('#alert').hide();

          var isEnabled = $('#checkboxEnabled').is(':checked');
          var formData = new FormData(this);
          formData.append("isEnabled", isEnabled);

          loadBlurSpinner();

          $.ajax({
            url: "<?php echo base_url(); ?>configuracao/notificacao/save",
            dataType: 'json',
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function(data) {
              if (data.status === 404) {
                $('#spanAlertMessage').text(data.message);
                $('#alert').show();
              }
              window.open('<?= base_url("notificacao/lista"); ?>', '_self');
              removeSpinner();
            },
          });
        });
      </script>
</body>

</html>