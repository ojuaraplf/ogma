<!-- Modal -->
<div class="modal fade" id="modalRiscoDetalhes" tabindex="-1" role="dialog" aria-labelledby="modalRiscoDetalhesLabel" aria-hidden="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalRiscoDetalhesLabel"> Detalhe Risco </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">


					<div class="row mb-3">

						<div class="col-12 ">
							<label for="textareaPFR_DescricaoRisco" class="text-left control-label col-form-label">Risco:</label>
							<textarea class="form-control" rows="2" id="textareaPFR_DescricaoRisco" disabled></textarea>
						</div>
					</div>


					<div class="row mb-3">

						<div class="col-12 ">
							<label for="textAreaPFR_MedidaMitigacao" class="text-left control-label col-form-label"> Medida Mitigação: </label>
							<textarea class="form-control" rows="5" id="textAreaPFR_MedidaMitigacao"></textarea>
						</div>


					</div>


				</div>
				<div class="alert alert-light" role="alert" id="divAlertReturnDetalheRisco"> &nbsp;</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="btnSalvarDetalhesRisco">Salvar</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	// textareaPFR_DescricaoRisco
	// textAreaPFR_MedidaMitigacao
	// modalRiscoDetalhes

	$('#modalRiscoDetalhes').on('hidden.bs.modal', function(e) {
		$('#textareaPFR_DescricaoRisco').val("");
		$('#textAreaPFR_MedidaMitigacao').val("");
		$('#divAlertReturnDetalheRisco').attr("class", "alert alert-light");
		$('#divAlertReturnDetalheRisco').html("&nbsp;");

	});


	$('#btnSalvarDetalhesRisco').click(function() {

		$('#divAlertReturnDetalheRisco').attr("class", "alert alert-primary");
		$('#divAlertReturnDetalheRisco').text("Carregando...");

		var PFR_MedidaMitigacao = $('#textAreaPFR_MedidaMitigacao').val();
		console.log(selectedRisco);

		arrayRiscos[getArrayIndexForKey(arrayRiscos, "PFR_Codigo", selectedRisco.PFR_Codigo)].PFR_MedidaMitigacao = PFR_MedidaMitigacao;

		$.ajax({
			url: "<?php echo base_url(); ?>editarFase/updateRiscoDetalhes",
			type: 'POST',
			data: {
				PFR_Codigo: selectedRisco.PFR_Codigo,
				PFR_MedidaMitigacao: PFR_MedidaMitigacao
			},
			success: function(data) {

				$('#divAlertReturnDetalheRisco').attr("class", "alert alert-success");
				$('#divAlertReturnDetalheRisco').text("Salvo!");
				$('#modalRiscoDetalhes').modal('hide');
				//console.log(data);
				//window.open('<?php //echo base_url('editarFase/'); 
								?>//' + <?php //echo $this->uri->segment(2); 
																				?>// + '/' + data, '_self');

			}
		});
	});




	$('#btnSalvarDescricaoAtividade').click(function() {

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
			success: function(data) {

				// console.log(data)
				$('#divAlertReturn').attr("class", "alert alert-success");
				$('#divAlertReturn').text("Salvo!");
				$('#modalApontarHorasDescricaoAtividade').modal('hide');
				//console.log(data);
				//window.open('<?php //echo base_url('editarFase/'); 
								?>//' + <?php //echo $this->uri->segment(2); 
																				?>// + '/' + data, '_self');

			}
		});
	});
</script>