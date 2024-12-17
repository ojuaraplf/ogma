<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
$route['home'] = 'home';
$route['listaProjeto'] = 'listaProjeto';
$route['editarProjeto'] = 'editarProjeto';
$route['editarProjeto/(:num)'] = 'editarProjeto/index/$1';
$route['editarProjeto/downloadFile/(:num)'] = "editarProjeto/downloadFile/$1";

$route['imprimirProjeto'] = 'imprimirProjeto';
$route['detalheProjeto'] = 'detalheProjeto';
$route['detalheProjeto/(:num)'] = 'detalheProjeto/index/$1';
$route['editarFase'] = 'editarFase';
$route['editarFase/(:num)/(:num)'] = 'editarFase/index/$1/$1';
$route['apontarDespesaProjeto'] = 'apontarDespesaProjeto';
$route['defaults'] = 'defaults';

$route['mapeamento'] = 'mapeamento/mapeamento';
$route['listaObjeto'] = 'mapeamento/listaObjeto';



$route['apontarHoras'] = 'consultoria/apontarHoras';
$route['relatorioApontamentoHoras'] = 'consultoria/relatorioApontamentoHoras';
$route['relatorioAtividadesPendentes'] = 'consultoria/relatorioAtividadesPendentes';
$route['revisaoMonitoramento'] = 'consultoria/revisaoMonitoramento';


//parceiro
$route['parceiro'] = 'administrativo/parceiro';
$route['parceiro/(:num)'] = 'administrativo/parceiro/$1';
$route['exportarvhsys'] = 'administrativo/exportarvhsys';
$route['listaPessoa'] = 'administrativo/listaPessoa';
$route['detalhePessoa/(:num)'] = 'detalhePessoa/index/$1';


//Colaborador
$route['listaColaborador'] = 'administrativo/colaborador/listaColaborador';
$route['colaborador/(:num)'] = 'administrativo/colaborador/colaborador/$1';
$route['novoColaborador'] = 'administrativo/colaborador/novoColaborador';
$route['colaborador/(:num)/updateColaborador'] = 'administrativo/colaborador/updateColaborador/$1';

//Relatório Colaborador
$route['colaborador/relatorio/relatorioFechaMes'] = 'administrativo/relatorio/relatorioFechaMes';

//Pessoa cadastro
$route['pessoa'] = 'administrativo/PesLista';
$route['PesEdita/(:num)'] = 'administrativo/PesLista/singlePesEdita/$1';
$route['PesEdita/(:num)/updatePesEdita'] = 'administrativo/PesLista/updatePesEdita/$1';
$route['PesNovo/salvarPesNovo'] = 'administrativo/PesLista/salvarPesNovo';
$route['PesNovo'] = 'administrativo/PesLista/singlePesNovo';


//Comercial
$route['CliLista'] = 'comercial/CliLista/CliLista';
$route['CliEdita/(:num)'] = 'comercial/CliLista/CliEdita/$1';
$route['CliNovo'] = 'comercial/CliLista/CliNovo';

//Chamado
$route['detalheChamado/downloadFile/(:num)'] = "chamado/detalheChamado/downloadFile/$1";
// $route['listaChamado'] = 'chamado/listaChamado';
$route['listaChamado'] = 'chamado/ChdLista/ChdLista';
$route['detalheChamado/(:num)'] = 'chamado/detalheChamado/index/$1';

//Configuração
$route['ListaStatusChamado'] = 'configuracao/StcLista';
$route['EditaStatusChamado/(:num)'] = 'configuracao/StcLista/StcEdita/$1';
$route['ListaStatusProjeto'] = 'configuracao/StpLista';
$route['EditaStatusProjeto/(:num)'] = 'configuracao/StpLista/StpEdita/$1';

$route['ListaUsuario'] = 'configuracao/UsuLista/UsuLista';
$route['EditaUsuario/(:num)'] = 'configuracao/UsuLista/UsuEdita/$1';
$route['NovoUsuario'] = 'configuracao/UsuLista/UsuNovo';

//Gestão de Projetos
$route['GpoRelStEco'] = 'gestaoprojeto/GpoLista/GpoRelStEco';
$route['ListaDisponibilidade'] = 'gestaoprojeto/DicLista/DicLista';
$route['ListaGestaoRecursos'] = 'gestaoprojeto/DigLista/DigLista';
$route['ListaCeckPpd'] = 'gestaoprojeto/RelatorioPjtCheckPointPpd/RelatorioPjtCheckPointPpd';
$route['ListaCeckChamado'] = 'gestaoprojeto/RelatoriopjtCheckChamados01/RelatoriopjtCheckChamados01';
$route['GpoRelStAva'] = 'gestaoprojeto/GpoLista/GpoRelStAva';
$route['GpoOquefaz'] = 'gestaoprojeto/GpoLista/GpoOquefaz';
$route['AtgCroEdita'] = 'gestaoprojeto/GpoLista/AtgCroEdita';

//Financeiro
$route['glosaApontamento'] = 'financeiro/glosaApontamento';
$route['fechamentoFinanceiro'] = 'financeiro/fechamentoFinanceiro';
$route['FapLista'] = 'financeiro/FapLista/FapLista';

$route['emailFaturamento'] = 'financeiro/EmailFaturamento/listaColaborador';

// $route['FapGera/(:num)'] = 'financeiro/FapLista/FapGera/$1';
$route['FapGera'] = 'financeiro/FapLista/FapGera';
$route['FapVisual'] = 'financeiro/FapLista/FapVisual';