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

        .rowCBR {
            cursor: pointer;
        }
  </style>

</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navbarColaborador') ?>
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
                                <table id="tableColaborador" class="table table-hover table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;"> Código </th>
                                            <th style="width: 70%;"> Nome colaborador </th>
                                            <th style="width: 20%;"> E-mail </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listaColaborador as $item): ?>
                                        <tr class="rowCBR" id="<?php echo $item['CODIGO']; ?>">
                                            <td> <?php echo $item['CODIGO']; ?> </td>
                                            <td> <?php echo $item['COLABORADOR']; ?> </td>
                                            <td> <?php echo $item['EMAIL']; ?> </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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

        $('#liAdministracao').addClass('selected');
        $('#liColaborador').addClass('active');
        $('#ulAdministrativo').addClass('in');

        $(document).on('click', '#tableColaborador > tbody > tr ', function() {
            window.open('<?php echo base_url("colaborador/") ?>' + $(this).attr("id"), '_self');
        });
        $('#tableColaborador').DataTable({
            "destroy": true,
            "searching": false,
            "autoWidth": false,
            "retrieve": true,
            "paging": false,
            "sAjaxDataProp": "",
            "responsive": true,
            "info": false,
            "order": [1, "asc"]

        });
    </script>

</body>

</html> 