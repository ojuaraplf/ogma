<!-- Modal -->
<div class="modal fade" id="modalFmcGlosaMotivo" tabindex="-1" role="dialog"
		 aria-labelledby="modalFmcGlosaMotivoLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modalFmcGlosaMotivo"><i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pré-pagamento: Motivo da Glosa </h3>				
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="row mb-3">
					<div class="col-12">
                            <label for="vViewLctDescricao" class="text-left control-label col-form-label" id="lViewLctDescricao"> Descrição do Apontamento: </label>
                            <textarea type="text" disabled class="form-control" rows="3" id="vViewLctDescricao"></textarea>
                        </div>
						<div class="col-12 ">
							<label for="vViewMotivoGlosa" id="lInputFMG_GlosaMotivo" class="text-left control-label col-form-label">Descrição do motivo da glosa:</label>							
							<textarea type="text" class="form-control" rows="9" id="vViewMotivoGlosa"></textarea>
						</div>
					</div>										
				</div>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" style="font-size: 20px; color: #2E8B57; background-color: #FFFFFF;" id="buttonConfirmarMotivo"> <i class="mdi mdi-checkbox-marked-outline"></i> </button>
				<button type="button" class="btn btn-primary" style="font-size: 20px; color: #B22222; background-color: #FFFFFF;" id="buttonFecharMotivo"> <i class="mdi mdi-exit-to-app"></i> </button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#modalFmcGlosaMotivo').on('show.bs.modal', function() {

		// console.log('console.log(linhaQueClicouNaTabela)');
		// console.log(linhaQueClicouNaTabela);

		
		$('#vViewLctDescricao').val(linhaQueClicouNaTabela["LCT_DESCRICAO"].replace('<br />', '\n'));
		$('#vViewMotivoGlosa').val(linhaQueClicouNaTabela["FMG_GlosaMotivo"]);
		$('#vViewMotivoGlosa').focus();		

		$('#buttonConfirmarMotivo').click(function () {
			linhaQueClicouNaTabela["FMG_GlosaMotivo"]=$('#vViewMotivoGlosa').val();
			var index = arrayFmcGloMotivo.findIndex(linha => linha.LinhaId == linhaQueClicouNaTabela["LinhaId"]);
			arrayFmcGloMotivo[index]=linhaQueClicouNaTabela;
			console.log(index);
			console.log(linhaQueClicouNaTabela);
			$('#modalFmcGlosaMotivo').modal('hide');
		});

		$('#buttonFecharMotivo').click(function () {
			$('#vViewMotivoGlosa').val("");
			$('#modalFmcGlosaMotivo').modal('hide');
		});
		
	});
	

</script>