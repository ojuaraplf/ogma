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
    <title>Ogma Pré-folha </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        
        /* #tableListaPjt tbody tr {
            cursor: pointer;
        } */
        
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
                        <h3 class="page-title"> <i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pré-pagamento </h3>
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
                            <h5> Pesquisa por apontamentos não pré-pagos. </h5>
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
                <div class="row" id="divListaPjt">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">                                
                                    <div class="col-12">
                                        <span id="spanDoTexto" class="card-title">Apontamentos não pré-pagos. </span>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar na lista</label>
                                        <input type="text" class="form-control" id="inputTextFiltro"/>
                                    </div>
                                    <br />
                                    <table class="table table-hover table-sm" id="tableListaPjt">
                            
                                        <thead>
                                            <tr>
                                                <th id='colCbrApel'> COLABORADOR<br/>Nome/Apelido</th>
                                                <th id='colCliApel'> CLIENTE<br/>Nome Fantasia</th>
                                                <th id='colPjtApel'> PLANO<br/>Apelido</th>
                                                <td id='colAtgDesc'> ATIVIDADE / CHAMADO<br/>Descrição</td>
                                                <td id='colFNaoApo'> <i class="mdi mdi-rowing"></i></td>
                                                <td id='colFNaoDat'> <i class="mdi mdi-calendar"></i></td>
                                                <td id='colFSimApo'> <i class="mdi mdi-rowing"></i></td>
                                                <td id='colFSimDat'> <i class="mdi mdi-calendar"></i></td>                                                
                                                <th id='colAlRenew'> <button class="btn btn-clear" onclick=AutoRenew()> <i class="mdi mdi-autorenew"></i> </button> </th>
                                                <th id='colVerDeta'> <i class="mdi mdi-playlist-check"></i> </th>
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

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>

    <script type="text/javascript">
        removeSpinner();
        $('#liFinanceiro').addClass('selected');
        $('#liFmcPrePagar').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divListaPjt').hide();
        // $('#divListaChd').hide();
        
        var arrayLista = [];
        var ArrayGeraKey = [];
        var table = $('#tableListaPjt').DataTable();
        var vCBRid = 0;
        var vCLIid = 0;
        var vPJTid = 0;
        var vATGid = 0;
        var vAgrupaCBR = 1;
        var vAgrupaCLI = 0;
        var vAgrupaPJT = 0;
        var vAgrupaATG = 0;
        var vAgrupaLCT = 0;
        var vData1 = null;
        var vUltDia = null;
        var vData2 = null;        

        var vTextoCabeca = 'Apontamentos não pré-pagos:';

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vHelpOptionMes = 'Informe o mês de referência.';
        var vHelpcheckSoFatPjt = 'Marque para considerar apenas apontamentos de Planos de Serviço com tipo de faturamento definido - diferente de "0".';
        var vHelpcheckSoFatAtg = 'Marque para considerar apenas apontamentos de Atividades definidas como faturáveis.';
        var vHelpcheckSoFatLct = 'Marque para considerar apenas apontamentos que ainda não foram pré-faturados.';
        
        setInputTextHints();
        ListaNaMarra();
        function ListaNaMarra() {
            
            if ($('#eOptionMes').val() == "") {
                Swal.fire(
                    'Aviso',
                    vHelpOptionMes,
                    'warning'
                )
                return;
            }

            vCBRid = vCBRid;
            vCLIid = vCLIid;
            vPJTid = vPJTid;
            vATGid = vATGid;
            vAgrupaCBR = vAgrupaCBR;
            vAgrupaCLI = vAgrupaCLI;
            vAgrupaPJT = vAgrupaPJT;
            vAgrupaATG = vAgrupaATG;
            vAgrupaLCT = vAgrupaLCT;
            vData1 = ($('#eOptionMes').val()).substring(3, 7)+'-'+($('#eOptionMes').val()).substring(0, 2)+'-01';
                vUltDia = daysInMonth(($('#eOptionMes').val()).substring(0, 2)-1,($('#eOptionMes').val()).substring(3, 7));
            vData2 = ($('#eOptionMes').val()).substring(3, 7)+'-'+($('#eOptionMes').val()).substring(0, 2)+'-'+vUltDia;            

            console.log('vCLIid');
            console.log(vCLIid);
            console.log('vPJTid');
            console.log(vPJTid);
            console.log('vData1');
            console.log(vData1);
            console.log('vData2');
            console.log(vData2);

            loadSpinner();
            $('#tableListaPjt').DataTable().clear().destroy();
            table = $('#tableListaPjt').DataTable({
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
                        exportOptions: {
                            columns: ':visible',
                            // format: {
                            //     body: function(data, row, column, node) {
                            //         data = $.isNumeric(data) ? data : '="' + data.replace('<br />', '"&CARACT(10)&"') + '"';
                            //         // return $.isNumeric(data) ? data : data.replace('<br />', '&CARACT(10)&');
                            //         //return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
                            //         //return data.replace('<br />', '&CARACT(10)&');
                            //         return data;
                            //         }
                            // }
                        }
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
                    url: "<?php echo base_url(); ?>financeiro/FmcLista/fetchFmcPrePagar",
                    type: 'POST',
                    data: {
                        vCBRid: vCBRid,
                        vCLIid: vCLIid,
                        vPJTid: vPJTid,
                        vATGid: vATGid,
                        vAgrupaCBR: vAgrupaCBR,
                        vAgrupaCLI: vAgrupaCLI,
                        vAgrupaPJT: vAgrupaPJT,
                        vAgrupaATG: vAgrupaATG,
                        vAgrupaLCT: vAgrupaLCT,
                        vData1: vData1,
                        vData2: vData2
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divListaPjt').show();
                        console.log(response);
                    }
                },

                
                language: {
                    //url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
                    
                },
                order: [
                    [0, "asc"]
                ],
                rowId: 'PJT_CODIGO',

                columns: [
                    {
                        "data": "CONS_APELIDO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "CLI_APELIDO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "PJT_APELIDO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "ATG_DESCRICAO",
                        "defaultContent": "",
                        className: "text-left"
                    },                    
                    {
                        "data": "FATURAVEL_NAO_APON_ANTES",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "FATURAVEL_NAO_PERIODO",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {
                            return data == null ? "-" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4)+ "\n"+data.substring(27, 29) + "/" + data.substring(24, 26)+ "/" + data.substring(19, 23);
                        }
                    },
                    {
                        "data": "FATURAVEL_SIM_APON_ANTES",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "FATURAVEL_SIM_PERIODO",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {                            
                            return data == null ? "-" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4)+ "\n"+data.substring(27, 29) + "/" + data.substring(24, 26)+ "/" + data.substring(19, 23);
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            var Drill_Dow = "Drill_Dow('" + row.CONS_CODIGO + "','" + row.CLI_CODIGO + "','" + row.PJT_CODIGO + "','" + row.ATG_CODIGO + "','" + row.p_AgrupaCLI + "','" + row.p_AgrupaPJT +  "','" + row.p_AgrupaATG + "')";
                            var Drill_Up = "Drill_Up('" + row.CONS_CODIGO + "','" + row.CLI_CODIGO + "','" + row.PJT_CODIGO + "','" + row.ATG_CODIGO + "','" + row.p_AgrupaCLI + "','" + row.p_AgrupaPJT +  "','" + row.p_AgrupaATG + "')";                            
                            return '<button class="btn btn-clear" onclick="' + Drill_Dow + '"> <i class="mdi mdi-chevron-double-down"></i> </button>\n<button class="btn btn-clear" onclick="' + Drill_Up + '"> <i class="mdi mdi-chevron-double-up"></i> </button>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            var chamaFmcCriar = "chamaFmcCriar('" + row.CONS_CODIGO + "','" + row.CLI_CODIGO + "','" + row.PJT_CODIGO + "','" + row.ATG_CODIGO + "','" + row.p_AgrupaPJT + "','" + row.p_AgrupaATG + "')";
                            return '<button class="btn btn-clear" onclick="' + chamaFmcCriar + '"> <i class="mdi mdi-playlist-check"></i> </button>';
                        }
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                columnDefs: [
                    {
                        "width": "18%",
                        "targets": [0],
                    },
                    {
                        "width": "18%",
                        "targets": [1],
                    },
                    {
                        "width": "18%",
                        "targets": [2],
                    },
                    {
                        "width": "18%",
                        "targets": [3],
                    },
                    {
                        "width": "5%",
                        "targets": [4],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                        }
                    },
                    {
                        "width": "8%",
                        "targets": [5],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                        }
                    },
                    {
                        "width": "5%",
                        "targets": [6],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                        },
                    },
                    {
                        "width": "8%",
                        "targets": [7],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                        },
                    },
                    {
                        "width": "1%",
                        "targets": [8],
                    },
                    {
                        "width": "1%",
                        "targets": [9],
                    },
                    {   "render": function(data){
                        return parseFloat(data).toLocaleString('pt-br', {minimumFractionDigits: 2});
                        },
                        "targets": [4 ,6]
                    }
                ],

            });

        }

        function Drill_Dow(idCBR, idCLI, idPJT, idATG, agCLI, agPJT, agATG, pLinhaId ) {

            console.log('id');
            console.log(idCBR);
            console.log(idCLI);
            console.log(idPJT);
            console.log(idATG);

            console.log('AGRUPA');
            console.log(agCLI);
            console.log(agPJT);
            console.log(agATG);


            var IdDowLinha = "#dow"+pLinhaId;
            

            //console.log('pLinhaId');
            //console.log(pLinhaId);
            //console.log('IdDowLinha');
            //console.log(IdDowLinha);
          
            if (agCLI == 1 && agPJT == 1 && agATG == 0 ) {
                console.log('entrei no 110');
                vCBRid = idCBR;
                vCLIid = idCLI;
                vPJTid = idPJT;
                vATGid = 0;
                vAgrupaCBR = 1;
                vAgrupaCLI = 1;
                vAgrupaPJT = 1;
                vAgrupaATG = 1;
                // $('#spanDoTexto').text(vTextoCabeca + ' Plano: ' +nmPJT);                    
                ListaNaMarra();
            } else if (agCLI == 1 && agPJT == 0 && agATG == 0) {
                console.log('entrei no 100');
                vCBRid = idCBR;
                vCLIid = idCLI;
                vPJTid = 0;
                vATGid = 0;
                vAgrupaCBR = 1;
                vAgrupaCLI = 1;
                vAgrupaPJT = 1;
                vAgrupaATG = agATG;
                // $('#spanDoTexto').text(vTextoCabeca + ' Plano: ' +nmPJT);                
                ListaNaMarra();
                document.getElementById(eval(IdDowLinha)).disabled = true;
            } else if (agCLI == 0 && agPJT == 0 && agATG == 0) {
                console.log('entrei no 000');
                vCBRid = idCBR;
                vCLIid = 0;
                vPJTid = 0;
                vATGid = 0;
                vAgrupaCBR = 1;
                vAgrupaCLI = 1;
                vAgrupaPJT = agPJT;
                vAgrupaATG = agATG;
                // $('#spanDoTexto').text(vTextoCabeca + ' Plano: ' +nmPJT);
                ListaNaMarra();
            } else {
                beep();
            }
        }

        function Drill_Up(idCBR, idCLI, idPJT, idATG, agCLI, agPJT, agATG) {
          
            console.log('id');
            console.log(idCBR);
            console.log(idCLI);
            console.log(idPJT);
            console.log(idATG);

            console.log('AGRUPA');
            console.log(agCLI);
            console.log(agPJT);
            console.log(agATG);
          
            if (agCLI == 1 && agPJT == 0 && agATG == 0) {
                console.log('entrei no 100');
                vCBRid = 0;
                vCLIid = 0;
                vPJTid = 0;
                vATGid = 0;
                vAgrupaCBR = 1;
                vAgrupaCLI = 0;
                vAgrupaPJT = 0;
                vAgrupaATG = 0;
                // $('#spanDoTexto').text(vTextoCabeca + ' Plano: ' +nmPJT);
                ListaNaMarra();
            } else if (agCLI == 1 && agPJT == 1 && agATG == 0) {
                console.log('entrei no 110');
                vCBRid = idCBR;
                vCLIid = 0;
                vPJTid = 0;
                vATGid = 0;
                vAgrupaCBR = 1;
                vAgrupaCLI = 1;
                vAgrupaPJT = 0;
                vAgrupaATG = 0;
                // $('#spanDoTexto').text(vTextoCabeca + ' Plano: ' +nmPJT);
                ListaNaMarra();
            } else if (agCLI == 1 && agPJT == 1 && agATG == 1 ) {
                console.log('entrei no 111');
                vCBRid = idCBR;
                vCLIid = idCLI;
                vPJTid = 0;
                vATGid = 0;
                vAgrupaCBR = 1;
                vAgrupaCLI = 1;
                vAgrupaPJT = 1;
                vAgrupaATG = 0;
                // $('#spanDoTexto').text(vTextoCabeca + ' Plano: ' +nmPJT);
                ListaNaMarra();
            } else {
                beep();
            }
      }

        function AutoRenew() {

            vCBRid = 0;
            vCLIid = 0;
            vPJTid = 0;
            vATGid = 0;
            vAgrupaCBR = 1;
            vAgrupaCLI = 0;
            vAgrupaPJT = 0;
            vAgrupaATG = 0;            
            $('#spanDoTexto').text(vTextoCabeca);
            ListaNaMarra();
        }

        // var selectedLinha = "";
        // $(document).on('click', '#tableLista > tbody > tr ', function() {

        //   selectedLinha = arrayLista[table.row(this).index()];
        //   console.log(selectedLinha.CLI_CODIGO);
        //   console.log(selectedLinha.CLIENTE_APELIDO);
        //   // window.open('<!?php echo base_url('detalheChamado/') ?>' + selectedLinha.NUMERO, '_self');

        // });

        $('#eOptionMes').change(function() {
            ListaNaMarra();
        });

        $('#eOptionMes').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            orientation: 'bottom'
        });

        function chamaFmcCriar(idCBR, idCLI, idPJT, idATG, agPJT, agATG) {

            console.log(idCBR);
            console.log(idCLI);            
            console.log(idPJT);
            console.log(idATG);
            console.log(agPJT);
            console.log(agATG);

            if ( agPJT != 0 ) {

                vIdCBR = idCBR;
                vIdCLI = idCLI;
                vIdPJT = idPJT;
                vIdATG = idATG;
                vAgCBR = 1;
                vAgCLI = 1;
                vAgPJT = 1;
                vAgATG = agATG;
                vAgLCT = 0;
                vData1 = vData1;
                vData2 = vData2;

                window.location.replace("<?php echo base_url(); ?>FmcCriar?aIdCBR="+vIdCBR +
                                                        "&aIdCLI="+vIdCLI +
                                                        "&aIdPJT="+vIdPJT +
                                                        "&aIdATG="+vIdATG +
                                                        "&aAgCBR="+vAgCBR +
                                                        "&aAgCLI="+vAgCLI +
                                                        "&aAgPJT="+vAgPJT +
                                                        "&aAgATG="+vAgATG +
                                                        "&aAgLCT="+vAgLCT +
                                                        "&aData1="+vData1 +
                                                        "&aData2="+vData2
                                                        );
            } else {
                beep();
            };
        };

        function daysInMonth(iMonth, iYear){
            return 32 - new Date(iYear, iMonth, 32).getDate();
        };

        function beep() {
            var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
            snd.play();
        }

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableListaPjt");
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
        
        function setInputTextHints() {

            $('#eOptionMes').prop('title', vHelpOptionMes );

            
            $('#colCbrApel').prop('title', "Nome/apelido do Colaborador." );
            $('#colCliApel').prop('title', "Nome Fantasia do Cliente." );            
            $('#colPjtApel').prop('title', "Apelido do Plano de Serviços." );
            $('#colAtgDesc').prop('title', "Descriçao da Atividade/Chamado" );
            $('#colFNaoApo').prop('title', "Número de horas apontadas\nsem pré-pagamento\npara atividades NÃO faturáveis." );
            $('#colFNaoDat').prop('title', "Primeiro e último apontamento\npara atividades NÃO faturáveis." );
            $('#colFSimApo').prop('title', "Número de horas apontadas\nsem pré-pagamento\npara atividades FATURÁVEIS." );
            $('#colFSimDat').prop('title', "Primeiro e último apontamento\npara atividades FATURÁVEIS." );

            $('#colVerDeta').prop('title', 'Ir para apontamentos e pré-pagamento.\n\nEm cada linha:\nClique em nível do Plano de Serviço (PPD, PPS etc)\npara ver apontamento(s) dele.\n\nClique em nivel da Atividade/Chamado\npara ver apontamento(s) dela.');
            $('#colAlRenew').prop('title', "Voltar ao nível de Colaboradores\n(Primeiro nível).\n\nEm cada linha:\nClique em ↓ para drill down.\nClique em ↑ para drill up:\nCOLABORADOR\n     ↨\nCLIENTE\n     ↨\nPLANO\n     ↨\nATIVIDADE/CHAMADO");
            
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
