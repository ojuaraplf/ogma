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
    <title>wD Ogma Cliente</title>

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
                        <h3 class="card-title"><i class="mdi mdi-account-star"></i> Editar cliente</h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('CliLista/'); ?>">Lista Clientes</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Editar cliente</li>
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
                                        <label for="inputCLI_PESCodigo" class="text-left control-label col-form-label">Código </label>
                                        <input type="text" class="form-control" value="<?= $CliEdita->CLI_PESCodigo ?>" id="inputCLI_PESCodigo" disabled />
                                    </div>
                                    <div class="col-11">
                                        <label for="inputPES_Nome" class="text-left control-label col-form-label">Cliente</label>
                                        <input type="text" class="form-control" value="<?php echo $CliEdita->PES_Nome; ?>" id="inputPES_Nome" disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-7">
                                        <label for="inputCLI_VhSysClienteId" id="labelCLI_VhSysClienteId" class="text-left control-label col-form-label"> Código VhSys </label>
                                        <input type="text" class="form-control" value="<?= $CliEdita->CLI_VhSysClienteId ?>"  id="inputCLI_VhSysClienteId" />
                                    </div>
                                </div>
                                <div class="border-top"></div>

                                <div class="col-12">
                                    <label for="tableCliPessoa" class="text-left control-label col-form-label"> <i class="mdi mdi-account-multiple"></i> Membros do Cliente </label>
                                    <button class="btn float-right" style="font-size: 12px; color: #00FF00; background-color: #000000;" id="buttonNovaPessoaMembro"> <i class="mdi mdi-account-plus"></i> </button>
                                    <table id="tableCliPessoa" class="table table-bordered table-sm" >
                                        <thead>
                                            <tr>
                                                <th id="thCLP_PESCodigo"  style="width: 70%;"> Nome </th>
                                                <th id="thCLP_Cargo"  style="width: 29%;"> Cargo no cliente </th>
                                                <th style="width: 1%" id="addCliPessoa"><i class="fas fa-plus-square"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody  height: 30px;>
                                        </tbody>
                                    </table>
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
    <?php $this->load->view('modal/modalQuickPesMembro') ?>

    <script type="text/javascript">
        removeSpinner();
        setInputTextHints();

        $('#liComercial').addClass('selected');
		$('#liCliLista').addClass('active');
		$('#ulComercial').addClass('in');

        var isCliPessoaChanged = false;
        var arrayDeletedCliPessoa = [];

        var arrayCliPessoaOption = [];
        
        $('#btnSalvar').click(function() {
            loadBlurSpinner();
            $.when(UpdateCliEdita(), updateCliPessoa(), DeletedCliPessoa() ).done(function(r1, r2, r3) {
                console.log(r1);
                Swal.fire(
                    'Cliente salvo',
                    '',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        });

        $('#btnEditarPessoa').click(function () {
		    window.open('<?php echo base_url('PesEdita/')?>' + "<?= $CliEdita->CLI_PESCodigo ?>", '_self');            
	    });

        $('#buttonNovaPessoaMembro').click(function() {
            $('#modalQuickPesMembro').modal('show');
        });
        
        $.when( fetchPessoaParaCLiente(), fetchPessoaDoCLiente()).done(function(r1, r2) {
            removeSpinner();
            
            for (var i = 0; i <= r1[0].length - 1; i++) {
                arrayCliPessoaOption.push('<option value="'+r1[0][i].CODIGO+'"> '+r1[0][i].PESSOA+'</option>');
            }
         
            console.log(r2[0]);
            for (var i = 0; i <= r2[0].length - 1; i++) {
                var htmltableCliPessoa = [];
                htmltableCliPessoa.push('<tr id="' + r2[0][i].CLP_ID + '">');
                htmltableCliPessoa.push('<td> <select id="thCLP_PESCodigo'+i+'"class="form-control" >'+arrayCliPessoaOption+'</select> </td>');
                htmltableCliPessoa.push('<td> <input type="text" class="form-control" id="thCLP_Cargo" value="' + r2[0][i].CARGO + '" /> </td>');
                htmltableCliPessoa.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmltableCliPessoa.push('</tr>');
                $('#tableCliPessoa').append(htmltableCliPessoa.join(''));

                $('#thCLP_PESCodigo' + i).val(r2[0][i].CODIGO);
                $('#thCLP_PESCodigo' + i).change();                
                
            }
        });

        function UpdateCliEdita() {
            var vCLI_PESCodigo = $('#inputCLI_PESCodigo').val();
            var vCLI_VhSysClienteId = $('#inputCLI_VhSysClienteId').val();
            $.ajax({
                // url: "<!?php echo base_url(); ?>configuracao/<!?= $this->uri->segment(2); ?>/UpdateUsu",
                url: "<?php echo base_url(); ?>comercial/CliLista/UpdateCliEdita",
                type: 'POST',
                data: {
                    vCLI_PESCodigo: vCLI_PESCodigo,
                    vCLI_VhSysClienteId: vCLI_VhSysClienteId
                }
            });
        }

        function updateCliPessoa() {
            var arrayCliPessoa = [];
            $('#tableCliPessoa').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                var CLP_PESCodigo = $tds.eq(0).find('select').val();
                var CLP_Cargo = $tds.eq(1).find('input').val();
                var CLP_CLICodigo = <?php echo $this->uri->segment(2); ?>;

                var CLP_Codigo = null;
                if ($(this).attr('id') != null) {
                    CLP_Codigo = $(this).attr('id');
                }
                arrayCliPessoa.push([CLP_Codigo, CLP_PESCodigo, CLP_Cargo, CLP_CLICodigo ]);
            });
            console.log(arrayCliPessoa);
            return $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/updateCliPessoa",
                type: 'POST',
                data: {
                    arrayCliPessoa: arrayCliPessoa
                },
            });
        }

        function fetchPessoaDoCLiente() {
            var pCLICodigo = '';
            return $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/fetchPessoaDoCLiente",
                dataType: 'json',
                type: 'POST',
                data: {
                    pCLICodigo: <?php echo $this->uri->segment(2); ?>
                }
            });
        }

        function fetchPessoaParaCLiente() {
            var pFouJ = 'F';
            var pCliTipo = '0';
            return $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/fetchPessoaParaCLiente",
                dataType: 'json',
                type: 'POST',
                data: {
                    pFouJ: pFouJ,
                    pCliTipo: pCliTipo
                }
            });
        }

        function DeletedCliPessoa() {
            return $.ajax({
                url: "<?php echo base_url(); ?>comercial/CliLista/DeletedCliPessoa",
                type: 'POST',
                data: {
                    arrayDeletedCliPessoa: arrayDeletedCliPessoa
                },
            });
        }

        $('#addCliPessoa').click(function() {

            var htmltableCliPessoa = [];
                htmltableCliPessoa.push('<tr>');
                htmltableCliPessoa.push('<td> <select class="form-control" >'+arrayCliPessoaOption+'</select> </td>');
                htmltableCliPessoa.push('<td> <input type="text" class="form-control"/> </td>');
                htmltableCliPessoa.push('<td id="delete"><i class="fas fa-trash-alt"></i></td>');
                htmltableCliPessoa.push('</tr>');
                $('#tableCliPessoa').append(htmltableCliPessoa.join(''));
        });

        $(document).on('click', '#delete', function() {
            if ($(this).parent().parent().parent().attr('id') == "tableCliPessoa") {
                arrayDeletedCliPessoa.push($(this).parent().attr('id'));
            }
            $(this).parent().remove();
        });


        function setInputTextHints() {
            $('#btnSalvar').prop('title', 'Clique para salvar as alterações nos dados do Cliente.');
            $('#btnEditarPessoa').prop('title', 'Clique para editar a Pessoa do Cliente.');
            
            $('#inputPES_Nome').prop('title', 'Nome da Pessoa Cliente.\nEditável pelo Cadastro de Pessoas.');
            $('#inputCLI_VhSysClienteId').prop('title', 'Código de classificação do cliente,\nno sistema VhSys, caso saiba.');

            $('#buttonNovaPessoaMembro').prop('title', 'Quick insert de Pessoa:\nClique para incluir rapidamente uma nova pessoa,\ncomo Pessoa e como Membro do Cliente, ao mesmo tempo.\nTenha certeza de que ela já não exista na lista de Pessoas.');
            $('#tableCliPessoa').prop('title', 'Pessoas Membro do Cliente.\nPessoas ligadas ao Cliente e suas respectivas funções.');
            $('#addCliPessoa').prop('title', 'Clique para adicionar nova linha.\nNas linhas, clique no icone da lixeira\npara exluir a linha e pessoa da lista.');
            $('#thCLP_PESCodigo').prop('title', 'Selecione a pessoa ligada ao Cliente, em cada linha.');
            $('#thCLP_Cargo').prop('title', 'Digite a função/papel da pessoa no Cliente, em cada linha.');
                        
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