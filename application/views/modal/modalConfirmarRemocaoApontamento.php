<!-- Modal -->
<div class="modal fade" id="modalConfirmarRemocaoApontamento" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarRemocaoApontamentoLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalConfirmarRemocaoApontamentoLabel">Concluido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Deseja mesmo apagar o apontamento de hora selecionado?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				 <button type="button" class="btn btn-danger" id="btnApagarApontamento"> Apagar </button>
			</div>
		</div>
	</div>
</div>





<script type="text/javascript">



	$('#btnApagarApontamento').click(function () {

		$.ajax({
			url: "<?php echo base_url(); ?>consultoria/relatorioApontamentoHoras/removerLancamentoHora",
			type: 'POST',
			data: {
				LCT_CODIGO: selectedApontamento.LCT_CODIGO

			},
			success: function (data) {

				console.log("Deu CERTO!!");
				isApontandoHoras = false;
				// $('#divAlertReturn').attr("class", "alert alert-success");
				// $('#divAlertReturn').text("Salvo!");
				$('#modalConfirmarRemocaoApontamento').modal('hide');
				$('#modalDetalhesApontamentoHoras').modal('hide');
				table.ajax.reload();
				fetchTotalHoras(PJT_CODIGO, LCT_DATAINICIAL, LCT_DATAFINAL);
			}
		});


	});





	</script>
