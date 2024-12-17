
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-6">
				<label>Identificação da fase </label>
				<input type="text" class="form-control" id="inputFasePJF_IDENTIFICACAOFASE" />
			</div>
			<div class="col-2">
				<label>Data início </label>
				<input type="text" class="form-control" id="inputFasePJF_DATAINICIO" />
			</div>
			<div class="col-2">
				<label>Data término </label>
				<input type="text" class="form-control" id="inputFasePJF_DATATERMINO" />
			</div>
			<div class="col-2">
				<label>QtHora </label>
				<input type="text" class="form-control" id="inputFasePJF_QTHORA" />
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<label>Recursos materiais da fase do projeto </label>
				<input type="text" class="form-control" id="inputFasePJF_RECURSOSMATERIAIS" />
			</div>
		</div>
	</div>
</div>
<br />

<h4> Equipe do projeto (fase)</h4>
<br />
<table id="tableEquipeDoProjeto" class="table table-bordered">
	<thead>
		<tr>
			<th style="width: 48%;">Nome</th>
			<th style="width: 48%;">Função</th>
			<th style="width: 4%" id="add">  <i class="fas fa-plus-square"></i> </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td contenteditable></td>
			<td contenteditable></td>
			<td id="delete"><i class="fas fa-trash-alt"></i></td>
		</tr>
	</tbody>
</table>

<div class="row">
	<div class="col-6">
		<label>Pessoa focal para a fase </label>
		<input type="text" class="form-control" />
	</div>
	<div class="col-6">
		<label>Função/setor na organização cliente </label>
		<input type="text" class="form-control" />
	</div>
</div>
<br />
<div class="row">
	<div class="col-6">
		<label>Responsável pela homologação da entrega </label>
		<input type="text" class="form-control" />
	</div>
	<div class="col-6">
		<label>Função/setor na organização cliente </label>
		<input type="text" class="form-control" />
	</div>
</div>
<br />
<h4> Elenco de fornecedores de requisitos</h4>
<table id="tableElencoDeFornecedores" class="table table-bordered">
	<thead>
		<tr>
			<th style="width: 4%;">#</th>
			<th style="width: 36%;">Nome</th>
			<th style="width: 20%;">Empresa</th>
			<th style="width: 36%;">Função/setor na Organização </th>
			<th style="width: 4%;" id="addElenco">  <i class="fas fa-plus-square"></i> </th>
  	</tr>
	</thead>
	<tbody>
		<tr>
			<td contenteditable></td>
			<td contenteditable></td>
			<td contenteditable></td>
			<td contenteditable></td>
			<td id="delete"><i class="fas fa-trash-alt"></i></td>
		</tr>
	</tbody>
</table>
<br />
<h4> Dependências e responsáveis</h4>
<table id="tableDependeciaEResponsaveis" class="table table-bordered">
	<thead>
		<tr>
			<th style="width: 43%;">Dependência</th>
			<th style="width: 43%;">Responsável</th>
			<th style="width: 10%;">Data limite</th>
			<th style="width: 4%" id="addDependenciaEResponsaveis">  <i class="fas fa-plus-square"></i> </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td contenteditable></td>
			<td contenteditable></td>
			<td contenteditable></td>
			<td id="delete"><i class="fas fa-trash-alt"></i></td>
		</tr>
	</tbody>
</table>

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<button class="btn btn-primary" id="btnSalvarFase"> SALVAR</button>	
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div id="divAlertReturn"></div>
	</div>
</div>





			    
					<!-- <script type="text/javascript" language="javascript" >
					 $(document).ready(function(){
					  $('#add').click(function(){
					   var html = '<tr>';
					   html += '<td contenteditable></td>';
					   html += '<td contenteditable></td>';
					   html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
					   html += '</tr>';
					   $('#tableEquipeDoProjeto tbody').append(html);
					  });
						$(document).on('click', '#delete', function(){
					    $(this).parent().remove();
					  });
					 });
					</script> -->

				
					
					<!-- <script type="text/javascript" language="javascript" >
					 $(document).ready(function(){
					  $('#addElenco').click(function(){
					   var html = '<tr>';
					   html += '<td contenteditable></td>';
					   html += '<td contenteditable></td>';
					   html += '<td contenteditable></td>';
					   html += '<td contenteditable></td>';
					   html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
					   html += '</tr>';
					   $('#tableElencoDeFornecedores tbody').append(html);
					  });
						$(document).on('click', '#delete', function(){
					    $(this).parent().remove();
					  });
					 });
					</script>
 -->
				 
					<!-- <script type="text/javascript" language="javascript" >
					 $(document).ready(function(){
					  $('#addDependenciaEResponsaveis').click(function(){
					   var html = '<tr>';
					   html += '<td contenteditable></td>';
					   html += '<td contenteditable></td>';
					   html += '<td contenteditable></td>';
					   html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
					   html += '</tr>';
					   $('#tableDependeciaEResponsaveis tbody').append(html);
					  });
						$(document).on('click', '#delete', function(){
					    $(this).parent().remove();
					  });
					 });
					</script> -->
