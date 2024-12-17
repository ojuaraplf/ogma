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
        .tooltip-inner {
            max-width: 350px;

        }

        #tableDocumentos tr:hover {
            cursor: pointer;
        }

        html {
            visibility: hidden;
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
                        <h4 class="page-title">Plano de Serviço <span id="spanNumeroProjeto"> - </span></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('listaProjeto/'); ?>">Projetos</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('detalheProjeto/') ?><?php echo $this->uri->segment(2); ?>">Detalhe
                                            Plano de Serviço</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Plano de Serviço</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-8">
                                        
                                        <h4 class="card-title" id="spanPJT_APELIDO"> Editar Plano de Serviço </h4>
                                        <!-- <h4 class="card-title" id="spanTitle">wD-PPT - Projeto de Treinamento</h4>
                                        <h6 class="card-title" id="spanSubtitle">Plano Específico de Serviço - Plano de Curso</h6> -->
                                    </div>
                                    <div class="col-4">
                                        <select class="form-control" id="comboboxPJT_STATUS">
                                        </select>
                                    </div>
                                </div>
                                <div class="border-top"></div>
                                <br />
                                <div class="row mb-3">
                                    <div class="col-6 ">
                                        <label for="inputTextPJT_TITULO" class="text-left control-label col-form-label"> Nome do plano </label>
                                        <input type="text" class="form-control" id="inputTextPJT_TITULO" data-toggle="tooltip" />
                                    </div>
                                    <div class="col-4">
                                        <label for="inputTextPJT_APELIDO" class="text-left control-label col-form-label"> Apelido </label>
                                        <input type="text" class="form-control" id="inputTextPJT_APELIDO" maxlength="44" data-toggle="tooltip" />
                                    </div>
                                    <div class="col-2">
                                        <label for="inputTextPJT_VhSysCCustoId" class="text-left control-label col-form-label">VHSys: Centro de Custo</label>
                                        <input type="text" class="form-control" id="inputTextPJT_VhSysCCustoId" data-toggle="tooltip" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- <div class="col-6">
                                        <label for="comboboxTipoOrcamento" class="text-left control-label col-form-label">Tipo de Faturamento</label>
                                        <select class="form-control" id="comboboxTipoOrcamento" data-toggle="tooltip">
                                            <option value="none">Selecione o tipo de orçamento</option>
                                        </select>
                                    </div> -->
                                    <div class="col-6">
                                        <label for="comboboxCliente" class="text-left control-label col-form-label"><i class="mdi mdi-account-star"></i> Cliente</label>
                                        <select class="form-control" id="comboboxCliente" data-toggle="tooltip">
                                            <option value="none"></option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="comboboxGestor" class="text-left control-label col-form-label">Gestor da Conta </label>
                                        <select class="form-control" id="comboboxGestor" data-toggle="tooltip">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="inputTextPJT_QTHORA" class="text-left control-label col-form-label"> QtHora </label>
                                        <input type="text" class="form-control" id="inputTextPJT_QTHORA" data-toggle="tooltip" />
                                    </div>
                                    <div class="col-3">
                                        <label for="inputTextPJT_VRHORA" class="text-left control-label col-form-label">VrHora</label>
                                        <input type="text" class="form-control" id="inputTextPJT_VRHORA" placeholder="R$ 0,00" data-toggle="tooltip" />
                                    </div>
                                    <div class="col-3">
                                        <label for="inputTextPJT_DATAINICIO" class="text-left control-label col-form-label">Data
                                            início</label>
                                        <input type="text" class="form-control" id="inputTextPJT_DATAINICIO" data-toggle="tooltip" />
                                    </div>
                                    <div class="col-3">
                                        <label for="inputTextPJT_DATATERMINO" class="text-left control-label col-form-label">Data
                                            Término</label>
                                        <input type="text" class="form-control" id="inputTextPJT_DATATERMINO" data-toggle="tooltip" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="textareaPJT_EscopoDoPlano" class="text-left control-label col-form-label"> Escopo do plano. </label>
                                        <textarea class="form-control" rows="2" id="textareaPJT_EscopoDoPlano" data-toggle="tooltip"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="textareaPJT_TREINAMENTOEQUIPE" class="text-left control-label col-form-label"> Treinamento Equipe </label>
                                        <textarea class="form-control" rows="2" id="textareaPJT_TREINAMENTOEQUIPE" data-toggle="tooltip"></textarea>
                                    </div>
                                </div>


                                <br />
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabANS-tab" data-toggle="tab" href="#tabANS" role="tab" aria-controls="tabANS" aria-selected="true">ANS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabPlanoComunicacao-tab" data-toggle="tab" href="#tabPlanoComunicacao" role="tab" aria-controls="tabPlanoComunicacao" aria-selected="false">Plano de Comunicação</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabPlanoDados-tab" data-toggle="tab" href="#tabPlanoDados" role="tab" aria-controls="tabPlanoDados" aria-selected="false">Plano de Dados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabMonitoramento-tab" data-toggle="tab" href="#tabMonitoramento" role="tab" aria-controls="tabMonitoramento" aria-selected="false">Monitoramento</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabTermosDoProjeto-tab" data-toggle="tab" href="#tabTermosDoProjeto" role="tab" aria-controls="tabTermosDoProjeto" aria-selected="false">Documentos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabConfiguracaoDoChamado-tab" data-toggle="tab" href="#tabConfiguracaoDoChamado" role="tab" aria-controls="tabConfiguracaoDoChamado" aria-selected="false">Chamados</a>
                                    </li>

                                    <?php if ($this->session->userdata('USU_FlgPodeAcessarGestaoPlanos') == 1): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tabConfiguracaoFinanceira-tab" data-toggle="tab" href="#tabConfiguracaoFinanceira" role="tab" aria-controls="tabConfiguracaoFinanceira" aria-selected="false">Financeiro</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>


                                <div class="tab-content" id="myTabContent">
                                    <br />

                                    <div class="tab-pane fade show active" id="tabANS" role="tabpanel" aria-labelledby="tabANS-tab">
                                        <h4> ANS </h4>
                                        <br />
                                        <table id="tableANS" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 24%;"> Status</th>
                                                    <th style="width: 24%;"> Categoria</th>
                                                    <th style="width: 24%;"> Prioridade</th>
                                                    <th style="width: 24%;"> QtHora</th>
                                                    <th style="width: 4%" id="addANS"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tabPlanoComunicacao" role="tabpanel" aria-labelledby="tabPlanoComunicacao-tab">
                                        <h4> Plano de Comunicação </h4>
                                        <br />
                                        <table id="tablePlanoComunicacao" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th id="thEvento" data-toggle="tooltip" style="width: 20%;"> Evento</th>
                                                    <th id="thResponsavel" data-toggle="tooltip" style="width: 19%;"> Responsavel</th>
                                                    <th id="thInteressado" data-toggle="tooltip" style="width: 19%;"> Interessado</th>
                                                    <th id="thQuando" data-toggle="tooltip" style="width: 19%;"> Quando</th>
                                                    <th id="thFormaComunicacao" data-toggle="tooltip" style="width: 19%;"> Forma Comunicação</th>
                                                    <th style="width: 4%" id="addPlanoComunicacao"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tabPlanoDados" role="tabpanel" aria-labelledby="tabPlanoDados-tab">
                                        <h4> Plano de Dados </h4>
                                        <br />
                                        <table id="tablePlanoDados" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th id="thArtefato" data-toggle="tooltip" style="width: 20%;"> Artefato</th>
                                                    <th id="thArmazenamento" data-toggle="tooltip" style="width: 19%;"> Armazenamento</th>
                                                    <th id="thResponsavelDados" data-toggle="tooltip" style="width: 19%;"> Responsável</th>
                                                    <th id="thAcesso" data-toggle="tooltip" style="width: 19%;"> Acesso</th>
                                                    <th id="thDistribuicao" data-toggle="tooltip" style="width: 19%;"> Distribuição</th>
                                                    <th style="width: 4%" id="addPlanoDados"><i class="fas fa-plus-square"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade" id="tabMonitoramento" role="tabpanel" aria-labelledby="tabMonitoramento-tab">
                                        <h4> Revisões de Monitoramento </h4>
                                        <br />
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


                                    <div class="tab-pane fade" id="tabTermosDoProjeto" role="tabpanel" aria-labelledby="tabTermosDoProjeto-tab">
                                        <h4> Documentos e Termos do Plano de Serviço </h4>
                                        <br />
                                        <form method="post" id="uploadForm" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label for="inputTextPJT_QTHORA" class="text-left control-label col-form-label"> Documento </label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="uploadFile" id="uploadFile" required>
                                                        <label class="custom-file-label" for="uploadFile" id="labelFile">Escolha o arquivo...</label>
                                                        <div class="invalid-feedback">Arquivo inválido.</div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <label for="" class="text-left control-label col-form-label"> Titulo </label>
                                                    <input type="text" class="form-control" id="inputTextPJD_DocumTitulo" />
                                                    <div class="invalid-feedback">
                                                        <span> Necessário preencher o Título do Documento. </span>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <label for="" class="text-left control-label col-form-label"> &nbsp; </label>
                                                    <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-primary btn-block" />
                                                </div>
                                            </div>
                                        </form>
                                        <table id="tableDocumentos" class="table table-bordered table-hover table-sm" hidden>
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;"> Código</th>
                                                    <th style="width: 50%;"> Título</th>
                                                    <th style="width: 40%;"> Documento</th>

                                                    <th style="width: 5%;"> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <br />
                                        <div class="border-top"></div>
                                        <br />
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="textareaPJX_TextoTermoKickoff" class="text-left control-label col-form-label"> Modelo de Kickoff </label>
                                                <textarea class="form-control" rows="2" id="textareaPJX_TextoTermoKickoff" data-toggle="tooltip"></textarea>
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
                                                <textarea class="form-control" rows="20" id="textareaPJX_TextoTRD" data-toggle="tooltip"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tabConfiguracaoDoChamado" role="tabpanel" aria-labelledby="tabConfiguracaoDoChamado-tab">
                                        <h4> Chamado - Configurações da interface do cliente </h4>
                                        <br />
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="checkbox" id="checkboxPJC_FlgRecebeChamado">
                                                    <label class="text-left" for="checkboxPJC_FlgRecebeChamado">Este plano recebe chamados</label>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="inputPJC_DescrAcolhimento" class="text-left control-label col-form-label"> Texto de acolhimento </label>
                                                    <textarea class="form-control" rows="1" id="inputPJC_DescrAcolhimento"></textarea>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="checkbox" id="checkboxPJC_FlgMostraPrazo">
                                                    <label class="text-left" for="checkboxPJC_FlgMostraPrazo">Mostrar prazo ANS</label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="checkbox" id="checkboxPJC_FlgMostraAvaliacao">
                                                    <label class="text-left" for="checkboxPJC_FlgMostraAvaliacao">Pedir por avaliação do chamado</label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="checkbox" id="checkboxPJC_FlgMostraTrd">
                                                    <label class="text-left" for="checkboxPJC_FlgMostraTrd">Pedir por TRD</label>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="checkbox" id="checkboxPJC_FlgMostraDocReferencia">
                                                    <label class="text-left" for="checkboxPJC_FlgMostraDocReferencia">Permitir documento interno</label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="checkbox" id="checkboxPJC_FlgMostraOrcamento">
                                                    <label class="text-left" for="checkboxPJC_FlgMostraOrcamento">Permitir orçamento</label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="checkbox" id="checkboxPJC_FlgDisparaEmail">
                                                    <label class="text-left" for="checkboxPJC_FlgDisparaEmail">Disparar Notificação</label>
                                                </div>
                                            </div>    
                                            <br />
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="" class="text-left control-label col-form-label"> Termo de aceite do orçamento </label>
                                                    <textarea class="form-control" rows="1" id="inputPJC_OrcaTermoAceite"></textarea>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="" class="text-left control-label col-form-label"> Termo de Recebimento Definitivo (TRD)</label>
                                                    <textarea class="form-control" rows="1" id="inputPJC_EntrTermoEntrega"></textarea>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="tab-pane fade" id="tabConfiguracaoFinanceira" role="tabpanel" aria-labelledby="tabConfiguracaoFinanceira-tab">
                                        <h4> Pré-faturamento - Configurações </h4>
                                        <br />
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="comboboxTipoOrcamento" class="text-left control-label col-form-label">Tipo de Faturamento</label>
                                                <select class="form-control" id="comboboxTipoOrcamento" data-toggle="tooltip">
                                                    <option value="none">Selecione o tipo de faturamento</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="comboboxPJN_CLPCodigo" class="text-left control-label col-form-label">Responsável pelo faturamento no Cliente:</label>
                                                <select class="form-control" id="comboboxPJN_CLPCodigo" data-toggle="tooltip">
                                                    <option value="none">Selecione a pessoa do cliente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="inputPJN_PropostaCaminho" class="text-left control-label col-form-label">Nome de caminho da Proposta:</label>
                                                <input type="text" class="form-control" id="inputPJN_PropostaCaminho" maxlength="500" />
                                            </div>
                                            
                                            <div class="col-1">
                                                <label for="inputPJN_FechmtoPeriInicio" class="text-left control-label col-form-label">Primeiro dia:</label>
                                                <select class="form-control" id="inputPJN_FechmtoPeriInicio">
                                                    <option value="0">Início</option>
                                                </select>
                                            </div>


                                            <div class="col-1">
                                                <label for="inputPJN_FechmtoPeriInicioMes" class="text-left control-label col-form-label">-1 Mês +1</label>
                                                <select class="form-control" id="inputPJN_FechmtoPeriInicioMes">
                                                    <option value='-1'> M - 1 </option>
                                                    <option value='0'> M = 0 </option>
                                                    <option value='1'> M + 1 </option>
                                                </select>        
                                            </div>


                                            <div class="col-1">
                                                <label for="inputPJN_FechmtoPeriTermino" class="text-left control-label col-form-label">Último dia:</label>
                                                <select class="form-control" id="inputPJN_FechmtoPeriTermino">
                                                    <option value="0">Final</option>
                                                </select>
                                            </div>

                                            <div class="col-1">
                                                <label for="inputPJN_FechmtoPeriTerminoMes" class="text-left control-label col-form-label">-1 Mês +1 </label>
                                                <select class="form-control" id="inputPJN_FechmtoPeriTerminoMes">
                                                    <option value='-1'> M - 1</option>
                                                    <option value='0'> M = 0</option>
                                                    <option value='1'> M + 1</option>
                                                </select>        
                                            </div>

                                            <div class="col-1">
                                                <label for="inputPJN_FechmtoDiaFechar" class="text-left control-label col-form-label"> Fecha em: </label>
                                                <input type="text" class="form-control" id="inputPJN_FechmtoDiaFechar" maxlength="2" />
                                            </div>
                                            <div class="col-1">
                                                <label for="inputPJN_PagmntoDiasPrazo" class="text-left control-label col-form-label"> Vence em: </label>
                                                <input type="text" class="form-control" id="inputPJN_PagmntoDiasPrazo" maxlength="2" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-7">
                                                    <label for="inputPJN_NotaFsclDescricao" class="text-left control-label col-form-label"> Descrição para a NF </label>
                                                    <input class="form-control" id="inputPJN_NotaFsclDescricao" maxlength="2000"></textarea>
                                            </div>
                                            <div class="col-2">
                                                    <label for="inputPJN_CentroCustoCliente" class="text-left control-label col-form-label"> Centro Custo </label>
                                                    <input class="form-control" id="inputPJN_CentroCustoCliente" maxlength="150"></textarea>
                                            </div>

                                            <div class="col-2">
                                                <label for="inputPJN_ValorTotal" class="text-left control-label col-form-label">Valor Total (R$)</label>
                                                <input type="text" placeholder="R$ 0,00" data-toggle="tooltip" class="form-control" id="inputPJN_ValorTotal" />
                                            </div>
                                        

                                            <div class="col-1">
                                                    <label for="inputPJN_IndiceImposto" class="text-left control-label col-form-label"> Índice (%): </label>
                                                    <input type="text" class="form-control" id="inputPJN_IndiceImposto" maxlength="5" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-7">
                                                    <label for="inputPJN_ObsDoFaturamento" class="text-left control-label col-form-label"> Observações sobre o faturamento: </label>
                                                    <textarea class="form-control" row="5" id="inputPJN_ObsDoFaturamento" maxlength="2000"></textarea>
                                            </div>
                                            <div class="col-5">
                                                <label for="tableFapParcela" class="text-left control-label col-form-label"> Parcelamento </label>
                                                <table id="tableFapParcela" class="table table-bordered table-sm" >
                                                    <thead>
                                                        <tr>
                                                            <th id="thPJE_ParcelaOrdem" data-toggle="tooltip" style="width: 15%;"> Ordem</th>
                                                            <th id="thPJE_ParcelaValor" data-toggle="tooltip" style="width: 30%;"> Valor (R$)</th>
                                                            <th id="thPJE_ParcelaVencimento" data-toggle="tooltip" style="width: 30%;"> Vencimento</th>
                                                            <th style="width: 4%" id="addFapParcela"><i class="fas fa-plus-square"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody  height: 30px;>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top">
                                    <div class="card-body">
                                        <button class="btn btn-primary" id="btnUpdateProjeto"> Salvar </button>
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
    <?php $this->load->view('modal/modalNovoProjeto') ?>
    <?php $this->load->view('modal/modalDetalhesRevisao') ?>
    <?php $this->load->view('modal/modalChecklist') ?>
    <?php $this->load->view('modal/modalChecklistItemDetalhes') ?>


    <script type="text/javascript">
        setInputTextHints();
        
            $('#inputTextPJT_TITULO').unbind('keyup change input paste').bind('keyup change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
            }
        });

        // ABA FINANCEIRO
        document.addEventListener('DOMContentLoaded', function() {
            function populateSelect(selectId) {
                const select = document.getElementById(selectId);
                for (let i = 1; i <= 30; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = `Dia ${String(i).padStart(2, '0')}`;
                    select.appendChild(option);
                }
            }

            populateSelect('inputPJN_FechmtoPeriInicio');
            populateSelect('inputPJN_FechmtoPeriTermino');
        });

        // ABA FINANCEIRO
        $('#uploadFile').change(function() {
            $('#labelFile').text($('#uploadFile')[0].files[0].name)
        });

        // ABA FINANCEIRO
        $("#inputPJN_ValorTotal").maskMoney({
            prefix: "R$ ",
            decimal: ",",
            thousands: "."
        });
        

        // $('#inputPJN_FechmtoPeriInicio, #inputPJN_FechmtoPeriTermino, #inputPJN_FechmtoDiaFechar, #inputPJN_PagmntoDiasPrazo').change(function() {
        //     var isValid = /^([0-2][0-9]|[3][0-1]|[1-9])$/.test($(this).val());
        //     if (!isValid) {
        //         $(this).val("");
        //         $(this).focus();
        //         console.log('inválido');
        //     } else {
        //     }
        // });

        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            $('#inputTextPJD_DocumTitulo').removeClass('is-invalid');

            if ($('#inputTextPJD_DocumTitulo').val() == "") {
                $('#inputTextPJD_DocumTitulo').addClass('is-invalid');
                return;
            }

            var formData = new FormData(this);

            formData.append("folder", currentProject.PJT_CODIGO + "-" + currentCatalogo.CSI_AcronimoPlanoServico);
            formData.append("PJD_DocumTitulo", $('#inputTextPJD_DocumTitulo').val());
            formData.append("PJD_PJTCodigo", currentProject.PJT_CODIGO);

            console.log(currentProject.PJT_CODIGO);

            loadBlurSpinner();
            $.when(uploadFile(formData)).done(function(r1) {
                $('#inputTextPJD_DocumTitulo').val('');
                $('#uploadFile').val('');
                $('#labelFile').text('Escolha o arquivo...');
                fetchDocumentos()
                removeSpinner();
            });
        });

        function uploadFile(formData) {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/uploadFile",
                // dataType: 'text',
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                data: formData
            });
        }
        $(document).on('click', '#tableDocumentos > tbody > tr', function() {
            var indexSelected = $(this).index();
            PJD_DocumentoProjeto = arrayDocumentos[indexSelected];
            window.location = "<?php echo base_url('editarProjeto/downloadFile'); ?>" + "/" + PJD_DocumentoProjeto["PJD_Codigo"];
        });

        var arrayDocumentos = [];


        fetchDocumentos();

        function fetchDocumentos() {
            $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchDocumentos",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJD_PJTCodigo: <?php echo $this->uri->segment(2); ?>
                },
                success: function(data) {
                    $('#tableDocumentos tbody').html('');
                    console.log(data);

                    // if (data.length > 0) {
                    //   $('#tableDocumentos').hide();
                    //   return;
                    // }

                    for (var i = 0; i <= data.length - 1; i++) {
                        $('#tableDocumentos').attr("hidden", false);
                        arrayDocumentos = data;
                        var htmlDocumentos = [];
                        htmlDocumentos.push('<tr id="' + data[i].PJD_Codigo + '">');
                        htmlDocumentos.push('<td>' + data[i].PJD_Codigo + '</td>');
                        htmlDocumentos.push('<td>' + data[i].PJD_DocumTitulo + '</td>');
                        htmlDocumentos.push('<td>' + data[i].PJD_DocumLink.split("/").pop() + '</td>');
                        htmlDocumentos.push('<td style="text-align: center;"><i class="fas fa-download" id="downloadFile"></i></td>');
                        htmlDocumentos.push('</tr>');
                        $('#tableDocumentos').append(htmlDocumentos.join(''));
                    }

                }

            });
        }

        function fetchStatusChamado() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchStatusChamado",
                dataType: 'json',
            });
        }



        loadSpinner();
        $('#liServico').addClass('selected');
        $('#liServicoProjeto').addClass('active');
        $('#ulServico').addClass('in');

        //* Comentado em 22/05/2021 - já tem outra chamada para a mesma função aqui. */
       // setInputTextHints();

        var arrayClientes = [];
        var arrayStatus = [];
        var arrayStatusChamado = [];
        var arrayCategoriaChamado = [];
        var arrayPrioridadeChamado = [];
        var arrayTipoOrcamento = [];
        var arrayPessoaDoCliente = [];

        var arrayDeletedANS = [];
        var arrayDeletedPlanoDados = [];
        var arrayDeletedFapParcela = [];
        var arrayDeletedPlanoComunicacao = [];
        var arrayDeletedMonitoramento = [];

        var isANSChanged = false;
        var isPlanoDeDadosChanged = false;
        var isFatParcelasChanged = false;

        $('#spanNumeroProjeto').text(<?php echo $this->uri->segment(2); ?>);


        $('#spanPJT_CODIGO').text(<?php echo $this->uri->segment(2); ?>);

        function fetchTipoOrcamento() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchTipoOrcamento",
                dataType: 'json',
            });
        }

        function fetchPessoaDoCLiente($pPJT) {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchPessoaDoCLiente",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                }
            });
        }

        function fetchCategoriaChamado() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchCategoriaChamado",
                dataType: 'json',
            });
        }

        function fetchPrioridadeChamado() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchPrioridadeChamado",
                dataType: 'json',
            });
        }


        function fetchANS() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchANS",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                },
            });
        }

        function fetchTermosProjeto() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchTermosProjeto",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                },
            });
        }

        function fetchConfiguracaoDoChamado() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchConfiguracaoDoChamado",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                },
            });
        }

        function fetchConfiguracaoFinanceira() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchConfiguracaoFinanceira",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                },
            });
        }

        function fetchFapParcela() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchFapParcela/<?php echo $this->uri->segment(2); ?>",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                },
                
            });
        }

        function fetchPlanoDados() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchPlanoDados",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                }
            });
        }

        function fetchPlanoComunicacao() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchPlanoComunicacao",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                }
            });
        }

        function fetchMonitoramento() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchMonitoramento",
                dataType: 'json',
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                }
            });
        }

        var arrayMonitoramento = [];

        var comboboxStatusChamado = [];
        var comboboxCategoriaChamado = [];
        var comboboxPrioridadeChamado = [];
        var comboboxEspecieMonitoramento = [];

        var comboboxStatusChamadoCount = 0;
        var comboboxPrioridadeChamadoCount = 0;
        var comboboxCategoriaChamadoCount = 0;
        var comboboxEspecieMonitoramentoCount = 0;

        var currentProject = [];
        var currentCatalogo = [];

        $('#addANS').click(function() {
            comboboxStatusChamadoCount += 1;
            comboboxCategoriaChamadoCount += 1;
            comboboxPrioridadeChamadoCount += 1;

            var html = '<tr>';
            html += '<td> <select id="comboboxStatusChamado' + comboboxStatusChamadoCount + '" class="form-control">' + comboboxStatusChamado + '</select> </td>';
            html += '<td> <select id="comboboxCategoriaChamado' + comboboxCategoriaChamadoCount + '" class="form-control">' + comboboxCategoriaChamado + '</select> </td>';
            html += '<td> <select id="comboboxPrioridadeChamadoChamado' + comboboxPrioridadeChamadoCount + '" class="form-control">' + comboboxPrioridadeChamado + '</select> </td>';
            html += '<td><input type="number" class="form-control" id="inputTextPJA_QtHoras" /> </td>';
            html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
            html += '</tr>';
            $('#tableANS tbody').append(html);
        });

        $('#addMonitoramento').click(function() {
            comboboxEspecieMonitoramentoCount += 1;
            var html = '<tr>';
            html += '<td> <input type="text" class="form-control" id="inputTextData" /> </td>';
            html += '<td> <select id="comboboxPrioridadeChamadoChamado' + comboboxEspecieMonitoramentoCount + '" class="form-control">' + comboboxEspecieMonitoramento + '</select> </td>';
            html += '<td><input type="text" class="form-control" id="inputTextDescricao" /> </td>';
            html += '<td style="text-align: center;" id="delete"><i class="fas fa-trash-alt"></i></td>';
            html += '</tr>';
            $('#tableMonitoramento tbody').append(html);

            $('[id^=inputTextData]').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "dd/mm/yyyy",
                orientation: "top",
                maxViewMode: 1
            });
        });
        
        
        

        $.when(fetchGestor(), fetchCliente(), fetchStatusProjeto(), fetchProject(<?php echo $this->uri->segment(2); ?>), fetchStatusChamado(), fetchCategoriaChamado(), fetchPrioridadeChamado(), fetchANS(), fetchPlanoDados(), fetchMonitoramento(), fetchEspecieRevisao(), fetchPlanoComunicacao(), fetchTipoOrcamento(), fetchTermosProjeto(), fetchConfiguracaoDoChamado(), fetchConfiguracaoFinanceira(), fetchPessoaDoCLiente(), fetchFapParcela() ).done(function(r1, r2, r3, r4, r6, r7, r8, r9, r10, r11, r12, r13, r14, r15, r16, r17, r18, r19) {
            removeSpinner();

            $('#textareaPJX_TextoTermoKickoff').val(r15[0].PJX_TextoTermoKickoff);
            $('#textareaPJX_TextoTRD').val(r15[0].PJX_TextoTRD);
            $('#textareaPJX_TextoConfidencialidade').val(r15[0].PJX_TextoConfidencialidade);


            $('#inputPJC_DescrAcolhimento').val(r16[0].PJC_DescrAcolhimento);
            $('#checkboxPJC_FlgMostraPrazo').prop('checked', r16[0].PJC_FlgMostraPrazo == 1);
            $('#checkboxPJC_FlgMostraAvaliacao').prop('checked', r16[0].PJC_FlgMostraAvaliacao == 1);
            $('#checkboxPJC_FlgMostraTrd').prop('checked', r16[0].PJC_FlgMostraTrd == 1);
            $('#checkboxPJC_FlgMostraDocReferencia').prop('checked', r16[0].PJC_FlgMostraDocReferencia == 1);
            $('#checkboxPJC_FlgMostraOrcamento').prop('checked', r16[0].PJC_FlgMostraOrcamento == 1);
            $('#checkboxPJC_FlgDisparaEmail').prop('checked', r16[0].PJC_FlgDisparaEmail == 1);
            $('#checkboxPJC_FlgRecebeChamado').prop('checked', r16[0].PJC_FlgRecebeChamado == 1);
            $('#inputPJC_OrcaTermoAceite').val(r16[0].PJC_OrcaTermoAceite);
            $('#inputPJC_EntrTermoEntrega').val(r16[0].PJC_EntrTermoEntrega);
            Des_habilitaCamposPJC(r16[0].PJC_FlgRecebeChamado);

            $('#comboboxPJN_CLPCodigo').val(r17[0].PJN_CLPCodigo);
            $('#comboboxTipoOrcamento').val(r17[0].PJN_TORCodigo);
            $('#inputPJN_FechmtoPeriInicio').val(r17[0].PJN_FechmtoPeriInicio);
            $('#inputPJN_FechmtoPeriInicioMes').val(r17[0].PJN_FechmtoPeriInicioMes);
            $('#inputPJN_FechmtoPeriTermino').val(r17[0].PJN_FechmtoPeriTermino);
            $('#inputPJN_FechmtoPeriTerminoMes').val(r17[0].PJN_FechmtoPeriTerminoMes);
            $('#inputPJN_FechmtoDiaFechar').val(r17[0].PJN_FechmtoDiaFechar);
            $('#inputPJN_PagmntoDiasPrazo').val(r17[0].PJN_PagmntoDiasPrazo);
            $('#inputPJN_PropostaCaminho').val(r17[0].PJN_PropostaCaminho);
            $('#inputPJN_NotaFsclDescricao').val(r17[0].PJN_NotaFsclDescricao);
            // $('#inputPJN_IndiceImposto').val(r17[0].PJN_IndiceImposto);
            $('#inputPJN_IndiceImposto').val(parseFloat(r17[0].PJN_IndiceImposto).toFixed(2) + '%');
            $('#inputPJN_CentroCustoCliente').val(r17[0].PJN_CentroCustoCliente);
            if (r17[0].PJN_ValorTotal != null) {               
                $('#inputPJN_ValorTotal').val('R$ ' + parseFloat(r17[0].PJN_ValorTotal).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
            }            
            $('#inputPJN_ObsDoFaturamento').val(r17[0].PJN_ObsDoFaturamento);



            console.log('O ID da pessoa do cliente');
            console.log(r17[0].PJN_CLPCodigo);

            for (var i = 0; i <= r12[0].length - 1; i++) {
                comboboxEspecieMonitoramento.push('<option value="' + r12[0][i].ERM_Codigo + '"> ' + r12[0][i].ERM_Descricao + ' </option>');
            }

            for (var i = 0; i <= r6[0].length - 1; i++) {
                comboboxStatusChamado.push('<option value="' + r6[0][i].STC_Codigo + '"> ' + r6[0][i].STC_Descricao + ' </option>');
            }
            for (var i = 0; i <= r7[0].length - 1; i++) {
                comboboxCategoriaChamado.push('<option value="' + r7[0][i].CHC_Codigo + '"> ' + r7[0][i].CHC_Descricao + ' </option>');
            }
            for (var i = 0; i <= r8[0].length - 1; i++) {
                comboboxPrioridadeChamado.push('<option value="' + r8[0][i].CHP_Codigo + '"> ' + r8[0][i].CHP_Descricao + ' </option>');
            }

            arrayStatusChamado = r6[0];
            arrayPrioridadeChamado = r7[0];
            arrayCategoriaChamado = r8[0];

            comboboxStatusChamadoCount = r9[0].length;
            comboboxPrioridadeChamadoCount = r9[0].length;
            comboboxCategoriaChamadoCount = r9[0].length;

            //Fetch Contigências -----------------------------------------------------------------
            for (var i = 0; i <= r9[0].length - 1; i++) {
                var htmlTableANS = [];
                htmlTableANS.push('<tr id="' + r9[0][i].PJA_Codigo + '">');
                htmlTableANS.push('<td> <select id="comboboxStatusChamado' + i + '" class="form-control">' + comboboxStatusChamado + '</select> </td>');
                htmlTableANS.push('<td> <select id="comboboxCategoriaChamado' + i + '" class="form-control">' + comboboxCategoriaChamado + '</select> </td>');
                htmlTableANS.push('<td> <select id="comboboxPrioridadeChamado' + i + '" class="form-control">' + comboboxPrioridadeChamado + '</select> </td>');
                htmlTableANS.push('<td><input type="number" class="form-control" id="" value="' + r9[0][i].PJA_QtHoras + '" /> </td>');
                htmlTableANS.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmlTableANS.push('</tr>');
                $('#tableANS').append(htmlTableANS.join(''));

                $('#comboboxStatusChamado' + i).val(r9[0][i].PJA_STCCodigo);
                $('#comboboxStatusChamado' + i).change();

                $('#comboboxPrioridadeChamado' + i).val(r9[0][i].PJA_CHPCodigo);
                $('#comboboxPrioridadeChamado' + i).change();

                $('#comboboxCategoriaChamado' + i).val(r9[0][i].PJA_CHCCodigo);
                $('#comboboxCategoriaChamado' + i).change();


            }
            $("#inputTextPJA_QtHoras").on("input", function() {
                isANSChanged = true;
            });

            $('[idˆ=comboboxStatusChamado], [idˆ=comboboxCategoriaChamado], [idˆ=comboboxPrioridadeChamado]').change(function() {
                isANSChanged = true;
            });


            arrayMonitoramento = r11[0];
            console.log(r11[0]);
            for (var i = 0; i <= r11[0].length - 1; i++) {

                var htmlTableMonitoramento = [];
                htmlTableMonitoramento.push('<tr id="' + r11[0][i].PJM_Codigo + '">');
                htmlTableMonitoramento.push('<td> <input type="text" class="form-control" id="inputTextData" value="' + r11[0][i].PJM_DataDaAgendaRevisao.split("-").reverse().join("/") + '" /> </td>');
                htmlTableMonitoramento.push('<td> <select id="comboboxEspecieMonitoramento' + i + '" class="form-control">' + comboboxEspecieMonitoramento + '</select> </td>');
                htmlTableMonitoramento.push('<td> <input type="text" class="form-control" id="inputTextDescricao" value="' + r11[0][i].PJM_mDescricaoDaRevisao + '" /> </td>');

                htmlTableMonitoramento.push('<td style="text-align: center;"><i class="fas fa-trash-alt" id="deleteMonitoramento"></i>&nbsp;&nbsp;&nbsp;<i id="detalheMonitoramento" class="fas fa-info-circle"></i></td>');
                htmlTableMonitoramento.push('</tr>');
                $('#tableMonitoramento').append(htmlTableMonitoramento.join(''));

                $('#comboboxEspecieMonitoramento' + i).val(r11[0][i].PJM_ERMCodigo);
                $('#comboboxEspecieMonitoramento' + i).change();

            }
            $('[id^=inputTextData]').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "dd/mm/yyyy",
                orientation: "bottom",
                maxViewMode: 1
            });
            $('[id=detalheMonitoramento]').hover(function() {
                $(this).css("cursor", "pointer");
            });

            //Fetch PLANO DADOS -----------------------------------------------------------------
            for (var i = 0; i <= r10[0].length - 1; i++) {

                var htmlTablePlanoDados = [];
                htmlTablePlanoDados.push('<tr id="' + r10[0][i].PLD_CODIGO + '">');
                htmlTablePlanoDados.push('<td> <input type="text" class="form-control" id="inputTextArtefato" value="' + r10[0][i].PLD_ARTEFATO + '" /> </td>');
                htmlTablePlanoDados.push('<td> <input type="text" class="form-control" id="inputTextArmazenamento" value="' + r10[0][i].PLD_ARMAZENAMENTO + '" /> </td>');
                htmlTablePlanoDados.push('<td> <input type="text" class="form-control" id="inputTextResponsavel" value="' + r10[0][i].PLD_RESPONSAVEL + '" /> </td>');
                htmlTablePlanoDados.push('<td> <input type="text" class="form-control" id="inputTextAcesso" value="' + r10[0][i].PLD_ACESSO + '" /> </td>');
                htmlTablePlanoDados.push('<td> <input type="text" class="form-control" id="inputTextDistribuicao" value="' + r10[0][i].PLD_DISTRIBUICAO + '" /> </td>');
                htmlTablePlanoDados.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmlTablePlanoDados.push('</tr>');
                $('#tablePlanoDados').append(htmlTablePlanoDados.join(''));
            }
            $("#inputTextArtefato, #inputTextArmazenamento, #inputTextResponsavel, #inputTextAcesso, #inputTextDistribuicao").on("input", function() {
                isPlanoDeDadosChanged = true;
            });

            //Fetch PLANO COMUNICACAO -----------------------------------------------------------------
            for (var i = 0; i <= r13[0].length - 1; i++) {

                var htmlTablePlanoComunicacao = [];
                htmlTablePlanoComunicacao.push('<tr id="' + r13[0][i].PLC_Codigo + '">');
                htmlTablePlanoComunicacao.push('<td> <input type="text" class="form-control" id="inputTextEvento" value="' + r13[0][i].PLC_Evento + '" /> </td>');
                htmlTablePlanoComunicacao.push('<td> <input type="text" class="form-control" id="inputTextResponsavel" value="' + r13[0][i].PLC_Responsavel + '" /> </td>');
                htmlTablePlanoComunicacao.push('<td> <input type="text" class="form-control" id="inputTextInteressado" value="' + r13[0][i].PLC_Interessado + '" /> </td>');
                htmlTablePlanoComunicacao.push('<td> <input type="text" class="form-control" id="inputTextQuando" value="' + r13[0][i].PLC_Quando + '" /> </td>');
                htmlTablePlanoComunicacao.push('<td> <input type="text" class="form-control" id="inputTextFomaComunicacao" value="' + r13[0][i].PLC_FomaComunicacao + '" /> </td>');
                htmlTablePlanoComunicacao.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmlTablePlanoComunicacao.push('</tr>');
                $('#tablePlanoComunicacao').append(htmlTablePlanoComunicacao.join(''));
            }
            $("#inputTextEvento, #inputTextResponsavel, #inputTextInteressado, #inputTextQuando, #inputTextFomaComunicacao").on("input", function() {
                isPlanoDeDadosChanged = true;
            });


            //Fetch PARCELAS DE FATURAMENTO -----------------------------------------------------------------
            for (var i = 0; i <= r19[0].length - 1; i++) {

                var htmltableFapParcela = [];
                htmltableFapParcela.push('<tr id="' + r19[0][i].PJE_Codigo + '">');
                htmltableFapParcela.push('<td> <input type="number" step="1" class="form-control" id="thPJE_ParcelaOrdem" value="' + r19[0][i].PJE_ParcelaOrdem + '" /> </td>');
                htmltableFapParcela.push('<td> <input type="number" format="currency" precision="2" class="form-control" id="thPJE_ParcelaValor" value="' + r19[0][i].PJE_ParcelaValor + '" /> </td>');
                htmltableFapParcela.push('<td> <input type="date" class="form-control" id="thPJE_ParcelaVencimento" value="' + r19[0][i].PJE_ParcelaVencimento + '" /> </td>');
                htmltableFapParcela.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmltableFapParcela.push('</tr>');
                $('#tableFapParcela').append(htmltableFapParcela.join(''));

                }
                $("#thPJE_ParcelaOrdem, #thPJE_ParcelaValor, #thPJE_ParcelaVencimento").on("input", function() {
                isFatParcelasChanged = true;
                });



            //COMBOBOX GESTOR
            var html = [];
            for (var i = r1[0].length - 1; i >= 0; i--) {
                html.push('<option value="' + r1[0][i].CODIGO + '">' + r1[0][i].COLABORADOR + '</option>');
            }
            $('#comboboxGestor').append(html.join(''));

            //COMBOBOX CLIENTE
            arrayClientes = r2[0];
            var html = [];
            for (var i = 0; i < r2[0].length; i++) {
                html.push('<option value="' + r2[0][i].CODIGO + '">' + r2[0][i].PESSOA + '</option>');

            }
            $('#comboboxCliente').append(html.join(''));



            //COMBOBOX Tipo Orçamento
            arrayTipoOrcamento = r14[0];
            var html = [];
            for (var i = r14[0].length - 1; i >= 0; i--) {
                html.push('<option value="' + r14[0][i].TOR_Codigo + '">' + r14[0][i].TOR_Nome + ' - ' + r14[0][i].TOR_Descricao + '</option>');

            }
            $('#comboboxTipoOrcamento').append(html.join(''));


            //COMBOBOX Pessoas do Cliente
            arrayPessoaDoCliente = r18[0];
            var html = [];
            for (var i = r18[0].length - 1; i >= 0; i--) {
                html.push('<option value="' + r18[0][i].CODIGO + '">' + r18[0][i].NOME + '</option>');

            }
            $('#comboboxPJN_CLPCodigo').append(html.join(''));










            arrayStatus = r3[0];
            var html = "";

            for (var i = r3[0].length - 1; i >= 0; i--) {
                html += '<option value="' + r3[0][i].STP_CODIGO + '"> ' + r3[0][i].STP_DESCRICAO + '</option>';
            }
            $('#comboboxPJT_STATUS').html(html)

            //IMPRIMIR NA TELA OS DADOS
            currentProject = r4[0];
            console.log(currentProject);

            $('#inputTextPJT_TITULO').val(r4[0].PJT_TITULO);
            $('#inputTextPJT_APELIDO').val(r4[0].PJT_APELIDO);
            $('#inputTextPJT_VhSysCCustoId').val(r4[0].PJT_VhSysCCustoId);

            $('#comboboxGestor').val(r4[0].CBR_CODIGO);



            console.log("HEHEHHEE");
            console.log(r4[0].PJN_TORCodigo);
            console.log("HEHEHHEE");
            $('#comboboxTipoOrcamento').val((r17[0].PJN_TORCodigo == null) ? "none" : r17[0].PJN_TORCodigo);
            $('#comboboxPJN_CLPCodigo').val((r17[0].PJN_CLPCodigo == null) ? "none" : r17[0].PJN_CLPCodigo);
            $('#inputPJN_FechmtoPeriTerminoMes').val((r17[0].PJN_FechmtoPeriTerminoMes == null) ? "none" : r17[0].PJN_FechmtoPeriTerminoMes);
            $('#inputPJN_FechmtoPeriInicioMes').val((r17[0].PJN_FechmtoPeriInicioMes == null) ? "none" : r17[0].PJN_FechmtoPeriInicioMes);
            




            // $('#inputTextPJT_TECNOLOGIA').val(r4[0].PJT_TECNOLOGIA);
            $('#inputTextPJT_QTHORA').val(r4[0].PJT_QTHORA);
            $('#textareaPJT_TREINAMENTOEQUIPE').val(r4[0].PJT_TREINAMENTOEQUIPE);
            $('#textareaPJT_EscopoDoPlano').val(r4[0].PJT_EscopoDoPlano);

            if (r4[0].PJT_VRHORA != null) {
                $('#inputTextPJT_VRHORA').val('R$ ' + r4[0].PJT_VRHORA.replace('.', ','));
            }

            if (r4[0].PJT_DATAINICIO != null) {
                $('#inputTextPJT_DATAINICIO').val(r4[0].PJT_DATAINICIO.split("-").reverse().join("/"));
            }
            if (r4[0].PJT_DATATERMINO != null) {
                $('#inputTextPJT_DATATERMINO').val(r4[0].PJT_DATATERMINO.split("-").reverse().join("/"));
            }

            $('#comboboxPJT_STATUS').val(r4[0].PJT_STATUS);
            $('#comboboxPJT_STATUS').change();
            // $('#comboboxPJT_TECNOLOGIA').val(r4[0].PJT_TECNOLOGIA);
            // $('#comboboxPJT_TECNOLOGIA').change();

            $('#inputTextPJT_PLACOMUNICACAO').val(r4[0].PJT_PLACOMUNICACAO);

            if (r4[0].CLI_CODIGO != null) {
                $('#comboboxCliente').val(r4[0].CLI_CODIGO);
                $('#comboboxCliente').change();
            }

            fetchCatalogoServico(r4[0].PJT_ITEMCAS);
        });

        // $('#comboboxCliente').change(function() {
        //     if ($('#comboboxCliente option:selected').val() == "none") {
        //         $('#inputTextCLI_NOMEFANTASIA').val("");
        //         return
        //     }
        //     var index = getArrayIndexForKey(arrayClientes, "PES_Nome", $('#comboboxCliente option:selected').val());
        //     $('#inputTextCLI_NOMEFANTASIA').val(arrayClientes[index].PES_Apelido);
        // });

        $(document).on('click', '#detalheMonitoramento', function() {


            selectedDetalheRevisao = arrayMonitoramento[$(this).parent().parent().index()];

            console.log(selectedDetalheRevisao);

            $('#modalDetalhesRevisao').modal('show');
            $('#inputTextPJM_DataDaAgendaRevisao').val(selectedDetalheRevisao["PJM_DataDaAgendaRevisao"].split("-").reverse().join("/"));
            $('#inputTextPJM_ERMCodigo').val(selectedDetalheRevisao["ERM_Descricao"]);
            $('#inputTextPJM_mDescricaoDaRevisao').val(selectedDetalheRevisao["PJM_mDescricaoDaRevisao"]);
            $('#textAreaPJM_ParecerGQ').val(selectedDetalheRevisao["PJM_ParecerGQ"]);
            $('#textAreaPJM_ParecerGP').val(selectedDetalheRevisao["PJM_ParecerGP"]);

            $("#buttonConcluirRevisao").attr("disabled", true);
            $("#textAreaPJM_ParecerGP").attr("disabled", true);


            if (selectedDetalheRevisao["PJM_mMomentoDaRevisao"] != null) {
                console.log("Revisão já feita");

                console.log(arrayMonitoramento);
                $('[id^=divAlertReturn]').attr("class", "alert alert-primary");
                $('[id^=divAlertReturn]').text("Carregando...");
                fetchIndicadores(selectedDetalheRevisao["PJM_Codigo"]);

            }
            if (selectedDetalheRevisao["PJM_FlgRevisaoConcluida"] == 1) {
                $("#textAreaPJM_ParecerGQ").attr("disabled", true);
                $("#buttonGerarIndicadores").attr("disabled", true);
            }

            // console.log(selectedDetalheRevisao);


            // console.log(selectedDetalheMonitoramento);
            // $('#modalDetalhesGrupoAtividades').modal('show');
        });

        function fetchIndicadores(PJM_Codigo) {
            $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchIndicadores",
                dataType: 'text',
                type: 'POST',
                data: {
                    PJM_Codigo: PJM_Codigo
                },
                success: function(data) {

                    var formattedString = data.replace(/\;/g, '\n');
                    console.log(formattedString);
                    $('#textAreaIndicadores').val(formattedString);

                    $('[id^=divAlertReturn]').attr("class", "alert alert-light");
                    $('[id^=divAlertReturn]').html("&nbsp;");

                    // console.log(data.replace(/\;/g, '\n'));
                    // console.log("SUCCESS");
                }

            });
        }

        function deleteANS() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/deleteANS",
                type: 'POST',
                data: {
                    arrayDeletedANS: arrayDeletedANS
                },
            });
        }

        function deletePlanoDados() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/deletePlanoDados",
                type: 'POST',
                data: {
                    arrayDeletedPlanoDados: arrayDeletedPlanoDados
                },
            });
        }

        
        function DeletedFapParcela() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/DeletedFapParcela",
                type: 'POST',
                data: {
                    arrayDeletedFapParcela: arrayDeletedFapParcela
                },
            });
        }

        function deletePlanoComunicacao() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/deletePlanoComunicacao",
                type: 'POST',
                data: {
                    arrayDeletedPlanoComunicacao: arrayDeletedPlanoComunicacao
                },
            });
        }






        function updatePlanoComunicacao() {
            var arrayPlanoComunicacao = [];
            $('#tablePlanoComunicacao').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var PLC_Evento = $tds.eq(0).find('input').val();
                var PLC_Responsavel = $tds.eq(1).find('input').val();
                var PLC_Interessado = $tds.eq(2).find('input').val();
                var PLC_Quando = $tds.eq(3).find('input').val();
                var PLC_FomaComunicacao = $tds.eq(4).find('input').val();
                var PLC_PJTCodigo = <?php echo $this->uri->segment(2); ?>;

                var PLC_Codigo = null;
                if ($(this).attr('id') != null) {
                    PLC_Codigo = $(this).attr('id');

                }
                arrayPlanoComunicacao.push([PLC_Codigo, PLC_Evento, PLC_Responsavel, PLC_Interessado, PLC_Quando, PLC_FomaComunicacao, PLC_PJTCodigo]);
            });
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updatePlanoComunicacao",
                type: 'POST',
                data: {
                    arrayPlanoComunicacao: arrayPlanoComunicacao
                },
            });
        }

        function updateFapParcela() {
            var arrayFapParcela = [];
            $('#tableFapParcela').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var PJE_ParcelaOrdem = $tds.eq(0).find('input').val();
                var PJE_ParcelaValor = $tds.eq(1).find('input').val();
                var PJE_ParcelaVencimento = $tds.eq(2).find('input').val();
                var PJE_PJTCodigo = <?php echo $this->uri->segment(2); ?>;

                var PJE_Codigo = null;
                if ($(this).attr('id') != null) {
                    PJE_Codigo = $(this).attr('id');
                }
                arrayFapParcela.push([PJE_Codigo, PJE_ParcelaOrdem, PJE_ParcelaValor, PJE_ParcelaVencimento, PJE_PJTCodigo ]);
            });
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updateFapParcela",
                type: 'POST',
                data: {
                    arrayFapParcela: arrayFapParcela
                },
            });
        }

        function updatePlanoDeDados() {
            var arrayPlanoDados = [];
            $('#tablePlanoDados').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var PLD_ARTEFATO = $tds.eq(0).find('input').val();
                var PLD_ARMAZENAMENTO = $tds.eq(1).find('input').val();
                var PLD_RESPONSAVEL = $tds.eq(2).find('input').val();
                var PLD_ACESSO = $tds.eq(3).find('input').val();
                var PLD_DISTRIBUICAO = $tds.eq(4).find('input').val();
                var PJT_CODIGO = <?php echo $this->uri->segment(2); ?>;

                var PLD_CODIGO = null;
                if ($(this).attr('id') != null) {
                    PLD_CODIGO = $(this).attr('id');
                }
                arrayPlanoDados.push([PLD_CODIGO, PLD_ARTEFATO, PLD_ARMAZENAMENTO, PLD_RESPONSAVEL, PLD_ACESSO, PLD_DISTRIBUICAO, PJT_CODIGO]);
            });
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updatePlanoDados",
                type: 'POST',
                data: {
                    arrayPlanoDados: arrayPlanoDados
                },
            });
        }

        function updateANS() {
            var arrayANS = [];
            $('#tableANS').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var PJA_STCCodigo = $tds.eq(0).find('option:selected').val();
                var PJA_CHCCodigo = $tds.eq(1).find('option:selected').val();
                var PJA_CHPCodigo = $tds.eq(2).find('option:selected').val();
                var PJA_QtHoras = $tds.eq(3).find('input').val();
                var PJA_PJTCodigo = <?php echo $this->uri->segment(2); ?>;

                var PJA_Codigo = null;
                if ($(this).attr('id') != null) {
                    PJA_Codigo = $(this).attr('id');

                }
                arrayANS.push([PJA_Codigo, PJA_STCCodigo, PJA_CHCCodigo, PJA_CHPCodigo, PJA_QtHoras, PJA_PJTCodigo]);
            });

            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updateANS",
                type: 'POST',
                data: {
                    arrayANS: arrayANS
                },
            });
        }

        function updateTermosProjeto() {
            var PJX_TextoTermoKickoff = $('#textareaPJX_TextoTermoKickoff').val();
            var PJX_TextoTRD = $('#textareaPJX_TextoTRD').val();
            var PJX_TextoConfidencialidade = $('#textareaPJX_TextoConfidencialidade').val();

            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updateTermosProjeto",
                type: 'POST',
                data: {
                    PJX_PJTCodigo: <?php echo $this->uri->segment(2); ?>,
                    PJX_TextoTermoKickoff: PJX_TextoTermoKickoff,
                    PJX_TextoTRD: PJX_TextoTRD,
                    PJX_TextoConfidencialidade: PJX_TextoConfidencialidade

                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            });
        }



        function updateConfiguracaoDoChamado() {
            var PJC_DescrAcolhimento = $('#inputPJC_DescrAcolhimento').val();
            var PJC_FlgMostraPrazo = $('#checkboxPJC_FlgMostraPrazo').is(':checked') == true ? 1 : 0;
            var PJC_FlgMostraAvaliacao = $('#checkboxPJC_FlgMostraAvaliacao').is(':checked') == true ? 1 : 0;
            var PJC_FlgMostraTrd = $('#checkboxPJC_FlgMostraTrd').is(':checked') == true ? 1 : 0;
            var PJC_FlgMostraDocReferencia = $('#checkboxPJC_FlgMostraDocReferencia').is(':checked') == true ? 1 : 0;
            var PJC_FlgMostraOrcamento = $('#checkboxPJC_FlgMostraOrcamento').is(':checked') == true ? 1 : 0;
            var PJC_FlgDisparaEmail = $('#checkboxPJC_FlgDisparaEmail').is(':checked') == true ? 1 : 0;
            var PJC_FlgRecebeChamado = $('#checkboxPJC_FlgRecebeChamado').is(':checked') == true ? 1 : 0;
            var PJC_OrcaTermoAceite = $('#inputPJC_OrcaTermoAceite').val();
            var PJC_EntrTermoEntrega = $('#inputPJC_EntrTermoEntrega').val();
            
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updateConfiguracaoDoChamado",
                type: 'POST',
                data: {
                    PJC_PJTCodigo: <?php echo $this->uri->segment(2); ?>,
                    PJC_DescrAcolhimento: PJC_DescrAcolhimento,
                    PJC_FlgMostraPrazo: PJC_FlgMostraPrazo,
                    PJC_FlgMostraAvaliacao: PJC_FlgMostraAvaliacao,
                    PJC_FlgMostraTrd: PJC_FlgMostraTrd,
                    PJC_FlgMostraDocReferencia: PJC_FlgMostraDocReferencia,
                    PJC_FlgMostraOrcamento: PJC_FlgMostraOrcamento,
                    PJC_FlgDisparaEmail: PJC_FlgDisparaEmail,
                    PJC_FlgRecebeChamado: PJC_FlgRecebeChamado,
                    PJC_OrcaTermoAceite: PJC_OrcaTermoAceite,
                    PJC_EntrTermoEntrega: PJC_EntrTermoEntrega
                }
            });
        }

        function updateConfiguracaoFinanceira() {

            var PJN_PJTCodigo = $('#inputPJN_PJTCodigo').val();
            var PJN_CLPCodigo = $('#comboboxPJN_CLPCodigo').val() == 'none' ? 0 : $('#comboboxPJN_CLPCodigo').val();
            var PJN_TORCodigo = $('#comboboxTipoOrcamento').val();
            var PJN_FechmtoPeriInicio = $('#inputPJN_FechmtoPeriInicio').val();
            var PJN_FechmtoPeriInicioMes = $('#inputPJN_FechmtoPeriInicioMes').val();
            var PJN_FechmtoPeriTermino = $('#inputPJN_FechmtoPeriTermino').val();
            var PJN_FechmtoPeriTerminoMes = $('#inputPJN_FechmtoPeriTerminoMes').val();
            var PJN_FechmtoDiaFechar = $('#inputPJN_FechmtoDiaFechar').val();
            var PJN_PagmntoDiasPrazo = $('#inputPJN_PagmntoDiasPrazo').val();
            var PJN_PropostaCaminho = $('#inputPJN_PropostaCaminho').val();
            var PJN_NotaFsclDescricao = $('#inputPJN_NotaFsclDescricao').val();
            var PJN_IndiceImposto = $('#inputPJN_IndiceImposto').val().replace('%', '').replace('.', '').replace(',', '.');            
            var PJN_CentroCustoCliente = $('#inputPJN_CentroCustoCliente').val();
            // var PJN_ValorTotal = $('#inputPJN_ValorTotal').val();

            var PJN_ValorTotal = $('#inputPJN_ValorTotal').val().replace('R$ ', '').replace('.', '').replace(',', '.');

            var PJN_ObsDoFaturamento = $('#inputPJN_ObsDoFaturamento').val();
           
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updateConfiguracaoFinanceira",
                type: 'POST',
                data: {
                    PJN_PJTCodigo: <?php echo $this->uri->segment(2); ?>,
                    PJN_CLPCodigo: PJN_CLPCodigo,
                    PJN_TORCodigo: PJN_TORCodigo,
                    PJN_FechmtoPeriInicio: PJN_FechmtoPeriInicio,
                    PJN_FechmtoPeriInicioMes: PJN_FechmtoPeriInicioMes,
                    PJN_FechmtoPeriTermino: PJN_FechmtoPeriTermino,
                    PJN_FechmtoPeriTerminoMes: PJN_FechmtoPeriTerminoMes,
                    PJN_FechmtoDiaFechar: PJN_FechmtoDiaFechar,
                    PJN_PagmntoDiasPrazo: PJN_PagmntoDiasPrazo,
                    PJN_PropostaCaminho: PJN_PropostaCaminho,
                    PJN_NotaFsclDescricao: PJN_NotaFsclDescricao,
                    PJN_IndiceImposto: PJN_IndiceImposto,
                    PJN_CentroCustoCliente: PJN_CentroCustoCliente,
                    PJN_ValorTotal: PJN_ValorTotal,
                    PJN_ObsDoFaturamento: PJN_ObsDoFaturamento

                }
            });
        }

        function updateMonitoramento() {
            var arrayMonitoramento = [];
            $('#tableMonitoramento').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var PJM_PJTCodigo = <?php echo $this->uri->segment(2); ?>;
                var PJM_DataDaAgendaRevisao = $tds.eq(0).find('input').val().split("/").reverse().join("-");
                var PJM_ERMCodigo = $tds.eq(1).find('option:selected').val();
                var PJM_mDescricaoDaRevisao = $tds.eq(2).find('input').val();
                var PJM_Codigo = null;
                if ($(this).attr('id') != null) {
                    PJM_Codigo = $(this).attr('id');

                }
                arrayMonitoramento.push([PJM_PJTCodigo, PJM_DataDaAgendaRevisao, PJM_ERMCodigo, PJM_mDescricaoDaRevisao, PJM_Codigo]);
            });
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updateMonitoramento",
                type: 'POST',
                data: {
                    arrayMonitoramento: arrayMonitoramento
                },
                error: function(x) {
                    console.log(x);
                }
            });
        }

        function deleteMonitoramento() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/deleteMonitoramento",
                type: 'POST',
                data: {
                    arrayDeletedMonitoramento: arrayDeletedMonitoramento
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            });
        }


        function fetchCliente() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchCliente",
                dataType: 'json',
                error: function(x) {
                    console.log(x);
                }
            });
        }

        function fetchGestor() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchGestor",
                dataType: 'json',
                error: function(x) {
                    console.log('error aqui');
                    console.log(x);
                    console.log('error aqui');
                }
            });
        }

        function fetchProject($idProjeto) {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchProject",
                type: 'POST',
                data: {
                    PJT_CODIGO: $idProjeto
                },
                dataType: "json",
                error: function(x) {
                    console.log(x);
                }
            });
        }

        function fetchStatusProjeto() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchStatusProjeto",
                dataType: 'json',
                error: function(x) {
                    console.log(x);
                }
            });
        }

        function fetchEspecieRevisao() {
            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchEspecieRevisao",
                dataType: 'json',
                error: function(x) {
                    console.log(x);
                }
            });
        }


        function fetchCatalogoServico($idCatalogo) {
            $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/fetchCatalogoServico",
                type: 'POST',
                data: {
                    CSI_CODIGO: $idCatalogo
                },
                dataType: "json",
                success: function(data) {


                    currentCatalogo = data;
                    console.log(data.CSI_SERVTITULO);
                    console.log(data.CSI_SERVSUBTITULO);


                    $('#spanTitle').text(data.CSI_SERVTITULO);
                    $('#spanSubtitle').text(data.CSI_SERVSUBTITULO);
                    // removeSpinner();
                },
                error: function(x) {
                    console.log(x);
                }
            });
        }


        $('#btnUpdateProjeto').click(function() {
            loadBlurSpinner();
            $.when(updateProjeto(), updateANS(), deleteANS(), updatePlanoDeDados(), deletePlanoDados(), updateMonitoramento(), deleteMonitoramento(), updatePlanoComunicacao(), deletePlanoComunicacao(), updateTermosProjeto(), updateConfiguracaoDoChamado(), updateConfiguracaoFinanceira(), DeletedFapParcela(), updateFapParcela() ).done(function() {
                window.open('<?php echo base_url("detalheProjeto/"); ?>' + <?php echo $this->uri->segment(2); ?>, '_self');
            });
        });

        function updateProjeto() {
            var PJT_TITULO = $('#inputTextPJT_TITULO').val();
            var PJT_APELIDO = $('#inputTextPJT_APELIDO').val();
            var PJT_VhSysCCustoId = $('#inputTextPJT_VhSysCCustoId').val();

            var CBR_CODIGO = $('#comboboxGestor').val();
            var PJT_STATUS = $('#comboboxPJT_STATUS').val();            
            // var PJT_TECNOLOGIA = $('#comboboxPJT_TECNOLOGIA').val();
            var PJT_QTHORA = $('#inputTextPJT_QTHORA').val();
            var PJT_VRHORA = $('#inputTextPJT_VRHORA').val().replace('R$ ', '').replace('.', '').replace(',', '.');
            var PJT_DATAINICIO = $('#inputTextPJT_DATAINICIO').val();
            var PJT_DATATERMINO = $('#inputTextPJT_DATATERMINO').val();
            var PJT_TREINAMENTOEQUIPE = $('#textareaPJT_TREINAMENTOEQUIPE').val();
            var PJT_EscopoDoPlano = $('#textareaPJT_EscopoDoPlano').val();

            if ($('#comboboxCliente').val() != 0 && $('#comboboxCliente').val() != "none") {
                var CLI_CODIGO = $('#comboboxCliente').val();
            }
            var PJN_TORCodigo = null;

            if ($('#comboboxTipoOrcamento').val() != "none") {
                PJN_TORCodigo = $('#comboboxTipoOrcamento').val();
            }

            var PJT_PLACOMUNICACAO = $('#inputTextPJT_PLACOMUNICACAO').val();
            var PJT_DATAINICIO = PJT_DATAINICIO.split("/").reverse().join("-");
            var PJT_DATATERMINO = PJT_DATATERMINO.split("/").reverse().join("-");

            return $.ajax({
                url: "<?php echo base_url(); ?>editarProjeto/updateProjeto",
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>,
                    PJT_TITULO: PJT_TITULO,
                    PJT_APELIDO: PJT_APELIDO,
                    PJT_VhSysCCustoId: PJT_VhSysCCustoId,
                    CBR_CODIGO: CBR_CODIGO,
                    // PJT_TECNOLOGIA: PJT_TECNOLOGIA,
                    PJT_QTHORA: PJT_QTHORA,
                    PJT_VRHORA: PJT_VRHORA,
                    PJT_DATAINICIO: PJT_DATAINICIO,
                    PJT_DATATERMINO: PJT_DATATERMINO,                    
                    CLI_CODIGO: CLI_CODIGO,
                    PJT_EscopoDoPlano: PJT_EscopoDoPlano,
                    PJT_STATUS: PJT_STATUS,
                    PJT_TREINAMENTOEQUIPE: PJT_TREINAMENTOEQUIPE,
                    PJT_PLACOMUNICACAO: PJT_PLACOMUNICACAO
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            });
        }

        $(document).ready(function() {
            
            // $('#comboboxCliente').change(function() {
            //   var index = getArrayIndexForKey(arrayClientes, "PES_Nome", $('#comboboxCliente option:selected').val());
            //   $('#inputTextCLI_NOMEFANTASIA').val(arrayClientes[index].PES_Apelido);
            // });

            $('#addFapParcela').click(function() {
                var html = '<tr>';
                html += '<td><input type="number" step="1" class="form-control" /></td>';
                html += '<td><input type="number" format="currency" precision="2" class="form-control" /></td>';
                html += '<td><input type="date" class="form-control" /></td>';
                html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
                html += '</tr>';
                $('#tableFapParcela tbody').append(html);
            });

            $('#addPlanoDados').click(function() {
                var html = '<tr>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
                html += '</tr>';
                $('#tablePlanoDados tbody').append(html);
            });

            $('#addPlanoComunicacao').click(function() {
                var html = '<tr>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td><input type="text" class="form-control" /></td>';
                html += '<td id="delete"><i class="fas fa-trash-alt"></i></td>';
                html += '</tr>';
                $('#tablePlanoComunicacao tbody').append(html);
            });

            $(document).on('click', '#delete', function() {
                if ($(this).parent().parent().parent().attr('id') == "tableANS") {
                    arrayDeletedANS.push($(this).parent().attr('id'));

                } else if ($(this).parent().parent().parent().attr('id') == "tablePlanoDados") {
                    arrayDeletedPlanoDados.push($(this).parent().attr('id'));

                } else if ($(this).parent().parent().parent().attr('id') == "tablePlanoComunicacao") {
                    arrayDeletedPlanoComunicacao.push($(this).parent().attr('id'));

                } else if ($(this).parent().parent().parent().attr('id') == "tableFapParcela") {
                    arrayDeletedFapParcela.push($(this).parent().attr('id'));

                }
                $(this).parent().remove();
            });


            $(document).on('click', '#deleteMonitoramento', function() {
                arrayDeletedMonitoramento.push($(this).parent().parent().attr('id'));
                $(this).parent().parent().remove();

            });


            $('#inputTextPJT_QTHORA').mask("0000", {
                placeholder: "9999"
            });


            $('#inputTextPJT_DATAINICIO').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                },
                placeholder: "DD/MM/AAAA"
            });
            $('#inputTextPJT_DATATERMINO').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                },
                placeholder: "DD/MM/AAAA"
            });
            $("#inputTextPJT_VRHORA").maskMoney({
                prefix: "R$ ",
                decimal: ",",
                thousands: "."
            });

        });

        $('#checkboxPJC_FlgRecebeChamado').change(function() {
            Des_habilitaCamposPJC($('#checkboxPJC_FlgRecebeChamado').is(':checked') == true ? 1 : 0);            
        });

        function Des_habilitaCamposPJC(pDesHab) {
            var vDesHab = pDesHab == 1 ? 0 : 1;
            $('#inputPJC_DescrAcolhimento').prop("disabled", vDesHab);
            $('#checkboxPJC_FlgMostraPrazo').prop("disabled", vDesHab);
            $('#checkboxPJC_FlgMostraAvaliacao').prop("disabled", vDesHab);
            $('#checkboxPJC_FlgMostraTrd').prop("disabled", vDesHab);
            $('#checkboxPJC_FlgMostraDocReferencia').prop("disabled", vDesHab);
            $('#checkboxPJC_FlgMostraOrcamento').prop("disabled", vDesHab);
            $('#checkboxPJC_FlgDisparaEmail').prop("disabled", vDesHab);                        
            $('#inputPJC_OrcaTermoAceite').prop("disabled", vDesHab);
            $('#inputPJC_EntrTermoEntrega').prop("disabled", vDesHab);
        }

        function setInputTextHints() {
            $('#inputPJC_DescrAcolhimento').prop('title', 'Texto da tela home do cliente. Tipo: Você está no Sirius, o sistema de chamados da wDiscover ...');
            $('#checkboxPJC_FlgMostraPrazo').prop('title', 'Marque para que a lista de chamados do cliente mostre o prazo final para a duração de cada status do chamado.');
            $('#checkboxPJC_FlgMostraAvaliacao').prop('title', 'Marque para que em status específicos (em garantia, por exemplo)\na lista do cliente peça por avaliação do atendimento.');
            $('#checkboxPJC_FlgMostraTrd').prop('title', 'Marque para que em status específicos (aguardando homologação, por exemplo)\na lista do cliente peça pelo Termo de Entrega Definitiva do serviço solicitado.');
            $('#checkboxPJC_FlgMostraDocReferencia').prop('title', 'Marque caso o cliente tenha outro documento interno de controle das solicitações.\nPor exemplo: Ordem de Serviços (OS), sistema de chamados etc.\nSerão disponibilizados campos para ele registrar esse documento.');
            $('#checkboxPJC_FlgMostraOrcamento').prop('title', 'Marque caso os chamados precisem de orçamento e aprovação do cliente.\nSerão disponibilizados o valor orçado e botão para aprovação.');    
            $('#checkboxPJC_FlgDisparaEmail').prop('title', 'Marque para que os fornecedores de requisitos (solicitantes) recebam notificações na abertura e interações do chamado.');
            $('#checkboxPJC_FlgRecebeChamado').prop('title', 'Marque caso o Plano de Serviço receba chamados como atividades em sua WBS.');
            $('#inputPJC_OrcaTermoAceite').prop('title', 'Texto para o termo de aceite, lido pelo usuário antes de aprovar o orçamento do chamado.');
            $('#inputPJC_EntrTermoEntrega').prop('title', 'Texto para o termo de TRD (Termo de Recebimento Dfinitivo), lido pelo usuário antes de declarar entregue o serviço do chamado.');
            $('#inputPJN_FechmtoPeriInicioMes').prop('title', 'Selecione em qual mês será considerado o primeiro dia do período de referência:\nM = 0: no próprio mês de referência;\nM - 1: no no mês anterior ao de referência;\nM + 1: no no mês posterior ao de referência.');
            $('#inputPJN_FechmtoPeriTerminoMes').prop('title', 'Selecione em qual mês será considerado o último dia do período de referência:\nM = 0: no próprio mês de referência;\nM - 1: no no mês anterior ao de referência;\nM + 1: no no mês posterior ao de referência.');
            
            

            $('#comboboxGestor').prop('title', 'Selecione o Gestor do Projeto / Operação de Serviço.\nAté a versão anterior, era o Gestor de Contas.');
            
            $('#comboboxTipoOrcamento').prop('title', 'Selecione o Tipo de Faturamento para o Plano de Serviço.\nIsso será usado no cálculo da pré-fatura. Para cada tipo de faturamento, forma diferente de gerar a Pré-fatura.');
            $('#comboboxPJN_CLPCodigo').prop('title', 'Selecione a Pessoa que é responsável do Cliente pelo faturamento.');
            $('#inputPJN_PropostaCaminho').prop('title', 'Informe o link ou o nome da caminho da proposta.\nPasta/subpasta/arquivo onde se encontra a proposta que gerou o Plano de Serviços.');
            $('#inputPJN_FechmtoPeriInicio').prop('title', 'Informe o dia do mês que se inicia o período de referência para faturamento\nIsso é necessário para delinear a busca dos apontamentos de horas que referenciam o faturamento.\nEscolha "Início" para o Ogma considerar o dia do início do projeto (Plano).');
            $('#inputPJN_FechmtoPeriTermino').prop('title', 'Informe o dia do mês que termina o período de referência para faturamento\nIsso é necessário para delinear a busca dos apontamentos de horas que referenciam o faturamento.\nEscolha "Final" para o Ogma considerar o dia do término do projeto (Plano).\nDia 30 representará o útimo dia do mês.');
            $('#inputPJN_FechmtoDiaFechar').prop('title', 'Informe o número de dias após o término do período de referência, para o fechamento da fatura.');
            $('#inputPJN_PagmntoDiasPrazo').prop('title', 'Informe o número de dias após o término do período de referência, para a quitação da fatura pelo cliente devedor.');
            $('#inputPJN_NotaFsclDescricao').prop('title', 'Descreva o texto sugerido para estar no corpo da Nota Fiscal / Fatura.');
            $('#thPJE_ParcelaOrdem').prop('title', 'Informe nessa coluna o número de ordem da parcela para faturamento.');
            $('#thPJE_ParcelaValor').prop('title', 'Informe nessa coluna o valor da parcela para faturamento.');
            $('#thPJE_ParcelaVencimento').prop('title', 'Informe nessa coluna a data de vencimento da parcela para faturamento.');
            $('#addFapParcela').prop('title', 'Clique para adicionar nova linha/parcela à tabela.');

            $('#inputPJN_ObsDoFaturamento').prop('title', 'Descreva quaiquer observações a respeito do financeiro deste Plano de Serviço.');
            $('#inputPJN_CentroCustoCliente').prop('title', 'Informe qual o Centro de Custo do Plano de Serviço do Sistema Financeiro, para o Cliente.');
            $('#inputPJN_ValorTotal').prop('title', 'Informe o valor total do Plano de Serviço.\nO valor de venda do PPx para o Cliente.');
            $('#inputPJN_IndiceImposto').prop('title', 'Informe a alíquota de tributos incidente sobre o valor total do Plano.\nIsso será usado nos cálculos de custo.');
                        
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