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
    <title>wDiscover</title>

    <?php $this->load->view('include/headerTop') ?>
    <style>
        html {
      visibility: hidden;
    }
  </style>

</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navBarStatusChamado') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                    <h3 class="page-title"> <i class="mdi mdi-format-align-justify"></i> wD Catálogo de Serviços: Editar </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('CasLista?aCasAtivo=3&aCsiId=0&aCasAbreI=0/'); ?>">Lista de Itens do Catálogo de Serviços</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Edita Catálogo de Serviços</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar"> <i class="mdi mdi-content-save"></i> </button>                        
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-1">
                                        <label for="inputCAS_CODIGO" class="text-left control-label col-form-label">Versão: </label>
                                        <input type="number" class="form-control" value="<?= $arrayCasEdita[0]['CAS_CODIGO'] ?>" id="inputCAS_CODIGO" disabled />
                                    </div>
                                    <div class="col-2">
                                        <label for="inputVERSAO" class="text-left control-label col-form-label">De: </label>
                                        <input type="date" class="form-control" value="<?= $arrayCasEdita[0]['VERSAO'] ?>" id="inputVERSAO" disabled />
                                    </div>
                                    <div class="col-1">
                                        <label for="inputCSI_CODIGO" class="text-left control-label col-form-label">Item: </label>
                                        <input type="number" class="form-control" value="<?= $arrayCasEdita[0]['CSI_CODIGO'] ?>" id="inputCSI_CODIGO" disabled />
                                    </div>
                                    <div class="col-7">
                                        <label for="inputTITULO" class="text-left control-label col-form-label">Título: </label>
                                        <input type="text" class="form-control font-weight-bold" value="<?= $arrayCasEdita[0]['TITULO'] ?>" id="inputTITULO"  />
                                    </div>                                    
                                </div>
                                <div class="row mb-3">   
                                    <div class="col-1">
                                        <label for="inputACRONIMO" class="text-left control-label col-form-label">Acrônimo: </label>
                                        <input type="text" class="form-control font-weight-bold" value="<?= $arrayCasEdita[0]['ACRONIMO'] ?>" id="inputACRONIMO"  />
                                    </div>
                                    <div class="col-5">
                                        <label for="inputSUBTITULO" class="text-left control-label col-form-label">Subtítulo: </label>
                                        <input type="text" class="form-control" value="<?= $arrayCasEdita[0]['SUBTITULO'] ?>" id="inputSUBTITULO" />
                                    </div>
                                    <div class="col-6">
                                        <label for="inputDOC_LINK" class="text-left control-label col-form-label">Link do documento: </label>
                                        <input type="text" class="form-control" value="<?= $arrayCasEdita[0]['DOC_LINK'] ?>" id="inputDOC_LINK" />
                                    </div>
                                </div>
                                <div class="row mb-3">                                
                                    <div class="col-12">
                                        <label for="inputDESCRICAO" class="text-left control-label col-form-label">Descrição: </label>                                        
                                        <textarea type="text" class="form-control" rows="3" id="inputDESCRICAO"><?php echo $arrayCasEdita[0]['DESCRICAO']; ?></textarea>
                                        
                                    </div>
                                </div>
                                <hr />
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input type="checkbox" <?= $arrayCasEdita[0]['EH_PROJETO'] == 1 ? 'checked' : '' ?> id="checkEH_PROJETO">
                                        <label class="text-left" for="checkEH_PROJETO">É projeto</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $arrayCasEdita[0]['EH_OPERACAO'] == 1 ? 'checked' : '' ?> id="checkEH_OPERACAO">
                                        <label class="text-left" for="checkEH_OPERACAO">É operação</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $arrayCasEdita[0]['EH_OPERACAO_PPS'] == 1 ? 'checked' : '' ?> id="checkEH_OPERACAO_PPS">
                                        <label class="text-left" for="checkEH_OPERACAO_PPS">É PPS</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $arrayCasEdita[0]['EH_OPERACAO_POS'] == 1 ? 'checked' : '' ?> id="checkEH_OPERACAO_POS">
                                        <label class="text-left" for="checkEH_OPERACAO_POS">É POS</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input type="checkbox" <?= $arrayCasEdita[0]['PRAZO_ANS'] == 1 ? 'checked' : '' ?> id="checkPRAZO_ANS">
                                        <label class="text-left" for="checkPRAZO_ANS">Prazo pela ANS</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $arrayCasEdita[0]['CHD_ATG'] == 1 ? 'checked' : '' ?> id="checkCHD_ATG">
                                        <label class="text-left" for="checkCHD_ATG">Chamado => Atividade</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $arrayCasEdita[0]['DESATIVADO'] == 1 ? 'checked' : '' ?> id="checkDESATIVADO">
                                        <label class="text-left" for="checkDESATIVADO">Item desativado</label>
                                    </div>
                                </div>                                                                
                                <hr />
                                <h4> Templates</h4>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item active">
                                        <a class="nav-link active" id="tabTempWbs-tab" data-toggle="tab" href="#tabTempWbs" role="tab" aria-controls="tabTempWbs" aria-selected="true">WBS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="tabTempTpc-tab" data-toggle="tab" href="#tabTempTpc" role="tab" aria-controls="tabTempTpc" aria-selected="false">Plano Comunicação</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="tabTempTpd-tab" data-toggle="tab" href="#tabTempTpd" role="tab" aria-controls="tabTempTpd" aria-selected="false">Plano Dados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabTempTpf-tab" data-toggle="tab" href="#tabTempTpf" role="tab" aria-controls="tabTempTpf" aria-selected="false">Chamados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="tabTempTpm-tab" data-toggle="tab" href="#tabTempTpm" role="tab" aria-controls="tabTempTpm" aria-selected="false">Monitoramento</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabTempTpn-tab" data-toggle="tab" href="#tabTempTpn" role="tab" aria-controls="tabTempTpn" aria-selected="false">Financeiro</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="tabTempTpt-tab" data-toggle="tab" href="#tabTempTpt" role="tab" aria-controls="tabTempTpt" aria-selected="false">Termos</a>
                                    </li>                                
                                </ul>

                                <div class="tab-content" id="myTabContent">
