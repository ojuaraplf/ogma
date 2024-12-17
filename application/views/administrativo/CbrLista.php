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
    <title>wD Ogma Colaboradores </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        #tableCbr tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-account-convert"></i> Lista de Colaboradores </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"> Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Lista de Colaboradores</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoCbr"> <i class="mdi mdi-plus-circle-outline"></i> </button>
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
                                        <label for="optionboxAtivo" class="text-left control-label col-form-label" id="labelPES_TipoFouJ" >Colaboradores ativos:</label>
                                        <select class="form-control" id="optionboxAtivo">                                            
                                            <option value='0'> Apenas Ativos </option>
                                            <option value='1'> Todos </option>
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
                                    <table id="tableCbr" class="table table-hover table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th id='coCbrNome'> Nome do Colaborador</th>
                                                <th id='coCbrCodi'> Código</th>
                                                <th id='coCbrEmal'> E-mail</th>
                                                <th id='coCbrCarg'> Cargo</th>
                                                <th id='coCbrRecb'> Recebimento</th>
                                                <th id='coCbrIntv'> <i class="mdi mdi-account-off" style="color: #FF0000"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.50 - 31/07/2022</b><br/>
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
       
        $('#liAdministracao').addClass('selected');
		$('#liColaborador').addClass('active');
		$('#ulAdministrativo').addClass('in');

        $('#divLista').hide();

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableCbr");
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

        var $rows = $('#tableCbr tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});

        var arrayLista = [];
        var table = $('#tableCbr').DataTable();
        var optionboxAtivo = null;

        setInputTextHints();
        $('#btnNovoCbr').click(function() {
            window.open('<?php echo base_url('CbrNovo/') ?>', '_self');  
        });
        
        $('#optionboxAtivo').change(function() {
            listarCbr();
        });
        
        listarCbr();

        function listarCbr() {

            pMostraTudo = $('#optionboxAtivo').val();
            pCBRCodigo = 0;

            loadSpinner();
            $('#tableCbr').DataTable().clear().destroy();
            table = $('#tableCbr').DataTable({
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
                    url: "<?php echo base_url(); ?>administrativo/CbrLista/fetchCbr",
                    type: 'POST',
                    data: {                    
                        pMostraTudo: pMostraTudo,
                        pCBRCodigo: pCBRCodigo
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
                        "data": "COLABORADOR",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "CODIGO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "EMAIL",
                        "defaultContent": "",
                        className: "text-left"
                    },                    
                    {
                        "data": "CARGO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "PERIODICIDADE",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "INATIVO",
                        "defaultContent": "",
                        className: "text-center",
                        render: function(data, type) {
                            return data == 1 ? '<i class="mdi mdi-account-off" style="color: #FF0000"></i>' : '';
                        }
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                columnDefs: [                   
                    {
                        "width": "50%",
                        "targets": [0]
                    },
                    {
                        "width": "2%",
                        "targets": [1]
                    },
                    {
                        "width": "20%",
                        "targets": [2]
                    },
                    {
                        "width": "20%",
                        "targets": [3]
                    },
                    {
                        "width": "10%",
                        "targets": [4]
                    }
               ],

            });
        };
    
        // /***************************************************************************************/

        function setInputTextHints() {

            $('#btnNovoCbr').prop('title', 'Criar novo Colaborador.' );
            $('#optionboxAtivo').prop('title', 'Opte por listar apenas:\ncolaboradores ativos\nou todos.' );

            $('#coCbrNome').prop('title', 'Nome do Colaborador.');
            $('#coCbrCodi').prop('title', 'Código (Id) do Colaborador.');
            $('#coCbrEmal').prop('title', 'E-mail do Colaborador.');
            $('#coCbrCarg').prop('title', 'Cargo do Colaborador.');
            $('#coCbrRecb').prop('title', 'Forma de recebimento do Colaborador.\nPeriodicidade de recebimento.' );
            $('#coCbrIntv').prop('title', 'Colaborador inativo.\nColaborador inativo quando ícone na linha' );
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

        var selectedCbr = "";
        $(document).on('click', '#tableCbr > tbody > tr ', function() {
          selectedCbr = arrayLista[table.row(this).index()];
          window.open('<?php echo base_url('CbrEdita/') ?>' + selectedCbr.CODIGO, '_self');
        });

    </script>
</body>

</html> 