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
                        <h3 class="card-title"><i class="mdi mdi-chart-bar" style="color: #FFA500;"></i> Editar Ferramenta </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaFerramenta/'); ?>">Lista de Ferramenta</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Ferramenta</li>
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
										<label for="inputTextFTA_Codigo" id="linputTextFTA_Codigo" class="control-label col-form-label">Código:</label>
										<input type="text" class="form-control font-weight-bold" id="inputTextFTA_Codigo" disabled />
									</div>
									<div class="col-7">
										<label for="inputTextFTA_Denominacao" id="linputTextFTA_Denominacao" class="control-label col-form-label">Denominação da Ferramenta:</label>
										<input type="text" class="form-control font-weight-bold" id="inputTextFTA_Denominacao"/>
									</div>
									<div class="col-4">
										<label for="inputNEACodigo" id="linputNEACodigo" class="control-label col-form-label">Área de Negócios:</label>
										<select id="inputNEACodigo" class="form-control">
											<option value="">Todas</option>
											<?php foreach ($ArrayNEA as $areaNegocio): ?>
												<option value="<?= $areaNegocio['NEA_Codigo']; ?>">
													<?= $areaNegocio['NEA_Denominacao']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-12">
										<label for="inputTextFTA_Especificacao" id="linputTextFTA_Especificacao" class="control-label col-form-label">Especificações da Ferramenta:</label>
										<input type="text" class="form-control" id="inputTextFTA_Especificacao" />
									</div>
								</div> 
								<div class="row mb-3">
									<div class="col-4">
										<label for="inputTextFTA_Fabricante" id="linputTextFTA_Fabricante" class="control-label col-form-label">Desenvolvedor da Ferramenta:</label>
										<input type="text" class="form-control" id="inputTextFTA_Fabricante" />
									</div>
									<div class="col-4">
										<label for="inputTextFTA_Representante" id="linputTextFTA_Representante" class="control-label col-form-label">Representante da Ferramenta:</label>
										<input type="text" class="form-control" id="inputTextFTA_Representante"/>
									</div>
									<div class="col-4">
										<label for="inputTextFTA_UltimaVersao" id="linputTextFTA_UltimaVersao" class="control-label col-form-label">Versão da Ferramenta:</label>
										<input type="text" class="form-control" id="inputTextFTA_UltimaVersao"/>
									</div> 
								</div>                            
							</div>
						</div>
					</div>
				</div>
			</div>

            <!-- Footer sempre no final da página -->
            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - FtaNovo: vs00.02 2410080930
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>
    
    <script type="text/javascript">
        removeSpinner();        
        setInputTextHints();
        
		$('#liFerramenta').addClass('selected');            
        $('#liComercial').addClass('active');
        $('#ulComercial').addClass('in');

        $('#btnSalvar').click(function() {

            if( $('#inputTextFTA_Especificacao').val().length <= 3 )
                {
                document.getElementById('inputTextFTA_Especificacao').focus();
                Swal.fire(
                    'Importante!',
                    "Descreva uma identificação para o Status do Contrato.",
                    'warning'
                )
                return;
            }

            loadBlurSpinner();
            $.when(InsertFta()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Novos dados salvos',
                    '',
                    'success'
                ).then(() => {
                    window.location.href = '<?= base_url('ListaFerramenta/'); ?>';
                });
            });
        });

        function InsertFta() {            
            return $.ajax({
                url: "<?php echo base_url(); ?>comercial/FtaLista/InsertFta",
                type: 'POST',
                data: {
                    FTA_Codigo: $('#inputTextFTA_Codigo').val(),
					FTA_Denominacao: $('#inputTextFTA_Denominacao').val(),
                    FTA_NEACodigo: $('#inputNEACodigo').val(),
                    FTA_UltimaVersao: $('#inputTextFTA_UltimaVersao').val(),
                    FTA_Especificacao: $('#inputTextFTA_Especificacao').val(),
                    FTA_Fabricante: $('#inputTextFTA_Fabricante').val(),
                    FTA_Representante: $('#inputTextFTA_Representante').val()
                }
            });
        }
        
        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

            $('#inputTextFTA_Codigo, #linputTextFTA_Codigo').prop('title', 'Código (Id) da Ferramenta.');
            $('#inputTextFTA_Denominacao, #linputTextFTA_Denominacao').prop('title', 'Denominação da Ferramenta.');
            $('#inputNEACodigo, #linputNEACodigo').prop('title', 'Área de Negócio da Ferramenta.');
            $('#inputTextFTA_Especificacao, #linputTextFTA_Especificacao').prop('title', 'Especificações da Ferramenta.');
            $('#inputTextFTA_Fabricante, #linputTextFTA_Fabricante').prop('title', 'Desenvolvedor da Ferramenta.');
            $('#inputTextFTA_Representante, #linputTextFTA_Representante').prop('title', 'Representante da Ferramenta.');
            $('#inputTextFTA_UltimaVersao, #linputTextFTA_UltimaVersao').prop('title', 'Última versão da Ferramenta.');

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
