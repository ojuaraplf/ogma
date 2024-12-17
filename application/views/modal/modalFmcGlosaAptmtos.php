<!-- Modal -->
<div class="modal fade" id="modalFmcGlosaAptmtos" role="dialog"
		 aria-labelledby="modalFmcGlosaMotivoLabel" aria-hidden="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modalFmcGlosaAptmtosLabel"><i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pré-pagamento: Demais Apontamentos </h3>				
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="row mb-3">						
						<div class="col-12">
                            <label for="vSpanAtgDescricao" class="text-left control-label col-form-label" id="lSpanAtgDescricao" >Atividade:</label>
                            <span id="vSpanAtgDescricao" class="form-control font-weight-bold" style="background-color: #DCDCDC;" disabled>-</span>
                        </div>
						<div class="row" id="divListaLcts">
							<div class="col-md-12">
                    			<div class="card">
                        			<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-sm" id="tabDemaisLcts">
												<thead>
													<tr>
														<td id='colModColabor'> COLABORADOR</td>
														<td id='colModLctCodi'> APONTAMENTO</td>
														<td id='colModLctDesc'> DESCRIÇÃO</td>
														<td id='colModLctData'> DATA</td>
														<td id='colModLctTrab'> <i class="mdi mdi-rowing"></i></td>										
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
				<button type="button" class="btn btn-secondary" style="font-size: 20px;" id="buttonFecharAptmtos" >Fechar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#divListaLcts').hide();

	$('#modalFmcGlosaAptmtos').on('show.bs.modal', function() {
						
		$('#vSpanAtgDescricao').text(linhaQueClicouNaTabela["ATG_DESCRICAO"]);
		var vATGCodigo = linhaQueClicouNaTabela["ATG_CODIGO"];
		var vLCTCodigo = linhaQueClicouNaTabela["LCT_CODIGO"];

		console.log('linhaQueClicouNaTabela, vATGCodigo, vLCTCodigo');
		console.log(linhaQueClicouNaTabela); 
		console.log(vATGCodigo);
		console.log(vLCTCodigo);

		$('#tabDemaisLcts').DataTable().clear().destroy();
		table = $('#tabDemaisLcts').DataTable({

			destroy: true,
			searching: false,
			autoWidth: false,
			retrieve: true,
			paging: false,
			sAjaxDataProp: "",
			responsive: true,
			info: false,

			ajax: {
				url: "<?php echo base_url(); ?>financeiro/FmcLista/fetchAptmtosDaAtg",
				type: 'POST',
				data: {
					vATGCodigo: vATGCodigo,
					vLCTCodigo: vLCTCodigo
				},
				complete: function(response) {
					arrayLista = JSON.parse(response.responseText);
					$('#divListaLcts').show();					
				}
			},

			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
			},

			columns: [
				{
					"data": "COLABORADOR",
					"defaultContent": "",
					className: "text-left"
				},
				{
					"data": "LCT_CODIGO",
					"defaultContent": "",
					className: "text-left"
				},
				{
					"data": "LCT_DESCRICAO",
					"defaultContent": "",
					className: "text-left"
				},
				{
					"data": "LCT_DATA",
					"defaultContent": "",
					className: "text-left",
					"render": function(data, type, row) {                            
						return data == null ? "-" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
					}
				},
				{
					"data": "LCT_TEMPO",
					"defaultContent": "",
					className: "text-right"
				}
			],

			columnDefs: [
				{
					"width": "30%",
					"targets": [0]
				},
				{
					"width": "8%",
					"targets": [1]
				},
				{
					"width": "49%",
					"targets": [2]
				},
				{
					"width": "8%",
					"targets": [3]
				},
				{
					"width": "5%",
					"targets": [4]
				},
			]

		});

	});


	$('#buttonFecharAptmtos').click(function () {
		$('#modalFmcGlosaAptmtos').modal('hide');
	});
	
</script>