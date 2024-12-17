<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Default and Error Routes
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

// Home Route
$route['home'] = 'home';

// Projeto Routes
$route['listaProjeto'] = 'listaProjeto';
$route['editarProjeto'] = 'editarProjeto';
$route['editarProjeto/(:num)'] = 'editarProjeto/index/$1';
$route['editarProjeto/downloadFile/(:num)'] = "editarProjeto/downloadFile/$1";
$route['imprimirProjeto'] = 'imprimirProjeto';
$route['detalheProjeto'] = 'detalheProjeto';
$route['detalheProjeto/(:num)'] = 'detalheProjeto/index/$1';
$route['editarFase'] = 'editarFase';
$route['editarFase/(:num)/(:num)'] = 'editarFase/index/$1/$2';
$route['apontarDespesaProjeto'] = 'apontarDespesaProjeto';

// Mapeamento Routes
$route['mapeamento'] = 'mapeamento/mapeamento';
$route['listaObjeto'] = 'mapeamento/listaObjeto';

// Consultoria Routes
$route['apontarHoras'] = 'consultoria/apontarHoras';
$route['relatorioApontamentoHoras'] = 'consultoria/relatorioApontamentoHoras';
$route['relatorioAtividadesPendentes'] = 'consultoria/relatorioAtividadesPendentes';
$route['revisaoMonitoramento'] = 'consultoria/revisaoMonitoramento';

// Parceiro Routes
$route['parceiro'] = 'administrativo/parceiro';
$route['parceiro/(:num)'] = 'administrativo/parceiro/$1';
$route['exportarvhsys'] = 'administrativo/exportarvhsys';
$route['listaPessoa'] = 'administrativo/listaPessoa';
$route['detalhePessoa/(:num)'] = 'detalhePessoa/index/$1';

// Colaborador Routes
$route['CbrLista'] = 'administrativo/CbrLista/CbrLista';
$route['CbrNovo'] = 'administrativo/CbrLista/CbrNovo';
$route['CbrEdita/(:num)'] = 'administrativo/CbrLista/CbrEdita/$1';
$route['CbrFechaMes'] = 'administrativo/CbrLista/CbrFechaMes';
$route['CgoLista'] = 'administrativo/CgoLista/CgoLista';
$route['CgoEdita/(:num)'] = 'administrativo/CgoLista/CgoEdita/$1';
$route['CgoNovo'] = 'administrativo/CgoLista/CgoNovo';
$route['colaborador/(:num)/updateColaborador'] = 'administrativo/colaborador/updateColaborador/$1';
$route['colaborador/relatorio/relatorioFechaMes'] = 'administrativo/relatorio/relatorioFechaMes';

// Pessoa Cadastro Routes
$route['pessoa'] = 'administrativo/PesLista';
$route['PesEdita/(:num)'] = 'administrativo/PesLista/singlePesEdita/$1';
$route['PesEdita/(:num)/updatePesEdita'] = 'administrativo/PesLista/updatePesEdita/$1';
$route['PesNovo'] = 'administrativo/PesLista/singlePesNovo';
$route['PesNovo/salvarPesNovo'] = 'administrativo/PesLista/salvarPesNovo';

// Comercial Routes
$route['CliLista'] = 'comercial/CliLista/CliLista';
$route['CliEdita/(:num)'] = 'comercial/CliLista/CliEdita/$1';
$route['CliNovo'] = 'comercial/CliLista/CliNovo';

// Chamado Routes
$route['listaChamado'] = 'chamado/ChdLista/ChdLista';
$route['detalheChamado/(:num)'] = 'chamado/detalheChamado/index/$1';
$route['detalheChamado/downloadFile/(:num)'] = "chamado/detalheChamado/downloadFile/$1";

