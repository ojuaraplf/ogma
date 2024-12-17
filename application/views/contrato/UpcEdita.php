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
                        <h3 class="card-title"><i class="mdi mdi-umbrella-outline"></i> Editar Unidade Padrão do Contrato </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaUnidadeContrato/'); ?>">Lista de Unidade Padrão do Contrato</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Unidade Padrão do Contrato</li>
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
                                        <label for="inputTextUPC_Codigo" id="linputTextUPC_Codigo" class="text-left control-label col-form-label">Código do Status:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayUPC->UPC_Codigo; ?>" id="inputTextUPC_Codigo" disabled />
                                    </div>
                                    <div class="col-10">
                                        <label for="inputTextUPC_Descricao" id="linputTextUPC_Descricao" class="text-left control-label col-form-label">Descrição do Unidade Padrão do Contrato:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayUPC->UPC_Descricao; ?>" id="inputTextUPC_Descricao"/>
                                    </div>                                    
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer sempre no final da página -->
            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - UpcEdita: vs00.02 20240824
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

            if( $('#inputTextUPC_Descricao').val().length <= 3 )
                {
                document.getElementById('inputTextUPC_Descricao').focus();
                Swal.fire(
                    'Importante!',
                    "Descreva uma identificação para o Unidade Padrão do Contrato.",
                    'warning'
                )
                return;
            }

            loadBlurSpinner();
            $.when(UpdateUpc()).done(function(r1) {
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

        function UpdateUpc() {            

            return $.ajax({
                url: "<?php echo base_url(); ?>contrato/upcLista/UpdateUpc",
                type: 'POST',
                data: {
                    UPC_Codigo: $('#inputTextUPC_Codigo').val(),
                    UPC_Descricao: $('#inputTextUPC_Descricao').val()
                }
            });

        }
        
        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

            $('#inputTextUPC_Codigo, #linputTextUPC_Codigo').prop('title', 'Código (Id) do Unidade Padrão do Contrato.');
            $('#inputTextUPC_Descricao, #linputTextUPC_Descricao').prop('title', 'Descrição do Unidade Padrão do Contrato.');
                        
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