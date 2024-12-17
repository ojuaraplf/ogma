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
    <title>Pré-pagamentos para fechar </title>

    <?php $this->load->view('include/headerTop') ?>
    <style>        
        #tabFmcVisual tbody tr {
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
                        <h3 class="page-title"> <i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pré-pagamento: Fechar </h3>
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
                            <h5> Filtro </h5>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label"> Mês de referência </label>
                                        <input type="text" id="eOptionMes" value=<?php echo date('m/Y'); ?> class="form-control" />
                                    </div>
                                    <div class="col-2">
                                        <label for="selectFMC_Status" class="text-left control-label col-form-label">Status do Pré-pagamemto</label>
                                        <select class="form-control" id="selectFMC_Status">
                                            <option value="A"> A fechar</option>
                                            <option value="F"> Fechado</option>                                            
                                            <option value="N"> Não fechar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divListaFmc">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">                                
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Pré-pagamentos para fechar </h4>
                                        </div>
                                    </div>                                    
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
                                            <input type="text" class="form-control" id="inputTextFiltro"/>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="tabFmcVisual">
                                        <thead>
                                            <tr>
                                                <th id='colCbrNome'> COLABORADOR</br>Nome/Apelido</th>
                                                <th id='colCbrCodi'> ID</th>
                                                <th id='colCbrCarg'> CARGO</th>
                                                <th id='colCbrRemu'> REMUNERAÇÃO</br>Valor/Forma</th>
                                                <th id='colNroClie'> <i class="mdi mdi-account-star" style="color:blue"></i></th>
                                                <th id='colNroPlan'> <i class="mdi mdi-math-compass" style="color:blue"></i></th>
                                                <th id='colNroCham'> <i class="mdi mdi-call-received" style="color:blue"></i></th>                                                                                                
                                                <th id='colTraTota'> <i class="mdi mdi-rowing" style="color:blue"></i></th>
                                                <th id='colTraGlos'> <i class="mdi mdi-rowing" style="color:red"></i></th>
                                                <th><input type="checkbox" id="colMarcada" class="marcarTodos" /></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>...</b><br/>
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
       
        var ArrayTextGlosa = [];
        $('#liFinanceiro').addClass('selected');
        $('#liFmcFechar').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divListaFmc').hide();
                
        var arrayLista = [];
        var table = $('#tabFmcVisual').DataTable();

        
                
        setInputTextHints();
        listar();

        function listar() {

            var vHabilitadaOuNao = '';
            var vCheckadoOuNao = '';
            var vApareceSaldoOuNao = '';
            var vSaldoCor = '';
            var vSaldo = '';
            var vIdTempoGlosa = '';            
            var vData1 = ($('#eOptionMes').val()).substring(3, 7)+'-'+($('#eOptionMes').val()).substring(0, 2)+'-01';
            var vUltDia = daysInMonth(($('#eOptionMes').val()).substring(0, 2)-1,($('#eOptionMes').val()).substring(3, 7));
            var vData2 = ($('#eOptionMes').val()).substring(3, 7)+'-'+($('#eOptionMes').val()).substring(0, 2)+'-'+vUltDia;        
            console.log('console.log(vData1)');
            console.log(vData1);
            console.log(vData2);

            loadSpinner();
            $('#tabFmcVisual').DataTable().clear().destroy();
            table = $('#tabFmcVisual').DataTable({
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
                
                ajax: {
                    url: "<?php echo base_url(); ?>financeiro/FmcLista/fetchFmcFechar",
                    type: 'POST',
                    data: {
                        aData1 : vData1,
                        aData2 : vData2
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divListaFmc').show();
                        console.log(response);
                    }
                },
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [0, "asc"]
                ],
                rowId: 'CBR_ID',
                columns: [
                    {
                        "data": "CBR_NOME",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "CBR_ID",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "CBR_CARGO",
                        "defaultContent": "",
                        className: "text-left",
                        render: function(data, type, row) {
                            return data;
                        }
                    },
                    {
                        "data": "VALOR_E_UD",
                        "defaultContent": "",
                        className: "text-right"                        
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.NROCLI_SALDO == '0' ? 'display: none;' : '';
                            vSaldoCor = row.CBR_FlgRemuneraQuebrado != '0' ? "color:orange;" : '';
                            return  '<span id="spanNROCLI_FECHADO">' + row.NROCLI_FECHADO + '</span>' + "</br>" +
                                    '<span id="spanNROCLI_SALDO" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.NROCLI_SALDO + '</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.NROCLI_SALDO == '0' ? 'display: none;' : '';
                            vSaldoCor = row.CBR_FlgRemuneraQuebrado != '0' ? "color:orange;" : '';
                            return  '<span id="spanNROPJT_FECHADO">' + row.NROPJT_FECHADO + '</span>' + "</br>" +
                                    '<span id="spanNROPJT_SALDO" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.NROPJT_SALDO + '</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.NROCLI_SALDO == '0' ? 'display: none;' : '';
                            vSaldoCor = row.CBR_FlgRemuneraQuebrado != '0' ? "color:orange;" : '';
                            return  '<span id="spanNROCHD_FECHADO">' + row.NROCHD_FECHADO + '</span>' + "</br>" + 
                                    '<span id="spanNROCHD_SALDO" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.NROCHD_SALDO + '</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.NROCLI_SALDO == '0' ? 'display: none;' : '';
                            vSaldoCor = row.CBR_FlgRemuneraQuebrado != '0' ? "color:orange;" : '';
                            vApareceSaldoOuNao = row.TEMPO_SALDO == '0.00' ? 'display: none;' : '';                            
                            return  '<span id="spanTEMPO_FECHADO">' + row.TEMPO_FECHADO + '</span>' + "</br>" +
                                    '<span id="spanTEMPO_SALDO" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.TEMPO_SALDO + '</span>';
                        }
                    },                                        
                    {
                        "data": "TEMPO_GLOSA",
                        "defaultContent": "",
                        className: "text-right",                        
                        render: function(data, type, row) {
                            vIdTempoGlosa = '#spanTEMPO_GLOSA' + row.CBR_ID;                                                   
                            if (row.TEMPO_GLOSA == '0.00') {
                                vApareceSaldoOuNao = 'display: none;';
                            } else {
                                vApareceSaldoOuNao = '';                                
                                ArrayTextGlosa.push({"CBR_ID":row.CBR_ID, "GLOSA_TEXTO": row.GLOSA_TEXTO});
                            };                            
                            return '<span id="' + vIdTempoGlosa + '" style="color:red;' + vApareceSaldoOuNao + '">' + row.TEMPO_GLOSA + '</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {                        
                            vHabilitadaOuNao = row.TEMPO_SALDO == '0.00' || row.CBR_FlgRemuneraQuebrado == '0' ? '' : 'disabled';
                            vCheckadoOuNao = row.TEMPO_SALDO == '0.00' || row.CBR_FlgRemuneraQuebrado == '0' ? ' checked ' : '';
                            return '<input type="checkbox" class="marcar"' + vCheckadoOuNao + 'id="CheckLinha' + row.CBR_ID +'"' + vHabilitadaOuNao + '>';
                        }
                    }

                ],
                'initComplete': function(settings, json) {
                    removeSpinner();                                        
                    ToolTip();
                }                
            });
        };

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tabFmcVisual");
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

		var $rows = $('#tabFmcVisual tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});
        
        function daysInMonth(iMonth, iYear){
            return 32 - new Date(iYear, iMonth, 32).getDate();
        };

        $('#eOptionMes').change(function() {
            listar();
        });

        $('#eOptionMes').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            orientation: 'bottom'
        });
        
        $("#eInputTRAB_VRHORA").maskMoney({
                prefix: "R$ ",
                decimal: ",",
                thousands: "."
        });

        $('.marcarTodos').click(toggleMarcarTodos);

        function toggleMarcarTodos(event) {
            var $tabela = $("#tabFmcVisual");
            var check = $(".marcarTodos", $tabela).is(':checked');
            var $checks = $('.marcar', $tabela);
            
            event && event.stopPropagation();
            
            $checks.each(function () {
                if (!$(this).prop("disabled")) {                    
                    $(this).prop("checked", check);
                };
                
            });        
        }

        function AtualizaTabela() {
  
            $('#tabFmcVisual').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');                
                var vGlosaVr = $tds.eq(8).text();
                
                if (vGlosaVr != '0.00') {                    
                    var IdGlosa = '#spanTEMPO_GLOSA' + $tds.eq(1).text();
                    $(IdGlosa).prop('title', 'jdlajkd sldj saldkja sl');                    
                    $('#spanTEMPO_GLOSA79').prop('title', 'jdlajkd sldj saldkja sl');
                }                
                
            });            
            
            ToolTip();
        }

        function setInputTextHints() {
            
            $('#colCbrNome').prop('title', 'Nome do Colaborador.\nApelido do Colaborador, no Cadastro de Pessoas.');
            $('#colCbrCodi').prop('title', 'Id do Colaborador.\nCódigo do Colaborador no Cadastro de Pessoas.');
            $('#colCbrCarg').prop('title', 'Cargo do Colaborador.\nCargo institucional ocupado pelo Colaborador -\ndiferente do cargo ocupado pelo Colaborador\nnos Planos de Serviços que participa.');
            $('#colCbrRemu').prop('title', 'Remuneração do Colaborador.\nValor e forma (hora, mês etc) de remuneração do colaborador.');
            $('#colNroClie').prop('title', 'Número de Clientes.\nQuantidade de Clientes atendidos pelo\nColaborador no período.\n\nLinha superior: Clientes já pré-fechados;\nLinha inferior: Clientes ainda não pré-fechados.');
            $('#colNroPlan').prop('title', 'Número de Planos de Serviços.\nQuantidade de Planos de Serviços trbalhados pelo\nColaborador no período.\n\nLinha superior: Planos já pré-fechados;\nLinha inferior: Planos ainda não pré-fechados.');
            $('#colNroCham').prop('title', 'Número de Chamados.\nQuantidade de Chamados trabalhados pelo\nColaborador no período.\n\nLinha superior: Chamados já pré-fechados;\nLinha inferior: Chamados ainda não pré-fechados.');
            $('#colTraTota').prop('title', 'Trabalho no período.\nTrabalho em horas do Colaborador durante\no período. Já descontadas as horas glosadas:\n\nLinha superior: Horas já pré-fechadas;\nLinha inferior: Horas ainda não pré-fechadas.');
            $('#colTraGlos').prop('title', 'Horas glosadas no período.\nValor em horas glosadas do Colaborador durante\no período.');            

            // $('[id^=spanTEMPO_GLOSA]').prop('title', ArrayTextGlosa.find(linha => linha.CBR_ID == substr(15,6);) );
            // $('[id^=spanTEMPO_GLOSA]').prop('title', this.id);
            
            
            
                 
            ToolTip();
        }

        function ToolTip() {
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
