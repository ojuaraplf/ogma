<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>wDiscovery</title>

    <?php $this->load->view('include/headerTop') ?>

</head>

<body style="background: #eeeeee;">


    <div id="main-wrapper">


        <?php $this->load->view('include/navbarHome') ?>
        <?php $this->load->view('include/asidebar') ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Mapeamento </h4>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">IMPLANTAÇÃO</h4>
                                <div class="border-top"></div>
                                <br />

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="selectIMPLANTACAO" class="text-left control-label col-form-label"> IMPLANTACAO </label>

                                        <select class="form-control" id="selectIMPLANTACAO">

                                        </select>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="selectogm_projeto" class="text-left control-label col-form-label"> Projeto </label>

                                        <select class="form-control" id="selectogm_projeto">
                                            <option> Selecione o projeto... </option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="selectogm_projetofase" class="text-left control-label col-form-label"> Fase </label>
                                        <select class="form-control" id="selectogm_projetofase">
                                        </select>
                                        <div class="invalid-feedback">
                                            <span> Nenhuma fase selecionada. </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-10">
                                        <label for="inputTextDSC_NOMEIMPLANTACAO" class="text-left control-label col-form-label"> Título </label>
                                        <input type="text" class="form-control" id="inputTextDSC_NOMEIMPLANTACAO" />
                                        <div class="invalid-feedback">
                                            <span> Necessário preencher o título. </span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="inputTextDAT_IMPLANTACAO" class="text-left control-label col-form-label"> Data </label>
                                        <input type="text" class="form-control" id="inputTextDAT_IMPLANTACAO" />
                                        <div class="invalid-feedback">
                                            <span> Necessário preencher a data. </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="textAreaDSC_IMPLANTACAO" class="text-left control-label col-form-label"> Descrição </label>
                                        <textarea class="form-control" rows="4" id="textAreaDSC_IMPLANTACAO"></textarea>
                                        <div class="invalid-feedback">
                                            <span> Necessário preencher a decrição. </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button class="btn btn-primary" id="btnSaveIMPLANTACAO"> Salvar </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">OBJETO</h4>
                                <div class="border-top"></div>

                                <div class="row mb-3">
                                    <div class="col-4 ">
                                        <label for="selectCHV_OBJETO" class="text-left control-label col-form-label"> CHV_OBJETO </label>
                                        <select class="form-control" id="selectCHV_OBJETO">
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-4 ">
                                        <label for="inputTextCOD_OBJETO" class="text-left control-label col-form-label"> COD_OBJETO </label>
                                        <input type="text" class="form-control" id="inputTextCOD_OBJETO" />
                                    </div>


                                    <div class="col-4 ">
                                        <label for="selectCHV_IMPLANTACAO" class="text-left control-label col-form-label"> CHV_IMPLANTACAO </label>
                                        <select class="form-control" id="selectCHV_IMPLANTACAO">
                                        </select>
                                    </div>
                                    <div class="col-4 ">
                                        <label for="selectCHV_TIPO_OBJETO" class="text-left control-label col-form-label"> CHV_TIPO_OBJETO </label>
                                        <select class="form-control" id="selectCHV_TIPO_OBJETO">
                                            <option> Selecione um tipo de objeto... </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 ">
                                        <label for="selectCHV_LOCAL_BD" class="text-left control-label col-form-label"> CHV_LOCAL_BD </label>
                                        <select class="form-control" id="selectCHV_LOCAL_BD">
                                            <option> Selecione um local do BD... </option>
                                        </select>
                                    </div>
                                </div>




                                <div class="row mb-3">
                                    <div class="col-4 ">
                                        <label for="inputTextDSC_OBJETOO" class="text-left control-label col-form-label"> DSC_OBJETO </label>
                                        <input type="text" class="form-control" id="inputTextDSC_OBJETO" />
                                    </div>
                                    <div class="col-4 ">
                                        <label for="inputTextDSC_DEFINICAO" class="text-left control-label col-form-label"> DSC_DEFINICAO </label>
                                        <input type="text" class="form-control" id="inputTextDSC_DEFINICAO" />
                                    </div>
                                    <div class="col-4 ">
                                        <label for="inputTextIND_VERSIONAMENTO" class="text-left control-label col-form-label"> IND_VERSIONAMENTO </label>
                                        <input type="text" class="form-control" id="inputTextIND_VERSIONAMENTO" />
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-4 ">
                                        <label for="inputTextDSC_REGRA_VERSIONAMENTO" class="text-left control-label col-form-label"> DSC_REGRA_VERSIONAMENTO </label>
                                        <input type="text" class="form-control" id="inputTextDSC_REGRA_VERSIONAMENTO" />
                                    </div>
                                    <div class="col-4 ">
                                        <label for="inputTextDSC_PERIODO_AFERICAO" class="text-left control-label col-form-label"> DSC_PERIODO_AFERICAO </label>
                                        <input type="text" class="form-control" id="inputTextDSC_PERIODO_AFERICAO" />
                                    </div>
                                    <div class="col-4 ">
                                        <label for="inputTextDSC_RETENCAO" class="text-left control-label col-form-label"> DSC_RETENCAO </label>
                                        <input type="text" class="form-control" id="inputTextDSC_RETENCAO" />
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 ">
                                        <label for="inputTextDSC_OBSERVACAO" class="text-left control-label col-form-label"> DSC_OBSERVACAO </label>
                                        <input type="text" class="form-control" id="inputTextDSC_OBSERVACAO" />
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button class="btn btn-primary" id="btnUpdateOBJETO"> Salvar </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">RELACIONAMENTO</h4>
                                <div class="border-top"></div>
                                <div class="row mb-3">
                                    <div class="col-6 ">
                                        <label for="selectCHV_OBJETO_ORIGEM" class="text-left control-label col-form-label"> CHV_OBJETO_ORIGEM </label>
                                        <select class="form-control" id="selectCHV_OBJETO_ORIGEM">
                                        </select>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="selectCHV_OBJETO_DESTINO" class="text-left control-label col-form-label"> CHV_OBJETO_DESTINO </label>
                                        <select class="form-control" id="selectCHV_OBJETO_DESTINO" size="20" multiple>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button class="btn btn-primary" id="btnUpdateRelacionamentos"> Salvar </button>
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
        </script>
