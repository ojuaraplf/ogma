<?php
if (!($this->session->has_userdata('userToken'))) {
  redirect('login');
}
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>wDiscovery</title>
  <?php $this->load->view('include/headerTop') ?>

  <style type="text/css">
    .tooltip-inner {
      max-width: 350px;

    }

    html {
      visibility: hidden;
    }

    .spanDetalheProjetoTitulo {
      font-size: 14px;
      font-weight: bold;
    }

    .spanDetalheProjetoConteudo {
      font-size: 14px;
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
            <h4 class="page-title">COD: <span id="spanCHD_Codigo"> <?php echo $this->uri->segment(2); ?> </span></h4>
            <div class="ml-auto text-right">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript:history.back()">Chamados</a></li>
                  <li class="breadcrumb-item"><a href="#">DetalheChamado</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">

        <div id="divCabecalhoChamado"></div>

        <div class="row">
          <div class="col-10">
            <h4> Interações </h4>
          </div>
          <div class="col-2 text-right">
            <button class="btn btn-primary" id="btnNovaInteracaoTapped" data-toggle="modal" data-target="#modalNovaInteracao"> <i class="fas fa-align-justify"></i> Nova Interação </button>
          </div>
        </div>


        <div id="divInteracoes"></div>

      </div>
    </div>


    <?php $this->load->view('include/handlebar/chamado/cellInteracao') ?>
    <?php $this->load->view('include/handlebar/chamado/cabecalhoChamado') ?>
    <?php $this->load->view('include/headerBottom') ?>

    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalNovaInteracao') ?>

    <script type="text/javascript">
      loadSpinner();

      // FETCHING fetchogma_PES_Selecao02  --------------------------------------------------------------------------------------
      var jsonArrayogma_PES_Selecao02 = JSON.parse(localStorage.arrayogma_PES_Selecao02);
      var htmlogma_PES_Selecao02 = [];
      htmlogma_PES_Selecao02.push('<option>Selecione um fornecedor de requisito...</option>');
      for (var i = 0; i <= jsonArrayogma_PES_Selecao02.length - 1; i++) {
        htmlogma_PES_Selecao02.push('<option value="' + jsonArrayogma_PES_Selecao02[i].CODIGO + '">' + jsonArrayogma_PES_Selecao02[i].PESSOA + '</option>');
      }
      optionsogma_PES_Selecao02 = htmlogma_PES_Selecao02;
      // -----------------------------------------------------------------------------------------------------


      $('#comboboxCHD_PFR_Codigo').html(optionsogma_PES_Selecao02);
      $('#comboboxCHI_USUCodigo').html(optionsogma_PES_Selecao02);
      $('#comboboxCHI_USUCodigo').val(<?php echo $this->session->userdata('userCodigo'); ?>);



      $('#liServico').addClass('selected');
      $('#liServicoChamado').addClass('active');
      $('#ulServico').addClass('in');

      var selectedChamado = "";

      $('#btnNovaInteracaoTapped').click(function() {
        $('#comboboxCHD_CHPCodigo').val(selectedChamado.CHD_CHPCodigo);
        $('#comboboxCHD_CHCCodigo').val(selectedChamado.CHD_CHCCodigo);
        $('#comboboxCHD_STCCodigo').val(selectedChamado.CHD_STCCodigo);
        $('#comboboxCHD_CBRCodigo').val(selectedChamado.CHD_CBRCodigo);
        $('#comboboxCHD_PFR_Codigo').val(selectedChamado.CHD_PFR_Codigo);
        $('#inputTextCHI_QtHora').val(selectedChamado.CHD_QtHora);

        if (selectedChamado.CHD_ATGWbsItem != null) {
          $('#selectCHD_ATGWbsItem').val(selectedChamado.CHD_ATGWbsItem.padStart(2, '0'));
          $('#selectCHD_ATGWbsItem').prop('disabled', true);          
        }
      });

      $.when(fetchChamado(), fetchChamadoInteracao()).done(function(r1, r2) {
        selectedChamado = r1[0];
        fetchCBRFase(r1[0].PJF_CODIGO);
        $("#divCabecalhoChamado").html(Handlebars.compile($('#cabecalhoChamado').html())({
          chamado: r1[0]
        }));
        $("#divInteracoes").html(Handlebars.compile($('#cellInteracao').html())({
          interacoes: r2[0]
        }));
        removeSpinner();
      });


      function fetchChamado() {
        return $.ajax({
          url: "<?php echo base_url(); ?>chamado/detalheChamado/fetchChamado",
          type: 'POST',
          dataType: "json",
          data: {
            CHD_Codigo: <?php echo $this->uri->segment(2); ?>
          },
          error: function(request, status, error) {
            alert(request.responseText);
          }
        });
      }

      function fetchChamadoInteracao() {
        return $.ajax({
          url: "<?php echo base_url(); ?>chamado/detalheChamado/fetchChamadoInteracao",
          type: 'POST',
          dataType: "json",
          data: {
            CHI_CHDCodigo: <?php echo $this->uri->segment(2); ?>
          },
          error: function(request, status, error) {
            alert(request.responseText);
          }
        });
      }
    </script>

</body>

</html>