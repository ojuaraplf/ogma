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
        <?php $this->load->view('include/navbarHome'); ?>
        <?php $this->load->view('include/asidebar'); ?>

        <!-- Usar flexbox para garantir que o footer fique no final da página -->
        <div class="page-wrapper d-flex flex-column min-vh-100">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h3 class="card-title"><i class="mdi mdi-currency-usd"></i> Editar Condição de Pagamento </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaCondicaoPagamento/'); ?>">Lista de Condição de Pagamento</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Condição de Pagamento</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid flex-grow-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar"> 
                            <i class="mdi mdi-content-save"></i> 
                        </button>                        
                    </div>
                    <div class="col-md-12">
                        <!-- Card Principal -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="inputTextCPG_Codigo" id="linputTextCPG_Codigo" class="text-left control-label col-form-label">Código do Status:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayCPG->CPG_Codigo; ?>" id="inputTextCPG_Codigo" disabled />
                                    </div>
                                    <div class="col-10">
                                        <label for="inputTextCPG_Descricao" id="linputTextCPG_Descricao" class="text-left control-label col-form-label">Descrição do Condição de Pagamento:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayCPG->CPG_Descricao; ?>" id="inputTextCPG_Descricao"/>
                                    </div>                                    
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer sempre no final da página -->
            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - CpgEdita: vs00.02 20240824
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>


    <script type="text/javascript">
        removeSpinner();        
        setInputTextHints();
/*
        $('#liAdministracao').addClass('selected');
        $('#liCargo').addClass('active');
        $('#ulAdministrativo').addClass('in');
*/
        $('#btnSalvar').click(function() {

            if( $('#inputTextCPG_Descricao').val().length <= 3 )
                {
                document.getElementById('inputTextCPG_Descricao').focus();
                Swal.fire(
                    'Importante!',
                    "Descreva uma identificação para a Condição de Pagamento.",
                    'warning'
                )
                return;
            }

            loadBlurSpinner();
            $.when(UpdateCpg()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Alterações salvas',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });

        function UpdateCpg() {            

            return $.ajax({
                url: "<?php echo base_url(); ?>financeiro/CpgLista/UpdateCpg",
                type: 'POST',
                data: {
                    CPG_Codigo: $('#inputTextCPG_Codigo').val(),
                    CPG_Descricao: $('#inputTextCPG_Descricao').val()
                }
            });

        }
        
        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

            $('#inputTextCPG_Codigo, #linputTextCPG_Codigo').prop('title', 'Código (Id) da Condição de Pagamento.');
            $('#inputTextCPG_Descricao, #linputTextCPG_Descricao').prop('title', 'Descrição da Condição de Pagamento.');
                        
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