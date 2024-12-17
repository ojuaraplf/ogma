<?php

if (!($this->session->has_userdata('userToken'))) {
    redirect('login');
}
?>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>wD Chamado </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        #tableLista tbody tr {
      cursor: pointer;
    }

    html {
      visibility: hidden;
    }
  </style>

</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navBarChamado') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Chamados - CHD </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"> Home</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-3">
                                        <label for="comboboxGep" class="text-left control-label col-form-label"> Gerente de Projeto </label>
                                        <select class="form-control" id="comboboxGep">
                                            <option value="0"> Todos os gerentes ... </option>

                                            <?php foreach ($listaGep as $item): ?>
                                            <option value="<?= $item['CODIGO']?>" <?= $this->session->userdata('userCodigo') == $item['CODIGO'] ? "selected" : "" ?>>
                                                <?= $item['NOME'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="comboboxPPx" class="text-left control-label col-form-label"> Plano de Serviço (Projeto) </label>
                                        <select class="form-control" id="comboboxPPx">
                                            <option value="0"> Todos os planos de serviço ... </option>

                                            <?php foreach ($listaPjt as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['APELIDO'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="comboboxSol" class="text-left control-label col-form-label"> Solicitante </label>
                                        <select class="form-control" id="comboboxSol">
                                            <option value="0">  Selecione o solicitante ... </option>

                                            <?php foreach ($listaSol as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['NOME'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="optionboxAtivo" class="text-left control-label col-form-label" id="labelPES_TipoFouJ" >Chamados ativos:</label>
                                        <select class="form-control" id="optionboxAtivo">
                                            <option value='0'> Todos </option>
                                            <option value='1'> Apenas inativos </option>
                                            <option value='2' <?php echo "selected" ?> > Apenas ativos </option>
  
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="buttonListar"> Listar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divLista">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                            <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar na lista de Chamados</label>
                                            <input type="text" class="form-control" id="inputTextFiltro"/>
                                        </div>
                                    </div>                                    
                                </div>
                                <br />
                                <div class="table-responsive">         
                                    <table class="table table-hover" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='col01nmro'> Chamado</br>Número</th>
                                                <th id='col02abre'> Interação</br>Data/hora</th>
                                                <th id='col10usua'> Usuário</th>
                                                <th id='col03desc'> Descrição</br>Solicitação</th>
                                                <th id='col04plan'> Plano</br>Projeto</th>
                                                <th id='col05stat'> Status</br>Atual</th>
                                                <th id='col06prio'> <i class="fas fa-hand-lizard"></i>
                                                <th id='col07anex'> <i class="fas fa-paperclip"></i></th>
                                                <th id='col08apro'> <i class="fas fa-hand-holding-usd"></i> </th>
                                                <th id='col09aval'> <i class="fas fa-hand-holding-heart"></i> </th>    
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.50 - 26/10/2021</b><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalNovoChamado') ?>

    <script type="text/javascript">
        removeSpinner();
       
        $('#liServico').addClass('selected');
		$('#liServicoChamado').addClass('active');
		$('#ulServico').addClass('in');

        $('#divLista').hide();

        var arrayLista = [];
        var table = $('#tableLista').DataTable();
        var selectedPjt = null;
        var selectedPjf = null;
        var selectedGep = null;
        var selectedSol = null;
        var optionboxAtivo = null;

        showTabela();

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAlertaPjt = 'Selecione o plano de serviço.';
        var vAlertaPjf = 'Selecione a fase do plano de serviço.';
        var vAlertaGep = 'Selecione o gerente do projeto / plano de operação.';
        var vAlertaSol = 'Selecione o solicitante.';
        var vAlertaAtivo = 'Selecione para listar chamados ativos, inativos ou todos.';
        var vAlertaAbre = 'Data e hora da abertura ou última interação do chamado.';
        var vAlertaUsua = 'Usuário.\nUsuário do Sirius que fez a interação/abertura no chamado.';
        var vAlertaDesc = 'Descrição.\nDescrição da solicitação do chamado.';
        var vAlertaPlan = 'PPx.\nApelido do Plano de Serviço / Projeto.';
        var vAlertaStat = 'Status.\nStatus atual do chamado.';
        var vAlertaPrio = 'Prioridade.\nPrioridade / severidade atual do chamado:\n0 = nenhuma,\n1 = baixa,\n2 = normal,\n3 = alta.';
        var vAlertaAnex = 'Com anexo.\nO chamado terá anexo(s) se o mesmo icone estiver na linha.';
        var vAlertaApro = 'Orçamento aprovado.\nO chamado estará aprovado se o mesmo icone estiver na linha.';
        var vAlertaAval = 'Avaliado.\nO chamado estará avaliado se o mesmo icone estiver na linha.';

        
        
        setInputTextHints();

        $('#comboboxGep').change(function() {
            console.log(this.value);
            $.ajax({
                url: "<?php echo base_url(); ?>chamado/ChdLista/fecthPjt/" + this.value,
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    var optionsPjtNome = [];
                    optionsPjtNome.push('<option value="0"> Todos os planos de serviço ... </option>');
                    response.listaPjt.forEach(function(e) {
                        optionsPjtNome.push('<option value="' + e.CODIGO + '"> ' + e.APELIDO + ' </option>')
                    });
                    $('#comboboxPPx').html(optionsPjtNome);
                    console.log(response);
                }
            });
        });

//***********************************************************************/
        $('#comboboxPPx').change(function() {
            console.log(this.value);
            $.ajax({
                url: "<?php echo base_url(); ?>chamado/ChdLista/fecthSol/" + this.value,
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    var optionsSolNome = [];
                    optionsSolNome.push('<option value="0"> Todos os Solicitantes ... </option>');
                    response.listaSol.forEach(function(e) {
                        optionsSolNome.push('<option value="' + e.CODIGO + '"> ' + e.NOME + ' </option>')
                    });
                    $('#comboboxSol').html(optionsSolNome);
                    console.log(response);
                }
            });
            showTabela()
        });

        $('#comboboxSol').change(function() {
            showTabela()
        });

        $('#optionboxAtivo').change(function() {
            showTabela()
        });

        $('#buttonListar').click(function() {
            showTabela()
        });

        // /***************************************************************************************/

        function showTabela() {

            selectedPjt = ($('#comboboxPPx')[0].selectedIndex == 0) ? 0 : $('#comboboxPPx').val();
            selectedPjf = 0;
            selectedGep = ($('#comboboxGep')[0].selectedIndex == 0) ? 0 : $('#comboboxGep').val();
            selectedSol = ($('#comboboxSol')[0].selectedIndex == 0) ? 0 : $('#comboboxSol').val();
            optionboxAtivo = ($('#optionboxAtivo')[0].selectedIndex == 0) ? 0 : $('#optionboxAtivo').val();
            
            loadSpinner();
            $('#tableLista').DataTable().clear().destroy();
            table = $('#tableLista').DataTable({
                // dom: 'Bfrtip',
                dom: '<"html5buttons"B>Tfgitp',
                buttons: [{
                        extend: 'pdf',
                        className: 'btn-primary',
                        exportOptions: {
                        columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-primary'
                    },
                    {
                        extend: 'excel',
                        className: 'btn-primary'
                    }
                ],
                
                destroy: true,
                searching: false,
                autoWidth: false,
                retrieve: true,
                paging: false,
                sAjaxDataProp: "",
                responsive: true,
                info: false,

                ajax: {
                    url: "<?php echo base_url(); ?>chamado/ChdLista/fetchChdLista",
                    type: 'POST',
                    data: {
                        selectedPjt: selectedPjt,
                        selectedPjf: selectedPjf,
                        selectedGep: selectedGep,
                        selectedSol: selectedSol,
                        optionboxAtivo: optionboxAtivo
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                // "scrollX": true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [1, "des"]
                ],
                rowId: 'NUMERO',
                columns: [
                    {
                        "data": "NUMERO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "CHI_ULTIMA",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            var dateSplitted = data.split(" ");
                            var date = dateSplitted[0].split("-").reverse().join("/");
                            var time = dateSplitted[1];
                            var span = '<span style="display: none"> ' + data + '</span>';
                            // var span = '<span> ' + data + '</span>';
                            
                            return span + date + ' ' + time;
                              
                            // return data == 1 ? '<i class="fas fa-paperclip"></i>' : '';
                        }
                        
            
                    },
                    {
                        "data": "CHI_USUARIO",
                        "defaultContent": ""
                        //className: "text-center"
                    },
                    {
                        "data": "DESCRICAO",
                        "defaultContent": ""
                        // className: "text-center"
                    },
                    {
                        "data": "PLANO",
                        "defaultContent": ""
                        // className: "text-center"
                    },
                    {
                        "data": "STATUS",
                        "defaultContent": ""
                        // className: "text-center"
                    },
                    {
                        "data": "PRIORIDADE",
                        "defaultContent": ""
                        // className: "text-center"
                    },
                    {
                        "data": "TEMANEXO",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="fas fa-paperclip"></i>' : '';
                        }
                    },
                    {
                        "data": "TAPROVADO",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="fas fa-hand-holding-usd"></i>' : '';
                        }
                    },
                    {
                        "data": "TAVALIADO",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="fas fa-hand-holding-heart"></i>' : '';
                        }
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                columnDefs: [
                    {
                        "width": "5%",
                        "targets": [0],
                    },
                    {
                        "width": "8%",
                        "targets": [1],
                    },
                    {
                        "width": "13%",
                        "targets": [2],
                    },
                    {
                        "width": "40%",
                        "targets": [3],
                    },
                    {
                        "width": "15%",
                        "targets": [4],
                    },
                    {
                        "width": "15%",
                        "targets": [5],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('color', rowData.ABERTURA!=0 ? 'red' :'black');
                        }
                    },
                    {
                        "width": "1%",
                        "targets": [6],
                    },
                    {
                        "width": "1%",
                        "targets": [7],
                    },
                    {
                        "width": "1%",
                        "targets": [8],
                    },
                    {
                        "width": "1%",
                        "targets": [9],
                    },
                ],

            });
        }

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableLista");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td") ; 
				for(j=0 ; j<td.length ; j++)
				{
				let tdata = td[j] ;
				if (tdata) {
					if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
					break ; 
					} else {
					tr[i].style.display = "none";
					}
				} 
				}
			}
		}

		var $rows = $('#tableLista tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});

        function setInputTextHints() {
            $('#comboboxPPx').prop('title', vAlertaPjt );
            $('#comboboxGep').prop('title', vAlertaGep );
            $('#comboboxSol').prop('title', vAlertaSol );
            $('#optionboxAtivo').prop('title', vAlertaAtivo );

            $('#col02abre').prop('title', vAlertaAbre );
            $('#col10usua').prop('title', vAlertaUsua );
            $('#col03desc').prop('title', vAlertaDesc );
            $('#col04plan').prop('title', vAlertaPlan );
            $('#col05stat').prop('title', vAlertaStat );
            $('#col06prio').prop('title', vAlertaPrio );
            $('#col07anex').prop('title', vAlertaAnex );
            $('#col08apro').prop('title', vAlertaApro );
            $('#col09aval').prop('title', vAlertaAval );   
         

            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

        var selectedChamado = "";
        $(document).on('click', '#tableLista > tbody > tr ', function() {

          selectedChamado = arrayLista[table.row(this).index()];
          window.open('<?php echo base_url('detalheChamado/') ?>' + selectedChamado.NUMERO, '_self');

        });

    </script>
</body>

</html> 