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
                        <h3 class="card-title"><i class="mdi mdi-umbrella-outline"></i> Editar Tipo do Contrato </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaTipoContrato/'); ?>">Lista de Tipo do Contrato</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Tipo do Contrato</li>
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
                                        <label for="inputTextTCT_Codigo" id="linputTextTCT_Codigo" class="text-left control-label col-form-label">Código do Status:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayTCT->TCT_Codigo; ?>" id="inputTextTCT_Codigo" disabled />
                                    </div>
                                    <div class="col-10">
                                        <label for="inputTextTCT_Descricao" id="linputTextTCT_Descricao" class="text-left control-label col-form-label">Descrição do Tipo do Contrato:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayTCT->TCT_Descricao; ?>" id="inputTextTCT_Descricao"/>
                                    </div>                                    
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer sempre no final da página -->
            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - TctEdita: vs00.02 20240824
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

            if( $('#inputTextTCT_Descricao').val().length <= 3 )
                {
                document.getElementById('inputTextTCT_Descricao').focus();
                Swal.fire(
                    'Importante!',
                    "Descreva uma identificação para o Tipo do Contrato.",
                    'warning'
                )
                return;
            }

            loadBlurSpinner();
            $.when(UpdateTct()).done(function(r1) {
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

        function UpdateTct() {            

            return $.ajax({
                url: "<?php echo base_url(); ?>contrato/tctLista/UpdateTct",
                type: 'POST',
                data: {
                    TCT_Codigo: $('#inputTextTCT_Codigo').val(),
                    TCT_Descricao: $('#inputTextTCT_Descricao').val()
                }
            });

        }
        
        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

            $('#inputTextTCT_Codigo, #linputTextTCT_Codigo').prop('title', 'Código (Id) do Tipo do Contrato.');
            $('#inputTextTCT_Descricao, #linputTextTCT_Descricao').prop('title', 'Descrição do Tipo do Contrato.');
                        
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