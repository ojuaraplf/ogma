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
    <title>wD Ogma Apontamentos </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        #tableApontamentos tbody tr {
      cursor: pointer;
    }
    html {
      visibility: hidden;
    }
  </style>
</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navbarHome') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h3 class="page-title"><i class="mdi mdi-library"></i> Apontamentos por período </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"> Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Apontamentos por período</li>
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
                                    <div class="col-2">
                                        <label for="eInputDataDe" class="text-left control-label col-form-label" > De: </label>
                                        <input type="date" style="border-color: #7CFC00;" value="<?php echo date('Y-m-01'); ?>"class="form-control" id="eInputDataDe" />
                                    </div>
                                    <div class="col-2">
                                        <label for="eInputDataAte" class="text-left control-label col-form-label" style = "border-color: #7CFC00;"> Até: </label>
                                        <input type="date" style="border-color: #7CFC00;" value=<?php echo date('Y-m-t'); ?> class="form-control" id="eInputDataAte" />
                                    </div>                                    
                                    <div class="col-4">
                                        <label for="optionCLI" class="text-left control-label col-form-label"> Cliente </label>
                                        <button class="btn btn-primary" style="font-size : 8px; width: 25%; height: 25px; border-color: #1E90FF; color: #000000; background-color: rgba(0, 0, 0, 0.0);" id="buttonRestaurarCombos">Restaurar seleção</button>
                                        <select class="form-control" id="optionCLI">
                                            <!--
                                            <option value="0"> Todos os clientes ... </option>
                                            <!?php foreach ($listaCli as $item): ?>
                                                <option value="<!?= $item['CODIGO'] ?>">
                                                    <!?= $item['PESSOA'] ?>
                                                </option>
                                            <!?php endforeach; ?>
                                            -->
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label"> Plano de Serviço (PPx) </label>
                                        <select class="form-control" id="optionPPx">
                                            <!--
                                            <option value="0"> Todos os planos de serviço ... </option>
                                            <!?php foreach ($listaPjtCliente as $item): ?>
                                                <option value="<!?= $item['CODIGO'] ?>">
                                                    <!?= $item['APELIDO'] ?>
                                                </option>
                                            <!?php endforeach; ?>
                                            -->
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="row">                                    
                                    <div class="col-4">
                                        <button class="btn btn-primary" style="font-size : 8px; width: 100%; height: 25px; border-color: #7CFC00; color: #000000; background-color: rgba(0, 0, 0, 0.0);" id="buttonAtualizar">Atualizar Lista </button>
                                    </div>                                    
                                    <div class="col-4">
                                        <label for="optionPJF" class="text-left control-label col-form-label"> Fase </label>
                                        <select class="form-control" id="optionPJF">
                                            <!--
                                            <option value="0"> Todas as fases ... </option>
                                            <!?php foreach ($listaPjfCliente as $item): ?>
                                                <option value="<!?= $item['ID'] ?>">
                                                    <!?= $item['DESCRICAO'] ?>
                                                </option>
                                            <!?php endforeach; ?>
                                            -->
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="optionCBR" class="text-left control-label col-form-label"> Colaborador </label>                                        
                                        <select class="form-control" id="optionCBR">
                                            <!--
                                            <option value="0"> Todos os colaboradores ... </option>
                                            <!?php foreach ($listaCbrCliente as $item): ?>
                                                <option value="<!?= $item['CODIGO'] ?>">
                                                    <1?= $item['COLABORADOR'] ?>
                                                </option>
                                            <!?php endforeach; ?>
                                            -->
                                        </select>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divTabela">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
                                        <input type="text" class="form-control" id="inputTextFiltro"/>
                                    </div>
                                </div>

                                <div class="table-responsive">         
                                    <table id="tableApontamentos" class="table table-stripe table-bordered">
                                        <thead>
                                            <tr>
                                                <th id='colApoData'> Data</th>
                                                <th id='colApoProf'> Profissional</th>
                                                <th id='colApoClie'> Cliente</th>
                                                <th id='colApoPlan'> Plano de Serviços</th>
                                                <th id='colApoAtiv'> Atividade</th>
                                                <th id='colApoCham'> Chamado</th>
                                                <th id='colApoDesc'> Descrição</th>
                                                <th id='colApoInic'> Início</th>
                                                <th id='colApoTerm'> Fim</th>                                                
                                                <td id='colApoTrab'> Trabalho<br/><span id="spanSomaTrab" class="font-weight-bold" style="color: #4B0082;">-</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão: 01.00 - 11/04/2023</b><br/>
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

    <script type="text/javascript">
        removeSpinner();
       
        $('#liGpo').addClass('selected');
		$('#liGpoRelApp').addClass('active');
		$('#ulGpo').addClass('in');

        $('#divTabela').hide();

        buttonAtualizar.setAttribute('disabled', '');
        
        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableApontamentos");
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

        var $rows = $('#tableApontamentos tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});

        $('#optionCLI').select2();
        $('#optionPPx').select2();
        $('#optionPJF').select2();
        $('#optionCBR').select2();

        ResetarCombos();
                
        var arrayLista = [];
        var table = $('#tableApontamentos').DataTable();

        var aCLICodigo = null;
        var aPJTCodigo = null;
        var aPJFCodigo = null;
        var aCBRCodigo = null;
        var aPeriodoIni = null;
        var aPeriodoFim = null;

        // var vSomaHora = 0.00;
        var $tds = null;

        setInputTextHints();        
        // listaApontamento();

        function listaApontamento() {

            aCLICodigo = ($('#optionCLI')[0].selectedIndex <= 0) ? 0 : $('#optionCLI').val();
            aPJTCodigo = ($('#optionPPx')[0].selectedIndex <= 0) ? 0 : $('#optionPPx').val();
            aPJFCodigo = ($('#optionPJF')[0].selectedIndex <= 0) ? 0 : $('#optionPJF').val();
            aCBRCodigo = ($('#optionCBR')[0].selectedIndex <= 0) ? 0 : $('#optionCBR').val();
            aPeriodoIni = $('#eInputDataDe').val();
            aPeriodoFim = $('#eInputDataAte').val();

            console.log(aCLICodigo);
            console.log(aPJTCodigo);
            console.log(aPJFCodigo);
            console.log(aCBRCodigo);            
            console.log(aPeriodoIni);
            console.log(aPeriodoFim);

            loadSpinner();
            $('#tableApontamentos').DataTable().clear().destroy();
            table = $('#tableApontamentos').DataTable({
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
                fixedHeader: true,

                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/FetchLctRelApp",                    
                    type: 'POST',
                    data: {                                            
                        aCLICodigo: aCLICodigo,
                        aPJTCodigo: aPJTCodigo,
                        aPJFCodigo: aPJFCodigo,
                        aCBRCodigo: aCBRCodigo,
                        aPeriodoIni: aPeriodoIni,
                        aPeriodoFim: aPeriodoFim
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divTabela').show();
                        // console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                // "scrollX": true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [0, "asc"]
                ],
                rowId: 'CODIGO',
                columns: [
                    {
                        "data": "DATA",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "PROFISSIONAL",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "CLIENTE",
                        "defaultContent": "",
                        className: "text-left"
                    },                    
                    {
                        "data": "PLANO_DE_SERVICO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "ATIVIDADE",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "CHAMADO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "DESCRICAO_HORAS",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "HORA_INICIO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "HORA_FIM",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "QTDE_HORAS_LANCADAS",
                        "defaultContent": "",
                        className: "text-center"
                    }

                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                    SomaHora();
                },
                columnDefs: [
                    {
                        "width": "5%",
                        "targets": [0]
                    },
                    {
                        "width": "15%",
                        "targets": [1]
                    },
                    {
                        "width": "15%",
                        "targets": [2]
                    },
                    {
                        "width": "15%",
                        "targets": [3]
                    },
                    {
                        "width": "15%",
                        "targets": [4]
                    },
                    {
                        "width": "3%",
                        "targets": [5]
                    },
                    {
                        "width": "26%",
                        "targets": [6]
                    },
                    {
                        "width": "3%",
                        "targets": [7]
                    },
                    {
                        "width": "3%",
                        "targets": [8]
                    },
                    {
                        "width": "3%",
                        "targets": [9]
                    }
               ],

            });
        };

        $('#eInputDataDe').change(function() {
            //buttonAtualizar.setAttribute('enabled', '');
            document.getElementById("buttonAtualizar").disabled = false;
        })

        $('#eInputDataAte').change(function() {
            // buttonAtualizar.setAttribute('enabled', '');
            document.getElementById("buttonAtualizar").disabled = false;
        })

        $('#buttonAtualizar').click(function() {
            buttonAtualizar.setAttribute('disabled', '');
            listaApontamento();
        })

        $('#buttonRestaurarCombos').click(function() {
            ResetarCombos();
            listaApontamento();
        })
        
        $('#optionCLI').change(function() { 
            ppCLICodigo = 0;
            ppPJTCodigo = 0;
            ppPJFCodigo = 0;
            ppCBRCodigo = 0;
            ppAgrupaCLI = 0;
            ppAgrupaPJT = 0;
            ppAgrupaPJF = 0;
            ppAgrupaCBR = 0;
            ppMostraTudo = 0;
            PopulaComboPJT( this.value, ppPJTCodigo, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, 1, ppAgrupaPJF, ppAgrupaCBR, ppMostraTudo );
            PopulaComboPJF( this.value, ppPJTCodigo, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, 1, ppAgrupaCBR, ppMostraTudo );
            PopulaComboCBR( this.value, ppPJTCodigo, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, ppAgrupaPJF, 1, ppMostraTudo );
            listaApontamento();
        })

        $('#optionPPx').change(function() {
            ppCLICodigo = 0;
            ppPJTCodigo = 0;
            ppPJFCodigo = 0;
            ppCBRCodigo = 0;
            ppAgrupaCLI = 0;
            ppAgrupaPJT = 0;
            ppAgrupaPJF = 0;
            ppAgrupaCBR = 0;
            ppMostraTudo = 0;            
            PopulaComboPJF( ppCLICodigo, this.value, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, 1, ppAgrupaCBR, ppMostraTudo );
            PopulaComboCBR( ppCLICodigo, this.value, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, ppAgrupaPJF, 1, ppMostraTudo );
            listaApontamento();
        })
        
        $('#optionPJF').change(function() {
            ppCLICodigo = 0;
            ppPJTCodigo = 0;
            ppPJFCodigo = 0;
            ppCBRCodigo = 0;
            ppAgrupaCLI = 0;
            ppAgrupaPJT = 0;
            ppAgrupaPJF = 0;
            ppAgrupaCBR = 0;
            ppMostraTudo = 0;            
            PopulaComboCBR( ppCLICodigo, ppPJTCodigo, this.value, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, ppAgrupaPJF, 1, ppMostraTudo );
            listaApontamento();
        })

        $('#optionCBR').change(function() {            
            listaApontamento();
        })        
        
        function PopulaComboCLI( ppCLICodigo, ppPJTCodigo, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, ppAgrupaPJF, ppAgrupaCBR, ppMostraTudo ) {
            loadSpinner();
            // document.getElementById('optionPPx').focus();    
            console.log('daqui');
            console.log(ppCLICodigo);
            console.log(ppPJTCodigo);
            console.log(ppPJFCodigo);
            console.log(ppCBRCodigo);
            console.log(ppAgrupaCLI);
            console.log(ppAgrupaPJT);
            console.log(ppAgrupaPJF);
            console.log(ppAgrupaCBR);
            console.log(ppMostraTudo);
            console.log('até');

            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthProComboCliente",                    
                    type: 'POST',
                    dataType: 'JSON',
                    data: { paCLICodigo: ppCLICodigo,
                            paPJTCodigo: ppPJTCodigo,
                            paPJFCodigo: ppPJFCodigo,
                            paCBRCodigo: ppCBRCodigo,
                            paAgrupaCLI: ppAgrupaCLI,
                            paAgrupaPJT: ppAgrupaPJT,
                            paAgrupaPJF: ppAgrupaPJF,
                            paAgrupaCBR: ppAgrupaCBR,
                            paMostraTudo: ppMostraTudo
                    },
                    success: function(response) {
                        var OptionsNome = [];
                        OptionsNome.push('<option value="0"> Todos os Clientes ... </option>');
                        response.listaCLI.forEach(function(e) {
                            OptionsNome.push('<option value="' + e.CLI_ID + '"> ' + e.CLI_DESC + ' </option>')
                        });
                        $('#optionCLI').html(OptionsNome);
                        
                    }
                    
                });
            removeSpinner();
        };

        function PopulaComboPJT( ppCLICodigo, ppPJTCodigo, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, ppAgrupaPJF, ppAgrupaCBR, ppMostraTudo ) {
            loadSpinner();
            // document.getElementById('optionPPx').focus();
            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthProComboPlano",                    
                    type: 'POST',
                    dataType: 'JSON',
                    data: { paCLICodigo: ppCLICodigo,
                            paPJTCodigo: ppPJTCodigo,
                            paPJFCodigo: ppPJFCodigo,
                            paCBRCodigo: ppCBRCodigo,
                            paAgrupaCLI: ppAgrupaCLI,
                            paAgrupaPJT: ppAgrupaPJT,
                            paAgrupaPJF: ppAgrupaPJF,
                            paAgrupaCBR: ppAgrupaCBR,
                            paMostraTudo: ppMostraTudo
                    },
                    success: function(response) {
                        var OptionsNome = [];
                        OptionsNome.push('<option value="0"> Todos os Planos ... </option>');
                        response.listaPJT.forEach(function(e) {
                            OptionsNome.push('<option value="' + e.PJT_ID + '"> ' + e.PJT_DESC + ' </option>')
                        });
                        $('#optionPPx').html(OptionsNome);
                    }
                });
            removeSpinner();
        };

        function PopulaComboPJF( ppCLICodigo, ppPJTCodigo, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, ppAgrupaPJF, ppAgrupaCBR, ppMostraTudo ) {
            loadSpinner();
            // document.getElementById('optionPPx').focus();
            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthProComboFase",                    
                    type: 'POST',
                    dataType: 'JSON',
                    data: { paCLICodigo: ppCLICodigo,
                            paPJTCodigo: ppPJTCodigo,
                            paPJFCodigo: ppPJFCodigo,
                            paCBRCodigo: ppCBRCodigo,
                            paAgrupaCLI: ppAgrupaCLI,
                            paAgrupaPJT: ppAgrupaPJT,
                            paAgrupaPJF: ppAgrupaPJF,
                            paAgrupaCBR: ppAgrupaCBR,
                            paMostraTudo: ppMostraTudo
                    },
                    success: function(response) {
                        var OptionsNome = [];
                        OptionsNome.push('<option value="0"> Todos as Fases ... </option>');
                        response.listaPJF.forEach(function(e) {
                            OptionsNome.push('<option value="' + e.PJF_ID + '"> ' + e.PJF_DESC + ' </option>')
                        });
                        $('#optionPJF').html(OptionsNome);
                    }
                });
            removeSpinner();
        };

        function PopulaComboCBR( ppCLICodigo, ppPJTCodigo, ppPJFCodigo, ppCBRCodigo, ppAgrupaCLI, ppAgrupaPJT, ppAgrupaPJF, ppAgrupaCBR, ppMostraTudo ) {
            loadSpinner();
            // document.getElementById('optionPPx').focus();
            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthProComboColabrador",                    
                    type: 'POST',
                    dataType: 'JSON',
                    data: { paCLICodigo: ppCLICodigo,
                            paPJTCodigo: ppPJTCodigo,
                            paPJFCodigo: ppPJFCodigo,
                            paCBRCodigo: ppCBRCodigo,
                            paAgrupaCLI: ppAgrupaCLI,
                            paAgrupaPJT: ppAgrupaPJT,
                            paAgrupaPJF: ppAgrupaPJF,
                            paAgrupaCBR: ppAgrupaCBR,
                            paMostraTudo: ppMostraTudo
                    },
                    success: function(response) {
                        var OptionsNome = [];
                        OptionsNome.push('<option value="0"> Todos os Colaboradores ... </option>');
                        response.listaCBR.forEach(function(e) {
                            OptionsNome.push('<option value="' + e.CBR_ID + '"> ' + e.CBR_DESC + ' </option>')
                        });
                        $('#optionCBR').html(OptionsNome);
                    }
                });
            removeSpinner();
        };                

        function SomaHora() {
            var vSomaHora = 0;
            $('#tableApontamentos').find('tr').slice(1).each(function(i, el) {
                    $tds = $(this).find('td');
                    vSomaHora += parseFloat($tds.eq(9).text());
                    // console.log('console.log(vSomaHora)');
                    // console.log(vSomaHora);
                });
            // $('#spanSomaTrab').text(vSomaHora.toFixed(2));
            $('#spanSomaTrab').text(vSomaHora.toFixed(2));
            // $('#spanSomaTrab').text(parseFloat(vSomaHora).toLocaleString('pt-br', {minimumFractionDigits: 2}));
        }

        function ResetarCombos() {
            PopulaComboCLI(0,0,0,0,1,0,0,0,0);        
            PopulaComboPJT(0,0,0,0,0,1,0,0,0);
            PopulaComboPJF(0,0,0,0,0,0,1,0,0);
            PopulaComboCBR(0,0,0,0,0,0,0,1,0);
        }
            
        // /***************************************************************************************/

        function setInputTextHints() {
                     
            $('#colApoData').prop('title', 'Data do apontamento de horas.');
            $('#colApoProf').prop('title', 'Nome/apelido do profissional atuante.');
            $('#colApoClie').prop('title', 'Denominação do Cliente.');
            $('#colApoPlan').prop('title', 'Título (apelido) do Plano de Serviços.');
            $('#colApoAtiv').prop('title', 'Descrição da Atividade do Apontamento de Horas.' );
            $('#colApoCham').prop('title', 'Código (Id) do Chamado - caso exista.' );

            $('#colApoDesc').prop('title', 'Descrição do Apontamento de Horas.' );
            $('#colApoCham').prop('title', 'Código (Id) do Chamado - caso exista.' );
            $('#colApoInic').prop('title', 'Momento (horário) do início do Trabalho apontado.' );
            $('#colApoTerm').prop('title', 'Momento (horário) do término do Trabalho apontado.' );
            $('#colApoTrab').prop('title', 'Tempo total do Trabalho apontado.' );
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }
/*
        var selectedCbr = "";
        $(document).on('click', '#tableApontamentos > tbody > tr ', function() {
          selectedCbr = arrayLista[table.row(this).index()];
          window.open('<!?php echo base_url('CbrEdita/') ?>' + selectedCbr.CODIGO, '_self');
        });
*/

    </script>
</body>

</html> 