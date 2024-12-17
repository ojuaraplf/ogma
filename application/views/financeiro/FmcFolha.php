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
    <title>Pré-pagamentos: Folha </title>

    <?php $this->load->view('include/headerTop') ?>
    <style>        
        #tabFmcFolha tbody tr {
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
                        <h3 class="page-title"> <i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pré-pagamento: Folha </h3>
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
                                            <h4 class="card-title">Pré-pagamentos fechados </h4>
                                        </div>
                                    </div>                                    
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
                                            <input type="text" class="form-control" id="inputTextFiltro"/>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="tabFmcFolha">
                                        <thead>
                                            <tr>
                                                <th id='colCbrNome'> COLABORADOR</br>Nome/Apelido</th>
                                                <th id='colCbrCodi'> ID</th>
                                                <th id='colCbrCarg'> CARGO</th>
                                                <th id='colTraTota'> <i class="mdi mdi-rowing" style="color:blue"></i></br><span class="font-weight-bold" id="spanSomaTraTota" >-</span></th>
                                                <th id='colCbrRemu'> REMUNERAÇÃO</br>Valor/Forma</th>
                                                <th id='colValTota'> Total (R$)</br><span class="font-weight-bold" id="spanSomaValTota" >-</span></th>
                                                <th id='colTraGlos'> <i class="mdi mdi-rowing" style="color:red"></i></br><span class="font-weight-bold" id="spanSomaTraGlos" >-</span></th>
                                                <th id="colObserLi"> Observações</i></th>
                                                <th><i class="mdi mdi-recycle"></i></br><input type="checkbox" id="colMarcada" class="marcarTodos" /></th>                                                
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
       
        var today_ = new Date();
        console.log('console.log(today_)');
        console.log(today_);


        var vMes = null;
        var ArrayLinhatabFmcFolha = [];
        var ArrayLinhaTabFmcVisualDet = [];
        var vCBRCodigoDaLinha = null;
        $('#liFinanceiro').addClass('selected');
        $('#liFmcFolha').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divListaFmc').hide();
                
        var arrayLista = [];        
        var table = $('#tabFmcFolha').DataTable();        
        $('#eOptionMes').val(MesAnoAnterior());
        
                    
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
            vMes = ($('#eOptionMes').val()).substring(3, 7)+'-'+($('#eOptionMes').val()).substring(0, 2)+'-01';
                                    
            console.log('console.log($(eOptionMes).val())');
            console.log(vMes);
            console.log(vMes.substring(5,7));
            console.log(vMes.substring(0,4));
                      
	        //var month = date.getMonth();
	//crio uma nova váriavel com a nova data, Date(ano, mes(soma da variavel enviada para o metodo + o mes atual, dia que eu coloquei padrão para 1
	//var n_date = new Date(date.getFullYear(), eval(m+month), 1);

            loadSpinner();
            $('#tabFmcFolha').DataTable().clear().destroy();
            table = $('#tabFmcFolha').DataTable({
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
                    url: "<?php echo base_url(); ?>financeiro/FmcLista/fetchFmcFolha",
                    type: 'POST',
                    data: {
                        aMes : vMes
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
                        "data": "REMUNERA_TRABALHO",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {                                                     
                            return  parseFloat(row.REMUNERA_VLR).toLocaleString('pt-br', {minimumFractionDigits: 2}) +
                                    '</br>' + row.REMUNERA_UND_DESC;
                        }                       
                    },                    
                    {
                        "data": "REMUNERA_TOTAL",
                        "defaultContent": "",
                        className: "text-right"                        
                    },
                    {
                        "data": "TEMPO_GLOSA",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {                            
                            ArrayLinhaTabFmcVisualDet.push({
                                "FMC_CBRCodigo": row.CBR_ID,
                                "GLOSA_TEXTO": row.GLOSA_TEXTO,
                                "CBR_NOME": row.CBR_NOME
                            });
                            vIdTempoGlosa = '#spanTEMPO_GLOSA' + row.CBR_ID;
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
                        className: "text-left"
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {                            
                            var vChamaSomaHora = "SomaHora()";
                            // var vChecadaOuNao = row.APO_DATA_REAL >= "<!?= $cabecaPjt->PER_INICIO?>" && row.APO_DATA_REAL <= "<!?= $cabecaPjt->PER_TERMINO ?>" ? 'checked' : '';
                            return '<input type="checkbox" checked class="marcar" id="CheckLinha' + row.CBR_ID +'"' + '>';
                        }
                    }
                ],

                columnDefs: [
                    /*
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                        },
                        "targets": [3, 5, 6]
                    }
                    */
                //     {
                //         "width": "27%",
                //         "targets": [0],
                //     },
                //     {
                //         "width": "3%",
                //         "targets": [1],
                //     },
                //     {
                //         "width": "20%",
                //         "targets": [2],
                //     },
                //     {
                //         "width": "5%",
                //         "targets": [3],
                //     },
                //     {
                //         "width": "2%",
                //         "targets": [4],
                //     },
                //     {
                //         "width": "2%",
                //         "targets": [5],
                //     },
                //     {
                //         "width": "2%",
                //         "targets": [6],
                //     },
                //     {
                //         "width": "2%",
                //         "targets": [7],
                //     },
                //     {
                //         "width": "5%",
                //         "targets": [8],
                //     },
                //     {
                //         "width": "31%",
                //         "targets": [9],
                //     },
                //     {
                //         "width": "1%",
                //         "targets": [10],
                //     }
                ],

                'initComplete': function(settings, json) {
                    SomaHora();
                    
                    $('[id^=CheckLinha]').click(function() {
                        vCBRCodigoDaLinha = this.id.substr(10,6);
                        console.log('CheckLinha');
                        console.log(vCBRCodigoDaLinha);
                        SomaHora();    
                    });
                    
                    
                    
                    
                    // toggleMarcarTodos();
                    removeSpinner();
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
                    
                    InputObs = "#eInputFMC_Obs" + pFMC_CBRCodigo;                        
                    ArrayLinhatabFmcFolha.push({
                        "FMC_CBRCodigo": pFMC_CBRCodigo,
                        "FMC_RemuneraValor": pFMC_RemuneraValor,
                        "FMC_FlgRemuneraQuebrado": pFMC_FlgRemuneraQuebrado,
                        "FMC_CBUCodigo": pFMC_CBUCodigo, 
                        "FMC_Mes": vMes,
                        "FMC_Status": 'F',
                        "FMC_Observacao": $(InputObs).val(),
                        "FMC_MomFechamento": MomentoAgora(),
                        "FMC_USUCodigo": <?php echo $this->session->userdata('userCodigo'); ?>
                    });

                    $.ajax({
                        url: "<?php echo base_url(); ?>financeiro/FmcLista/NewFMC",
                        type: 'POST',
                        data: {
                            ArrayLinhatabFmcFolha: ArrayLinhatabFmcFolha
                        }
                    });
                    // Swal.fire(
                    //     'Salva(s) a(s) alteração(ões) na pré-fatura.',
                    //     '',
                    //     'success'
                    // ).then(() => {
                    //     // location.reload();
                    //     listar();
                    // });                    
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
            return today
        }

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tabFmcFolha");
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

		var $rows = $('#tabFmcFolha tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});
        
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

        $('.marcarTodos').click(toggleMarcarTodos);

        function toggleMarcarTodos(event) {
            var $tabela = $("#tabFmcFolha");
            var check = $(".marcarTodos", $tabela).is(':checked');
            var $checks = $('.marcar', $tabela);            
            event && event.stopPropagation();            
            $checks.each(function () {
                $(this).prop("checked", check);
            });
            SomaHora();
        }

        function SomaHora() {
            var vcolTraTota = 0.00;
            var vcolValTota = 0.00;
            var vcolTraGlos = 0.00;
            $('#tabFmcFolha').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var estaCheckado = $tds.eq(8).find('input[type="checkbox"]').is(":checked") ? 1 : 0;
                if (estaCheckado==1) {
                    vcolTraTota += parseFloat($tds.eq(3).text());
                    vcolValTota += parseFloat($tds.eq(5).text());
                    vcolTraGlos += parseFloat($tds.eq(6).text());
                }                                
            });
            console.log(vcolTraTota);
            console.log(vcolValTota);
            console.log(vcolTraGlos);
            $('#spanSomaTraTota').text(vcolTraTota.toFixed(2));
            $('#spanSomaValTota').text(vcolValTota.toFixed(2));
            $('#spanSomaTraGlos').text(vcolTraGlos.toFixed(2));            
        }

        function MesAnoAnterior(){
            var data = new Date(),                
                mes  = (data.getMonth()+0).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
                ano  = data.getFullYear();
            return mes+"/"+ano;
        }
        
        function setInputTextHints() {
            
            $('#colCbrNome').prop('title', 'Nome do Colaborador.\nApelido do Colaborador, no Cadastro de Pessoas.');
            $('#colCbrCodi').prop('title', 'Id do Colaborador.\nCódigo do Colaborador no Cadastro de Pessoas.');
            $('#colCbrCarg').prop('title', 'Cargo do Colaborador.\nCargo institucional ocupado pelo Colaborador -\ndiferente do cargo ocupado pelo Colaborador\nnos Planos de Serviços que participa.');
            $('#colCbrRemu').prop('title', 'Remuneração do Colaborador.\nValor e forma (hora, mês etc) de remuneração do colaborador.');
            $('#colTraTota').prop('title', 'Trabalho no período.\nTrabalho em horas do Colaborador durante\no período. Já descontadas as horas glosadas.');
            $('#colTraGlos').prop('title', 'Horas glosadas no período.\nValor em horas glosadas do Colaborador durante\no período.');
            $('#colValTota').prop('title', 'Valor em R$ da folha para o Colaborador.');
            
            $('#colMarcada').prop('title', 'Clique para marcar o Colaborador para Fechar a folha.');                       

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

