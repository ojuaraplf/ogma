<!-- Modal -->
<div class="modal fade" id="modalFmgGlosasDoColaborador" role="dialog"
		 aria-labelledby="modalFmgGlosasDoColaboradorLabel" aria-hidden="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modalFmgGlosasDoColaboradorLabel"><i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pré-pagamento: Glosas do Colaborador </h3>				
			</div>
			<div class="modal-body">
				<div class="form-group">
				
					<div class="row mb-3">
						<div class="col-md-10">
							<label for="vSpanCbrNome" class="text-left control-label col-form-label" id="lSpanCbrNome" >Colaborador:</label>
                            <span id="vSpanCbrNome" class="form-control font-weight-bold" style="background-color: #DCDCDC;" disabled>-</span>
						</div>
						<div class="col-md-2">
							<label for="vSpanMesCorrente" class="text-left control-label col-form-label" id="lSpanMesCorrente" >Mês:</label>
                            <span id="vSpanMesCorrente" class="form-control font-weight-bold" style="background-color: #DCDCDC;" disabled>-</span>
						</div>
						<div class="row" id="divListaGlosas">
						<div class="col-md-12">
                    			<div class="card">
                        			<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-sm" id="tabGlosasApontamento">
												<thead>
													<tr>
														<td id='colModColabor'> GLOSADOR</td>
														<td id='colModColabor'> APONTADO</br>(h)</td>
														<td id='colModLctCodi'> GLOSADO</br>(h)</td>
														<td id='colModLctDesc'> MOTIVO</td>														
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
			<div class="modal-footer">				
				<button type="button" class="btn btn-secondary" style="font-size: 20px;" id="buttonFecharDetalhesApontamentos" >Fechar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#divListaGlosas').hide();

	$('#modalFmgGlosasDoColaborador').on('show.bs.modal', function() {
						
		// $('#vSpanCbrNome').text(linhaQueClicouNaTabela["ATG_DESCRICAO"])
		
		$('#vSpanCbrNome').text(ArrayLinhaTabFmcVisualDet.find(linha => linha.FMC_CBRCodigo == vCBRCodigoDaLinha )["CBR_NOME"]);
		$('#vSpanMesCorrente').text(vData1.substring(5, 7) + "/" + vData1.substring(0, 4));

		$('#tabGlosasApontamento').DataTable().clear().destroy();
		table = $('#tabGlosasApontamento').DataTable({

			destroy: true,
			searching: false,
			autoWidth: false,
			retrieve: true,
			paging: false,
			sAjaxDataProp: "",
			responsive: true,
			info: false,

			ajax: {
				url: "<?php echo base_url(); ?>financeiro/FmcLista/fetchGlosasColaboradorMes",
				type: 'POST',
				data: {					
					pCBRCodigo: vCBRCodigoDaLinha,
					pMes: vData1

				},
				complete: function(response) {
					arrayLista = JSON.parse(response.responseText);
					$('#divListaGlosas').show();					
				}
			},

			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
			},

			columns: [
				{
					"data": "GLOSADOR",
					"defaultContent": "",
					className: "text-left"
				},
				{
					"data": "HORAS_APONTADAS",
					"defaultContent": "",
					className: "text-left"
				},
				{
					"data": "HORAS_GLOSADAS",
					"defaultContent": "",
					className: "text-left"
				},
				{
					"data": "MOTIVO_DA_GLOSA",
					"defaultContent": "",
					className: "text-left"
				}
			],

			columnDefs: [
				{
					"width": "30%",
					"targets": [0]
				},
				{
					"width": "6%",
					"targets": [1]
				},
				{
					"width": "6%",
					"targets": [2]
				},
				{
					"width": "58%",
					"targets": [3]
				}
			]

		});

	});


	$('#buttonFecharDetalhesApontamentos').click(function () {
		$('#modalFmgGlosasDoColaborador').modal('hide');
	});
	
</script>