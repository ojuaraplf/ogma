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
    <title>wD Ogma Pessoa</title>

    <?php $this->load->view('include/headerTop') ?>
    <style>
        html {
      visibility: hidden;
    }
  </style>

</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navbarPessoa') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
        <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="card-title"><i class="mdi mdi-account"></i> Editar pessoa</h4>                        
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('pessoa/'); ?>">Lista de pessoas</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar pessoa</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar"> <i class="mdi mdi-content-save"></i> </button>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <hr/>
                                <div class="row mb-3">
                                    <div class="col-1">
                                        <label for="" class="text-left control-label col-form-label" id="labelTextPES_Codigo" >Código:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $singlePesEdita->PES_Codigo; ?>" id="inputTextPES_Codigo" disabled />
                                    </div>
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_MomCadastro" >Cadastro em:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_MomCadastro; ?>" id="inputPES_MomCadastro" disabled />
                                    </div>
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_TipoFouJ" >Tipo:</label>
                                        <select class="form-control" id="optionPES_TipoFouJ">
                                            <option value='F'> Física </option>
                                            <option value='J'> Jurídica </option>
                                        </select>
                                    </div>
                                    <div class="col-7">
                                        <label class="text-left control-label col-form-label" id="labelTextPES_Nome" >Nome / Razão Social:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $singlePesEdita->PES_Nome; ?>" id="inputTextPES_Nome" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_CnpjCpf" >CPF / CNPJ:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_CnpjCpf; ?>" id="inputPES_CnpjCpf" />
                                    </div>
                                    <div class="col-7">
                                        <label for="" class="text-left control-label col-form-label" id="labelTextPES_Apelido" >Apelido / Nome Fantasia:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_Apelido; ?>" id="inputTextPES_Apelido" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="row mb-3">
                                    <div class="col-9">
                                        <label for="" class="text-left control-label col-form-label" id="labelTextPES_EndLogradouro" >Endereço - logradouro:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_EndLogradouro; ?>" id="inputTextPES_EndLogradouro" />
                                    </div>
                                    <div class="col-3">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_EndNumero" >Número:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_EndNumero; ?>" id="inputPES_EndNumero" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label for="" class="text-left control-label col-form-label" id="labelTextPES_EndBairro" >Endereço - bairro:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_EndBairro; ?>" id="inputTextPES_EndBairro" />
                                    </div>
                                    <div class="col-5">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_EndComplemento" >Complemento:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_EndComplemento; ?>" id="inputPES_EndComplemento" />
                                    </div>
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_EndCEP" >CEP:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_EndCEP; ?>" id="inputPES_EndCEP" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label" id="labelTextPES_ContEmail" >E-mail:</label>
                                        <input type="email" class="form-control font-weight-bold" value="<?php echo $singlePesEdita->PES_ContEmail; ?>" id="inputTextPES_ContEmail" />
                                    </div>
                                    <div class="col-3">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_ContTelefone1" >Telefone principal:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_ContTelefone1; ?>" id="inputPES_ContTelefone1" />
                                    </div>
                                    <div class="col-3">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_ContTelefone2" >Telefone alternativo:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_ContTelefone2; ?>" id="inputPES_ContTelefone2" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label" id="labelTextPES_ContSkype" >Rede - Skype:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_ContSkype; ?>" id="inputTextPES_ContSkype" />
                                    </div>
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_ContFacebook" >Rede - Facebook:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_ContFacebook; ?>" id="inputPES_ContFacebook" />
                                    </div>
                                    <div class="col-4">
                                        <label for="" class="text-left control-label col-form-label" id="labelPES_ContLinkedin" >Rede - Linkedin:</label>
                                        <input type="text" class="form-control" value="<?php echo $singlePesEdita->PES_ContLinkedin; ?>" id="inputPES_ContLinkedin" />
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

    <script type="text/javascript">
        removeSpinner();
        // $('#selectCBR_PESempCodigo').select2();

        $('#liAdministracao').addClass('selected');
        $('#liPesLista').addClass('active');
        $('#ulAdministrativo').addClass('in');

        var ValiField="";
        var ValiDominio="";
        var ValiUsuario="";
        var ValiRetorno=false;

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vTextAlertaPES_MomCadastro = 'Se não vier automaticamente, marque o momento do cadastramento da pessoa.';
        var vTextAlertaPES_TipoFouJ = 'Selecione a personalidade jurídica da pessoa, entre Física ou Jurídica.';
        var vTextAlertaPES_Nome = 'Informe o nome da pessoa física ou a razão social da pessoa jurídica.';
        var vTextAlertaPES_CnpjCpf = 'Informe corretamente o CPF da pessoa física ou o CNPJ da pessoa jurídica.';
        var vTextAlertaPES_Apelido = 'Dê um apelido à pessoa física ou informe o nome fantasia à pessoa jurídica.';
        var vTextAlertaPES_EndLogradouro = 'Informe a denominação do logradouro (rua, praça etc) do endereço da pessoa.';
        var vTextAlertaPES_EndNumero = 'Informe o número do endereço da pessoa.';
        var vTextAlertaPES_EndBairro = 'Informe o nome do bairro do endereço da pessoa.';
        var vTextAlertaPES_EndComplemento = 'Informe algum complemento do endereço da pessoa.';
        var vTextAlertaPES_EndCEP = 'Informe o CEP do endereço da pessoa.';
        var vTextAlertaPES_ContEmail = 'Informe corretamente o e-mail pricipal da pessoa.';
        var vTextAlertaPES_ContTelefone1 = 'Informe o número do telefone fixo ou celular pricipal da pessoa.';
        var vTextAlertaPES_ContTelefone2 = 'Informe o número de outro telefone fixo ou celular da pessoa.';
        var vTextAlertaPES_ContSkype = 'Informe o endereço do Skype da pessoa.';
        var vTextAlertaPES_ContFacebook = 'Informe o endereço do Facebook da pessoa.';
        var vTextAlertaPES_ContLinkedin = 'Informe o endereço do Linkedin da pessoa.';

        setInputTextHints();

        $('#btnSalvar').click(function() {

            if( $('#inputTextPES_Nome').val().length <= 3 )
                {
                document.getElementById('inputTextPES_Nome').focus();
                Swal.fire(
                    'Importante!',
                    vTextAlertaPES_Nome,
                    'warning'
                )
                return;
            }

            if( $('#inputTextPES_Apelido').val().length <= 3 )
                {
                document.getElementById('inputTextPES_Apelido').focus();
                Swal.fire(
                    'Importante!',
                    vTextAlertaPES_Apelido,
                    'warning'
                )
                return;
            }

            loadBlurSpinner();
            $.when(updatePesEdita()).done(function(r1) {
                Swal.fire(
                    'Dados salvos',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });

        function setInputTextHints() {
            $('#inputPES_MomCadastro').prop('title', vTextAlertaPES_MomCadastro );
            $('#optionPES_TipoFouJ').prop('title', vTextAlertaPES_TipoFouJ );
            $('#inputTextPES_Nome').prop('title', vTextAlertaPES_Nome );
            $('#inputPES_CnpjCpf').prop('title', vTextAlertaPES_CnpjCpf );
            $('#inputTextPES_Apelido').prop('title', vTextAlertaPES_Apelido );
            $('#inputTextPES_EndLogradouro').prop('title', vTextAlertaPES_EndLogradouro );
            $('#inputPES_EndNumero').prop('title', vTextAlertaPES_EndNumero );
            $('#inputTextPES_EndBairro').prop('title', vTextAlertaPES_EndBairro );
            $('#inputPES_EndComplemento').prop('title', vTextAlertaPES_EndComplemento );
            $('#inputPES_EndCEP').prop('title', vTextAlertaPES_EndCEP );
            $('#inputTextPES_ContEmail').prop('title', vTextAlertaPES_ContEmail );
            $('#inputPES_ContTelefone1').prop('title', vTextAlertaPES_ContTelefone1 );
            $('#inputPES_ContTelefone2').prop('title', vTextAlertaPES_ContTelefone2 );
            $('#inputTextPES_ContSkype').prop('title', vTextAlertaPES_ContSkype );
            $('#inputPES_ContFacebook').prop('title', vTextAlertaPES_ContFacebook );
            $('#inputPES_ContLinkedin').prop('title', vTextAlertaPES_ContLinkedin );

            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

      
        // function ValiEmail(ValiField) {
        //     ValiUsuario = ValiField.substring(0, ValiField.indexOf("@"));
        //     ValiDominio = ValiField.substring(ValiField.indexOf("@")+ 1, ValiField.length);

        //     ValiRetorno = ((ValiUsuario.length >=1) &&
        //         (ValiDominio.length >=3) &&
        //         (ValiUsuario.search("@")==-1) &&
        //         (ValiDominio.search("@")==-1) &&
        //         (ValiUsuario.search(" ")==-1) &&
        //         (ValiDominio.search(" ")==-1) &&
        //         (ValiDominio.search(".")!=-1) &&
        //         (ValiDominio.indexOf(".") >=1) &&
        //         (ValiDominio.lastIndexOf(".") < ValiDominio.length - 1));
        //         return ValiRetorno;
        // }

        function updatePesEdita() {
            var PES_Nome = $('#inputTextPES_Nome').val();
            var PES_TipoFouJ = $('#optionPES_TipoFouJ').val();
            var PES_MomCadastro = $('#inputPES_MomCadastro').val();
            var PES_CnpjCpf = $('#inputPES_CnpjCpf').val();
            var PES_Apelido = $('#inputTextPES_Apelido').val();
            var PES_EndLogradouro = $('#inputTextPES_EndLogradouro').val();
            var PES_EndNumero = $('#inputPES_EndNumero').val();
            var PES_EndBairro = $('#inputTextPES_EndBairro').val();
            var PES_EndComplemento = $('#inputPES_EndComplemento').val();
            var PES_EndCEP = $('#inputPES_EndCEP').val();
            var PES_ContEmail = $('#inputTextPES_ContEmail').val();
            var PES_ContTelefone1 = $('#inputPES_ContTelefone1').val();
            var PES_ContTelefone2 = $('#inputPES_ContTelefone2').val();
            var PES_ContSkype = $('#inputTextPES_ContSkype').val();
            var PES_ContFacebook = $('#inputPES_ContFacebook').val();
            var PES_ContLinkedin = $('#inputPES_ContLinkedin').val();
            
            $.ajax({
                url: "<?php echo base_url(); ?>PesEdita/<?= $this->uri->segment(2); ?>/updatePesEdita",
                type: 'POST',
                data: {
                    PES_Nome: PES_Nome,
                    PES_TipoFouJ: PES_TipoFouJ,
                    PES_MomCadastro: PES_MomCadastro,
                    PES_CnpjCpf: PES_CnpjCpf,
                    PES_Apelido: PES_Apelido,
                    PES_EndLogradouro: PES_EndLogradouro,
                    PES_EndNumero: PES_EndNumero,
                    PES_EndBairro: PES_EndBairro,
                    PES_EndComplemento: PES_EndComplemento,
                    PES_EndCEP: PES_EndCEP,
                    PES_ContEmail: PES_ContEmail,
                    PES_ContTelefone1: PES_ContTelefone1,
                    PES_ContTelefone2: PES_ContTelefone2,
                    PES_ContSkype: PES_ContSkype,
                    PES_ContFacebook: PES_ContFacebook,
                    PES_ContLinkedin: PES_ContLinkedin
                }
            });


        }
    
    </script>

</body>

</html> 
