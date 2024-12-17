<!-- Modal -->
<div class="modal fade" id="modalQuickPesCliente" tabindex="-1" role="dialog"
		 aria-labelledby="modalQuickPesClienteLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modalQuickPesClienteLabel"><i class="mdi mdi-account-plus" style="color: #00FF00;"></i> Quick insert de Pessoa </h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="row mb-3">
						<div class="col-12 ">
							<label for="inputPES_Nome" class="text-left control-label col-form-label">Nome do Cliente:</label>
							<input type="text" class="form-control" rows="2" id="inputPES_Nome">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<label for="selectPES_TipoFouJ" class="text-left control-label col-form-label">Personalidade:</label>
							<select class="form-control" id="selectPES_TipoFouJ">
								<option value="J"> Pessoa jurídica</option>
								<option value="F"> Pessoa física</option>							
							</select>
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
				<button type="button" class="btn btn-primary" style="font-size: 20px;" id="buttonEditarCliente" disabled >Editar Cliente</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	var vCliCodigo = null;	
	var vNovoCli = 0;
	$(inputPES_ContEmail).val('alterar@alterar.com');

	setInputTextHints();

	$('#buttonSalvarPessoa').click(function () {

		if( $('#inputPES_Nome').val().length <= 5 )
			{
			document.getElementById('inputPES_Nome').focus();
			Swal.fire(
				'Importante!',
				'Informe um nome com mais de cinco caracteres. Tenha certeza de que ela já não exista na lista de clientes. Verifique no combo.',
				'warning'
			)			
			return;
		}

		
		$.when( salvarPesNovo() ).done(function(r1) {
			console.log(r1);
			vNovoCli = r1;
			$.when( salvarCliNovo(r1) ).done(function(r2) {
				console.log(r1);
				console.log(r2);
				// window.open('<!?php echo base_url('CliEdita/') ?>' + r1, '_self');
				// return
				
				document.getElementById("buttonSalvarPessoa").disabled = true;
				document.getElementById("buttonEditarCliente").disabled = false;
				// $('#modalQuickPesClienteLabel'). modal('hide');


			})
		});
		
	});

	function salvarPesNovo() {
		return  $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/salvarPesNovo",                
                type: 'POST',
				// dataType: 'text',
                data: {
                    PES_Nome : $('#inputPES_Nome').val(),					
					PES_Apelido : $('#inputPES_Nome').val(),
					PES_TipoFouJ : $('#selectPES_TipoFouJ').val(),
					PES_ContEmail : $('#inputPES_ContEmail').val()
                }								
            });
	}

	function salvarCliNovo(vCliCodigo) {
		$.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/salvarCliNovo",
                type: 'POST',
                data: {
                    CLI_PESCodigo : vCliCodigo				
                }
            });
	}

	$('#buttonEditarCliente').click(function () {
		window.open('<?php echo base_url('CliEdita/') ?>' + vNovoCli, '_self');
	});

	$('#buttonFecharModal').click(function () {
		if (vNovoCli == 0 ) {
			$('#modalQuickPesCliente').modal('hide');
			return;
		}
		window.open('<?php echo base_url('CliLista/') ?>', '_self');
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
            
            $('#buttonSalvarPessoa').prop('title', 'Clique para incluir nova pessoa/cliente.\nTenha certeza de que ela já não exista na lista de clientes.\nVerifique no combo.');
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

</script>