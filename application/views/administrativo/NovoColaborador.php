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
                        <h4 class="card-title">Novo colaborador</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('listaColaborador/'); ?>">Lista de colaboradores</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Novo colaborador</li>
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
                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label">Colaborador</label>
                                        <select class="form-control" id="selectCBR_PESCodigo">
                                            <option> Selecione uma pessoa... </option>
                                            <?php foreach ($ogma_PES_Selecao01 as $item): ?>
                                            <option value="<?= $item['CODIGO']; ?>">
                                                <?= $item['PESSOA']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label">Unidade Remuneração</label>
                                        <select class="form-control" id="selectCBR_CBUCodigo">
                                            <option> Selecione uma unidade de remuneração... </option>
                                            <?php foreach ($ogrh_CBU_RemuneraUnidade as $item): ?>
                                            <option value="<?= $item['CODIGO']; ?>">
                                                <?= $item['UNIDADE']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label">Valor</label>
                                        <input type="text" class="form-control" id="inputTextCBR_RemuneraValor" />

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label">Cargo</label>
                                        <select class="form-control" id="selectCBR_CGOcodigo">
                                            <option> Selecione o cargo... </option>
                                            <?php foreach ($ogrh_CGO_DescricaoCargo as $item): ?>
                                            <option value="<?= $item['CGO_Codigo']; ?>">
                                                <?= $item['CGO_Titulo']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label ">Empresa</label>
                                        <select class="form-control" id="selectCBR_PESempCodigo">
                                            <option> Selecione o empresa do colaborador... </option>
                                            <?php foreach ($ogma_PES_Pessoa as $item): ?>
                                            <option value="<?= $item['PES_Codigo']; ?>">
                                                <?= $item['PES_Nome'] . ' (' . $item['PES_Codigo'] . ')'; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <div class="border-top"></div>
                                <br />
                                <button class="btn btn-primary" id="btnSalvar"> Salvar</button>


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

        $('#selectCBR_PESempCodigo').select2();

        $('#liAdministracao').addClass('selected');
        $('#liColaborador').addClass('active');
        $('#ulAdministrativo').addClass('in');

        $('#btnSalvar').click(function() {
            if ($('#selectCBR_CBUCodigo')[0].selectedIndex == 0 ||
                $('#selectCBR_PESCodigo')[0].selectedIndex == 0 ||
                $('#selectCBR_PESempCodigo')[0].selectedIndex == 0 ||
                $('#selectCBR_CGOcodigo')[0].selectedIndex == 0) {
                Swal.fire(
                    'Aviso',
                    'Necessário preencher todos os campos para adicionar novo colaborador',
                    'warning'
                )
                return;
            }
            loadBlurSpinner();
            $.when(salvarColaborador()).done(function(r1) {
                Swal.fire(
                    'Colaborador salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                    window.open('<?php echo base_url("colaborador/"); ?>' + $("#selectCBR_PESCodigo").val(), '_self');
                });
            });
        });

        function salvarColaborador() {
            var CBR_RemuneraValor = $('#inputTextCBR_RemuneraValor').val() == "" ? "0" : $('#inputTextCBR_RemuneraValor').val();
            var CBR_CBUCodigo = $('#selectCBR_CBUCodigo').val();
            var CBR_PESCodigo = $('#selectCBR_PESCodigo').val();
            var CBR_USULogin = "<?= $this->session->userdata('userLogin'); ?>";
            var CBR_PESempCodigo = $('#selectCBR_PESempCodigo').val();
            var CBR_CGOcodigo = $('#selectCBR_CGOcodigo').val();

            return $.ajax({
                url: "<?php echo base_url(); ?>administrativo/colaborador/salvarColaborador",
                type: 'POST',
                data: {
                    CBR_PESCodigo: CBR_PESCodigo,
                    CBR_CBUCodigo: CBR_CBUCodigo,
                    CBR_RemuneraValor: CBR_RemuneraValor,
                    CBR_PESempCodigo: CBR_PESempCodigo,
                    CBR_CGOcodigo: CBR_CGOcodigo,
                    CBR_USULogin: CBR_USULogin
                }
            });
        }
    </script>

</body>

</html> 