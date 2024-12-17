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
    <title>wD Chamado </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        #tableLista tbody tr {
            cursor: pointer;
        }

        html {
            visibility: hidden;
        }
    </style>

</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navBarChamado') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Chamados - CHD </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"> Home</li>
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
                                <div class="row">
                                    <div class="col-3">
                                        <label for="comboboxGep" class="text-left control-label col-form-label"> Gerente de Projeto </label>
                                        <select class="form-control" id="comboboxGep">
                                            <option value="0"> Todos os gerentes ... </option>
                                            <?php foreach ($listaGep as $item) : ?>
                                                <option value="<?= $item['CODIGO'] ?>" <?= $this->input->get("selectedGep") == $item['CODIGO'] ? "selected" : "" ?>>
                                                    <?= $item['NOME'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="comboboxPPx" class="text-left control-label col-form-label"> Plano de Serviço (Projeto) </label>
                                        <select class="form-control" id="comboboxPPx">
                                            <option value="0"> Todos os planos de serviço ... </option>
                                            <?php foreach ($listaPjt as $item) : ?>
                                                <option value="<?= $item['CODIGO'] ?>" <?= $this->input->get("selectedPjt") == $item['CODIGO'] ? "selected" : "" ?>>
                                                    <?= $item['APELIDO'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="comboboxSol" class="text-left control-label col-form-label"> Solicitante </label>
                                        <select class="form-control" id="comboboxSol">
                                            <option value="0"> Selecione o solicitante ... </option>
                                            <?php foreach ($listaSol as $item) : ?>
                                                <option value="<?= $item['CODIGO'] ?>" <?= $this->input->get("selectedSol") == $item['CODIGO'] ? "selected" : "" ?>>
                                                    <?= $item['NOME'] ?>
                                                </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="optionboxAtivo" class="text-left control-label col-form-label" id="labelPES_TipoFouJ">Chamados ativos:</label>
                                        <select class="form-control" id="optionboxAtivo">
                                            <option value='0' <?= $this->input->get("optionboxAtivo") == 0 ? "selected" : "" ?>> Todos </option>
                                            <option value='1' <?= $this->input->get("optionboxAtivo") == 1 ? "selected" : "" ?>> Apenas inativos </option>
                                            <option value='2' <?= $this->input->get("optionboxAtivo") == 2 ? "selected" : "" ?>> Apenas ativos </option>
                                        </select>
                                    </div>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divLista">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar na lista de Chamados</label>
                                        <input type="text" class="form-control" id="inputTextFiltro" />
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableLista">
                                    <thead>
                                        <tr>
                                            <th id='col01nmro'> Chamado</br>Número</th>
                                            <th id='col02abre'> Interação</br>Data/hora</th>
                                            <th id='col10usua'> Usuário</th>
                                            <th id='col03desc'> Descrição</br>Solicitação</th>
                                            <th id='col04plan'> Plano</br>Projeto</th>
                                            <th id='col05stat'> Status</br>Atual</th>
                                            <th id='col06prio'> <i class="fas fa-hand-lizard"></i>
                                            <th id='col07anex'> <i class="fas fa-paperclip"></i></th>
                                            <th id='col08apro'> <i class="fas fa-hand-holding-usd"></i> </th>
                                            <th id='col09aval'> <i class="fas fa-hand-holding-heart"></i> </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($chdLista as $item) : ?>
                                            <tr id="<?= $item['NUMERO']; ?>">
                                                <td> <?= $item['NUMERO']; ?> </td>
                                                <td> <?= $item['CHI_ULTIMA']; ?> </td>
                                                <td> <?= $item['CHI_USUARIO']; ?> </td>
                                                <td> <?= $item['DESCRICAO']; ?> </td>
                                                <td> <?= $item['PLANO']; ?> </td>
                                                <td> <?= $item['STATUS']; ?> </td>
                                                <td> <?= $item['PRIORIDADE']; ?> </td>
                                                <td> <?= $item['TEMANEXO']; ?> </td>
                                                <td> <?= $item['TAPROVADO']; ?> </td>
                                                <td> <?= $item['TAVALIADO']; ?> </td>
                                                <td> <?= $item['ABERTURA']; ?> </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                            <b>Versão Beta: 00.50 - 26/10/2021</b><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalNovoChamado') ?>

    <script type="text/javascript">
        removeSpinner();

        $('#liServico').addClass('selected');
        $('#liServicoChamado').addClass('active');
        $('#ulServico').addClass('in');

        var arrayLista = [];
        var currentUrlParams = window.location.search;
        var selectedPjt = null;
        var selectedPjf = null;
        var selectedGep = null;
        var selectedSol = null;
        var optionboxAtivo = null;

        var table = $('#tableLista').DataTable({
            dom: '<"html5buttons"B>Tfgitp',
            buttons: [{
                    extend: 'pdf',
                    className: 'btn-primary',
                    exportOptions: {
                        columns: ':not(.notexport)'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-primary'
                },
                {
                    extend: 'excel',
                    className: 'btn-primary'
                }
            ],

            destroy: true,
            searching: false,
            autoWidth: false,
            retrieve: true,
            paging: false,
            sAjaxDataProp: "",
            responsive: true,
            info: false,
            order: [
                [1, "des"]
            ],
            rowId: 'NUMERO',

            columns: [{
                    "data": "NUMERO",
                    "defaultContent": "",
                    className: "text-center"
                },
                {
                    "data": "CHI_ULTIMA",
                    "defaultContent": "",
                    className: "text-center",
                    render: function(data, type) {
                        var dateSplitted = data.split(" ");
                        var date = dateSplitted[0].split("-").reverse().join("/");
                        var time = dateSplitted[1];
                        var span = '<span style="display: none"> ' + data + '</span>';
                        return span + date + ' ' + time;
                    }


                },
                {
                    "data": "CHI_USUARIO",
                    "defaultContent": ""
                },
                {
                    "data": "DESCRICAO",
                    "defaultContent": ""
                },
                {
                    "data": "PLANO",
                    "defaultContent": ""
                },
                {
                    "data": "STATUS",
                    "defaultContent": ""
                },
                {
                    "data": "PRIORIDADE",
                    "defaultContent": ""
                },
                {
                    "data": "TEMANEXO",
                    "defaultContent": "",
                    className: "text-center",
                    render: function(data, type) {
                        return data == 1 ? '<i class="fas fa-paperclip"></i>' : '';
                    }
                },
                {
                    "data": "TAPROVADO",
                    "defaultContent": "",
                    className: "text-center",
                    render: function(data, type) {
                        return data == 1 ? '<i class="fas fa-hand-holding-usd"></i>' : '';
                    }
                },
                {
                    "data": "TAVALIADO",
                    "defaultContent": "",
                    className: "text-center",
                    render: function(data, type) {
                        return data == 1 ? '<i class="fas fa-hand-holding-heart"></i>' : '';
                    }
                },
                {
                    "data": "ABERTURA",
                    "defaultContent": "",
                    className: "text-center",
                },
            ],
            columnDefs: [{
                    "width": "5%",
                    "targets": [0],
                },
                {
                    "width": "8%",
                    "targets": [1],
                },
                {
                    "width": "13%",
                    "targets": [2],
                },
                {
                    "width": "40%",
                    "targets": [3],
                },
                {
                    "width": "15%",
                    "targets": [4],
                },
                {
                    "width": "15%",
                    "targets": [5],
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).css('color', rowData.ABERTURA != 0 ? 'red' : 'black');
                    }
                },
                {
                    "width": "1%",
                    "targets": [6],
                },
                {
                    "width": "1%",
                    "targets": [7],
                },
                {
                    "width": "1%",
                    "targets": [8],
                },
                {
                    "width": "1%",
                    "targets": [9],
                },
                {
                    "targets": [10],
                    "visible": false
                },
            ],

        });

        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAlertaPjt = 'Selecione o plano de serviço.';
        var vAlertaPjf = 'Selecione a fase do plano de serviço.';
        var vAlertaGep = 'Selecione o gerente do projeto / plano de operação.';
        var vAlertaSol = 'Selecione o solicitante.';
        var vAlertaAtivo = 'Selecione para listar chamados ativos, inativos ou todos.';
        var vAlertaAbre = 'Data e hora da abertura ou última interação do chamado.';
        var vAlertaUsua = 'Usuário.\nUsuário do Sirius que fez a interação/abertura no chamado.';
        var vAlertaDesc = 'Descrição.\nDescrição da solicitação do chamado.';
        var vAlertaPlan = 'PPx.\nApelido do Plano de Serviço / Projeto.';
        var vAlertaStat = 'Status.\nStatus atual do chamado.';
        var vAlertaPrio = 'Prioridade.\nPrioridade / severidade atual do chamado:\n0 = nenhuma,\n1 = baixa,\n2 = normal,\n3 = alta.';
        var vAlertaAnex = 'Com anexo.\nO chamado terá anexo(s) se o mesmo icone estiver na linha.';
        var vAlertaApro = 'Orçamento aprovado.\nO chamado estará aprovado se o mesmo icone estiver na linha.';
        var vAlertaAval = 'Avaliado.\nO chamado estará avaliado se o mesmo icone estiver na linha.';

        setInputTextHints();

        $('#comboboxGep').change(function() {
            currentUrlParams = replaceQueryParam('selectedGep', this.value, currentUrlParams);
            currentUrlParams = replaceQueryParam('selectedPjt', "0", currentUrlParams);
            currentUrlParams = replaceQueryParam('selectedSol', "0", currentUrlParams);
            window.location = "<?= base_url('listaChamado'); ?>" + currentUrlParams
        });

        $('#comboboxPPx').change(function() {
            currentUrlParams = replaceQueryParam('selectedPjt', this.value, currentUrlParams);
            currentUrlParams = replaceQueryParam('selectedSol', "0", currentUrlParams);
            window.location = "<?= base_url('listaChamado'); ?>" + currentUrlParams
        });

        $('#comboboxSol').change(function() {
            currentUrlParams = replaceQueryParam('selectedSol', this.value, currentUrlParams);
            window.location = "<?= base_url('listaChamado'); ?>" + currentUrlParams
        });

        $('#optionboxAtivo').change(function() {
            currentUrlParams = replaceQueryParam('optionboxAtivo', this.value, currentUrlParams);
            window.location = "<?= base_url('listaChamado'); ?>" + currentUrlParams
        });

        function replaceQueryParam(param, newval, search) {
            var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
            var query = search.replace(regex, "$1").replace(/&$/, '');
            return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
        }

        function pesquisa_Tabela() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("inputTextFiltro");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableLista");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    let tdata = td[j];
                    if (tdata) {
                        if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }

        var $rows = $('#tableLista tbody tr');
        $('#inputTextFiltro').keyup(function() {
            pesquisa_Tabela();
        });

        function setInputTextHints() {
            $('#comboboxPPx').prop('title', vAlertaPjt);
            $('#comboboxGep').prop('title', vAlertaGep);
            $('#comboboxSol').prop('title', vAlertaSol);
            $('#optionboxAtivo').prop('title', vAlertaAtivo);

            $('#col02abre').prop('title', vAlertaAbre);
            $('#col10usua').prop('title', vAlertaUsua);
            $('#col03desc').prop('title', vAlertaDesc);
            $('#col04plan').prop('title', vAlertaPlan);
            $('#col05stat').prop('title', vAlertaStat);
            $('#col06prio').prop('title', vAlertaPrio);
            $('#col07anex').prop('title', vAlertaAnex);
            $('#col08apro').prop('title', vAlertaApro);
            $('#col09aval').prop('title', vAlertaAval);


            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }

        $('#tableLista tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            window.open('<?php echo base_url('detalheChamado/') ?>' + data.NUMERO, '_self');
        });
    </script>
</body>

</html>