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
    <title>wD Tipo Faturamento </title>

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
                        <h4 class="page-title"><i class="mdi mdi-square-inc-cash"></i> Tipo de Faturamento - TOR </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">                                    
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>                                    
                                    <li class="breadcrumb-item active" aria-current="page"> Lista Tipo de Faturamento (TOR)</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoTipo"> <i class="mdi mdi-plus-circle-outline"></i> </button>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row" id="divLista">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='colTorCodi'> Id</th>
                                                <th id='colTorNome'> Denominação</th>
                                                <th id='colTorDesc'> Descrição</th>                                           
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.50 - 13/07/2022</b><br/>
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
		$('#liTor').addClass('active');
	    $('#ulConfiguracao').addClass('in');

        $('#divLista').hide();

        var arrayLista = [];
        var table = $('#tableLista').DataTable();
        var vTOR_Codigo = null;
        var vIncluirDesativa = 0;
        
        showTabela();
        setInputTextHints();
        
        // /***************************************************************************************/

        function showTabela() {

            console.log('vTOR_Codigo');
            console.log(vTOR_Codigo);
            console.log(vIncluirDesativa);
            
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

                ajax: {
                    url: "<?php echo base_url(); ?>configuracao/TorLista/fetchTorLista",
                    type: 'POST',
                    data: {
                        vTOR_Codigo: vTOR_Codigo,
                        vIncluirDesativa: vIncluirDesativa
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        console.log(response);
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
                rowId: 'TOR_Codigo',
                columns: [
                    {
                        "data": "TOR_Codigo",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "TOR_Nome",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "TOR_Descricao",
                        "defaultContent": "",
                        className: "text-left"
                    }                    
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                columnDefs: [
                    {
                        "width": "5%",
                        "targets": [0],
                    },
                    {
                        "width": "35%",
                        "targets": [1],
                    },
                    {
                        "width": "60%",
                        "targets": [2],
                    }
                    
                ],

            });
        }

        function setInputTextHints() {
            $('#colTorCodi').prop('title', 'Código (Id) do Tipo de Faturamento.' );
            $('#colTorNome').prop('title', 'Denominação do Tipo de Faturamento.' );
            $('#colTorDesc').prop('title', 'Descrição do Tipo de Faturamento.' );
            $('#btnNovoTipo').prop('title', 'Criar novo Tipo de Faturamento.' );
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

        $('#btnNovoTipo').click(function() {
            window.open('<?php echo base_url('TorNovo/') ?>', '_self');  
        });
                

        var selectedTor = "";
        $(document).on('click', '#tableLista > tbody > tr ', function() {
          selectedTor = arrayLista[table.row(this).index()];
          window.open('<?php echo base_url('TorEdita/') ?>' + selectedTor.TOR_Codigo, '_self');

        });

    </script>
</body>

</html> 