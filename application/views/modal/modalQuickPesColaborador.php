<!-- Modal -->
<div class="modal fade" id="modalQuickPesColaborador" tabindex="-1" role="dialog"
		 aria-labelledby="modalQuickPesColaboradorLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modalQuickPesColaboradorLabel"><i class="mdi mdi-account-plus" style="color: #00FF00;"></i> Quick insert de Pessoa </h3>								
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>				
			</div>			
			<div class="modal-body">
				<div class="form-group">
					<div class="row mb-3">
						<div class="col-12 ">
							<label for="inputPES_Nome" class="text-left control-label col-form-label">Nome do Colaborador:</label>
							<input type="text" class="form-control" rows="2" id="inputPES_Nome">
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
				<button type="button" class="btn btn-primary" style="font-size: 20px;" id="buttonEditarCbr" disabled >Editar Colaborador</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	var vCbrCodigo = null;
	// var vCbrUsuLogin : "<!?= $this->session->userdata('userLogin'); ?>";
	var vNovoCbr = 0;
	$(inputPES_ContEmail).val('alterar@alterar.com');
	document.getElementById('inputPES_Nome').focus();

	setInputTextHints();

	$('#buttonSalvarPessoa').click(function () {

		if( $('#inputPES_Nome').val().length <= 5 )
			{
			document.getElementById('inputPES_Nome').focus();
			Swal.fire(
				'Importante!',
				'Informe um nome com mais de cinco caracteres. Tenha certeza de que ela já não exista na lista de Pessoas. Verifique no combo.',
				'warning'
			)			
			return;
		}

		
		$.when( salvarPesNovo() ).done(function(r1) {
			console.log(r1);
			vNovoCbr = r1;
			$.when( InsertCbr(r1) ).done(function(r2) {
				console.log(r1);
				console.log(r2);
				// window.open('<!?php echo base_url('CliEdita/') ?>' + r1, '_self');
				// return
				
				document.getElementById("buttonSalvarPessoa").disabled = true;
				document.getElementById("buttonEditarCbr").disabled = false;
				// $('#modalQuickPesColaboradorLabel'). modal('hide');

			})
		});
		
	});

	function salvarPesNovo() {
		return  $.ajax({
                url: "<?php echo base_url(); ?>administrativo/CbrLista/salvarPesNovo",                
                type: 'POST',
				// dataType: 'text',
                data: {
                    PES_Nome : $('#inputPES_Nome').val(),					
					PES_Apelido : $('#inputPES_Nome').val(),
					PES_TipoFouJ : 'F',
					PES_ContEmail : $('#inputPES_ContEmail').val()
                }								
            });
	}

	function InsertCbr(vCbrCodigo) {
		$.ajax({
                url: "<?php echo base_url(); ?>administrativo/CbrLista/InsertCbrQuick",
                type: 'POST',
                data: {
                    CBR_PESCodigo : vCbrCodigo,
					CBR_USULogin : "<?= $this->session->userdata('userLogin'); ?>"
                }
            });
	}

	$('#buttonEditarCbr').click(function () {
		window.open('<?php echo base_url('CbrEdita/') ?>' + vNovoCbr, '_self');
	});

	$('#buttonFecharModal').click(function () {
		if (vNovoCbr == 0 ) {
			$('#modalQuickPesColaborador').modal('hide');
			return;
		}
		window.open('<?php echo base_url('CbrLista/') ?>', '_self');
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
            
            $('#buttonSalvarPessoa').prop('title', 'Clique para incluir nova pessoa/colaborador.\nTenha certeza de que ela já não exista na lista de pessoas.\nVerifique no combo.');
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

</script>