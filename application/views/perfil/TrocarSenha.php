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
        .hiddenAlert {
            display: none;
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
                        <h4 class="card-title">Perfil</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="">Perfil</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Trocar senha</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-md-6 center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Trocar senha</h4>
                                <br />
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label">Senha atual:</label>
                                        <input type="password" class="form-control" id="inputTextCurrentPassword" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label">Nova senha:</label>
                                        <input type="password" class="form-control" id="inputTextNewPassword" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label">Confirme a senha nova:</label>
                                        <input type="password" class="form-control" id="inputTextNewPasswordConfirmation" />
                                    </div>
                                </div>
                                <div class="alert alert-danger hiddenAlert" style="white-space: pre-line" role="alert" id="divAlertReturn"> &nbsp;</div>
                                <div class="border-top"></div>
                                <br />
                                <button class="btn btn-primary" id="btnChangePassword"> Trocar senha</button>

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
        $('#liHome').addClass('selected');

        $('#btnChangePassword').click(function() {
            const token = "<?= $this->session->userdata('token') ?>";
            var currentPassword = $('#inputTextCurrentPassword').val();
            var newPassword = $('#inputTextNewPassword').val();
            var newPasswordConfirmation = $('#inputTextNewPasswordConfirmation').val();

            $('#divAlertReturn').addClass('hiddenAlert');
            $('#divAlertReturn').html("&nbsp;");

            if (currentPassword === '' || newPassword === '' || newPasswordConfirmation === '') {
                $('#divAlertReturn').removeClass('hiddenAlert');
                $('#divAlertReturn').attr("class", "alert alert-danger");
                $('#divAlertReturn').text("Necessário preencher todos os campos.");
                return
            }

            if (newPassword !== newPasswordConfirmation) {
                $('#divAlertReturn').removeClass('hiddenAlert');
                $('#divAlertReturn').attr("class", "alert alert-danger");
                $('#divAlertReturn').text("A nova senha e confirmação não coincidem.");
                return
            }

            const containsUppercase = /[A-Z]/.test(newPassword)
            const containsLowercase = /[a-z]/.test(newPassword)
            const containsNumber = /[0-9]/.test(newPassword)
            const containsSpecial = /[()#?!@$%^&*-]/.test(newPassword)

            if (!containsUppercase || !containsLowercase || !containsNumber || !containsSpecial || newPassword < 8) {
                $('#divAlertReturn').removeClass('hiddenAlert');
                $('#divAlertReturn').attr("class", "alert alert-danger");
                $('#divAlertReturn').text("A nova senha deve possuir ao menos 8 caracteres, contendo:\n∙ 1 carácter maiusculo;\n∙ 1 minúsculo;\n∙ 1 número;\n∙ 1 especial.");
                return
            }

            loadBlurSpinner();
            $.ajax({
                url: "<?= apiURL; ?>changePassword",
                dataType: 'json',
                type: 'POST',
                data: {
                    currentPassword: currentPassword,
                    newPassword: newPassword
                },
                beforeSend: function(request) {
                    request.setRequestHeader("Authorization", `Bearer ${token}`);
                },

                success: function(data) {
                    removeSpinner();
                    if (data.type == "invalidPassword") {
                        $('#divAlertReturn').removeClass('hiddenAlert');
                        $('#divAlertReturn').attr("class", "alert alert-danger");
                        $('#divAlertReturn').text(data.message);
                        return
                    }
                    Swal.fire('Senha atualizada!', '', 'success').then(() => {
                        window.open('<?= base_url("home/"); ?>', '_self');
                    });
                }
            });
        });
    </script>
</body>
</html>