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
                        <h4 class="card-title">Editar colaborador</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('listaColaborador/'); ?>">Lista de colaboradores</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar colaborador</li>
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
                                        <input type="text" class="form-control" value="<?php echo $colaborador->PES_Nome; ?>" id="inputTextPES_Nome" disabled />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label">E-mail</label>
                                        <input type="text" class="form-control" value="<?php echo $colaborador->PES_ContEmail; ?>" id="inputTextPES_ContEmail"  />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label for="" class="text-left control-label col-form-label">Unidade Remuneração</label>
                                        <select class="form-control" id="selectCBR_CBUCodigo">
                                            <option> Selecione uma unidade de remuneração... </option>
                                            <?php foreach ($ogrh_CBU_RemuneraUnidade as $item): ?>
                                            <option value="<?= $item['CODIGO']; ?>" <?= $colaborador->CBR_CBUCodigo == $item['CODIGO'] ? 'selected' : '' ?>>
                                                <?= $item['UNIDADE']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <label for="" class="text-left control-label col-form-label">Valor (R$)</label>
                                        <input type="text" class="form-control" value="<?= $colaborador->CBR_RemuneraValor ?>"  id="inputTextCBR_RemuneraValor" />
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $colaborador->CBR_FlgRemuneraQuebrado == 1 ? 'checked' : '' ?> id="checkboxCBR_FlgRemuneraQuebrado">
                                        <label class="text-left" for="checkboxCBR_FlgRemuneraQuebrado">Cálculo com divisor</label>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label">Cargo</label>
                                        <select class="form-control" id="selectCBR_CGOcodigo">
                                            <option> Selecione o cargo... </option>
                                            <?php foreach ($ogrh_CGO_DescricaoCargo as $item): ?>
                                            <option value="<?= $item['CGO_Codigo']; ?>" <?= $colaborador->CBR_CGOcodigo == $item['CGO_Codigo'] ? 'selected' : '' ?>>
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
                                            <option value="<?= $item['PES_Codigo']; ?>" <?= $colaborador->CBR_PESempCodigo == $item['PES_Codigo'] ? 'selected' : '' ?>>
                                                <?= $item['PES_Nome'] . ' (' . $item['PES_Codigo'] . ')'; ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>



                                <br />
                                <div class="border-top"></div>
                                <br />
                                <button class="btn btn-primary" id="btnSalvar"> Salvar colaborador</button>
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

        setInputTextHints();

        $('#liAdministracao').addClass('selected');
        $('#liColaborador').addClass('active');
        $('#ulAdministrativo').addClass('in');

        $('#btnSalvar').click(function() {
            if ($('#selectCBR_CBUCodigo')[0].selectedIndex == 0 ||
                $('#selectCBR_PESempCodigo')[0].selectedIndex == 0 ||
                $('#selectCBR_CGOcodigo')[0].selectedIndex == 0) {
                Swal.fire(
                    'Aviso',
                    'Necessário preencher todos os campos para salvar as informações do colaborador',
                    'warning'
                )
                return;
            }
            loadBlurSpinner();
            $.when(updateColaborador()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Colaborador salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });

        function updateColaborador() {
            var CBR_RemuneraValor = $('#inputTextCBR_RemuneraValor').val() == "" ? "0" : $('#inputTextCBR_RemuneraValor').val();
            var CBR_CBUCodigo = $('#selectCBR_CBUCodigo').val();
            var CBR_FlgRemuneraQuebrado = $('#checkboxCBR_FlgRemuneraQuebrado').is(":checked") ? 1 : 0;
            var CBR_USULogin = "<?= $this->session->userdata('userLogin'); ?>";
            var CBR_PESempCodigo = $('#selectCBR_PESempCodigo').val();
            var CBR_CGOcodigo = $('#selectCBR_CGOcodigo').val();
            var PES_ContEmail = $('#inputTextPES_ContEmail').val();

            $.ajax({
                url: "<?php echo base_url(); ?>colaborador/<?= $this->uri->segment(2); ?>/updateColaborador",
                type: 'POST',
                data: {
                    CBR_CBUCodigo: CBR_CBUCodigo,
                    CBR_FlgRemuneraQuebrado: CBR_FlgRemuneraQuebrado,
                    CBR_RemuneraValor: CBR_RemuneraValor,
                    CBR_PESempCodigo: CBR_PESempCodigo,
                    CBR_CGOcodigo: CBR_CGOcodigo,
                    CBR_USULogin: CBR_USULogin,
                    PES_ContEmail: PES_ContEmail
                }
            });
        }


        function setInputTextHints() {
            $('#selectCBR_CBUCodigo').prop('title', 'Selecione a unidade de remuneração do colaborador - a forma de pagamento.');
            $('#inputTextCBR_RemuneraValor').prop('title', 'Informe o valor em R$ da remuneração do colaborador. Valor pago pela unidade de remuneração.');
            $('#checkboxCBR_FlgRemuneraQuebrado').prop('title', 'Marque para que cálculo mensal considere o divisor da unidade de remuneração.');
            $('#selectCBR_CGOcodigo').prop('title', 'Selecione o cargo do colaborador.');
            $('#selectCBR_PESempCodigo').prop('title', 'Selecione a empresa (pessoa jurídica) do colaborador.');
            
            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }  

    
    </script>

</body>

</html> 