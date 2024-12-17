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
        .nav-link.active {
            font-weight: bold; /* Negrito */
            font-size: calc(1em + 2px); /* Aumenta a fonte em 2px */
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
                        <h3 class="card-title"><i class="mdi mdi-umbrella-outline" style="color: #00FF00;"></i> Editar Contrato Master </h3>
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
									<div class="col-3">
                                        <label for="inputTextCTM_NumeroWD" id="linputTextCTM_NumeroWD" class="control-label col-form-label">Núm. Ctr Interno - WD​</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_NumeroWD']; ?>" id="inputTextCTM_NumeroWD"/>
                                    </div>
									<div class="col-md-2">
										<label for="inputTextCTM_DataRequisicao" id="linputTextCTM_DataRequisicao" class="control-label col-form-label">Data Requisição</label>
										<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataRequisicao']; ?>" id="inputTextCTM_DataRequisicao" />
									</div>
									<div class="col-md-2">
										<label for="inputTextCTM_DataVigenciaIni" id="linputTextCTM_DataVigenciaIni" class="control-label col-form-label">Data Início Vigência</label>
										<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataVigenciaIni']; ?>" id="inputTextCTM_DataVigenciaIni" />
									</div>
									<div class="col-md-2">
										<label for="inputTextCTM_DataVigenciaFim" id="linputTextCTM_DataVigenciaFim" class="control-label col-form-label">Data Fim Vigência</label>
										<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataVigenciaFim']; ?>" id="inputTextCTM_DataVigenciaFim" />
									</div>
									<div class="col-md-2">
										<label for="inputTextCTM_DataAceite" id="linputTextCTM_DataAceite" class="control-label col-form-label">Data Aceite</label>
										<input type="date" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_DataAceite']; ?>" id="inputTextCTM_DataAceite" />
									</div>
						       </div>
                               <div class="row mb-3">
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
									<div class="col-md-2">
										<label for="inputSelectCTM_UPCCodigo" id="linputSelectCTM_UPCCodigo" class="control-label col-form-label">Unidade Padrão</label>
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
									<div class="col-4">
										<label for="inputSelectGestorWdNome" id="linputSelectGestorWdNome" class="control-label col-form-label">Gestor da Conta (wD)</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectGestorWdNome">
											<option selected>Escolher Gestor WD...</option>
										</select>                                        
                                    </div> 
								</div>
								<hr style="width: 100%; border: 1px solid #A9A9A9;" />
								<div class="row mb-3">
									<div class="col-md-5">
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
										<?php 
											$ctmCodigo = $ArrayEditaCTM[0]['CLI_Codigo']; 
										?>
										<small class="form-text text-muted">
											<a href="https://www.somoswd.com.br/ogma/CliLista/" target="_blank">
												Caso não encontre o cliente na lista, procure-o/cadastre-o aqui.
											</a>
										</small>
									</div>
									<div class="col-2">
                                        <label for="inputTextCTM_NumeroCliente" id="linputTextCTM_NumeroCliente" class="control-label col-form-label">Cód./Núm no Cliente​​</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_NumeroCliente']; ?>" id="inputTextCTM_NumeroCliente"/>
                                    </div> 
									<div class="col-5">
                                        <label for="inputTextCTM_TituloCliente" id="linputTextCTM_TituloCliente" class="control-label col-form-label">Título no Cliente</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_TituloCliente']; ?>" id="inputTextCTM_TituloCliente"/>
                                    </div>
								</div>
								<div class="row mb-3">
									<div class="col-6">
										<label for="inputTextCTM_Descricao" id="linputTextCTM_Descricao" class="control-label col-form-label">Descrição</label>
										<textarea rows="2" style="height: 76px; padding: 6px 12px;" class="form-control" id="inputTextCTM_Descricao"><?php echo $ArrayEditaCTM[0]['CTM_Descricao']; ?></textarea>
									</div>   
									<div class="col-6">
										<label for="inputTextCTM_Procedimento" id="linputTextCTM_Procedimento" class="control-label col-form-label">Procedimento – Acesso ao Portal do cliente</label>
										<textarea rows="2" style="height: 76px; padding: 6px 12px;" class="form-control" id="inputTextCTM_Procedimento"><?php echo $ArrayEditaCTM[0]['CTM_Procedimento']; ?></textarea>
									</div>   
								</div>
								<div class="row mb-3">
									<div class="col-4">
									    <label for="inputSelectCTM_CLPCodigo" id="linputSelectCTM_CLPCodigo" class="control-label col-form-label">Responsável Cliente</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectCTM_CLPCodigo">
											<option selected>Escolher Responsável ...</option>
											<!-- Options should be dynamically generated -->
										</select>
										<?php 
											$ctmCodigo = $ArrayEditaCTM[0]['CLI_Codigo']; 
										?>
										<small class="form-text text-muted">
											<a href="https://www.somoswd.com.br/ogma/CliEdita/<?php echo $ctmCodigo; ?>" target="_blank">
												Caso não encontre a pessoa do cliente na lista, cadastre-a aqui.
											</a>
										</small>
                                    </div> 
									<div class="col-4">
                                        <label for="inputTextCLP_Email" id="linputTextCLP_Email" class="control-label col-form-label">E-mail</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CLP_Email']; ?>" id="inputTextCLP_Email" disabled/>
                                    </div>
									<div class="col-2">
                                        <label for="inputTextCLP_Telefone1" id="linputTextCLP_Telefone1" class="control-label col-form-label">Telefone 1</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CLP_Telefone1']; ?>" id="inputTextCLP_Telefone1" disabled/>
                                    </div>
									<div class="col-2">
                                        <label for="inputTextCLP_Telefone2" id="linputTextCLP_Telefone2" class="control-label col-form-label">Telefone 2</label>
                                        <input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CLP_Telefone2']; ?>" id="inputTextCLP_Telefone2" disabled/>
                                    </div>
								</div>									
								<hr style="width: 100%; border: 1px solid #A9A9A9;" />
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
								<hr style="width: 100%; border: 1px solid #A9A9A9;" />
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
									<div class="col-2">
										<label for="inputTextCTM_CorrecaoIndice" id="linputTextCTM_CorrecaoIndice" class="control-label col-form-label">Índice para correção</label>
										<input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_CorrecaoIndice']; ?>" id="inputTextCTM_CorrecaoIndice"/>
									</div>
									<div class="col-2">
										<label for="inputTextCTM_CorrecaoPercent" id="linputTextCTM_CorrecaoPercent" class="control-label col-form-label">Correção (%)</label>
										<input type="text" style="height: 38px; padding: 6px 12px;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_CorrecaoPercent']; ?>" id="inputTextCTM_CorrecaoPercent"/>
									</div>
									<div class="col-4">
										<label for="inputSelectFinanceiroWdNome" id="linputSelectFinanceiroWdNome" class="control-label col-form-label">Gestor Financeiro (wD)</label>
										<select class="form-control" style="height: 38px; padding: 6px 12px;" id="inputSelectFinanceiroWdNome">
											<option selected>Escolher Financeiro WD...</option>
										</select> 
                                    </div>
								</div>
								<hr style="width: 100%; border: 1px solid #A9A9A9;" />
								<div class="row mb-2">
									<div class="col-2">
										<label for="spanSomarHora" id="lspanSomarHora" class="control-label col-form-label">
											<span style="color: #A9A9A9;">[A]</span></br>Total em Serviços (R$)
										</label>
										<span style="height: 38px; padding: 6px 12px; font-weight: bold; color: darkblue; text-align: right; background-color: #E6E6FA;" class="form-control" id="spanSomarHora"</span>
									</div>
									<div class="col-2">
										<label for="spanSomarUsua" id="lspanSomarUsua" class="control-label col-form-label">
											<span style="color: #A9A9A9;">[B]</span></br>Total em Produtos (R$)
										</label>
										<span style="height: 38px; padding: 6px 12px; font-weight: bold; color: darkblue; text-align: right; background-color: #E6E6FA;" class="form-control" id="spanSomarUsua"</span>
									</div>
									<div class="col-2">
										<label for="spanSomarTudo" id="lspanSomarTudo" class="control-label col-form-label">
											<span style="color: #A9A9A9;">[C] A + B</span></br>Total em Recursos (R$)
										</label>
										<span style="height: 38px; padding: 6px 12px; font-weight: bold; color: darkblue; text-align: right; background-color: #E6E6FA;" class="form-control" id="spanSomarTudo"</span>
									</div>
									<div class="col-2">
										<!-- espaço em branco -->
									</div>
									<div class="col-2">
										<label for="spanDiferencaPagar" id="lspanDiferencaPagar" class="control-label col-form-label">
											<span style="color: #A9A9A9;">[D] E - C</span><br>A prever pagamento (R$)
										</label>
										<span id="spanDiferencaPagar" class="form-control" style="height: 38px; padding: 6px 12px; text-align: right; background-color: #FFFFFF;"></span>
									</div>
									<div class="col-2">
										<label for="inputTextCTM_ValorTotal" id="linputTextCTM_ValorTotal" class="control-label col-form-label">
											<span style="color: #A9A9A9;">[E]</span><br>Total pagamento previsto (R$)
										</label>
										<input type="text" style="height: 38px; padding: 6px 12px; font-weight: bold; color: darkblue; text-align: right; background-color: #FFFFE0;" class="form-control" value="<?php echo $ArrayEditaCTM[0]['CTM_ValorTotal']; ?>" id="inputTextCTM_ValorTotal" disabled />
									</div>
								</div>

								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" style="background-color: #E6E6FA;" href="#informacaoProdServ" role="tab">
											<span id="lspanAbaInfProdServ" class="hidden-xs-down">Recursos</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" style="background-color: #FFFFE0;" href="#informacaoPagamento" role="tab">
											<span id="lspanAbaInfPagamento" class="hidden-xs-down">Pagamento</span>
										</a>
									</li>
								</ul>

								<!-- Tab panes-->
								<div class="tab-content">
									<!-- ABA RECURSOS -->
									<div class="tab-pane active p-3" id="informacaoProdServ" role="tabpanel">
										<div class="row mb-12">
										<div class="col-12">
											<label for="RecTable" id="lRecTable" class="control-label col-form-label">Recursos Contratados</label>
										</div>
											<div class="col-12">
												<table id="RecTable" class="table table-hover" style="width:100%">
													<thead>
														<tr>
															<th id='coRecCodig'>#</th> <!-- CTR_Codigo -->
															<th id='coRecDescr'>Recurso</th> <!-- CTR_Descricao_Combinada -->
															<th id='coRecUnida'>Unid.</th> <!-- REP_UNVCodigo -->
															<th id='coRecQuant'>Quant.</th> <!-- CTR_Quantidade -->
															<th id='coRecPreco'>Preço (R$)</th> <!-- REP_VendaPreco -->
															<th id='coRecTotal'>Total (R$)</th>
															<th>
																<button id="coRecNovaLinha" style="border: none; background: none; font-size: 14px; cursor: pointer;">
																	<i class="mdi mdi-playlist-plus"></i>
																</button>
															</th>
														</tr>
													</thead>
													<tbody>
													</tbody>

												</table>
											</div>
										</div>

									</div>

									<!-- ABA PAGAMENTO -->
									<div class="tab-pane p-3" id="informacaoPagamento" role="tabpanel">
										<div class="row mb-12">
											<div class="col-12">
												<label for="ParcPagTable" id="lParcPagTable" class="control-label col-form-label">Parcelamento</label>
											</div>
											<div class="col-12">
												<table id="ParcPagTable" class="table table-hover" style="width:100%">
													<thead>
														<tr>
															<th id='coParcSequ'>#</th>
															<th id='coParcOrde'><i class="mdi mdi-sort-ascending"></i></th>
															<th id='coParcAtiv'>Descrição</th>
															<th id='coParcVcto'>Vencimento</th>
															<th id='coParcValo'>Valor (R$)</th>
															<th>
																<button id="btnNovaParcela" style="border: none; background: none; font-size: 14px; cursor: pointer;">
																	<i class="mdi mdi-playlist-plus"></i>
																</button>
															</th>
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
            </div>

            <footer class="footer text-center mt-auto">
                © 2019 wDiscover Ltda - CtmEdita: vs00.20 202410191635
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>
    
    <script type="text/javascript">

        $('#ListaStatusContrato').addClass('selected');
        $('#liCadastrosBasicos').addClass('active');
        $('#liComercial').addClass('in');

		var vParcPagSomarTotalVal = 0;
		var vCBRCodigo = null;
		var vMostraTudo = 0;
		var linhasFinanRemovidas = []; 
		var linhasRecurRemovidas = [];
		var ArrayPessoasDoCliente = [];
		var vRecurSomarTudo = 0;
		var vParcPagSomarTotalVal = 0;
		var vRecurDifApagar = 0;
		var vRecursosGeral = <?php echo json_encode($RecursosGeral); ?>;
			console.table('vRecursosGeral:', vRecursosGeral);
		
		removeSpinner();    
		BuscarColaboradores(vCBRCodigo, vMostraTudo);
		buscarPessoasDoCliente($('#inputSelectCLI_Codigo').val());
		ParcPagListar();
		RecursoListar();


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
			buscarDadosDaPessoaDoCliente(clienteCodigo, clpCodigo);
		});

		function buscarDadosDaPessoaDoCliente(clienteCodigo, clpCodigo) {
			var pessoa = ArrayPessoasDoCliente.find(p => p.CODIGO.toString() === clpCodigo.trim());
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
					var pagamentoSelecionado = "<?php echo $ArrayEditaCTM[0]['CTM_CBRFinancWdCodigo']; ?>";
					selectGestor.append('<option value="">Escolher Gestor WD...</option>');
					selectFinanc.append('<option value="">Escolher Financeiro WD...</option>');
					$.each(response, function(index, colaborador) {
						var isGestorSelected = colaborador.CODIGO == gestorSelecionado ? 'selected' : '';
						var isFinancSelected = colaborador.CODIGO == pagamentoSelecionado ? 'selected' : '';
						selectGestor.append('<option value="' + colaborador.CODIGO + '" ' + isGestorSelected + '>' + colaborador.COLABORADOR + '</option>');
						selectFinanc.append('<option value="' + colaborador.CODIGO + '" ' + isFinancSelected + '>' + colaborador.COLABORADOR + '</option>');
					});
				},
				error: function(xhr, status, error) {
					console.error("Erro ao buscar os colaboradores WD: ", error);
				}
			});
		}

		function validarCampos() {
			var camposValidos = true;
			var campos = [
				{ id: '#inputTextCTM_Descricao', mensagem: 'O campo Descrição precisa ser preenchido.' },
				{ id: '#inputTextCTM_NumeroCliente', mensagem: 'O campo Número do Cliente precisa ser preenchido.' },
				{ id: '#inputTextCTM_TituloCliente', mensagem: 'O campo Título do Cliente precisa ser preenchido.' },
				{ id: '#inputTextCTM_Procedimento', mensagem: 'O campo Procedimento precisa ser preenchido.' },
				{ id: '#inputSelectSTT_Codigo', mensagem: 'Selecione um Status do Contrato.' },
				{ id: '#inputSelectTCT_Codigo', mensagem: 'Selecione um Tipo de Contrato.' },
				{ id: '#inputSelectCTM_UPCCodigo', mensagem: 'Selecione uma Unidade Padrão.' },
				{ id: '#inputSelectCFC_Codigo', mensagem: 'Selecione uma Condição de Faturamento.' },
				{ id: '#inputSelectCPG_Codigo', mensagem: 'Selecione uma Condição de Pagamento.' },
				{ id: '#inputSelectCLI_Codigo', mensagem: 'Selecione um Cliente.' },
				// Adicione outros campos conforme necessário
			];
			$.each(campos, function(index, campo) {
				if ($(campo.id).val() === '' || $(campo.id).val() === null) {
					Swal.fire({
						title: 'Ops!',
						text: campo.mensagem,
						icon: 'error',
						confirmButtonText: 'OK'
					}).then(() => {
						$(campo.id).focus(); // Coloca o foco no campo
					});
					camposValidos = false;
					return false; // Para a execução do each
				}
			});
			return camposValidos;
		}

		function atualizarEstiloSpanDiferenca(valor) {
			var span = document.getElementById('spanDiferencaPagar');
			span.innerHTML = 'R$ ' + valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
			if (valor > 0) {
				span.style.color = 'black'; // Fonte preta
				span.style.fontWeight = 'normal'; // Sem negrito
			} else if (valor === 0) {
				span.style.color = 'green'; // Fonte verde
				span.style.fontWeight = 'normal'; // Sem negrito
			} else {
				span.style.color = 'red'; // Fonte vermelha
				span.style.fontWeight = 'normal'; // Sem negrito
			}
		}

		function UpdateContratosMaster() {
			var linkProposta = $('#inputTextCTM_LinkProposta').val();
			var linkContrato = $('#inputTextCTM_LinkContrato').val();

			// Verifica se os arquivos foram selecionados
			if (linkProposta === '') {
				linkProposta = '<?php echo $ArrayEditaCTM[0]['CTM_LinkProposta']; ?>';
			}
			if (linkContrato === '') {
				linkContrato = '<?php echo $ArrayEditaCTM[0]['CTM_LinkContrato']; ?>';
			}

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
					CTM_LinkProposta: linkProposta,
					CTM_LinkContrato: linkContrato,
					CTM_CLICodigo: $('#inputSelectCLI_Codigo').val(),
					CTM_CLPCodigo: $('#inputSelectCTM_CLPCodigo').val(),
					CTM_CBRGestorWdCodigo: $('#inputSelectGestorWdNome').val(),
					CTM_CBRFinancWdCodigo: $('#inputSelectFinanceiroWdNome').val(),
					CTM_QtdeHoraTotal: $('#inputTextCTM_QtdeHoraTotal').val(),
					CTM_ValorTotal: $('#inputTextCTM_ValorTotal').val().replace(/[R$\.\s]/g, '').replace(',', '.'),
					CTM_CorrecaoIndice: $('#inputTextCTM_CorrecaoIndice').val(),
					CTM_CorrecaoPercent: $('#inputTextCTM_CorrecaoPercent').val()
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

		$('#inputSelectCLI_Codigo').select2({
			placeholder: 'Escolher Cliente...',
			allowClear: true,
			width: '100%'
		});

		// ******************************************************************************************************
		// ABA RECURSOS *****************************************************************************************

		// $('#inputTextCTM_QtdeHoraTotal').val(formatarMilhar(<?php echo $ArrayEditaCTM[0]['CTM_QtdeHoraTotal']; ?>));

		function RecursoListar() {
			var vctmCodigo = $('#inputTextCTM_Codigo').val();
			var vctrCodigo = null;

			if (!vctmCodigo) {
				console.error("CTM Código está vazio.");
				return; // Não prossegue se vctmCodigo estiver vazio
			}
			
			$('#RecTable').DataTable({
				"ajax": {
					"url": "<?= base_url('contrato/CtmLista/getRecursosDoContratoMaster'); ?>",
					"type": 'POST',
					"data": { 
						ctmCodigo: vctmCodigo,
						ctrCodigo: vctrCodigo
					},
					"dataSrc": "",
					"error": function(xhr, error, thrown) {
						console.error("Erro na requisição Ajax:", error);
						// Você pode adicionar uma mensagem para o usuário aqui
					}
				},
				"responsive": false,
				"destroy": true,
				"paging": false,
				"searching": false,
				"info": false,
				"ordering": false,
				"order": [[3, "asc"]],
				"rowId": 'CTR_Codigo',
				"columns": [
					{	"data": "CTR_Codigo" },
					{
						"data": "CTR_Descricao_Combinada",
						"render": function(data, type, row) {
							var recursoIdPrefix = 'selectRecurso_' + row.CTR_Codigo;
							return criarSelectRecurso(row.CTR_REPCodigo, recursoIdPrefix);
						}
					},
					{
						"data": "REP_UNVCodigo",
					},
					{
						"data": "CTR_Quantidade",
						render: function(data, type, row) {
							var valorFormatado = parseFloat(data || 0).toFixed(2); // Formata como número com duas casas decimais
							return '<input type="number" step="1" style="text-align: right;" value="' + valorFormatado + '" id="rowCTR_Codigo' + row.CTR_Codigo + '" />';
						}
					},
					{
						"data": "CTR_VendaPreco",
						className: "text-right",
						render: function(data) {
							return parseFloat(data || 0).toLocaleString('pt-BR', {
								style: 'decimal',
								minimumFractionDigits: 2,
								maximumFractionDigits: 2
							});
						}
					},
					{
						"data": null,
						className: "text-right",
						render: function(data, type, row) {
							return RecurCalculaTotal(parseFloat(row.CTR_Quantidade), parseFloat(row.CTR_VendaPreco));
						}
					},
					{
						"data": "CTR_Codigo",
						render: function(data) {
							return '<button class="btnExcluirRecurso" id="btnExcluirRecurso' + data + '" style="border: none; background: none; cursor: pointer;" title="Excluir recurso ' + data + '"><i class="mdi mdi-delete"></i></button>';
						}
					}
				],

				"columnDefs": [
					{ "width": "1%", "targets": [0] },
					{ "width": "62%", "targets": [1] },
					{ "width": "12%", "targets": [2] },
					{ "width": "8%", "targets": [3] },
					{ "width": "8%", "targets": [4] },
					{ "width": "8%", "targets": [5] },
					{ "width": "1%", "targets": [6] }
				],
				"initComplete": function(settings, json) {

					$(document).on('click', '.btnExcluirRecurso', function() {
						var linha = $(this).closest('tr');
						var recursoId = linha.find('td:eq(0)').text().trim();
						if (recursoId) {
							linhasRecurRemovidas.push(recursoId);
						}
						linha.remove();
						console.table('console.table(linhasRecurRemovidas)');
						console.table(linhasRecurRemovidas);
						RecurSomarTudo();
					});
					RecurSomarTudo();
				}
			});
		}

		// Função para criar uma nova linha de recursos
		function criarNovaLinhaRecurso() {
			return {
				CTR_Codigo: '',
				CTR_Descricao_Combinada: criarSelectRecurso(null, 'selectRecurso_new_' + Date.now()), // Select vazio
				REP_UNVCodigo: '', // Unidade vazia
				CTR_Quantidade: '<input type="text" class="form-control" value="0" />', // Quantidade 0
				CTR_VendaPreco: '<input type="text" class="form-control" value="0.00" />' // Preço 0.00
			};
		}
		/*
		// Função que verifica se a tabela está vazia e adiciona uma linha
		function verificarTabelaRecursosVazia() {
			var tabelaRecursos = $('#RecTable').DataTable();
			if (tabelaRecursos.rows().count() === 0) {
				tabelaRecursos.row.add(criarNovaLinhaRecurso()).draw(false);
			}
		}
		*/

		// Evento do botão para adicionar uma nova linha
		$('#coRecNovaLinha').click(function() {
			var tabela = $('#RecTable').DataTable();
			tabela.row.add(criarNovaLinhaRecurso()).draw(false);
		});


		function criarSelectRecurso(selectedValue, recursoIdPrefix) {
			var selectElement = '<select class="form-control" id="' + recursoIdPrefix + '">';
			selectElement += '<option value="">Selecione um Recurso</option>';
			for (var i = 0; i < vRecursosGeral.length; i++) {
				var recurso = vRecursosGeral[i];
				if (recurso.REP_Codigo !== undefined) {
					var isSelected = (recurso.REP_Codigo === selectedValue) ? 'selected' : '';
					selectElement += '<option value="' + recurso.REP_Codigo + '" ' + isSelected + '>' + recurso.Descricao_Combinada + '</option>';
				}
			}
			selectElement += '</select>';
			return selectElement;
		}

		function atualizarValoresRecurso(linha, recursoCodigo) {
			var recursoSelecionado = vRecursosGeral.find(function(recurso) {
				return recurso.REP_Codigo === recursoCodigo;
			});
			if (recursoSelecionado) {
				linha.find('td:eq(2)').text(recursoSelecionado.REP_UNVCodigo);
				var precoUnitario = recursoSelecionado.REP_VendaPreco || 0;
				linha.find('td:eq(4)').text(precoUnitario.toLocaleString('pt-BR', {
					style: 'decimal',
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				}));
				var quantidade = parseFloat(linha.find('td:eq(3) input').val()) || 0;
				var total = RecurCalculaTotal(quantidade, precoUnitario);
				linha.find('td:eq(5)').text(total);
			}
		}

		// Quando o select de CTR_Descricao_Combinada for alterado
		$('#RecTable').on('change', 'select', function() {
			var linha = $(this).closest('tr');
			var recursoCodigo = $(this).val();  // Pega o código do recurso selecionado
			atualizarValoresRecurso(linha, recursoCodigo);
			RecurSomarTudo();
		});

		// Quando o campo de quantidade for alterado
		$('#RecTable').on('input', 'input', function() {
			var linha = $(this).closest('tr');
			var recursoCodigo = linha.find('select').val();  // Pega o código do recurso selecionado
			atualizarValoresRecurso(linha, recursoCodigo);
			RecurSomarTudo();
		});

		function UpdateRecursos() {
			var numRows = $('#RecTable tbody tr').length;
			console.log("Número de linhas na tabela RecTable: ", numRows);
			if (numRows === 0) {
				console.log("Tabela está vazia, encerrando a função.");
				return;
			}
			var recursos = [];
			$('#RecTable tbody tr').each(function() {
				var linha = $(this);
				var selectRecurso = linha.find('td:eq(1) select');
				if (selectRecurso.length === 0 || selectRecurso.val().trim() === '') {
					console.log("Linha vazia ou incompleta, ignorando.");
					return; // Ignora a linha se o select não estiver preenchido
				}
				var CTR_Codigo = linha.find('td:eq(0)').text().trim();
				var recurso = {
					CTR_Codigo: CTR_Codigo === "#" ? null : CTR_Codigo, // Trata valores vazios corretamente
					CTR_CTMCodigo: $('#inputTextCTM_Codigo').val(),
					CTR_REPCodigo: selectRecurso.val().trim(),
					CTR_Quantidade: linha.find('td:eq(3) input').val().trim() || "0", // Tratamento de valores vazios
					CTR_VendaPreco: linha.find('td:eq(4)').text().replace(/[R$\.\s]/g, '').replace(',', '.').trim() || "0.00"
				};
				recursos.push(recurso);
			});
			if (recursos.length === 0) {
				console.log("Nenhum recurso válido encontrado, abortando atualização.");
				return;
			}
			$.ajax({
				url: '<?= base_url('contrato/CtmLista/UpdateRecursos'); ?>',
				type: 'POST',
				data: {
					recursos: recursos,
					linhasRecurRemovidas: linhasRecurRemovidas
				}
			});
		}

		function RecurCalculaTotal (pQuant, pValor) {
			return (pQuant * pValor).toLocaleString('pt-BR', {
										style: 'decimal',
										minimumFractionDigits: 2,
										maximumFractionDigits: 2
									});
		}

		function RecurSomarTudo() {
			// Verifica se há linhas na tabela
			if ($('#RecTable tbody tr').length === 0) {
				return;
			}

			vRecurSomarTudo = 0;
			vRecurDifApagar = 0;
			var vRecurSomarHora = 0;
			var vRecurSomarUsua = 0;

			$('#RecTable tbody tr').each(function() {
				var valorCampo = $(this).find('td:eq(5)').text().trim();
				var tipoUnidade = $(this).find('td:eq(2)').text().trim(); // Coluna índice 3 para "Hora" ou "Usuário"
        
				console.log('Linha atual: ', $(this)); // Para verificar a linha atual
				console.log('Valor encontrado na coluna 5: ', valorCampo);
				console.log('Tipo de Unidade (coluna 3): ', tipoUnidade);

				if (valorCampo) {
					var valorLimpo = valorCampo.replace(/[R$\.\s]/g, '').replace(',', '.');

					if (!isNaN(parseFloat(valorLimpo))) {
						var valorNumerico = parseFloat(valorLimpo) || 0;
                
						// Soma ao total geral
						vRecurSomarTudo += valorNumerico;

						// Calcula a diferença entre total de recursos e total já pareclado
						vRecurSomarTudo += valorNumerico;
						vRecurDifApagar = vRecurSomarTudo - vParcPagSomarTotalVal;

						// Soma ao total de Hora, se for o caso
						if (tipoUnidade === 'Hora') {
							vRecurSomarHora += valorNumerico;
						}

						// Soma ao total de Usuário, se for o caso
						if (tipoUnidade === 'Usuário') {
							vRecurSomarUsua += valorNumerico;
						}
					}
				}
			});

			console.log('vRecurSomarTudo: ' + vRecurSomarTudo);
			console.log('vRecurSomarHora: ' + vRecurSomarHora);
			console.log('vRecurSomarUsua: ' + vRecurSomarUsua);

			// Atribui os valores aos spans correspondentes
			$('#spanSomarTudo').text(
				'R$ ' + vRecurSomarTudo.toLocaleString('pt-BR', {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				})
			);

			$('#spanSomarHora').text(
				'R$ ' + vRecurSomarHora.toLocaleString('pt-BR', {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				})
			);

			$('#spanSomarUsua').text(
				'R$ ' + vRecurSomarUsua.toLocaleString('pt-BR', {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				})
			);

			atualizarEstiloSpanDiferenca(vRecurDifApagar);
		}

		// *****************************************************************************************************
		// ABA PAGAMENTO ***************************************************************************************
		
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
				"ordering": false,
				"order": [[3, "asc"]],
				"rowId": 'CTP_Codigo',
				"columns": [
					{ "data": "CTP_Codigo" },
					{
						"data": null,
						"render": function (data, type, row, meta) {
							return (meta.row + 1);
						}
					},
					{
						"data": "CTP_Descricao",
						render: function(data, type, row) {
							return '<input type="text" style="text-align: left; width: 100%;" value="' + data + '" id="rowCTP_Descricao' + row.CTP_Codigo + '" />';
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
							return '<input type="text" style="text-align: right;" placeholder="R$ 0,00" value="' + valorFormatado + '" id="rowCTP_Valor' + row.CTP_Codigo + '" />';
						}
					},
					{
						"data": "CTP_Codigo", // Utilizando o valor de CTP_Codigo
						"render": function (data, type, row) {
							return '<button class="btnExcluirParcela" id="btnExcluirParcela' + data + '" style="border: none; background: none; cursor: pointer;" title="Excluir parcela ' + data + '"><i class="mdi mdi-delete"></i></button>';
						}
					}
				],
				"columnDefs": [
					{
                        "width": "1%",
                        "targets": [0],
                    },
					{
                        "width": "1%",
                        "targets": [1],
                    },
                    {
                        "width": "81%",
                        "targets": [2]
                    },
                    {
                        "width": "8%",
                        "targets": [3]
                    },
                    {
                        "width": "8%",
                        "targets": [4]
                    },
                    {
                        "width": "1%",
                        "targets": [5]
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

					/*
					$('#ParcPagTable').on('input', 'input', function() {
						console.log("Opa! Mexeram em um input da tabela ParcPagTable");
						RecurSomarTudo();
					});
					*/

					$(document).on('click', '.btnExcluirParcela', function() {
						var linha = $(this).closest('tr');
						var parcelaId = linha.find('td:eq(0)').text().trim();
						if (parcelaId) {
							linhasFinanRemovidas.push(parcelaId);
						}
						linha.remove();
						console.table('console.table(linhasFinanRemovidas)');
						console.table(linhasFinanRemovidas);
						ParcPagSomar();
					});

					setInputTextHints();
					ParcPagSomar();                    
                }
		});

		verificarTabelaParcelasVazia();
		function verificarTabelaParcelasVazia() {
			var tabelaParcelas = $('#ParcPagTable').DataTable();
			if (tabelaParcelas.rows().count() === 0) {
				var novaLinha = `
					<tr>
						<td>#</td>
						<td>1</td>
						<td><input type="text" style="text-align: left; width: 100%;" placeholder="Descrição da Parcela" /></td>
						<td><input type="date" style="text-align: left;" /></td>
						<td><input type="text" style="text-align: right;" class="parcela-valor" placeholder="R$ 0,00" /></td>
						<td>
							<button class="btnExcluirParcela" style="border: none; background: none;">
								<i class="mdi mdi-delete"></i>
							</button>
						</td>
					</tr>
				`;
				$('#ParcPagTable tbody').append(novaLinha);
				$("input.parcela-valor").maskMoney({
					prefix: 'R$ ',
					thousands: '.',
					decimal: ',',
					affixesStay: true,
					precision: 2,
					allowZero: true,
					allowNegative: false
				});
				$('.btnExcluirParcela').click(function() {
					$(this).closest('tr').remove();
					ParcPagSomar(); // Recalcula o total
				});
			}
		}

		$('#btnNovaParcela').click(function() {
			var totalLinhas = $('#ParcPagTable tbody tr').length + 1;
			var idDinamico = 'rowCTP_Valor' + totalLinhas; // Cria um ID único baseado no número da linha
			$('#ParcPagTable tbody').append(
				`<tr>
					<td>#</td>
					<td>` + totalLinhas + `</td>
					<td><input type="text" style="text-align: left; width: 100%;" placeholder="Descrição da Parcela" /></td>
					<td><input type="date" style="text-align: left;" /></td>
					<td><input type="text" style="text-align: right;" value="0.00" class="parcela-valor" id="` + idDinamico + `" placeholder="R$ 0,00" /></td>
					<td>
						<button class="btnExcluirParcela" style="border: none; background: none;">
							<i class="mdi mdi-delete"></i>
						</button>
					</td>
				</tr>`
			);
			$("#" + idDinamico).maskMoney({
				prefix: 'R$ ',
				thousands: '.',
				decimal: ',',
				affixesStay: true,
				precision: 2,
				allowZero: true,
				allowNegative: false
			});
			$('.btnExcluirParcela').click(function() {
				$(this).closest('tr').remove();
				ParcPagSomar();
			});
		});

		$("#ParcPagTable").on('keyup', "input[id^='rowCTP_Valor']", function() {
			console.log("Opa! Mexeram no valor da parcela da tabela ParcPagTable");
			ParcPagSomar();
		});	

		function ParcPagSomar() {

			vParcPagSomarTotalVal = 0;
			$('#ParcPagTable').find('tr').slice(1).each(function() {
				var valorCampo = $(this).find('td:eq(4) input').val();
				if (valorCampo) {
					var valorLimpo = valorCampo.replace(/[R$\.\s]/g, '').replace(',', '.');
					if (!isNaN(parseFloat(valorLimpo))) {
						vParcPagSomarTotalVal += parseFloat(valorLimpo) || 0;
						vRecurDifApagar = vRecurSomarTudo - vParcPagSomarTotalVal;
					}
				}
			});
			$('#inputTextCTM_ValorTotal').val(
				'R$ ' + vParcPagSomarTotalVal.toLocaleString('pt-BR', {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				})
			);
			atualizarEstiloSpanDiferenca(vRecurDifApagar);

		}

		function UpdateParcelas() {
			var numRows = $('#ParcPagTable tbody tr').length;
			console.log("Número de linhas na tabela ParcPagTable: ", numRows);
			if (numRows === 0) {
				console.log("Tabela está vazia, encerrando a função."); // Log para depuração
				return;
			}
			var parcelas = [];
			$('#ParcPagTable tbody tr').each(function() {
				var linha = $(this);
				var CTP_Codigo = linha.find('td:eq(0)').text().trim();
				var parcela = {
					CTP_Codigo: CTP_Codigo === "#" ? null : CTP_Codigo, // Trata valores vazios corretamente
					CTP_CTMCodigo: $('#inputTextCTM_Codigo').val(),
					CTP_Descricao: linha.find('td:eq(2) input').val().trim(),
					CTP_DtaVencimento: linha.find('td:eq(3) input').val().trim(),
					CTP_Valor: linha.find('td:eq(4) input').val().replace(/[R$\.\s]/g, '').replace(',', '.').trim()
				};
				parcelas.push(parcela);
			});
			$.ajax({
				url: '<?= base_url('contrato/CtmLista/UpdateParcelas'); ?>',
				type: 'POST',
				data: {
					parcelas: parcelas,
					linhasFinanRemovidas: linhasFinanRemovidas,
					CTM_Codigo: $('#inputTextCTM_Codigo').val()
				}
			});
		}

		// *****************************************************************************************************
		// GERALZONA *******************************************************************************************

		$('#btnSalvar').click(function() {
			if (!validarCampos()) {
				return;
			}
			$.when(UpdateContratosMaster(), UpdateParcelas(), UpdateRecursos())
			.done(function(r1, r2, r3) {
				Swal.fire(
					'Tudo certo!',
					'Contrato, parcelas e recursos atualizados com sucesso.',
					'success'
				);
			})
			.fail(function() {
				Swal.fire(
					'Ops!',
					'Ocorreu um erro ao salvar os dados. Tente novamente.',
					'error'
				);
			})
			.always(function() {
				location.reload(); // Recarregar a página após sucesso ou erro
			});
		});

		function setInputTextHints() {

			$('#btnSalvar').prop('title', 'Clique para salvar as alterações.');

			$('[id^="input"], [id^="linput"]').prop('title', 'Qual será o tooltip explicando aqui, Sobreira?');

			$('#inputTextCTM_Codigo, #linputTextCTM_Codigo').prop('title', 'Código sequencial do Contrato Master.');
			$('#inputTextCTM_DataRequisicao, #linputTextCTM_DataRequisicao').prop('title', 'Data da Requisição para o Contrato.');
			$('#inputSelectCLI_Codigo, #linputSelectCLI_Codigo').prop('title', 'Cliente do Contrato.\nSelecione o cliente na lista.');
			$('#inputSelectTCT_Codigo, #linputSelectTCT_Codigo').prop('title', 'Tipo de Contrato Master.\nSelecione o tipo na lista.');
			$('#inputSelectSTT_Codigo, #linputSelectSTT_Codigo').prop('title', 'Status (situação) do Contrato Master.\nSelecione o status na lista.');
			$('#inputTextCTM_NumeroWD, #linputTextCTM_NumeroWD').prop('title', 'Para a wDiscover, qual é o número, a identificação deste Contrato Master?');
			$('#inputTextCTM_Descricao, #linputTextCTM_Descricao').prop('title', 'Para a wDiscover, como se descreve suscintamente esta contratação?');
			$('#inputTextCTM_NumeroCliente, #linputTextCTM_NumeroCliente').prop('title', 'Para o Cliente, qual é o número, a identificação deste Contrato Master?');
			$('#inputTextCTM_TituloCliente, #linputTextCTM_TituloCliente').prop('title', 'Para o Cliente, como se intitula suscintamente esta contratação?');
			$('#inputSelectCTM_CLPCodigo').attr('title', 'Qual é a pessoa do Cliente responsável pela contratação da wDiscover? Selecione na lista.<br>Caso não a encontre, cadastre-a.');			
			$('#inputTextCLP_Email, #linputTextCLP_Email').prop('title', 'E-mail do cadastro da pessoa do Cliente responsável pela contratação da wDiscover.');
			$('#inputTextCLP_Telefone1, #linputTextCLP_Telefone1').prop('title', 'Telefone princial (celular ou fixo) do cadastro da pessoa do Cliente responsável pela contratação da wDiscover.');
			$('#inputTextCLP_Telefone2, #linputTextCLP_Telefone2').prop('title', 'Telefone auxiliar (celular ou fixo) do cadastro da pessoa do Cliente responsável pela contratação da wDiscover.');
			$('#inputTextCTM_Procedimento, #linputTextCTM_Procedimento').prop('title', 'Qual o procedimento contratado - objeto deste contrato? Descreva suscintamente.');
			$('#inputTextCTM_LinkProposta, #linputTextCTM_LinkProposta').prop('title', 'Nome de caminho do arquivo da proposta que gerou este Contrato Master');
			$('#inputTextCTM_LinkContrato, #linputTextCTM_LinkContrato').prop('title', 'Nome de caminho do arquivo do documento deste Contrato Master');
			$('#inputSelectGestorWdNome, #linputSelectGestorWdNome').prop('title', 'Pela wDiscover, quem é o gestor responsável por esta contratação - o Gestor da Conta?');
			$('#inputSelectFinanceiroWdNome, #linputSelectFinanceiroWdNome').prop('title', 'Pela wDiscover, quem é o gestor financeiro desta contratação?');
			$('#inputSelectCTM_UPCCodigo, #linputSelectCTM_UPCCodigo').prop('title', 'Unidade Padão de medida do produto ou serviço aqui contratado.');
			$('#inputTextCTM_DataVigenciaIni, #linputTextCTM_DataVigenciaIni').prop('title', 'Data do início do período de vigência deste Contrato Master.');
			$('#inputTextCTM_DataVigenciaFim, #linputTextCTM_DataVigenciaFim').prop('title', 'Data do término do período de vigência deste Contrato Master.');

			$('#spanSomarTudo, #lspanSomarTudo').prop('title', 'Total em R$ dos recursos contratados/vendidos.');
			$('#spanSomarUsua, #lspanSomarUsua').prop('title', 'Total em R$ dos produtos (Ferramentas) contratadas/vendidos\npor número de usuários das Ferramentas.');
			$('#spanSomarHora, #lspanSomarHora').prop('title', 'Total em R$ dos serviços (Hora/disponibilidade profissional) contratados/vendidos.');
			$('#spanSomarParc, #lspanSomarParc').prop('title', 'Total em R$ do Contrato.\nSoma das parcelas previstas para pagamento.');
			$('#spanDiferencaPagar, #lspanDiferencaPagar').prop('title', 'Diferença entre os recursos contratados/vendidos e o que já\nestá computado em uma ou mais parcelas para pagamento.');


			$('#lspanAbaInfProdServ').prop('title', 'Informações sobre o(s) produto(s) e/ou serviço(s) contratado(s).');
			$('#lspanAbaInfPagamento').prop('title', 'Informações sobre a forma de pagamentos contratada.');

			$('#coParcSequ').prop('title', 'Número sequencial da parcela (Id).');
			$('#coParcOrde').prop('title', 'Número de ordem da parcela.');
			$('#coParcAtiv').prop('title', 'Especificação da parcela.');
			$('#coParcVcto').prop('title', 'Data de vencimento prevista para a parcela.');
			$('#coParcValo').prop('title', 'Valor previsto da parcela.\nSua somatória será o valor total do Contrato.');
			$('#btnNovaParcela').prop('title', 'Clique para inserir nova parcela\nNo ícone de cada linha, clique para excluir a parcela da linha.');

			
			$('#inputTextCTM_CorrecaoIndice, #linputTextCTM_CorrecaoIndice').prop('title', 'IPCA: (Índice de Preços ao Consumidor Amplo): usado como referência oficial para metas de inflação.\n' +
				'INPC: (Índice Nacional de Preços ao Consumidor): usado para corrigir salários e benefícios previdenciários.\n' +
				'IGP-M: (Índice Geral de Preços do Mercado): amplamente utilizado em reajustes de aluguéis.\n' +
				'IGP-DI: (Índice Geral de Preços - Disponibilidade Interna): similar ao IGP-M, porémlm coleta em períodos diferentes.\n' +
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
