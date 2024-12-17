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
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar" > 
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
										<label for="inputTextCTM_Procedimento" id="linputTextCTM_Procedimento" class="control-label col-form-label">Procedimento – Acesso ao Portal do cliente</label>
										<textarea rows="3" style="height: 76px; padding: 6px 12px;" class="form-control" id="inputTextCTM_Procedimento"><?php echo $ArrayEditaCTM[0]['CTM_Procedimento']; ?></textarea>
									</div>                                    
								</div>
								<div class="row mb-3">
									<div class="col-6">
										<label for="inputTextCTM_LinkProposta" id="linputTextCTM_LinkProposta" class="control-label col-form-label">Proposta</label>
										<input type="file" class="form-control" id="inputTextCTM_LinkProposta" placeholder="Selecione o arquivo">
										<?php if (!empty($ArrayEditaCTM[0]['CTM_LinkProposta'])): ?>
														<small class="form-text text-muted">
															Arquivo atual: <a href="<?= base_url('uploads/'.$ArrayEditaCTM[0]['CTM_LinkProposta']); ?>" target="_blank">
																<?= $ArrayEditaCTM[0]['CTM_LinkProposta']; ?>
															</a>
														</small>
										<?php endif; ?>
									</div>
									<div class="col-6">
										<label for="inputTextCTM_LinkContrato" id="linputTextCTM_LinkContrato" class="control-label col-form-label">Contrato Assinado</label>
										<input type="file" class="form-control" id="inputTextCTM_LinkContrato" placeholder="Selecione o arquivo">
										<?php if (!empty($ArrayEditaCTM[0]['CTM_LinkContrato'])): ?>
														<small class="form-text text-muted">
															Arquivo atual: <a href="<?= base_url('uploads/'.$ArrayEditaCTM[0]['CTM_LinkContrato']); ?>" target="_blank">
																<?= $ArrayEditaCTM[0]['CTM_LinkContrato']; ?>
															</a>
														</small>
										<?php endif; ?>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-3">
										<label for="inputSelectGestorWdNome" id="linputSelectGestorWdNome" class="control-label col-form-label">Gestor WD</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectGestorWdNome">
											<option selected>Escolher Gestor WD...</option>
										</select>                                        
                                    </div> 
									<div class="col-3">
										<label for="inputSelectFinanceiroWdNome" id="linputSelectFinanceiroWdNome" class="control-label col-form-label">Financeiro WD</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectFinanceiroWdNome">
											<option selected>Escolher Financeiro WD...</option>
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
									<div class="col-md-2">
										<label for="inputTextCTM_DataVigenciaIni" id="linputTextCTM_DataVigenciaIni" class="control-label col-form-label">Data Início Vigência</label>
										<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataVigenciaIni']; ?>" id="inputTextCTM_DataVigenciaIni" />
									</div>
									<div class="col-md-2">
										<label for="inputTextCTM_DataVigenciaFim" id="linputTextCTM_DataVigenciaFim" class="control-label col-form-label">Data Fim Vigência</label>
										<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataVigenciaFim']; ?>" id="inputTextCTM_DataVigenciaFim" />
									</div>
								</div>

								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#informacaoProdServ" role="tab">
											<span class="hidden-xs-down">Informação Produto/Serviço</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#informacaoPagamento" role="tab">
											<span class="hidden-xs-down">Informação de Pagamento</span>
										</a>
									</li>
								</ul>

								<!-- Tab panes-->
								<div class="tab-content">
									<!-- Aba "Informação Produto/Serviço" -->
									<div class="tab-pane active p-3" id="informacaoProdServ" role="tabpanel">
										<div class="row mb-3">
											<div class="col-2">
												<label for="inputTextCTM_QtdeHoraTotal" id="linputTextCTM_QtdeHoraTotal" class="control-label col-form-label">Quantidade Total (h)</label>
												<input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_QtdeHoraTotal']; ?>" id="inputTextCTM_QtdeHoraTotal"/>
											</div>
										</div>
									</div>

									<!-- Aba "Informação de Pagamento" -->
									<div class="tab-pane p-3" id="informacaoPagamento" role="tabpanel">
										<div class="row mb-2">
											<div class="col-md-2">
												<label for="inputSelectCFC_Codigo" id="linputSelectCFC_Codigo" class="control-label col-form-label">Condição de Faturamento</label>
												<select class="form-control" id="inputSelectCFC_Codigo" style="height: 38px; padding: 6px 12px;">
													<option value="">Escolher Condição de Faturamento ...</option>
													<?php foreach ($condicoesfaturamento as $condfat): ?>
														<option value="<?php echo $condfat['CFC_Codigo']; ?>"
															<?php echo ($condfat['CFC_Codigo'] == $ArrayEditaCTM[0]['CFC_Codigo']) ? 'selected' : ''; ?>>
															<?php echo $condfat['CFC_Descricao']; ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="col-md-2">
												<label for="inputSelectCPG_Codigo" id="linputSelectCPG_Codigo" class="control-label col-form-label">Condição de Pagamento</label>
												<select class="form-control" id="inputSelectCPG_Codigo" style="height: 38px; padding: 6px 12px;">
													<option value="">Escolher Condição de Pagamento ...</option>
													<?php foreach ($condicoespagamento as $condpag): ?>
														<option value="<?php echo $condpag['CPG_Codigo']; ?>"
															<?php echo ($condpag['CPG_Codigo'] == $ArrayEditaCTM[0]['CPG_Codigo']) ? 'selected' : ''; ?>>
															<?php echo $condpag['CPG_Descricao']; ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="col-md-2">
												<label for="inputTextCTM_DataAceite" id="linputTextCTM_DataAceite" class="control-label col-form-label">Data Aceite</label>
												<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataAceite']; ?>" id="inputTextCTM_DataAceite" />
											</div>
											<div class="col-2">
												<label for="inputTextCTM_ValorTotal" id="linputTextCTM_ValorTotal" class="control-label col-form-label">Valor Total (R$)</label>
												<input type="text" style="height: 38px; padding: 6px 12px; font-weight: bold; color: darkblue; text-align: right;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_ValorTotal']; ?>" id="inputTextCTM_ValorTotal" disabled />
											</div>
											<div class="col-2">
												<label for="inputTextCTM_CorrecaoIndice" id="linputTextCTM_CorrecaoIndice" class="control-label col-form-label">Índice para correção</label>
												<input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_CorrecaoIndice']; ?>" id="inputTextCTM_CorrecaoIndice"/>
											</div>
											<div class="col-2">
												<label for="inputTextCTM_CorrecaoPercent" id="linputTextCTM_CorrecaoPercent" class="control-label col-form-label">Correção (%)</label>
												<input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_CorrecaoPercent']; ?>" id="inputTextCTM_CorrecaoPercent"/>
											</div>
										</div>
										<div class="row mb-12">
											<table id="ParcPagTable" class="table table-hover" style="width:100%">
												<thead>
													<tr>
														<th id='coParcSequ'>#</th>
														<th id='coParcAtiv'>Descrição</th>
														<th id='coParcVcto'>Vencimento</th>
														<th id='coParcValo'>Valor (R$)</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>

								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - CtmEdita: vs00.11 2409282000
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>
    
    <script type="text/javascript">
        removeSpinner();    

        $('#ListaStatusContrato').addClass('selected');
        $('#liCadastrosBasicos').addClass('active');
        $('#liComercial').addClass('in');

		ParcPagListar();

		// Formatando / mascarando valores em horas e reais
		$('#inputTextCTM_ValorTotal').val(formatarReais(<?php echo $ArrayEditaCTM[0]['CTM_ValorTotal']; ?>));
		$('#inputTextCTM_QtdeHoraTotal').val(formatarMilhar(<?php echo $ArrayEditaCTM[0]['CTM_QtdeHoraTotal']; ?>));

		var ArrayPessoasDoCliente = [];
		var vParcPagSomarTotalVal = 0;
		var vCBRCodigo = null;
		var vMostraTudo = 0;
		BuscarColaboradores(vCBRCodigo, vMostraTudo);
		buscarPessoasDoCliente($('#inputSelectCLI_Codigo').val());

		// Tratando a Data de Rquisição
		$('#inputTextCTM_DataRequisicao').change(function() {
			var dataRequisicao = $(this).val();

			// Verifica se a data está preenchida
			if (dataRequisicao === '') {
				alert('Por favor, preencha a data.');
				$(this).focus();
				return;
			}
    
			// Verifica se a data é válida
			if (!isValidDateBR(dataRequisicao)) {
				alert('Por favor, insira uma data válida no formato DD/MM/AAAA.');
				$(this).focus();
				return;
			}
    
			console.log('Data válida: ' + dataRequisicao);
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
					pCBRCodigo: pCBRCodigo,
					pMostraTudo: pMostraTudo
				},
				dataType: "json",
				success: function(response) {
					var selectGestor = $('#inputSelectGestorWdNome');
					var selectFinanc = $('#inputSelectFinanceiroWdNome');
					selectGestor.empty();
					selectFinanc.empty();

					var gestorSelecionado = "<?php echo $ArrayEditaCTM[0]['CTM_CBRGestorWdCodigo']; ?>";
					var financeiroSelecionado = "<?php echo $ArrayEditaCTM[0]['CTM_CBRFinancWdCodigo']; ?>";

					selectGestor.append('<option value="">Escolher Gestor WD...</option>');
					selectFinanc.append('<option value="">Escolher Financeiro WD...</option>');

					$.each(response, function(index, colaborador) {
						var isGestorSelected = colaborador.CODIGO == gestorSelecionado ? 'selected' : '';
						var isFinancSelected = colaborador.CODIGO == financeiroSelecionado ? 'selected' : '';
						selectGestor.append('<option value="' + colaborador.CODIGO + '" ' + isGestorSelected + '>' + colaborador.COLABORADOR + '</option>');
						selectFinanc.append('<option value="' + colaborador.CODIGO + '" ' + isFinancSelected + '>' + colaborador.COLABORADOR + '</option>');
					});
				},
				error: function(xhr, status, error) {
					console.error("Erro ao buscar os colaboradores WD: ", error);
				}
			});
		}


		$('#btnSalvar').click(function() {
			UpdateContratosMaster();
		});  

        function UpdateContratosMaster() {            
			return $.ajax({
				url: "<?php echo base_url(); ?>contrato/CtmLista/UpdateContratosMaster",
				type: 'POST',
				data: {
					CTM_Codigo: $('#inputTextCTM_Codigo').val(),
					CTM_STTCodigo: $('#inputSelectSTT_Codigo').val(),
					CTM_TCTCodigo: $('#inputSelectTCT_Codigo').val(),
					CTM_UPCCodigo: $('#inputSelectCTM_UPCCodigo').val(),
					CTM_CFCCodigo: $('#inputSelectCFC_Codigo').val(),
					CTM_CPGCodigo: $('#inputSelectCPG_Codigo').val(),
					CTM_DataRequisicao: $('#inputTextCTM_DataRequisicao').val(),
					CTM_DataAceite: $('#inputTextCTM_DataAceite').val(),
					CTM_DataVigenciaIni: $('#inputTextCTM_DataVigenciaIni').val(),
					CTM_DataVigenciaFim: $('#inputTextCTM_DataVigenciaFim').val(),
					CTM_NumeroWD: $('#inputTextCTM_NumeroWD').val(),
					CTM_Descricao: $('#inputTextCTM_Descricao').val(),
					CTM_NumeroCliente: $('#inputTextCTM_NumeroCliente').val(),
					CTM_TituloCliente: $('#inputTextCTM_TituloCliente').val(),
					CTM_Procedimento: $('#inputTextCTM_Procedimento').val(),
					CTM_LinkProposta: $('#inputTextCTM_LinkProposta').val(),
					CTM_LinkContrato: $('#inputTextCTM_LinkContrato').val(),
					CTM_CLICodigo: $('#inputSelectCLI_Codigo').val(),
					CTM_CLPCodigo: $('#inputSelectCTM_CLPCodigo').val(),
					CTM_CBRGestorWdCodigo: $('#inputSelectGestorWdNome').val(),
					CTM_CBRFinancWdCodigo: $('#inputSelectFinanceiroWdNome').val(),
					CTM_QtdeHoraTotal: $('#inputTextCTM_QtdeHoraTotal').val(),
					CTM_ValorTotal: $('#inputTextCTM_ValorTotal').val().replace(/[R$\.\s]/g, '').replace(',', '.'),
					CTM_CorrecaoIndice: $('#inputTextCTM_CorrecaoIndice').val(),
					CTM_CorrecaoPercent: $('#inputTextCTM_CorrecaoPercent').val()
				},
				success: function(response) {
					Swal.fire(
						'Sucesso!',
						'O contrato foi salvo com sucesso.',
						'success'
					).then(() => {
						// Redirecionar ou recarregar a página, se necessário
						location.reload();
					});
				},
				error: function(xhr, status, error) {
					Swal.fire(
						'Erro!',
						'Ocorreu um erro ao salvar o contrato. Tente novamente.',
						'error'
					);
					console.log(xhr.responseText);
				}
			});
		}

		function ParcPagListar () {

				var vctmCodigo = $('#inputTextCTM_Codigo').val();

				$('#ParcPagTable').DataTable({
				"ajax": {
					"url": "<?= base_url('contrato/CtmLista/getParcelasDoContrato'); ?>",
					"type": 'POST',
					"data": {ctmCodigo: vctmCodigo
					},
					"dataSrc": ""
				},
				"responsive": false,
				"destroy": true,
				"paging": false,
				"searching": false,
				"info": false,
				"rowId": 'CTP_Codigo',
				"columns": [
					{ "data": "CTP_Codigo" },
					{
						"data": "CTP_Descricao",
						render: function(data, type, row) {
							return '<input type="text" style="text-align: left;" value="' + data + '" id="rowCTP_Descricao' + row.CTP_Codigo + '" />';
						}
					},
					{
						"data": "CTP_DtaVencimento",
						render: function(data, type, row) {
							return '<input type="date" style="text-align: left;" value="' + data + '" id="rowCTP_DtaVencimento' + row.CTP_Codigo + '" />';
						}
					},
					{
						"data": "CTP_Valor",
						className: "text-right",
						render: function(data, type, row) {
							var valorFormatado = parseFloat(data).toLocaleString('pt-BR', {
								style: 'decimal',
								minimumFractionDigits: 2,
								maximumFractionDigits: 2
							});
							return '<input type="text" style="text-align: right;" value="' + valorFormatado + '" id="rowCTP_Valor' + row.CTP_Codigo + '" />';
						}
					}
				],
				"columnDefs": [
					{
                        "width": "1%",
                        "targets": [0],
                    },
                    {
                        "width": "83%",
                        "targets": [1]
                    },
                    {
                        "width": "8%",
                        "targets": [2]
                    },
                    {
                        "width": "8%",
                        "targets": [3]
                    }
				],
                "initComplete": function(settings, json) {
				
				 $("input[id^='rowCTP_Valor']").maskMoney({
					prefix: 'R$ ',
					thousands: '.',
					decimal: ',',
					affixesStay: true,
					precision: 2,
					allowZero: true,
					allowNegative: false
				});
				
				$("#ParcPagTable").on('change', "input[id^='rowCTP_Valor']", function() {
					ParcPagSomar();
				});
				setInputTextHints();
				
                ParcPagSomar();                    
                }
				
		});

		function ParcPagSomar() {
			var vParcPagSomarTotalVal = 0;
    
			$('#ParcPagTable').find('tr').slice(1).each(function() {
				var valorCampo = $(this).find('td:eq(3) input').val();

				// Remove prefixo e separadores de milhar antes de somar
				var valorLimpo = valorCampo.replace(/[R$\.\s]/g, '').replace(',', '.');

				if (!isNaN(parseFloat(valorLimpo))) {
					vParcPagSomarTotalVal += parseFloat(valorLimpo) || 0;
				}
			});

			// Exibir o valor total com a formatação correta
			$('#inputTextCTM_ValorTotal').val(
				'R$ ' + vParcPagSomarTotalVal.toLocaleString('pt-BR', {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				})
			);
		}

		$('#inputSelectCLI_Codigo').select2({
			placeholder: 'Escolher Cliente...',
			allowClear: true,
			width: '100%'
		});

		function setInputTextHints() {
			$('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

			$('[id^="input"], [id^="linput"]').prop('title', 'Qual será o tooltip explicando aqui, Sobreira?');

			$('#coParcSequ').prop('title', 'Número sequencial da parcela (#).');
			$('#coParcAtiv').prop('title', 'Descrição.');
			$('#coParcVcto').prop('title', 'Data de vencimento prevista para a parcela.');
			$('#coParcValo').prop('title', 'Valor previsto da parcela.\nSua somatória será o valor total do Contrato.');

			
			$('#inputTextCTM_Codigo, #linputTextCTM_Codigo').prop('title', 'Código sequencial do Contrato Master.');
			$('#inputTextCTM_DataRequisicao, #linputTextCTM_DataRequisicao').prop('title', 'Data da Requisição para o Contrato.');
			$('#inputSelectCLI_Codigo, #linputSelectCLI_Codigo').prop('title', 'Cliente do Contrato.\nSelecione o cliente na lista.');
			$('#inputSelectTCT_Codigo, #linputSelectTCT_Codigo').prop('title', 'Tipo de Contrato Master.\nSelecione o tipo na lista.');
			$('#inputSelectSTT_Codigo, #linputSelectSTT_Codigo').prop('title', 'Sttus (situação) do Contrato Master.\nSelecione o status na lista.');
			$('#inputSelectSTT_Codigo, #linputSelectSTT_Codigo').prop('title', 'Sttus (situação) do Contrato Master.\nSelecione o status na lista.');
		
			
			$('#inputTextCTM_CorrecaoIndice, #linputTextCTM_CorrecaoIndice').prop('title', 'IPCA: (Índice de Preços ao Consumidor Amplo): usado como referência oficial para metas de inflação.\n' +
				'INPC: (Índice Nacional de Preços ao Consumidor): usado para corrigir salários e benefícios previdenciários.\n' +
				'IGP-M: (Índice Geral de Preços do Mercado): amplamente utilizado em reajustes de aluguéis.\n' +
				'IGP-DI: (Índice Geral de Preços - Disponibilidade Interna): similar ao IGP-M, porém com coleta em períodos diferentes.\n' +
				'Selic: Selic (Taxa Básica de Juros): taxa usada como referência para os juros na economia.\n' +
				'TR: (Taxa Referencial): usada em financiamentos imobiliários e cadernetas de poupança.\n' +
				'TJLP: (Taxa de Juros de Longo Prazo): utilizada em financiamentos do BNDES.\n' +
				'TLP: (Taxa de Longo Prazo): substituiu a TJLP para novos contratos do BNDES.\n' +
				"CDI: (Certificado de Depósito Interbancário): usado como referência para diversas operações de crédito.\n" +
				'Poupança: Poupança: taxa de rendimento da caderneta de poupança, vinculada à Selic.\n' +
				'UFIR: (Unidade Fiscal de Referência): extinta, mas ainda usada em algumas regiões para correção de tributos.\n' +
				'IPC-Fipe: (Índice de Preços ao Consumidor - FIPE): usado para reajustes em São Paulo.');
			$('#inputTextCTM_ValorTotal, #linputTextCTM_ValorTotal').prop('title', 'Valor total do Contrato Master.\nValor total das parcelas.\nInclua uma ou mais parcelas.');
			

			$('[data-toggle="tooltip"]').tooltip({
				placement: "bottom",
				boundary: 'window',
				animation: true,
				trigger: "hover"
			});
		}

	}
    </script>
</body>
</html> 
