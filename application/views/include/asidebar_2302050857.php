<aside class="left-sidebar" data-sidebarbg="skin5">
    
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item" id="liHome"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('home/'); ?>" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">HOME</span></a></li>
                <!--
                <li class="sidebar-item" id="liCliente"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Cliente</span></a></li>
                -->
                <li class="sidebar-item" id="liConsultoria"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-worker"></i><span class="hide-menu">CONSULTORIA </span></a>
                    <ul aria-expanded="false" class="collapse  first-level" id="ulConsultoria">
                        <li class="sidebar-item" id="liConsultoriaApontarHoras"><a href="<?php echo base_url('apontarHoras/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Apontar Horas </span></a></li>
                        <li class="sidebar-item" id="liConsultoriaRelatorio"><a href="<?php echo base_url('relatorioApontamentoHoras/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Relatório Apontamento Horas </span></a></li>
                    </ul>
                </li>

                <?php if ($this->session->userdata('USU_FlgPodeAcessarGestaoPlanos') == 1): ?>
                    <li class="sidebar-item" id="liGpo"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-math-compass"></i><span class="hide-menu">GERÊNCIA DE PROJETOS
                    </span></a>
                        <ul aria-expanded="false" class="collapse  first-level" id="ulGpo">                            
                            <li class="sidebar-item" id="liGpoRelApp"><a href="<?php echo base_url('RelApp/'); ?>" class="sidebar-link"><i class="mdi mdi-library"></i><span class="hide-menu"> Apontamentos do Período </span></a></li>
                            <li class="sidebar-item" id="liAtgCroEdita"><a href="<?php echo base_url('AtgCroEdita/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Cronograma da Fase </span></a></li>
                            <li class="sidebar-item" id="liExpercha"><a href="<?php echo base_url('Expercha/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Extrato Chamados </span></a></li>
                            <li class="sidebar-item" id="liExpeproj"><a href="<?php echo base_url('Expeproj/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Extrato Projetos </span></a></li>
                            <li class="sidebar-item" id="liGpoOquefaz"><a href="<?php echo base_url('GpoOquefaz/'); ?>" class="sidebar-link"><i class="mdi mdi-library"></i><span class="hide-menu"> Quem faz o quê na semana </span></a></li>
                            <?php if ($this->session->userdata('USU_FlgPodeAcessarGestaoPlanos') == 5): ?>
                                <li class="sidebar-item" id="liGpoRelStEco"><a href="<?php echo base_url('GpoRelStEco/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Relatório Status Econômico </span></a></li>
                                <li class="sidebar-item" id="liGpoRelStAva"><a href="<?php echo base_url('GpoRelStAva/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Relatório Status AVA </span></a></li>
                                <li class="sidebar-item" id="liDicLista"><a href="<?php echo base_url('ListaDisponibilidade/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Disponibilidade {BETA} </span></a></li>
                                <li class="sidebar-item" id="liDigLista"><a href="<?php echo base_url('ListaGestaoRecursos/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Gestão de recursos {BETA} </span></a></li>
                                <li class="sidebar-item" id="liListaCeckChamado"><a href="<?php echo base_url('ListaCeckChamado'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Check Chamado {BETA} </span></a></li>
                                <li class="sidebar-item" id="liListaCeckPpd"><a href="<?php echo base_url('ListaCeckPpd'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Check PPD {BETA} </span></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>


                <li class="sidebar-item" id="liServico"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-rowing"></i><span class="hide-menu">SERVIÇO </span></a>
                    <ul aria-expanded="false" class="collapse  first-level" id="ulServico">
                        <li class="sidebar-item" id="liServicoProjeto"><a href="<?php echo base_url('listaProjeto/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Plano de Serviço </span></a></li>
                        <li class="sidebar-item" id="liServicoChamado"><a href="<?php echo base_url('listaChamado/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Chamado </span></a></li>
                    </ul>
                </li>


                <li class="sidebar-item" id="liComercial"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"> <i class="mdi mdi-access-point"></i> <span class="hide-menu">COMERCIAL </span></a>
                    <ul aria-expanded="false" class="collapse  first-level" id="ulComercial">
                        <li class="sidebar-item" id="liCliLista"><a href="<?php echo base_url('CliLista/'); ?>" class="sidebar-link"><i class="mdi mdi-account-star"></i><span class="hide-menu"> Cadastro Cliente </span></a></li>
                    </ul>
                </li>


                <li class="sidebar-item" id="liAdministracao"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"> <i class="mdi mdi-stackoverflow"></i> <span class="hide-menu">ADMINISTRATIVO </span></a>
                    <ul aria-expanded="false" class="collapse  first-level" id="ulAdministrativo">
                        <li class="sidebar-item" id="liPesLista"><a href="<?php echo base_url('pessoa/'); ?>" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu"> Cadastro Pessoa </span></a></li>
                        <?php if ($this->session->userdata('USU_FlgPodeEditarColaborador') == 1): ?>
                            <li class="sidebar-item" id="liColaborador"><a href="<?php echo base_url('CbrLista/'); ?>" class="sidebar-link"><i class="mdi mdi-account-convert"></i><span class="hide-menu"> Cadastro Colaborador </span></a></li>
                            <li class="sidebar-item" id="liCargo"><a href="<?php echo base_url('CgoLista/'); ?>" class="sidebar-link"><i class="mdi mdi-account-box-outline"></i><span class="hide-menu"> Cadastro Cargo </span></a></li>
                            <li class="sidebar-item" id="liRelatorioFechaMes"><a href="<?php echo base_url('colaborador/relatorio/relatorioFechaMes'); ?>" class="sidebar-link"><i class="mdi mdi-library"></i><span class="hide-menu"> Fechamento Mensal </span></a></li>
                            <li class="sidebar-item" id="liRelatorioFechaMes"><a href="<?php echo base_url('CbrFechaMes/'); ?>" class="sidebar-link"><i class="mdi mdi-alert-octagram" style="color: #FFFF00;"></i><span class="hide-menu"> Fechamento Mensal </span></a></li>
                            <li class="sidebar-item" id="liExportarvhsys"><a href="<?php echo base_url('exportarvhsys/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> VhSys Exportar </span></a></li> 
                            <li class="sidebar-item" id="liEmailFaturamento"><a href="<?php echo base_url('emailFaturamento/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> E-mail faturamento </span></a></li>  
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="sidebar-item" id="liFinanceiro"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"> <i class="mdi mdi-coin"></i> <span class="hide-menu">FINANCEIRO </span></a>
                    <ul aria-expanded="false" class="collapse  first-level" id="ulFinanceiro">
                        <?php if ($this->session->userdata('USU_FlgPodePreFaturar') == 1): ?>
                            <li class="sidebar-item" id="liFapPreFaturar"><a href="<?php echo base_url('FapPreFaturar/'); ?>" class="sidebar-link"><i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i><span class="hide-menu"> FAP | Pré-faturar </span></a></li>
                            <li class="sidebar-item" id="liFapFechar"><a href="<?php echo base_url('FapVisual/'); ?>" class="sidebar-link"><i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i><span class="hide-menu" > FAP | Fechar Pré-faturamento </span></a></li>
                            <li class="sidebar-item" id="liFapExtrato"><a href="<?php echo base_url('FapRelExtrFaturamento/'); ?>" class="sidebar-link"><i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i><span class="hide-menu"> FAP | Extrato Pré-faturamento </span></a></li>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('USU_FlgPodePrePagar') == 1): ?>
                            <li class="sidebar-item" id="liFmcPrePagar"><a href="<?php echo base_url('FmcPrePagar/'); ?>" class="sidebar-link" ><i class="mdi mdi-battery-negative" style="color: #B22222;"></i><span class="hide-menu"> VERSÃO BETA</br>FMC | Pré-pagar </span></a></li>
                            <?php if ($this->session->userdata('USU_FlgPodeEditarColaborador') == 1): ?>
                                <li class="sidebar-item" id="liFmcFechar"><a href="<?php echo base_url('FmcFechar/'); ?>" class="sidebar-link" ><i class="mdi mdi-battery-negative" style="color: #B22222;"></i><span class="hide-menu"> VERSÃO BETA</br>FMC | Fechar Pré-pagamento </span></a></li>
                                <li class="sidebar-item" id="liFmcFolha"><a href="<?php echo base_url('FmcFolha/'); ?>" class="sidebar-link" ><i class="mdi mdi-battery-negative" style="color: #B22222;"></i><span class="hide-menu"> VERSÃO BETA</br>FMC | Fechar Folha </span></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <!--
                        <li class="sidebar-item" id="liFmcFechar"><a href="<!?php echo base_url('FmcCriar/'); ?>" class="sidebar-link" ><i class="mdi mdi-battery-negative"></i><span class="hide-menu"> FMC | Fechar Pré-pagamento </span></a></li>
                        <li class="sidebar-item" id="liFmcExtrato"><a href="<!?php echo base_url('FmcRelExtrato/'); ?>" class="sidebar-link"><i class="mdi mdi-battery-negative"></i><span class="hide-menu"> FMC | Extrato Pré-pagamento </span></a></li>
                        -->
                        <!-- <li class="sidebar-item" id="liFapLista"><a href="<!?php echo base_url('FapLista/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Pré-fatura Gerar </span></a></li>
                        <li class="sidebar-item" id="liFapVisual"><a href="<!?php echo base_url('FapVisual/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Pré-fatura Visualizar </span></a></li>
                        <li class="sidebar-item" id="liFapSemFatura"><a href="<!?php echo base_url('FapSemFatura/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Sem Pré-fatura </span></a></li> -->
                        
                    </ul>
                </li>
                                

                <li class="sidebar-item" id="liConfiguracao"> <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">CONFIGURAÇÃO</span></a>
                    <ul aria-expanded="false" class="collapse  first-level" id="ulConfiguracao">
                        <li class="sidebar-item" id="liStc"><a href="<?php echo base_url('ListaStatusChamado/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Serviço</br>Status Chamado </span></a></li>
                        <li class="sidebar-item" id="liStp"><a href="<?php echo base_url('ListaStatusProjeto/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Serviço</br>Status Projeto </span></a></li>
                        <li class="sidebar-item" id="liCas"><a href="<?php echo base_url('CasLista?aCasAtivo=3&aCsiId=0&aCasAbreI=0/'); ?>" class="sidebar-link"><i class="mdi mdi-format-align-justify"></i><span class="hide-menu"> Serviço</br>Catálogo Serviços </span></a></li>
                        <?php if ($this->session->userdata('USU_FlgPodeEditarColaborador') == 1): ?>
                            <li class="sidebar-item" id="liEditaSvc"><a href="<?php echo base_url('EditaSvc/'); ?>" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> Serviço</br>Configurações </span></a></li>
                        <?php endif; ?>
                        <li class="sidebar-item" id="liTor"><a href="<?php echo base_url('TorLista/'); ?>" class="sidebar-link"><i class="mdi mdi-square-inc-cash"></i><span class="hide-menu"> Financeiro</br>Tipo Faturamento </span></a></li>
                        <?php if ($this->session->userdata('USU_FlgPodeEditarUsuario') == 1): ?>
                            <li class="sidebar-item" id="liUsuLista"><a href="<?php echo base_url('ListaUsuario/'); ?>" class="sidebar-link"><i class="mdi mdi-account-network"></i><span class="hide-menu"> Geral</br>Cadastro Usuário </span></a></li>
                        <?php endif; ?>                        
                    </ul>
                </li>


            </ul>
        </nav>
    </div>
</aside>