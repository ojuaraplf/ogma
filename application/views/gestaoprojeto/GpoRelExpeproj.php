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
    <title>wD Ogma Extrato de PPx </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        #tableApontamentoHoras tbody tr {
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
                        <h4 class="page-title">Extrato de Planos de Serviço (PPx) </h4>
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
                            <h5> Período analisado: </h5>
                                <div class="row">
                                    <div class="col-2">
                                        <label for="eInputDataDe" class="text-left control-label col-form-label"> De: </label>
                                        <input type="date" value="<?php echo date('2023-01-01'); ?>"class="form-control" id="eInputDataDe" />
                                    </div>
                                    <div class="col-2">
                                        <label for="eInputDataAte" class="text-left control-label col-form-label"> Até: </label>
                                        <input type="date" value=<?php echo date('Y-m-t'); ?> class="form-control" id="eInputDataAte" />
                                    </div>
                                    <div class="col-4">
                                        
                                    </div>
                                    <div class="col-4">
                                        <label for="comboboxCLI" class="text-left control-label col-form-label"> Cliente </label>
                                        <select class="form-control" id="comboboxCLI">
                                            <option value="0"> Todos os clientes com Plano de Serviço (PPx) </option>

                                            <?php foreach ($listaCli as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['PESSOA'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-3">
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
                                <div class="table-responsive">
                                
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Planos de Serviço </h4>
                                            <small> Lista de PPx com trabalhos (apontamentos) realizados no período analisado. </small>
                                            <small> Coloque o cursor sobre o título de cada coluna para informações sobre ela. </small>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar na lista</label>
                                            <input type="text" class="form-control" id="inputTextFiltro"/>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-hover table-bordered" id="tableLista">
                                    
                                        <thead>
                                            <tr>
                                                <th id='colPlApel'> Plano de Serviço<br/>Apelido</th>
                                                <th id='colChStat'> Status</th>
                                                <th id='colCpDesd'> Início<br/>Data</th> 
                                                <th id='colPlVlHR'> Valor<br/>Hora<br/>(R$)</th>
                                                <th id='colPjVlTO'> Preço<br/>Total<br/>(R$)</th>
                                                <th id='colCtCusR'> Custo<br/>Atual<br/>(R$)</th>
                                                <th id='colCtImpo'> Imposto<br/>Total<br/>(R$)</th>
                                                <th id='colResult'> Resultado<br/>Atual<br/>(R$)</th>
                                                <th id='colFapTra'> Pré-faturado<br/>Atual<br/>(h)</th>
                                                <th id='colFapVal'> Pré-faturado<br/>Atual<br/>(R$)</th>
                                            </tr>                                            
                                        </thead>                                        
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th id='footPlApel'></th>
                                                <th id='footChStat'></th>
                                                <th id='footCpDesd'></th> 
                                                <th id='footPlVlHR'></th>
                                                <th id='footPjVlTO'><span id="spanPjVlTO" class="font-weight-bold" style="color: #4B0082;">-</span></th>
                                                <th id='footCtCusR'><span id="spanCtCusR" class="font-weight-bold" style="color: #4B0082;">-</span></th>
                                                <th id='footCtImpo'><span id="spanCtImpo" class="font-weight-bold" style="color: #4B0082;">-</span></th>
                                                <th id='footResult'><span id="spanResult" class="font-weight-bold" style="color: #4B0082;">-</span></th>
                                                <th id='footFapTra'><span id="spanFapTra" class="font-weight-bold" style="color: #4B0082;">-</span></th>
                                                <th id='footFapVal'><span id="spanFapVal" class="font-weight-bold" style="color: #4B0082;">-</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.21 - 24/03/2023</b><br/>
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
        $('#liExpeproj').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divLista').hide();
        $('#divGeral').hide();

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAledataDataIni = 'Informe a data início do período desejado';
        var vAledataDataFim = 'Informe a data final do período desejado';
        var vAlertaCli = 'Selecione o cliente.';
        var dataDataIni = null;
        var dataDataFim = null;
        var selectedCli = null;
        var ArrayPjtDetCons = [];
        var vCustoId = null;
        var vCustoVa = null;
        var vCustoCo = null;
        var ArrayPjtDetProj = [];
        var vDetPjtId = null;
        var vDetPjtVa = null;
        var vDetPjtCo = null;
        var ArrayPjtDetValo = [];
        var vDetValId = null;
        var vDetValVa = null;
        var vDetValCo = null;


        $('#comboboxCLI').change(function() {
            ListaNaMarra();
        })

        $('#buttonListar').click(function() {
            ListaNaMarra();
        })
            
        ListaNaMarra();
       
        function ListaNaMarra() {

            var arrayLista = [];
            var table = $('#tableLista').DataTable();
            dataDataIni = $('#eInputDataDe').val();
            dataDataFim = $('#eInputDataAte').val();
            selectedCli = ($('#comboboxCLI')[0].selectedIndex == 0) ? 0 : $('#comboboxCLI').val();
            console.log(selectedCli);

            loadSpinner();
            $('#tableLista').DataTable().clear().destroy();
            table = $('#tableLista').DataTable({

                dom: 'Bfrtip',
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
                
                fixedHeader: {
                    header: true,
                    footer: true
                },

                //scrollX: true, comentado porque bagunça entre colunas e cabeçalho.

                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/FetchExtProj",
                    type: 'POST',
                    data: {
                        dataDataIni: dataDataIni,
                        dataDataFim: dataDataFim,
                        selectedCli: selectedCli
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [1, "asc"]
                ],
                rowId: 'ID1',
                columns: [
                    {
                        "data": "colPlApel",
                        "defaultContent": "",
                        className: "text-lelft",
                        render: function(data, type, row) {                            
                            ArrayPjtDetProj.push({
                                "PJT_CODIGO": row.PJT_CODIGO,
                                "PJT_DETALHES": row.PJT_DETALHES
                            });
                            vDetPjtVa = data ;
                            vDetPjtId = 'spanDETALHES' + row.PJT_CODIGO;
                            vDetPjtCo = 'black';
                            return  '<span id="' + vDetPjtId + '" style="color:'+ vDetPjtCo +';" >' + vDetPjtVa + '</span>';
                        }
                    },
                    {
                        "data": "colChStat",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "colCpDesd",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "colPlVlHR",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "colPjVlTO",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {                            
                            ArrayPjtDetValo.push({
                                "PJT_CODIGO": row.PJT_CODIGO,
                                "PJT_FATURAMENTO": row.PJT_FATURAMENTO + row.PJT_ATIVIDADES
                            });
                            vDetValVa = data == null ? '0.00' : parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                            vDetValId = 'spanVRTOTAL' + row.PJT_CODIGO;
                            vDetValCo = data < 0 ? 'red' : 'black';
                            return  '<span id="' + vDetValId + '" style="color:'+ vDetValCo +';" >' + vDetValVa + '</span>';
                        }
                    },
                    {
                        "data": "colCtCusR",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {
                            ArrayPjtDetCons.push({
                                "PJT_CODIGO": row.PJT_CODIGO,
                                "PJT_CONSULTORES": row.PJT_CONSULTORES
                            });
                            vCustoVa = data == null ? '0.00' : parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                            vCustoId = 'spanCUSTO' + row.PJT_CODIGO;
                            vCustoCo = data < 0 ? 'red' : 'black';
                            return  '<span id="' + vCustoId + '" style="color:'+ vCustoCo +';" >' + vCustoVa + '</span>';
                        }
                    },

                    {
                        "data": "colCtImpo",
                        "defaultContent": "",
                        className: "text-right"
                    },                    
                    {
                        "data": "colResult",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "colFapTra",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "colFapVal",
                        "defaultContent": "",
                        className: "text-right"
                    }
                ],

                columnDefs: [
                    {
                        "width": "40%",
                        "targets": [0]
                    },
                    {
                        "width": "19%",
                        "targets": [1]
                    },                    
                    {
                        "width": "6%",
                        "targets": [2]
                    },
                    {
                        "width": "5%",
                        "targets": [3],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        "width": "5%",
                        "targets": [4],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        "width": "5%",
                        "targets": [5],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        "width": "5%",
                        "targets": [6],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                            }
                    },
                    {
                        "width": "5%",
                        "targets": [7],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', (cellData<0 ? '#FAF0E6' : '#F0FFFF'));
                            }
                    },
                    {
                        "width": "5%",
                        "targets": [8],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },
                    {
                        "width": "5%",
                        "targets": [9],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFFFF0');
                            }
                    },                    
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                        },
                        "targets": [3, 4, 5, 6, 7, 8, 9]
                    }
                ],
                'initComplete': function(settings, json) {
                    console.log('console.log(json)');
                    console.log(json);
                    removeSpinner();
                    SomaLista(json);
                    setInputTextHints();
                }

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

        $('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});

        function SomaLista(pJson) {
            var vSomaPjVlTO = 0;
            var vSomaCtCusR = 0;
            var vSomaCtImpo = 0;
            var vSomaResult = 0;
            var vSomaFapTra = 0;
            var vSomaFapVal = 0;
            for (i = 0; i < pJson.length; i++) {
                vSomaPjVlTO += parseFloat(pJson[i]['colPjVlTO']);
                vSomaCtCusR += parseFloat(pJson[i]['colCtCusR']);
                vSomaCtImpo += parseFloat(pJson[i]['colCtImpo']);
                vSomaResult += parseFloat(pJson[i]['colResult']);
                vSomaFapTra += parseFloat(pJson[i]['colFapTra']);
                vSomaFapVal += parseFloat(pJson[i]['colFapVal']);
            }
            /*
            $('#spanPjVlTO').text(vSomaPjVlTO.toFixed(2));
            $('#spanCtCusR').text(vSomaCtCusR.toFixed(2));
            $('#spanCtImpo').text(vSomaCtImpo.toFixed(2));
            $('#spanResult').text(vSomaResult.toFixed(2));
            $('#spanFapTra').text(vSomaFapTra.toFixed(2));
            $('#spanFapVal').text(vSomaFapVal.toFixed(2));
            */
            $('#spanPjVlTO').text(vSomaPjVlTO.toLocaleString('pt-br', {minimumFractionDigits: 2}));
            $('#spanCtCusR').text(vSomaCtCusR.toLocaleString('pt-br', {minimumFractionDigits: 2}));
            $('#spanCtImpo').text(vSomaCtImpo.toLocaleString('pt-br', {minimumFractionDigits: 2}));
            $('#spanResult').text(vSomaResult.toLocaleString('pt-br', {minimumFractionDigits: 2}));
            $('#spanFapTra').text(vSomaFapTra.toLocaleString('pt-br', {minimumFractionDigits: 2}));
            $('#spanFapVal').text(vSomaFapVal.toLocaleString('pt-br', {minimumFractionDigits: 2}));
            
        }

        /*
        function SomaLista() {
            var vSomaPjVlTO = 0;
            var vSomaCtCusR = 0;
            var vSomaCtImpo = 0;
            var vSomaResult = 0;
            var vSomaFapTra = 0;
            var vSomaFapVal = 0.0;            
            $('#tableLista').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');                
                vSomaPjVlTO += parseFloat($tds.eq(4).text());
                vSomaCtCusR += parseFloat($tds.eq(5).text());
                vSomaCtImpo += parseFloat($tds.eq(6).text());
                vSomaResult += parseFloat($tds.eq(7).text());
                vSomaFapTra += parseFloat($tds.eq(8).text());
                vSomaFapVal += parseFloat($tds.eq(9).text());
            });           
           
            $('#spanPjVlTO').text(vSomaPjVlTO.toFixed(2));
            $('#spanCtCusR').text(vSomaCtCusR.toFixed(2));
            $('#spanCtImpo').text(vSomaCtImpo.toFixed(2));
            $('#spanResult').text(vSomaResult.toFixed(2));
            $('#spanFapTra').text(vSomaFapTra.toFixed(2));
            $('#spanFapVal').text(vSomaFapVal.toFixed(2));
        }
        */
        
        function setInputTextHints() {
        
            $('#eInputDataDe').prop('title', vAledataDataIni );
            $('#eInputDataAt').prop('title', vAledataDataFim );
            $('#comboboxCLI').prop('title', vAlertaCli );

            $('#colPlApel').prop('title', 'Apelido do Plano de Serviço.\nProjeto.\nPonha o cursor sobre o apelido para ver detalhes' );
            $('#colChStat').prop('title', 'Status atual do Projeto.' );
            $('#colCpDesd').prop('title', 'Data do primeiro apontamento de trabalho feito para o projeto.' );
            $('#colPlVlHR').prop('title', 'Valor cobrado pela hora no projeto.' );
            $('#colPjVlTO').prop('title', 'Valor total do projeto.\nPonha o cursos sobre o valor para ver o tipo de faturamento.' );
            $('#colCtCusR').prop('title', 'Total do custo do projeto.\nSomatória das horas trabalhadas X valor/hora do consultor.\nPonha o cursos sobre o valor para ver os consultores.' );
            $('#colCtImpo').prop('title', 'Total dos impostos previstos.\nValor total do projeto X Índice(%)\ninformado na seção financeira do projeto.' );
            $('#colResult').prop('title', 'Resultado bruto do projeto.\nTotais de custos e impostos subtraídos do Valor Total do Projeto.' );
            $('#colFapTra').prop('title', 'Total de Horas já pré-faturadas (FAP) do projeto.' );
            $('#colFapVal').prop('title', 'Valor toral já pré-faturado (FAP) do projeto.' );

            $('[id^=spanDETALHES]').each(function(){                    
                $(this).prop('title', ArrayPjtDetProj.find(linha => linha.PJT_CODIGO == this.id.substr(12,6))["PJT_DETALHES"]);
            });
            
            $('[id^=spanVRTOTAL]').each(function(){                    
                $(this).prop('title', ArrayPjtDetValo.find(linha => linha.PJT_CODIGO == this.id.substr(11,6))["PJT_FATURAMENTO"]);
            });

            $('[id^=spanCUSTO]').each(function(){                    
                $(this).prop('title', ArrayPjtDetCons.find(linha => linha.PJT_CODIGO == this.id.substr(9,6))["PJT_CONSULTORES"]);
            });

            
        
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

    </script>
</body>

</html> 