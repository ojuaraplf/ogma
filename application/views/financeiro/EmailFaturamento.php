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
        html {
            visibility: hidden;
        }
        #thCheckbox[class*="sort"]:after {
            content: "" !important;
        }
        #thCheckbox[class*="sort"]:before {
            content: "" !important;
        }

        table.dataTable.table-sm>thead>tr>th { 
            padding-right: 5px !important; 
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
                        <h4 class="card-title">Lista colaboradores</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Lista colaboradores</li>
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
                                <div class="row">
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label"> Mês </label>
                                        <input type="text" id="inputTextMesAno" value="<?= date('m/Y', strtotime('-1 month')) ?>" class="form-control" />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-primary" id="buttonEnviarTapped"> Enviar </button>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-12">
                                        <table id="tableColaborador" class="table table-hover table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" id="thCheckbox" class="text-center"> <input type="checkbox" id="checkBoxSelectAll" /> </th>
                                                    <th style="width: 50%;"> Nome colaborador </th>
                                                    <th style="width: 20%;"> E-mail </th>
                                                    <th style="width: 10%;"> Último e-mal </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listaColaborador as $item) : ?>
                                                    <tr class="rowCBR" id="<?php echo $item['CODIGO']; ?>">
                                                        <td class="text-center"> <input type="checkbox" /> </td>
                                                        <td> <?php echo $item['COLABORADOR']; ?> </td>
                                                        <td> <?php echo $item['EMAIL']; ?> </td>
                                                        <td> <?php echo $item['CBR_MomUltimoEmailFatEnviado']; ?> </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer text-center">
                    © 2019 wDiscovery Ltda.
                </footer>
            </div>
        </div>
    </div>
    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>


    <script type="text/javascript">
        removeSpinner();

        $('#inputTextMesAno').change(function() {
            loadBlurSpinner()
            $.when(fetchEmployeesInPeriod()).done(function(r1) {
                table.clear().draw();
                $.each(r1, function(index, value) {
                    table.row.add(['<input type="checkbox" />', value.COLABORADOR, value.EMAIL, value.CBR_MomUltimoEmailFatEnviado]).node().id = value.CODIGO;
                    table.draw(false);
                });
                removeSpinner();
            });
        });

        $('#inputTextMesAno').keydown(function() {
            return false
        });

        $('#checkBoxSelectAll').change(function() {
            table.$('input[type="checkbox"]').each(function() {
                $(this).prop('checked', $('#checkBoxSelectAll').is(':checked'));
            });
        });;

        function fetchEmployeesInPeriod() {
            const inputTextDate = $('#inputTextMesAno').val();
            var LCT_DATA = inputTextDate.split('/').reverse().join('-');
            LCT_DATA += '-01';

            return $.ajax({
                url: "<?= base_url(); ?>financeiro/emailFaturamento/fetchEmployeesInPeriod",
                dataType: 'json',
                type: 'POST',
                data: {
                    LCT_DATA: LCT_DATA
                }
            });
        }

        $('#inputTextMesAno').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months"
        });

        var actualDate = new Date();

        var past = actualDate.setMonth(actualDate.getMonth() - 1, 1);

        $('#liAdministracao').addClass('selected');
        $('#liEmailFaturamento').addClass('active');
        $('#ulAdministrativo').addClass('in');

        var selected = [];

        var table = $('#tableColaborador').DataTable({
            destroy: true,
            searching: false,
            autoWidth: false,
            retrieve: true,
            paging: false,
            sAjaxDataProp: "",
            responsive: true,
            info: false,
            columnDefs: [{
                targets: 0,
                orderable: false,
                className: 'text-center'
            }]
        });

        $('#buttonEnviarTapped').click(function() {
            const token = "<?= $this->session->userdata('token') ?>";
            const inputTextDate = $('#inputTextMesAno').val();

            var LCT_Data = inputTextDate.split('/').reverse().join('-');
            LCT_Data += '-01';

            selected = [];
            table.$('input[type="checkbox"]:checked').each(function() {
                selected.push({
                    "CBR_Codigo": $(this).parent().parent().attr('id'),
                    "PES_ContEmail": $(this).parent().parent().children()[3].innerText,
                    "PES_Nome": $(this).parent().parent().children()[2].innerText
                });
            });

            loadBlurSpinner()

            $.ajax({
                url: "<?= apiURL; ?>sendEmailEmployees",
                dataType: 'json',
                type: 'POST',
                data: {
                    LCT_Data: LCT_Data,
                    employees: selected
                },

                beforeSend: function(request) {
                    request.setRequestHeader("Authorization", `Bearer ${token}`);
                },

                success: function() {
                    removeSpinner();
                    Swal.fire('E-mails enviados com sucesso!', '', 'success').then(() => {
                        location.reload();
                    });
                }
            });
        });
    </script>
</body>
</html>