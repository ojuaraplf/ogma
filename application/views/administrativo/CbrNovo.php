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
                        <h4 class="card-title"><i class="mdi mdi-account-convert"></i> Novo colaborador</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('CbrLista/'); ?>">Lista de colaboradores</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Novo colaborador</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="buttonNovaPessoaColaborador"> <i class="mdi mdi-account-plus"></i> </button>
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar" disabled> <i class="mdi mdi-content-save"></i> </button>
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
                                            <option value='0'> Selecione uma pessoa... </option>
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
                                            <option value='0'> Selecione uma unidade de remuneração... </option>
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
                                        <label for="" class="text-left control-label col-form-label">Empresa</label>
                                        <button class="btn float-right" style="font-size: 12px; color: #00FF00; background-color: #000000;" id="buttonNovaPessoaEmpresa"> <i class="mdi mdi-account-plus"></i> </button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalQuickPesColaborador') ?>
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>    

    <script type="text/javascript">
        removeSpinner();
        setInputTextHints();

        $('#selectCBR_PESempCodigo').select2();

        $('#liAdministracao').addClass('selected');
        $('#liColaborador').addClass('active');
        $('#ulAdministrativo').addClass('in');

        $('#selectCBR_PESCodigo').change(function() {
            console.log("console.log($(selectCBR_PESCodigo).val());");
            console.log($("#selectCBR_PESCodigo").val());
            document.getElementById("btnSalvar").disabled = $("#selectCBR_PESCodigo").val() != '0' ? false : true;
        });

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
                    // location.reload();
                    // window.open('<!?php echo base_url("CbrEdita/"); ?>' + $("#selectCBR_PESCodigo").val(), '_self');
                    window.open('<?php echo base_url("CbrLista/"); ?>', '_self');
                });
            });
        });
        
        var vNovoEmpre = 0;

        function PopulaCBR_PESempCodigo() {
            // console.log("KK");
            $.ajax({
                url: "<?php echo base_url(); ?>administrativo/CbrLista/fetchPessEmpr/",
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response);
                    var optionsPessoaEmpre = [];
                    optionsPessoaEmpre.push('<option value="0"> Selecione o empresa do colaborador... </option>');
                    response.forEach(function(e) {
                        optionsPessoaEmpre.push('<option value="' + e.PES_Codigo + '"> ' + e.PES_Nome + ' </option>')
                    });
                    
                    console.log(optionsPessoaEmpre);
                    $('#selectCBR_PESempCodigo').html(optionsPessoaEmpre);
                    $("#selectCBR_PESempCodigo").val(vNovoEmpre);
                    // console.log(response);
                }
            });
        }
        
        function salvarColaborador() {
            
            return $.ajax({
                url: "<?php echo base_url(); ?>administrativo/CbrLista/InsertCbrAll",
                type: 'POST',
                data: {
                    CBR_PESCodigo: $('#selectCBR_PESCodigo').val(),
                    CBR_CBUCodigo: $('#selectCBR_CBUCodigo').val(),
                    CBR_RemuneraValor: $('#inputTextCBR_RemuneraValor').val() == "" ? "0" : $('#inputTextCBR_RemuneraValor').val(),
                    CBR_PESempCodigo: $('#selectCBR_PESempCodigo').val(),
                    CBR_CGOcodigo: $('#selectCBR_CGOcodigo').val(),
                    CBR_USULogin: "<?= $this->session->userdata('userLogin'); ?>"
                }
            });
        }

        $('#buttonNovaPessoaColaborador').click(function() {
            $('#modalQuickPesColaborador').modal('show');
        });

        $('#buttonNovaPessoaEmpresa').click(function() {
            $('#modalQuickPesColabEmpresa').modal('show');
        });
        
        function setInputTextHints() {
            
            $('#buttonNovaPessoaColaborador').prop('title', 'Quick Insert de Pessoa:\nClique para incluir rapidamente uma nova pessoa,\ncomo Pessoa e como Colaboradora, ao mesmo tempo.\nTenha certeza de que ela já não exista na lista de Pessoas.');
            $('#buttonNovaPessoaEmpresa').prop('title', 'Clique para incluir rapidamente uma nova pessoa,\ncomo Pessoa e como Empresa do Claborador, ao mesmo tempo.\nTenha certeza de que ela já não exista na lista de Pessoas.');
            
            $('#selectCBR_PESCodigo').prop('title', 'Selecione uma pessoa para Colaborador.\nNo combo estão as pessoas que ainda não são Colaboradoras.\nPara incluir nova pessoa como Colaboradora, clique em "incluir nova Pessoa/Colaboradora".');
            $('#selectCBR_CBUCodigo').prop('title', 'Selecione a Unidade de Remuneração para o Colaborador.');
            $('#inputTextCBR_RemuneraValor').prop('title', 'Informe o calor da remuneração do Colaborador, pela Unidade selecionada.');
            $('#selectCBR_CGOcodigo').prop('title', 'Selecione o Cargo do Colaborador.');
            $('#selectCBR_PESempCodigo').prop('title', 'Selecione a Empresa (PJ) do Colaborador.');
                                    
            $('#btnSalvar').prop('title', 'Clique para adicionar (salvar) os dados do novo Colaborador.');
            
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