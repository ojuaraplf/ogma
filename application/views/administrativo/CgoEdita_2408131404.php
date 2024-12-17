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
    <title>wDiscover</title>

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
                        <h3 class="card-title"><i class="mdi mdi-account-box-outline"></i> Editar Cargo </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('CgoLista/'); ?>">Lista de Cargos</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar Cargo</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #FFD700; background-color: #000000;" id="btnSalvar" > <i class="mdi mdi-content-save"></i> </button>                        
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="inputTextCGO_Codigo" id="lnputTextCGO_Codigo" class="text-left control-label col-form-label">Código do Cargo:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayCargo[0]["CGO_Codigo"]; ?>" id="inputTextCGO_Codigo" disabled />
                                    </div>
                                    <div class="col-10">
                                        <label for="inputTextCGO_Titulo" id="lnputTextCGO_Titulo" class="text-left control-label col-form-label">Título do Cargo:</label>
                                        <input type="text" class="form-control font-weight-bold" value="<?php echo $ArrayCargo[0]["CGO_Titulo"]; ?>" id="inputTextCGO_Titulo"/>
                                    </div>                                    
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input type="checkbox" <?= $ArrayCargo[0]["CGO_FlgGerenciaPpx"] == 1 ? 'checked' : '' ?> id="checkboxCGO_FlgGerenciaPpx">
                                        <label class="text-left" for="checkboxCGO_FlgGerenciaPpx">De Gestão</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $ArrayCargo[0]["CGO_FlgExecutaSvco"] == 1 ? 'checked' : '' ?> id="checkboxCGO_FlgExecutaSvco">
                                        <label class="text-left" for="checkboxCGO_FlgExecutaSvco">De Execução</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" <?= $ArrayCargo[0]["CGO_FlgLideraEQP"] == 1 ? 'checked' : '' ?> id="checkboxCGO_FlgLideraEQP">
                                        <label class="text-left" for="checkboxCGO_FlgLideraEQP">De Liderança de Equipe</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">                                        
                                        <label for="eInputCGO_Atribuicoes" id="lInputCGO_Atribuicoes" class="text-left control-label col-form-label" id="lInputCGO_Atribuicoes"> Atribuições do cargo:</label>
                                        <textarea type="text" class="form-control" rows="3" id="eInputCGO_Atribuicoes"><?php echo $ArrayCargo[0]["CGO_Atribuicoes"] ; ?></textarea>
                                    </div>                                    
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="eInputCGO_PapelMissao" id="lInputCGO_PapelMissao" class="text-left control-label col-form-label" id="lInputCGO_PapelMissao"> Missão do cargo:</label>
                                        <textarea type="text" class="form-control" rows="2" id="eInputCGO_PapelMissao"><?php echo $ArrayCargo[0]["CGO_PapelMissao"]; ?></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="eInputCGO_FormacaoMinima" id="lInputCGO_FormacaoMinima" class="text-left control-label col-form-label" id="lInputCGO_FormacaoMinima"> Formação Mínima:</label>
                                        <textarea type="text" class="form-control" rows="2" id="eInputCGO_FormacaoMinima"><?php echo $ArrayCargo[0]["CGO_FormacaoMinima"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="eInputCGO_FormExperDesejavel" id="lInputCGO_FormExperDesejavel" class="text-left control-label col-form-label" id="lInputCGO_FormExperDesejavel"> Experiência Desejável:</label>
                                        <textarea type="text" class="form-control" rows="2" id="eInputCGO_FormExperDesejavel"><?php echo $ArrayCargo[0]["CGO_FormExperDesejavel"]; ?></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="eInputCGO_ExperMinima" id="lInputCGO_ExperMinima" class="text-left control-label col-form-label" id="lInputCGO_ExperMinima"> Experiência Mínima:</label>
                                        <textarea type="text" class="form-control" rows="2" id="eInputCGO_ExperMinima"><?php echo $ArrayCargo[0]["CGO_ExperMinima"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="selectCGO_SETCodigo" id="lselectCGO_SETCodigo" class="text-left control-label col-form-label">Setor do Cargo</label>
                                        <select class="form-control" id="selectCGO_SETCodigo">
                                            <option value=0> Selecione um Setor ... </option>
                                            <?php foreach ($ArraySetor as $item): ?>
                                            <option value="<?= $item['SET_Codigo']; ?>" <?= $ArrayCargo[0]["CGO_SETCodigo"] == $item['SET_Codigo'] ? 'selected' : '' ?>>
                                                <?= $item['SETOR_NOME']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label for="selectCGO_CBUCodigo" id="lselectCGO_CBUCodigo" class="text-left control-label col-form-label">Unidade de Remuneração para o cargo</label>
                                        <select class="form-control" id="selectCGO_CBUCodigo">
                                            <option value=0> Selecione uma Unidade de Remuneração ... </option>
                                            <?php foreach ($ArrayUnida as $item): ?>
                                            <option value="<?= $item['CODIGO']; ?>"  <?= $ArrayCargo[0]["CGO_CBUCodigo"] == $item['CODIGO'] ? 'selected' : '' ?>>
                                                <?= $item['UNIDADE']; ?>
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
    <?php $this->load->view('modal/modalQuickPesColabEmpresa') ?>


    <script type="text/javascript">
        removeSpinner();        
        setInputTextHints();

        $('#liAdministracao').addClass('selected');
        $('#liCargo').addClass('active');
        $('#ulAdministrativo').addClass('in');

        $('#btnSalvar').click(function() {

            if( $('#inputTextCGO_Titulo').val().length <= 3 )
                {
                document.getElementById('inputTextCGO_Titulo').focus();
                Swal.fire(
                    'Importante!',
                    "Dê um Título digno para o Cargo.",
                    'warning'
                )
                return;
            }

            if( $('#selectCGO_SETCodigo').val() == '0' )
                {
                document.getElementById('selectCGO_SETCodigo').focus();
                Swal.fire(
                    'Importante!',
                    'Selecione um Setor para o Cargo.',
                    'warning'
                )
                return;
            };

            if( $('#selectCGO_CBUCodigo').val() == '0' )
                {
                document.getElementById('selectCGO_CBUCodigo').focus();
                Swal.fire(
                    'Importante!',
                    'Selecione uma Unidade de Remuneração para o Cargo.',
                    'warning'
                )
                return;
            };

            loadBlurSpinner();
            $.when(UpdateCargo()).done(function(r1) {
                console.log(r1);
                Swal.fire(
                    'Cargo salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });

        function UpdateCargo() {            

            return $.ajax({
                url: "<?php echo base_url(); ?>administrativo/CgoLista/UpdateCargo",
                type: 'POST',
                data: {
                    CGO_Codigo: $('#inputTextCGO_Codigo').val(),
                    CGO_Titulo: $('#inputTextCGO_Titulo').val(),
                    CGO_PapelMissao: $('#eInputCGO_PapelMissao').val(),
                    CGO_Atribuicoes: $('#eInputCGO_Atribuicoes').val(),
                    CGO_FormacaoMinima: $('#eInputCGO_FormacaoMinima').val(),
                    CGO_FormExperDesejavel: $('#eInputCGO_FormExperDesejavel').val(),
                    CGO_ExperMinima: $('#eInputCGO_ExperMinima').val(),
                    CGO_SETCodigo: $('#selectCGO_SETCodigo').val() == 0 ? null : $('#selectCGO_SETCodigo').val(),
                    CGO_CBUCodigo: $('#selectCGO_CBUCodigo').val() == 0 ? null : $('#selectCGO_CBUCodigo').val(),
                    CGO_FlgGerenciaPpx: $('#checkboxCGO_FlgGerenciaPpx').is(":checked") ? 1 : 0,
                    CGO_FlgLideraEQP: $('#checkboxCGO_FlgLideraEQP').is(":checked") ? 1 : 0,
                    CGO_FlgExecutaSvco: $('#checkboxCGO_FlgExecutaSvco').is(":checked") ? 1 : 0
                }
            });

        }
        
        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações nos dados do Cargo.');

            $('#inputTextCGO_Codigo').prop('title', 'Código (Id) do Cargo.');
            $('#inputTextCGO_Titulo').prop('title', 'Título do Cargo.');

            $('#checkboxCGO_FlgGerenciaPpx').prop('title', 'Marcado, indica que o cargo é de Gestão de Projetos ou Operações de Serviço.');
            $('#checkboxCGO_FlgExecutaSvco').prop('title', 'Marcado, indica que o cargo é de Execução de Serviços.');
            $('#checkboxCGO_FlgLideraEQP').prop('title', 'Marcado, indica que o cargo é de Liderança de Equipe de Execução.');
            

            $('#eInputCGO_Atribuicoes').prop('title', 'Atribuições do Cargo.\nQue tarefas rotineiras, intermitentes ou contínuas têm o(s) ocuante(s) do Cargo?');
            $('#eInputCGO_PapelMissao').prop('title', 'Missão do Cargo.\nAlém das atribuições, para que resultado estão voltadas as preocupações do(s) ocupante(s) do Cargo?');
            $('#eInputCGO_FormacaoMinima').prop('title', 'Formação Mìnima para o Cargo.\nQue formação (cursos, especializações etc) deve ter o(s) ocupante(s) do Cargo?');
            $('#eInputCGO_FormExperDesejavel').prop('title', 'Experiência Desejável para o Cargo.\nQual o tempo e em que expertise o(s) ocupante(s) já deverá(ão) ter para ter(em) melhor desempenho no Cargo?');
            $('#eInputCGO_ExperMinima').prop('title', 'Experiência Mínima para o Cargo.\nQual o tempo e em que expertise o(s) ocupante(s) já deverá(ão) ter para ocupar(em) no Cargo?');
            $('#selectCGO_SETCodigo').prop('title', 'Setor de funcionamento do Cargo.\nSelecione o Setor do Cargo.');
            $('#selectCGO_CBUCodigo').prop('title', 'Unidade de Remuneração para o Cargo.\nSelecione a unidade sugerida para remuneração do(s) ocupante(s) do Cargo.');
                        
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