<!-- WBS WBS WBS WBS WBS WBS WBS WBS WBS WBS WBS WBS WBS  -->
                                    <div class="tab-pane fade show active" id="tabTempWbs" role="tabpanel" aria-labelledby="tabTempWbs-tab">
                                        <br />
                                        <h6> Templates para Estrutura de Atividades/WBS </h6>
                                        <div class="col-3">
                                            <input type="checkbox" <?= $arrayCasEdita[0]['GERA_ATG'] == 1 ? 'checked' : '' ?> id="checkGERA_ATG">
                                            <label class="text-left" for="checkGERA_ATG">Gerar Atividades</label>
                                        </div>
                                        <hr />
                                        <table id="tableTAG" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;"> Ordem</th>
                                                    <th style="width: 50%;"> Descrição</th>
                                                    <th style="width: 16%;"> Família</th>
                                                    <th style="width: 10%;"> Fase</th>
                                                    <th style="width: 10%;"> Esforço</th>
                                                    <th style="width: 4%" id="addTAG"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                        
                                    <div class="tab-pane fade" id="tabTempTpc" role="tabpanel" aria-labelledby="tabTempTpc-tab">
                                        <br />
                                        <h6> Templates para Plano de Comunicação </h6>
                                        <div class="col-3">
                                            <input type="checkbox" <?= $arrayCasEdita[0]['GERA_TPC'] == 1 ? 'checked' : '' ?> id="checkGERA_TPC">
                                            <label class="text-left" for="checkGERA_TPC">Gerar Plano de Comunicação</label>
                                        </div>
                                        <hr />
                                        <table id="tableTPC" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 16%;"> Evento</th>
                                                    <th style="width: 20%;"> Responsável</th>
                                                    <th style="width: 20%;"> Interessado</th>
                                                    <th style="width: 20%;"> Quando</th>
                                                    <th style="width: 20%;"> Forma</th>
                                                    <th style="width: 4%" id="addTAG"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tabTempTpd" role="tabpanel" aria-labelledby="tabTempTpd-tab">
                                        <br />
                                        <h6> Templates para Plano de Dados </h6>
                                        <div class="col-3">
                                            <input type="checkbox" <?= $arrayCasEdita[0]['GERA_TPD'] == 1 ? 'checked' : '' ?> id="checkGERA_TPC">
                                            <label class="text-left" for="checkGERA_TPC">Gerar Plano de Dados</label>
                                        </div>
                                        <hr />
                                        <table id="tableTPC" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 16%;"> Artefato</th>
                                                    <th style="width: 20%;"> Armazenamento</th>
                                                    <th style="width: 20%;"> Responsável</th>
                                                    <th style="width: 20%;"> Acesso</th>
                                                    <th style="width: 20%;"> Distribuição</th>
                                                    <th style="width: 4%" id="addTAG"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
