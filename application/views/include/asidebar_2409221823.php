
<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item" id="liHome">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('home/'); ?>" aria-expanded="false">
                        <i class="mdi mdi-home"></i><span class="hide-menu">HOME</span>
                    </a>
                </li>

                <li class="sidebar-item" id="liConsultoria">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-worker"></i><span class="hide-menu">CONSULTORIA</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level" id="ulConsultoria">
                        <li class="sidebar-item" id="liConsultoriaApontarHoras">
                            <a href="<?php echo base_url('apontarHoras/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-record"></i><span class="hide-menu"> Apontar Horas </span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="liConsultoriaRelatorio">
                            <a href="<?php echo base_url('relatorioApontamentoHoras/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-record"></i><span class="hide-menu"> Relatório Apontamento Horas </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php if (($this->session->userdata('USU_FlgPodeAcessarGestaoPlanos') == 1) || ($this->session->userdata('LIDER_EQP') == 1)) : ?>
                    <li class="sidebar-item" id="liGpo">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-math-compass"></i><span class="hide-menu">GERÊNCIA DE PROJETOS</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level" id="ulGpo">
                            <li class="sidebar-item" id="liAtgCroEdita">
                                <a href="<?php echo base_url('AtgCroEdita/'); ?>" class="sidebar-link">
                                    <i class="mdi mdi-record"></i><span class="hide-menu"> Cronograma da Fase </span>
                                </a>
                            </li>
                            <?php if ($this->session->userdata('USU_FlgPodeAcessarGestaoPlanos') == 1): ?>
                                <li class="sidebar-item" id="liGpoRelApp">
                                    <a href="<?php echo base_url('RelApp/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-library"></i><span class="hide-menu"> Apontamentos do Período </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('USU_FlgPodeAcessarGestaoPlanos') == 5): ?>
                                <li class="sidebar-item" id="liExpercha">
                                    <a href="<?php echo base_url('Expercha/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-record"></i><span class="hide-menu"> Extrato Chamados </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liGpoOquefaz">
                                    <a href="<?php echo base_url('GpoOquefaz/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-library"></i><span class="hide-menu"> Quem faz o quê na semana </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liGpoRelStEco">
                                    <a href="<?php echo base_url('GpoRelStEco/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-record"></i><span class="hide-menu"> Relatório Status Econômico </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liGpoRelStAva">
                                    <a href="<?php echo base_url('GpoRelStAva/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-record"></i><span class="hide-menu"> Relatório Status AVA </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liDicLista">
                                    <a href="<?php echo base_url('ListaDisponibilidade/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-record"></i><span class="hide-menu"> Disponibilidade {BETA} </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liDigLista">
                                    <a href="<?php echo base_url('ListaGestaoRecursos/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-record"></i><span class="hide-menu"> Gestão de recursos {BETA} </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liListaCeckChamado">
                                    <a href="<?php echo base_url('ListaCeckChamado'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-record"></i><span class="hide-menu"> Check Chamado {BETA} </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liListaCeckPpd">
                                    <a href="<?php echo base_url('ListaCeckPpd'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-record"></i><span class="hide-menu"> Check PPD {BETA} </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="sidebar-item" id="liServico">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-rowing"></i><span class="hide-menu">SERVIÇO</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level" id="ulServico">
                        <li class="sidebar-item" id="liServicoProjeto">
                            <a href="<?php echo base_url('listaProjeto/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-record"></i><span class="hide-menu"> Plano de Serviço </span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="liServicoChamado">
                            <a href="<?php echo base_url('listaChamado/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-record"></i><span class="hide-menu"> Chamado </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item" id="liComercial">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-access-point"></i><span class="hide-menu" style="color: white;">COMERCIAL</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level" id="ulComercial">
					    <li class="sidebar-item" id="liContratoMaster">
                            <a href="<?php echo base_url('ListaContratoMaster/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-umbrella-outline"></i><span class="hide-menu" style="color: white;">Contrato Master</span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="liCliLista">
                            <a href="<?php echo base_url('CliLista/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-account-star"></i><span class="hide-menu" style="color: white;">Cadastro de Cliente</span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="liCadastrosBasicosCom">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i><span class="hide-menu" style="color: white;">Cadastros Básicos</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level" id="ulCadastrosBasicosCom">
                                <li class="sidebar-item" id="liStatusContrato">
                                    <a href="<?php echo base_url('ListaStatusContrato/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings" style="color: Aquamarine;"></i><span class="hide-menu" style="color: Aquamarine;">Status do Contrato</span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liUnidadePadraoContrato">
                                    <a href="<?php echo base_url('ListaUnidadeContrato/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings" style="color: Aquamarine;"></i><span class="hide-menu" style="color: Aquamarine;">Unidade Padrão do Contrato</span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liTipoContrato">
                                    <a href="<?php echo base_url('ListaTipoContrato/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings" style="color: Aquamarine;"></i><span class="hide-menu" style="color: Aquamarine;">Tipo do Contrato</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item" id="liAdministracao">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-stackoverflow"></i><span class="hide-menu">ADMINISTRATIVO</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level" id="ulAdministrativo">
                        <li class="sidebar-item" id="liPesLista">
                            <a href="<?php echo base_url('pessoa/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-account"></i><span class="hide-menu"> Cadastro Pessoa </span>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('USU_FlgPodeEditarColaborador') == 1): ?>
                            <li class="sidebar-item" id="liColaborador">
                                <a href="<?php echo base_url('CbrLista/'); ?>" class="sidebar-link">
                                    <i class="mdi mdi-account-convert"></i><span class="hide-menu"> Cadastro Colaborador </span>
                                </a>
                            </li>
                            <li class="sidebar-item" id="liCargo">
                                <a href="<?php echo base_url('CgoLista/'); ?>" class="sidebar-link">
                                    <i class="mdi mdi-account-box-outline"></i><span class="hide-menu"> Cadastro Cargo </span>
                                </a>
                            </li>                            
                        <?php endif; ?>
                    </ul>
                </li>



                <li class="sidebar-item" id="liFinanceiro">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-coin"></i><span class="hide-menu">FINANCEIRO</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level" id="ulFinanceiro">
                        <?php if ($this->session->userdata('USU_FlgPodePreFaturar') == 1): ?>
                            <li class="sidebar-item" id="liFapPreFaturar">
                                <a href="<?php echo base_url('FapPreFaturar/'); ?>" class="sidebar-link">
                                    <i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i><span class="hide-menu"> FAP | Pré-faturar </span>
                                </a>
                            </li>
                            <li class="sidebar-item" id="liFapFechar">
                                <a href="<?php echo base_url('FapVisual/'); ?>" class="sidebar-link">
                                    <i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i><span class="hide-menu"> FAP | Fechar Pré-faturamento </span>
                                </a>
                            </li>
                            <li class="sidebar-item" id="liFapExtrato">
                                <a href="<?php echo base_url('FapRelExtrFaturamento/'); ?>" class="sidebar-link">
                                    <i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i><span class="hide-menu"> FAP | Extrato Pré-faturamento </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('USU_FlgPodePrePagar') == 1): ?>
                            <li class="sidebar-item" id="liFmcPrePagar">
                                <a href="<?php echo base_url('FmcPrePagar/'); ?>" class="sidebar-link">
                                    <i class="mdi mdi-battery-negative" style="color: #B22222;"></i><span class="hide-menu"> FMC | Pré-pagar </span>
                                </a>
                            </li>
                            <?php if ($this->session->userdata('USU_FlgPodeEditarColaborador') == 1): ?>
                                <li class="sidebar-item" id="liFmcFechar">
                                    <a href="<?php echo base_url('FmcFechar/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-battery-negative" style="color: #B22222;"></i><span class="hide-menu"> FMC | Fechar Pré-pagamento </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liFmcFolha">
                                    <a href="<?php echo base_url('FmcFolha/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-battery-negative" style="color: #B22222;"></i><span class="hide-menu"> FMC | Fechar Folha </span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liFechaMes">
                                    <a href="<?php echo base_url('CbrFechaMes/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-battery-negative" style="color: #B22222;"></i><span class="hide-menu"> FMC | Fechar Folha Detalhada </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <hr style="border-top: 1px solid #ccc; margin: 10px 0;">
                        <li class="sidebar-item" id="liExpeproj">
                            <a href="<?php echo base_url('Expeproj/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-library"></i><span class="hide-menu"> Extrato Planos de Serviço </span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="liEmailFaturamento">
                            <a href="<?php echo base_url('emailFaturamento/'); ?>" class="sidebar-link">
                                <i class="mdi mdi-email-variant"></i><span class="hide-menu"> E-mail Faturamento </span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="liCadastrosBasicosFin">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i><span class="hide-menu" style="color: white;">Cadastros Básicos</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level" id="ulCadastrosBasicosFin">
                                <li class="sidebar-item" id="liCondicaoFaturamento">
                                    <a href="<?php echo base_url('ListaCondicaoFaturamento/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings" style="color: Aquamarine;"></i><span class="hide-menu" style="color: Aquamarine;">Condição de Faturamento</span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liCondicaoPagamento">
                                    <a href="<?php echo base_url('ListaCondicaoPagamento/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings" style="color: Aquamarine;"></i><span class="hide-menu" style="color: Aquamarine;">Condição de Pagamento</span>
                                    </a>
                                </li>                                
                            </ul>
                        </li>                        
                    </ul>
                </li>

                <li class="sidebar-item" id="liConfiguracao">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-settings"></i><span class="hide-menu">CONFIGURAÇÃO</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level" id="ulConfiguracao">

                        <!-- Grupo Serviço -->
                        <li class="sidebar-item" id="liServicoGroup">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-rowing"></i><span class="hide-menu">Serviço</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item" id="liStc">
                                    <a href="<?php echo base_url('ListaStatusChamado/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings"></i><span class="hide-menu">Status Chamado</span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liStp">
                                    <a href="<?php echo base_url('ListaStatusProjeto/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings"></i><span class="hide-menu">Status Projeto</span>
                                    </a>
                                </li>
                                <li class="sidebar-item" id="liCas">
                                    <a href="<?php echo base_url('CasLista?aCasAtivo=3&aCsiId=0&aCasAbreI=0/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings"></i><span class="hide-menu">Catálogo Serviços</span>
                                    </a>
                                </li>
                                <?php if ($this->session->userdata('USU_FlgPodeEditarColaborador') == 1): ?>
                                    <li class="sidebar-item" id="liEditaSvc">
                                        <a href="<?php echo base_url('EditaSvc/'); ?>" class="sidebar-link">
                                            <i class="mdi mdi-settings"></i><span class="hide-menu">Configurações</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <!-- Grupo Financeiro -->
                        <li class="sidebar-item" id="liFinanceiroGroup">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-coin"></i><span class="hide-menu">Financeiro</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item" id="liTor">
                                    <a href="<?php echo base_url('TorLista/'); ?>" class="sidebar-link">
                                        <i class="mdi mdi-settings"></i><span class="hide-menu">Tipo Faturamento</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Grupo Geral -->
                        <?php if ($this->session->userdata('USU_FlgPodeEditarUsuario') == 1): ?>
                            <li class="sidebar-item" id="liGeralGroup">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-home"></i><span class="hide-menu">Geral</span>
                                </a>
                                <ul aria-expanded="false" class="collapse second-level">
                                    <li class="sidebar-item" id="liUsuLista">
                                        <a href="<?php echo base_url('ListaUsuario/'); ?>" class="sidebar-link">
                                            <i class="mdi mdi-settings"></i><span class="hide-menu">Cadastro Usuário</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
