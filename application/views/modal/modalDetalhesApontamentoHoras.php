<!-- Modal -->
<div class="modal fade" id="modalDetalhesApontamentoHoras" tabindex="-1" role="dialog"
		 aria-labelledby="modalDetalhesApontamentoHorasLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalDetalhesApontamentoHorasLabel">Detalhes do Apontamento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>




			<div class="modal-body">
				<div class="form-group">
					<div class="row mb-3">
						<div class="col-4">
							<label for="inputTextLCT_CODIGOO" class="text-left control-label col-form-label">COD</label>
							<input type="text" class="form-control" id="inputTextLCT_CODIGOO" disabled/>
						</div>
						<div class="col-8">


							<label for="" class="text-left control-label col-form-label">Atividade</label>
							<select class="form-control" id="comboboxAtividadesColaborador">
							</select>
							<div class="invalid-feedback">
								<span id=""> Nenhuma atividade selecionada. </span>
							</div>








						</div>
					</div>



					<div class="row mb-3">

						<div class="col-3">
							<label for="inputTextLCT_DATA" class="text-left control-label col-form-label">Data</label>
							<input type="text" class="form-control" id="inputTextLCT_DATA" />
							<div class="invalid-feedback">
								<span id=""> Data incorreta. </span>
							</div>
						</div>
						<div class="col-2">
							<label for="inputTextLCT_HORAINICIO" class="text-left control-label col-form-label"> Hora Inicial </label>
							<input type="text" class="form-control" id="inputTextLCT_HORAINICIO"/>
							<div class="invalid-feedback">
								<span id="spanHoraInicialError"> Hora incorreta. </span>
							</div>
						</div>


						<div class="col-2">
							<label for="inputTextLCT_HORAFIM" class="text-left control-label col-form-label"> Hora Final </label>
							<input type="text" class="form-control" id="inputTextLCT_HORAFIM"/>
							<div class="invalid-feedback">
								<span id="spanHoraFinalError"> Hora incorreta. </span>
							</div>
						</div>
						<div class="col-3">
							<label for="inputTextLCT_CODCHAMADO" class="text-left control-label col-form-label"> Chamado </label>
							<input type="text" class="form-control" id="inputTextLCT_CODCHAMADO"/>
						</div>







						<div class="col-2">
							<label for="inputTextLCT_TEMPO" class="text-left control-label col-form-label">Qtd Horas</label>
							<input type="text" class="form-control" id="inputTextLCT_TEMPO" disabled/>
						</div>
					</div>









					<div class="row mb-3">
						<div class="col-12">
							<label for="textareaLCT_DESCRICAO" class="text-left control-label col-form-label">Descrição</label>


							<textarea rows="3" class="form-control" id="textareaLCT_DESCRICAO"> </textarea>
							<div class="invalid-feedback">
								<span id=""> Necessário preencher a descrição da Atividade </span>
							</div>


						</div>
					</div>
				</div>


				<div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="btnDeletarApontamento">Deletar Apontamento</button>
				<button type="button" class="btn btn-primary" id="btnSalvarApontamento">Salvar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	$('#modalDetalhesApontamentoHoras').on('show.bs.modal', function (e) {


	});

	$('#modalDetalhesApontamentoHoras').on('hidden.bs.modal', function () {
		fetchTotalHoras();
		$('#inputTextLCT_DATA').removeClass('is-invalid');
		$('#textareaLCT_DESCRICAO').removeClass('is-invalid');
		$('#inputTextLCT_HORAINICIO').removeClass('is-invalid');
		$('#inputTextLCT_HORAFIM').removeClass('is-invalid');
	});





	$('#inputTextLCT_HORAINICIO').change(function () {
		$('#spanHoraInicialError').text('Hora incorreta.');
		if ($(this).val().length < 5) {
			$(this).addClass('is-invalid');
			$('#inputTextLCT_TEMPO').val("");
		} else {
			$(this).removeClass('is-invalid');
			if ($('#inputTextLCT_HORAFIM').val().length == 5 && $('#inputTextLCT_HORAFIM').val() <= $(this).val()) {
				$(this).addClass('is-invalid');
				$('#inputTextLCT_HORAFIM').addClass('is-invalid');
				$('#spanHoraFinalError').text('Hora final está inferior à hora inicial.');
				$('#spanHoraInicialError').text('Hora inicial está superior à hora final');
				$('#inputTextLCT_TEMPO').val("");
			} else {
				$('#inputTextLCT_HORAINICIO').removeClass('is-invalid');
				$('#inputTextLCT_HORAFIM').removeClass('is-invalid');

				var LCT_TEMPO = (new Date("1970-1-1 " + $('#inputTextLCT_HORAFIM').val()) - new Date("1970-1-1 " + $('#inputTextLCT_HORAINICIO').val())) / 1000 / 60 / 60;
				if (!isNaN(LCT_TEMPO)) {
					$('#inputTextLCT_TEMPO').val(LCT_TEMPO.toFixed(2));
				}
			}
		}
	});


