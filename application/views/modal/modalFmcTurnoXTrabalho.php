<!-- Modal -->
<div class="modal fade" id="modalFmcTurnoXTrabalho" role="dialog" aria-labelledby="modalFmcTurnoXTrabalhoLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalFmcTurnoXTrabalhoLabel">
                    <i class="mdi mdi-clock-end" style="color: #8A2BE2;"></i> Pré-pagamento: Trabalho Extraturno
                </h3>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm" id="tabTurnoTrab">
                        <thead>
                            <tr>
                                <td id='colTabClbr'>COLABORADOR</td>
                                <td id='colTabData'>DATA</td>
                                <td id='colTabTurn'><i class="mdi mdi-av-timer"></i></td>
                                <td id='colTabTrab'><i class="mdi mdi-rowing"></i></td>
                                <td id='colTabOver'><i class="mdi mdi-clock-end" style="color: #8A2BE2;"></i></td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="font-size: 20px;" id="buttonFecharTraTur">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('#divListaTurnoTrabalho').hide();

	$('#modalFmcTurnoXTrabalho').on('show.bs.modal', function() {
		// Defina ou remova comentários relacionados às variáveis comentadas
		// var linhaQueClicouNaTabela = ...;

		var vDataErrada = $('#eOptionMes').val();
        var pData = vDataErrada.substring(3, 7) + '-' + vDataErrada.substring(0, 2) + '-01';
        console.log(pData);
        // var pData = '2024-02-01';
        var pDataLen = 7;
        var pCbr = "";

		$('#tabTurnoTrab').DataTable().clear().destroy();
		var table = $('#tabTurnoTrab').DataTable({
			destroy: true,
			searching: false,
			autoWidth: false,
			retrieve: true,
			paging: false,
			sAjaxDataProp: "",
			responsive: true,
			info: false,
			ajax: {
				url: "<?php echo base_url(); ?>financeiro/FmcLista/fetchTurnoXtrabalhoMes",
				type: 'POST',
				data: {
					pData: pData,
					pDataLen: pDataLen,
					pCbr: pCbr
				},
				complete: function(response) {
					var arrayLista = JSON.parse(response.responseText);
					console.log(pData);
					$('#divListaTurnoTrabalho').show();
				}
			},
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
			},

        	order: [[4, 'asc']],
			columns: [
				{
					"data": "NOME",
					"defaultContent": "",
					className: "text-left"
				},
				{
					"data": "DATA",
					"defaultContent": "",
					className: "text-center",
					"render": function(data, type, row) {
						return data == null ? "-" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7) + "/" + data.substring(0, 4);
					}
				},
				{
					"data": "TURNO",
					"defaultContent": "",
					className: "text-center"
				},
				{
					"data": "TRABALHO",
					"defaultContent": "",
					className: "text-center"
				},
				{
					"data": "SOBREPOSTO",
					"defaultContent": "",
					className: "text-center"
				}
			],
			columnDefs: [
				{
					"width": "68%",
					"targets": [0]
				},
				{
					"width": "8%",
					"targets": [1]
				},
				{
					"width": "8%",
					"targets": [2]
				},
				{
					"width": "8%",
					"targets": [3]
				},
				{
					"width": "8%",
					"targets": [4]
				}				
			],
			createdRow: function(row, data, dataIndex) {
				// Verifica o valor na coluna SOBREPOSTO (índice 4)
				if (data['SOBREPOSTO'] < -0.3000) {
					// Adiciona a classe CSS 'negative-value' para a célula da coluna SOBREPOSTO
					$('td:eq(4)', row).addClass('negative-value');
				}
			}
		});
	});

	$('#buttonFecharTraTur').click(function () {
		$('#modalFmcTurnoXTrabalho').modal('hide');
	});
</script>

<style>
    .negative-value {
        color: red;
    }
</style>

