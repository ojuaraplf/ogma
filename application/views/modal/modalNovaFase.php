<!-- Modal -->
<div class="modal fade" id="modalNovaFase" tabindex="-1" role="dialog" aria-labelledby="modalNovaFaseLabel"
		 aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalNovaFaseLabel"> Nova Fase </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="inputTextPJF_IDENTIFICACAOFASE" class="col-form-label"> Nome da Fase: </label>
					<textarea class="form-control" rows="2" id="inputTextPJF_IDENTIFICACAOFASE"></textarea>
				</div>

				<div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="btnNovaFase">Nova Fase</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	fetchNumberFasesFromProject();
	var numberNewFase = 0;

	$('#modalNovaFase').on('show.bs.modal', function () {
		if (lastFaseDate == null || lastFaseDate == "0000-00-00") {
			$('#divAlertReturn').attr("class", "alert alert-danger");
			$('#divAlertReturn').text("Necessário preencher a data término da fase anterior para iniciar uma nova fase.");

			$('#btnNovaFase').prop('disabled', true);
			$('#btnNovaFase').hover(function () {
				$(this).css("cursor", "no-drop");
			});

		}
	})


	$('#modalNovaFase').on('hidden.bs.modal', function (e) {
		$('#divAlertReturn').attr("class", "alert alert-light");
		$('#divAlertReturn').html("&nbsp;");
	});


	$('#btnNovaFase').click(function () {

		$('#divAlertReturn').attr("class", "alert alert-primary");
		$('#divAlertReturn').text("Carregando...");


		var PJF_IDENTIFICACAOFASE = $('#inputTextPJF_IDENTIFICACAOFASE').val();
		if (PJF_IDENTIFICACAOFASE == "") {
			$('#divAlertReturn').attr("class", "alert alert-danger");
			$('#divAlertReturn').text("Necessário preencher todos os campos um novo projeto!");
			return;
		}

		$.ajax({
			url: "<?php echo base_url(); ?>detalheProjeto/newFase",
			type: 'POST',
			data: {
				PJT_CODIGO: <?php echo $this->uri->segment(2); ?>,
				PJF_IDENTIFICACAOFASE: PJF_IDENTIFICACAOFASE,
				PJF_DATAINICIO: lastFaseDate.split("/").reverse().join("-"),
				PJF_ORDEMFASE: numberNewFase
			},
			success: function (data) {
				$('#divAlertReturn').attr("class", "alert alert-success");
				$('#divAlertReturn').text("Salvo!");
				console.log(data);
				window.open('<?php echo base_url('editarFase/'); ?>' + <?php echo $this->uri->segment(2); ?> +'/' + data, '_self');

			},
			error: function (jqXHR, exception) {
				console.log(jqXHR);
				console.log(exception);

			}
		});
	});

	function insertTemplateRiscos(PJF_CODIGO) {
		$.ajax({
			url: "<?php echo base_url(); ?>detalheProjeto/insertTemplateRiscos",
			type: 'POST',
			data: {
				PJF_CODIGO: PJF_CODIGO
			},
			success: function (data) {
				window.open('<?php echo base_url('editarFase/'); ?>' + <?php echo $this->uri->segment(2); ?> +'/' + PJF_CODIGO, '_self');
			}
		});

	}

	function fetchNumberFasesFromProject() {
		$.ajax({
			url: "<?php echo base_url(); ?>detalheProjeto/fetchNumberFasesFromProject",
			type: 'POST',
			data: {PJT_CODIGO: <?php echo $this->uri->segment(2); ?>},
			success: function (data) {
				numberNewFase = parseInt(data) + 1;
			}
		});
	}

</script>