<!-- CHAMADO CHAMADO CHAMADO CHAMADO CHAMADO CHAMADO CHAMADO -->
                                    <div class="tab-pane fade" id="tabTempTpf" role="tabpanel" aria-labelledby="tabTempTpf-tab">
                                        <br />
                                        <h6> Templates para Configuração do Chamados </h6>
                                        <div class="col-3">
                                            <input type="checkbox" <?= $arrayCasEdita[0]['GERA_TPF'] == 1 ? 'checked' : '' ?> id="checkGERA_TPF">
                                            <label class="text-left" for="checkGERA_TPF">Gerar Configurações de Chamados</label>
                                        </div>
                                        <hr />                                        
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="checkbox" id="checkboxTPF_FlgRecebeChamado">
                                                <label class="text-left" for="checkboxTPF_FlgRecebeChamado">Plano recebe chamados</label>
                                            </div>
                                            <div class="col-3">
                                                <input type="checkbox" id="checkboxTPF_FlgMostraPrazo">
                                                <label class="text-left" for="checkboxTPF_FlgMostraPrazo">Mostrar prazo ANS</label>
                                            </div>
                                            <div class="col-3">
                                                <input type="checkbox" id="checkboxTPF_FlgMostraAvaliacao">
                                                <label class="text-left" for="checkboxTPF_FlgMostraAvaliacao">Pedir por avaliação do chamado</label>
                                            </div>
                                            <div class="col-3">
                                                <input type="checkbox" id="checkboxTPF_FlgMostraTrd">
                                                <label class="text-left" for="checkboxTPF_FlgMostraTrd">Pedir por TRD</label>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="checkbox" id="checkboxTPF_FlgMostraDocReferencia">
                                                <label class="text-left" for="checkboxTPF_FlgMostraDocReferencia">Permitir documento interno</label>
                                            </div>
                                            <div class="col-3">
                                                <input type="checkbox" id="checkboxTPF_FlgMostraOrcamento">
                                                <label class="text-left" for="checkboxTPF_FlgMostraOrcamento">Permitir orçamento</label>
                                            </div>
                                            <div class="col-3">
                                                <input type="checkbox" id="checkboxTPF_FlgDisparaEmail">
                                                <label class="text-left" for="checkboxTPF_FlgDisparaEmail">Disparar Notificação</label>
                                            </div>
                                        </div>    
                                        <br />
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="inputTPF_DescrAcolhimento" class="text-left control-label col-form-label"> Texto de acolhimento </label>
                                                <textarea class="form-control" rows="2" id="inputTPF_DescrAcolhimento" maxlength="2000"></textarea>                                                
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="text-left control-label col-form-label"> Termo de aceite do orçamento </label>
                                                <textarea class="form-control" rows="2" id="inputTPF_OrcaTermoAceite" maxlength="2000"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="text-left control-label col-form-label"> Termo de Recebimento Definitivo (TRD)</label>
                                                <textarea class="form-control" rows="2" id="inputTPF_EntrTermoEntrega" maxlength="2000"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tabTempTpm" role="tabpanel" aria-labelledby="tabTempTpm-tab">
                                        <br />
                                        <h6> Templates para Monitoramento </h6>
                                        <div class="col-3">
                                            <input type="checkbox" <?= $arrayCasEdita[0]['GERA_TPM'] == 1 ? 'checked' : '' ?> id="checkGERA_TPT">
                                            <label class="text-left" for="checkGERA_TPM">Gerar Estrutura de Monitoramento</label>
                                        </div>
                                        <hr />
                                        <table id="tableMonitoramento" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;"> Data</th>
                                                    <th style="width: 20%;"> Espécie</th>
                                                    <th style="width: 52%;"> Descrição</th>
                                                    <th style="width: 8%; text-align: center;" id="addMonitoramento"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
