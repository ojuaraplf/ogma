<!-- Modal -->
<div class="modal fade" id="modalDetalhesFinanceiro" tabindex="-1" role="dialog"
		 aria-labelledby="modalDetalhesFinanceiroLabel" aria-hidden="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">


				<h5 class="modal-title" id="modalDetalhesFinanceiroLabel"> Detalhes Financeiro </h5>


				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>


			<div class="modal-body">
				<div class="form-group">
					<div class="row mb-3">
						<div class="col-2 ">
							<label for="inputTexta033_cd_lcto_financeiro" class="text-left control-label col-form-label"> Lcto
								Financeiro </label>
							<input type="text" class="form-control" id="inputTexta033_cd_lcto_financeiro"/>
						</div>
						<div class="col-1">
							<label for="inputTexta033_tp_lcto_financeiro" class="text-left control-label col-form-label">Tipo</label>
							<input type="text" class="form-control" id="inputTexta033_tp_lcto_financeiro"/>
						</div>
						<div class="col-2">
							<label for="inputTexta033_vl_lcto_financeiro" class="text-left control-label col-form-label">Valor</label>
							<input type="text" class="form-control" id="inputTexta033_vl_lcto_financeiro"/>
						</div>
						<div class="col-7">
							<label for="inputTextreferente" class="text-left control-label col-form-label">Referente</label>
							<input type="text" class="form-control" id="inputTextreferente"/>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<label for="inputTexta033_ds_lcto_financeiro"
										 class="text-left control-label col-form-label">Despesa</label>
							<input type="text" class="form-control" id="inputTexta033_ds_lcto_financeiro"/>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<label for="inputTexta033_obs_lcto_financeiro" class="text-left control-label col-form-label">Observação</label>
							<input type="text" class="form-control" id="inputTexta033_obs_lcto_financeiro"/>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-6 ">
							<label for="inputTexta033_nr_documento" class="text-left control-label col-form-label"> NR Doc </label>
							<input type="text" class="form-control" id="inputTexta033_nr_documento"/>
						</div>
						<div class="col-6">
							<label for="inputTexta033_dsc_grupo_lcto" class="text-left control-label col-form-label">Grupo</label>
							<input type="text" class="form-control" id="inputTexta033_dsc_grupo_lcto"/>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-6 ">
							<label for="inputTexta050_subgrupo_lcto" class="text-left control-label col-form-label"> Sub
								Grupo </label>
							<input type="text" class="form-control" id="inputTexta050_subgrupo_lcto"/>
						</div>
						<div class="col-6">
							<label for="inputTextPJT_APELIDO" class="text-left control-label col-form-label">?????</label>
							<input type="text" class="form-control" id="inputTexta033_ind_conciliado"/>
						</div>
					</div>


					<div class="row mb-3">
						<div class="col-6 ">
							<label for="inputTextPJT_TITULO" class="text-left control-label col-form-label"> Valor Principal </label>
							<input type="text" class="form-control" id="inputTexta033_vl_principal"/>
						</div>
						<div class="col-6">
							<label for="inputTextPJT_APELIDO" class="text-left control-label col-form-label">????</label>
							<input type="text" class="form-control" id="inputTexta033_sit_lcto_financeiro"/>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-6 ">
							<label for="inputTextPJT_TITULO" class="text-left control-label col-form-label"> Data venc </label>
							<input type="text" class="form-control" id="inputTexta033_dt_vencimento"/>
						</div>
						<div class="col-6">
							<label for="inputTextPJT_APELIDO" class="text-left control-label col-form-label">Data Pag</label>
							<input type="text" class="form-control" id="inputTexta033_dt_pagamento"/>
						</div>


					</div>
					<div class="row mb-3">
						<div class="col-6 ">
							<label for="inputTextPJT_TITULO" class="text-left control-label col-form-label"> Valor Pag </label>
							<input type="text" class="form-control" id="inputTexta033_vl_pagamento"/>
						</div>
						<div class="col-6">
							<label for="inputTextPJT_APELIDO" class="text-left control-label col-form-label">C/c</label>
							<input type="text" class="form-control" id="inputTexta033_nr_conta_corrente"/>
						</div>
					</div>


				</div>


				<div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="btnSalvarFinanceiro">Salvar</button>
			</div>


		</div>
	</div>
