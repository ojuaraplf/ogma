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
                        <h3 class="card-title"><i class="mdi mdi-tune-vertical" style="color: #FF00FF;"></i> Criar Recursos & Preços </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaRecursoPreco/'); ?>">Lista Recursos & Preços</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Criar Recursos & Preços</li>
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
										<label for="inputTextREP_Codigo" id="linputTextREP_Codigo" class="control-label col-form-label">Código:</label>
										<input type="text" class="form-control font-weight-bold" id="inputTextREP_Codigo" disabled />
									</div>
									<div class="col-11">
										<label for="inputSelectCargoFerramenta" id="linputSelectCargoFerramenta" class="control-label col-form-label">Selecione o Recurso:</label>
										<select id="inputSelectCargoFerramenta" class="form-control">
											<option value="">Selecione o Recurso</option>

											<!-- Itens do ArrayCGO -->
											<?php foreach ($ArrayCGO as $cgo): ?>
												<option value="<?= $cgo['CGO_Codigo']; ?>" data-type="cgo">
													Cargo: <?= $cgo['CGO_Titulo']; ?>
												</option>
											<?php endforeach; ?>

											<!-- Itens do ArrayFTA -->
											<?php foreach ($ArrayFTA as $fta): ?>
												<option value="<?= $fta['FTA_Codigo']; ?>" data-type="fta">
													Ferramenta: <?= $fta['FTA_Denominacao']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-10">
										<label for="selectREP_UNVCodigo" id="lselectREP_UNVCodigo" class="control-label col-form-label">Unidade de venda:</label>
										<select class="form-control" id="selectREP_UNVCodigo">
											<option value="">Selecione a unidade</option>
											<option value="Hora">Hora</option>
											<option value="Usuário">Usuário</option>
										</select>
									</div>
									<div class="col-2">
										<label for="inputTextREP_VendaPreco" id="linputTextREP_VendaPreco" class="control-label col-form-label">Valor de venda:</label>
										<input type="text" placeholder="R$ 0,00" class="form-control" id="inputTextREP_VendaPreco" />
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

            <!-- Footer sempre no final da página -->
            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - RepNovo: vs00.05 2410100915
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>
    
    <script type="text/javascript">
        removeSpinner();        
        setInputTextHints();

        $('#liListaRecursoPreco').addClass('selected');            
        $('#liComercial').addClass('active');
        $('#ulComercial').addClass('in');

        $('#btnSalvar').click(function() {
            loadBlurSpinner();
            $.when(InsertRep()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Novos dados salvos',
                    '',
                    'success'
                ).then(() => {
                    window.location.href = '<?= base_url('ListaRecursoPreco/'); ?>';
				});
            });
        });

        function InsertRep() {            
			// Capturar o item selecionado no campo de seleção de Cargo ou Ferramenta
			var selectedItem = $('#inputSelectCargoFerramenta').find(':selected');
			var selectedValue = selectedItem.val();
			var selectedType = selectedItem.data('type'); // Obter o tipo do item selecionado (cargo ou ferramenta)

			// Definir os códigos com base no tipo do item selecionado
			var repCGOCodigo = (selectedType === 'cgo') ? selectedValue : null; // Definir o código do Cargo se for o tipo 'cgo'
			var repFTACodigo = (selectedType === 'fta') ? selectedValue : null; // Definir o código da Ferramenta se for o tipo 'fta'

			// Capturar e formatar o valor de venda
			var vendaPreco = $('#inputTextREP_VendaPreco').val()
				//.replace(/[R$ .]/g, '') // Remove R$, espaços e pontos
				//.replace(',', '.'); // Substitui a vírgula por ponto decimal

			// Garantir que o valor esteja correto como número float antes de enviar
			vendaPreco = parseFloat(vendaPreco).toFixed(2); // Garante duas casas decimais sem adicionar zeros extras

			// Capturar o valor selecionado na Unidade de Venda
			var unvCodigo = $('#selectREP_UNVCodigo').val();

			// Exibir no console para depuração
			console.log('selectedItem =' + selectedItem);
			console.log('selectedValue =' + selectedValue);
			console.log('selectedType =' + selectedType);
			console.log('repCGOCodigo =' + repCGOCodigo);
			console.log('repFTACodigo =' + repFTACodigo);
			console.log('vendaPreco =' + vendaPreco);
			console.log('unvCodigo =' + unvCodigo);

			// Executar a requisição AJAX para salvar os dados no servidor
			return $.ajax({
				url: "<?php echo base_url(); ?>comercial/RepLista/insertRep", // URL do controlador responsável por salvar os dados
				type: 'POST', // Método de envio
				data: {
					REP_CGOCodigo: repCGOCodigo, // Código do Cargo (se aplicável)
					REP_FTACodigo: repFTACodigo,   // Código da Ferramenta (se aplicável)
					REP_UNVCodigo: unvCodigo, // Unidade de venda selecionada (Hora ou Usuário)
					REP_VendaPreco: vendaPreco // Valor formatado de venda
				},
				success: function(response) {
					console.log('Resposta do servidor:', response);
					Swal.fire(
						'Novos dados salvos',
						'',
						'success'
					).then(() => {
						window.location.href = '<?= base_url('ListaRecursoPreco/'); ?>'; // Redireciona após salvar
					});
				},
				error: function(xhr, status, error) {
					console.error('Erro ao salvar os dados:', error);
					Swal.fire(
						'Erro',
						'Não foi possível salvar os dados.',
						'error'
					);
				}
			});
		}

        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

            $('#inputTextREP_Codigo, #linputTextREP_Codigo').prop('title', 'Código (Id) do Recurso e Preço.');
            $('#inputSelectCGO_Codigo, #linputSelectCGO_Codigo').prop('title', 'Cargo do Recurso e Preço.');
            $('#inputSelectFTA_Codigo, #linputSelectFTA_Codigo').prop('title', 'Ferramenta do Recurso e Preço.');
            $('#inputTextREP_UNVCodigo, #linputTextREP_UNVCodigo').prop('title', 'Unidade de venda do Recurso.');
            $('#inputTextREP_VendaPreco, #linputTextREP_VendaPreco').prop('title', 'Valor de venda do Recurso.');

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
