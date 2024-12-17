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

        <div class="page-wrapper d-flex flex-column min-vh-100">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h3 class="card-title"><i class="mdi mdi-briefcase" style="color: #0000FF;"></i> Editar Área de Negócio </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaAreaNegocio/'); ?>">Lista Área de Negócio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Área de Negócio</li>
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
									<div class="col-1">
										<label for="inputTextNEA_Codigo" id="linputTextNEA_Codigo" class="control-label col-form-label">Código:</label>
										<input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayNEA->NEA_Codigo; ?>" id="inputTextNEA_Codigo" disabled />
									</div>
									<div class="col-9">
										<label for="inputTextNEA_Denominacao" id="linputTextNEA_Denominacao" class="control-label col-form-label">Denominação da Área de Negócio:</label>
										<input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayNEA->NEA_Denominacao; ?>" id="inputTextNEA_Denominacao"/>
									</div>	
									<div class="col-2">
										<label for="inputTextNEA_Acronimo" id="linputTextFTA_NEA_Acronimo" class="control-label col-form-label">Acrônimo:</label>
										<input type="text" class="form-control" value="<?php echo $ArrayNEA->NEA_Acronimo; ?>" id="inputTextNEA_Acronimo" />
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-12">
										<label for="inputTextNEA_Especificacao" id="linputTextNEA_Especificacao" class="control-label col-form-label">Especificações da Área de Negócio:</label>
										<input type="text" class="form-control" value="<?php echo $ArrayNEA->NEA_Especificacao; ?>" id="inputTextNEA_Especificacao" />
									</div>
								</div> 
							</div>
						</div>
					</div>
				</div>
			</div>


            <!-- Footer sempre no final da página -->
            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - NeaEdita: vs00.02 2410080930
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>
    
    <script type="text/javascript">
        removeSpinner();        
        setInputTextHints();

        $('#liAreaNegocio').addClass('selected'); // Para a página atual
		$('#liCadastrosBasicosCom').addClass('active'); // Para o subitem do menu
		$('#ulCadastrosBasicosCom').addClass('in'); // Para expandir o submenu correspondente
		$('#liComercial').addClass('active'); // Para o item do menu específico
		$('#ulComercial').addClass('in'); // Para expandir o menu específico

        $('#btnSalvar').click(function() {
            loadBlurSpinner();
            $.when(UpdateNea()).done(function(r1) {
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

        function UpdateNea() {            
            return $.ajax({
                url: "<?php echo base_url(); ?>comercial/NeaLista/updateAreaNegocios",
                type: 'POST',
                data: {
                    NEA_Codigo: $('#inputTextNEA_Codigo').val(),
                    NEA_Denominacao: $('#inputTextNEA_Denominacao').val(),
                    NEA_Especificacao: $('#inputTextNEA_Especificacao').val(),
                    NEA_Acronimo: $('#inputTextNEA_Acronimo').val()
                }
            });

        }
        
        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

            $('#inputTextNEA_Codigo, #linputTextNEA_Codigo').prop('title', 'Código (Id) da Área de Negócio.');
            $('#inputTextNEA_Denominacao, #linputTextNEA_Denominacao').prop('title', 'Denominação da Área de Negócio.');
            $('#inputTextNEA_Especificacao, #linputTextNEA_Especificacao').prop('title', 'Especificações da Área de Negócio.');
            $('#inputTextNEA_Acronimo, #linputTextNEA_Acronimo').prop('title', 'Acrônimo da Área de Negócio.');

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