</div>


<script type="text/javascript">
	$('#btnSalvarFinanceiro').click(function () {


	});

	function updateFinanceiro() {


// a033_cd_lcto_financeiro
// a033_dt_lcto_financeiro
// a033_tp_lcto_financeiro
// a033_vl_lcto_financeiro
// a033_ds_lcto_financeiro
// a033_obs_lcto_financeiro
// referente
// a033_nr_documento
// a049_dsc_grupo_lcto
// a050_dsc_subgrupo_lcto
// a033_ind_conciliado
// a033_vl_principal
// a033_sit_lcto_financeiro
// a033_dt_vencimento
// a033_dt_pagamento
// a033_vl_pagamento
// a032_nr_conta_corrente


		// var PJF_IDENTIFICACAOFASE = $('#inputTextPJF_IDENTIFICACAOFASE').val();
		// var PJF_DATAINICIO = $('#inputTextPJF_DATAINICIO').val().split("/").reverse().join("-");
		// var PJF_DATATERMINO = $('#inputTextPJF_DATATERMINO').val().split("/").reverse().join("-");
		// var PJF_QTHORA = $('#inputTextPJF_QTHORA').val();
		// var PJF_RECURSOSMATERIAIS = $('#inputTextPJF_RECURSOSMATERIAIS').val();

		// var PJF_CODFOCALCLI = $('#comboboxFocal').val();
		// var PJF_FUNCAOFOCAL = $('#inputTextPJF_FUNCAOFOCAL').val();
		// var PJF_CONTATOHOMOLOGENTREGA = $('#comboboxResponsavel').val();
		// var PJF_FUNCCONTATOHOMOLOG = $('#inputTextPJF_FUNCCONTATOHOMOLOG').val();

		// var PJF_ESCOPO = $('#inputTextPJF_ESCOPO').val();
		// var PJF_ESCOPONEGATIVO = $('#inputTextPJF_ESCOPONEGATIVO').val();
		// var PJF_REQUISITOS = $('#inputTextPJF_REQUISITOS').val();
		// var PJF_ENTREGAFASE = $('#inputTextPJF_ENTREGAFASE').val();


		// return $.ajax({
		//   url: "<?php echo base_url(); ?>editarFase/updateFase",
		//   type: 'POST',
		//   data: {
		//     PJF_CODIGO: <?php echo $this->uri->segment(3); ?>,
		//     PJF_IDENTIFICACAOFASE: PJF_IDENTIFICACAOFASE,
		//     PJF_DATAINICIO: PJF_DATAINICIO,
		//     PJF_DATATERMINO: PJF_DATATERMINO,
		//     PJF_QTHORA: PJF_QTHORA,
		//     PJF_RECURSOSMATERIAIS: PJF_RECURSOSMATERIAIS,
		//     PJF_CODFOCALCLI: PJF_CODFOCALCLI,
		//     PJF_FUNCAOFOCAL: PJF_FUNCAOFOCAL,
		//     PJF_CONTATOHOMOLOGENTREGA: PJF_CONTATOHOMOLOGENTREGA,
		//     PJF_FUNCCONTATOHOMOLOG: PJF_FUNCCONTATOHOMOLOG,
		//     PJF_ESCOPO: PJF_ESCOPO,
		//     PJF_ESCOPONEGATIVO: PJF_ESCOPONEGATIVO,
		//     PJF_REQUISITOS: PJF_REQUISITOS,
		//     PJF_ENTREGAFASE: PJF_ENTREGAFASE
		//   },

		// });
	}


</script>