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
    <title>Configuração do Serviço</title>

    <?php $this->load->view('include/headerTop') ?>
    <style>
        html {
      visibility: hidden;
    }
  </style>

</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
    <?php $this->load->view('include/navBarUsuario') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="card-title">Configuração Módulo Serviço</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Configuração Serviço </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="inputMomLimiteMenor" class="text-left control-label col-form-label">Data limite menor de apontamento </label>
                                        <input type="date" class="form-control" value="<?= $Svc_Edita->SVC_ApontaLimiteMenor ?>" id="inputMomLimiteMenor" />
                                    </div>
                                    <div class="col-4">
                                        <label for="inputMomLimiteMaior" class="text-left control-label col-form-label">Data limite maior de apontamento </label>
                                        <input type="date" class="form-control" value="<?= $Svc_Edita->SVC_ApontaLimiteMaior ?>" id="inputMomLimiteMaior" />
                                    </div>
                                </div>
                                <br />
                                <button class="btn btn-primary" id="btnSalvar"> Salvar configurações</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>


    <script type="text/javascript">
        removeSpinner();
        setInputTextHints();

        $('#liConfiguracao').addClass('selected');
    	$('#liEditaSvc').addClass('active');
        $('#ulConfiguracao').addClass('in');

        $('#btnSalvar').click(function() {
            // if ($('#selectCBR_CBUCodigo')[0].selectedIndex == 0 ||
            //     $('#selectCBR_PESempCodigo')[0].selectedIndex == 0 ||
            //     $('#selectCBR_CGOcodigo')[0].selectedIndex == 0) {
            //     Swal.fire(
            //         'Aviso',
            //         'Necessário preencher todos os campos para salvar as informações do colaborador',
            //         'warning'
            //     )
            //     return;
            // }
            loadBlurSpinner();
            $.when(UpdateSvc()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Configurações salvas',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });


        function UpdateSvc() {

            var SVC_ApontaLimiteMenor = $('#inputMomLimiteMenor').val();
            var SVC_ApontaLimiteMaior = $('#inputMomLimiteMaior').val();

            $.ajax({
                url: "<?php echo base_url(); ?>configuracao/ConfServEdita/updateConfServEdita",
                type: 'POST',
                data: {
                    SVC_ApontaLimiteMenor: SVC_ApontaLimiteMenor,
                    SVC_ApontaLimiteMaior: SVC_ApontaLimiteMaior
                }
            });
        }

        function setInputTextHints() {
            $('#inputMomLimiteMenor').prop('title', 'Informe a menor data permitida para apontamento de horas.');
            $('#inputMomLimiteMaior').prop('title', 'Informe a maior data permitida para apontamento de horas.');
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }  

    </script>

</body>

</html> 