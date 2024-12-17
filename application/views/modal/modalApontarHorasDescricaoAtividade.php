<!-- Modal -->
<div class="modal fade" id="modalApontarHorasDescricaoAtividade" tabindex="-1" role="dialog"
		 aria-labelledby="modalApontarHorasDescricaoAtividadeLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalApontarHorasDescricaoAtividadeLabel"> Descrição da Atividade </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">


					<div class="row mb-3">

						<div class="col-12 ">
							<label for="textareaATG_DESCRICAO" class="text-left control-label col-form-label">Atividade:</label>
							<textarea class="form-control" rows="2" id="textareaATG_DESCRICAO" disabled></textarea>
						</div>
					</div>


<!--					<div class="row mb-3">-->
<!---->
<!--						<div class="col-12 ">-->
<!--							<label for="inputTextATG_PORCENTAGEMAPRONTADA" class="text-left control-label col-form-label"> Porcentagem-->
<!--								Aprontada: </label>-->
<!--							<input type="number" class="form-control" id="inputTextATG_PORCENTAGEMAPRONTADA"/>-->
<!--						</div>-->
<!---->
<!---->
<!--					</div>-->


					<div class="row mb-3">

						<div class="col-12 ">
							<label for="textAreaATG_DetalheDescritivo" class="text-left control-label col-form-label"> Descrição da
								Atividade: </label>
							<textarea class="form-control" rows="5" id="textAreaATG_DetalheDescritivo"></textarea>
						</div>


					</div>


				</div>
				<div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="btnSalvarDescricaoAtividade">Salvar</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">


	$('#modalApontarHorasDescricaoAtividade').on('hidden.bs.modal', function (e) {
		$('#textAreaATG_DetalheDescritivo').val("");
		$('#divAlertReturn').attr("class", "alert alert-light");
		$('#divAlertReturn').html("&nbsp;");

	});
	$('#modalApontarHorasDescricaoAtividade').on('show.bs.modal', function () {
		// var porcentagemMinima = selectedAtividade["ATG_PORCENTAGEMAPRONTADA"];

		// console.log(porcentagemMinima);


		// $('#inputTextATG_PORCENTAGEMAPRONTADA').focusout(function() {

		// 	var value = $(this).val();

		// 	if ((value !== '') && (value.indexOf('.') === -1)) {
		// 		$(this).val(Math.max(Math.min(value, 100), selectedAtividade["ATG_PORCENTAGEMAPRONTADA"]));
		// 	}
		// });


	});


	$('#btnSalvarDescricaoAtividade').click(function () {

		$('#divAlertReturn').attr("class", "alert alert-primary");
		$('#divAlertReturn').text("Carregando...");


		var ATG_DetalheDescritivo = $('#textAreaATG_DetalheDescritivo').val();
		// var ATG_PORCENTAGEMAPRONTADA = $('#inputTextATG_PORCENTAGEMAPRONTADA').val();


		atividadesArray[getArrayIndexForKey(atividadesArray, "ATG_CODIGO", ATG_CODIGO)].ATG_DetalheDescritivo = $('#textAreaATG_DetalheDescritivo').val();
		// atividadesArray[getArrayIndexForKey(atividadesArray, "ATG_CODIGO", ATG_CODIGO)].ATG_PORCENTAGEMAPRONTADA = $('#inputTextATG_PORCENTAGEMAPRONTADA').val();
		$.ajax({
			url: "<?php echo base_url(); ?>consultoria/apontarHoras/updateDetalhesAtividade",
			type: 'POST',
			data: {
				ATG_CODIGO: ATG_CODIGO,
				// ATG_PORCENTAGEMAPRONTADA: ATG_PORCENTAGEMAPRONTADA,
				ATG_DetalheDescritivo: ATG_DetalheDescritivo
			},
			success: function (data) {

				// console.log(data)
				$('#divAlertReturn').attr("class", "alert alert-success");
				$('#divAlertReturn').text("Salvo!");
				$('#modalApontarHorasDescricaoAtividade').modal('hide');
				//console.log(data);
				//window.open('<?php //echo base_url('editarFase/'); ?>//' + <?php //echo $this->uri->segment(2); ?>// + '/' + data, '_self');

			}
		});
	});


	//
	//	fetchNumberFasesFromProject();
	//	var numberNewFase = 0;
	//
	//	$('#modalNovaFase').on('show.bs.modal', function () {
	//		if (lastFaseDate == null || lastFaseDate == "0000-00-00") {
	//			$('#divAlertReturn').attr("class", "alert alert-danger");
	//			$('#divAlertReturn').text("Necessário preencher a data término da fase anterior para iniciar uma nova fase.");
	//
	//			$('#btnNovaFase').prop('disabled', true);
	//			$('#btnNovaFase').hover(function(){
	//				$(this).css("cursor", "no-drop");
	//			});
	//
	//		}
	//	})
	//
	//
	//
	//
	//	$('#modalNovaFase').on('hidden.bs.modal', function (e) {
	//		$('#divAlertReturn').attr("class", "alert alert-light");
	//		$('#divAlertReturn').html("&nbsp;");
	//	});
	//
	//
	//	$('#btnNovaFase').click(function() {
	//		$('#divAlertReturn').attr("class", "alert alert-primary");
	//		$('#divAlertReturn').text("Carregando...");
	//
	//		var PJF_IDENTIFICACAOFASE = $('#inputTextPJF_IDENTIFICACAOFASE').val();
	//		if (PJF_IDENTIFICACAOFASE == "") {
	//			$('#divAlertReturn').attr("class", "alert alert-danger");
	//			$('#divAlertReturn').text("Necessário preencher todos os campos um novo projeto!");
	//			return;
	//		}
	//
	//		$.ajax({
	//			url: "<?php //echo base_url(); ?>//detalheProjeto/newFase",
	//			type: 'POST',
	//			data: {
	//				PJT_CODIGO: <?php //echo $this->uri->segment(2); ?>//,
	//				PJF_IDENTIFICACAOFASE: PJF_IDENTIFICACAOFASE,
	//				PJF_DATAINICIO: lastFaseDate.split("/").reverse().join("-"),
	//				// PJF_DATATERMINO: $('#spanPJT_DATATERMINO').text().split("/").reverse().join("-"),
	//				PJF_ORDEMFASE: numberNewFase
	//			},
	//			success: function(data) {
	//				$('#divAlertReturn').attr("class", "alert alert-success");
	//				$('#divAlertReturn').text("Salvo!");
	//				console.log(data);
	//				window.open('<?php //echo base_url('editarFase/'); ?>//' + <?php //echo $this->uri->segment(2); ?>// + '/' + data, '_self');
	//
	//			}
	//		});
	//	});
	//
	//	function fetchNumberFasesFromProject() {
	//		$.ajax({
	//			url: "<?php //echo base_url(); ?>//detalheProjeto/fetchNumberFasesFromProject",
	//			type: 'POST',
	//			data: {PJT_CODIGO: <?php //echo $this->uri->segment(2); ?>//},
	//			success: function(data) {
	//				console.log('HEHEHEHEHEHEHEHEHEHEHEHEHE');
	//				console.log(data);
	//				numberNewFase = parseInt(data) + 1;
	//				console.log('HEHEHEHEHEHEHEHEHEHEHEHEHE');
	//				// removeSpinner();
	//			}
	//		});
	//	}


</script>

