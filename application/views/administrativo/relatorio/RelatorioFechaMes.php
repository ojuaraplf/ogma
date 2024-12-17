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
    <title>wDiscovery</title>

    <?php $this->load->view('include/headerTop') ?>


    <style>

        #tableApontamentoHoras tbody tr {
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
                        <h4 class="page-title">Relatório Fecha Mês </h4>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label"> Mês </label>
                                        <input type="text" id="inputTextMesAno" class="form-control" />
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label"> Colaborador </label>
                                        <select class="form-control" id="comboboxColaborador">
                                            <option> Selecione Colaborador... </option>

                                            <?php foreach ($listaColaborador as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['COLABORADOR'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="checkbox" id="checkboxpAbreProjeto" checked>
                                        <label class="text-left" for="checkboxpAbreProjeto">Abre projeto</label>

                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="buttonRelatorio"> Relatório</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divRelatorio">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Relatório </h4>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableRelatorio">
                                        <thead>
                                            <tr>
                                                <th class="notexport"> </th>
                                                <th> Colaborador</th>
                                                <th id="thPlanoServiço"> Ultimo dia apontado</th>
                                                <th> UD</th>
                                                <th> Trabalho</th>
                                                <th> Unit. (R$)</th>
                                                <th> Total (R$)</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="buttonSalvarFechaMes"> Salvar Fechamento Mês</button>
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
    <?php $this->load->view('modal/modalRelatorioApontamentoHora') ?>

    <script type="text/javascript">
        removeSpinner();

        $('#liAdministracao').addClass('selected');
        $('#liRelatorioFechaMes').addClass('active');
        $('#ulAdministrativo').addClass('in');

        $('#divRelatorio').hide();

        $('#inputTextMesAno').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months"
        });

        var arrayRelatorio = [];
        var table = $('#tableRelatorio').DataTable();
        var selectedColaborador = null;
        var selectedMes = null;

        $('#buttonSalvarFechaMes').click(function() {
            var arrayRowFechar = [];
            $('#tableRelatorio tbody').find('tr').each(function(i, el) {
                if ($(this).find('td').hasClass('dataTables_empty')) {
                    return;
                }

                var $tds = $(this).find('td');
                var rowId = $(this).attr('id');

                if ($tds.eq(0).find('.dt-checkboxes:input[type="checkbox"]').prop('checked') == false) {
                    return;
                }

                var currentRowObject = arrayRelatorio.find(value => value.ID1 == rowId);
                var pPJTCodigo = parseInt(currentRowObject.PJT);
                var pCBRCodigo = $('#comboboxColaborador').val();
                var date = "01/" + $('#inputTextMesAno').val();
                var PMes = date.split("/").reverse().join("-");
                var pQtHora = $tds.eq(3).text();
                var pVrHora = $tds.eq(6).text();
                var pVrTotal = $tds.eq(5).text();
                var pFlgQuebrado = currentRowObject.QUEBRA;
                var pCBUCodigo = currentRowObject.UD;
                var pUSULogin = "<?php echo $this->session->userdata('userLogin'); ?>";

                arrayRowFechar.push({
                    'pPJTCodigo': pPJTCodigo,
                    'pCBRCodigo': pCBRCodigo,
                    'PMes': PMes,
                    'pFlgQuebrado': pFlgQuebrado,
                    'pCBUCodigo': pCBUCodigo,
                    'pQtHora': pQtHora,
                    'pVrHora': pVrHora,
                    'pVrTotal': pVrTotal,
                    'pUSULogin': pUSULogin

                });
            });
            loadSpinner();

            $.ajax({
                url: "<?php echo base_url(); ?>administrativo/relatorio/saveRelatorioFechaMes",
                type: 'POST',
                data: {
                    arrayRowFechar: arrayRowFechar
                },
                success: function(x) {
                    Swal.fire(
                        'Sucesso',
                        'Fechamento do mês salvo com sucesso!',
                        'success'
                    )

                    removeSpinner()

                },
                error: function(x) {
                    console.log(x);
                }
            });
        });

        $('#buttonRelatorio').click(function() {
            selectedColaborador = $('#comboboxColaborador')[0].selectedIndex == 0 ? null : $('#comboboxColaborador').val();
            if ($('#inputTextMesAno').val() == "") {
                Swal.fire(
                    'Aviso',
                    'Necessário preencher um mês/ano para prosseguir',
                    'warning'
                )
                return;
            }
            var date = "01/" + $('#inputTextMesAno').val();
            selectedMes = date.split("/").reverse().join("-");

            var pAbreProjeto = $('#checkboxpAbreProjeto').is(":checked") ? 1 : 0;



            $('#thPlanoServiço').text(pAbreProjeto ? "Plano de Serviço | Ultimo dia apontado" : "Ultimo dia apontado");




            loadSpinner();
            $('#tableRelatorio').DataTable().clear().destroy();
            table = $('#tableRelatorio').DataTable({
                dom: 'Bfrtip',
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
                    url: "<?php echo base_url(); ?>administrativo/relatorio/fetchRelatorioFechaMes",
                    type: 'POST',
                    data: {
                        selectedColaborador: selectedColaborador,
                        selectedMes: selectedMes,
                        pAbreProjeto: pAbreProjeto

                    },
                    complete: function(response) {
                        arrayRelatorio = JSON.parse(response.responseText);
                        $('#divRelatorio').show();
                    },
                    error: function(x) {
                        console.log(x.responseText);
                    }
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [3, "asc"]
                ],
                rowId: 'ID1',
                columns: [{
                        "data": null,
                        "defaultContent": null,

                    },
                    {
                        "data": "COLABORADOR",
                        "defaultContent": ""
                    },
                    {
                        "data": "PROJETO",
                        "defaultContent": ""
                    },
                    {
                        "data": "UD",
                        "defaultContent": ""
                    },
                    {
                        "data": "TRAB_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VRUN_RS",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VRTO_RS",
                        "defaultContent": "",
                        className: "text-right"
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                select: {
                    'style': 'multi'
                },
                columnDefs: [{
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    },
                    {
                        'orderable': false,
                        'targets': 0
                    },
                    {
                        "width": "5%",
                        "targets": [0, 3, 4, 5, 6],

                    },
                ],
            });
        });
    </script>
</body>

</html> 