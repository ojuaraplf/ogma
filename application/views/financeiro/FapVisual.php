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
    <title>Pré-faturas para faturar </title>

    <?php $this->load->view('include/headerTop') ?>
    <style>        
        #tabFapVisual tbody tr {
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
                        <h3 class="page-title"> <i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i> Pré-fatura: Fechar </h3>
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
                                    <div class="col-2">
                                        <label for="selectFAP_Status" class="text-left control-label col-form-label">Status do Pré-faturamento</label>
                                        <select class="form-control" id="selectFAP_Status">
                                            <option value="A"> A faturar</option>
                                            <option value="F"> Faturado</option>
                                            <option value="H"> Em Homologação</option>
                                            <option value="N"> Não faturar</option>                                            
                                        </select>
                                    </div>
                                </div>
                                <!-- <br />
                                <div class="row">
                                    <div class="col-3">
                                        <button class="btn btn-primary" id="buttonListar"> Listar </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divListaFap">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">                                
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Pré-faturas para faturar </h4>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
                                            <input type="text" class="form-control" id="inputTextFiltro"/>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="tabFapVisual">
                                        <thead>
                                            <tr>
                                                <th id='colFapCodi'> Pré-Fatura</th>
                                                <th id='colFapUsua'> Emissor</th>
                                                <th id='colFapDesc'> Descrição </th>
                                                <th id='colFapStat'> <i class="mdi mdi-nest-thermostat"></i></th>
                                                <th id='colNotNume'> NF </br> Num.</th>
                                                <th id='col___Data'> Data </th>
                                                <th id='col___Inic'> Período </br> Início </th>
                                                <th id='col___Term'> Período </br> Término </th>
                                                <th id='colTrabalh'> <i class="mdi mdi-rowing"></i></th>
                                                <th id='col___Valor'> Valor </th>
                                                <th id='colParcOrde'> # </th>
                                                <th id='colParcTota'> De </th>
                                                <th id='colVhSysCod'> vhsys </th>
                                                <td id="colBotSalva"><i class="mdi mdi-content-save"></i></td>
                                                <td id="colBotApaga"><i class="mdi mdi-delete"></i></td>                                                
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
       
        $('#liFinanceiro').addClass('selected');
        $('#liFapFechar').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divListaFap').hide();
                
        var arrayLista = [];
        var table = $('#tabFapVisual').DataTable();
        var vAbreAponta = null;
        var vFAPStatus = 'A';
        // var vFAPStatusDepois = 'F';
                
        setInputTextHints();
        listar();

        function listar() {

            vAbreAponta = 0;

            loadSpinner();
            $('#tabFapVisual').DataTable().clear().destroy();
            table = $('#tabFapVisual').DataTable({
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
                    url: "<?php echo base_url(); ?>financeiro/FapLista/fetchFapVisual",
                    type: 'POST',
                    data: {
                        vFAPStatus: vFAPStatus,
                        vAbreAponta: vAbreAponta
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divListaFap').show();
                        console.log(response);
                    }
                },
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [1, "asc"]
                ],
                rowId: 'FAP_ID',
                columns: [
                    {
                        "data": "FAP_ID",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "USUARIO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "FAP_DESCRICAO",
                        "defaultContent": "",
                        className: "text-left",
                    },
                    {
                        "data": "FAP_STATUS",
                        "defaultContent": "",
                        className: "text-center"                    
                    },
                    {
                        "data": "FAP_NF",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            return row.FAP_STATUS == 'A' || row.FAP_STATUS == 'H' ? '<input type="text" value=' + row.FAP_NF + ' class="form-control" id="eInputFAP_NF' + row.FAP_ID + '" />' : '<input type="text" value=' + row.FAP_NF + ' disabled class="form-control" id="eInputFAP_NF' + row.FAP_ID + '" />';
                        }
                    },
                    {
                        "data": "FAP_DATA",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {
                            return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
                        }
                    },
                    {
                        "data": "FAP_INICIO",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {
                            return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
                        }
                    },
                    {
                        "data": "FAP_TERMINO",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {
                            return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
                        }
                    },
                    {
                        "data": "TOTAL_HORAS_REFERENCIA",
                        "defaultContent": "",
                        className: "text-right"                        
                    },
                    {
                        "data": "FAP_VALOR",
                        "defaultContent": "",
                        className: "text-right",
                    },
                    {
                        "data": "PARC_ORDEM",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "PARC_TOTAL",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "FAP_VhSysFaturaId",
                        "defaultContent": "",
                        className: "text-center",
                        visible: false
                    },
                    {
                    "data": "",
                    "defaultContent": "",
                    className: "text-center",
                        render: function(data, type, row) {
                            var NFEditada = $('#eInputFAP_NF' + row.FAP_ID ).val();
                            console.log(row.FAP_ID);
                            console.log(NFEditada); 
                            var FAPSalvaItem = "updateRow('" + row.FAP_ID + "','" + row.PARC_ORDEM + "','" + row.PARC_TOTAL +  "','" + row.FAP_STATUS + "')"; 
                            return row.FAP_STATUS == 'A' || row.FAP_STATUS == 'H' ? '<button class="btn btn-clear" onclick="' + FAPSalvaItem + '"> <i class="mdi mdi-content-save"></i> </button>' : '<button class="btn btn-clear" disabled onclick="' + FAPSalvaItem + '"> <i class="mdi mdi-content-save"></i> </button>';
                            // return row.FAP_VhSysFaturaId == null ? '<input type="buton" id="butonApagaPAF">' : '<input type="buton" id="butonApagaPAF" checked >' ;
                        }
                    },
                    {
                    "data": "",
                    "defaultContent": "",
                    className: "text-center",
                        render: function(data, type, row) {
                            var FAPApagaItem = "FAPApagaItem('" + row.FAP_ID + "')";
                            return row.FAP_STATUS == 'A' ? '<button class="btn btn-clear" onclick="' + FAPApagaItem + '"> <i class="mdi mdi-delete"></i> </button>' : '<button class="btn btn-clear" disabled onclick="' + FAPApagaItem + '"> <i class="mdi mdi-delete"></i> </button>';
                            // return row.FAP_VhSysFaturaId == null ? '<input type="buton" id="butonApagaPAF">' : '<input type="buton" id="butonApagaPAF" checked >' ;
                        }
                    }

                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                columnDefs: [
                    {
                        "width": "1%",
                        "targets": [0]
                    },
                    {
                        "width": "5%",
                        "targets": [1]
                    },
                    {
                        "width": "43%",
                        "targets": [2]
                    },
                    {
                        "width": "1%",
                        "targets": [3]
                    },
                    {
                        "width": "8%",
                        "targets": [4]
                    },
                    {
                        "width": "8%",
                        "targets": [5]
                    },
                    {
                        "width": "8%",
                        "targets": [6]
                    },
                    {
                        "width": "8%",
                        "targets": [7]
                    },
                    {
                        "width": "10%",
                        "targets": [8]
                    },
                    {
                        "width": "5%",
                        "targets": [9]
                    },
                    {
                        "width": "1%",
                        "targets": [10]
                    },
                    {
                        "width": "1%",
                        "targets": [11]
                    },
                    {
                        "width": "1%",
                        "targets": [12]
                    },
                    {
                        "width": "1%",
                        "targets": [13]
                    },
                    {
                        "width": "1%",
                        "targets": [14]
                    },
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                        },
                        "targets": [8 ,9]
                    }
                ],

            });

        };

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tabFapVisual");
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

		var $rows = $('#tabFapVisual tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});
        
        $('#selectFAP_Status').change(function() {
            vFAPStatus = $('#selectFAP_Status').val();
            listar();
        });

        function FAPApagaItem(pFAP_ID) {
            
            Swal.fire({
                title: 'Deseja mesmo apagar a pré-fatura?',
                text: 'Ela e seus apontamentos de referência estarão disponíveis para novo pré-faturamento.',
                showDenyButton: true,
                confirmButtonText: 'Confirmar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Estou dentro');
                        console.log(pFAP_ID);
                        loadBlurSpinner();
                        $.ajax({
                            url: "<?php echo base_url(); ?>financeiro/FapLista/FAPApagaItem",
                            type: 'POST',
                            data: {
                                pFAP_ID: pFAP_ID
                            },
                            success:function(){
                                location.reload();
                            }
                        })
                        // location.reload();
                    };
                });
        }

        function updateRow(pFAP_ID, pPARC_ORDEM, pPARC_TOTAL, paFAP_STATUS ) {
  
            
            Swal.fire({
                title: 'Salvar e mudar o status da Pré-fatura?',
                text: 'O novo status será "Faturado"',
                showDenyButton: true,
                confirmButtonText: 'Confirmar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                if (result.isConfirmed) {
                    var pFAP_NF = $('#eInputFAP_NF' + pFAP_ID).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>financeiro/FapLista/UpdateFapRow",
                        type: 'POST',
                        data: {
                            pFAP_ID: pFAP_ID,
                            pFAP_NF: pFAP_NF,
                            pPARC_ORDEM: pPARC_ORDEM,
                            pPARC_TOTAL: pPARC_TOTAL,
                            pFAP_STATUS: 'F'
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

                    // var vNovoStatus = paFAP_STATUS == 'A' ? 'H' : 'F';
                    // $("#selectFAP_Status").val(vNovoStatus);
                    // vFAPStatus = vNovoStatus;
                    listar();
                }
            })            
        }

        function setInputTextHints() {
            
            $('#selectFAP_Status').prop('title', 'Selecione o Status do Pre-faturamento.' );

            $('#colFapCodi').prop('title', 'Código (Id) da Pré-fatura (FAP).' );
            $('#colFapUsua').prop('title', 'Nome (apelido) do usuário emissor da FAP.' );
            $('#colFapDesc').prop('title', 'Descrição da Pré-fatura.' );
            $('#colFapStat').prop('title', 'Status do Pré-faturamento:\nA = A faturar;\nF = Faturado;\nH = Em Homologação;\nN = Não faturar.');
            $('#colNotNume').prop('title', 'Número da Nota Fiscal/Fatura emitida para o Pré-faturamento.\nInforme ou altere.' );
            $('#col___Data').prop('title', 'Data de emissão da Pré-fatura.' );
            $('#col___Inic').prop('title', 'Data inicial do período de referência da Pré-fatura.' );
            $('#col___Term').prop('title', 'Data final do período de referência da Pré-fatura.' );
            $('#colTrabalh').prop('title', 'Trabalho total em horas apontadas no período de referência.' );
            $('#col___Valor').prop('title', 'Valor da Pré-fatura.' );
            $('#colParcOrde').prop('title', 'Número de ordem da parcela pré-faturada.' );
            $('#colParcTota').prop('title', 'Número total de parcelas da Pré-fatura.' );
            $('#colBotSalva').prop('title', 'Clique para salvar a(s) alteração(ões) na Pré-fatura.' );
            $('#colBotApaga').prop('title', 'Clique para excluir a Pré-fatura.\nEla e os apontamentos estarão novamente disponíveis para novo pré-faturamento.' );            
            
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
