<!-- Modal -->
<div class="modal fade" id="modalEsforcoPERT" tabindex="-1" role="dialog" aria-labelledby="modalEsforcoPERTLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalEsforcoPERTLabel"> PERT </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">





					<div class="row mb-3">
						<div class="col-4">
							<label for="inputTextPessimista" class="text-left control-label col-form-label">Pessimista:</label>
							<input type="number" class="form-control" id="inputTextPessimista" />
							<div class="invalid-feedback">
								<span id=""> Campo em branco! </span>
							</div>
						</div>
						<div class="col-4">
							<label for="inputTextProvavel" class="text-left control-label col-form-label">Mais provável:</label>
							<input type="number" class="form-control" id="inputTextProvavel" />
							<div class="invalid-feedback">
								<span id=""> Campo em branco! </span>
							</div>
						</div>
						<div class="col-4">
							<label for="inputTextOtimista" class="text-left control-label col-form-label">Otimista:</label>
							<input type="number" class="form-control" id="inputTextOtimista" />
							<div class="invalid-feedback">
								<span id=""> Campo em branco! </span>
							</div>
						</div>
					</div>


					<div class="row mb-3">
						<div class="col-12 text-center">
							<button type="button" class="btn btn-primary" id="btnCalcularMedia"> &nbsp;&nbsp;&nbsp;&nbsp; Calcular média &nbsp;&nbsp;&nbsp;&nbsp;</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<label for="inputTextResultadoPert" class="text-left control-label col-form-label">Resultado:</label>
							<input type="text" class="form-control" id="inputTextResultadoPert" disabled />
							<div class="invalid-feedback">
								<span id=""> Não foi feito o cálculo! </span>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="btnUsarPERT">Usar PERT</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('#modalEsforcoPERT').on('hide.bs.modal', function() {
		$('#inputTextPessimista').val('');
		$('#inputTextProvavel').val('');
		$('#inputTextOtimista').val('');
		$('#inputTextResultadoPert').val('');
	});






	$('#btnUsarPERT').click(function() {
		$('#inputTextResultadoPert').removeClass('is-invalid');

		if ($('#inputTextResultadoPert').val() == "") {
			$('#inputTextResultadoPert').addClass('is-invalid');
		} else {
			$('#inputTextPJT_QTHORA').val($('#inputTextResultadoPert').val());
			$('#modalEsforcoPERT').modal('hide');



			fetchDataFinal();
		}

		



	});


	$('#btnCalcularMedia').click(function() {


		$('#inputTextPessimista').removeClass('is-invalid');
		$('#inputTextProvavel').removeClass('is-invalid');
		$('#inputTextOtimista').removeClass('is-invalid');
		$('#inputTextResultadoPert').removeClass('is-invalid');

		if ($('#inputTextPessimista').val() == "") {
			$('#inputTextPessimista').addClass('is-invalid');
		}

		if ($('#inputTextProvavel').val() == "") {
			$('#inputTextProvavel').addClass('is-invalid');
		}

		if ($('#inputTextOtimista').val() == "") {
			$('#inputTextOtimista').addClass('is-invalid');
		}

		if ($('#inputTextPessimista').val() != "" && $('#inputTextProvavel').val() != "" && $('#inputTextOtimista').val() != "") {
			var resultPERT = (parseInt($('#inputTextPessimista').val()) + (4 * parseInt($('#inputTextProvavel').val())) + parseInt($('#inputTextOtimista').val())) / 6;
			$('#inputTextResultadoPert').val(Math.round(resultPERT));


		}



	});
</script>