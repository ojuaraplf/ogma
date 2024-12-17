<!-- Modal -->
<div class="modal fade" id="modalRelatorioApontamentoHora" tabindex="-1" role="dialog"
		 aria-labelledby="modalRelatorioApontamentoHoraLabel" aria-hidden="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">


				<h5 class="modal-title" id="modalRelatorioApontamentoHoraLabel"> Lancamento de Horas </h5>


				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>


			<div class="modal-body">
				<div class="form-group">

					<div class="row mb-3">

						<div class="col-2 ">
							<label for="inputTextDSP_Codigo" class="text-left control-label col-form-label"> COD </label>
							<input type="text" class="form-control" id="inputTextLCT_CODIGO" disabled/>
						</div>


						<div class="col-3">
							<label for="inputTextaDST_DataDespesa" class="text-left control-label col-form-label">Data Despesa</label>
							<input type="text" class="form-control" id="inputTextaDST_DataDespesa"/>
						</div>

						<div class="col-7">
							<label for="inputTextDSP_Descricao" class="text-left control-label col-form-label">Descrição</label>
							<input type="text" class="form-control" id="inputTextDSP_Descricao"/>
						</div>

					</div>


					<div class="row mb-3">
						<div class="col-12">
							<label for="textareaDSP_PJT_CODIGO" class="text-left control-label col-form-label">Projeto</label>
							<select class="form-control" id="comboboxDSP_PJT_CODIGO">
							</select>
						</div>
					</div>


					<div class="row mb-3">
						<div class="col-12">
							<label for="textareaDSP_ObjetivoDespesa" class="text-left control-label col-form-label">Objetivo</label>
							<textarea rows="5" class="form-control" id="textareaDSP_ObjetivoDespesa"> </textarea>
						</div>
					</div>


					<div class="row mb-3">
						<div class="col-6">
							<label for="inputTextDSP_ValorDespesa" class="text-left control-label col-form-label">Valor
								Despesa</label>
							<input type="text" class="form-control" id="inputTextDSP_ValorDespesa"/>
						</div>
						<div class="col-6">
							<label for="inputTextDSP_IdentificacaoDocumento" class="text-left control-label col-form-label">Identificação
								Despesa</label>
							<input type="text" class="form-control" id="inputTextDSP_IdentificacaoDocumento"/>
						</div>
					</div>
				</div>


				<div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="btnUpdateApontarDespesa">Salvar</button>
			</div>


		</div>
	</div>
</div>

<script type="text/javascript">


	$.when(fetchProjeto()).done(function (r1) {

		var html = "";
		html += '<option value="0"> Selecione um projeto </option>';
		for (var i = r1.length - 1; i >= 0; i--) {
			html += '<option value="' + r1[i].PJT_CODIGO + '"> ' + r1[i].PJT_APELIDO + '</option>';
		}
		$('#comboboxDSP_PJT_CODIGO').html(html)



	});


	$('#modalApontarDespesaProjeto').on('hidden.bs.modal', function (e) {
		$('#inputTextDSP_Codigo').val("");
		$('#inputTextaDST_DataDespesa').val("");
		$('#inputTextDSP_Descricao').val("");
		$('#textareaDSP_ObjetivoDespesa').val("");
		$('#comboboxDSP_PJT_CODIGO').val(0);

		$('#inputTextDSP_ValorDespesa').val("");
		$('#inputTextDSP_IdentificacaoDocumento').val("");


		$('#divAlertReturn').attr("class", "alert alert-light");
		$('#divAlertReturn').html("&nbsp;");
	});


	function fetchProjeto() {
		return $.ajax({
			url: "<?php echo base_url(); ?>apontarDespesaProjeto/fetchProjeto",
			dataType: 'json',
		});
	}


	$('#btnUpdateApontarDespesa').click(function () {
		updateApontarDespesa();
	});

	function updateApontarDespesa() {

		$('#divAlertReturn').attr("class", "alert alert-primary");
		$('#divAlertReturn').text("Carregando...");

		// $('#divAlertReturn').attr("class", "alert alert-danger");
		// $('#divAlertReturn').text("Necessário preencher todos os campos um novo projeto!");

		var DSP_Codigo = $('#inputTextDSP_Codigo').val();
		var DST_DataDespesa = $('#inputTextaDST_DataDespesa').val().split("/").reverse().join("-");
		var DSP_Descricao = $('#inputTextDSP_Descricao').val();
		var DSP_ObjetivoDespesa = $('#textareaDSP_ObjetivoDespesa').val();
		var DSP_PJT_CODIGO = $('#comboboxDSP_PJT_CODIGO').val();
		var DSP_IdentificacaoDocumento = $('#inputTextDSP_IdentificacaoDocumento').val();
		var DSP_ValorDespesa = $('#inputTextDSP_ValorDespesa').val().replace('R$ ', '').replace('.', '').replace(',', '.');

		// console.log($('#inputTextDSP_ValorDespesa').val().replace('R$ ', '').replace('.', '').replace(',', '.'));
		// var DSP_DataPgamento = $('#inputTextDSP_DataPgamento').val().split("/").reverse().join("-");
		// var DSP_DataRecebimento = $('#inputTextDSP_DataRecebimento').val().split("/").reverse().join("-");
		// var DSP_DataTermino = $('#inputTextDSP_DataTermino').val().split("/").reverse().join("-");
		// var DSP_DataFechamento = $('#inputTextDSP_DataFechamento').val().split("/").reverse().join("-");
		// var DSP_NumFechamento = $('#inputTextDSP_NumFechamento').val();

		if (DST_DataDespesa == "" || DSP_Descricao == "" || DSP_PJT_CODIGO == "") {
			$('#divAlertReturn').attr("class", "alert alert-danger");
			$('#divAlertReturn').text("Necessário preencher os campos obrigatórios!");
			return;
		}


		$.ajax({
			url: "<?php echo base_url(); ?>apontarDespesaProjeto/updateDespesaProjeto",
			type: 'POST',
			data: {
				DSP_001_cd_usuario: <?php echo $this->session->userdata('userCodigo'); ?>,
				DSP_Codigo: DSP_Codigo,
				DST_DataDespesa: DST_DataDespesa,
				DSP_Descricao: DSP_Descricao,
				DSP_ObjetivoDespesa: DSP_ObjetivoDespesa,
				DSP_PJT_CODIGO: DSP_PJT_CODIGO,
				DSP_IdentificacaoDocumento: DSP_IdentificacaoDocumento,
				DSP_ValorDespesa: DSP_ValorDespesa
				// DSP_DataPgamento: DSP_DataPgamento,
				// DSP_DataRecebimento: DSP_DataRecebimento,
				// DSP_DataTermino: DSP_DataTermino,
				// DSP_DataFechamento: DSP_DataFechamento,
				// DSP_NumFechamento: DSP_NumFechamento
			},
			success: function (data) {
				$('#divAlertReturn').attr("class", "alert alert-success");
				$('#divAlertReturn').text("Salvo!");

				$('#modalApontarDespesaProjeto').modal('hide');
				table.ajax.reload();
			}
		});

	}

	$('#inputTextaDST_DataDespesa').mask("00r00r0000", {
		translation: {
			'r': {
				pattern: /[\/]/,
				fallback: '/'
			},
			placeholder: "__/__/____"
		},
		placeholder: "DD/MM/AAAA"
	});

	$("#inputTextDSP_ValorDespesa").maskMoney({
		prefix: "R$ ",
		decimal: ",",
		thousands: "."
	});


</script>