// Configuração Routes
$route['ListaStatusChamado'] = 'configuracao/StcLista';
$route['EditaStatusChamado/(:num)'] = 'configuracao/StcLista/StcEdita/$1';
$route['ListaStatusContrato'] = 'contrato/SttLista';
$route['EditaStatusContrato/(:num)'] = 'contrato/sttLista/SttEdita/$1';
$route['CriaStatusContrato'] = 'contrato/SttLista/SttCria';
$route['ListaUnidadeContrato'] = 'contrato/UpcLista';
$route['EditaUnidadeContrato/(:num)'] = 'contrato/UpcLista/UpcEdita/$1';
$route['CriaUnidadeContrato'] = 'contrato/UpcLista/UpcCria';
$route['ListaTipoContrato'] = 'contrato/TctLista';
$route['EditaTipoContrato/(:num)'] = 'contrato/TctLista/TctEdita/$1';
$route['CriaTipoContrato'] = 'contrato/TctLista/TctCria';
$route['ListaStatusProjeto'] = 'configuracao/StpLista';
$route['EditaStatusProjeto/(:num)'] = 'configuracao/StpLista/StpEdita/$1';
$route['CasLista'] = 'configuracao/CasLista/CasLista';
$route['CasEdita/(:num)'] = 'configuracao/CasLista/CasEdita/$1';
$route['TorLista'] = 'configuracao/TorLista/TorLista';
$route['TorNovo'] = 'configuracao/TorLista/TorNovo';
$route['TorEdita/(:num)'] = 'configuracao/TorLista/TorEdita/$1';
$route['EditaSvc'] = 'configuracao/ConfServEdita/SvcEdita';
$route['ListaUsuario'] = 'configuracao/UsuLista/UsuLista';
$route['EditaUsuario/(:num)'] = 'configuracao/UsuLista/UsuEdita/$1';
$route['NovoUsuario'] = 'configuracao/UsuLista/UsuNovo';

// Gestão de Projetos Routes
$route['GpoRelStEco'] = 'gestaoprojeto/GpoLista/GpoRelStEco';
$route['ListaDisponibilidade'] = 'gestaoprojeto/DicLista/DicLista';
$route['ListaGestaoRecursos'] = 'gestaoprojeto/DigLista/DigLista';
$route['ListaCeckPpd'] = 'gestaoprojeto/RelatorioPjtCheckPointPpd/RelatorioPjtCheckPointPpd';
$route['ListaCeckChamado'] = 'gestaoprojeto/RelatoriopjtCheckChamados01/RelatoriopjtCheckChamados01';
$route['GpoRelStAva'] = 'gestaoprojeto/GpoLista/GpoRelStAva';
$route['GpoOquefaz'] = 'gestaoprojeto/GpoLista/GpoOquefaz';
$route['AtgCroEdita'] = 'gestaoprojeto/GpoLista/AtgCroEdita';
$route['Expercha'] = 'gestaoprojeto/GpoLista/Expercha';
$route['Expeproj'] = 'gestaoprojeto/GpoLista/Expeproj';
$route['RelApp'] = 'gestaoprojeto/GpoLista/RelApp';

// Financeiro Routes
$route['glosaApontamento'] = 'financeiro/glosaApontamento';
$route['fechamentoFinanceiro'] = 'financeiro/fechamentoFinanceiro';
$route['FapPreFaturar'] = 'financeiro/FapLista/FapPreFaturar';
$route['FapCriar'] = 'financeiro/FapLista/FapCriar';
$route['FapVisual'] = 'financeiro/FapLista/FapVisual';
$route['emailFaturamento'] = 'financeiro/EmailFaturamento/listaColaborador';
$route['FapRelExtrFaturamento'] = 'financeiro/FapLista/FapRelExtrFatur';
$route['FmcPrePagar'] = 'financeiro/FmcLista/FmcPrePagar';
$route['FmcCriar'] = 'financeiro/FmcLista/FmcCriar';
$route['FmcFechar'] = 'financeiro/FmcLista/FmcFechar';
$route['FmcFolha'] = 'financeiro/FmcLista/FmcFolha';
$route['ListaCondicaoFaturamento'] = 'financeiro/CfcLista';
$route['EditaCondicaoFaturamento/(:num)'] = 'financeiro/CfcLista/CfcEdita/$1';
$route['CriaCondicaoFaturamento'] = 'financeiro/CfcLista/CfcCria';
$route['ListaCondicaoPagamento'] = 'financeiro/CpgLista';
$route['EditaCondicaoPagamento/(:num)'] = 'financeiro/CpgLista/CpgEdita/$1';
$route['CriaCondicaoPagamento'] = 'financeiro/CpgLista/CpgCria';

// Perfil Routes
$route['perfil/trocarSenha'] = 'perfil/Perfil/trocarSenha';

// Notificações Routes
$route['notificacao/lista'] = 'configuracao/Notificacao/lista';
$route['notificacao/adicionar'] = 'configuracao/Notificacao/adicionar';
