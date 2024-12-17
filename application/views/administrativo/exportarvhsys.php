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
    <title>wDiscovery</title>

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
                        <h4 class="page-title">Exportação VHSYS</h4>
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
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label"> Informe Mês Ano</label>
                                        <input type="text" id="inputTextMesAno" class="form-control" />
                                    </div>

                                    <div class="col-10 align-self-end">
                                        <button class="btn btn-primary" id="buttonExportar"> Exportar para VHSys </button>
                                        <button class="btn btn-primary" id="buttonFecharMes"> Fechar Mês </button>
                                        <button class="btn btn-danger" id="buttonExcluir"> Excluir registros VHSys </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="divteste" style="text-align: center; display:none;">

                </div>

                <div id="divtoast" >
                    <div id="divDialogoExclusao" class="alert alert-danger text-center" role="alert" style="display:none;">
                        Confirma exclusão das contas a pagar no VHSYS? 
                        <div class="col-lg-12" style="text-align: center;" id="div_btn" style="display:none;">
                            <button class="btn btn-primary" name="btnSim" id="btnSim">Sim</button>
                            <button class="btn btn-primary" name="btnNao" id="btnNao">Não</button>
                        </div>
                    </div>
                </div>

                <div id="divDialogo" style="text-align: center;" class="alert alert-info" role="alert">
                    Informe mês e ano para obter relação do dados para exportação VHSYS.
                </div>
                
                <div class="row" id="divRelatorio">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Dados do Mês </h4>
                                        </div>
                                    </div>
                                    <br />
                                    <div id="divresultado">
                                    </div>
                                    <table class="table table-sm table-hover" id="tablefechamentomes">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">IDMigração</th>
                                                <th scope="col">VHSys ID</th>
                                                <th scope="col">Colaborador</th> 
                                                <th scope="col">VHSys CC</th>                                             
                                                <th scope="col">Plano de Serviço</th>
                                                <th scope="col">UD</th>
                                                <th scope="col">Trabalho</th>
                                                <th scope="col">Unit. (R$)</th>
                                                <th scope="col">Total (R$)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <br />
                                <div class="row">
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

        //$('#liAdministracao').addClass('selected');
        //$('#ulAdministrativo').addClass('in');        

        $('#divRelatorio').hide();

        $('#buttonExportar').prop('disabled', true);
        $('#buttonFecharMes').prop('disabled', true);
        $('#buttonExcluir').prop('disabled', true);

        $('#inputTextMesAno').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months"
        });


        var arrayRelatorio = [];
        var table = $('#tableRelatorio').DataTable();
        var selectedColaborador = null;
        var selectedMes = null;
        var VHSYS_MIGRACADO = 0; 
        var CHECKBOXMARCADOS = "";

        $(document).ready(function() {

            $('#inputTextMesAno').change(function() {
                
                $('#buttonExportar').prop('disabled', true);
                $('#buttonFecharMes').prop('disabled', true);
                $('#buttonExcluir').prop('disabled', true);                

                var mesano = "01/" + $('#inputTextMesAno').val();
                var mesano = mesano.split("/").reverse().join("-");        
                
                VHSYS_MIGRACADO = 0;
                CHECKBOXMARCADOS = "";

                fetchFechamentoMes(mesano);

            });


            $('#btnNao').click(function() {

                $("#divDialogoExclusao").fadeOut();

            });


            $('#btnSim').click(function() {

                if (CHECKBOXMARCADOS != "") {
                    deleteContaspagarVHSys(CHECKBOXMARCADOS);
                }

            });


            $('#buttonExportar').click(function() {

                var mesano = "01/" + $('#inputTextMesAno').val();
                var mesano = mesano.split("/").reverse().join("-");
                var htmlmsg;

                document.body.style.cursor = "wait";

                $('#buttonExportar').prop('disabled', true);
                $('#buttonExcluir').prop('disabled', true);  

                $.ajax({
                    url: "<?php echo base_url(); ?>administrativo/exportarvhsys/sendToContaspagar",
                    type: 'POST',
                    //dataType: 'text',
                    data: {
                        FMC_Mes: mesano
                    },

                    error: function(e, ts, et) {
                            console.log(e);

                            htmlmsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                            htmlmsg += e;
                            htmlmsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                            htmlmsg += '    <span aria-hidden="true">&times;</span>';
                            htmlmsg += '  </button>';
                            htmlmsg += '</div>';

                            $('#btnNao').click();
                            CHECKBOXMARCADOS = "";
                            $('#buttonExcluir').prop('disabled', true);
                            $('#divteste').html(htmlmsg);
                            $('#divteste').show();

                            setTimeout(function () { 
                                $('#divteste').html('');
                                $("#divteste").hide();
                            }, 7000);

                            document.body.style.cursor = "default";
                            $('#buttonExportar').prop('disabled', false);
                        },

                    success: function(data) {
                        console.log(data);
                        fetchFechamentoMes(mesano);

                        htmlmsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                        htmlmsg += data;
                        htmlmsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        htmlmsg += '    <span aria-hidden="true">&times;</span>';
                        htmlmsg += '  </button>';
                        htmlmsg += '</div>';

                        $('#btnNao').click();
                        CHECKBOXMARCADOS = "";
                        $('#buttonExcluir').prop('disabled', true);
                        $('#divteste').html(htmlmsg);
                        $('#divteste').show();

                        setTimeout(function () { 
                            $('#divteste').html('');
                            $("#divteste").hide();
                        }, 7000);

                        document.body.style.cursor = "default";
                        $('#buttonExportar').prop('disabled', false);
                        return data;
                    },
                })

            });


            $('#buttonExcluir').click(function() {

                $('#divteste').html('');
                $('#divteste').hide();
                $("#divDialogoExclusao").fadeIn();

            });


            $('#buttonFecharMes').click(function() {

                //$('#divteste').html('teste');
                //$('#divteste').show();
            });

        });


        function fetchFechamentoMes(mesano) {
  
            var v_VHSYSIDParceiro;
            var v_VHSYSIDLancamento;
            var v_VHSYSCC;
            var v_vhsys;
            var v_COLABORADOR;            

            document.body.style.cursor = "wait";

            $("#tablefechamentomes > tbody").html("");

			$.ajax({
				url: "<?php echo base_url(); ?>administrativo/exportarvhsys/fetchFechamentoMes",
                type: 'POST',
                dataType: 'json',  
                data: {
                  FMC_Mes: mesano
                },
				success: function (data) {
          
                    console.log(data);
                    var html = [];

                    for (var i = data.length - 1; i >= 0; i--) {
                        v_VHSYSIDParceiro = "";
                        v_VHSYSIDLancamento = "";
                        v_VHSYSCC = ""
                        v_vhsys = "";
                        v_COLABORADOR = data[i].PES_Nome + ' (' + data[i].FMC_CBRCodigo + ')';

                        if (data[i].CBR_VhSysClienteId > 0) {
                            v_VHSYSIDParceiro = data[i].CBR_VhSysClienteId;
                        }
                        if (data[i].PJT_VhSysCCustoId > 0) {
                            v_VHSYSCC = data[i].PJT_VhSysCCustoId;
                        }
                        if (data[i].FMC_VhSysLancamentoId > 0) {
                            v_VHSYSIDLancamento = data[i].FMC_VhSysLancamentoId;
                            VHSYS_MIGRACADO = 1;
                        }
                        if (data[i].FMC_CBRempCodigo > 0) {
                            v_COLABORADOR = '<del>' + v_COLABORADOR + '</del><P>' + data[i].PES_Empresa;
                        }                        

                        if (v_VHSYSIDParceiro == "" || v_VHSYSCC == "" ) {
                            v_vhsys = data[i].FMC_Codigo;
                        }
                        
                        html.push('<tr id="rs' + data[i].FMC_Codigo + '" class="danger" scope="row">');
                        html.push('<td scope="row">' + data[i].FMC_Codigo + '</td>');
                        if (v_VHSYSIDLancamento > 0) {
                            html.push('<td class="text-center">' + v_VHSYSIDLancamento + '<input type="checkbox" name="teste[]" onClick="CheckBoxVHSys();" id="' + data[i].FMC_Codigo + '" value="' + data[i].FMC_Codigo + '" /></td>');
                        } else {
                            html.push('<td></td>');
                        }
                        html.push('');
                        html.push('<td class="danger">' + v_VHSYSIDParceiro + '</td>');
                        html.push('<td>' + v_COLABORADOR + '</td>');
                        html.push('<td>' + v_VHSYSCC + '</td>');
                        html.push('<td>' + data[i].PJT_APELIDO + '</td>');
                        html.push('<td>' + data[i].FMC_CBUCodigo + '</td>');
                        html.push('<td class="text-right">' + data[i].FMC_RemuneraQuant + '</td>');
                        html.push('<td class="text-right">' + data[i].FMC_RemuneraValor + '</td>');
                        html.push('<td class="text-right">' + data[i].FMC_VrTotal + '</td>');
                        html.push('</tr>');

                    }
                    
                    if (data == "") {
                        $('#divRelatorio').hide();
                        $('#buttonExportar').prop('disabled', true);
                        $("#divDialogo").removeClass('alert-info');
                        $("#divDialogo").addClass('alert-danger');
                        $('#divDialogo').html('Nenhum registro para ' + $('#inputTextMesAno').val() + '.');
                        $('#divDialogo').show();
                    } else {
                        $('#tablefechamentomes').append(html);
                        fetchFechamentoMesEstat(mesano);
                        $('#divRelatorio').show();
                        $('#buttonExportar').prop('disabled', false);                      
                        //alert(VHSYS_MIGRACADO)
                        if (VHSYS_MIGRACADO > 0) {
                            $('#buttonFecharMes').prop('disabled', false);                                                 
                        }
                    }
				}
			});

            document.body.style.cursor = "default";

        }


        function fetchFechamentoMesEstat(mesano) {
        
            var html;
            var porcentagem;
            var pendentecolb = 0;
            var pendenteccusto = 0;
            var pendentemig = 0;

            $.ajax({
                url: "<?php echo base_url(); ?>administrativo/exportarvhsys/fetchFechamentoMesEstat",
                type: 'POST',
                dataType: 'json',  
                data: {
                    FMC_Mes: mesano
                },
                success: function (data) {
                    console.log(data);

                    html = '<h5>' + data[0].QTD_LINHAS + '<small class="text-muted"> Linha(s) | </small>';
                    html += data[0].QTD_COLBOGMA + '<small class="text-muted"> Colaboradore(s) | </small>';
                    pendentecolb = (data[0].QTD_COLBOGMA - data[0].QTD_COLBVHSYS);
                    if (pendentecolb > 0) {
                        //html +='<a href="#">' + pendentecolb + '<small class="text-muted"> Colaboradore(s) sem vínculo com VHSys | </small></a>';
                        html += '<input type="button" class="btn btn-link" style="font-weight: bold;" value="' + pendentecolb + ' Colaboradore(s) pendente vínculo com VHSys " /> | ';
                        //html += '<a href="#">' + pendentecolb + '<small class="text-muted"> Colaboradore(s) pendente vínculo com VHSys | </small></a>';
                    }
                    html += data[0].QTD_PROJETO + '<small class="text-muted"> Projeto(s) | </small>';
                    pendenteccusto = (data[0].QTD_PROJETO - data[0].QTD_CCUSTO);
                    if (pendenteccusto > 0) {
                        html += '<a>' + pendenteccusto + '<small class="text-muted"> Projeto(s) pendente vínculo VHSys | </small></a>';
                    }
                    html += data[0].TOT_HORAS + '<small class="text-muted"> Hora(s) </small></h5><p>';
                    if (data[0].QTD_LINHAS_MIGRADO > 0) {
                        porcentagem = (data[0].QTD_LINHAS_MIGRADO * data[0].QTD_LINHAS) / 100;
                        
                        html += '<h5>' + data[0].QTD_LINHAS_MIGRADO + '<small class="text-muted"> Linha(s) migrada(s) | </small>';
                        pendentemig = (data[0].QTD_LINHAS - data[0].QTD_LINHAS_MIGRADO);
                        if (pendentemig > 0) {
                            html += pendentemig + '<small class="text-muted"> Pendente(s) migração </small></h5><p>';
                        }
                        html += '<div class="progress" style="height: 20px;">';
                        html += '<div class="progress-bar" role="progressbar" style="width:' + porcentagem + '%;" aria-valuenow="' + porcentagem + '" aria-valuemin="0" aria-valuemax="100">' + porcentagem + ' %</div>';
                        html += '</div>';

                    }
                    $("#divDialogo").removeClass('alert-danger');
                    $("#divDialogo").addClass('alert-info');
                    $('#divDialogo').html(html);
                    $('#divDialogo').show();

                }
            });

        }


        function CheckBoxVHSys() {

            CHECKBOXMARCADOS = "";
            $('#divteste').html('');
            $('#divteste').hide();
                     
            $("input:checked").each(function(){
                console.log($(this).attr("id"));
                CHECKBOXMARCADOS += $(this).attr("id") + ',';
            });

            if (CHECKBOXMARCADOS == "") {
                $('#btnNao').click();
                $('#buttonExcluir').prop('disabled', true);
            } else {
                $('#buttonExcluir').prop('disabled', false);
            }
            
            CHECKBOXMARCADOS = CHECKBOXMARCADOS.substring( 0, CHECKBOXMARCADOS.length - 1);
        
        }


        function deleteContaspagarVHSys(FMC_Codigos) {

            document.body.style.cursor = "wait";
            var mesano = "01/" + $('#inputTextMesAno').val();
            var mesano = mesano.split("/").reverse().join("-");
            var htmlmsg;

            $.ajax({
                url: "<?php echo base_url(); ?>administrativo/exportarvhsys/deleteContaspagarVHSys",
                type: 'POST',
                //dataType: 'json',
                data: {
                    FMC_Codigos: FMC_Codigos
                },

                success: function(data) {
                    //data = JSON.parse(data).data;
                    console.log(data);
                    fetchFechamentoMes(mesano);
                    htmlmsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    htmlmsg += data;
                    htmlmsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    htmlmsg += '    <span aria-hidden="true">&times;</span>';
                    htmlmsg += '  </button>';
                    htmlmsg += '</div>';
                    $('#btnNao').click();
                    CHECKBOXMARCADOS = "";
                    $('#buttonExcluir').prop('disabled', true);
                    $('#divteste').html(htmlmsg);
                    $('#divteste').show();
                },

                error: function(request, status, error) {
                console.log(request.responseText);
                }
            });

            document.body.style.cursor = "default";
        }






    </script>



</body>

</html> 