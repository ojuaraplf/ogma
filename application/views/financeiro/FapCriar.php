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
    <title> Pré-fatura Criar </title>

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
                    <h3 class="page-title"> <i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i> Pré-fatura: Criar </h3>
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
                    <h5> Dados para a pré-fatura:</h5>
                    <div class="row mb-3">
                    <div class="col-3">
                        <label for="eInputCLIENTE" class="text-left control-label col-form-label" id="lInputCLIENTE" >Cliente:</label>
                            <input type="text" class="form-control font-weight-bold" value="<?php echo $cabecaPjt->CLIENTE; ?>" id="eInputCLIENTE" disabled />
                        </div>
                        <div class="col-1">
                            <label for="eInputCLI_CODIGO" class="text-left control-label col-form-label" id="lInputCLI_CODIGO" >Id:</label>
                            <input type="text" class="form-control font-weight-bold" value="<?php echo $cabecaPjt->CLI_CODIGO; ?>" id="eInputCLI_CODIGO" disabled />
                        </div>                      
                        <div class="col-3">
                            <label for="selectCLI_PESCodigo" class="text-left control-label col-form-label">Pessoa do cliente responsável pelo faturamento</label>
                            <select class="form-control" id="selectCLI_PESCodigo">

                                <option value="<?php echo $cabecaPjt->RESPONSA_CLIENTE_COD; ?>">
                                    <?php echo $cabecaPjt->RESPONSA_CLIENTE; ?>
                                </option>
                                <?php foreach ($ogma_PES_Selecao01 as $item): ?>
                                <option value="<?= $item['CODIGO']; ?>">
                                    <?= $item['NOME']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="eInputPJT_APELIDO" class="text-left control-label col-form-label" id="lInputPJT_APELIDO" >Plano de Serviço (PPx):</label>
                            <input type="text" class="form-control font-weight-bold" value="<?php echo $cabecaPjt->PLANO_APELIDO_CAB; ?>" id="eInputPJT_APELIDO" disabled />
                        </div>
                        <div class="col-1">
                            <label for="eInputFAP_PJTCodigo" class="text-left control-label col-form-label" id="lInputFAP_PJTCodigo" >Id:</label>
                            <input type="text" class="form-control font-weight-bold" value="<?php echo $cabecaPjt->PJT_CODIGO; ?>" id="eInputFAP_PJTCodigo" disabled />
                        </div>
                        <div class="col-1">
                            <label for="eInputFAP_PJTVrHora" class="text-left control-label col-form-label" id="lInputFAP_PJTVrHora" >Valor hora:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->VALOR_HORA; ?>" id="eInputFAP_PJTVrHora" disabled />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-5">
                            <label for="eInputATIVIDADE_DESCRICAO" class="text-left control-label col-form-label" id="lInputATIVIDADE_DESCRICAO" >Descrição da Atividade:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->ATIVIDADE_DESCRICAO_CAB; ?>" id="eInputATIVIDADE_DESCRICAO" disabled />
                        </div>
                        <div class="col-1">
                            <label for="eInputATIVIDADE_ID" class="text-left control-label col-form-label" id="lInputATIVIDADE_ID" >Atividade:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->ATIVIDADE_ID_CAB; ?>" id="eInputATIVIDADE_ID" disabled />
                        </div>
                        <div class="col-1">
                            <label for="eInputCHAMADO" class="text-left control-label col-form-label" id="lInputCHAMADO" >Chamado:</label>
                            <input type="text" class="form-control font-weight-bold" value="<?php echo $cabecaPjt->CHAMADO; ?>" id="eInputCHAMADO" disabled />
                        </div>
                        <div class="col-3">
                            <label for="eInputTOR_Nome" class="text-left control-label col-form-label" id="lInputTOR_Nome" >Tipo de Faturamento:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->FATU_TIPO; ?>" id="eInputTOR_Nome" disabled />
                        </div>                        
                        <div class="col-1">
                            <label for="eInputFAP_PeriodoInicio" class="text-left control-label col-form-label" id="lInputFAP_PeriodoInicio" >Início:</label>
                            <input type="date" class="form-control" value="<?php echo $cabecaPjt->PER_INICIO_; ?>" id="eInputFAP_PeriodoInicio" disabled />
                        </div>
                        <div class="col-1">
                            <label for="eInputFAP_PeriodoTermino" class="text-left control-label col-form-label" id="lInputFAP_PeriodoTermino" >Término:</label>
                            <input type="date" class="form-control" value="<?php echo $cabecaPjt->PER_TERMINO_; ?>" id="eInputFAP_PeriodoTermino" disabled />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-3">
                            <!-- ESPAÇO EM BRANCO -->
                        </div>
                        <div class="col-1">
                            <label for="eInputFAP_NfNumero" class="text-left control-label col-form-label" id="lInputFAP_NfNumero" >Número NF:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->FAP_NRO_NF; ?>" id="eInputFAP_NfNumero" />
                        </div>
                        <div class="col-2">
                            <label for="eInputFAP_Valor" class="text-left control-label col-form-label" id="lInputFAP_Valor" >Valor pré-fatura:</label>
                            <input type="text" placeholder="R$ 0,00" data-toggle="tooltip" class="form-control" value="<?php echo $cabecaPjt->FAP_VALOR; ?>" id="eInputFAP_Valor" />
                        </div>
                        <div class="col-1">
                            <label for="eInputFAP_ParcelaOrdem" class="text-left control-label col-form-label" id="LInputFAP_ParcelaOrdem" >Parcela:</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->PARC_ORDEM; ?>" id="eInputFAP_ParcelaOrdem" />
                        </div>
                        <div class="col-1">
                            <label for="eInputFAP_ParcelaTotal" class="text-left control-label col-form-label" id="InputFAP_ParcelaTotal" >Parcela(s):</label>
                            <input type="text" class="form-control" value="<?php echo $cabecaPjt->PARC_TOTAL; ?>" id="eInputFAP_ParcelaTotal" />
                        </div>                        
                        <div class="col-2">
                            <label for="selectFAP_Status" class="text-left control-label col-form-label">Status do Pré-faturamento</label>
                            <select class="form-control" id="selectFAP_Status">
                                <option value="A"> A faturar</option>
                                <!-- <option value="F"> Faturado</option> -->
                                <option value="H">Homologar</option>
                                <option value="N">Não faturar</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <label for="eInputFATURAVEL_NAO_APON_ANTES" class="text-left control-label col-form-label" id="lInputFATURAVEL_NAO_APON_ANTES" ><i class="mdi mdi-rowing"></i>Não Faturável:</label>
                            <input type="text" style="background: #FFF0F5;" class="form-control" value="<?php echo $cabecaPjt->FATURAVEL_NAO_APON_ANTES; ?>" id="eInputFATURAVEL_NAO_APON_ANTES" disabled />
                        </div>           
                        <div class="col-1">
                            <label for="eInputFATURAVEL_SIM_APON_ANTES" class="text-left control-label col-form-label" id="lInputFATURAVEL_SIM_APON_ANTES" ><i class="mdi mdi-rowing"></i>Faturável:</label>
                            <input type="text" style="background: #F0FFFF;" class="form-control" value="<?php echo $cabecaPjt->FATURAVEL_SIM_APON_ANTES; ?>" id="eInputFATURAVEL_SIM_APON_ANTES" disabled />
                        </div> 
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="eInputFAP_Descricao" class="text-left control-label col-form-label" id="lInputFAP_Descricao" > Descrição para a Fatura </label>
                            <textarea class="form-control" rows="3" id="eInputFAP_Descricao"><?php echo $cabecaPjt->FAP_DESCRICAO; ?></textarea>
                        </div>
                        <div class="col-6">
                            <label for="eInputFAP_Observacao" class="text-left control-label col-form-label" id="lInputFAP_Observacao"> Observações </label>
                            <textarea type="text" class="form-control" rows="3" id="eInputFAP_Observacao"><?php echo $cabecaPjt->FAP_OBSERVACAO; ?></textarea>
                        </div>
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
                            <button class="btn btn-primary" style="font-size : 20px; width: 100%; height: 50px; border-color: SteelBlue; background-color: SteelBlue;" id="buttonGerar"> Criar Pré-fatura </button>
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
                                    <div class="col-1">
                                        <label for="eMM_Limite" class="text-left" id="lMM_Limite"> <i class="mdi mdi-checkbox-marked-outline"></i> Limite </label>
                                        <input type="number" min="0.0" max="1000.0" step="0.5" class="form-control" value="10.00" id="eMM_Limite" />
                                    </div>
                                    <div class="col-1">
                                        <label for="eMM_Limite" class="text-left" id="lMM_Limite"> <i class="mdi mdi-checkbox-marked-outline"></i> Diferença </label>
                                        <input type="number" min="0.00" max="100.00" step="0.01" class="form-control" value="0.50" id="eMM_MaxDif" />
                                    </div>
                                    <div class="col-1">                                        
                                        <button class="btn btn-primary" style="font-size : 15px; width: 100%; height: 70px; border-color: Transparent; color: black; background-color: Transparent;" id="MMbutton"> <i class="mdi mdi-checkbox-marked-outline"></i><br/>Marcar </button>
                                    </div>
                                </div>
                                <table class="table table-hover table-sm" id="tableListaApo">
                                    <thead>
                                        <tr>
                                            <td id='colPjtCodi'> ID</td>
                                            <td id='colPjtCons'> Apontamento<br/>Consultor</td>
                                            <td id='colPjtDesc'> ATIVIDADE<br/>Descrição do apontamento</td>
                                            <td id='colFNaoApo'> <i class="mdi mdi-rowing"></i><br/><span id="spanSomaFatN" >-</span></td>
                                            <td id='colFNaoDat'> <i class="mdi mdi-calendar"></i></td>
                                            <td id='colFSimApo'> <i class="mdi mdi-rowing"></i><br/><span id="spanSomaFatS" >-</span></td>
                                            <td id='colFSimDat'> <i class="mdi mdi-calendar"></i></td>
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

    <script type="text/javascript">
        removeSpinner();

        const NomeMes = ["JANEIRO", "FEVEREIRO", "MARÇO", "ABRIL", "MAIO", "JUNHO",
        "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO", "DEZEMBRO"];        
        
        $('#buttonGerar').click(function() {

            var wFapMesRef = getTextMesAno($('#eInputFAP_PeriodoTermino').val());
            var wFapStatus = $('#selectFAP_Status :selected').text();
            var wFapValor = $('#eInputFAP_Valor').val();
            var textomsg = 'Referência: ' + wFapMesRef + ';<br/>Status: ' +  wFapStatus + ';<br/>Valor: ' + wFapValor +'.';

            console.log('console.log(wFapStatus)');
            console.log(wFapStatus);

            // Validando o valor da fatura           
            if( (wFapValor == "0.00" || wFapValor == "") && (wFapStatus != 'Não faturar') ) {
                $('#eInputFAP_Valor').focus();
                Swal.fire(
                    'Ops!',
                    'Importante informar o valor da Pré-fatura?',
                    'warning'
                )
              return;
            }

            Swal.fire({
                title: 'Confirma pré-faturamento ?',                
                html: '<div id="align_left">' + textomsg + '</div>',
                showDenyButton: true,
                confirmButtonText: 'Confirmar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                if (result.isConfirmed) {
                    loadBlurSpinner();
                    $.when( UpdateGeraFAP() ).done(function(r1) {
                        $.when( UpdateGeraFAPi(r1) ).done(function(r2) {
                            console.log(r2);
                            if(arrayFapItens.length == 0){
                                removeSpinner();
                                Swal.fire(
                                    'Sem apontamentos de referência',
                                    '',
                                    'warning'
                                    );
                                return;
                            }
                            Swal.fire(
                                'Fatura Gerada',
                                '',
                                'success'
                            ).then(() => {
                                // var NroDeLinha = '<?php echo $cabecaPjt->APON_NRO; ?>';
                                // if(
                                //     (arrayFapItens.length - NroDeLinha) == 0
                                // ){ 
                                //     // window.open('<!?php echo base_url('FapLista/') ?>', '_self');
                                //     voltar();
                                // } else{
                                //     location.reload();
                                // }
                                voltar();
                            });
                        });
                    });
                }
            });
        });
       
        $('#liFinanceiro').addClass('selected');
        $('#liFapLista').addClass('active');
        $('#ulFinanceiro').addClass('in');

        $('#divListaPjt').hide();
        $('#divListaChd').hide();

        setInputTextHints();
        
        // vTexTitNao = "";
        // $('#spanSomaFatN').text('<i class="mdi mdi-rowing"></i>' + vSomaHoraFatN);
        // <span id="spanSomaFatN"> </span>
        // $('#spanSomaFatN').text(<?= $cabecaPjt->FATURAVEL_NAO_APON_ANTES ?>.toFixed(2));
        // $('#spanSomaFatS').text(<?= $cabecaPjt->FATURAVEL_SIM_APON_ANTES ?>.toFixed(2));
        SomaHora();
        ListaNaMarra();

        // new $.fn.dataTable.FixedHeader( ListaNaMarra );
        
        // $("#eInputFAP_Descricao").change( function() {
        //     new $.fn.dataTable.FixedHeader( ListaNaMarra );
        // });
        
        
        //new $.fn.dataTable.FixedHeader( ListaNaMarra, {
            // options
        //} );

        

        function ListaNaMarra() {

            var arrayLista = [];
            var table = $('#tableListaApo').DataTable();
            var vAgruparPJT = 0;
            var arrayFapItens = [];
            var vInputPjt = $('#eInputATIVIDADE_ID').val() != '' ? 0 : $('#eInputFAP_PJTCodigo').val();
            var vInputAtg = $('#eInputATIVIDADE_ID').val() != '' ? "<?= $cabecaPjt->ATIVIDADE ?>" : 0;
            var pData1 = $('#eInputFAP_PeriodoInicio').val();
            var pData2 = $('#eInputFAP_PeriodoTermino').val();        
            var vSoFaturavelPjt = 0;
            var vSoFaturavelAtg = 0;
            var vSoFaturavelLct = 1;
                    
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
                    url: "<?php echo base_url(); ?>financeiro/FapLista/fetchFAPPreFaurar",
                    type: 'POST',
                    data: {
                            vCLIid: 0,
                            vPJTid: vInputPjt,
                            vATGid: vInputAtg,
                            vAgrupaCLI: 0,
                            vAgrupaPJT: vAgruparPJT,
                            vAgrupaATG: 0,
                            vAgrupaLCT: 1,
                            vData1: pData1,
                            vData2: pData2,
                            vSoFaturavelPjt: vSoFaturavelPjt,
                            vSoFaturavelAtg: vSoFaturavelAtg,
                            vSoFaturavelLct: vSoFaturavelLct
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divListaPjt').show();
                        SomaHora();
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
                        "data": "APON_ID",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "APON_CONSULTOR",
                        "defaultContent": "",
                        className: "text-left"
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
                        "data": "FATURAVEL_NAO_DATA_ANTES",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {
                            return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
                        }
                    },
                    {
                        "data": "FATURAVEL_SIM_APON_ANTES",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "FATURAVEL_SIM_DATA_ANTES",
                        "defaultContent": "",
                        className: "text-center",
                        "render": function(data, type, row) {
                            return data == null ? " / /" : "<span style='display: none;'>" + data + "</span>" + data.substring(8, 10) + "/" + data.substring(5, 7)+ "/" + data.substring(0, 4);
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
                            return row.APO_DATA_REAL >= "<?= $cabecaPjt->PER_INICIO_?>" && row.APO_DATA_REAL <= "<?= $cabecaPjt->PER_TERMINO_ ?>" ? '<input type="checkbox" class="marcar" onclick="' + vChamaSomaHora + '" id="CheckLinha" checked>' : '<input type="checkbox" class="marcar" onclick="' + vChamaSomaHora + '" id="CheckLinha" >' ;
                        }
                    }
                ],                
                'initComplete': function(settings, json) {
                    removeSpinner();                    
                },                
                columnDefs: [
                    {
                        "width": "49%",
                        "targets": [2],
                    },
                    {
                        "width": "8%",
                        "targets": [3],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                        }
                    },
                    {
                        "width": "8%",
                        "targets": [4],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF0F5');
                        }
                    },
                    {
                        "width": "8%",
                        "targets": [5],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                        },
                    },
                    {
                        "width": "8%",
                        "targets": [6],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F0FFFF');
                        },
                    },
                    {
                        "width": "2%",
                        "targets": [7],
                    }
                ]                
            });                      
        }
        
        function voltar() {
            // window.history.back();
            // history.go(-1);
            window.open('<?php echo base_url('FapPreFaturar/') ?>', '_self');
            // window.location.assign("https://ogma.wdiscover.com.br/ogma/FapSemFatura/");
        }

        $("#eInputFAP_Valor").maskMoney({
                prefix: "R$ ",
                decimal: ",",
                thousands: "."
        });

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

        function UpdateGeraFAP() {

            return $.ajax({
                url: "<?php echo base_url(); ?>financeiro/FapLista/NewFAP",
                type: 'POST',
                data: {
                    pFAP_Codigo: null,
                    pFAP_Descricao: $('#eInputFAP_Descricao').val(),
                    pFAP_NroHoras: $('#eInputFAP_NroHoras').val(),
                    pFAP_PJTCodigo: $('#eInputFAP_PJTCodigo').val(),
                    pFAP_PJTVrHora: $('#eInputFAP_PJTVrHora').val(),
                    pFAP_TORCodigo: "<?= $cabecaPjt->FATU_TIPO_COD ?>",
                    pFAP_PESrescliCodigo: $('#selectCLI_PESCodigo').val(),
                    pFAP_Valor: $('#eInputFAP_Valor').val().replace('R$ ', '').replace('.', '').replace(',', '.'),
                    pFAP_NfNumero: $('#eInputFAP_NfNumero').val(),
                    pFAP_MomEmissao: MomentoAgora(),
                    pFAP_MomEmigracao: null,
                    pFAP_PeriodoInicio: $('#eInputFAP_PeriodoInicio').val(),
                    pFAP_PeriodoTermino: $('#eInputFAP_PeriodoTermino').val(),
                    pFAP_ParcelaOrdem: $('#eInputFAP_ParcelaOrdem').val(),
                    pFAP_ParcelaTotal: $('#eInputFAP_ParcelaTotal').val(),
                    pFAP_Observacao: $('#eInputFAP_Observacao').val(),
                    pFAP_ATGCodigo: $('#eInputATIVIDADE_ID').val(),
                    pFAP_Status:  $('#selectFAP_Status').val(),
                    pFAP_USUCodigo:  <?php echo $this->session->userdata('userCodigo'); ?>
                    
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            });
                        
        }

        function UpdateGeraFAPi(FapId) {
            arrayFapItens = [];
            $('#tableListaApo').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var CheckVai = $tds.eq(7).find('input').is(":checked");
                if (!CheckVai) {
                    return;
                }
                var FAPi_FAPCodigo = FapId;
                var FAPi_LCTCodigo = $tds.eq(0).text();
                var FAPi_HoraNro = parseFloat($tds.eq(5).text()) + parseFloat($tds.eq(3).text());                
                arrayFapItens.push({FAPi_FAPCodigo:FAPi_FAPCodigo, FAPi_LCTCodigo:FAPi_LCTCodigo, FAPi_HoraNro:FAPi_HoraNro});
            });
            console.log(arrayFapItens);
            if(arrayFapItens.length == 0){
                return;
            }
            return $.ajax({
                url: "<?php echo base_url(); ?>financeiro/FapLista/UpdateFAPiRow",
                type: 'POST',
                data: {
                    arrayFapItens: arrayFapItens
                },
            });
        }

        function SomaHora() {
            var vSomaHoraFatN = 0;
            var vSomaHoraFatS = 0;
            $('#tableListaApo').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var estaCheckado = $tds.eq(7).find('input[type="checkbox"]').is(":checked") ? 1 : 0;
                if (estaCheckado==1) {
                    vSomaHoraFatN += parseFloat($tds.eq(3).text());
                    vSomaHoraFatS += parseFloat($tds.eq(5).text());
                }                                
            });
            console.log(vSomaHoraFatN);
            console.log(vSomaHoraFatS);
            $('#spanSomaFatN').text(vSomaHoraFatN.toFixed(2));
            $('#spanSomaFatS').text(vSomaHoraFatS.toFixed(2));
        }

        $('#MMbutton').click(function() {
            MarcaNoLimite( $('#eMM_Limite').val(), $('#eMM_MaxDif').val());
        });
        

        function MarcaNoLimite(pLimite, pDifMax ) {
            toggleMarcarTodos();
            //var pLimite = 10;
            // var pDifMax = 0.15;
            var vSomaHoraFatN = 0;
            var vSomaHoraFatS = 0;            
            $('#tableListaApo').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');                
                var ValorLinha = parseFloat($tds.eq(5).text());
                let Marca = $tds.eq(7).find('input[type="checkbox"]');

                if (ValorLinha>0) {

                    if (vSomaHoraFatS < pLimite ) {                        
                        vSomaHoraFatS += ValorLinha;
                        Marca.prop('checked', true);                    
                    } else if (vSomaHoraFatS - pLimite > pDifMax ) {
                        vSomaHoraFatS -= ValorLinha;
                        Marca.prop('checked', false);
                    } else {
                        return false;
                    };
                }
            });            
            console.log('vSomaHoraFatS');
            console.log(vSomaHoraFatS);
            SomaHora();
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


        function getTextMesAno(date) {
            return NomeMes[parseInt((date).substring(5, 7))-1] + ' de ' + (date).substring(0, 4);
        }

        function setInputTextHints() {
                                    
            $('#eMM_Limite').prop('title', "Quer marcar até\num número limitado de horas?\n\nInforme o número de horas desejado\npara ajuda nisso." );
            $('#eMM_MaxDif').prop('title', "Quer marcar até\num número limitado de horas?\n\nInforme a diferença suportada\npara ajuda nisso." )
            $('#MMbutton').prop('title', "Clique para marcar um número de itens\ncom a soma mais próxima do limite." )
            

            $('#eInputCLIENTE').prop('title', $('#eInputCLIENTE').val() + "\nNome / Razão Social do Cliente." );
            $('#eInputCLI_CODIGO').prop('title', $('#eInputCLI_CODIGO').val() + "\nCódigo (Id) do Cliente." );
            $('#eInputPJT_APELIDO').prop('title', $('#eInputPJT_APELIDO').val() + "\nApelido do Plano de Serviço (PPx)." );
            $('#eInputFAP_PJTCodigo').prop('title', $('#eInputFAP_PJTCodigo').val() + "\nCódigo (Id) do Plano de Serviço (PPx)." );            
            $('#selectCLI_PESCodigo').prop('title', "Confirme ou selecione a pessoa do cliente,\nresponsável pelo faturamento." );
            $('#eInputPJN_CentroCustoCliente').prop('title', $('#eInputPJN_CentroCustoCliente').val() + "\nCentro de Custo do Cliente.\nCOnfirme ou informe." );
            $('#eInputATIVIDADE_DESCRICAO').prop('title', $('#eInputATIVIDADE_DESCRICAO').val() + "\nDescrição da atividade/chamado.\nEm caso de pré-faturamento da Atividade/Chamado." );
            $('#eInputTOR_Nome').prop('title', $('#eInputTOR_Nome').val() + "\nTipo de Faturamento do PPx.\nInformado na configuração do financeiro do PPx." );
            $('#eInputCHAMADO').prop('title', $('#eInputCHAMADO').val() + "\nNúmero do Chamado.\nEm caso de pré-faturamento da Atividade/Chamado." );
            $('#eInputATIVIDADE_ID').prop('title', $('#eInputATIVIDADE_ID').val() + "\nId da Atividade.\nEm caso de pré-faturamento da Atividade/Chamado." );
            $('#eInputFAP_PJTVrHora').prop('title', $('#eInputFAP_PJTVrHora').val() + "\nPreço da hora vendida para o cliente.\nInformado no cabeçalho do PPx." );
            $('#eInputFATURAVEL_NAO_APON_ANTES').prop('title', $('#eInputFATURAVEL_NAO_APON_ANTES').val() + "\nNúmero total de horas apontadas.\nEm atividades NÃO Faturáveis." );
            $('#eInputFATURAVEL_SIM_APON_ANTES').prop('title', $('#eInputFATURAVEL_SIM_APON_ANTES').val() + "\nNúmero total de horas apontadas.\nEm atividades FATURÁVEIS." );
            $('#eInputFAP_PeriodoInicio').prop('title', $('#eInputFAP_PeriodoInicio').val() + "\nData do início do período de faturamento.\nInformada na configuração do financeiro do PPx." );
            $('#eInputFAP_PeriodoTermino').prop('title', $('#eInputFAP_PeriodoTermino').val() + "\nData do término do período de faturamento.\nInformada na configuração do financeiro do PPx." );
            $('#eInputFAP_Valor').prop('title', $('#eInputFAP_Valor').val() + "\nValor total da pré-fatura.\nConfirme ou informe." );
            $('#eInputFAP_NfNumero').prop('title', $('#eInputFAP_NfNumero').val() + "\nNúmero da NF/Fatura.\nPoderá também ser informado após a efetivação do faturamento." );
            $('#eInputFAP_ParcelaOrdem').prop('title', $('#eInputFAP_ParcelaOrdem').val() + "\nNúmero de ordem da parcela.\nConfirme, altere ou informe." );
            $('#eInputFAP_ParcelaTotal').prop('title', $('#eInputFAP_ParcelaTotal').val() + "\nNúmero total de parcelas.\nConfirme, altere ou informe." );
            $('#eInputFAP_Descricao').prop('title', $('#eInputFAP_Descricao').val() + "\nDescrição para o corpo da NF/Fatura.\nConfirme, altere ou informe." );
            $('#eInputFAP_Observacao').prop('title', $('#eInputFAP_Observacao').val() + "\nObservações sobre o faturamento.\nConfirme, altere ou complemente." );
            $('#selectFAP_Status').prop('title', "Status do Pré-faturamento:\nA Faturar: Estará na lista para fechamento da fatura;\nHomologar: Direto para homologarção do cliente;\nNão faturar: Não será faturado (Trabalhos internos etc)." );

            $('#buttonVoltar').prop('title', "Clique para retornar à lista de Planos de Serviço." );
            $('#buttonGerar').prop('title', "Clique para gerar a pré-fatura." );

            $('#colPjtCodi').prop('title', "Id/código do apontamento de horas." );
            $('#colPjtCons').prop('title', "Nme do consultor." );
            $('#colPjtDesc').prop('title', "Descrição do apontamento de horas, pelo Consultor." );
            $('#colFNaoApo').prop('title', "Número de horas apontadas\nsem pré-faturamento\npara atividades NÃO faturáveis." );
            $('#colFNaoDat').prop('title', "Último apontamento\npara atividades NÃO faturáveis." );
            $('#colFSimApo').prop('title', "Número de horas apontadas\nsem pré-faturamento\npara atividades FATURÁVEIS." );
            $('#colFSimDat').prop('title', "Último apontamento\npara atividades FATURÁVEIS." );

            $('#colMarcada').prop('title', "Item marcado para referência do pré-faturamento.\nMarque todos clicando aqui.\nMarque em cada linha os apontamentos que serão incluídos neste pré-faturamento." );
            
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