// 	$('#inputTextLCT_DATA').change(function () {
// 		if ($(this).val().length == 10) {
// 			$(this).removeClass('is-invalid');
// 		} else {
// 			$(this).addClass('is-invalid');
// 		}
// 	});

	$('#textareaLCT_DESCRICAO').change(function () {
		if ($(this).val().length >= 1) {
			$(this).removeClass('is-invalid');
		} else {
			$(this).addClass('is-invalid');
		}
	});

	$('#inputTextLCT_HORAFIM').change(function () {
		$('#spanHoraFinalError').text('Hora incorreta.');
		if ($(this).val().length < 5) {
			$(this).addClass('is-invalid');
			$('#inputTextLCT_TEMPO').val("");
		} else {
			$(this).removeClass('is-invalid');
			if ($('#inputTextLCT_HORAINICIO').val().length == 5 && $('#inputTextLCT_HORAINICIO').val() >= $(this).val()) {
				$(this).addClass('is-invalid');
				$('#inputTextLCT_TEMPO').val("");
				$('#inputTextLCT_HORAINICIO').addClass('is-invalid');
				$('#spanHoraFinalError').text('Hora final está inferior à hora inicial.');
				$('#spanHoraInicialError').text('Hora inicial está superior à hora final');
			} else {
				$('#inputTextLCT_HORAINICIO').removeClass('is-invalid');
				$('#inputTextLCT_HORAFIM').removeClass('is-invalid');

				var LCT_TEMPO = (new Date("1970-1-1 " + $('#inputTextLCT_HORAFIM').val()) - new Date("1970-1-1 " + $('#inputTextLCT_HORAINICIO').val())) / 1000 / 60 / 60;
				if (!isNaN(LCT_TEMPO)) {
					$('#inputTextLCT_TEMPO').val(LCT_TEMPO.toFixed(2));
				}
			}
		}
	});


	$("#inputTextLCT_HORAINICIO, #inputTextLCT_HORAFIM").mask("Hh:Mm", {
		translation: {
			'H': {
				pattern: /[0-2]/,
				optional: false
			},
			'h': {
				pattern: /[0-9]/,
				optional: false
			},
			'M': {
				pattern: /[0-5]/,
				optional: false
			},
			'm': {
				pattern: /[0-9]/,
				optional: false
			}
		},
		placeholder: "HH:MM"
	});






	var isApontandoHoras = false;

	$('#btnDeletarApontamento').click(function () {
		$('#modalConfirmarRemocaoApontamento').modal('show');
	});

	$('#btnSalvarApontamento').click(function () {

		if (isApontandoHoras == true) {
			return;
		}

		isApontandoHoras = true;

		var LCT_DATA = $('#inputTextLCT_DATA').val().split("/").reverse().join("-");
		var LCT_CODIGO = $('#inputTextLCT_CODIGOO').val();
		var LCT_HORAINICIO = $('#inputTextLCT_HORAINICIO').val();
		var LCT_HORAFIM = $('#inputTextLCT_HORAFIM').val();
		var LCT_CODCHAMADO = $('#inputTextLCT_CODCHAMADO').val();
		var LCT_TEMPO = $('#inputTextLCT_TEMPO').val();
		var LCT_DESCRICAO = $('#textareaLCT_DESCRICAO').val();
		var CBR_CODIGO = <?php echo $this->session->userdata('userCodigo'); ?>;
		var ATG_CODIGO = $('#comboboxAtividadesColaborador').val();

		if (LCT_DATA < 10) {
			$('#inputTextLCT_DATA').addClass('is-invalid');
			return;
		}
		if (LCT_HORAINICIO < 5) {
			$('#inputTextLCT_HORAINICIO').addClass('is-invalid');
			return;
		}
		if (LCT_HORAFIM < 5) {
			$('#inputTextLCT_HORAFIM').addClass('is-invalid');
			return;
		}
		if (LCT_DESCRICAO.length < 1) {
			$('#textareaLCT_DESCRICAO').addClass('is-invalid');
			return;
		}

		$('#divAlertReturn').attr("class", "alert alert-primary");
		$('#divAlertReturn').text("Carregando...");


		$.ajax({
			url: "<?php echo base_url(); ?>consultoria/relatorioApontamentoHoras/updateLancamentoHora",
			type: 'POST',
			data: {
				LCT_CODIGO: LCT_CODIGO,
				LCT_DATA: LCT_DATA,
				LCT_HORAINICIO: LCT_HORAINICIO,
				LCT_HORAFIM: LCT_HORAFIM,
				LCT_CODCHAMADO: LCT_CODCHAMADO,
				LCT_TEMPO: LCT_TEMPO,
				LCT_DESCRICAO: LCT_DESCRICAO,
				ATG_CODIGO: ATG_CODIGO,
				CBR_CODIGO: CBR_CODIGO
			},
			success: function (data) {
				isApontandoHoras = false;
				$('#divAlertReturn').attr("class", "alert alert-success");
				$('#divAlertReturn').text("Salvo!");
				$('#modalDetalhesApontamentoHoras').modal('hide');
				table.ajax.reload();
				fetchTotalHoras(PJT_CODIGO, LCT_DATAINICIAL, LCT_DATAFINAL);
			}
		});

	});



	$.when(fetchAtividadesReferenteColaborador()).done(function (r1) {
		var html = [];
		atividadesArray = r1;
		for (var i = 0; i <= r1.length - 1; i++) {
			html.push('<option value="' + r1[i].ATG_CODIGO + '">' + r1[i].PJT_APELIDO + ' - ' + r1[i].ATG_DESCRICAO + '</option>')
		}
		$('#comboboxAtividadesColaborador').append(html);
		removeSpinner();

	});
	function fetchAtividadesReferenteColaborador() {
		return $.ajax({
			url: "<?php echo base_url(); ?>consultoria/apontarHoras/fetchAtividadesReferenteColaborador",
			type: 'POST',
			data: {AEA_CBRCODIGO: <?php echo $this->session->userdata('userCodigo'); ?>},
			dataType: 'json'
		});
	}
	function setupComboboxAtividadesColaborador() {
		$('#comboboxAtividadesColaborador').editableSelect({
			effects: 'fade'
		}).on('select.editable-select', function (e, li) {
			selectedComboboxAtividade = atividadesArray[li.index()].PJT_APELIDO + ' - ' + atividadesArray[li.index()].ATG_DESCRICAO;
			selectedAtividade = atividadesArray[li.index()];
			ATG_CODIGO = li.val();
			$('#comboboxAtividadesColaborador').removeClass('is-invalid');
		});
	}
</script>