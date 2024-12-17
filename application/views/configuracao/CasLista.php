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
  <title>wD Catálogo de Serviços </title>

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
      <!--<!?php $this->load->view('include/navBarChamado') ?>-->
      <?php $this->load->view('include/asidebar') ?>
      <div class="page-wrapper">

          <div class="page-breadcrumb">
              <div class="row">
                  <div class="col-12 d-flex no-block align-items-center">
                      <h3 class="page-title"> <i class="mdi mdi-format-align-justify"></i> wD Catálogo de Serviços </h3>
                      <div class="ml-auto text-right">
                          <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item active" aria-current="page"> Home</li>
                              </ol>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>

          <div class="card-body">
            <div class="card" style="background-color: #eeeeee;">
                <div class="col-12">
                    <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnNovoCas" disabled > <i class="mdi mdi-plus-circle-outline"></i> </button>
                </div>
            </div>
        </div>

          <div class="card">
              <div class="card-body">
                  <div class="row mb-3">
                      <div class="col-1">
                          <label for="inputCasVersao" class="text-left control-label col-form-label" >Versão:</label>
                          <input type="number" class="form-control" value="<?php echo $CasCabeca->CAS_CODIGO; ?>" id="inputCasVersao" disabled />
                      </div>
                      <div class="col-2">
                          <label for="inputCasEdicao" class="text-left control-label col-form-label" >De:</label>
                          <input type="date" class="form-control" value="<?php echo $CasCabeca->VERSAO; ?>" id="inputCasEdicao" disabled />
                      </div>
                  </div>    
              </div>
          </div>
  
          <div class="row" id="divLista">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                                <div class="table-responsive">         
                                    <table class="table table-hover" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='colTipoServ'> Serviço</th>
                                                <th id='colAcronimo'> Acrônimo</th>
                                                <th id='colCodigoId'> Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão Beta: 00.50 - 15/06/2022</b><br/>
                                </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalNovoChamado') ?>

    <script type="text/javascript">
        removeSpinner();
       
        $('#liConfiguracao').addClass('selected');
		$('#liCas').addClass('active');
		$('#ulConfiguracao').addClass('in');

        $('#divLista').hide();

        var arrayLista = [];
        var table = $('#tableLista').DataTable();

        showTabela();

        setInputTextHints();

        // /***************************************************************************************/

        function showTabela() {

            var CasAtivo = 3;
            var CsiId = null;
            var pAbre = 1;

            console.log(CsiId);
            
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
                    url: "<?php echo base_url(); ?>configuracao/CasLista/fetchCasLista",
                    type: 'POST',
                    data: {
                        CasAtivo: CasAtivo,
                        CsiId: CsiId,
                        pAbre: pAbre
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
                    [1, "asc"]
                ],
                rowId: 'CSI_CODIGO',
                columns: [
                    {
                        "data": "TITULO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "ACRONIMO",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "CSI_CODIGO",
                        "defaultContent": "",
                        className: "text-center"
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
                        "width": "5%",
                        "targets": [1]
                    },
                    {
                        "width": "2%",
                        "targets": [2]
                    }
                ],

            });
        }

        function setInputTextHints() {
            // $('#comboboxPPx').prop('title', vAlertaPjt );

            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

        var selectedCas = "";
        $(document).on('click', '#tableLista > tbody > tr ', function() {
          selectedCas = arrayLista[table.row(this).index()];
          window.open('<?php echo base_url('CasEdita/') ?>' + selectedCas.CSI_CODIGO, '_self');
        });

    </script>
  </body>

</html> 