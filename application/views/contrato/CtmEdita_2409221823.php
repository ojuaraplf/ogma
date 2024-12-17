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
                        <h3 class="card-title"><i class="mdi mdi-umbrella-outline"></i> Editar Contrato Master </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaContratoMaster/'); ?>">Lista de Contrato Master</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Contrato Master</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid flex-grow-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar" disabled> 
                            <i class="mdi mdi-content-save"></i> 
                        </button>                        
                    </div>
                    <div class="col-md-12">
                        <!-- Card Principal -->
                        <div class="card">
                            <div class="card-body">
                               <div class="row mb-3">
									<div class="col-md-1">
										<label for="inputTextCTM_Codigo" id="linputTextCTM_Codigo" class="control-label col-form-label">Código</label>
										<input type="text" style="height: 38px; padding: 6px 12px;" class="form-control font-weight-bold" value="<?php echo $ArrayEditaCTM[0]['CTM_Codigo']; ?>" id="inputTextCTM_Codigo" disabled />
									</div>									
									<div class="col-md-2">
										<label for="inputTextCTM_DataRequisicao" id="linputTextCTM_DataRequisicao" class="control-label col-form-label">Data Requisição</label>
										<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataRequisicao']; ?>" id="inputTextCTM_DataRequisicao" />
									</div>
									<div class="col-md-3">
										<label for="inputSelectCLI_Codigo" id="linputSelectCLI_Codigo" class="control-label col-form-label">Cliente</label>
										<select class="form-control" id="inputSelectCLI_Codigo" style="height: 38px; padding: 6px 12px;">
											<option value="">Escolher Cliente...</option>
											<?php foreach ($todosClientes as $clientesctm): ?>
												<option value="<?php echo $clientesctm['CLI_Codigo']; ?>"
													<?php echo ($clientesctm['CLI_Codigo'] == $ArrayEditaCTM[0]['CLI_Codigo']) ? 'selected' : ''; ?>>
													<?php echo $clientesctm['PESSOA']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-md-3">
										<label for="inputSelectTCT_Codigo" id= "linputSelectTCT_Codigo" class="control-label col-form-label">Tipo Contrato</label>
										<select class="form-control" id="inputSelectTCT_Codigo" style="height: 38px; padding: 6px 12px;">
											<option value="">Escolher Tipo Contrato...</option>
											<?php foreach ($tiposContratos as $tiposctm): ?>
												<option value="<?php echo $tiposctm['TCT_Codigo']; ?>"
													<?php echo ($tiposctm['TCT_Codigo'] == $ArrayEditaCTM[0]['TCT_Codigo']) ? 'selected' : ''; ?>>
													<?php echo $tiposctm['TCT_Descricao']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-md-3">
										<label for="inputSelectSTT_Codigo" id="linputSelectSTT_Codigo" class="control-label col-form-label">Status</label>
										<select class="form-control" id="inputSelectSTT_Codigo" style="height: 38px; padding: 6px 12px;">
											<option value="">Escolher Status...</option>
											<?php foreach ($statusContratos as $statusctm): ?>
												<option value="<?php echo $statusctm['STT_Codigo']; ?>"
													<?php echo ($statusctm['STT_Codigo'] == $ArrayEditaCTM[0]['STT_Codigo']) ? 'selected' : ''; ?>>
													<?php echo $statusctm['STT_Descricao']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-3">
                                        <label for="inputTextCTM_NumeroWD" id="linputTextCTM_NumeroWD" class="control-label col-form-label">Núm. Ctr Interno - WD​</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_NumeroWD']; ?>" id="inputTextCTM_NumeroWD"/>
                                    </div> 
									<div class="col-9">
                                        <label for="inputTextCTM_Descricao" id="linputTextCTM_Descricao" class="control-label col-form-label">Descrição</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_Descricao']; ?>" id="inputTextCTM_Descricao"/>
                                    </div>   
								</div>
								<div class="row mb-3">
									<div class="col-3">
                                        <label for="inputTextCTM_NumeroCliente" id="linputTextCTM_NumeroCliente" class="control-label col-form-label">Cód./Núm no Cliente​​</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_NumeroCliente']; ?>" id="inputTextCTM_NumeroCliente"/>
                                    </div> 
									<div class="col-9">
                                        <label for="inputTextCTM_TituloCliente" id="linputTextCTM_TituloCliente" class="control-label col-form-label">Título no Cliente</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_TituloCliente']; ?>" id="inputTextCTM_TituloCliente"/>
                                    </div>
								</div>
								<div class="row mb-3">
									<div class="col-4">
									    <label for="inputSelectCTM_CLPCodigo" id="linputSelectCTM_CLPCodigo" class="control-label col-form-label">Responsável Cliente</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectCTM_CLPCodigo">
											<option selected>Escolher Responsável ...</option>
											<!-- Options should be dynamically generated -->
										</select> 
                                    </div> 
									<div class="col-4">
                                        <label for="inputTextCLP_Email" id="linputTextinputTextCLP_Email" class="control-label col-form-label">E-mail</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CLP_Email']; ?>" id="inputTextCLP_Email" disabled/>
                                    </div>
									<div class="col-2">
                                        <label for="inputTextCLP_Telefone1" id="linputTextinputTextCLP_Telefone1" class="control-label col-form-label">Telefone 1</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CLP_Telefone1']; ?>" id="inputTextCLP_Telefone1" disabled/>
                                    </div>
									<div class="col-2">
                                        <label for="inputTextCLP_Telefone2" id="linputTextinputTextCLP_Telefone2" class="control-label col-form-label">Telefone 2</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CLP_Telefone2']; ?>" id="inputTextCLP_Telefone2" disabled/>
                                    </div>
								</div>									
								<div class="row mb-3">
									<div class="col-12">
                                        <label for="inputTextCTM_Procedimento" id="linputTextCTM_Procedimento" class="control-label col-form-label">Procedimento – Acesso ao Portal do cliente​</label>
                                        <textarea type="text" rows="3" style="height: 76px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_Procedimento']; ?>" id="inputTextCTM_Procedimento"/></textarea>
                                    </div> 									
								</div>
								<div class="row mb-3">
									<div class="col-6">
										<label for="inputTextCTM_LinkProposta" id="linputTextCTM_LinkProposta" class="control-label col-form-label">Proposta</label>
										<div class="input-group">
											<input type="text" class="form-control" id="inputTextCTM_LinkProposta" placeholder="Selecione o arquivo">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button" id="button-addon2">
													<i class="fa fa-folder-open"></i>
												</button>
											</div>
										</div>
										<!-- Input de arquivo escondido -->
										<input type="file" style="display: none;" id="fileInput1">
									</div>
									<div class="col-6">
										<label for="inputTextCTM_LinkContrato" id="linputTextCTM_LinkContrato" class="control-label col-form-label">Contrato Assinado</label>
										<div class="input-group">
											<input type="text" class="form-control" id="inputTextCTM_LinkContrato" placeholder="Selecione o arquivo">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button" id="button-addon3">
													<i class="fa fa-folder-open"></i>
												</button>
											</div>
										</div>
										<!-- Input de arquivo escondido -->
										<input type="file" style="display: none;" id="fileInput2">
									</div>
								</div>

								<div class="row mb-3">
									<div class="col-3">
										<label for="inputSelectGestorWdNome" id="linputSelectGestorWdNome" class="control-label col-form-label">Gestor WD</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectGestorWdNome">
											<option selected>Escolher Gestor WD...</option>
											<!-- Options should be dynamically generated -->
										</select>                                        
                                    </div> 
									<div class="col-3">
										<label for="inputSelectFinanceiroWdNome" id="linputSelectFinanceiroWdNome" class="control-label col-form-label">Financeiro WD</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectFinanceiroWdNome">
											<option selected>Escolher Financeiro WD...</option>
											<!-- Options should be dynamically generated -->
										</select> 
                                    </div>
									<div class="col-md-2">
										<label for="inputSelectCTM_UPCCodigo" id="linputSelectCTM_UPCCodigo" class="control-label col-form-label">Unidade Padrão do Contrato</label>
										<select class="form-control" id="inputSelectCTM_UPCCodigo" style="height: 38px; padding: 6px 12px;">
											<option value="">Escolher Unidade...</option>
											<?php foreach ($unidadesContrato as $unidadesctm): ?>
												<option value="<?php echo $unidadesctm['UPC_Codigo']; ?>"
													<?php echo ($unidadesctm['UPC_Codigo'] == $ArrayEditaCTM[0]['CTM_UPCCodigo']) ? 'selected' : ''; ?>>
													<?php echo $unidadesctm['UPC_Descricao']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-2">
                                        <label for="inputTextCTM_QtdeHoraTotal" id="linputTextCTM_QtdeHoraTotal" class="control-label col-form-label">Quantidade Total (h)</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_QtdeHoraTotal']; ?>" id="inputTextCTM_QtdeHoraTotal"/>
                                    </div>
									<div class="col-2">
                                        <label for="inputTextCTM_ValorTotal" id="linputTextCTM_ValorTotal" class="control-label col-form-label">Valor Total (R$)</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_ValorTotal']; ?>" id="inputTextCTM_ValorTotal"/>
                                    </div>
								</div>						
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - SttEdita: vs00.07 20240922
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>
    
    <script type="text/javascript">
        removeSpinner();        
        setInputTextHints();

        $('#ListaStatusContrato').addClass('selected');
        $('#liCadastrosBasicos').addClass('active');
        $('#liComercial').addClass('in');

		var ArrayPessoasDoCliente = [];
		var vCBRCodigo = null;
		var vMostraTudo = 0;
		BuscarColaboradores(vCBRCodigo, vMostraTudo);
		buscarPessoasDoCliente($('#inputSelectCLI_Codigo').val());
		

		// Para seleção dos arquivos de Proposta
		document.getElementById('button-addon2').addEventListener('click', function() {
			document.getElementById('fileInput1').click();
		});
		document.getElementById('fileInput1').addEventListener('change', function() {
			var filePath = this.value.split('\\').pop();
			document.getElementById('inputTextCTM_LinkProposta').value = filePath;  // Mostra o caminho do arquivo no input de texto

			document.getElementById('inputTextCTM_LinkProposta').focus();
		});
		
		// Para seleção dos arquivos de Contrato Assinado
