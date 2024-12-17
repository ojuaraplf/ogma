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
        <?php $this->load->view('include/navBarStatusChamado') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="card-title">Edita Status de Chamado</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Edita Status de Chamado</li>
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
                                        <input type="text" class="form-control" value="<?= $status->STC_Codigo ?>" id="inputTextCodStatus" disabled />
                                    </div>
                                    <div class="col-10">
                                        <label for="" class="text-left control-label col-form-label">Descrição do Status </label>
                                        <input type="text" class="form-control" value="<?= $status->STC_Descricao ?>" id="inputTextDescStatus" />
                                    </div>
                                </div>
                                <br />
                                <div class="row mb-3">   
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgChamadoAtivo == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgChamadoAtivo">
                                        <label class="text-left" for="checkboxSTC_FlgChamadoAtivo">Chamado ativo</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgRespdadeCliente == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgRespdadeCliente">
                                        <label class="text-left" for="checkboxSTC_FlgRespdadeCliente">Ação do cliente</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgApareceSirius == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgApareceSirius">
                                        <label class="text-left" for="checkboxSTC_FlgApareceSirius">Listado no Sirius</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_DeExecucao == 1 ? 'checked' : '' ?> id="checkboxSTC_DeExecucao">
                                        <label class="text-left" for="checkboxSTC_DeExecucao">De execução</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_DeAtendimento == 1 ? 'checked' : '' ?> id="checkboxSTC_DeAtendimento">
                                        <label class="text-left" for="checkboxSTC_DeAtendimento">De atendimento</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_DeAbertura == 1 ? 'checked' : '' ?> id="checkboxSTC_DeAbertura">
                                        <label class="text-left" for="checkboxSTC_DeAbertura">Chamado de abertura</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgParaFaturamento == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgParaFaturamento">
                                        <label class="text-left" for="checkboxSTC_FlgParaFaturamento">Para faturamento</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgMostraOrcamento == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgMostraOrcamento">
                                        <label class="text-left" for="checkboxSTC_FlgMostraOrcamento">Orçável</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgMostraAvaliacao == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgMostraAvaliacao">
                                        <label class="text-left" for="checkboxSTC_FlgMostraAvaliacao">Avaliável</label>
                                    </div> 
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgMostraTrd == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgMostraTrd">
                                        <label class="text-left" for="checkboxSTC_FlgMostraTrd">TRD Confirmável </label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $status->STC_FlgMostraRetornoNecessario == 1 ? 'checked' : '' ?> id="checkboxSTC_FlgMostraRetornoNecessario">
                                        <label class="text-left" for="checkboxSTC_FlgMostraRetornoNecessario">Informações solicitadas</label>
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
		$('#liStc').addClass('active');
		$('#ulConfiguracao').addClass('in');

        $('#btnSalvar').click(function() {

            loadBlurSpinner();
            $.when(UpdateStc()).done(function(r1) {
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


        function UpdateStc() {
            var STC_Codigo = $('#inputTextCodStatus').val();
            var STC_Descricao = $('#inputTextDescStatus').val();
            var STC_FlgChamadoAtivo = $('#checkboxSTC_FlgChamadoAtivo').is(":checked") ? 1 : 0;
            var STC_FlgRespdadeCliente = $('#checkboxSTC_FlgRespdadeCliente').is(":checked") ? 1 : 0;
            var STC_FlgApareceSirius = $('#checkboxSTC_FlgApareceSirius').is(":checked") ? 1 : 0;
            
            var STC_DeExecucao = $('#checkboxSTC_DeExecucao').is(":checked") ? 1 : 0;
            var STC_DeAtendimento = $('#checkboxSTC_DeAtendimento').is(":checked") ? 1 : 0;
            var STC_DeAbertura = $('#checkboxSTC_DeAbertura').is(":checked") ? 1 : 0;
            var STC_FlgMostraOrcamento = $('#checkboxSTC_FlgMostraOrcamento').is(":checked") ? 1 : 0;
            var STC_FlgMostraRetornoNecessario = $('#checkboxSTC_FlgMostraRetornoNecessario').is(":checked") ? 1 : 0;
            var STC_FlgMostraAvaliacao = $('#checkboxSTC_FlgMostraAvaliacao').is(":checked") ? 1 : 0;
            var STC_FlgMostraTrd = $('#checkboxSTC_FlgMostraTrd').is(":checked") ? 1 : 0;
            var STC_FlgParaFaturamento = $('#checkboxSTC_FlgParaFaturamento').is(":checked") ? 1 : 0;

            
            $.ajax({
                url: "<?php echo base_url(); ?>configuracao/StcLista/UpdateStc",
                
                type: 'POST',
                data: {
                    STC_Codigo: STC_Codigo,
                    STC_Descricao: STC_Descricao,
                    STC_FlgChamadoAtivo: STC_FlgChamadoAtivo,
                    STC_FlgRespdadeCliente: STC_FlgRespdadeCliente,
                    STC_DeExecucao: STC_DeExecucao,
                    STC_DeAbertura: STC_DeAbertura,
                    STC_DeAtendimento: STC_DeAtendimento,
                    STC_FlgMostraOrcamento: STC_FlgMostraOrcamento,
                    STC_FlgMostraRetornoNecessario: STC_FlgMostraRetornoNecessario,
                    STC_FlgMostraAvaliacao: STC_FlgMostraAvaliacao,
                    STC_FlgMostraTrd: STC_FlgMostraTrd,
                    STC_FlgParaFaturamento: STC_FlgParaFaturamento,
                    STC_FlgApareceSirius: STC_FlgApareceSirius
                    
                }
            });
        }


        function setInputTextHints() {
            $('#inputTextDescStatus').prop('title', 'Edite a descrição do status.\n Por convenção, inicia-se com verbo em gerúndio.');

            $('#checkboxSTC_FlgChamadoAtivo').prop('title', 'Status é chamado em fase ativa:\nMarcado, significa que o chamado estará em fase ativa ou operante.\nDesmarcado, significa que o chamado estará em fase não importante.');
            $('#checkboxSTC_FlgRespdadeCliente').prop('title', 'Status de responsabilidade e dependência do cliente:\nMarcado, significa que o chamado estará em fase de atuação do cliente - dependente do cliente.\nDesmarcado, significa que o chamado estará em fase independente do cliente.');
            $('#checkboxSTC_FlgApareceSirius').prop('title', 'Status que deixa os chamados aparecerem na lista do Sirius,\npara ser visto/editado pelo cliente.');            
            $('#checkboxSTC_DeExecucao').prop('title', 'Status é de execução e não atendimento:\nMarcado, significa que o chamado estará em fase de execução de serviços.\nDesmarcado, significa que o chamado estará em fase fora de execução de serviços.');
            $('#checkboxSTC_DeAtendimento').prop('title', 'Status é de atendimento e não execução:\nMarcado, significa que o chamado estará em fase de atendimento - de não execução.\nDesmarcado, significa que o chamado não estará em fase de atendimento.');
            $('#checkboxSTC_FlgMostraOrcamento').prop('title', 'Status mostra e pede aprovação do orçamento:\nMarcado, significa que o chamado estará em fase que requer orçamento,\ne será mostrado e sua aprovação solicitada pela interface do cliente.');
            $('#checkboxSTC_FlgMostraRetornoNecessario').prop('title', 'Status notifica cliente pedindo por informações:\nMarcado, significa que neste status o cliente será notificado para dar alguma informação\nou para homologar algo, do que depende a continuidade dos serviços.');
            $('#checkboxSTC_FlgMostraAvaliacao').prop('title', 'Status mostra e pede avaliação:\nMarcado, significa que o chamado estará em fase que os serviços podem ser avaliados pelo cliente e será solicitada avaliação pela interface do dele.\nDesmarcado, nenhuma avaliação será solicitada do cliente naquela fase.');
            $('#checkboxSTC_FlgMostraTrd').prop('title', 'Status mostra e pede ciência do Termo de Entrega Definitiva (TRD):\nMarcado, significa que o chamado estará em fase de entrerga para o cliente e será solicitado o aceite definitivo do serviço.\nDesmarcado, nenhum termo de entrega será solicitado ao cliente.');
            $('#checkboxSTC_DeAbertura').prop('title', 'Status é de abertura do chamado:\nMarcado, significa que o chamado NÃO deve criar atividade no PPx.');
            $('#checkboxSTC_FlgParaFaturamento').prop('title', 'Status é de faturamento.\nMarcado, significa que o chamado estará em processo de pré-faturamento ou faturamento efetivo.');
            

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