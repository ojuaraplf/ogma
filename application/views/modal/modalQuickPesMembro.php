<!-- Modal -->
<div class="modal fade" id="modalQuickPesMembro" tabindex="-1" role="dialog"
		 aria-labelledby="modalQuickPesMembroLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modalQuickPesMembroLabel"><i class="mdi mdi-account-plus" style="color: #00FF00;"></i> Quick insert de Pessoa </h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="row mb-2">
						<div class="col-2">
							<label for="inputCLI_Codigo" class="text-left control-label col-form-label">Código:</label>
							<input type="text" class="form-control" disabled value="<?= $CliEdita->CLI_PESCodigo ?>" rows="2" id="inputCLI_Codigo">
						</div>
						<div class="col-10 ">
							<label for="inputCLI_Nome" class="text-left control-label col-form-label">Nome do Cliente:</label>
							<input type="text" class="form-control" disabled value="<?php echo $CliEdita->PES_Nome; ?>" rows="2" id="inputCLI_Nome">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12 ">
							<label for="inputPesNovaNome" class="text-left control-label col-form-label">Nome do Membro do Cliente:</label>
							<input type="text" class="form-control" rows="2" id="inputPesNovaNome">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<label for="inputPES_ContEmail" class="text-left control-label col-form-label">E-mail:</label>
							<input type="email" class="form-control" id="inputPES_ContEmail">
						</div>
					</div>					
				</div>
				<div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-secondary" style="font-size: 20px;" data-dismiss="modal">Fechar</button> -->
				<button type="button" class="btn btn-secondary" style="font-size: 20px;" id="buttonFecharModal" >Fechar</button>
				<button type="button" class="btn btn-primary" style="font-size: 20px; color: #FFD700; background-color: #000000;" id="buttonSalvarPessoa"> <i class="mdi mdi-content-save"></i> </button>				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	var vCliCodigo = null;
	var vPesCliCodigo = null;
	$(inputPES_ContEmail).val('alterar@alterar.com');

	setInputTextHints();	

	$('#buttonSalvarPessoa').click(function () {

		if( $('#inputPesNovaNome').val().length <= 5 )
			{
			document.getElementById('inputPesNovaNome').focus();
			Swal.fire(
				'Importante!',
				'Informe um nome com mais de cinco caracteres. Tenha certeza de que ela já não exista na lista de clientes. Verifique no combo.',
				'warning'
			)		
			return;
		}

		
		$.when( salvarPesNovo() ).done(function(r1) {			
			vCliCodigo = $("#inputCLI_Codigo").val();
			vPesCliCodigo = r1;
			console.log(vCliCodigo);
			console.log(vPesCliCodigo);
			$.when( salvarClpNovo(vCliCodigo, vPesCliCodigo) ).done(function(r2) {
			
				document.getElementById("buttonSalvarPessoa").disabled = true;
				// setTimeout(() => {  $('#modalQuickPesMembro').modal('hide'); }, 10000);
				// setTimeout(() => {  location.reload(); }, 3000);				
				location.reload();
				// location.reload();


			})
		});
		
	});

	function salvarPesNovo() {
		return $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/salvarPesNovo",                
                type: 'POST',
				// dataType: 'text',
                data: {
                    PES_Nome : $('#inputPesNovaNome').val(),					
					PES_Apelido : $('#inputPesNovaNome').val(),
					PES_TipoFouJ : 'F',
					PES_ContEmail : $('#inputPES_ContEmail').val()
                }								
            });
	}

	function salvarClpNovo(vCliCodigo, vPesCliCodigo) {
		return $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/salvarClpNovo",
                type: 'POST',
                data: {
					CLP_CLICodigo : vCliCodigo,
                    CLP_PESCodigo :	vPesCliCodigo 		
                }
            });
	}

	$('#buttonFecharModal').click(function () {
		$('#modalQuickPesMembro').modal('hide');
	});
	

	function MomentoAgora() {
		// Montando o momento atual
		var today = new Date();
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();
		var hh = String(today.getHours()).padStart(2, '0');
		var mn = String(today.getMinutes()).padStart(2, '0');
		var ss = String(today.getSeconds()).padStart(2, '0');
		console.log(hh);
		today = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + mn + ':' + ss;
		console.log(today);
		return today
	}

	function setInputTextHints() {
            
            $('#buttonSalvarPessoa').prop('title', 'Clique para incluir nova pessoa/membro.\nTenha certeza de que ela já não exista na lista de pessoas.\nVerifique no combo.');
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

</script>