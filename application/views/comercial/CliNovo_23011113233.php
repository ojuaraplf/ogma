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
    <title>wD Ogma Cliente</title>

    <?php $this->load->view('include/headerTop') ?>
    <style>
        html {
      visibility: hidden;
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
                        <h3 class="page-title"><i class="mdi mdi-account-star"></i> Adicionar cliente</h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('CliLista/'); ?>">Lista Clientes</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Adicionar cliente</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="buttonNovaPessoaCliente"> <i class="mdi mdi-account-plus"></i> </button>
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar" disabled> <i class="mdi mdi-content-save"></i> </button>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="selectCLI_PESCodigo" class="text-left control-label col-form-label">Novo Cliente</label>
                                        <select class="form-control" id="selectCLI_PESCodigo">
                                            <option value='0'> Selecione uma pessoa para cliente... </option>
                                            <?php foreach ($ogma_PES_Selecao01 as $item): ?>
                                            <option value="<?= $item['CODIGO']; ?>">
                                                <?= $item['PESSOA']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <div class="row mb-3">
                                <div class="col-7">
                                    <label for="inputCLI_VhSysClienteId" id="labelCLI_VhSysClienteId" class="text-left control-label col-form-label"> Código VhSys </label>
                                    <input type="text" class="form-control" id="inputCLI_VhSysClienteId" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesCliente') ?>

    <script type="text/javascript">
        removeSpinner();
        setInputTextHints();

        $('#liComercial').addClass('selected');
		$('#liCliLista').addClass('active');
		$('#ulComercial').addClass('in');

        $('#selectCLI_PESCodigo').change(function() {
            document.getElementById("btnSalvar").disabled = $("#selectCLI_PESCodigo").val() != '0' ? false : true;
        });

        $('#btnSalvar').click(function() {
            loadBlurSpinner();
            $.when(AdicionaCli()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Cliente salvo',
                    '',
                    'success'
                ).then(() => {
                    // location.reload();
                    window.location.href = "../CliLista/";
                });
                
            });
        });

        function AdicionaCli() {
            var vCLI_PESCodigo = $('#selectCLI_PESCodigo').val();
            var vCLI_VhSysClienteId = $('#inputCLI_VhSysClienteId').val();
            $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/AdicionaCli",
                type: 'POST',
                data: {
                    vCLI_PESCodigo: vCLI_PESCodigo,
                    vCLI_VhSysClienteId: vCLI_VhSysClienteId
                }
            });
        }

        $('#buttonNovaPessoaCliente').click(function() {
            $('#modalQuickPesCliente').modal('show');
        });

        function setInputTextHints() {
            
            $('#buttonNovaPessoaCliente').prop('title', 'Quick Insert de Pessoa:\nClique para incluir rapidamente uma nova pessoa,\ncomo Pessoa e como Cliente, ao mesmo tempo.\nTenha certeza de que ela já não exista na lista de Pessoas.');

            $('#selectCLI_PESCodigo').prop('title', 'Selecione uma pessoa para cliente.\nNo combo estão as pessoas que ainda não são clientes.\nPara incluir nova pessoa como cliente, clique em "incluir nova pessoa/cliente".');
            //$('#selectCLI_PESCodigo').prop('title', 'Selecione uma pessoa para cliente.\nNo combo estão as pessoas que ainda não são clientes.\nPara incluir nova pessoa como cliente, clique em' + class="mdi mdi-account-plus");
            $('#inputCLI_VhSysClienteId').prop('title', 'Entre com o código de classificação do cliente,\nno sistema VhSys, caso saiba.');
            
            $('#btnSalvar').prop('title', 'Clique para adicionar (salvar) os dados do novo cliente.');
            
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