</body>

</html>



<script tgcype="text/javascript">
    var comboboxLOCAL_BD = [];
    var comboboxTIPO_OBJETO = [];
    var comboboxOBJETOS = [];
    var comboboxIMPLANTACAO = [];
    var comboboxMAP_INDICADOR = [];
    var arrayOBJETO = [];
    var arrayIMPLANTACAO = [];


    loadSpinner();

    function fetchogm_projeto() {
        return $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchogm_projeto",
            type: 'POST',
            dataType: 'json'
        });
    }

    function fetchPJT_CODIGO(PJF_CODIGO) {
        $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchPJT_CODIGO",
            type: 'POST',
            dataType: 'json',
            data: {
                PJF_CODIGO: PJF_CODIGO,
            },
            success: function(data) {
                console.log(data);

                $('#selectogm_projeto').val(data[0].PJT_CODIGO);
                $("#selectogm_projetofase")[0].selectedIndex = -1;
                fetchogm_projetofase(data[0].PJT_CODIGO, PJF_CODIGO);


            }
        });
    }

    function fetchogm_projetofase(PJT_CODIGO, PJF_CODIGO) {
        loadBlurSpinner();
        $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchogm_projetofase",
            type: 'POST',
            dataType: 'json',
            data: {
                PJT_CODIGO: PJT_CODIGO,
            },
            success: function(data) {
                var selectogm_projetofase = [];
                for (var i = 0; i <= data.length - 1; i++) {
                    selectogm_projetofase.push('<option value="' + data[i].PJF_CODIGO + '"> ' + data[i].PJF_IDENTIFICACAOFASE + ' </option>');
                }
                $('#selectogm_projetofase').html('');
                $('#selectogm_projetofase').append(selectogm_projetofase);
                if (PJF_CODIGO != null) {
                    $('#selectogm_projetofase').val(PJF_CODIGO);
                }
                // console.log(data);
                removeSpinner();
            }
        });
    }
    fetchIMPLANTACAO();
    fetchOBJETO();

    $.when(fetchogm_projeto(), fetchLOCAL_BD(), fetchTIPO_OBJETO()).done(function(r1, r2, r3) {

        var selectogm_projeto = [];
        for (var i = 0; i <= r1[0].length - 1; i++) {
            selectogm_projeto.push('<option value="' + r1[0][i].PJT_CODIGO + '"> ' + r1[0][i].PJT_TITULO + ' </option>');
        }
        $('#selectogm_projeto').append(selectogm_projeto);

        for (var i = 0; i <= r2[0].length - 1; i++) {
            comboboxLOCAL_BD.push('<option value="' + r2[0][i].CHV_LOCAL_BD + '"> ' + r2[0][i].DSC_LOCAL_BD + ' </option>');
        }
        $('#selectCHV_LOCAL_BD').append(comboboxLOCAL_BD);

        for (var i = 0; i <= r3[0].length - 1; i++) {
            comboboxTIPO_OBJETO.push('<option value="' + r3[0][i].CHV_TIPO_OBJETO + '"> ' + r3[0][i].DSC_TIPO_OBJETO + ' </option>');
        }
        $('#selectCHV_TIPO_OBJETO').append(comboboxTIPO_OBJETO);


        // $.when().done(function() {
        removeSpinner();
        // });


    });

    $("#selectogm_projeto").on('change', function(e) {
        loadBlurSpinner();
        if (this.selectedIndex == 0) {
            $('#selectogm_projetofase').html('');
            return;
        }
        fetchogm_projetofase(this.value);
    });


    $('#inputTextDAT_IMPLANTACAO').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy",
        orientation: "bottom right",
        maxViewMode: 1
    });



    $('#btnSaveIMPLANTACAO').click(function() {
        $.when(updateIMPLANTACAO()).done(function() {

            removeSpinner();
        });
    });

    function updateIMPLANTACAO() {

        $('#selectogm_projetofase').removeClass('is-invalid');
        $('#inputTextDSC_NOMEIMPLANTACAO').removeClass('is-invalid');
        $('#inputTextDAT_IMPLANTACAO').removeClass('is-invalid');
        $('#textAreaDSC_IMPLANTACAO').removeClass('is-invalid');

        var isFormValid = true;

        var CHV_IMPLANTACAO = $('#selectIMPLANTACAO').val();
        var CHV_FASE = $('#selectogm_projetofase').val();
        var DSC_NOMEIMPLANTACAO = $('#inputTextDSC_NOMEIMPLANTACAO').val();
        var DAT_IMPLANTACAO = $('#inputTextDAT_IMPLANTACAO').val().split("/").reverse().join("-");
        var DSC_IMPLANTACAO = $('#textAreaDSC_IMPLANTACAO').val();

        if (CHV_FASE == null) {
            isFormValid = false;
            $('#selectogm_projetofase').addClass('is-invalid');
        }
        if (DSC_NOMEIMPLANTACAO == "") {
            isFormValid = false;
            $('#inputTextDSC_NOMEIMPLANTACAO').addClass('is-invalid');
        }
        if (DAT_IMPLANTACAO == "") {
            isFormValid = false;
            $('#inputTextDAT_IMPLANTACAO').addClass('is-invalid');
        }
        if (DSC_IMPLANTACAO == "") {
            isFormValid = false;
            $('#textAreaDSC_IMPLANTACAO').addClass('is-invalid');
        }

        if (!isFormValid) {
            return;
        }
        loadBlurSpinner();
        return $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/updateIMPLANTACAO",
            type: 'POST',
            data: {
                CHV_IMPLANTACAO: CHV_IMPLANTACAO,
                CHV_FASE: CHV_FASE,
                DSC_NOMEIMPLANTACAO: DSC_NOMEIMPLANTACAO,
                DAT_IMPLANTACAO: DAT_IMPLANTACAO,
                DSC_IMPLANTACAO: DSC_IMPLANTACAO
            },
            success: function() {
                $("#selectIMPLANTACAO")[0].selectedIndex = 0;
                $("#selectogm_projeto")[0].selectedIndex = 0;
                $("#selectogm_projetofase")[0].selectedIndex = -1;
                $('#inputTextDSC_NOMEIMPLANTACAO').val('');
                $('#inputTextDAT_IMPLANTACAO').val('');
                $('#textAreaDSC_IMPLANTACAO').val('');
                fetchIMPLANTACAO();
                toastr.success('Informações salvas com sucesso. ', 'Atualização');
            }
        });
    }


    function fetchLOCAL_BD() {
        return $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchLOCAL_BD",
            type: 'POST',
            dataType: 'json'
        });
    }

    function fetchTIPO_OBJETO() {
        return $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchTIPO_OBJETO",
            type: 'POST',
            dataType: 'json'
        });
    }


    function fetchIMPLANTACAO() {
        $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchIMPLANTACAO",
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                arrayIMPLANTACAO = [];
                arrayIMPLANTACAO = data;
                comboboxIMPLANTACAO = [];
                comboboxIMPLANTACAO.push('<option> Selecione uma implantação... </option>');
                for (var i = 0; i <= data.length - 1; i++) {
                    comboboxIMPLANTACAO.push('<option value="' + data[i].CHV_IMPLANTACAO + '"> ' + data[i].DSC_NOMEIMPLANTACAO + ' </option>');
                }
                $('#selectCHV_IMPLANTACAO').empty();
                $('#selectIMPLANTACAO').empty();
                $('#selectCHV_IMPLANTACAO').append(comboboxIMPLANTACAO);
                $('#selectIMPLANTACAO').append(comboboxIMPLANTACAO);
            }

        });
    }


    function fetchOBJETO() {

        $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchOBJETO",
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                arrayOBJETO = [];
                arrayOBJETO = data;
                comboboxOBJETOS = [];
                $('#selectCHV_OBJETO').html('');
                $('#selectCHV_OBJETO_ORIGEM').html('');
                $('#selectCHV_OBJETO_DESTINO').html('');
                comboboxOBJETOS.push('<option> Novo objeto ou selecione um objeto para edição... </option');
                for (var i = 0; i <= data.length - 1; i++) {
                    comboboxOBJETOS.push('<option value="' + data[i].CHV_OBJETO + '"> ' + data[i].CHV_OBJETO + ' - ' + data[i].DSC_OBJETO + ' </option>');
                }
                $('#selectCHV_OBJETO').append(comboboxOBJETOS);

                $('#selectCHV_OBJETO_ORIGEM').append(comboboxOBJETOS);
                $('#selectCHV_OBJETO_DESTINO').append(comboboxOBJETOS);

                $('#selectCHV_OBJETO_DESTINO option:eq(0)').remove();

                removeSpinner();
            }
        });
    }
    $('#selectIMPLANTACAO').change(function() {
        if (this.selectedIndex == 0) {
            $('#selectogm_projeto')[0].selectedIndex = 0;
            $('#selectogm_projetofase').html('');
            $('#inputTextDSC_NOMEIMPLANTACAO').val('');
            $('#inputTextDAT_IMPLANTACAO').val('');
            $('#textAreaDSC_IMPLANTACAO').val('');

            return;
        }
        loadBlurSpinner();
        var IMPLANTACAO = arrayIMPLANTACAO[getArrayIndexForKey(arrayIMPLANTACAO, 'CHV_IMPLANTACAO', $('#selectIMPLANTACAO').val())];
        fetchPJT_CODIGO(IMPLANTACAO.CHV_FASE);




        $('#inputTextDSC_NOMEIMPLANTACAO').val(IMPLANTACAO.DSC_NOMEIMPLANTACAO);
        $('#inputTextDAT_IMPLANTACAO').val(IMPLANTACAO.DAT_IMPLANTACAO.split("-").reverse().join("/"));
        $('#textAreaDSC_IMPLANTACAO').val(IMPLANTACAO.DSC_IMPLANTACAO);

    });

    $('#selectCHV_OBJETO').change(function() {

        if (this.selectedIndex == 0) {
            $('#inputTextCOD_OBJETO').val('');
            $('#selectCHV_IMPLANTACAO')[0].selectedIndex = 0;
            $('#selectCHV_TIPO_OBJETO')[0].selectedIndex = 0;
            $('#selectCHV_LOCAL_BD')[0].selectedIndex = 0;
            $('#inputTextDSC_OBJETO').val('');
            $('#inputTextDSC_DEFINICAO').val('');
            $('#inputTextIND_VERSIONAMENTO').val('');
            $('#inputTextDSC_REGRA_VERSIONAMENTO').val('');
            $('#inputTextDSC_PERIODO_AFERICAO').val('');
            $('#inputTextDSC_RETENCAO').val('');
            $('#inputTextDSC_OBSERVACAO').val('');
            return;
        }
        var OBJETO = arrayOBJETO[getArrayIndexForKey(arrayOBJETO, 'CHV_OBJETO', $('#selectCHV_OBJETO').val())];
        $('#inputTextCOD_OBJETO').val(OBJETO.COD_OBJETO);
        $('#selectCHV_IMPLANTACAO').val(OBJETO.CHV_IMPLANTACAO);
        $('#selectCHV_TIPO_OBJETO').val(OBJETO.CHV_TIPO_OBJETO);
        $('#selectCHV_LOCAL_BD').val(OBJETO.CHV_LOCAL_BD);
        $('#inputTextDSC_OBJETO').val(OBJETO.DSC_OBJETO);
        $('#inputTextDSC_DEFINICAO').val(OBJETO.DSC_DEFINICAO);
        $('#inputTextIND_VERSIONAMENTO').val(OBJETO.IND_VERSIONAMENTO);
        $('#inputTextDSC_REGRA_VERSIONAMENTO').val(OBJETO.DSC_REGRA_VERSIONAMENTO);
        $('#inputTextDSC_PERIODO_AFERICAO').val(OBJETO.DSC_PERIODO_AFERICAO);
        $('#inputTextDSC_RETENCAO').val(OBJETO.DSC_RETENCAO);
        $('#inputTextDSC_OBSERVACAO').val(OBJETO.DSC_OBSERVACAO);
    });


    $('#btnUpdateOBJETO').click(function() {
        loadBlurSpinner();
        $.when(updateOBJETO()).done(function() {
            toastr.success('Informações salvas com sucesso. ', 'Atualização');
            fetchOBJETO();
            $('#inputTextCOD_OBJETO').val('');
            // $('#selectCHV_IMPLANTACAO')[0].selectedIndex = 0;
            // $('#selectCHV_TIPO_OBJETO')[0].selectedIndex = 0;
            // $('#selectCHV_LOCAL_BD')[0].selectedIndex = 0;
            $('#inputTextDSC_OBJETO').val('');
            $('#inputTextDSC_DEFINICAO').val('');
            $('#inputTextIND_VERSIONAMENTO').val('');
            $('#inputTextDSC_REGRA_VERSIONAMENTO').val('');
            $('#inputTextDSC_PERIODO_AFERICAO').val('');
            $('#inputTextDSC_RETENCAO').val('');
            $('#inputTextDSC_OBSERVACAO').val('');
        });
    });

    function updateOBJETO() {
        var CHV_OBJETO = $('#selectCHV_OBJETO').val();
        var COD_OBJETO = $('#inputTextCOD_OBJETO').val();
        var CHV_IMPLANTACAO = $('#selectCHV_IMPLANTACAO').val();
        var CHV_TIPO_OBJETO = $('#selectCHV_TIPO_OBJETO').val();
        var CHV_LOCAL_BD = $('#selectCHV_LOCAL_BD').val();
        var DSC_OBJETO = $('#inputTextDSC_OBJETO').val();
        var DSC_DEFINICAO = $('#inputTextDSC_DEFINICAO').val();
        var IND_VERSIONAMENTO = $('#inputTextIND_VERSIONAMENTO').val();
        var DSC_REGRA_VERSIONAMENTO = $('#inputTextDSC_REGRA_VERSIONAMENTO').val();
        var DSC_PERIODO_AFERICAO = $('#inputTextDSC_PERIODO_AFERICAO').val();
        var DSC_RETENCAO = $('#inputTextDSC_RETENCAO').val();
        var DSC_OBSERVACAO = $('#inputTextDSC_OBSERVACAO').val();
        return $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/updateOBJETO",
            type: 'POST',
            data: {
                CHV_OBJETO: CHV_OBJETO,
                COD_OBJETO: COD_OBJETO,
                CHV_IMPLANTACAO: CHV_IMPLANTACAO,
                CHV_LOCAL_BD: CHV_LOCAL_BD,
                CHV_TIPO_OBJETO: CHV_TIPO_OBJETO,
                DSC_OBJETO: DSC_OBJETO,
                DSC_DEFINICAO: DSC_DEFINICAO,
                IND_VERSIONAMENTO: IND_VERSIONAMENTO,
                DSC_REGRA_VERSIONAMENTO: DSC_REGRA_VERSIONAMENTO,
                DSC_PERIODO_AFERICAO: DSC_PERIODO_AFERICAO,
                DSC_RETENCAO: DSC_RETENCAO,
                DSC_OBSERVACAO: DSC_OBSERVACAO,
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
        });
    }



    $.when().done(function(r1) {
        // for (var i = 0; i <= r3[0].length - 1; i++) {
        //     // comboboxOBJETOS.push('<option value="' + r3[0][i].CHV_OBJETO + '"> ' + r3[0][i].CHV_OBJETO + ' - ' + r3[0][i].DSC_OBJETO + ' </option>');
        //     comboboxOBJETOS.push('<option value="' + r3[0][i].CHV_OBJETO + '"> ' + r3[0][i].DSC_OBJETO + ' </option>');
        // }
        // $('#selectCHV_OBJETO_ORIGEM').append(comboboxOBJETOS);
        // $('#selectCHV_OBJETO_DESTINO').append(comboboxOBJETOS);


        // for (var i = 0; i <= r4[0].length - 1; i++) {
        //     // comboboxMAP_INDICADOR.push('<option value="' + r4[0][i].CHV_INDICADOR + '"> ' + r4[0][i].CHV_INDICADOR + ' - ' + r4[0][i].DSC_INDICADOR + ' </option>');
        //     comboboxMAP_INDICADOR.push('<option value="' + r4[0][i].CHV_INDICADOR + '"> ' + r4[0][i].DSC_INDICADOR + ' </option>');
        // }

        // $('#selectCHV_OBJETO_ORIGEM').append(comboboxMAP_INDICADOR);
        // $('#selectCHV_OBJETO_DESTINO').append(comboboxMAP_INDICADOR);

        // var mergedArray = $.merge(comboboxOBJETOS, comboboxMAP_INDICADOR);
        // console.log(mergedArray);

        // $("#selectCHV_OBJETO_ORIGEM").html($("#selectCHV_OBJETO_ORIGEM option").sort(function(a, b) {
        //     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
        // }))
        // $("#selectCHV_OBJETO_ORIGEM").val($("#selectCHV_OBJETO_ORIGEM option:first").val());
        // $("#selectCHV_OBJETO_DESTINO").html($("#selectCHV_OBJETO_DESTINO option").sort(function(a, b) {
        //     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
        // }))

        // removeSpinner();
    });





    $('#btnUpdateRelacionamentos').click(function() {
        loadBlurSpinner();
        $.when(updateOBJETO_RELACIONAMENTO()).done(function() {
            removeSpinner();
        });


    });




    // $('#inputTextCHV_OBJETO').focusout(function() {
    //     loadBlurSpinner();
    //     $.when(fetchObjeto($(this).val())).done(function(r1) {
    //         $('#selectCHV_BANCO_DESTINO').val(r1.CHV_BANCO_DESTINO);
    //         $('#selectCHV_TIPO_OBJETO').val(r1.CHV_TIPO_OBJETO);
    //         $('#inputTextDSC_OBJETO').val(r1.DSC_OBJETO);
    //         $('#inputTextDSC_DEFINICAO').val(r1.DSC_DEFINICAO);
    //         $('#inputTextIND_VERSIONAMENTO').val(r1.IND_VERSIONAMENTO);
    //         $('#inputTextDSC_REGRA_VERSIONAMENTO').val(r1.DSC_REGRA_VERSIONAMENTO);
    //         $('#inputTextDSC_PERIODO_AFERICAO').val(r1.DSC_PERIODO_AFERICAO);
    //         $('#inputTextDSC_RETENCAO').val(r1.DSC_RETENCAO);
    //         $('#inputTextDSC_OBSERVACAO').val(r1.DSC_OBSERVACAO);
    //         removeSpinner();
    //     });

    // });
    $('#selectCHV_OBJETO_ORIGEM').change(function() {
        loadBlurSpinner();
        $('#selectCHV_OBJETO_DESTINO').val([]);
        $.when(fetchOBJETO_RELACIONAMENTO($('#selectCHV_OBJETO_ORIGEM').val())).done(function(r1) {
            $('#selectCHV_OBJETO_DESTINO').focus();
            for (var i = 0; i <= r1.length - 1; i++) {
                $('#selectCHV_OBJETO_DESTINO ').children("option[value=" + r1[i].CHV_OBJETO_DESTINO + "]").prop("selected", true);
            }
            removeSpinner();
        });

    });

    function fetchOBJETO_RELACIONAMENTO(CHV_OBJETO_ORIGEM) {
        return $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/fetchOBJETO_RELACIONAMENTO",
            type: 'POST',
            dataType: 'json',
            data: {
                CHV_OBJETO_ORIGEM: CHV_OBJETO_ORIGEM
            }
        });
    }

    //

    function updateOBJETO_RELACIONAMENTO() {

        var arrayCHV_OBJETO_DESTINO = $('#selectCHV_OBJETO_DESTINO').val();
        var CHV_OBJETO_ORIGEM = $('#selectCHV_OBJETO_ORIGEM').val();

        return $.ajax({
            url: "<?php echo base_url(); ?>mapeamento/mapeamento/updateOBJETO_RELACIONAMENTO",
            type: 'POST',
            data: {
                CHV_OBJETO_ORIGEM: CHV_OBJETO_ORIGEM,
                arrayCHV_OBJETO_DESTINO: arrayCHV_OBJETO_DESTINO
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
        });
    }



    // function fetchMAP_INDICADOR() {
    //     return $.ajax({
    //         url: "<?php echo base_url(); ?>santaMaria/santaMaria/fetchMAP_INDICADOR",
    //         type: 'POST',
    //         dataType: 'json'
    //     });
    // }

    // function fetchObjeto(CHV_OBJETO) {
    //     return $.ajax({
    //         url: "<?php echo base_url(); ?>santaMaria/santaMaria/fetchObjeto",
    //         type: 'POST',
    //         dataType: 'json',
    //         data: {
    //             CHV_OBJETO: CHV_OBJETO
    //         }
    //     });
    // }
</script>