;		document.getElementById('button-addon3').addEventListener('click', function() {
			document.getElementById('fileInput2').click();
		});
		document.getElementById('fileInput2').addEventListener('change', function() {
			var filePath = this.value.split('\\').pop();
			document.getElementById('inputTextCTM_LinkContrato').value = filePath;  // Mostra o caminho do arquivo no input de texto

			document.getElementById('inputTextCTM_LinkContrato').focus();
		});
		
		// Formatando valores na edição
		document.getElementById('inputTextCTM_ValorTotal').addEventListener('input', function(e) {
			formatarReais(e.target);
		});
		document.getElementById('inputTextCTM_QtdeHoraTotal').addEventListener('input', function(e) {
			formatarMilhar(e.target);
		});

		$('#inputSelectCLI_Codigo').change(function() {
			var clienteCodigo = $(this).val();	
			console.log("Cliente selecionado: " + clienteCodigo);
			if (clienteCodigo) {
				buscarPessoasDoCliente(clienteCodigo);
			}
		});

		$('#inputSelectCTM_CLPCodigo').change(function() {
			var clpCodigo = $(this).val(); // Obtém o id do responsável cliente selecionado
			var clienteCodigo = $('#inputSelectCLI_Codigo').val(); // Obtém o id do cliente selecionado
			console.log("Cliente selecionado: " + clienteCodigo);
			console.log("Responsável selecionado: " + clpCodigo);
	
			// Chama a função para atualizar o contato com base no responsável e no cliente selecionado
			buscarDadosDaPessoaDoCliente(clienteCodigo, clpCodigo);
		});

		function buscarDadosDaPessoaDoCliente(clienteCodigo, clpCodigo) {
			console.log('clienteCodigo: ' + clienteCodigo);
			console.log('clpCodigo: ' + clpCodigo);
			console.log('Tipo de clpCodigo: ' + typeof clpCodigo);
			console.table(ArrayPessoasDoCliente);

			// Ajuste para comparar o campo CODIGO com clpCodigo
			var pessoa = ArrayPessoasDoCliente.find(p => p.CODIGO.toString() === clpCodigo.trim());

			console.log('Pessoa encontrada:', pessoa);

			if (pessoa) {
				$('#inputTextCLP_Email').val(pessoa.CLP_EMAIL || '');
				$('#inputTextCLP_Telefone1').val(pessoa.CLP_TEL1 || '');
				$('#inputTextCLP_Telefone2').val(pessoa.CLP_TEL2 || '');
			} else {
				console.error("Pessoa do Cliente não encontrada.");
				$('#inputTextCLP_Email').val('');
				$('#inputTextCLP_Telefone1').val('');
				$('#inputTextCLP_Telefone2').val('');
			}
		}

		function buscarPessoasDoCliente(clienteCodigo) {
			$.ajax({
				url: "<?php echo base_url('contrato/CtmLista/buscarPessoasDoCliente'); ?>",
				type: "POST",
				data: { clienteCodigo: clienteCodigo },
				dataType: "json",
				success: function(response) {
					ArrayPessoasDoCliente = response;
					console.table(ArrayPessoasDoCliente);
					var pessoasSelect = $('#inputSelectCTM_CLPCodigo');					
					pessoasSelect.empty(); // Limpa o select

					$.each(response, function(index, pessoa) {
						pessoasSelect.append('<option value="' + pessoa.CODIGO + '">' + pessoa.NOME + '</option>');						
					});

					var pessoaclieCod = $('#inputSelectCTM_CLPCodigo').val();
					console.log("Pessoa do Cliente inferida: " + pessoaclieCod);
					buscarDadosDaPessoaDoCliente(clienteCodigo, pessoaclieCod);

				},
				error: function(xhr, status, error) {
					console.error("Erro ao buscar pessoas do cliente: ", error);
				}
			});
		}

		function BuscarColaboradores(pCBRCodigo, pMostraTudo) {
			console.log("pCBRCodigo view: " + pCBRCodigo + ", pMostraTudo: " + pMostraTudo);
			$.ajax({
				url: "<?php echo base_url('contrato/CtmLista/BuscarColaboradores'); ?>",
				type: "GET",
				data: {
					pCBRCodigo: pCBRCodigo, // Parâmetro opcional
					pMostraTudo: pMostraTudo // Parâmetro opcional
				},
				dataType: "json",
				success: function(response) {
					var selectGestor = $('#inputSelectGestorWdNome');
					var selectFinanc = $('#inputSelectFinanceiroWdNome');
					selectGestor.empty(); // Limpa o combo
					selectFinanc.empty(); // Limpa o combo

					// Adiciona a opção padrão
					selectGestor.append('<option value="">Escolher Gestor WD...</option>');
					selectFinanc.append('<option value="">Escolher Financeiro WD...</option>');

					// Percorre os dados retornados e popula o select
					$.each(response, function(index, colaborador) {
						selectGestor.append('<option value="' + colaborador.CODIGO + '">' + colaborador.COLABORADOR + '</option>');
						selectFinanc.append('<option value="' + colaborador.CODIGO + '">' + colaborador.COLABORADOR + '</option>');
					});
				},
				error: function(xhr, status, error) {
					console.error("Erro ao buscar os colaboradores WD: ", error);
				}
			});
		}

        $('#btnSalvar').click(function() {
            if( $('#inputTextCTM_Descricao').val().length <= 3 )
                {
                document.getElementById('inputTextCTM_Descricao').focus();
                Swal.fire(
                    'Importante!',
                    "Descreva Contrato Master.",
                    'warning'
                )
                return;
            }

            loadBlurSpinner();
            $.when(UpdateStt()).done(function(r1) {
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

        function UpdateStt() {            
            return $.ajax({
                url: "<?php echo base_url(); ?>contrato/sttLista/UpdateStt",
                type: 'POST',
                data: {
                    CTM_Codigo: $('#inputTextCTM_Codigo').val(),
                    CTM_Descricao: $('#inputTextCTM_Descricao').val()
                }
            });

        }
        
        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

            $(document).ready(function() {
				$('[id^="input"], [id^="linput"]').prop('title', 'Qual será o tooltip explicando aqui, Sobreira?');
			})
                        
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

		$('#inputSelectCLI_Codigo').select2({
			placeholder: 'Escolher Cliente...', // Define o texto de placeholder
			allowClear: true, // Permite limpar o campo
			width: '100%' // Define o select para ocupar 100% da largura
		});
    
    </script>
</body>
</html> 
