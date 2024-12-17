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
    .img-size {
      padding: 20px;

      height: 450px;
      width: 100%;
      background-size: cover;
      object-fit: contain;
      overflow: hidden;
    }

    .modal-dialog {
      height: 100%
    }

    .modal-content {
      height: 90%
    }

    .modal-body {
      height: 100%;
      overflow: auto
    }

    .carousel-control-prev-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
      width: 30px;
      height: 48px;
    }

    .carousel-control-next-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
      width: 30px;
      height: 48px;
    }

    .divLabels {
      padding: 20px;
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
            <h4 class="card-title">Home</h4>
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



      </div>

    </div>
  </div>


  <!-- Notification modal -->
  <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div id='notificationCarousel' class='carousel slide' data-interval="false">
            <div class='carousel-inner'>
              <?php foreach ($notifications as $item) : ?>
                <div class='carousel-item <?= $item == $notifications[0] ? 'active' : '' ?>'>
                  <img class='img-size' src='<?= notificationFilesURL . $item['NOT_NomeImagem']; ?>' />
                  <div class="divLabels">
                    <h4> <?= $item['NOT_Titulo']; ?> </h4>
                    <p class="text-justify"><?= $item['NOT_Descricao']; ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="buttonPrevious" disabled>Anterior</button>
          <button type="button" class="btn btn-primary" id="buttonNext">Próximo</button>
          <button type="button" class="btn btn-secondary" id="buttonDismiss" data-dismiss="modal" disabled>Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('include/headerBottom') ?>
  <?php $this->load->view('include/defaults') ?>
  <script type="text/javascript">
    removeSpinner();
    $('#liHome').addClass('selected');
  </script>

</body>

</html>

<script type="text/javascript">
  const numberOfNotifications = <?= count($notifications); ?>;
  var actualNotification = 1;
  var readAllNotifications = false
  var notificationChecked = <?= $this->session->userdata('notificationChecked') == true ? 'true' : 'false' ?>;

  showNotification();

  function showNotification() {
    var userLogged = <?= $this->session->userdata('userCodigo') ?>;

    if (!notificationChecked && numberOfNotifications != 0 && (userLogged == 71 || userLogged == 78)) {
      updateButtons(1);
      $('#notificationModal').modal();
      <?php $this->session->set_userdata('notificationChecked', true); ?>
    }
  }

  $('#buttonPrevious').click(function() {
    $('#notificationCarousel').carousel('prev');
    actualNotification -= 1;
    updateButtons(actualNotification);
  });

  $('#buttonNext').click(function() {
    $('#notificationCarousel').carousel('next');
    actualNotification += 1;
    if (!readAllNotifications) {
      readAllNotifications = actualNotification == numberOfNotifications;
    }
    updateButtons(actualNotification);
  });

  function updateButtons(actualNotification) {
    if (numberOfNotifications == 1) {
      $('#buttonPrevious').prop('disabled', true);
      $('#buttonPrevious').addClass('btn-secondary');
      $('#buttonPrevious').removeClass('btn-primary');
      $('#buttonNext').prop('disabled', true);
      $('#buttonNext').addClass('btn-secondary');
      $('#buttonNext').removeClass('btn-primary');
      $('#buttonDismiss').prop('disabled', false);
      $('#buttonDismiss').addClass('btn-primary');
      $('#buttonDismiss').removeClass('btn-secondary');
      return;
    }

    $('#buttonPrevious').prop('disabled', actualNotification == 1);
    $('#buttonPrevious').addClass(actualNotification == 1 ? 'btn-secondary' : 'btn-primary');
    $('#buttonPrevious').removeClass(actualNotification == 1 ? 'btn-primary' : 'btn-secondary');

    $('#buttonNext').prop('disabled', actualNotification == numberOfNotifications);
    $('#buttonNext').addClass(actualNotification == numberOfNotifications ? 'btn-secondary' : 'btn-primary');
    $('#buttonNext').removeClass(actualNotification == numberOfNotifications ? 'btn-primary' : 'btn-secondary');

    $('#buttonDismiss').prop('disabled', !readAllNotifications);
    $('#buttonDismiss').addClass(readAllNotifications ? 'btn-primary' : 'btn-secondary');
    $('#buttonDismiss').removeClass(readAllNotifications ? 'btn-secondary' : 'btn-primary');
  }

  fetchFamiliaAtividade();
  fetchTipoMudancaCorrecao();
  fetch_ogm_catalogoservicoitem();
  fetch_ogsv_CIL_ItemCatalogoLabel();
  fetchContatoDetalhe();
  fetchColaboradores();
  fetch_ogsv_TLG_Tecnologia();
  fetchCargos();
  fetchogma_PES_Selecao02();
</script>