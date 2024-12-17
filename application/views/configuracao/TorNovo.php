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
                        <h4 class="card-title"><i class="mdi mdi-square-inc-cash"></i> Criar Tipo de Faturamento (TOR)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('TorLista/'); ?>">Lista de Tipos de Faturamento</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Cria Tipo de Faturamento (TOR)</li>
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
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="inputTOR_Nome" class="text-left control-label col-form-label">Denominação </label>
                                        <input type="text" class="form-control" id="inputTOR_Nome" />
                                    </div>
                                </div>
                                <div class="row mb-3">                                    
                                    <div class="col-12">
                                        <label for="inputTOR_Descricao" class="text-left control-label col-form-label">Descrição </label>
                                        <input type="text" class="form-control" id="inputTOR_Descricao" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="checkbox" checked id="checkboxTOR_FlgAtgFaturavel">
                                    <label class="text-left" for="checkboxTOR_FlgAtgFaturavel">Atividades Faturáveis</label>
                                </div>
                                <div class="row mb-3">                            
                                    <div class="col-6">
                                        <label for="selectTOR_OptClasseFaturamento" class="text-left control-label col-form-label">Classe do Tipo de Faturamento</label>
                                        <select class="form-control" id="selectTOR_OptClasseFaturamento" data-toggle="tooltip">
                                            <option value="none">Selecione a classe</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="selectTOR_OptBaseFaturamento" class="text-left control-label col-form-label">Base do Tipo de Faturamento</label>
                                        <select class="form-control" id="selectTOR_OptBaseFaturamento" data-toggle="tooltip">
                                            <option value="none">Selecione a base</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <label for="InputTOC_Descritivo" class="text-left control-label col-form-label" id="lInputTOC_Descritivo"> Descritivo da Classe </label>
                                        <textarea type="text" class="form-control" rows="5" disabled id="InputTOC_Descritivo"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="InputTOB_Descritivo" class="text-left control-label col-form-label" id="lInputTOB_Descritivo"> Descritivo da Base </label>
                                        <textarea type="text" class="form-control" rows="5" disabled id="InputTOB_Descritivo"></textarea>
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
		$('#liTor').addClass('active');
		$('#ulConfiguracao').addClass('in');        
 
        var vArrayTOC = [];
        var vArrayTOB = [];

        $.when(SelTOC(), SelTOB()).done(function(r1, r2) {
            removeSpinner();

            console.log(r1[0]);
            console.log(r2[0]);                       
            console.log(r1[0][0].TOC_Codigo);
            console.log(r2[0][0].TOB_Codigo);

            vArrayTOC = r1[0];
            vArrayTOB = r2[0];

            var html = [];
            for (var i = r1[0].length - 1; i >= 0; i--) {
                html.push('<option value="' + r1[0][i].TOC_Codigo + '">' + r1[0][i].TOC_Descricao + '</option>');

            }
            $('#selectTOR_OptClasseFaturamento').append(html.join(''));            
                        
            var html = [];
            for (var i = r2[0].length - 1; i >= 0; i--) {
                html.push('<option value="' + r2[0][i].TOB_Codigo + '">' + r2[0][i].TOB_Descricao + '</option>');

            }
            $('#selectTOR_OptBaseFaturamento').append(html.join(''));           

        });

        function SelTOC() {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/TorLista/SelTOC",
                dataType: 'json'
            });            
        }

        function SelTOB() {
            return $.ajax({
                url: "<?php echo base_url(); ?>configuracao/TorLista/SelTOB",
                dataType: 'json'
            });            
        }

        $('#selectTOR_OptClasseFaturamento').change(function() {            
            if ($('#selectTOR_OptClasseFaturamento')[0].selectedIndex == 0) {
                $('#InputTOC_Descritivo').val('');
                return;
            }
            $('#InputTOC_Descritivo').val(vArrayTOC.find(x => x.TOC_Codigo == $('#selectTOR_OptClasseFaturamento').val()).TOC_Descritivo);
        });

        $('#selectTOR_OptBaseFaturamento').change(function() {            
            if ($('#selectTOR_OptBaseFaturamento')[0].selectedIndex == 0) {
                $('#InputTOB_Descritivo').val('');
                return;
            }
            $('#InputTOB_Descritivo').val(vArrayTOB.find(x => x.TOB_Codigo == $('#selectTOR_OptBaseFaturamento').val()).TOB_Descritivo);
        });

        function NewTor() {
            
            $.ajax({                
                url: "<?php echo base_url(); ?>configuracao/TorLista/NewTor",
                type: 'POST',
                data: {                    
                    TOR_Nome: $('#inputTOR_Nome').val(),
                    TOR_Descricao: $('#inputTOR_Descricao').val(),
                    TOR_OptClasseFaturamento: $('#selectTOR_OptClasseFaturamento').val(),
                    TOR_OptBaseFaturamento: $('#selectTOR_OptBaseFaturamento').val(),
                    TOR_FlgAtgFaturavel: $('#checkboxTOR_FlgAtgFaturavel').is(":checked") ? 1 : 0
                }
            });
        }

        $('#btnSalvar').click(function() {
            
            if( $('#inputTOR_Nome').val().length <= 5 )
                {
                document.getElementById('inputTOR_Nome').focus();
                Swal.fire(
                    'Importante!',
                    'Informe um nome com mais de cinco caracteres.',
                    'warning'
                )		
                return;
            };

            if( $('#selectTOR_OptClasseFaturamento').val() == 'none')
                {
                document.getElementById('selectTOR_OptClasseFaturamento').focus();
                Swal.fire(
                    'Importante!',
                    'Selecione a Classe para o Tipo de Faturamento.',
                    'warning'
                )		
                return;
            };
            
            if( $('#selectTOR_OptBaseFaturamento').val() == 'none')
                {
                document.getElementById('selectTOR_OptBaseFaturamento').focus();
                Swal.fire(
                    'Importante!',
                    'Selecione a Base para o Tipo de Faturamento.',
                    'warning'
                )		
                return;
            };

            loadBlurSpinner();
            $.when(NewTor()).done(function(r1) {
                console.log('console.log(r1);');
                console.log(r1);
                Swal.fire(
                    'Tipo de Faturamento salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });

        function setInputTextHints() {
            $('#inputTOR_Nome').prop('title', 'Denominação do Tipo de Faturamento.');
            $('#inputTOR_Descricao').prop('title', 'Descrição sobre o Tipo de Faturamento.');
            $('#checkboxTOR_FlgAtgFaturavel').prop('title', 'Atividades geradas faturáveis.\nMarcado, significa que as atividades geradas por\ntemplate ou chamado, virão faturáveis para este tipo de faturamento.');
            $('#selectTOR_OptClasseFaturamento').prop('title', 'Classe do Tipo de Faturamento.\nAinda se definindo como necessário.');           
            $('#selectTOR_OptBaseFaturamento').prop('title', 'Base de cálculo do Tipo de Faturamento.\nAinda se definindo como necessário.');
            $('#InputTOC_Descritivo').prop('title', 'Descritivo da Classe do Tipo de Faturamento.\nMuda conforme a Classe selecionada no combo.');
            $('#InputTOB_Descritivo').prop('title', 'Descritivo da Base de Cálculo do Tipo de Faturamento.\nMuda conforme a Base selecionada no combo.');
            $('#btnSalvar').prop('title', 'Criar novo Tipo de Faturamento, com novo código e com os dados editados.');
            

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