<!-- FINANCEIRO FINANCEIRO FINANCEIRO FINANCEIRO FINANCEIRO FINANCEIRO -->
                                    <div class="tab-pane fade" id="tabTempTpn" role="tabpanel" aria-labelledby="tabTempTpn-tab">
                                        <br />                                                                                
                                        <h6> Templates para Configuração do Financeiro </h6>
                                        <div class="col-3">
                                            <input type="checkbox" <?= $arrayCasEdita[0]['GERA_PJN'] == 1 ? 'checked' : '' ?> id="checkGERA_TPN">
                                            <label class="text-left" for="checkGERA_TPN">Gerar Configuração do Financeiro</label>
                                        </div>
                                        <hr />
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="comboboxTipoOrcamento" class="text-left control-label col-form-label">Tipo de Faturamento</label>
                                                <select class="form-control" id="comboboxTipoOrcamento">
                                                    <option value="none">Selecione o tipo de faturamento</option>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="inputTPN_PropostaCaminho" class="text-left control-label col-form-label">Nome de caminho da Proposta:</label>
                                                <input type="text" class="form-control" id="inputTPN_PropostaCaminho" maxlength="500" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-1">
                                                <label for="inputTPN_FechmtoPeriInicio" class="text-left control-label col-form-label"> Primeiro dia: </label>
                                                <select class="form-control" id="inputTPN_FechmtoPeriInicio">                                                    
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <label for="inputTPN_FechmtoPeriInicioMes" class="text-left control-label col-form-label">-1 Mês +1</label>
                                                <select class="form-control" id="inputTPN_FechmtoPeriInicioMes">
                                                    <option value='-1'> M - 1 </option>
                                                    <option value='0'> M = 0 </option>
                                                    <option value='1'> M + 1 </option>
                                                </select>        
                                            </div>
                                            <div class="col-1">
                                                <label for="inputTPN_FechmtoPeriTermino" class="text-left control-label col-form-label"> Último dia: </label>                                                                                                
                                                <select class="form-control" id="inputTPN_FechmtoPeriTermino">
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <label for="inputTPN_FechmtoPeriTerminoMes" class="text-left control-label col-form-label">-1 Mês +1 </label>
                                                <select class="form-control" id="inputTPN_FechmtoPeriTerminoMes">
                                                    <option value='-1'> M - 1</option>
                                                    <option value='0'> M = 0</option>
                                                    <option value='1'> M + 1</option>
                                                </select>        
                                            </div>

                                            <div class="col-1">
                                                <label for="inputTPN_FechmtoDiaFechar" class="text-left control-label col-form-label"> Fecha em: </label>
                                                <input type="text" class="form-control" id="inputTPN_FechmtoDiaFechar" maxlength="2" />
                                            </div>
                                            <div class="col-1">
                                                <label for="inputTPN_PagmntoDiasPrazo" class="text-left control-label col-form-label"> Vence em: </label>
                                                <input type="text" class="form-control" id="inputTPN_PagmntoDiasPrazo" maxlength="2" />
                                            </div>
                                            <div class="col-1">
                                                    <label for="inputPJN_IndiceImposto" class="text-left control-label col-form-label"> Índice (%): </label>
                                                    <input type="text" class="form-control" id="inputPJN_IndiceImposto" maxlength="2" />
                                            </div>
                                        </div>                                    
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                    <label for="inputTPN_NotaFsclDescricao" class="text-left control-label col-form-label"> Descrição para a NF </label>
                                                    <textarea class="form-control" row="6" id="inputTPN_NotaFsclDescricao" maxlength="2000"></textarea>
                                            </div>                                           
                                        </div>                                        
                                    </div>

                                    <div class="tab-pane fade" id="tabTempTpt" role="tabpanel" aria-labelledby="tabTempTpt-tab">
                                        <br />
                                        <h6> Templates para Termos e Documentos </h6>
                                        <div class="col-3">
                                            <input type="checkbox" <?= $arrayCasEdita[0]['GERA_TPT'] == 1 ? 'checked' : '' ?> id="checkGERA_TPT">
                                            <label class="text-left" for="checkGERA_TPT">Gerar Termos e Documentos</label>
                                        </div>
                                        <hr />
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="textareaPJX_TextoTermoKickoff" class="text-left control-label col-form-label"> Modelo de Kickoff </label>
                                                <textarea class="form-control" rows="2" id="textareaPJX_TextoTermoKickoff" ></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label> Modelo de Aspectos de privacidade, confidencialidade e segurança </label>
                                                <textarea class="form-control" rows="5" id="textareaPJX_TextoConfidencialidade"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="textareaPJX_TextoTRD" class="text-left control-label col-form-label"> Modelo de TRD </label>
                                                <textarea class="form-control" rows="20" id="textareaPJX_TextoTRD"></textarea>
                                            </div>
                                        </div>
                                    </div>
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
        setInputTextHints();

        $('#liConfiguracao').addClass('selected');
		$('#liCas').addClass('active');
		$('#ulConfiguracao').addClass('in');

        var comboATFCount = 0;
        var comboATF = [];
        comboFase=[];
        comboFase[1]='<option value="0"> Em todas </option>';
        comboFase[2]='<option value="1"> Na fase 1 </option>';
        comboFase[3]='<option value="1"> Na fase 2 </option>';
        comboFase[4]='<option value="1"> Na fase 3 </option>';
        comboFase[5]='<option value="1"> Na fase 4 </option>';        
        var pCSICodigo = null;
        var arrayDeleteTag = [];

        $('#btnSalvar').click(function() {

            loadBlurSpinner();
            $.when(UpdateCas(), updateTag(), deleteTag(), UpdateTpn(), UpdateTpf()).done(function(r1, r2, r3, r4, r5) {
                console.log(r1);
                Swal.fire(
                    'Item do Cátálogo de Serviços salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });


        // $('#checkGERA_PJR').change(function() {
        //     $('#butonGERA_PJR').attr("disabled", document.getElementById("checkGERA_PJR"));
        // });

        $('#addTAG').click(function() {
            comboATFCount += 1;
            var html = '<tr>';
            html += '<td><input type="text" class="form-control" id="inputTAG_Ordem" /> </td>';
            html += '<td><input type="text" class="form-control" id="inputTAG_Descricao" /> </td>';
            html += '<td> <select id="comboATF' + comboATFCount + '" class="form-control">' + comboATF + '</select> </td>';
            html += '<td><select id="comboFase' + comboATFCount + '" class="form-control">' + comboFase + '</select> </td>';
            // html += '<td><input type="number" class="form-control" id="inputTAG_Fase" /> </td>';
            html += '<td><input type="number" class="form-control" id="inputTAG_QtHora" /> </td>';            
            html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
            html += '</tr>';
            $('#tableTAG tbody').append(html);
        });

        $.when(fetchComboATF(), fetchTemplTAG(), fetchTipoOrcamento(), fetchTemplTPN(), fetchComboTOD(1), fetchComboTOD(2), fetchTemplTPF() ).done(function(r1, r2, r3, r4, r5, r6, r7) {
            removeSpinner();
            
            //** TEMPLATE DE WBS */
            for (var i = 0; i <= r1[0].length - 1; i++) {
                comboATF.push('<option value="' + r1[0][i].ATF_Codigo + '"> ' + r1[0][i].ATF_Descricao + ' </option>');               
            }
            comboATFCount = r2[0].length;
            for (var i = 0; i <= r2[0].length - 1; i++) {
                var htmlTableTAG = [];
                htmlTableTAG.push('<tr id="' + r2[0][i].TAG_Codigo + '">');
                htmlTableTAG.push('<td> <input type="text" class="form-control" id="inputTAG_Ordem" value="' + r2[0][i].TAG_Ordem + '" /> </td>');
                htmlTableTAG.push('<td> <input type="text" class="form-control" id="inputTAG_Descricao" value="' + r2[0][i].TAG_Descricao + '" /> </td>');
                htmlTableTAG.push('<td> <select id="comboATF' + i + '" class="form-control">' + comboATF + '</select> </td>');
                // htmlTableTAG.push('<td> <input type="number" class="form-control" id="inputTAG_Fase" value="' + r2[0][i].TAG_Fase + '" /> </td>');
                htmlTableTAG.push('<td><select id="comboFase' + i + '" class="form-control">' + comboFase + '</select> </td>');                
                htmlTableTAG.push('<td> <input type="number" class="form-control" id="inputTAG_QtHora" value="' + r2[0][i].TAG_QtHora + '" /> </td>');
                htmlTableTAG.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmlTableTAG.push('</tr>');
                $('#tableTAG').append(htmlTableTAG.join(''));
                $('#comboATF' + i).val(r2[0][i].TAG_Familia);
                $('#comboATF' + i).change();                
                $('#comboFase' + i).val(r2[0][i].TAG_Fase);
                $('#comboFase' + i).change();
            }

            //COMBOBOX Dias do Mês - início
            var html = [];
            for (var i = 0 ; i <= r5[0].length - 1; i++) {
                html.push('<option value="' + r5[0][i].TOD_Codigo + '">' + r5[0][i].TOD_Descricao + '</option>');
            }
            $('#inputTPN_FechmtoPeriInicio').append(html.join(''));
            $('#inputTPN_FechmtoPeriInicio').val(r4[0]['TPN_FechmtoPeriInicio']);

            //COMBOBOX Dias do Mês - término
            var html = [];
            for (var i = 0 ; i <= r6[0].length - 1; i++) {
                html.push('<option value="' + r6[0][i].TOD_Codigo + '">' + r6[0][i].TOD_Descricao + '</option>');
            }
            $('#inputTPN_FechmtoPeriTermino').append(html.join(''));
            $('#inputTPN_FechmtoPeriTermino').val(r4[0]['TPN_FechmtoPeriTermino']);
            
            //COMBOBOX Tipo Orçamento
            var html = [];
            for (var i = r3[0].length - 1; i >= 0; i--) {
                html.push('<option value="' + r3[0][i].TOR_Codigo + '">' + r3[0][i].TOR_Nome + ' - ' + r3[0][i].TOR_Descricao + '</option>');
            }
            $('#comboboxTipoOrcamento').append(html.join(''));
            $('#comboboxTipoOrcamento').val(r4[0]['TPF_TORCodigo']);
            $('#inputTPN_PropostaCaminho').val(r4[0]['TPN_PropostaCaminho']);
            $('#inputTPN_FechmtoPeriInicio').val(r4[0]['TPN_FechmtoPeriInicio']);
            $('#inputTPN_FechmtoPeriInicioMes').val(r4[0]['TPN_FechmtoPeriInicioMes']);
            $('#inputTPN_FechmtoPeriTermino').val(r4[0]['TPN_FechmtoPeriTermino']);
            $('#inputTPN_FechmtoPeriTerminoMes').val(r4[0]['TPN_FechmtoPeriTerminoMes']);
            $('#inputTPN_FechmtoDiaFechar').val(r4[0]['TPN_FechmtoDiaFechar']);
            $('#inputTPN_PagmntoDiasPrazo').val(r4[0]['TPN_PagmntoDiasPrazo']);
            $('#inputTPN_NotaFsclDescricao').val(r4[0]['TPN_NotaFsclDescricao']);
            $('#inputPJN_IndiceImposto').val(r4[0]['TPN_IndiceImposto']);
            
            //TEMPLATE DE CONFIGURAÇÃO DE CHAMADOS
            $('#inputTPF_DescrAcolhimento').val(r7[0]['TPF_DescrAcolhimento']);
            $('#checkboxTPF_FlgMostraPrazo').prop('checked', r7[0].TPF_FlgMostraPrazo == 1);
            $('#checkboxTPF_FlgMostraAvaliacao').prop('checked', r7[0].TPF_FlgMostraAvaliacao == 1);
            $('#checkboxTPF_FlgMostraTrd').prop('checked', r7[0].TPF_FlgMostraTrd == 1);
            $('#checkboxTPF_FlgMostraDocReferencia').prop('checked', r7[0].TPF_FlgMostraDocReferencia == 1);
            $('#checkboxTPF_FlgMostraOrcamento').prop('checked', r7[0].TPF_FlgMostraOrcamento == 1);
            $('#checkboxTPF_FlgDisparaEmail').prop('checked', r7[0].TPF_FlgDisparaEmail == 1);
            $('#checkboxTPF_FlgRecebeChamado').prop('checked', r7[0].TPF_FlgRecebeChamado == 1);
            $('#inputTPF_OrcaTermoAceite').val(r7[0]['TPF_OrcaTermoAceite']);
            $('#inputTPF_EntrTermoEntrega').val(r7[0]['TPF_EntrTermoEntrega']);
            Des_habilitaCamposTPF(r7[0].TPF_FlgRecebeChamado);

        });

        function fetchTipoOrcamento() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchTipoOrcamento",
                dataType: 'json',
            });
        }

        function fetchComboATF() {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/fetchComboATF",
                dataType: 'json',
                type: 'POST'
            });
        }

        function fetchComboTOD(pIni1_Fim2) {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/fetchComboTOD",
                dataType: 'json',
                type: 'POST',
                data: {
                    aIni1_Fim2: pIni1_Fim2
                }
            });
        }
        
        function fetchTemplTAG() {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/fetchTemplTAG",
                dataType: 'json',
                type: 'POST',
                data: {
                    pCSICodigo: $('#inputCSI_CODIGO').val()
                }
            });            
        }

        function fetchTemplTPF() {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/fetchTemplTPF",
                dataType: 'json',
                type: 'POST',
                data: {
                    pCSICodigo: $('#inputCSI_CODIGO').val()
                }
            });            
        }

        function fetchTemplTPN() {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/fetchTemplTPN",
                dataType: 'json',
                type: 'POST',
                data: {
                    pCSICodigo: $('#inputCSI_CODIGO').val()
                }
            });            
        }

        function UpdateCas() {
                       
            $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/UpdateCas",
                
                type: 'POST',
                data: {
                    CSI_CODIGO : $('#inputCSI_CODIGO').val(),
                    CSI_SERVTITULO : $('#inputTITULO').val(),
                    CSI_AcronimoPlanoServico : $('#inputACRONIMO').val(),
                    CSI_SERVSUBTITULO : $('#inputSUBTITULO').val(),
                    CSI_SERVDESCRICAO : $('#inputDESCRICAO').val(),
                    CSI_DESATIVADO : $('#checkDESATIVADO').is(":checked") ? 1 : 0,
                    CAS_CODIGO : $('#inputCAS_CODIGO').val(),
                    CSI_FlgGeraPJRAutomatica : $('#checkGERA_PJR').is(":checked") ? 1 : 0,
                    CSI_FlgGeraPJAAutomatica : $('#checkGERA_ANS').is(":checked") ? 1 : 0,
                    CSI_FlgGeraATGAutomatica : $('#checkGERA_ATG').is(":checked") ? 1 : 0,
                    CSI_FlgGeraPLCAutomatica : $('#checkGERA_PLC').is(":checked") ? 1 : 0,
                    CSI_FlgGeraPLDAutomatica : $('#checkGERA_PLD').is(":checked") ? 1 : 0,
                    CSI_FlgGeraTPTAutomatica : $('#checkGERA_TPT').is(":checked") ? 1 : 0,
                    CSI_FlgGeraPJCAutomatica : $('#checkGERA_TPF').is(":checked") ? 1 : 0,
                    CSI_FlgGeraPJNAutomatica : $('#checkGERA_TPN').is(":checked") ? 1 : 0,                    
                    CSI_FlgCHDgeraATG : $('#checkCHD_ATG').is(":checked") ? 1 : 0,
                    CSI_FlgEhProjeto : $('#checkEH_PROJETO').is(":checked") ? 1 : 0,
                    CSI_FlgEhOperacao : $('#checkEH_OPERACAO').is(":checked") ? 1 : 0,
                    CSI_FlgEhOperacaoPps : $('#checkEH_OPERACAO_PPS').is(":checked") ? 1 : 0,
                    CSI_FlgEhOperacaoPos : $('#checkEH_OPERACAO_POS').is(":checked") ? 1 : 0,
                    CSI_FlgPzoNaANS : $('#checkPRAZO_ANS').is(":checked") ? 1 : 0
                }
            });
        }

        function UpdateTpf() {
                       
            $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/UpdateTpf",
                
                type: 'POST',
                data: {
                    TPF_CSICodigo : $('#inputCSI_CODIGO').val(),
                    TPF_DescrAcolhimento : $('#inputTPF_DescrAcolhimento').val(),
                    TPF_FlgMostraPrazo : $('#checkboxTPF_FlgMostraPrazo').is(':checked') == true ? 1 : 0,
                    TPF_FlgMostraAvaliacao : $('#checkboxTPF_FlgMostraAvaliacao').is(':checked') == true ? 1 : 0,
                    TPF_FlgMostraTrd : $('#checkboxTPF_FlgMostraTrd').is(':checked') == true ? 1 : 0,
                    TPF_FlgMostraDocReferencia : $('#checkboxTPF_FlgMostraDocReferencia').is(':checked') == true ? 1 : 0,
                    TPF_FlgMostraOrcamento : $('#checkboxTPF_FlgMostraOrcamento').is(':checked') == true ? 1 : 0,
                    TPF_FlgDisparaEmail : $('#checkboxTPF_FlgDisparaEmail').is(':checked') == true ? 1 : 0,
                    TPF_FlgRecebeChamado : $('#checkboxTPF_FlgRecebeChamado').is(':checked') == true ? 1 : 0,
                    TPF_OrcaTermoAceite : $('#inputTPF_OrcaTermoAceite').val(),
                    TPF_EntrTermoEntrega : $('#inputTPF_EntrTermoEntrega').val()                 
                }
            });
        }

        function UpdateTpn() {                       
            $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/UpdateTpn",
                
                type: 'POST',
                data: {

                    TPF_CSICodigo : $('#inputCSI_CODIGO').val(),
                    TPF_TORCodigo : $('#comboboxTipoOrcamento').val(),
                    TPN_FechmtoPeriInicio : $('#inputTPN_FechmtoPeriInicio').val(),
                    TPN_FechmtoPeriInicioMes : $('#inputTPN_FechmtoPeriInicioMes').val(),
                    TPN_FechmtoPeriTermino : $('#inputTPN_FechmtoPeriTermino').val(),
                    TPN_FechmtoPeriTerminoMes : $('#inputTPN_FechmtoPeriTerminoMes').val(),
                    TPN_FechmtoDiaFechar : $('#inputTPN_FechmtoDiaFechar').val(),
                    TPN_PagmntoDiasPrazo : $('#inputTPN_PagmntoDiasPrazo').val(),
                    TPN_PropostaCaminho : $('#inputTPN_PropostaCaminho').val(),
                    TPN_NotaFsclDescricao : $('#inputTPN_NotaFsclDescricao').val(),
                    TPN_IndiceImposto : $('#inputPJN_IndiceImposto').val()
                }
            });
        }

        function updateTag() {
            var arrayTag = [];
            $('#tableTAG').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var TAG_Ordem = $tds.eq(0).find('input').val();
                var TAG_Descricao = $tds.eq(1).find('input').val();
                var TAG_Familia = $tds.eq(2).find('option:selected').val();
                var TAG_Fase = $tds.eq(3).find('option:selected').val();
                var TAG_QtHora = $tds.eq(4).find('input').val();
                var TAG_CSICodigo = <?php echo $this->uri->segment(2); ?>;

                var TAG_Codigo = null;
                if ($(this).attr('id') != null) {
                    TAG_Codigo = $(this).attr('id');
                }
                arrayTag.push([TAG_Codigo, TAG_CSICodigo, TAG_Ordem, TAG_Descricao, TAG_Familia, TAG_Fase, TAG_QtHora]);
            });

            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/updateTag",
                type: 'POST',
                data: {
                    arrayTag: arrayTag
                }               
            });
        }

        function deleteTag() {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/CasLista/deleteTag",
                type: 'POST',
                data: {
                    arrayDeleteTag: arrayDeleteTag
                },
            });
        }

        $(document).on('click', '#delete', function() {
            if ($(this).parent().parent().parent().attr('id') == "tableTAG") {
                arrayDeleteTag.push($(this).parent().attr('id'));
            }
            $(this).parent().remove();
        });

        $('#checkboxTPF_FlgRecebeChamado').change(function() {
            Des_habilitaCamposTPF($('#checkboxTPF_FlgRecebeChamado').is(':checked') == true ? 1 : 0);
            
        });

        function Des_habilitaCamposTPF(pDesHab) {
            var vDesHab = pDesHab == 1 ? 0 : 1;
            $('#inputTPF_DescrAcolhimento').prop("disabled", vDesHab);
            $('#checkboxTPF_FlgMostraPrazo').prop("disabled", vDesHab);
            $('#checkboxTPF_FlgMostraAvaliacao').prop("disabled", vDesHab);
            $('#checkboxTPF_FlgMostraTrd').prop("disabled", vDesHab);
            $('#checkboxTPF_FlgMostraDocReferencia').prop("disabled", vDesHab);
            $('#checkboxTPF_FlgMostraOrcamento').prop("disabled", vDesHab);
            $('#checkboxTPF_FlgDisparaEmail').prop("disabled", vDesHab);                        
            $('#inputTPF_OrcaTermoAceite').prop("disabled", vDesHab);
            $('#inputTPF_EntrTermoEntrega').prop("disabled", vDesHab);
        }

        function setInputTextHints() {

            $('#btnSalvar').prop('title', 'Clique para salvar as alterações no item do Catálogo de Serviços.');

            // ITEM DO CATÁLOGO (CABEÇALHO)
            $('#inputCAS_CODIGO').prop('title', 'Versão do Catáogo de Serviços.\nUm número sequencial.');
            $('#inputVERSAO').prop('title', 'Data de lançamento da versão do Catálogo de Serviços.');
            $('#inputCSI_CODIGO').prop('title', 'Código do item do Catálogo de Serviços.\nId do Tipo de Serviço wD.');
            $('#inputTITULO').prop('title', 'Título do Serviço wD.');
            $('#inputACRONIMO').prop('title', 'Acrônimo identificativo do Serviço wD.');
            $('#inputSUBTITULO').prop('title', 'Descrição suscinta sobre o Serviço wD.');
            $('#inputDOC_LINK').prop('title', 'Link para o Documento desta versão do Catálogo de Serviços.');
            $('#inputDESCRICAO').prop('title', 'Descrição detalhada sobre o Serviço wD.');
            $('#checkEH_PROJETO').prop('title', 'O Serviço é executado sobre estrutura de projeto.');
            $('#checkEH_OPERACAO').prop('title', 'O Serviço é executado sobre estrutura de operação de serviços.');
            $('#checkEH_OPERACAO_PPS').prop('title', 'O Serviço é executado sobre estrutura de operação de serviços de Service Desk.\nTipo Guarda Chuva.');
            $('#checkEH_OPERACAO_POS').prop('title', 'O Serviço é executado sobre estrutura de operação de serviços on site.\nAlocação de recursos?');
            $('#checkPRAZO_ANS').prop('title', 'Indica se o prazo tratado para a execução da atividade vem da ANS ou não.');
            $('#checkCHD_ATG').prop('title', 'Setado, indica que os projetos deste item do catálogo podem ter suas atividades geradas por Chamados.\nOu seja: indica que suas atividades estarão relacionadas, cada uma, a um respectivo chamado.\nIndica também que estarão na lista para escolha no processo de Valiidação do Chamado.');

            
            $('#checkGERA_PJR').prop('title', 'Gerar Itens de Riscos a partir do template em cada novo plano do Serviço.');
            $('#checkGERA_ANS').prop('title', 'Gerar ANS a partir do template em cada novo plano do Serviço.');
            $('#checkGERA_ATG').prop('title', 'Gerar Estrutura de Atividades e/ou WBS a partir do template em cada novo plano do Serviço.');
            $('#checkGERA_TPC').prop('title', 'Gerar Estrutura do Plano de Comunicação a partir do template em cada novo plano do Serviço.');
            $('#checkGERA_TPD').prop('title', 'Gerar Estrutura do Plano de Dados a partir do template em cada novo plano do Serviço.');
            $('#checkGERA_TPN').prop('title', 'Gerar Configuração Financeira a partir do template em cada novo plano do Serviço.');
            $('#checkGERA_TPT').prop('title', 'Gerar Configuração Documentos e Termos a partir do template em cada novo plano do Serviço.');
            $('#checkGERA_TPF').prop('title', 'Gerar Configuração dos Chamados a partir do template em cada novo plano do Serviço.');

            $('#tabTempWbs-tab').prop('title', 'Templates para a estrutra de Atividades - WBS.');
            $('#tabTempTpc-tab').prop('title', 'Templates para a estrutra do Plano de Comuicação.');
            $('#tabTempTpd-tab').prop('title', 'Templates para a estrutra do Plano de Dados.');
            $('#tabTempTpf-tab').prop('title', 'Templates para a configuração dos Chamados.');
            $('#tabTempTpm-tab').prop('title', 'Templates para a indicadores do Monitoramento.');
            $('#tabTempTpn-tab').prop('title', 'Templates para a configuração Financeira.');
            $('#tabTempTpt-tab').prop('title', 'Templates para Termos e Documentos.');

            $('#comboboxTipoOrcamento').prop('title', 'Selecione o Tipo de Faturamento para o Plano de Serviço.\nIsso será usado no cálculo da pré-fatura. Para cada tipo de faturamento, forma diferente de gerar a Pré-fatura.');
            $('#inputTPN_PropostaCaminho').prop('title', 'Informe o link ou o nome da caminho da proposta.\nPasta/subpasta/arquivo onde se encontra a proposta que gerou o Plano de Serviços.');
            $('#inputTPN_FechmtoPeriInicio').prop('title', 'Informe o dia do mês que se inicia o período de referência para faturamento\nIsso é necessário para delinear a busca dos apontamentos de horas que referenciam o faturamento.\nEscolha "Início" para o Ogma considerar o dia do início do projeto (Plano).');
            $('#inputTPN_FechmtoPeriInicioMes').prop('title', 'Selecione em qual mês será considerado o primeiro dia do período de referência:\nM = 0: no próprio mês de referência;\nM - 1: no no mês anterior ao de referência;\nM + 1: no no mês posterior ao de referência.');
            $('#inputTPN_FechmtoPeriTerminoMes').prop('title', 'Selecione em qual mês será considerado o último dia do período de referência:\nM = 0: no próprio mês de referência;\nM - 1: no no mês anterior ao de referência;\nM + 1: no no mês posterior ao de referência.');
            $('#inputTPN_FechmtoPeriTermino').prop('title', 'Informe o dia do mês que termina o período de referência para faturamento\nIsso é necessário para delinear a busca dos apontamentos de horas que referenciam o faturamento.\nEscolha "Final" para o Ogma considerar o dia do término do projeto (Plano).\nDia 30 representará o útimo dia do mês.');
            $('#inputTPN_FechmtoDiaFechar').prop('title', 'Informe o número de dias após o término do período de referência, para o fechamento da fatura.');
            $('#inputTPN_PagmntoDiasPrazo').prop('title', 'Informe o número de dias após o término do período de referência, para a quitação da fatura pelo cliente devedor.');
            $('#inputTPN_NotaFsclDescricao').prop('title', 'Descreva o texto sugerido para estar no corpo da Nota Fiscal / Fatura.');
            $('#inputPJN_IndiceImposto').prop('title', 'Informe a alíquota de tributos incidente sobre o valor total do Plano.\nIsso será usado nos cálculos de custo.');
            
            // CONFIGURAÇÃO DOS CHAMADOS
            $('#inputTPF_DescrAcolhimento').prop('title', 'Texto da tela home do cliente. Tipo: Você está no Sirius, o sistema de chamados da wDiscover ...');
            $('#checkboxTPF_FlgMostraPrazo').prop('title', 'Marque para que a lista de chamados do cliente mostre o prazo final para a duração de cada status do chamado.');
            $('#checkboxTPF_FlgMostraAvaliacao').prop('title', 'Marque para que em status específicos (em garantia, por exemplo)\na lista do cliente peça por avaliação do atendimento.');
            $('#checkboxTPF_FlgMostraTrd').prop('title', 'Marque para que em status específicos (aguardando homologação, por exemplo)\na lista do cliente peça pelo Termo de Entrega Definitiva do serviço solicitado.');
            $('#checkboxTPF_FlgMostraDocReferencia').prop('title', 'Marque caso o cliente tenha outro documento interno de controle das solicitações.\nPor exemplo: Ordem de Serviços (OS), sistema de chamados etc.\nSerão disponibilizados campos para ele registrar esse documento.');
            $('#checkboxTPF_FlgMostraOrcamento').prop('title', 'Marque caso os chamados precisem de orçamento e aprovação do cliente.\nSerão disponibilizados o valor orçado e botão para aprovação.');    
            $('#checkboxTPF_FlgDisparaEmail').prop('title', 'Marque para que os fornecedores de requisitos (solicitantes) recebam notificações na abertura e interações do chamado.');
            $('#checkboxTPF_FlgRecebeChamado').prop('title', 'Marque caso o Plano de Serviço receba chamados como atividades em sua WBS.');
            $('#inputTPF_OrcaTermoAceite').prop('title', 'Texto para o termo de aceite, lido pelo usuário antes de aprovar o orçamento do chamado.');
            $('#inputTPF_EntrTermoEntrega').prop('title', 'Texto para o termo de TRD (Termo de Recebimento Dfinitivo), lido pelo usuário antes de declarar entregue o serviço do chamado.');

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