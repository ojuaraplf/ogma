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
    <title>wD Ogma Usuário</title>

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
                        <h3 class="card-title"><i class="mdi mdi-account-network"></i> Editar usuário</h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('ListaUsuario/'); ?>">Lista de Usuários</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar usuário</li>
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
                        <button class="btn float-right" style="font-size: 25px; color: #00BFFF; background-color: #000000;" id="btnEditarPessoa"> <i class="mdi mdi-account"></i></i> </button>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-1">
                                        <label for="" class="text-left control-label col-form-label">Código </label>
                                        <input type="text" class="form-control" value="<?= $usuario->USU_PESCodigo ?>" id="inputTextCodUsuario" disabled />
                                    </div>
                                    <div class="col-11">
                                        <label for="inputTextPES_Nome" class="text-left control-label col-form-label">Usuário</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario->PES_Nome; ?>" id="inputTextPES_Nome" disabled />
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label for="inputTextUSU_Login" class="text-left control-label col-form-label">Login</label>
                                        <input type="text" class="form-control" value="<?= $usuario->USU_Login ?>"  id="inputTextUSU_Login" />
                                    </div>
                                    <div class="col-5">
                                        <label for="inputTextUSU_Senha" class="text-left control-label col-form-label">Criptografia da senha</label>
                                        <input type="text" class="form-control" value="<?= $usuario->USU_Senha ?>"  id="inputTextUSU_Senha" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodeAcessarOgma == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodeAcessarOgma">
                                        <label class="text-left" for="checkboxUSU_FlgPodeAcessarOgma"><i class="mdi mdi-star"></i> Acessa OGMA</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodeAcessarSirius == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodeAcessarSirius">
                                        <label class="text-left" for="checkboxUSU_FlgPodeAcessarSirius"><i class="mdi mdi-star-outline"></i> Acessa SIRIUS</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodeEditarPessoa == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodeEditarPessoa">
                                        <label class="text-left" for="checkboxUSU_FlgPodeEditarPessoa"><i class="mdi mdi-account"></i> Edita Pessoa</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodeEditarColaborador == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodeEditarColaborador">
                                        <label class="text-left" for="checkboxUSU_FlgPodeEditarColaborador"><i class="mdi mdi-account-convert"></i> Edita Colaborador</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodeEditarUsuario == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodeEditarUsuario">
                                        <label class="text-left" for="checkboxUSU_FlgPodeEditarUsuario"><i class="mdi mdi-account-network"></i> Edita Usuário</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodeAcessarGestaoPlanos == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodeAcessarGestaoPlanos">
                                        <label class="text-left" for="checkboxUSU_FlgPodeAcessarGestaoPlanos"><i class="mdi mdi-math-compass"></i> Acessa Gerência</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodePreFaturar == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodePreFaturar">
                                        <label class="text-left" for="checkboxUSU_FlgPodePreFaturar"><i class="mdi mdi-battery-positive" style="color: SteelBlue;"></i> Pode pré-faturar</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgPodePrePagar == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgPodePrePagar">
                                        <label class="text-left" for="checkboxUSU_FlgPodePrePagar"><i class="mdi mdi-battery-negative" style="color: #B22222;"></i> Pode pré-pagar</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" <?= $usuario->USU_FlgRecebeEmail == 1 ? 'checked' : '' ?> id="checkboxUSU_FlgRecebeEmail">
                                        <label class="text-left" for="checkboxUSU_FlgRecebeEmail"><i class="fas fa-envelope"></i> Recebe e-mail</label>
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
        setInputTextHints();

        $('#liConfiguracao').addClass('selected');
		$('#liUsuLista').addClass('active');
		$('#ulConfiguracao').addClass('in');

        $('#btnSalvar').click(function() {
            // if ($('#selectCBR_CBUCodigo')[0].selectedIndex == 0 ||
            //     $('#selectCBR_PESempCodigo')[0].selectedIndex == 0 ||
            //     $('#selectCBR_CGOcodigo')[0].selectedIndex == 0) {
            //     Swal.fire(
            //         'Aviso',
            //         'Necessário preencher todos os campos para salvar as informações do colaborador',
            //         'warning'
            //     )
            //     return;
            // }
            loadBlurSpinner();
            $.when(UpdateUsu()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Usuário salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });

        function UpdateUsu() {

            
            var USU_PESCodigo = $('#inputTextCodUsuario').val();
            var USU_Login = $('#inputTextUSU_Login').val();
            var USU_Senha = $('#inputTextUSU_Senha').val();
            var USU_FlgPodeAcessarOgma = $('#checkboxUSU_FlgPodeAcessarOgma').is(":checked") ? 1 : 0;
            var USU_FlgPodeAcessarSirius = $('#checkboxUSU_FlgPodeAcessarSirius').is(":checked") ? 1 : 0;
            var USU_FlgPodeEditarPessoa = $('#checkboxUSU_FlgPodeEditarPessoa').is(":checked") ? 1 : 0;
            var USU_FlgPodeEditarColaborador = $('#checkboxUSU_FlgPodeEditarColaborador').is(":checked") ? 1 : 0;
            var USU_FlgPodeEditarUsuario = $('#checkboxUSU_FlgPodeEditarUsuario').is(":checked") ? 1 : 0;
            var USU_FlgPodeAcessarGestaoPlanos = $('#checkboxUSU_FlgPodeAcessarGestaoPlanos').is(":checked") ? 1 : 0;
            var USU_FlgRecebeEmail = $('#checkboxUSU_FlgRecebeEmail').is(":checked") ? 1 : 0;
            var USU_FlgPodePreFaturar = $('#checkboxUSU_FlgPodePreFaturar').is(":checked") ? 1 : 0;
            var USU_FlgPodePrePagar = $('#checkboxUSU_FlgPodePrePagar').is(":checked") ? 1 : 0;
            
            
            $.ajax({
                // url: "<!?php echo base_url(); ?>configuracao/<!?= $this->uri->segment(2); ?>/UpdateUsu",
                url: "<?php echo base_url(); ?>configuracao/UsuLista/UpdateUsu",
                type: 'POST',
                data: {
                    USU_PESCodigo: USU_PESCodigo,
                    USU_Login: USU_Login,
                    USU_Senha: USU_Senha,
                    USU_FlgPodeAcessarOgma: USU_FlgPodeAcessarOgma,
                    USU_FlgPodeAcessarSirius: USU_FlgPodeAcessarSirius,
                    USU_FlgPodeEditarPessoa: USU_FlgPodeEditarPessoa,
                    USU_FlgPodeEditarColaborador: USU_FlgPodeEditarColaborador,
                    USU_FlgPodeEditarUsuario: USU_FlgPodeEditarUsuario,
                    USU_FlgPodeAcessarGestaoPlanos: USU_FlgPodeAcessarGestaoPlanos,
                    USU_FlgPodePreFaturar: USU_FlgPodePreFaturar,
                    USU_FlgPodePrePagar: USU_FlgPodePrePagar,
                    USU_FlgRecebeEmail: USU_FlgRecebeEmail
                }
            });
        }

        $('#btnEditarPessoa').click(function () {
		    window.open('<?php echo base_url('PesEdita/')?>' + "<?= $usuario->USU_PESCodigo ?>", '_self');            
	    });

        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações nos dados do Usuário.');
            $('#btnEditarPessoa').prop('title', 'Clique para editar a Pessoa do Usuário.');

            $('#inputTextUSU_Login').prop('title', 'Digite um login para o usuário - servirá para acesso ao OGMA e o SIRIUS.');
                        
            $('#checkboxUSU_FlgPodeAcessarOgma').prop('title', 'Marque para que o usuário possa acessar o OGMA.');
            $('#checkboxUSU_FlgPodeAcessarSirius').prop('title', 'Marque para que o usuário possa acessar o SIRIUS.');
            $('#checkboxUSU_FlgPodeEditarPessoa').prop('title', 'Marque para que o usuário possa acessar e editar o Cadastro de Pessoas.');
            $('#checkboxUSU_FlgPodeEditarColaborador').prop('title', 'Marque para que o usuário possa acessar e editar o Cadastro de Colaboradores.');
            $('#checkboxUSU_FlgPodeEditarUsuario').prop('title', 'Marque para que o usuário possa acessar e editar o Cadastro de Usuários.');
            $('#checkboxUSU_FlgPodeAcessarGestaoPlanos').prop('title', 'Marque para que o usuário possa acessar a Seção de Gerência de Projetos.');
            $('#checkboxUSU_FlgRecebeEmail').prop('title', 'Marque para que o usuário receba e-mails do OGMA e/ou Sírius: interações de chamado etc.');
            $('#checkboxUSU_FlgPodePreFaturar').prop('title', 'Marque para que o usuário possa pré-fatutar apontamentos.');
            $('#checkboxUSU_FlgPodePrePagar').prop('title', 'Marque para que o usuário possa pré-pagar apontamentos.');
            
            
            
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