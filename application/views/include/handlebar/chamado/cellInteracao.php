<script id="cellInteracao" type="text/x-handlebars-template">
	{{#each interacoes}}
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-8">
						<h5 class="card-title"><strong>{{CHI_USUNome}}</strong> <small class="text-muted">{{dateUStoBR CHI_MomentoInteracao }}</small></h5>
					</div>
				</div>
				<div class="border-top"></div>
				<br />
				<div class="row">
					<div class="col-12">
						<strong>Status:</strong> <span class="" id=""> {{STC_Descricao}} </span>
					</div>
					<div class="col-12">
						<strong> Categoria: </strong><span class="" id=""> {{CHC_Descricao}} </span>
					</div>
					<div class="col-12">
						<strong> Prioridade: </strong><span class="" id=""> {{CHP_Descricao}} </span>
					</div>
					<div class="col-12">
						<strong> Responsável: </strong><span class="" id=""> {{CHI_CBRNome}} </span>
					</div>
				</div>
				<br />
				<div class="border-top"></div>
				<br />
				<div class="row">
					<div class="col-12">
						<strong> Descrição: </strong> <br /><span class="" id=""> {{CHI_TextoSolicitacao}} </span>
					</div>
				</div>
			</div>
		</div>
	{{/each}}
</script>