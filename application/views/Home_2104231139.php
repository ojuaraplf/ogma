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
                &nbsp;
            </div>
            <?php $this->load->view('include/headerBottom') ?>
            <?php $this->load->view('include/defaults') ?>
            <script type="text/javascript">
                removeSpinner();
                $('#liHome').addClass('selected');
            </script>
        </div>

</body>

</html>

<script type="text/javascript">
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