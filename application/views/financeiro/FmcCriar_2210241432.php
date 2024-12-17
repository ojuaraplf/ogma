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
    <title> Pré-pagamento Criar </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        html {
        visibility: hidden;
        }
        #align_left {
        text-align: left;
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
                        <h3 class="page-title"> <i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pré-pagamento: Criar </h3>
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
         
            
            <div class="card">
                <div class="card-body">
                    <hr/>
                    <h5> Dados para o pré-pagamento:</h5>
                    <div class="row mb-3">
                        <div class="col-2">
                            <label for="eInputPER_INICIO" class="text-left control-label col-form-label" id="lInputPER_INICIO" >Início:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->PER_INICIO; ?>" id="eInputPER_INICIO" disabled />
                        </div>
                        <div class="col-2">
                            <label for="eInputPER_TERMINO" class="text-left control-label col-form-label" id="lInputPER_TERMINO" >Término:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->PER_TERMINO; ?>" id="eInputPER_TERMINO" disabled />
                        </div>
                        <div class="col-5">
                            <label for="eInputCONS_APELIDO" class="text-left control-label col-form-label" id="lInputCONS_APELIDO" >Colaborador:</label>
                            <input type="text" class="form-control font-weight-bold" value="<?php echo $cabecaPjt->CONS_APELIDO; ?>" id="eInputCONS_APELIDO" disabled />
                        </div>
                        <div class="col-3">
                            <label for="eInputCONS_CARGO" class="text-left control-label col-form-label" id="lInputCONS_CARGO" >Cargo:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->CONS_CARGO; ?>" id="eInputCONS_CARGO" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="eInputCLI_APELIDO" class="text-left control-label col-form-label" id="lInputCLI_APELIDO" >Cliente:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->CLI_APELIDO; ?>" id="eInputCLI_APELIDO" disabled />
                        </div>
                        <div class="col-4">
                            <label for="eInputPJT_APELIDO" class="text-left control-label col-form-label" id="lInputPJT_APELIDO" >Plano de Serviços:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->PJT_APELIDO; ?>" id="eInputPJT_APELIDO" disabled />
                        </div>
                        <div class="col-4">
                            <label for="eInputATG_DESCRICAO" class="text-left control-label col-form-label" id="lInputATG_DESCRICAO" >Atividade/Chamado:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->ATG_DESCRICAO; ?>" id="eInputATG_DESCRICAO" disabled />
                        </div>
                    </div>
                    <hr/>



                    <div class="row mb-3">
                        <div class="col-9">
                            <label for="eInputObservacao" class="text-left control-label col-form-label" id="lInputObservacao"> Observações: </label>
                            <textarea type="text" class="form-control" rows="1" id="eInputObservacao"></textarea>
                        </div>
                        <div class="col-1">
                            <label for="eInputCONS_U_REMUNERA" class="text-left control-label col-form-label" id="lInputCONS_U_REMUNERA" >Unidade:</label>
                            <input type="text" class="form-control" style="background-color: #DCDCDC; text-align:center;" value="<?php echo $cabecaPjt->CONS_U_REMUNERA; ?>" id="eInputCONS_U_REMUNERA" disabled />
                        </div>
                        <div class="col-2">
                            <label for="vSpanQtdeTotal" class="text-left control-label col-form-label" id="lSpanQtdeTotal" >Trabalho (h):</label>
                            <span id="vSpanQtdeTotal" class="form-control  font-weight-bold" style="background-color: #DCDCDC; text-align:right;" disabled >-</span>
                        </div>
                        <!--
                        <div class="col-2">
                            <label for="eInputTRAB_VRHORA" class="text-left control-label col-form-label" id="lInputTRAB_VRHORA" >Valor Unitário (R$):</label>
                            <input type="text" class="form-control" style="background-color: #DCDCDC; text-align:right;" value="<!?php echo $cabecaPjt->TRAB_VRHORA; ?>" id="eInputTRAB_VRHORA" disabled />
                        </div>
                        <div class="col-2">
                            <label for="vSpanValorTotal" class="text-left control-label col-form-label" id="lSpanValorTotal" >Valor Total (R$):</label>
                            <span id="vSpanValorTotal" class="form-control" style="background-color: #DCDCDC; text-align:right;" disabled>-</span>
                        </div>
                        -->
                    </div>
                    
                    <hr/>
                    <div class="row">                        
                        <div class="col-6">
                            <button class="btn btn-primary" disabled style="font-size : 20px; width: 100%; height: 50px; border-color: LightGrey; background-color: LightGrey;" id="buttonVazio"></button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary" onclick="voltar()"  style="font-size : 20px; width: 100%; height: 50px; border-color: SlateGray; background-color: SlateGray;" id="buttonVoltar"> Voltar </button>
                        </div>
                        <div class="col-3">                            
                            <button class="btn btn-primary" style="font-size : 20px; width: 100%; height: 50px; border-color: #B22222; background-color: #B22222;" id="buttonGerar"> Criar Pré-pagamento </button>
                        </div>
                    </div>
                </div>    
            </div>

            <div class="row" id="divListaPjt">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-9">
                                        <h5 class="card-title">Apontamento de horas no período para o Plano de Serviço </h5>
                                    </div>                                                                   
                                </div>
                                <table class="table table-hover table-sm" id="tableListaApo">
                                    <thead>
                                        <tr>
                                            <td id='colLctCodi'> ID</td>
                                            <td id='colLctDesc'> ATIVIDADE<br/>Descrição do apontamento</td>
                                            <td id='colFNaoApo'> <i class="mdi mdi-rowing"></i><br/><span id="spanSomaPgtN" >-</span></td>
                                            <td id='colFNaoDat'> <i class="mdi mdi-calendar"></i></td>
                                            <td id='colFSimApo'> <i class="mdi mdi-rowing"></i><br/><span id="spanSomaPgtS" >-</span></td>
                                            <td id='colFSimDat'> <i class="mdi mdi-calendar"></i></td>
                                            <td id='colGAnalis'> <i class="mdi mdi-glasses"></i></td>
                                            <td id='colGTraApo'> <i class="mdi mdi-rowing"></i><br/>Apo</td>
                                            <td id='colGTraGlo'> <i class="mdi mdi-rowing"  style="color:red"></i><br/>Glo</td>
                                            <td id='colGTraTot'> <i class="mdi mdi-rowing"></i><br/>Tot</td>
                                            <th><input type="checkbox" id="colMarcada" class="marcarTodos" /></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
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
    <?php $this->load->view('modal/modalFmcGlosaMotivo') ?>
    <?php $this->load->view('modal/modalFmcGlosaAptmtos') ?>
        

    <script type="text/javascript">
        removeSpinner();
                    
        var arrayFmcGloMotivo = [];
        var linhaQueClicouNaTabela = [];
        var linhaProModal = [];
        var pData1 = $('#eInputPER_INICIO').val();
        var pData2 = $('#eInputPER_TERMINO').val();
        $("#eInputPER_INICIO").val(DataEuaBra($("#eInputPER_INICIO").val()));
        $("#eInputPER_TERMINO").val(DataEuaBra($("#eInputPER_TERMINO").val()));

        const NomeMes = ["JANEIRO", "FEVEREIRO", "MARÇO", "ABRIL", "MAIO", "JUNHO",
        "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO", "DEZEMBRO"];        
        
        $('#buttonGerar').click(function() {
            
            var wFmcMesRef = getTextMesAno(pData2);
            var wFmcCbrNome = $('#eInputCONS_APELIDO').val();
            var wPPx = $('#eInputPJT_APELIDO').val();
            var wFmcTrabalho = $('#vSpanQtdeTotal').text();
            var textomsg =  'Colaborador: ' + wFmcCbrNome +
                            ';<br/>Plano: ' + wPPx +
                            ';<br/>Referência: ' + wFmcMesRef +
                            ';<br/>Trabalho (h): ' + wFmcTrabalho +
                            '.';
            Swal.fire({
                title: 'Confirma pré-pagamento ?',
                html: '<div id="align_left">' + textomsg + '</div>',
                showDenyButton: true,
                confirmButtonText: 'Confirmar',
                denyButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    loadBlurSpinner();
                    // $.when( UpdateGeraFMC() ).done(function(r1) {
                        $.when( NewFMCiRow() ).done(function(r2) {
                            console.log('r1');
                            // console.log(r1);
                            console.log('r2');
                            console.log(r2);
                            if(arrayFmcItens.length == 0){
                                removeSpinner();
                                Swal.fire(
                                    'Sem apontamentos de referência',
                                    '',
                                    'warning'
                                );
                                return;
                            }
                            Swal.fire(
                            'Pré-pagamento Gerada',
                            '',
                            'success'
                        ).then(() => {
                            voltar();
                        });
                        });
                    // });
                }
            });
        });
       
        $('#liFinanceiro').addClass('selected');
        $('#liFmcPrePagar').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divListaPjt').hide();
        $('#divListaChd').hide();

        
        
        SomaHora();
        ListaNaMarra();

        function ListaNaMarra() {

            var arrayLista = [];
            
            var table = $('#tableListaApo').DataTable();            
            var arrayFmcItens = [];

            var vCBRid = "<?= $cabecaPjt->CONS_CODIGO ?>";
            var vCLIid = "<?= $cabecaPjt->CLI_CODIGO ?>";
            var vPJTid = "<?= $cabecaPjt->PJT_CODIGO ?>";
            var vATGid = 0;
            var vAgrupaCBR = 1;
            var vAgrupaCLI = 1;
            var vAgrupaPJT = 1;
            var vAgrupaATG = 1;
            var vAgrupaLCT = 1;                        

            console.log('Um papo reto pra ver se tá legal:');
            console.log(vCBRid);
            console.log(vCLIid);
            console.log(vPJTid);
            console.log(vATGid);
            console.log(vAgrupaCBR);
            console.log(vAgrupaCLI);
            console.log(vAgrupaPJT);
            console.log(vAgrupaATG);
            console.log(vAgrupaLCT);
            console.log(pData1);
            console.log(pData2);

                    
            loadSpinner();
            $('#tableListaApo').DataTable().clear().destroy();
            table = $('#tableListaApo').DataTable({
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
                            vData1: pData1,
                            vData2: pData2
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divListaPjt').show();
                        // SomaHora();
                        console.log(response);
                    }
                },

                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [6, "des"]
                ],
                rowId: 'PJT_CODIGO',

                columns: [
                    {
                        "data": "LCT_CODIGO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "LCT_DESCRICAO",
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
                            // return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
                            return data == null ? "-" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4)+ "\n"+data.substring(11, 16) + '|' +data.substring(30, 36);
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
                            // return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
                            return data == null ? "-" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4)+ "\n"+data.substring(11, 16) + '|' +data.substring(30, 36);
                        }
                    },
                    {
                        "data": "DELAY",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            // return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
                            return data + '<br/>' + (row.EV == null ? '-' : row.EV);
                        }
                    },
                    {
                        "data": "TRAB_HORAS",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        // HR GLOSADA
                        "data": "FMG_GlosaQuant",
                        "defaultContent": "",
                        className: "text-right",
                        render: function(data, type, row) {                            
                            arrayFmcGloMotivo.push({"LinhaId":row.LinhaId, "LCT_CODIGO":row.LCT_CODIGO, "ATG_CODIGO":row.ATG_CODIGO, "FMG_GlosaMotivo":row.FMG_GlosaMotivo, "ATG_DESCRICAO":row.ATG_DESCRICAO, "LCT_DESCRICAO":row.LCT_DESCRICAO});
                            var vChecadaOuNao = row.APO_DATA_REAL >= "<?= $cabecaPjt->PER_INICIO?>" && row.APO_DATA_REAL <= "<?= $cabecaPjt->PER_TERMINO ?>" ? '' : 'disabled';
                            return  '<input type="text" value=' + row.FMG_GlosaQuant + ' style="text-align:right; border-color:' + '#EEE8AA' + ';" class="form-control" ' + vChecadaOuNao + ' id="eInputFMG_GlosaQuant' + row.LinhaId + '" />' + 
                                    '<button class="btn float-right" style="font-size : 1px; width: 25%; border-color:' + '#B0E0E6' + '; background-color:' + '#E0FFFF' + ';" id="buttonGloMotivo' + row.LinhaId + '"></button>' +
                                    '<button class="btn float-right" style="font-size : 1px; width: 25%; border-color:' + '#DEB887' + '; background-color:' + '#FFEFD5' + ';" id="buttonGloDemais' + row.LinhaId + '"></button>';;
                        }
                    },
                    {
                        // HR TOTAL
                        "data": "",
                        "defaultContent": "",
                        className: "text-right",
                        "render": function(data, type, row) {
                            var vSoma = row.TRAB_HORAS - row.FMG_GlosaQuant;
                            return data == null ? 0.00 : '<span value=' + row.TRAB_HORAS + '>'+vSoma+'</span>';
                        }
                    },
                    {
                        "data": "",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type, row) {
                            // var chamaFatGera = "chamaFatGera('" + row.PJT_CODIGO + "')";
                            // return '<button class="btn btn-clear" onclick="' + chamaFatGera + '"> <i class="mdi mdi-playlist-check"></i> </button>';
                            // return row.APON_TRABALHO == null ? '<input type="checkbox" class="marcar" id="CheckLinha">' : '<input type="checkbox" class="marcar" id="CheckLinha" checked >' ;
                            var vChamaSomaHora = "SomaHora()"; 
                            var vChecadaOuNao = row.APO_DATA_REAL >= "<?= $cabecaPjt->PER_INICIO?>" && row.APO_DATA_REAL <= "<?= $cabecaPjt->PER_TERMINO ?>" ? 'checked' : '';
                            // return row.APO_DATA_REAL >= "<?= $cabecaPjt->PER_INICIO?>" && row.APO_DATA_REAL <= "<!?= $cabecaPjt->PER_TERMINO ?>" ? '<input type="checkbox" class="marcar" onclick="' + vChamaSomaHora + '" id="CheckLinha" checked>' : '<input type="checkbox" class="marcar" onclick="' + vChamaSomaHora + '" id="CheckLinha" >' ;
                            // return '<input type="checkbox" class="marcar" onclick="' + vChamaSomaHora + '" id="CheckLinha' + row.LinhaId +'"' + vChecadaOuNao + '>';
                            return '<input type="checkbox" class="marcar" id="CheckLinha' + row.LinhaId +'"' + vChecadaOuNao + '>';
                        }
                    }
                ],                
                'initComplete': function(settings, json) {
                    removeSpinner();
                    setInputTextHints();
                    $('[id^=eInputFMG_GlosaQuant]').change(function() {
                        var ValorThis = $(this).val() == '' ? '0.00' : $(this).val();                        
                        var NumLinha = this.id.substr(20,6);                                            
                        if (ValorThis>0) {                            
                            linhaQueClicouNaTabela = arrayFmcGloMotivo.find(linha => linha.LinhaId == NumLinha);                            
                            $('#modalFmcGlosaMotivo').modal('show');
                        } else{
                            $(this).val(ValorThis==''?'0.00':ValorThis);                            
                        };                        
                        SomaHora();
                    });
                    $('[id^=CheckLinha]').change(function() {
                        SomaHora();
                    });
                    $('[id^=buttonGloMotivo]').click(function() {
                        var NumLinha = this.id.substr(15,6);
                        if ($('#eInputFMG_GlosaQuant' + NumLinha).val()>0) {
                            linhaQueClicouNaTabela = arrayFmcGloMotivo.find(linha => linha.LinhaId == NumLinha);
                            $('#modalFmcGlosaMotivo').modal('show');                            
                        };                        
                    });

                    $('[id^=buttonGloDemais]').click(function() {
                        var NumLinha = this.id.substr(15,6);
                        linhaQueClicouNaTabela = arrayFmcGloMotivo.find(linha => linha.LinhaId == NumLinha);
                        $('#modalFmcGlosaAptmtos').modal('show');
                    });
                                        
                    $('[id^=eInputFMG_GlosaQuant]').maskMoney({
                        prefix: "",
                        decimal: ".",
                        thousands: "."
                    });
                    SomaHora();                  
                },                
                columnDefs: [
                    {
                        "width": "3%",
                        "targets": [0],
                    },
                    {
                        "width": "51%",
                        "targets": [1],
                    },
                    {
                        "width": "5%",
                        "targets": [2],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                        }
                    },
                    {
                        "width": "8%",
                        "targets": [3],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                        }
                    },
                    {
                        "width": "5%",
                        "targets": [4],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                        },
                    },
                    {
                        "width": "8%",
                        "targets": [5],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                        },
                    },
                    {
                        "width": "2%",
                        "targets": [6],
                        "createdCell": function (td, cellData, rowData, row, col) {                            
                            $(td).css('background-color', '#FFFAF0'); 
                        }
                    },
                    {
                        "width": "5%",
                        "targets": [7],
                        "createdCell": function (td, cellData, rowData, row, col) {                            
                            $(td).css('background-color', '#FFFAF0');                            
                        }
                    },
                    {
                        "width": "6%",
                        "targets": [8],
                        "createdCell": function (td, cellData, rowData, row, col) {                            
                            $(td).css('background-color', '#FFFAF0');
                        }
                    },
                    {
                        "width": "5%",
                        "targets": [9],
                        "createdCell": function (td, cellData, rowData, row, col) {                            
                            $(td).css('background-color', '#FFFAF0');
                        }
                    },
                    {
                        "width": "2%",
                        "targets": [10],
                    }
                ]                
            });                      
        }
                
        function voltar() {
            // window.history.back();
            // history.go(-1);
            window.open('<?php echo base_url('FmcPrePagar/') ?>', '_self');
            // window.location.assign("https://ogma.wdiscover.com.br/ogma/FapSemFatura/");
        }
        /*
        $("#eInputTRAB_VRHORA").maskMoney({
                prefix: "R$ ",
                decimal: ",",
                thousands: "."
        });
        */

        $('.marcarTodos').click(toggleMarcarTodos);

        function toggleMarcarTodos(event) {
            var $tabela = $("#tableListaApo");
            var check = $(".marcarTodos", $tabela).is(':checked');
            var $checks = $('.marcar', $tabela);
            
            event && event.stopPropagation();
            
            $checks.each(function () {
                $(this).prop("checked", check);
            });
            SomaHora();
        }
        
        function NewFMCiRow() {
            arrayFmcItens = [];
            arrayFmcGlosa = [];
            $('#tableListaApo').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');                
                var CheckVai = $tds.eq(10).find('input').is(":checked");
                if (!CheckVai) {
                    return;
                }
                // var FMCi_FMCCodigo = FmcId;
                var FMCi_LCTCodigo = $tds.eq(0).text();
                var FMCi_PJTCodigo = "<?= $cabecaPjt->PJT_CODIGO ?>";
                var FMCi_ATGCodigo = "<?= $cabecaPjt->ATG_CODIGO ?>";
                var FMCi_HoraNro = parseFloat($tds.eq(9).text());
                var FMCi_LCTMes = "<?= $cabecaPjt->PER_INICIO ?>";
                var FMCi_CBRCodigo = "<?= $cabecaPjt->CONS_CODIGO ?>";
                var FMCi_MomPreFechamento = MomentoAgora();
                var FMCi_USUCodigo = <?php echo $this->session->userdata('userCodigo'); ?>;

                var wFMG_GlosaQuant = parseFloat($tds.eq(8).find("input").val()); 
                console.log('console.log(wFMG_GlosaQuant)');
                console.log(wFMG_GlosaQuant);
                if (wFMG_GlosaQuant != null && wFMG_GlosaQuant != '' && wFMG_GlosaQuant != 0) {
                    arrayFmcGlosa.push({
                        FMG_LCTCodigo: FMCi_LCTCodigo,
                        FMG_GlosaQuant: wFMG_GlosaQuant,
                        FMG_GlosaMotivo: arrayFmcGloMotivo.find(Apont => Apont.LCT_CODIGO == FMCi_LCTCodigo)["FMG_GlosaMotivo"],
                        FMG_MomDaGlosa: MomentoAgora(),
                        FMG_USUCodigo: <?php echo $this->session->userdata('userCodigo'); ?>
                    });                    
                };                

                console.table(arrayFmcGlosa);

                arrayFmcItens.push({
                    // FMCi_FMCCodigo: FMCi_FMCCodigo,
                    FMCi_LCTCodigo: FMCi_LCTCodigo,
                    FMCi_PJTCodigo: FMCi_PJTCodigo,
                    FMCi_ATGCodigo: FMCi_ATGCodigo,
                    FMCi_HoraNro: FMCi_HoraNro,
                    FMCi_CBRCodigo: FMCi_CBRCodigo,
                    FMCi_LCTMes: FMCi_LCTMes,
                    FMCi_MomPreFechamento: FMCi_MomPreFechamento,
                    FMCi_USUCodigo: FMCi_USUCodigo
                });
            });
            console.log(arrayFmcItens);
            if(arrayFmcItens.length == 0){
                return;
            }
            // Criado pelo Thiago em 14/09/2022 como alternativa digna de registro de patente! 
            // Parabéns, Thiago !!!
            return $.when( preFMCRow(arrayFmcItens), preFMGRow(arrayFmcGlosa) );
        }

        
        function preFMCRow(arrayFmcItens) {
            return $.ajax({
                url: "<?php echo base_url(); ?>financeiro/FmcLista/NewFMCiRow",
                type: 'POST',
                data: {
                    arrayFmcItens: arrayFmcItens
                },
            });
        }
                        
        function preFMGRow(arrayFmcGlosa) {
            return $.ajax({
                url: "<?php echo base_url(); ?>financeiro/FmcLista/NewFMGRow",
                type: 'POST',
                data: {
                    arrayFmcGlosa: arrayFmcGlosa
                },
            });
        }

        function SomaHora() {
            var vSomaHoraFatN = 0;
            var vSomaHoraFatS = 0;
            var vSomaTotal = 0;
            var vRemuTotal = 0;
            $('#tableListaApo').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var estaCheckado = $tds.eq(10).find('input[type="checkbox"]').is(":checked") ? 1 : 0;
                $tds.eq(8).find("input").prop("disabled", estaCheckado==0);
                $tds.eq(8).find("button").prop("disabled", estaCheckado==0);
                $tds.eq(9).text((parseFloat($tds.eq(7).text()) - parseFloat($tds.eq(8).find("input").val())).toFixed(2));
                if (estaCheckado==1) {
                    vSomaHoraFatN += parseFloat($tds.eq(2).text());
                    vSomaHoraFatS += parseFloat($tds.eq(4).text());
                    vSomaTotal += parseFloat($tds.eq(9).text());
                } else{
                    $tds.eq(8).find("input").val(0.00);
                }               
                

            });
            console.log(vSomaHoraFatN);
            console.log(vSomaHoraFatS);
            //vSomaTotal = vSomaHoraFatN + vSomaHoraFatS;
            vRemuTotal = vSomaTotal * "<?= $cabecaPjt->TRAB_VRHORA ?>"
            $('#spanSomaPgtN').text(vSomaHoraFatN.toFixed(2));
            $('#spanSomaPgtS').text(vSomaHoraFatS.toFixed(2));
            $('#vSpanQtdeTotal').text(vSomaTotal.toFixed(2));
            // $('#vSpanValorTotal').text(vRemuTotal.toFixed(2));
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
            console.log(today);
            return today
        }

        function DataEuaBra(pData) {
            return pData.substring(8, 10) + "/" + pData.substring(5, 7)+ "/" + pData.substring(0, 4);
        }

        function getTextMesAno(date) {
            return NomeMes[parseInt((date).substring(5, 7))-1] + ' de ' + (date).substring(0, 4);
        }

        function setInputTextHints() {
                                                
            $('#eInputPER_INICIO').prop('title', $('#eInputPER_INICIO').val() + "\nData do início do período de referência para pré-pagamento (mês)." );
            $('#eInputPER_TERMINO').prop('title', $('#eInputPER_TERMINO').val() + "\nData do término do período de de referência para pré-pagamento (mês)." );
            $('#eInputCONS_APELIDO').prop('title', $('#eInputCONS_APELIDO').val() + "\nNome/apelido do colaborador." );
            $('#eInputCONS_CARGO').prop('title', $('#eInputCONS_CARGO').val() + "\nCargo ocupado pelo " + $('#eInputCONS_APELIDO').val() + "." );
            $('#eInputCLI_APELIDO').prop('title', $('#eInputCLI_APELIDO').val() + "\nRazão Social/Nome Fantasia do cliente atendido pelo " + $('#eInputCONS_APELIDO').val() + "." );
            $('#eInputPJT_APELIDO').prop('title', $('#eInputPJT_APELIDO').val() + "\nTítulo (apelido) do Plano de Serviços trabalhado pelo " + $('#eInputCONS_APELIDO').val() + "." );
            $('#eInputATG_DESCRICAO').prop('title', $('#eInputATG_DESCRICAO').val() + "\nDescrição da atividade/chamado trabalhada pelo " + $('#eInputCONS_APELIDO').val() + ".\nCaso o pré-pagamento se refira a tal detalhe." );

            $('#eInputObservacao').prop('title', $('#eInputObservacao').val() + "\nObservações diversas sobre o pré-pagamento do\nColaborador para o mês/Plano de Serviço ou Atividade/Chamado." );
            $('#eInputCONS_U_REMUNERA').prop('title', $('#eInputCONS_U_REMUNERA').val() + "\nUnidade de Remuneração para o Colaborador.\nSerá gravado no pré-pagamento para registro histórico." );
            $('#vSpanQtdeTotal').prop('title', $('#vSpanQtdeTotal').val() + "\nQuantidade total de Unidades de Remuneração para o mês/Plano de Serviço ou Atividade/Chamado.\nSoma da coluna de total de horas dos itens marcados na lista." );
            // $('#eInputTRAB_VRHORA').prop('title', $('#eInputTRAB_VRHORA').val() + "\nValor de remuneração por Unidade de Remuneração do Colaborador.\nSerá gravado no pré-pagamento para registro histórico." );
            // $('#vSpanValorTotal').prop('title', $('#vSpanValorTotal').val() + "\nValor total de remuneração do Colaborador para o mês/Plano de Serviço ou Atividade/Chamado." );

            $('#buttonVoltar').prop('title', "Clique para retornar à lista de Colaboradores." );
            $('#buttonGerar').prop('title', "Clique para gerar o pré-pagamento." );
            
            $('#colLctCodi').prop('title',  "Id/código do apontamento de horas." );
            $('#colPjtCons').prop('title',  "Nome do Colaborador." );
            $('#colLctDesc').prop('title',  "Descrição da atividade e do apontamento\nde horas, pelo Colaborador." );
            $('#colFNaoApo').prop('title',  "NÃO FATURÁVEIS:\nNúmero de horas apontadas:\nHoras apontadas e ainda sem pré-pagamento." );
            $('#colFNaoDat').prop('title',  "NÃO FATURÁVEIS:\nÚltimo apontamento:\nÚltimo apontamento\nno período de referência." );
            $('#colFSimApo').prop('title',  "FATURÁVEIS:\nNúmero de horas apontadas:\nHoras apontadas e ainda sem pré-pagamento." );
            $('#colFSimDat').prop('title',  "FATURÁVEIS:\nÚltimo apontamento:\nÚltimo apontamento\nno período de referência." );

            $('#colGAnalis').prop('title',  "GLOSA:\nAnálise DELAY / EV:\n\nDELAY: Tempo em horas entre o momento final do trabalho e o momento da última alteração nesse apontamento.\nMelhor quando menor de 48.\n\n" +
                                            "EV: Valor agregado - índice gerado da divisão do tempo trabalhado pela proporção do aprontamento do esforço\n(subtração entre os percentuais antes e depois do apontamento).\nMelhor quando próximo a 1" );
            $('#colGTraApo').prop('title',  "GLOSA:\nTotal em  horas centesimais apontado no período de referência." );
            $('#colGTraGlo').prop('title',  "GLOSA:\nValor em horas centesimais a ser glosado." );
            $('#colGTraTot').prop('title',  "GLOSA:\nTotal líquido:\nValor em horas centesimais a se computar no pré-pagamento do Colaborador." );
            
            $('#colMarcada').prop('title', "Item marcado para referência do pré-pagamento.\nMarque todos clicando aqui.\nMarque em cada linha os apontamentos que serão incluídos neste pré-pagamento." );

            $('[id^=buttonGloMotivo]').prop('title', "Clique para editar o motivo da glosa." );
            $('[id^=buttonGloDemais]').prop('title', "Clique para visualizar os demais\napontamentos da Atividade." );
            $('[id^=eInputFMG_GlosaQuant]').prop('title', "Informe um valor em horas centesimais a ser glosado deste apontamento.\nDepois, descreva mo motivo da glosa." );
            
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