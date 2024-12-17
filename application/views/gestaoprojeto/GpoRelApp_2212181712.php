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
                                        <select class="form-control" id="optionCLI">
                                            <option value="0"> Todos os clientes ... </option>
                                            <?php foreach ($listaCli as $item): ?>
                                                <option value="<?= $item['CODIGO'] ?>">
                                                    <?= $item['PESSOA'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="optionCBR" class="text-left control-label col-form-label"> Colaborador </label>
                                        <select class="form-control" id="optionCBR">
                                            <option value="0"> Todos os colaboradores ... </option>
                                            <?php foreach ($listaCbr as $item): ?>
                                                <option value="<?= $item['CODIGO'] ?>">
                                                    <?= $item['COLABORADOR'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-4">
                                        <button class="btn btn-primary" style="font-size : 8px; width: 100%; height: 25px; border-color: #7CFC00; color: #000000; background-color: rgba(0, 0, 0, 0.0);" id="buttonAtualizar">Atualizar Lista </button>
                                    </div>
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label"> Plano de Serviço (PPx) </label>
                                        <select class="form-control" id="optionPPx">
                                            <option value="0"> Todos os planos de serviço ... </option>
                                            <?php foreach ($listaPjt as $item): ?>
                                                <option value="<?= $item['CODIGO'] ?>">
                                                    <?= $item['APELIDO'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="optionPJF" class="text-left control-label col-form-label"> Fase(s) do PPx </label>
                                        <select class="form-control" id="optionPJF">
                                            <option value="0"> Todas as fases ... </option>
                                            <?php foreach ($listaPjf as $item): ?>
                                                <option value="<?= $item['ID'] ?>">
                                                    <?= $item['DESCRICAO'] ?>
                                                </option>
                                            <?php endforeach; ?>
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
                                    <table id="tableApontamentos" class="table table-hover table-sm table-bordered">
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
                                                <th id='colApoTrab'> Trabalho</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.50 - 04/12/2022</b><br/>
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

        $('#optionPPx').change(function() {
            console.log(this.value);
            loadSpinner();
            document.getElementById('optionPJF').focus();
            $.ajax({
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fecthPJF/" + this.value,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        var optionsPJFNome = [];
                        optionsPJFNome.push('<option value="0"> Todas as fases ... </option>');
                        response.listaPjf.forEach(function(e) {
                            optionsPJFNome.push('<option value="' + e.ID + '"> ' + e.DESCRICAO + ' </option>')
                        });
                        $('#optionPJF').html(optionsPJFNome);
                        console.log(response);
                        console.log("$('#optionPJF').val()");
                        console.log($('#optionPJF').val());
                        listaApontamento();
                    }
                });
            removeSpinner();
        });


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

        var arrayLista = [];
        var table = $('#tableApontamentos').DataTable();

        var aCLICodigo = 0;
        var aPJTCodigo = 0;
        var aPJFCodigo = 0;
        var aCBRCodigo = 0;
        var aPeriodoIni = null;
        var aPeriodoFim = null;

        setInputTextHints();        
        listaApontamento();

        function listaApontamento() {
                        
            aCLICodigo = ($('#optionCLI')[0].selectedIndex == 0) ? 0 : $('#optionCLI').val();
            aPJTCodigo = ($('#optionPPx')[0].selectedIndex == 0) ? 0 : $('#optionPPx').val();
            aPJFCodigo = ($('#optionPJF')[0].selectedIndex == 0) ? 0 : $('#optionPJF').val();
            aCBRCodigo = ($('#optionCBR')[0].selectedIndex == 0) ? 0 : $('#optionCBR').val();
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

        $('#optionCLI').change(function() {
            listaApontamento();
        })

        $('#optionPPx').change(function() {
            listaApontamento();
        })
        
        $('#optionPJF').change(function() {
            listaApontamento();
        })

        $('#optionCBR').change(function() {
            listaApontamento();
        })

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

        var selectedCbr = "";
        $(document).on('click', '#tableApontamentos > tbody > tr ', function() {
          selectedCbr = arrayLista[table.row(this).index()];
          window.open('<?php echo base_url('CbrEdita/') ?>' + selectedCbr.CODIGO, '_self');
        });

    </script>
</body>

</html> 