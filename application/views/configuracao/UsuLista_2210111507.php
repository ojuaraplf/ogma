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
    <title>wD Ogma Usuários </title>

    <?php $this->load->view('include/headerTop') ?>
    <style>
        #tableLista tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-account-network"></i> Lista de Usuários </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"> Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista de Usuários</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoUsuario"> <i class="mdi mdi-plus-circle-outline"></i> </button>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                    </div>
                                    <div class="col-2">
                                        <label for="optionboxAtivo" class="text-left control-label col-form-label" id="labelPES_TipoFouJ" >Usuários ativos:</label>
                                        <select class="form-control" id="optionboxAtivo">
                                            <option value='2'> Apenas ativos </option>                                            
                                            <option value='1'> Apenas inativos </option>
                                            <option value='0'> Todos </option>
                                        </select>
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divLista">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
                                        <input type="text" class="form-control" id="inputTextFiltro"/>
                                    </div>
                                </div>

                                <div class="table-responsive">         
                                    <table id="tableLista" class="table table-hover table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th id='col01nome'> Nome do usuário</th>
                                                <th id='col02codi'> Código </th>
                                                <th id='col03logi'> Login</th>                                                
                                                <th id='col06Ppes'> <i class="mdi mdi-account"></i> </th>
                                                <th id='col07Pcbr'> <i class="mdi mdi-account-convert"></i> </th>
                                                <th id='col08Pusu'> <i class="mdi mdi-account-network"></i> </th>
                                                <th id='col09Pgpo'> <i class="mdi mdi-math-compass"></i> </th>
                                                <th id='col00Pfap'> <i class="mdi mdi-coin"></i> </th>
                                                <th id='col04Pogm'> <i class="mdi mdi-star"></i> </th>
                                                <th id='col05Psir'> <i class="mdi mdi-star-outline"></i> </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.30 - 13/06/2021</b><br/>
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
       
        $('#liConfiguracao').addClass('selected');
		$('#liUsuLista').addClass('active');
		$('#ulConfiguracao').addClass('in');

        $('#divLista').hide();

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableLista");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td") ; 
				for(j=0 ; j<td.length ; j++)
				{
				let tdata = td[j] ;
				if (tdata) {
					if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
					break ; 
					} else {
					tr[i].style.display = "none";
					}
				} 
				}
			}
		}

        var $rows = $('#tableLista tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});

        var arrayLista = [];
        var table = $('#tableLista').DataTable();
        var optionboxAtivo = null;
        var vUSUCodigo = null;


        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAlertaAtivo = 'Selecione para listar chamados ativos, inativos ou todos.';
        var vAlert01nome = 'Coluna do nome do usuário.';
        var vAlert02codi = 'Coluna do código do usuário.';
        var vAlert03logi = 'Coluna do login do usuário.';
        var vAlert04Pogm = 'Usuário pode acessar o OGMA.';
        var vAlert05Psir = 'Usuário pode acessar o SIRIUS.';
        var vAlert06Ppes = 'Usuário pode acessar e editar o Cadastro de Pessoas.';
        var vAlert07Pcbr = 'Usuário pode acessar e editar o Cadastro de Colaboradores.';
        var vAlert00Pfap = 'Usuário pode acessar e pré-faturar apontamentos no financeiro.';        
        var vAlert08Pusu = 'Usuário pode acessar e editar o Cadastro de Usuários.';
        var vAlert09Pgpo = 'Usuário pode acessar Seção de Gerência de Projetos.';

        setInputTextHints();

        $('#btnNovoUsuario').click(function() {
            window.open('<?php echo base_url('NovoUsuario/') ?>', '_self');  
        });
        
        $('#optionboxAtivo').change(function() {
            listarUsu();
        });
        
        listarUsu();

        function listarUsu() {

            optionboxAtivo = ($('#optionboxAtivo')[0].selectedIndex == 0) ? 0 : $('#optionboxAtivo').val();
            vUSUCodigo = 0;

            loadSpinner();
            $('#tableLista').DataTable().clear().destroy();
            table = $('#tableLista').DataTable({
                // dom: 'Bfrtip',
                dom: '<"html5buttons"B>Tfgitp',
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
                    url: "<?php echo base_url(); ?>configuracao/UsuLista/fetchUsuLista",
                    type: 'POST',
                    data: {
                        vUSUCodigo: vUSUCodigo,
                        optionboxAtivo: optionboxAtivo
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        // console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                // "scrollX": true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [0, "asc"]
                ],
                rowId: 'CODIGO',
                columns: [
                    {
                        "data": "NOME",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "CODIGO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "USU_Login",
                        "defaultContent": "",
                        className: "text-left"
                    },                    
                    {
                        "data": "USU_FlgPodeEditarPessoa",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-account"></i>' : '';
                        }
                    },
                    {
                        "data": "USU_FlgPodeEditarColaborador",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-account-convert"></i>' : '';
                        }
                    },
                    {
                        "data": "USU_FlgPodeEditarUsuario",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-account-network"></i>' : '';
                        }
                    },
                    {
                        "data": "USU_FlgPodeAcessarGestaoPlanos",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-math-compass"></i>' : '';
                        }
                    },
                    {
                        "data": "USU_FlgPodePreFaturar",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-coin"></i>' : '';
                        }
                    },
                    {
                        "data": "USU_FlgPodeAcessarOgma",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-star"></i>' : '';
                        }
                    },
                    {
                        "data": "USU_FlgPodeAcessarSirius",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-star-outline"></i>' : '';
                        }
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                columnDefs: [                   
                    {
                        "width": "30%",
                        "targets": [0]
                    },
                    {
                        "width": "2%",
                        "targets": [1]
                    },
                    {
                        "width": "10%",
                        "targets": [2]
                    },
                    {
                        "width": "1%",
                        "targets": [3]
                    },
                    {
                        "width": "1%",
                        "targets": [4]
                    },
                    {
                        "width": "1%",
                        "targets": [5]
                    },
                    {
                        "width": "1%",
                        "targets": [6]
                    },
                    {
                        "width": "1%",
                        "targets": [7]
                    },
                    {
                        "width": "1%",
                        "targets": [8]
                    },
                    {
                        "width": "1%",
                        "targets": [9]
                    }

               ],

            });
        };
    
        // /***************************************************************************************/

        function setInputTextHints() {

            $('#btnNovoUsuario').prop('title', 'Criar novo Usuário.' );

            $('#optionboxAtivo').prop('title', vAlertaAtivo );  
            $('#col01nome').prop('title', vAlert01nome );  
            $('#col02codi').prop('title', vAlert02codi );  
            $('#col03logi').prop('title', vAlert03logi );  
            $('#col04Pogm').prop('title', vAlert04Pogm );  
            $('#col05Psir').prop('title', vAlert05Psir );  
            $('#col06Ppes').prop('title', vAlert06Ppes );  
            $('#col07Pcbr').prop('title', vAlert07Pcbr );            
            $('#col00Pfap').prop('title', vAlert00Pfap );            
            $('#col08Pusu').prop('title', vAlert08Pusu );
            $('#col09Pgpo').prop('title', vAlert09Pgpo );

            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

        var selectedUsuario = "";
        $(document).on('click', '#tableLista > tbody > tr ', function() {
          selectedUsuario = arrayLista[table.row(this).index()];
          window.open('<?php echo base_url('EditaUsuario/') ?>' + selectedUsuario.CODIGO, '_self');
        });

    </script>
</body>

</html> 