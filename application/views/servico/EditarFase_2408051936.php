<?php

if (!($this->session->has_userdata('userToken'))) {
    redirect('login');
}
?>


<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>wDiscovery</title>

    <?php $this->load->view('include/headerTop') ?>


    <style type="text/css">
        .spanDetalheProjetoTitulo {
            font-size: 14px;
            font-weight: bold;
        }

        .spanDetalheProjetoConteudo {
            font-size: 14px;
        }

        .rowProjeto {
            cursor: pointer;
        }

        #tableRiscos td {
            text-align: center;
            vertical-align: middle;
        }

        #tableAtividades td {
            text-align: center;
            vertical-align: middle;
        }

        html {
            visibility: hidden;
        }

        #tableAtividades,
        #tableAtividades tbody input[type='text'] {
            font-size: x-small;
        }


        .textColorRedRow td input[type=text] {
            color: red;
        }

        .textColorRedRow td {
            color: red;
        }


    </style>

</head>


<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navbarProjeto') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Plano de serviço <span id="spanNumeroProjeto"> - </span> - Fase <span id="spanNumeroFase"> - </span></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('listaProjeto/'); ?>">Plano de Serviço</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('detalheProjeto/') ?><?php echo $this->uri->segment(2); ?>">Detalhe
                                            Plano de Serviço</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Fase</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Detalhes do Plano de serviço</h4>
                                <hr />
                                <div class="row">
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Apelido: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanPJT_APELIDO"> - </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Cliente: </span><br /><span class="spanDetalheProjetoConteudo" id="spanCLI_NOMEFANTASIA"> - </span>
                                        <br />
                                    </div>
                                </div>
                                <br />
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Data Início: </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> - </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Data Término: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATATERMINO"> - </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Detalhes da Fase</h4>
                                <hr />
                                <div class="row">
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Identificação fase: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanPJF_IDENTIFICACAOFASE"> - </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Total de horas já apontadas: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanTotalHorasApontadas"> - </span>
                                    </div>
                                </div>
                                <br />
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Data Início: </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJF_DATAINICIO"> - </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo"> Data Término: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJF_DATATERMINO"> - </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="cabecalho-tab" data-toggle="tab" href="#cabecalho" role="tab" aria-controls="cabecalho" aria-selected="true">Cabeçalho</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="partesinteressadas-tab" data-toggle="tab" href="#partesinteressadas" role="tab" aria-controls="partesinteressadas" aria-selected="false">Partes Interessadas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="escopo-tab" data-toggle="tab" href="#escopo" role="tab" aria-controls="escopo" aria-selected="false">Declaração de Escopo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="execucao-tab" data-toggle="tab" href="#execucao" role="tab" aria-controls="execucao" aria-selected="false">Execuçao (WBS)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contigencias-tab" data-toggle="tab" href="#contigencias" role="tab" aria-controls="contigencias" aria-selected="false">Riscos</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="recursos" aria-selected="false">Recursos</a>
                                    </li>


                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <br />
                                    <div class="tab-pane fade show active" id="cabecalho" role="tabpanel" aria-labelledby="cabecalho-tab">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Identificação da fase </label>
                                                <input type="text" class="form-control" id="inputTextPJF_IDENTIFICACAOFASE" />
                                            </div>
                                            <div class="col-2">
                                                <label>Data início </label>
                                                <input type="text" class="form-control" id="inputTextPJF_DATAINICIO" />
                                            </div>
                                            <div class="col-2">
                                                <label>Data término </label>
                                                <input type="text" class="form-control" id="inputTextPJF_DATATERMINO" />
                                            </div>
                                            <div class="col-2">
                                                <label>QtHora </label>
                                                <input type="text" class="form-control" id="inputTextPJF_QTHORA" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="selectPJF_ItemWbsParaChamados" class="text-left control-label col-form-label">Grupo de atividades para chamados:</label>
                                                <select class="form-control" id="selectPJF_ItemWbsParaChamados">
                                                    <option> Selecione a atividade agrupadora para as criadas via chamados  </option>
                                                </select>
                                            </div>
                                        </div>  
                                        <br />

                                    </div>
                                    <div class="tab-pane fade" id="partesinteressadas" role="tabpanel" aria-labelledby="partesinteressadas-tab">
 
                                        <h4 id="labelFR"> - </h4>
                                        <table id="tableFornecedorRequisito" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40%;">Nome</th>
                                                    <th style="width: 44%;">Função no Plano de Serviço</th>
                                                    <th style="width: 4%;" id="inputCheckboxNotificaFornecedorRequisito"><i class="fas fa-envelope"></i></th>
                                                    <th style="width: 4%;" id="inputCheckboxPFocalFornecedorRequisito"><i class="fas fa-star"></i></th>
                                                    <th style="width: 4%;" id="addFornecedorRequisito"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                        <h4> Dependências e responsáveis</h4>
                                        <table id="tableDependenciaEResponsaveis" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 38%;">Dependência</th>
                                                    <th style="width: 38%;">Responsável</th>
                                                    <th style="width: 20%;">Data limite</th>
                                                    <th style="width: 4%" id="addDependenciaEResponsaveis"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="escopo" role="tabpanel" aria-labelledby="escopo-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Escopo da fase (detalhes que delineiam o que será feito nesta fase de
                                                    forma indiscutivelmente compreendida pelas partes)</label>
                                                <textarea class="form-control" rows="5" id="inputTextPJF_ESCOPO"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-12">
                                                <label> Escopo negativo da fase 6 (descrição sucinta de itens que não
                                                    são/serão considerados como escopo do Plano de Serviço) </label>
                                                <textarea class="form-control" rows="5" id="inputTextPJF_ESCOPONEGATIVO"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-12">
                                                <label id="labelRQ"> - </label>
                                                <textarea class="form-control" rows="5" id="inputTextPJF_REQUISITOS"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-12">
                                                <label> Entrega da fase (detalhes que delineiam a entrega (produto) desta
                                                    fase de forma indiscutivelmente compreendida pelas partes) </label>
                                                <textarea class="form-control" rows="5" id="inputTextPJF_ENTREGAFASE"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="execucao" role="tabpanel" aria-labelledby="escopo-tab">
                                        <div class="row">
                                            <div class="col-10">
                                                <h4> Atividades</h4>
                                            </div>
                                            <!-- <div class="col-2 text-right">
                                                <button class="btn btn-outline-success" id="btnChecklistWBS" data-toggle="tooltip"> WBS</button>
                                            </div> -->

                                        </div>
                                        <br />

                                        <table id="tableAtividades" class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%; text-align: center;"></th>
                                                    <th style="width: 5%; text-align: center;">ID</th>
                                                    <th style="width: 10%; text-align: center;">Ordem</th>
                                                    <th style="width: 40%;">Descrição da atividade</th>
                                                    <th style="width: 8%; text-align: center;">QtHora</th>
                                                    <th style="width: 5%; text-align: center;">%</th>
                                                    <th style="width: 5%; text-align: center;">Horas lançadas</th>
                                                    <th style="width: 5%; text-align: center;">Inicio e Fim Estimados</th>
                                                    <th style="width: 5%; text-align: center;" id="addAtividade"><i class="fas fa-plus-square"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade" id="contigencias" role="tabpanel" aria-labelledby="contigencias-tab">


                                        <!-- <div class="row">
                                            <div class="col-12">
                                                <label> Aspectos de privacidade, confidencialidade e segurança </label>
                                                <textarea class="form-control" rows="5" id="inputTextPJF_PRIVACIDADE"></textarea>
                                            </div>
                                        </div> -->


                                        <br />

                                        <div class="row">
                                            <div class="col-10">
                                                <h4> Previsão de riscos para a fase </h4>
                                            </div>
                                            <div class="col-2 text-right">
                                                <button class="btn btn-outline-success" id="btnChecklistRIS" data-toggle="tooltip"> RIS</button>
                                            </div>

                                        </div>
                                        <br />

                                        <table id="tableRiscos" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 60%;">Descrição</th>
                                                    <th style="width: 10%; text-align: center;">Probabilidade <br /> (1 a 5)</th>
                                                    <th style="width: 10%; text-align: center;">Impacto <br /> (1 a 5)</th>
                                                    <th style="width: 10%; text-align: center;">Prioridade <br /> (3 a 15)</th>
                                                    <th style="width: 10%; text-align: center;" id="addRisco"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>


                                    </div>

                                    <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Recursos materiais da fase </label>
                                                <textarea class="form-control" rows="5" id="inputTextPJF_RECURSOSMATERIAIS"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <h4 id="labelEX"> - </h4>
                                        <table id="tableEquipeFase" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30%;" id="RecProfissa">Profissional atuante</th>
                                                    <th style="width: 30%;" id="RecAtuacao">Atuação no Plano de Serviço</th>
                                                    <th style="width: 14%;" id="RecIniData">Início da atuação</th>
                                                    <th style="width: 4%;" id="RecInihora">h</th>
                                                    <th style="width: 14%;" id="RecFimData">Término da atuação</th>
                                                    <th style="width: 4%;" id="RecFimHora">h</th>
                                                    <th style="width: 4%" id="addEquipe"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr>
                        <td >
                            <select class="form-control" id="comboboxEquipe">
                            </select>
                        </td>
                        <td><input type="text" class="form-control" id="inputTextFuncaoEquipeFase" /></td>
                        <td id="delete"><i class="fas fa-trash-alt"></i></td>
                        </tr> -->
                                            </tbody>
                                        </table>
                                        <br />

                                        <h4> Tecnologias </h4>
                                        <table id="tableTecnologias" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 96%;">Tecnologia</th>
                                                    <!-- <th style="width: 48%;">Função</th> -->
                                                    <th style="width: 4%" id="addTecnologia"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>




                                            </tbody>
                                        </table>






                                    </div>


                                </div>
                                <br />
                                <button class="btn btn-primary" id="btnUpdateFase"> Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                © 2019 wDiscovery Ltda.
            </footer>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalDetalhesGrupoAtividades') ?>
    <?php $this->load->view('modal/modalDetalhesGrupoAtividadesAssociadas') ?>
    <?php $this->load->view('modal/modalConfirmarAssociacaoAtividades') ?>
    <?php $this->load->view('modal/modalChecklist') ?>
    <?php $this->load->view('modal/modalChecklistItemDetalhes') ?>
    <?php $this->load->view('modal/modalRiscoDetalhes') ?>
    <?php $this->load->view('modal/modalEsforcoPERT') ?>



    <script type="text/javascript">
        loadSpinner();
        setInputTextHints();

        var optionsColaborador = [];
        var optionsCargos = [];
        var optionsCliente = [];
        var options_ogsv_TLG_Tecnologia = [];
        var optionsogma_PES_Selecao02 = [];
        var arrayAtividades = [];
        var arrayToDeletePFR = [];

        // FETCHING COLABORADOR --------------------------------------------------------------------------------
        var jsonArrayColaborador = JSON.parse(localStorage.arrayColaborador);
        var htmlColaborador = [];
        for (var i = jsonArrayColaborador.length - 1; i >= 0; i--) {
            htmlColaborador.push('<option value="' + jsonArrayColaborador[i].CODIGO + '">' + jsonArrayColaborador[i].COLABORADOR + '</option>');
        }
        optionsColaboradores = htmlColaborador;
        $('#comboboxATG_CBRCodigo').append("<option value='0'>Selecione...</option>");
        $('#comboboxATG_CBRCodigo').append(htmlColaborador);
        // -----------------------------------------------------------------------------------------------------

        // FETCHING CARGO --------------------------------------------------------------------------------------
        var jsonArrayCargo = JSON.parse(localStorage.arrayCargo);
        var htmlCargo = [];
        for (var i = jsonArrayCargo.length - 1; i >= 0; i--) {
            htmlCargo.push('<option value="' + jsonArrayCargo[i].CGO_Codigo + '">' + jsonArrayCargo[i].CGO_Titulo + '</option>');
        }
        optionsCargos = htmlCargo;
        // -----------------------------------------------------------------------------------------------------

        // FETCHUNG CONTATO DETALHES ---------------------------------------------------------------------------
        var jsonArrayContatoDetalhe = JSON.parse(localStorage.arrayContatoDetalhe);
        var htmlContatoDetalhe = [];
        for (var i = jsonArrayContatoDetalhe.length - 1; i >= 0; i--) {
            htmlContatoDetalhe.push('<option value="' + jsonArrayContatoDetalhe[i].a006_cd_contato + '">' + jsonArrayContatoDetalhe[i].a006_nm_contato + '</option>');
        }
        optionsCliente = htmlContatoDetalhe;
        $('#comboboxFocal').append("<option></option>");
        $('#comboboxFocal').append(optionsCliente);
        $('#comboboxResponsavel').append("<option></option>");
        $('#comboboxResponsavel').append(optionsCliente);
        // -----------------------------------------------------------------------------------------------------

        // FETCHING TECNOLOGIAS  --------------------------------------------------------------------------------------
        var jsonArray_ogsv_TLG_Tecnologia = JSON.parse(localStorage.array_ogsv_TLG_Tecnologia);
        var html_ogsv_TLG_Tecnologia = [];
        for (var i = jsonArray_ogsv_TLG_Tecnologia.length - 1; i >= 0; i--) {
            html_ogsv_TLG_Tecnologia.push('<option value="' + jsonArray_ogsv_TLG_Tecnologia[i].TLG_CODIGO + '">' + jsonArray_ogsv_TLG_Tecnologia[i].TLG_DESCRICAO + '</option>');
        }
        options_ogsv_TLG_Tecnologia = html_ogsv_TLG_Tecnologia;
        // -----------------------------------------------------------------------------------------------------

        // FETCHING fetchogma_PES_Selecao02  --------------------------------------------------------------------------------------
        var jsonArrayogma_PES_Selecao02 = JSON.parse(localStorage.arrayogma_PES_Selecao02);
        var htmlogma_PES_Selecao02 = [];
        htmlogma_PES_Selecao02.push('<option>Selecione um fornecedor de requisito...</option>');
        for (var i = 0; i <= jsonArrayogma_PES_Selecao02.length - 1; i++) {
            htmlogma_PES_Selecao02.push('<option value="' + jsonArrayogma_PES_Selecao02[i].CODIGO + '">' + jsonArrayogma_PES_Selecao02[i].PESSOA + '</option>');
        }
        optionsogma_PES_Selecao02 = htmlogma_PES_Selecao02;
        // -----------------------------------------------------------------------------------------------------




        // console.log(htmlogma_PES_Selecao02);








        $('#liServico').addClass('selected');
        $('#liServicoProjeto').addClass('active');
        $('#ulServico').addClass('in');

        // $('#btnChecklistWBS').click(function() {

        //     selectedCKL_ProcedCodigoAcro = "WBS";
        //     selectedCKL_CGOCodigo = 6;
        //     selectedCKL_ProcedCodigo = <?php echo $this->uri->segment(3); ?>;

        //     $('#modalChecklist').modal('show');

        // });
        $('#btnChecklistRIS').click(function() {

            selectedCKL_ProcedCodigoAcro = "RIS";
            selectedCKL_CGOCodigo = 8;
            selectedCKL_ProcedCodigo = <?php echo $this->uri->segment(3); ?>;

            $('#modalChecklist').modal('show');

        });










        var comboboxEquipeCount = 0;
        var comboboxCargoCount = 0;
        var comboboxTecnologiaCount = 0;
        var comboboxFornecedorRequisitoCount = 0;
        var comboboxDependenciaEResponsaveis = 0;
        var comboboxCargo = 0;

        var deletedRowsAtividade = [];

        var isEquipeChanged = false;
        var isFornecedorRequisitoChanged = false;
        var isDependenciaEResponsaveisChanged = false;
        var isTecnologiasChanged = false;

        var selectedDetalheAtividade = "";

        var arrayAtividadesToDeleteDetalhes = [];

        var arrayDeletedRiscos = [];
        var comboboxEquipeFase = [];

        var arrayContatoDetalhe = [];
        var arrayRiscos = [];


        var selectedFase = [];

        var CSI_FlgCHDgeraATG = 0;


        var json_array_ogsv_CIL_ItemCatalogoLabel = JSON.parse(localStorage.array_ogsv_CIL_ItemCatalogoLabel);

        console.log(json_array_ogsv_CIL_ItemCatalogoLabel);
        var selectedProject = [];
        $.when(fetchFase(), fetchEquipeFase(), fetchFornecedorRequisitoFase(), fetchDependenciaEResponsaveis(), fetchAtividadesFase(), fetchProjeto(), fetchEquipeFaseAlocada(), fetchRiscoFase(), fetchTotalHorasApontadas(), fetchCatalogoServicoItemDetalhes(), fetch_ogsv_PJL_TecnologiaFase(), fetchAtgItemGrande() ).done(function(r1, r2, r3, r4, r5, r6, r7, r8, r9, r10, r11, r12) {

            // console.log(arrayLabels);
            // console.log(r6[0]["PJT_ITEMCAS"]);

            // var arrayLabels = $.map(json_array_ogsv_CIL_ItemCatalogoLabel, function(i) {
            //     if (i["CIL_CSICodigo"] != r6[0]["PJT_ITEMCAS"])
            //         return null;
            //     return i;
            // });
            
            // console.log(arrayLabels);
            // $('#labelEX').text(arrayLabels[getArrayIndexForKey(arrayLabels, "CIL_ProjAcronimo", "EX")].CIL_ShowDescricao);
            // $('#labelFR').text(arrayLabels[getArrayIndexForKey(arrayLabels, "CIL_ProjAcronimo", "FR")].CIL_ShowDescricao);
            // $('#labelRQ').text(arrayLabels[getArrayIndexForKey(arrayLabels, "CIL_ProjAcronimo", "RQ")].CIL_ShowDescricao);


            // console.log(r11[0]);

            // console.table(r2);
            
            console.log(r2[0][0].PEQ_CODCBR);
            console.log(r2[0][0].PEQ_CODCARGO);
            
           // MudaDateTime(pDataVinda, pDataOuHora) {

        

            //Fetch Tecnologias Fase--------------------------------------------------------------------------
            comboboxEquipeCount = r2[0].length;
            comboboxCargoCount = r2[0].length;
            for (var i = 0; i <= r2[0].length - 1; i++) {
                var htmlTableEquipeFase = []
                htmlTableEquipeFase.push('<tr><td><select class="form-control" id="comboboxEquipe' + i + '">');
                htmlTableEquipeFase.push(optionsColaboradores);
                htmlTableEquipeFase.push('</select> </td>');
                htmlTableEquipeFase.push('<td><select class="form-control" id="comboboxCargo' + i + '">');
                htmlTableEquipeFase.push(optionsCargos);
                htmlTableEquipeFase.push('<td><input type="Date" class="form-control" id="CampoPEQ_DataIniAtuacao' + i + '">');
                htmlTableEquipeFase.push('<td><input type="Time" class="form-control" id="CampoPEQ_TimeIniAtuacao' + i + '">');
                htmlTableEquipeFase.push('<td><input type="Date" class="form-control" id="CampoPEQ_DataFimAtuacao' + i + '">');
                htmlTableEquipeFase.push('<td><input type="Time" class="form-control" id="CampoPEQ_TimeFimAtuacao' + i + '">');
                htmlTableEquipeFase.push('</select></td><td id="delete"><i class="fas fa-trash-alt"></i></td></tr>');
                $('#tableEquipeFase').append(htmlTableEquipeFase.join(''));
                $('#comboboxEquipe' + i).val(r2[0][i].PEQ_CODCBR);
                $('#comboboxEquipe' + i).change();
                $('#comboboxCargo' + i).val(r2[0][i].PEQ_CODCARGO);
                $('#comboboxCargo' + i).change();

                if (r2[0][i].PEQ_MomIniAtuacao != null) {
                    $('#CampoPEQ_DataIniAtuacao' + i).val(r2[0][i].PEQ_MomIniAtuacao.substring(0, 10));                    
                    $('#CampoPEQ_TimeIniAtuacao' + i).val(r2[0][i].PEQ_MomIniAtuacao.substring(11, 16));                    
                } else {
                    $('#CampoPEQ_DataIniAtuacao' + i).val('0000-00-00');    
                    $('#CampoPEQ_TimeIniAtuacao' + i).val('00:00');
                }
                $('#CampoPEQ_DataIniAtuacao' + i).change();
                $('#CampoPEQ_TimeIniAtuacao' + i).change();

                if (r2[0][i].PEQ_MomFimAtuacao != null) {
                    $('#CampoPEQ_DataFimAtuacao' + i).val(r2[0][i].PEQ_MomFimAtuacao.substring(0, 10));                   
                    $('#CampoPEQ_TimeFimAtuacao' + i).val(r2[0][i].PEQ_MomFimAtuacao.substring(11, 16));                    
                } else {
                    $('#CampoPEQ_DataFimAtuacao' + i).val('0000-00-00');    
                    $('#CampoPEQ_TimeFimAtuacao' + i).val('00:00');
                }
                $('#CampoPEQ_DataFimAtuacao' + i).change();
                $('#CampoPEQ_TimeFimAtuacao' + i).change();
                
                // $('#inputTextFuncaoEquipeFase' + i).val(r2[0][i].PEQ_CODCARGO);


                $('#comboboxCargo' + i).change(function() {
                    isEquipeChanged = true;
                });

                $('#comboboxEquipe' + i).change(function() {
                    isEquipeChanged = true;
                });

                $('#CampoPEQ_DataIniAtuacao' + i).change(function() {
                    isEquipeChanged = true;
                });

                $('#CampoPEQ_TimeIniAtuacao' + i).change(function() {
                    isEquipeChanged = true;
                });

                $('#CampoPEQ_DataFimAtuacao' + i).change(function() {
                    isEquipeChanged = true;
                });

                $('#CampoPEQ_TimeFimAtuacao' + i).change(function() {
                    isEquipeChanged = true;
                });

            }
            //-------------------------------------------------------------------------------------------


            console.log(r9[0]);
            console.log(r6[0]);

            if (r9[0] != "") {
                $('#spanTotalHorasApontadas').text(r9[0]);
            }
            CSI_FlgCHDgeraATG = r10[0].CSI_FlgCHDgeraATG;
            selectedFase = r1[0];
            //Fetch Fase
            $('#spanNumeroFase').text(r1[0].PJF_ORDEMFASE);
            $('#spanNumeroProjeto').text(<?php echo $this->uri->segment(2); ?>);
            $('#inputTextPJF_IDENTIFICACAOFASE').val(r1[0].PJF_IDENTIFICACAOFASE);

            $('#spanPJF_IDENTIFICACAOFASE').text(r1[0].PJF_IDENTIFICACAOFASE);

            if (r1[0].PJF_DATAINICIO != null) {
                $('#inputTextPJF_DATAINICIO').val(r1[0].PJF_DATAINICIO.split("-").reverse().join("/"));
                $('#spanPJF_DATAINICIO').text(r1[0].PJF_DATAINICIO.split("-").reverse().join("/"));
            }
            if (r1[0].PJF_DATATERMINO != null) {
                $('#inputTextPJF_DATATERMINO').val(r1[0].PJF_DATATERMINO.split("-").reverse().join("/"));
                $('#spanPJF_DATATERMINO').text(r1[0].PJF_DATATERMINO.split("-").reverse().join("/"));
            }

            $('#inputTextPJF_QTHORA').val(r1[0].PJF_QTHORA);
            $('#inputTextPJF_RECURSOSMATERIAIS').val(r1[0].PJF_RECURSOSMATERIAIS);

            $('#comboboxFocal').val(r1[0].PJF_CODFOCALCLI);
            $('#inputTextPJF_FUNCAOFOCAL').val(r1[0].PJF_FUNCAOFOCAL);
            $('#comboboxResponsavel').val(r1[0].PJF_CONTATOHOMOLOGENTREGA);
            $('#inputTextPJF_FUNCCONTATOHOMOLOG').val(r1[0].PJF_FUNCCONTATOHOMOLOG);

            $('#inputTextPJF_ESCOPO').val(r1[0].PJF_ESCOPO);
            $('#inputTextPJF_ESCOPONEGATIVO').val(r1[0].PJF_ESCOPONEGATIVO);
            $('#inputTextPJF_REQUISITOS').val(r1[0].PJF_REQUISITOS);
            $('#inputTextPJF_ENTREGAFASE').val(r1[0].PJF_ENTREGAFASE);

            // $('#inputTextPJF_PRIVACIDADE').val(r1[0].PJF_PRIVACIDADE);

            //Fetch Tecnologia Fase--------------------------------------------------------------------------
            comboboxTecnologiaCount = r11[0].length;
            for (var i = 0; i <= r11[0].length - 1; i++) {
                var htmlTableTecnologiasFase = []
                htmlTableTecnologiasFase.push('<tr id="' + r11[0][i].PJL_PJFCodigo + '_' + r11[0][i].PJL_TLGCodigo + '"><td><select class="form-control" id="comboboxTecnologia' + i + '">');
                htmlTableTecnologiasFase.push(options_ogsv_TLG_Tecnologia);
                htmlTableTecnologiasFase.push('</select> </td>');
                htmlTableTecnologiasFase.push('<td id="delete"><i class="fas fa-trash-alt"></i></td></tr>');
                $('#tableTecnologias').append(htmlTableTecnologiasFase.join(''));
                $('#comboboxTecnologia' + i).val(r11[0][i].PJL_TLGCodigo);
                $('#comboboxTecnologia' + i).change();
            }
            //-------------------------------------------------------------------------------------------

            //Fetch Fornecedor Requisito-----------------------------------------------------------------
            comboboxFornecedorRequisitoCount = r3[0].length;
            for (var i = 0; i <= r3[0].length - 1; i++) {
                var htmlTableFornecedorRequisito = []
                htmlTableFornecedorRequisito.push('<tr id="' + r3[0][i].PFR_CODIGO + '"><td><select class="form-control" id="comboboxFornecedorRequisito' + i + '">');
                htmlTableFornecedorRequisito.push(optionsogma_PES_Selecao02);
                htmlTableFornecedorRequisito.push('</select></td> ');
                htmlTableFornecedorRequisito.push('<td><input type="text" class="form-control" id="inputTextFuncaoFornecedorRequisito'  + i + '" /></td> ' +
                                                  '<td><input type="checkbox" id="inputCheckboxNotificaFornecedorRequisito' + i + '" /></td> ' +
                                                  '<td><input type="checkbox" id="inputCheckboxPFocalFornecedorRequisito' + i + '" /></td>' +
                                                  '<td id="delete"><i class="fas fa-trash-alt"></i></td></tr>' );
                $('#tableFornecedorRequisito').append(htmlTableFornecedorRequisito.join(''));
                $('#comboboxFornecedorRequisito' + i).val(r3[0][i].PFR_PESCodigo);
                $('#inputTextFuncaoFornecedorRequisito' + i).val(r3[0][i].PFR_FUNCAO);
                $('#inputCheckboxNotificaFornecedorRequisito' + i).prop('checked', r3[0][i].PRF_FlgRecebeEmail == 1);
                $('#inputCheckboxPFocalFornecedorRequisito' + i).prop('checked', r3[0][i].PRF_FlgPessoaFocal == 1);
                
                $("#inputTextFuncaoFornecedorRequisito" + i).on("input", function() {
                    isFornecedorRequisitoChanged = true;
                });
                $("#inputCheckboxNotificaFornecedorRequisito" + i).on("input", function() {
                    isFornecedorRequisitoChanged = true;
                });

                $("#inputCheckboxPFocalFornecedorRequisito" + i).on("input", function() {
                    isFornecedorRequisitoChanged = true;
                });
            }

            //Fetch Dependencia Responsaveis------------------------------------------------------------------------

            comboboxDependenciaEResponsaveis = r4[0].length;
            for (var i = 0; i <= r4[0].length - 1; i++) {
                var htmlTableDependenciaEResponsaveis = []
                htmlTableDependenciaEResponsaveis.push('<tr><td><input type="text" class="form-control" id="inputTextFuncaoDependenciaEResponsaveis' + i + '"/></td>');
                htmlTableDependenciaEResponsaveis.push('<td><select class="form-control" id="comboboxDependenciaEResponsaveis' + i + '">');
                htmlTableDependenciaEResponsaveis.push(optionsCliente);
                htmlTableDependenciaEResponsaveis.push('</select><td><input type="text" class="form-control" id="inputTextDataLimiteDependencia' + i + '" /></td>');
                htmlTableDependenciaEResponsaveis.push('<td id="delete"><i class="fas fa-trash-alt"></i></td></tr>');
                $('#tableDependenciaEResponsaveis').append(htmlTableDependenciaEResponsaveis.join(''));

                $('#comboboxDependenciaEResponsaveis' + i).val(r4[0][i].DEP_CLICOD);
                $('#comboboxDependenciaEResponsaveis' + i).change();

                $('#inputTextFuncaoDependenciaEResponsaveis' + i).val(r4[0][i].DEP_DESCRICAO);
                $('#inputTextDataLimiteDependencia' + i).val(r4[0][i].DEP_DATALIMITE.split("-").reverse().join("/"));

                $("#inputTextFuncaoDependenciaEResponsaveis" + i).on("input", function() {
                    isDependenciaEResponsaveisChanged = true;
                });
                $("#inputtextDataLimiteDependencia" + i).on("input", function() {
                    isDependenciaEResponsaveisChanged = true;
                });
                $('#comboboxDependenciaEResponsaveis' + i).change(function() {
                    isDependenciaEResponsaveisChanged = true;
                });
                $('#inputTextDataLimiteDependencia' + i).mask("00r00r0000", {
                    translation: {
                        'r': {
                            pattern: /[\/]/,
                            fallback: '/'
                        },
                        placeholder: "__/__/____"
                    },
                    placeholder: "DD/MM/AAAA"
                });


            }
            //------------------------------------------------------------------------------------------------------

            //COMBOBOX Grupo da WBS para chamados
            arrayGrupoWbsChamado = r12[0];
            var html = [];
            for (var i = r12[0].length - 1; i >= 0; i--) {
                html.push('<option value="' + r12[0][i].ITEM + '">' + r12[0][i].ATIVIDADE + '</option>');
            }
            $('#selectPJF_ItemWbsParaChamados').append(html.join(''));

            $('#selectPJF_ItemWbsParaChamados').val(r1[0].PJF_ItemWbsParaChamados == null ? "none" : ("00" + r1[0].PJF_ItemWbsParaChamados).slice(-2));

            arrayAtividades = r5[0];
            for (var i = 0; i <= r5[0].length - 1; i++) {
                
                let isTaskNotBillable = r5[0][i].ATG_QTHORA != null && r5[0][i].ATG_ISENTA == 1 ? '<i style="color: red;" class="fas fa-dollar-sign">' : ""; 
                let iconCheckMark = r5[0][i].ATG_FlgPrioridadeEstrategica == 1 ? r5[0][i].ATG_FlgAtividadeAuditoriaRealizada == 1 ? '<i style="color: limegreen;" class="fas fa-check-double">' : '<i style="color: darkgray;" class="fas fa-check">' : '';

                var htmlTableAtividades = [];

                if (r5[0][i].ATG_ORDEM.slice(-8) == '00.00.00') {
                    rowAtividade1 += 1
                    htmlTableAtividades.push('<tr style="background-color: #A0A0A0;" id="rowAtividade' + padZero(rowAtividade1) + '_' + r5[0][i].ATG_CODIGO + '">');
                    htmlTableAtividades.push('<td>'+ isTaskNotBillable + '&nbsp;' + iconCheckMark +' </td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_CODIGO + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_ORDEM + '" disabled /><div class="progress m-t-15"><div class="progress-bar" role="progressbar" style="width: ' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div></td>');
                    htmlTableAtividades.push('<td><input type="text" id="inputTextDescricao" class="form-control" value="' + r5[0][i].ATG_DESCRICAO + '" ></td>');
                    if (r5[0][i].ATG_QTHORA == null) {
                        htmlTableAtividades.push('<td><input type="text" id="inputTextQtHora" class="form-control" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + ((r5[0][i].HLATIVIDADE != null) ? parseFloat(r5[0][i].HLATIVIDADE).toFixed(2) : " - ") + '" disabled /></td>');
                        htmlTableAtividades.push('<td></td>');
                        htmlTableAtividades.push('<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add1" class="fas fa-plus-square"></i></td>');
                    } else {
                        htmlTableAtividades.push('<td><input type="text" id="inputTextQtHora" class="form-control" value="' + r5[0][i].ATG_QTHORA + '" /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + ((r5[0][i].HLATIVIDADE != null) ? parseFloat(r5[0][i].HLATIVIDADE).toFixed(2) : " - ") + '" disabled /></td>');
                        htmlTableAtividades.push('<td><span>' + r5[0][i].ATG_MomInicExecucaoInformado + ' <br />' + r5[0][i].ATG_MomFinalExecucaoInformado + '</span></td>');
                        htmlTableAtividades.push('<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add1" class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;<i id="detalheAtividade" class="fas fa-info-circle"></i></td>');
                    }
                } else if (r5[0][i].ATG_ORDEM.slice(-5) == '00.00') {
                    rowAtividade11 += 1;
                    htmlTableAtividades.push('<tr style="background-color: #C0C0C0;" id="rowAtividade' + padZero(rowAtividade1) + padZero(rowAtividade11) + '_' + r5[0][i].ATG_CODIGO + '">');
                    htmlTableAtividades.push('<td>'+ isTaskNotBillable + '&nbsp;' + iconCheckMark +' </td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_CODIGO + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_ORDEM + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" id="inputTextDescricao" class="form-control" value="' + r5[0][i].ATG_DESCRICAO + '" ></td>');
                    if (r5[0][i].ATG_QTHORA == null) {
                        htmlTableAtividades.push('<td><input type="text" id="inputTextQtHora" class="form-control" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + ((r5[0][i].HLATIVIDADE != null) ? parseFloat(r5[0][i].HLATIVIDADE).toFixed(2) : " - ") + '" disabled /></td>');
                        htmlTableAtividades.push('<td></td>');
                        htmlTableAtividades.push('<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add11" class="fas fa-plus-square"></i></td>');
                    } else {
                        htmlTableAtividades.push('<td><input type="text" id="inputTextQtHora" class="form-control" value="' + r5[0][i].ATG_QTHORA + '" /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + ((r5[0][i].HLATIVIDADE != null) ? parseFloat(r5[0][i].HLATIVIDADE).toFixed(2) : " - ") + '" disabled /></td>');
                        var inicio = r5[0][i].ATG_MomInicExecucaoInformado == null ? '-' : r5[0][i].ATG_MomInicExecucaoInformado.split(" ")[0].split("-").reverse().join("/");
                        var fim = r5[0][i].ATG_MomFinalExecucaoInformado == null ? '-' : r5[0][i].ATG_MomFinalExecucaoInformado.split(" ")[0].split("-").reverse().join("/")
                        htmlTableAtividades.push('<td><span>' + inicio + ' <br />' + fim + '</span></td>');
                        htmlTableAtividades.push('<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add11" class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;<i id="detalheAtividade" class="fas fa-info-circle"></i></td>');
                    }
                } else if (r5[0][i].ATG_ORDEM.slice(-2) == '00') {
                    rowAtividade111 += 1;
                    htmlTableAtividades.push('<tr style="background-color: #E0E0E0;" id="rowAtividade' + padZero(rowAtividade1) + padZero(rowAtividade11) + padZero(rowAtividade111) + '_' + r5[0][i].ATG_CODIGO + '">');
                    htmlTableAtividades.push('<td>'+ isTaskNotBillable + '&nbsp;' + iconCheckMark +' </td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_CODIGO + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_ORDEM + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" id="inputTextDescricao" class="form-control" value="' + r5[0][i].ATG_DESCRICAO + '" ></td>');
                    if (r5[0][i].ATG_QTHORA == null) {
                        htmlTableAtividades.push('<td><input type="text" id="inputTextQtHora" class="form-control" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + ((r5[0][i].HLATIVIDADE != null) ? parseFloat(r5[0][i].HLATIVIDADE).toFixed(2) : " - ") + '" disabled /></td>');
                        htmlTableAtividades.push('<td></td>');
                        htmlTableAtividades.push('<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add111" class="fas fa-plus-square"></i></td>');
                    } else {
                        htmlTableAtividades.push('<td><input type="text" id="inputTextQtHora" class="form-control" value="' + r5[0][i].ATG_QTHORA + '" /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '" disabled /></td>');
                        htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + ((r5[0][i].HLATIVIDADE != null) ? parseFloat(r5[0][i].HLATIVIDADE).toFixed(2) : " - ") + '" disabled /></td>');
                        var inicio = r5[0][i].ATG_MomInicExecucaoInformado == null ? '-' : r5[0][i].ATG_MomInicExecucaoInformado.split(" ")[0].split("-").reverse().join("/");
                        var fim = r5[0][i].ATG_MomFinalExecucaoInformado == null ? '-' : r5[0][i].ATG_MomFinalExecucaoInformado.split(" ")[0].split("-").reverse().join("/")
                        htmlTableAtividades.push('<td><span>' + inicio + ' <br />' + fim + '</span></td>');
                        htmlTableAtividades.push('<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add111" class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;<i id="detalheAtividade" class="fas fa-info-circle"></i></td>');
                    }
                } else {
                    rowAtividade1111 += 1;
                    htmlTableAtividades.push('<tr style="background-color: #FFFFFF;" id="rowAtividade' + padZero(rowAtividade1) + padZero(rowAtividade11) + padZero(rowAtividade111) + padZero(rowAtividade1111) + '_' + r5[0][i].ATG_CODIGO + '">');
                    htmlTableAtividades.push('<td>'+ isTaskNotBillable + '&nbsp;' + iconCheckMark +' </td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_CODIGO + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" class="form-control no-border" value="' + r5[0][i].ATG_ORDEM + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" id="inputTextDescricao" class="form-control" value="' + r5[0][i].ATG_DESCRICAO + '" ></td>');
                    htmlTableAtividades.push('<td><input type="text" id="inputTextQtHora" class="form-control" value="' + r5[0][i].ATG_QTHORA + '" ></td>');
                    htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + r5[0][i].ATG_PORCENTAGEMAPRONTADA + '" disabled /></td>');
                    htmlTableAtividades.push('<td><input type="text" id="inputTextHLATIVIDADE" class="form-control" value="' + ((r5[0][i].HLATIVIDADE != null) ? parseFloat(r5[0][i].HLATIVIDADE).toFixed(2) : " - ") + '" disabled /></td>');
                    var inicio = r5[0][i].ATG_MomInicExecucaoInformado == null ? '-' : r5[0][i].ATG_MomInicExecucaoInformado.split(" ")[0].split("-").reverse().join("/");
                    var fim = r5[0][i].ATG_MomFinalExecucaoInformado == null ? '-' : r5[0][i].ATG_MomFinalExecucaoInformado.split(" ")[0].split("-").reverse().join("/")
                    htmlTableAtividades.push('<td><span>' + inicio + ' <br />' + fim + '</span></td>');
                    htmlTableAtividades.push('<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="detalheAtividade" class="fas fa-info-circle"></i></td>');
                }
                htmlTableAtividades.push('</tr>');

                $('#tableAtividades').append(htmlTableAtividades.join(''));
                if (CSI_FlgCHDgeraATG == 1) {
                    $('[id^=inputTextDescricao]').attr('disabled', true);
                }
            }

            selectedProject = r6[0];

            $('#spanPJT_APELIDO').text(r6[0].PJT_APELIDO);
            $('#spanCLI_NOMEFANTASIA').text(r6[0].a004_nm_fantasia);
            if (r6[0].PJT_DATAINICIO != null) {
                $('#spanPJT_DATAINICIO').text(r6[0].PJT_DATAINICIO.split("-").reverse().join("/"));
            }
            if (r6[0].PJT_DATATERMINO != null) {
                $('#spanPJT_DATATERMINO').text(r6[0].PJT_DATATERMINO.split("-").reverse().join("/"));
            }


            comboboxEquipeCount = r2[0].length;
            $('#comboboxEquipeAlocada').attr('size', r7[0].length);
            for (var i = 0; i <= r2[0].length - 1; i++) {
                var htmlTableEquipeAlocada = [];

                htmlTableEquipeAlocada.push('<option value="' + r7[0][i].PEQ_CODCBR + '"> ' + r7[0][i].COLABORADOR + ' </option>');
                $('#comboboxEquipeAlocada').append(htmlTableEquipeAlocada);
            }


            $('[id=detalheAtividade]').hover(function() {
                $(this).css("cursor", "pointer");
            });
            $('[id=deleteAtividade]').hover(function() {
                $(this).css("cursor", "pointer");
            });
            $('[id^=add]').hover(function() {
                $(this).css("cursor", "pointer");
            });

            arrayRiscos = r8[0];
            //Fetch Contigências -----------------------------------------------------------------
            for (var i = 0; i <= r8[0].length - 1; i++) {
                var htmlTableRiscos = [];
                htmlTableRiscos.push('<tr id="' + r8[0][i].PFR_Codigo + '">');
                htmlTableRiscos.push('<td><input type="text" class="form-control" id="inputTextRiscoDescricao' + i + '" value="' + r8[0][i].PFR_DescricaoRisco + '" /> </td>');
                htmlTableRiscos.push('<td><input type="number" class="form-control" style="text-align: center;" id="inputTextRiscoProbabilidade' + i + '" value="' + r8[0][i].PFR_Probabilidade + '" /> </td>');
                htmlTableRiscos.push('<td><input type="number" class="form-control" style="text-align: center;" id="inputTextRiscoImpacto' + i + '" value="' + r8[0][i].PFR_Impacto + '" /> </td>');
                htmlTableRiscos.push('<td><input type="number" class="form-control" style="text-align: center;" id="inputTextRiscoExposicao' + i + '" value="' + r8[0][i].PFR_Exposicao + '" /> </td>');

                htmlTableRiscos.push('<td><i id="deleteRisco" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="detalheRisco" class="fas fa-info-circle"></i></td>');

                // htmlTableRiscos.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmlTableRiscos.push('</tr>');
                $('#tableRiscos').append(htmlTableRiscos.join(''));


            }
            $('[id=deleteRisco]').hover(function() {
                $(this).css("cursor", "pointer");
            });
            $('[id=detalheRisco]').hover(function() {
                $(this).css("cursor", "pointer");
            });

            $('[id^=inputTextRiscoProbabilidade], [id^=inputTextRiscoImpacto]').on('input', function() {
                var value = $(this).val();
                if ((value !== '') && (value.indexOf('.') === -1)) {
                    $(this).val(Math.max(Math.min(value, 5), 0));
                }
            });
            $('[id^=inputTextRiscoExposicao]').on('input', function() {
                var value = $(this).val();
                if ((value !== '') && (value.indexOf('.') === -1)) {
                    $(this).val(Math.max(Math.min(value, 15), 0));
                }
            });

            removeSpinner();
        });

        // function fetchContatoDetalhe() {
        //     return $.ajax({
        //         url: "<?php echo base_url(); ?>editarFase/fetchContatoDetalhe",
        //         dataType: 'json'
        //     });
        // }

        function fetchCatalogoServicoItemDetalhes() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchCatalogoServicoItemDetalhes",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                }
            });
        }


        function fetchColaboradores() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchColaboradores",
                dataType: 'json'
            });
        }

        function fetchCargos() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchCargos",
                dataType: 'json'
            });
        }

        $('#addEquipe').click(function() {
            isEquipeChanged = true;
            comboboxEquipeCount += 1;
            comboboxCargoCount += 1;
            var html = '<tr>';
            html += '<td><select class="form-control" id="comboboxEquipe' + comboboxEquipeCount + '"><option></option></select></td>';
            html += '<td><select class="form-control" id="comboboxCargo' + comboboxCargoCount + '"><option></option></select></td>';
            html += '<td><input type="Date" class="form-control" id="CampoPEQ_DataIniAtuacao' + comboboxCargoCount + '">';
            html += '<td><input type="Time" class="form-control" id="CampoPEQ_TimeIniAtuacao' + comboboxCargoCount + '">';
            html += '<td><input type="Date" class="form-control" id="CampoPEQ_DataFimAtuacao' + comboboxCargoCount + '">';
            html += '<td><input type="Time" class="form-control" id="CampoPEQ_TimeFimAtuacao' + comboboxCargoCount + '">';
            html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
            html += '</tr>';
            $('#tableEquipeFase tbody').append(html);
            $('#comboboxEquipe' + comboboxEquipeCount).append(optionsColaboradores);
            $('#comboboxCargo' + comboboxCargoCount).append(optionsCargos);
        });

        $('#addRisco').click(function() {
            var html = '<tr>';
            html += '<td><input type="text" class="form-control" /> </td>';
            html += '<td><input type="number" class="form-control" id="inputTextRiscoProbabilidade" style="text-align: center;" /> </td>';
            html += '<td><input type="number" class="form-control" id="inputTextRiscoImpacto" style="text-align: center;" /> </td>';
            html += '<td><input type="number" class="form-control" id="inputTextRiscoExposicao" style="text-align: center;" /> </td>';
            html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
            html += '</tr>';
            $('#tableRiscos tbody').append(html);

            $('[id^=inputTextRiscoProbabilidade], [id^=inputTextRiscoImpacto]').on('input', function() {
                var value = $(this).val();
                if ((value !== '') && (value.indexOf('.') === -1)) {
                    $(this).val(Math.max(Math.min(value, 5), 0));
                }
            });
            $('[id^=inputTextRiscoExposicao]').on('input', function() {
                var value = $(this).val();
                if ((value !== '') && (value.indexOf('.') === -1)) {
                    $(this).val(Math.max(Math.min(value, 15), 0));
                }
            });


        });
        $('#addTecnologia').click(function() {

            isTecnologiasChanged = true;

            var html = '<tr>';
            html += '<td><select class="form-control" id="comboboxCargo">' + options_ogsv_TLG_Tecnologia + '</select></td>';
            html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
            html += '</tr>';
            $('#tableTecnologias tbody').append(html);
        });


        $('#addFornecedorRequisito').click(function() {
            isFornecedorRequisitoChanged = true;
            comboboxFornecedorRequisitoCount += 1;
            var htmlTableFornecedorRequisito = []
            htmlTableFornecedorRequisito.push('<tr><td><select class="form-control" id="comboboxFornecedorRequisito' + comboboxFornecedorRequisitoCount + '">');
            htmlTableFornecedorRequisito.push(optionsogma_PES_Selecao02);
            htmlTableFornecedorRequisito.push( '</select></td>' + 
                                                '<td><input type="text" class="form-control" id="inputTextFuncaoFornecedorRequisito' + comboboxFornecedorRequisitoCount + '" /></td>' + 
                                                '<td><input type="checkbox" id="inputCheckboxNotificaFornecedorRequisito' + comboboxFornecedorRequisitoCount + '" /></td>' + 
                                                '<td><input type="checkbox" id="inputCheckboxPFocalFornecedorRequisito' + comboboxFornecedorRequisitoCount + '" /></td>' + 
                                                '<td id="delete"><i class="fas fa-trash-alt"></i></td></tr>');
            $('#tableFornecedorRequisito tbody').append(htmlTableFornecedorRequisito.join(''));
        });

        $('#addDependenciaEResponsaveis').click(function() {
            isDependenciaEResponsaveisChanged = true;
            comboboxDependenciaEResponsaveis += 1;
            var htmlTableDependenciaEResponsaveis = []
            htmlTableDependenciaEResponsaveis.push('<tr><td><input type="text" class="form-control" id="inputTextFuncaoDependenciaEResponsaveis' + comboboxDependenciaEResponsaveis + '"/></td>');
            htmlTableDependenciaEResponsaveis.push('<td><select class="form-control" id="comboboxDependenciaEResponsaveis' + comboboxDependenciaEResponsaveis + '">');
            htmlTableDependenciaEResponsaveis.push('<option></option>');
            htmlTableDependenciaEResponsaveis.push(optionsCliente);
            htmlTableDependenciaEResponsaveis.push('</select><td><input type="text" class="form-control" id="inputTextDataLimiteDependencia' + comboboxDependenciaEResponsaveis + '" /></td>');
            htmlTableDependenciaEResponsaveis.push('<td id="delete"><i class="fas fa-trash-alt"></i></td></tr>');
            $('#tableDependenciaEResponsaveis').append(htmlTableDependenciaEResponsaveis.join(''));

            $('#inputTextDataLimiteDependencia' + comboboxDependenciaEResponsaveis).mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                },
                placeholder: "DD/MM/AAAA"
            });


        });

        function fetchProjeto() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchProjeto",
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                },
                dataType: "json"
            });
        }

        function fetchFamiliaAtividade() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchFamiliaAtividade",
                type: 'POST',
                dataType: "json"
            });
        }


        function fetchFase() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchFase",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json'
            });
        }

        function fetchEquipeFase() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchEquipeFase",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json'
            });
        }

        function fetchEquipeFaseAlocada() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchEquipeFaseAlocada",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json'
            });
        }


        function fetch_ogsv_PJL_TecnologiaFase() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetch_ogsv_PJL_TecnologiaFase",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json',
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            });
        }

        function fetchFornecedorRequisitoFase() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchFornecedorRequisitoFase",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json'
            });
        }


        function fetchTotalHorasApontadas() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchTotalHorasApontadas",
                type: 'POST',
                dataType: 'text',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                }

            });
        }


        function fetchRiscoFase() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchRiscoFase",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json'
            });
        }


        function fetchDependenciaEResponsaveis() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchDependenciaEResponsaveis",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json'
            });
        }

        function fetchAtividadesFase() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchAtividadesFase",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
                dataType: 'json',

                error: function(request, status, error) {
                    console.log(request.responseText);
                }

            });
        }

        $('#btnUpdateFase').click(function() {
            loadBlurSpinner();
            $.when(updateFase(), updateEquipe(), updateFornecedorRequisito(), updateDependenciaEResponsaveis(), updateAtividades(), deleteAtividades(), deleteDetalhesAtividades(), updateRiscos(), deleteRiscos(), updateTecnologias()).done(function(r1, r2, r3, r4, r5, r6, r7, r8, r9, r10) {
                location.reload();
            });
        });

        function updateFase() {

            var PJF_IDENTIFICACAOFASE = $('#inputTextPJF_IDENTIFICACAOFASE').val();
            var PJF_DATAINICIO = $('#inputTextPJF_DATAINICIO').val().split("/").reverse().join("-");
            var PJF_DATATERMINO = $('#inputTextPJF_DATATERMINO').val().split("/").reverse().join("-");
            var PJF_QTHORA = $('#inputTextPJF_QTHORA').val();
            var PJF_RECURSOSMATERIAIS = $('#inputTextPJF_RECURSOSMATERIAIS').val();
            var PJF_CODFOCALCLI = $('#comboboxFocal').val();
            var PJF_FUNCAOFOCAL = $('#inputTextPJF_FUNCAOFOCAL').val();
            var PJF_CONTATOHOMOLOGENTREGA = $('#comboboxResponsavel').val();
            var PJF_FUNCCONTATOHOMOLOG = $('#inputTextPJF_FUNCCONTATOHOMOLOG').val();
            var PJF_ESCOPO = $('#inputTextPJF_ESCOPO').val();
            var PJF_ESCOPONEGATIVO = $('#inputTextPJF_ESCOPONEGATIVO').val();
            var PJF_REQUISITOS = $('#inputTextPJF_REQUISITOS').val();
            var PJF_ENTREGAFASE = $('#inputTextPJF_ENTREGAFASE').val();
            var PJF_ItemWbsParaChamados = $('#selectPJF_ItemWbsParaChamados').val();

            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/updateFase",
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>,
                    PJF_IDENTIFICACAOFASE: PJF_IDENTIFICACAOFASE,
                    PJF_DATAINICIO: PJF_DATAINICIO,
                    PJF_DATATERMINO: PJF_DATATERMINO,
                    PJF_QTHORA: PJF_QTHORA,
                    PJF_RECURSOSMATERIAIS: PJF_RECURSOSMATERIAIS,
                    PJF_CODFOCALCLI: PJF_CODFOCALCLI,
                    PJF_FUNCAOFOCAL: PJF_FUNCAOFOCAL,
                    PJF_CONTATOHOMOLOGENTREGA: PJF_CONTATOHOMOLOGENTREGA,
                    PJF_FUNCCONTATOHOMOLOG: PJF_FUNCCONTATOHOMOLOG,
                    PJF_ESCOPO: PJF_ESCOPO,
                    PJF_ESCOPONEGATIVO: PJF_ESCOPONEGATIVO,
                    PJF_REQUISITOS: PJF_REQUISITOS,
                    PJF_ENTREGAFASE: PJF_ENTREGAFASE,
                    PJF_ItemWbsParaChamados: PJF_ItemWbsParaChamados
                    // PJF_PRIVACIDADE: PJF_PRIVACIDADE
                },

            });
        }

        function updateEquipe() {
            if (isEquipeChanged == false) {
                return true
            }
            var arrayEquipe = [];
            $('#tableEquipeFase').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                PEQ_CODCBR = $tds.eq(0).find('option:selected').val();
                // $tds.find('input').each(function () {
                PEQ_CODCARGO = $tds.eq(1).find('option:selected').val();
                // })
                PEQ_MomIniAtuacao =  $tds.eq(2).find('input').val() + ' ' + $tds.eq(3).find('input').val() + ':00';
                PEQ_MomFimAtuacao =  $tds.eq(4).find('input').val() + ' ' + $tds.eq(5).find('input').val() + ':00';

                console.log("no update");
                console.log(PEQ_MomIniAtuacao);
                console.log(PEQ_MomFimAtuacao);
                
                // **** Colocado provisoriamente para não ter erro de integridade no banco quando não
                // informado o cargo do membro da equipe (alvaro-04/11/2021)
                PEQ_CODCARGO = PEQ_CODCARGO == '' ? 8 : PEQ_CODCARGO;
                // ****
                
                // ****
                PJF_CODIGO = <?php echo $this->uri->segment(3); ?>;
                arrayEquipe.push([PEQ_CODCBR, PEQ_CODCARGO, PJF_CODIGO, PEQ_MomIniAtuacao, PEQ_MomFimAtuacao]);
            });
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/updateEquipe",
                type: 'POST',
                data: {
                    arrayEquipe: arrayEquipe
                },
            });
        }

        function fetchAtgItemGrande() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/fetchAtgItemGrande",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJF_CODIGO: <?php echo $this->uri->segment(3); ?>
                },
            });
        }

        function updateFornecedorRequisito() {
            if (isFornecedorRequisitoChanged == false) {
                return true
            }
            var arrayToInsertPFR = [];
            var arrayToUpdatePFR = [];
            $('#tableFornecedorRequisito').find('tr').slice(1).each(function(i, el) {
                console.log(el.id);
                var $tds = $(this).find('td');
                PFR_PESCodigo = $tds.eq(0).find('option:selected').val();
                PFR_FUNCAO = $tds.eq(1).find('input').val();
                PJF_CODIGO = <?= $this->uri->segment(3); ?>;
                PRF_FlgRecebeEmail = $tds.eq(2).find('input').is(':checked') == true ? 1 : 0;
                PRF_FlgPessoaFocal = $tds.eq(3).find('input').is(':checked') == true ? 1 : 0;
                PFR_CODIGO = el.id

                if (PFR_CODIGO) {
                    arrayToUpdatePFR.push({'PFR_CODIGO' : PFR_CODIGO, 'PFR_PESCodigo': PFR_PESCodigo, 'PFR_FUNCAO': PFR_FUNCAO,  'PJF_CODIGO': PJF_CODIGO, 'PRF_FlgRecebeEmail': PRF_FlgRecebeEmail, 'PRF_FlgPessoaFocal': PRF_FlgPessoaFocal});
                } else {
                    arrayToInsertPFR.push({'PFR_PESCodigo': PFR_PESCodigo, 'PFR_FUNCAO': PFR_FUNCAO,  'PJF_CODIGO': PJF_CODIGO, 'PRF_FlgRecebeEmail': PRF_FlgRecebeEmail, 'PRF_FlgPessoaFocal': PRF_FlgPessoaFocal});
                }
            });

            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/updateFornecedorRequisito",
                type: 'POST',
                data: {
                    arrayToInsertPFR: arrayToInsertPFR,
                    arrayToUpdatePFR: arrayToUpdatePFR,
                    arrayToDeletePFR: arrayToDeletePFR
                },

            });
        }

        function updateTecnologias() {
            var arrayTecnologias = [];
            $('#tableTecnologias').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td'),
                    PJL_TLGCodigo = $tds.eq(0).find('option:selected').val(),
                    PJF_CODIGO = <?php echo $this->uri->segment(3); ?>;
                arrayTecnologias.push([PJL_TLGCodigo, PJF_CODIGO]);

            });

            $.ajax({
                url: "<?php echo base_url(); ?>editarFase/updateTecnologias",
                type: 'POST',
                data: {
                    PJL_PJFCodigo: <?php echo $this->uri->segment(3); ?>,
                    arrayTecnologias: arrayTecnologias
                },
                success: function(data) {
                    console.log(data);
                },

                error: function(request, status, error) {
                    console.log(request.responseText);
                }

            });
        }

        function updateRiscos() {

            var arrayRiscos = [];


            $('#tableRiscos').find('tr').slice(1).each(function(i, el) {

                var idRisco = $(this).attr('id');
                var $tds = $(this).find('td');
                var PFR_DescricaoRisco = $tds.find('input').eq(0).val();
                var PFR_Probabilidade = $tds.find('input').eq(1).val();
                var PFR_Impacto = $tds.find('input').eq(2).val();
                var PFR_Exposicao = $tds.find('input').eq(3).val();
                var PJF_CODIGO = <?php echo $this->uri->segment(3); ?>;

                arrayRiscos.push([idRisco, PFR_DescricaoRisco, PFR_Probabilidade, PFR_Impacto, PFR_Exposicao, PJF_CODIGO]);
            });
            $.ajax({
                url: "<?php echo base_url(); ?>editarFase/updateRiscos",
                type: 'POST',
                data: {
                    arrayRiscos: arrayRiscos
                }
            });
        }


        function updateDependenciaEResponsaveis() {
            if (isDependenciaEResponsaveisChanged == false) {
                return true
            }
            var arrayDependenciaEResponsaveis = [];
            $('#tableDependenciaEResponsaveis').find('tr').slice(1).each(function(i, el) {

                var $tds = $(this).find('td'),
                    DEP_DESCRICAO = $tds.eq(0).find('input').val(),
                    DEP_CLICOD = $tds.eq(1).find('option:selected').val(),
                    DEP_DATALIMITE = $tds.eq(2).find('input').val().split("/").reverse().join("-"),
                    PJF_CODIGO = <?php echo $this->uri->segment(3); ?>;
                arrayDependenciaEResponsaveis.push([DEP_DESCRICAO, DEP_CLICOD, DEP_DATALIMITE.split("/").reverse().join("-"), PJF_CODIGO]);
            });
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/updateDependenciaEResponsaveis",
                type: 'POST',
                data: {
                    arrayDependenciaEResponsaveis: arrayDependenciaEResponsaveis
                },
            });
        }


        function deleteDetalhesAtividades() {
            var arrayToDelete = deletedRowsAtividade.concat(arrayAtividadesToDeleteDetalhes);

            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/deleteDetalhesAtividades",
                type: 'POST',
                data: {
                    arrayToDelete: arrayToDelete
                },
            });

        }


        function deleteAtividades() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/deleteAtividades",
                type: 'POST',
                data: {
                    deletedAtividades: deletedRowsAtividade
                },
            });
        }

        function deleteRiscos() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/deleteRiscos",
                type: 'POST',
                data: {
                    arrayDeletedRiscos: arrayDeletedRiscos
                },
            });
        }


        function updateAtividades() {

            // if (isEquipeChanged == false) {
            // 	return true
            // }

            var arrayAtividades = [];

            $('#tableAtividades').find('tr').slice(1).each(function(i, el) {

                var rowId = $(this).attr('id');
                if (rowId.split('_')[1] == null) {
                    idAtividade = null;
                } else {
                    idAtividade = rowId.split('_')[1];
                }


                var $tds = $(this).find('td'),
                    ATG_ORDEM = $tds.find('input').eq(1).val();
                ATG_DESCRICAO = $tds.find('input').eq(2).val();
                if ($tds.find('input').eq(3).is(':disabled')) {
                    ATG_QTHORA = null;
                } else if ($tds.find('input').eq(3).val() == '') {
                    ATG_QTHORA = 0;
                } else {
                    ATG_QTHORA = $tds.find('input').eq(3).val();
                }

                var ATG_MomInicExecucao = selectedFase["PJF_DATAINICIO"] + " 08:00:00";
                var PJF_DATAINICIO = selectedFase["PJF_DATAINICIO"];

                PJF_CODIGO = <?php echo $this->uri->segment(3); ?>;
                arrayAtividades.push([ATG_ORDEM, ATG_DESCRICAO, ATG_QTHORA, PJF_CODIGO, idAtividade, ATG_MomInicExecucao, PJF_DATAINICIO]);
            });

            return $.ajax({
                url: "<?php echo base_url(); ?>editarFase/updateAtividades",
                type: 'POST',
                data: {
                    arrayAtividades: arrayAtividades
                }
            });
        }

        

        $(document).on('click', '#delete', function() {
            if ($(this).parent().parent().parent().attr('id') == "tableEquipeFase") {
                isEquipeChanged = true;
            } else if ($(this).parent().parent().parent().attr('id') == "tableFornecedorRequisito") {
                isFornecedorRequisitoChanged = true;
                const idPFR = $(this).parent().attr('id');
                arrayToDeletePFR.push(idPFR);
            } else if ($(this).parent().parent().parent().attr('id') == "tableDependenciaEResponsaveis") {
                isDependenciaEResponsaveisChanged = true;
            }
            $(this).parent().remove();
        });


        var rowAtividade1 = 0
        var rowAtividade11 = 0
        var rowAtividade111 = 0
        var rowAtividade1111 = 0

        function padZero(number) {
            return Array(Math.max(2 - String(number).length + 1, 0)).join(0) + number;
        }

        function reloadTableOrderNumber() {

            $('[id=detalheAtividade]').prop('disabled', true);

            $('[id=detalheAtividade]').hover(function() {
                $(this).css("cursor", "no-drop");
            });


            var addRowAtividade1 = 0;
            var addRowAtividade11 = 0;
            var addRowAtividade111 = 0;
            var addRowAtividade1111 = 0;
            $('#tableAtividades tbody tr').each(function(key, val) {
                var currentRowID = $(this).attr('id');


                switch (currentRowID.split('_')[0].length) {
                    case 14:
                        addRowAtividade1 = addRowAtividade1 + 1;
                        $('#' + currentRowID).find('td input').eq(1).val(padZero(addRowAtividade1) + '.00.00.00');
                        addRowAtividade11 = 0;
                        addRowAtividade111 = 0;
                        addRowAtividade1111 = 0;
                        break;
                    case 16:
                        addRowAtividade11 = addRowAtividade11 + 1;

                        $('#' + currentRowID).find('td input').eq(1).val(padZero(addRowAtividade1) + '.' + padZero(addRowAtividade11) + '.00.00');
                        addRowAtividade111 = 0;
                        addRowAtividade1111 = 0;
                        break;
                    case 18:
                        addRowAtividade111 = addRowAtividade111 + 1;
                        $('#' + currentRowID).find('td input').eq(1).val(padZero(addRowAtividade1) + '.' + padZero(addRowAtividade11) + '.' + padZero(addRowAtividade111) + '.00');
                        addRowAtividade1111 = 0;
                        break;
                    case 20:
                        addRowAtividade1111 = addRowAtividade1111 + 1;
                        $('#' + currentRowID).find('td input').eq(1).val(padZero(addRowAtividade1) + '.' + padZero(addRowAtividade11) + '.' + padZero(addRowAtividade111) + '.' + padZero(addRowAtividade1111));
                        break;
                    default:
                        break;
                }
            });
        }


        $('#addAtividade').click(function() {

            rowAtividade1 += 1;
            var html = '<tr style="color: white; background-color: #A0A0A0;" id="rowAtividade' + padZero(rowAtividade1) + '">';
            html += '<td></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" id="inputTextDescricao" class="form-control" ></td>';
            html += '<td><input type="text" id="inputTextQtHora" class="form-control" ></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add1" class="fas fa-plus-square"></i></td>';
            html += '</tr>'
            $('#tableAtividades tbody').append(html);
            reloadTableOrderNumber();
        });


        $(document).on('click', '#add1', function() {


            rowAtividade11 += 1;
            var rowClicked = $(this).parent().parent().attr('id');

            if (rowClicked.split('_')[1] != null) {
                arrayAtividadesToDeleteDetalhes.push(rowClicked.split('_')[1]);
            }


            $('#' + rowClicked).find('#inputTextQtHora').prop('disabled', true);
            $('#' + rowClicked).find('#inputTextQtHora').val('');

            $('#' + rowClicked).find('#checkBoxIsenta').prop('disabled', true);
            $('#' + rowClicked).find('#checkBoxIsenta').prop('checked', false);

            var html = '<tr style="background-color: #C0C0C0;" id="' + rowClicked.split('_')[0] + padZero(rowAtividade11) + '">';
            html += '<td></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" id="inputTextDescricao" class="form-control" ></td>';
            html += '<td><input type="text" id="inputTextQtHora" class="form-control" ></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add11" class="fas fa-plus-square"></i></td>';
            html += '</tr>';

            $('[id^=' + rowClicked.split('_')[0] + ']').last().after(html);

            reloadTableOrderNumber();

        });
        //OK


        $(document).on('click', '#add11', function() {
            rowAtividade111 += 1;
            var rowClicked = $(this).parent().parent().attr('id');

            if (rowClicked.split('_')[1] != null) {
                arrayAtividadesToDeleteDetalhes.push(rowClicked.split('_')[1]);
            }

            $('#' + rowClicked).find('#inputTextQtHora').prop('disabled', true);
            $('#' + rowClicked).find('#inputTextQtHora').val('');

            $('#' + rowClicked).find('#checkBoxIsenta').prop('disabled', true);
            $('#' + rowClicked).find('#checkBoxIsenta').prop('checked', false);

            var html = '<tr style="background-color: #E0E0E0;" id="' + rowClicked.split('_')[0] + padZero(rowAtividade111) + '">';
            html += '<td></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" id="inputTextDescricao" class="form-control" ></td>';
            html += '<td><input type="text" id="inputTextQtHora" class="form-control" ></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td><i id="deleteAtividade" class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;<i id="add111" class="fas fa-plus-square"></i></td>';
            html += '</tr>'
            $('[id^=' + rowClicked.split('_')[0] + ']').last().after(html);
            reloadTableOrderNumber();
        });

        $(document).on('click', '#add111', function() {
            rowAtividade1111 += 1;
            var rowClicked = $(this).parent().parent().attr('id');

            if (rowClicked.split('_')[1] != null) {
                arrayAtividadesToDeleteDetalhes.push(rowClicked.split('_')[1]);
            }

            $('#' + rowClicked).find('#inputTextQtHora').prop('disabled', true);
            $('#' + rowClicked).find('#inputTextQtHora').val('');

            $('#' + rowClicked).find('#checkBoxIsenta').prop('disabled', true);
            $('#' + rowClicked).find('#checkBoxIsenta').prop('checked', false)

            var html = '<tr style="background-color: #FFFFFF;" id="' + rowClicked.split('_')[0] + padZero(rowAtividade1111) + '">';
            html += '<td></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" class="form-control no-border" disabled /></td>';
            html += '<td><input type="text" id="inputTextDescricao" class="form-control" ></td>';
            html += '<td><input type="text" id="inputTextQtHora" class="form-control" ></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td></td>';
            html += '<td><i id="deleteAtividade" class="fas fa-trash-alt"></i></td>';
            html += '</tr>'
            $('[id^=' + rowClicked.split('_')[0] + ']').last().after(html);
            reloadTableOrderNumber();
        });


        $(document).on('click', '#detalheAtividade', function() {
            selectedDetalheAtividade = arrayAtividades[$(this).parent().parent().index()];
            $('#modalDetalhesGrupoAtividades').modal('show');
        });





        var selectedRisco = [];
        $(document).on('click', '#detalheRisco', function() {
            selectedRisco = arrayRiscos[$(this).parent().parent().index()];

            $('#textareaPFR_DescricaoRisco').val(selectedRisco.PFR_DescricaoRisco);
            $('#textAreaPFR_MedidaMitigacao').val(selectedRisco.PFR_MedidaMitigacao);

            $('#modalRiscoDetalhes').modal('show');
        });


        $(document).on('click', '#deleteAtividade', function() {
            var idRow = $(this).parent().parent().attr('id').split('_')[0];
            var idRowParent = idRow.split('_')[0].slice(0, -2);
            if ($('[id^=' + idRow + ']').length == 1) {
                if ($(this).parent().parent().attr("id").split('_')[1] != null) {
                    deletedRowsAtividade.push($(this).parent().parent().attr("id").split('_')[1]);
                }
                if ($('[id^=' + idRowParent).length == 2) {
                    $('[id^=' + idRowParent).find('#inputTextQtHora').prop('disabled', false);
                }

                $(this).parent().parent().remove();
            } else {
                $('[id^=' + idRow + ']').each(function(index) {
                    if ($(this).attr('id').split('_')[1] != null) {
                        deletedRowsAtividade.push($(this).attr('id').split('_')[1]);
                    }

                    $(this).remove();
                });
                if ($('[id^=' + idRowParent).length <= 1) {
                    $('[id^=' + idRowParent).find('#inputTextQtHora').prop('disabled', false);
                }
            }
            reloadTableOrderNumber();
        });

        $(document).on('click', '#deleteRisco', function() {
            arrayDeletedRiscos.push($(this).parent().parent().attr('id'));
            $(this).parent().parent().remove();
        });

        $(document).ready(function() {
            $('#inputTextPJF_DATAINICIO').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                },
                placeholder: "DD/MM/AAAA"
            });
            $('#inputTextPJF_DATATERMINO').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                },
                placeholder: "DD/MM/AAAA"
            });
            $('#inputTextPJF_QTHORA').mask("0000", {
                placeholder: "9999"
            });


            $('#tdDataLimiteDependencia').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                },
                placeholder: "DD/MM/AAAA"
            });

            $('#inputtextDataLimiteDependencia').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                },
                placeholder: "DD/MM/AAAA"
            });
        });

        /*
        function MudaDateTime(pDataVinda, pDataOuHora) {
            if(pDataVinda == null) {
                return '0000-00-00 00:00:00'
            }
            var dd = pDataVinda.substring(0, 2);
            var mm = pDataVinda.substring(3, 5);
            var yyyy = pDataVinda.substring(6, 10);
            var hh = '12';
            var mn = '00';
            var ss = '00';
            if(pDataOuHora == 1) {
                return yyyy + '-' + mm + '-' + dd;
            } elseif(pDataOuHora == 2) {
                return = hh + ':' + mn + ':' + ss;
            } elseif(pDataOuHora == 3) {
                return = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + mn + ':' + ss;
            }
            // var DataIda = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + mn + ':' + ss;
            // return DataIda
        }
            */

        function setInputTextHints() {
            $('#inputCheckboxNotificaFornecedorRequisito').prop('title', 'Marque para que a pessoa seja notificada em cada interação do chamado.\nSerá notificada, por exemplo, pelo e-mail de seu Cadastro de Pessoa.');
            $('#inputCheckboxPFocalFornecedorRequisito').prop('title', 'Marque se for uma pessoa que é Ponto Focal para a prestação do serviço.\nSerá responsável: por aprovar orçamentos, oficializar homolgações etc');
            $('#addFornecedorRequisito').prop('title', 'Adicionar nova pessoa.');
            $('#selectPJF_ItemWbsParaChamados').prop('title', 'Selecione a atividade agrupadora para as criadas via chamados.\nAs atividades agrupadoras, para esse fim, têm a ordem terminada em "00.00.00".\nOgma criará neste grupo, uma atividade para cada novo chamado.\nAs atividades neste grupo terão a mesma descrição do respectivo chamado.');

            $('#RecProfissa').prop('title', 'Selecione o profissional indicado para esta fase de Plano de Serviço.');
            $('#RecAtuacao').prop('title', 'Selecione a atuação específica do Profissional para esta fase de Plano de Serviço.');
            $('#RecIniData').prop('title', 'Informe a data prevista para o ínicio da atuação do profissinal.');
            $('#RecInihora').prop('title', 'Informe o momento (hora e minuto) previsto para o ínicio da atuação do profissinal.');
            $('#RecFimData').prop('title', 'Informe a data prevista para o término da atuação do profissinal.');
            $('#RecFimHora').prop('title', 'Informe o momento (hora e minuto) previsto para o término da atuação do profissinal.');
            $('#addEquipe').prop('title', 'Clique para incluir item da tabela.');
            

            $('#checkboxATG_FlgTemporaria').prop('title', 'Marcada, limita os apontamentos de horas para esta atividade no período entre o Início da Execução e Término da Execução (inclusive).');
            
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