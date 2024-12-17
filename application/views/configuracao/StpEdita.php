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
    <title>wDiscover</title>

    <?php $this->load->view('include/headerTop') ?>
    <style>
        html {
      visibility: hidden;
    }
  </style>

</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navBarStatusProjeto') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="card-title">Edita Status de Projeto</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Edita Status do Projeto</li>
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
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label">Código </label>
                                        <input type="text" class="form-control" value="<?= $status->STP_CODIGO ?>" id="inputTextCodStatus" disabled />
                                    </div>
                                    <div class="col-10">
                                        <label for="" class="text-left control-label col-form-label">Descrição do Status </label>
                                        <input type="text" class="form-control" value="<?= $status->STP_DESCRICAO ?>" id="inputTextDescStatus" />
                                    </div>
                                </div>
                                <br />
                                <div class="row mb-3">   
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STP_FlgApontaHora == 1 ? 'checked' : '' ?> id="checkboxSTP_FlgApontaHora">
                                        <label class="text-left" for="checkboxSTP_FlgApontaHora">Aponta hora</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STP_FlgProjetoAtivo == 1 ? 'checked' : '' ?> id="checkboxSTP_FlgProjetoAtivo">
                                        <label class="text-left" for="checkboxSTP_FlgProjetoAtivo">Projeto ativo</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STP_FlgProjetoEmExecucao == 1 ? 'checked' : '' ?> id="checkboxSTP_FlgProjetoEmExecucao">
                                        <label class="text-left" for="checkboxSTP_FlgProjetoEmExecucao">Em execução</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STP_FlgProjetoParaFaturamento == 1 ? 'checked' : '' ?> id="checkboxSTP_FlgProjetoParaFaturamento">
                                        <label class="text-left" for="checkboxSTP_FlgProjetoParaFaturamento">Para faturamento</label>
                                    </div>
                                </div>
                                <br />
                                <div class="border-top"></div>
                                <br />
                                <button class="btn btn-primary"  id="btnSalvar"> Salvar Status </button>
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
		$('#liStp').addClass('active');
		$('#ulConfiguracao').addClass('in');

        $('#btnSalvar').click(function() {

            loadBlurSpinner();
            $.when(UpdateStp()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Status salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });


        function UpdateStp() {
            var STP_CODIGO = $('#inputTextCodStatus').val();
            var STP_DESCRICAO = $('#inputTextDescStatus').val();
            var STP_FlgApontaHora = $('#checkboxSTP_FlgApontaHora').is(":checked") ? 1 : 0;
            var STP_FlgProjetoAtivo = $('#checkboxSTP_FlgProjetoAtivo').is(":checked") ? 1 : 0;
            var STP_FlgProjetoEmExecucao = $('#checkboxSTP_FlgProjetoEmExecucao').is(":checked") ? 1 : 0;
            var STP_FlgProjetoParaFaturamento = $('#checkboxSTP_FlgProjetoParaFaturamento').is(":checked") ? 1 : 0;
            
            $.ajax({
                url: "<?php echo base_url(); ?>configuracao/StpLista/UpdateStp",
                
                type: 'POST',
                data: {

                    STP_CODIGO: STP_CODIGO,
                    STP_DESCRICAO: STP_DESCRICAO,
                    STP_FlgEditaPjtCabecalho: 1,
                    STP_FlgEditaFasCabecalho: 1,
                    STP_FlgEditaFasDeclaEscopo: 1,
                    STP_FlgEditaFasExecucao: 1,
                    STP_FlgEditaFasPartesInteressadas: 1,
                    STP_FlgEditaFasContingencias: 1,
                    STP_FlgEditaFasAgenda: 1,
                    STP_FlgEditaFasHomologacao: 1,
                    STP_FlgApontaHora: STP_FlgApontaHora,
                    STP_FlgProjetoAtivo: STP_FlgProjetoAtivo,
                    STP_FlgProjetoEmExecucao: STP_FlgProjetoEmExecucao,
                    STP_FlgProjetoParaFaturamento: STP_FlgProjetoParaFaturamento
                }
            });
        }


        function setInputTextHints() {
            $('#inputTextDescStatus').prop('title', 'Edite a descrição do status.\n Por convenção, inicia-se com verbo em gerúndio.');

            $('#checkboxSTP_FlgApontaHora').prop('title', 'Status de projeto em fase de apontamento de horas.\nMarcado, significa que as atividades estarão na lista dos consultores alocado no projeto/atividade.');
            $('#checkboxSTP_FlgProjetoAtivo').prop('title', 'Status de projeto ativo.\nMarcado, significa que o projeto está em fase importante, considerável, atuante.');
            $('#checkboxSTP_FlgProjetoEmExecucao').prop('title', 'Status do projeto em execução.\nMarcado, significa que o projeto está em execução dos seviços.');
            $('#checkboxSTP_FlgProjetoParaFaturamento').prop('title', 'Status do projeto em faturamento.\nMarcado, signifinca que o projeto está aguardando procedimentos de pré-faturamento e faturamento efetivo.');

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