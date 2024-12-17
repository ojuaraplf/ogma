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
                                    <!-- <div class="col-2">
                                        <label for="selectFMC_Status" class="text-left control-label col-form-label">Status do Pré-pagamemto</label>
                                        <select class="form-control" id="selectFMC_Status">
                                            <option value="A"> A fechar</option>
                                            <option value="F"> Fechado</option>                                            
                                            <option value="N"> Não fechar</option>
                                        </select>
                                    </div> -->
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
                                                <th id="colObserLi"> Observações</i></th>
                                                <th id="buttAtuali"> <i class="mdi mdi-recycle"></i></th>
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
       
        var vData1 = null;
        var vData2 = null;
        var ArrayLinhaTabFmcVisual = [];
        var ArrayLinhaTabFmcVisualDet = [];
        $('#eOptionMes').val(MesAnoAnterior());
        $('#liFinanceiro').addClass('selected');
        $('#liFmcFechar').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divListaFmc').hide();
                
        var arrayLista = [];
        var table = $('#tabFmcVisual').DataTable();
                    
        // setInputTextHints();
        listar();

        function listar() {

            var vHabilitadaOuNao = '';
            var vLiberadoOuNao = '';
            var InputObs = '';
            var FmcSalvaItem = '';
            var vApareceSaldoOuNao = '';
            var vSaldoCor = '';
            var vSaldo = '';
            var vIdTempoGlosa = '';
            vData1 = ($('#eOptionMes').val()).substring(3, 7)+'-'+($('#eOptionMes').val()).substring(0, 2)+'-01';
            var vUltDia = daysInMonth(($('#eOptionMes').val()).substring(0, 2)-1,($('#eOptionMes').val()).substring(3, 7));
            vData2 = ($('#eOptionMes').val()).substring(3, 7)+'-'+($('#eOptionMes').val()).substring(0, 2)+'-'+vUltDia;        
            console.log('console.log(vData1)');
            console.log(vData1);
            console.log(vData2);
            ArrayLinhaTabFmcVisualDet = [];

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
                fixedHeader: true,
                
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
                        className: "text-right",
                        render: function(data, type, row) {                                                     
                            return  parseFloat(row.CBR_REMUNERA_VALOR).toLocaleString('pt-br', {minimumFractionDigits: 2}) +
                                    '</br>' + row.CBR_REMUNERA_DESC;
                        }                         
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.NROCLI_SALDO == '0' ? 'display: none;' : '';
                            vSaldoCor = row.NROCLI_SALDO != '0' ? "color:orange;" : '';
                            return  '<span id="spanNROCLI_FECHADO">' + row.NROCLI_FECHADO + '</span>' + "</br>" +
                                    '<span id="spanNROCLI_SALDO' + row.CBR_ID + '" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.NROCLI_SALDO + '</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.NROPJT_SALDO == '0' ? 'display: none;' : '';
                            vSaldoCor = row.NROPJT_SALDO != '0' ? "color:orange;" : '';
                            return  '<span id="spanNROPJT_FECHADO">' + row.NROPJT_FECHADO + '</span>' + "</br>" +
                                    '<span id="spanNROPJT_SALDO' + row.CBR_ID + '" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.NROPJT_SALDO + '</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.NROCHD_SALDO == '0' ? 'display: none;' : '';
                            vSaldoCor = row.NROCHD_SALDO != '0' ? "color:orange;" : '';
                            return  '<span id="spanNROCHD_FECHADO">' + row.NROCHD_FECHADO + '</span>' + "</br>" + 
                                    '<span id="spanNROCHD_SALDO' + row.CBR_ID + '" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.NROCHD_SALDO + '</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {
                            vApareceSaldoOuNao = row.TEMPO_SALDO == '0.00' ? 'display: none;' : '';
                            vSaldoCor = row.TEMPO_SALDO != '0.00' ? "color:orange;" : '';
                            vApareceSaldoOuNao = row.TEMPO_SALDO == '0.00' ? 'display: none;' : '';                            
                            return  '<span id="spanTEMPO_FECHADO">' + row.TEMPO_FECHADO + '</span>' + "</br>" +
                                    '<span id="spanTEMPO_SALDO' + row.CBR_ID + '" style="' + vSaldoCor + vApareceSaldoOuNao + '">' + row.TEMPO_SALDO + '</span>';
                        }
                    },                                        
                    {
                        "data": "TEMPO_GLOSA",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {                            
                            ArrayLinhaTabFmcVisualDet.push({
                                "FMC_CBRCodigo": row.CBR_ID,
                                "GLOSA_TEXTO": row.GLOSA_TEXTO,
                                "CBR_NOME": row.CBR_NOME,
                                "LISTA_CLI": row.LISTA_CLI,
                                "LISTA_PJT": row.LISTA_PJT,
                                "LISTA_CHD": row.LISTA_CHD,
                                "LISTA_LCT": row.LISTA_LCT
                            });
                            vIdTempoGlosa = 'spanTEMPO_GLOSA' + row.CBR_ID;
                            if (row.TEMPO_GLOSA == '0.00') {
                                vApareceSaldoOuNao = 'display: none;';
                            } else {
                                vApareceSaldoOuNao = '';                                                                
                            };                            
                            return  '<span id="' + vIdTempoGlosa + '" style="color:red;' + vApareceSaldoOuNao + '">' + row.TEMPO_GLOSA + '</span>';
                        }
                    },
                    {
                        "data": "OBS",
                        "defaultContent": "",
                        className: "text-left",
                        render: function(data, type, row) { 
                            vHabilitadaOuNao = row.TEMPO_SALDO == '0.00' ? '' : ' disabled ';
                            InputObs = 'eInputFMC_Obs' + row.CBR_ID;
                            return  '<textarea type="text" class="form-control"' + vHabilitadaOuNao + 'rows="1" id="' + InputObs +'">' + row.OBS + '</textarea>'
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {                        
                            vHabilitadaOuNao =  row.TEMPO_SALDO == '0.00' ? '' : ' disabled ';
                            vLiberadoOuNao =    row.TEMPO_SALDO == '0.00' ?                             
                                                '<i class="mdi  mdi-flag-checkered" style="color:#32CD32; font-weight:bold;"></i>' :
                                                '<i class="mdi mdi-flag-checkered" style="color:#FF6347;"></i>';
                            FmcSalvaItem = "FecharFmc('" + row.CBR_ID + "', '" + row.CBR_REMUNERA_VALOR + "', '" + row.CBR_FlgRemuneraQuebrado  + "', '" + row.CBR_CBUCodigo  + "', '" + row.CBR_NOME  + "')";
                            return '<button id="buttonFechaLinha' + row.CBR_ID + 'style= border-color:rgba(255, 255, 255, .4); background-color: rgba(255, 255, 255, .4);" class="btn btn-clear"' + vHabilitadaOuNao + ' onclick="' + FmcSalvaItem + '">'+ vLiberadoOuNao +'</button>'
                        }
                    }

                ],

                columnDefs: [
                    {
                        "width": "27%",
                        "targets": [0],
                    },
                    {
                        "width": "3%",
                        "targets": [1],
                    },
                    {
                        "width": "20%",
                        "targets": [2],
                    },
                    {
                        "width": "5%",
                        "targets": [3],
                    },
                    {
                        "width": "2%",
                        "targets": [4],
                    },
                    {
                        "width": "2%",
                        "targets": [5],
                    },
                    {
                        "width": "2%",
                        "targets": [6],
                    },
                    {
                        "width": "2%",
                        "targets": [7],
                    },
                    {
                        "width": "5%",
                        "targets": [8],
                    },
                    {
                        "width": "31%",
                        "targets": [9],
                    },
                    {
                        "width": "1%",
                        "targets": [10],
                    }
                ],

                'initComplete': function(settings, json) {
                    removeSpinner();                                        

                    $('[id^=spanNROCLI_SALDO]').click(function() {
                        console.log('console.log(this.id.substr(16,6))');
                        console.log(this.id.substr(16,6));
                    });
                    
                    console.table(ArrayLinhaTabFmcVisualDet);
                    setInputTextHints();
                }                
            });
        };

        function FecharFmc(
            pFMC_CBRCodigo,
            pFMC_RemuneraValor,
            pFMC_FlgRemuneraQuebrado,
            pFMC_CBUCodigo,
            pCBR_Nome
            
            ) {

            console.log('pFMC_CBRCodigo'),
            console.log(pFMC_CBRCodigo),
            console.log('pFMC_RemuneraValor'),
            console.log(pFMC_RemuneraValor),
            console.log('pFMC_FlgRemuneraQuebrado'),
            console.log(pFMC_FlgRemuneraQuebrado),
            console.log('pFMC_CBUCodigo'),
            console.log(pFMC_CBUCodigo),

           
            Swal.fire({
                title: 'Fechar Pré-pagamento?',
                text: pCBR_Nome,
                showDenyButton: true,
                confirmButtonText: 'Confirmar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                if (result.isConfirmed) {
                    ArrayLinhaTabFmcVisual = [];
                    InputObs = "#eInputFMC_Obs" + pFMC_CBRCodigo;                        
                    ArrayLinhaTabFmcVisual.push({
                        "FMC_CBRCodigo": pFMC_CBRCodigo,
                        "FMC_RemuneraValor": pFMC_RemuneraValor,
                        "FMC_FlgRemuneraQuebrado": pFMC_FlgRemuneraQuebrado,
                        "FMC_CBUCodigo": pFMC_CBUCodigo, 
                        "FMC_Mes": vData1,
                        "FMC_Status": 'F',
                        "FMC_Observacao": $(InputObs).val(),
                        "FMC_MomFechamento": MomentoAgora(),
                        "FMC_USUCodigo": <?php echo $this->session->userdata('userCodigo'); ?>
                    });

                    $.ajax({
                        url: "<?php echo base_url(); ?>financeiro/FmcLista/NewFMC",
                        type: 'POST',
                        data: {
                            ArrayLinhaTabFmcVisual: ArrayLinhaTabFmcVisual
                        }
                    });                
                    listar();
                }
            })            
        }

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
            console.log('console.log(today)');
            console.log(today);
            return today
        }

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
				for(j=0 ; j<td.length ; j++) {
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

        $('#buttAtuali').click(function() {
            listar();
        });

        $('#eOptionMes').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            orientation: 'bottom'
        });

        function MesAnoAnterior(){
            var data = new Date(),                
                mes  = (data.getMonth()+0).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
                ano  = data.getFullYear();
            return mes+"/"+ano;
        };
                
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
            $('#buttAtuali').prop('title', 'Clique para atualizar dados da tabela.');
            
            $('[id^=buttonGloDetalhes]').prop('title', 'Clique para visualizar detalhes da Glosa.');
            $('[id^=buttonFechaLinha]').prop('title', 'Quando bandeira verde,\nclique para fechar o\nPré-pagamento do Colaborador.');                                                            

            $('[id^=spanNROCLI_SALDO]').each(function(){
                $(this).prop('title', ArrayLinhaTabFmcVisualDet.find(linha => linha.FMC_CBRCodigo == this.id.substr(16,6))["LISTA_CLI"]);
            });
            $('[id^=spanNROPJT_SALDO]').each(function(){
                $(this).prop('title', ArrayLinhaTabFmcVisualDet.find(linha => linha.FMC_CBRCodigo == this.id.substr(16,6))["LISTA_PJT"]);
            });
            $('[id^=spanNROCHD_SALDO]').each(function(){
                $(this).prop('title', ArrayLinhaTabFmcVisualDet.find(linha => linha.FMC_CBRCodigo == this.id.substr(16,6))["LISTA_CHD"]);
            });
            $('[id^=spanTEMPO_SALDO]').each(function(){
                $(this).prop('title', ArrayLinhaTabFmcVisualDet.find(linha => linha.FMC_CBRCodigo == this.id.substr(15,6))["LISTA_LCT"]);
            });
            $('[id^=spanTEMPO_GLOSA]').each(function(){
                $(this).prop('title', ArrayLinhaTabFmcVisualDet.find(linha => linha.FMC_CBRCodigo == this.id.substr(15,6))["GLOSA_TEXTO"]);
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

