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
    <title>Ogma Check Point</title>

    <?php $this->load->view('include/headerTop') ?>


    <style>

        #tableApontamentoHoras tbody tr {
      cursor: pointer;
    }

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
                        <h4 class="page-title">Relatório Check Point PPD </h4>
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

                                <div class="row mb-3">

                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label"> Plano Projeto (PPD) </label>
                                        <select class="form-control" id="comboboxPPx">
                                            <option> Listar todos os PPDs. </option>

                                            <?php foreach ($listaPjt as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['APELIDO'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <input type="checkbox" id="checkboxpAbreProjeto" >
                                        <label class="text-left" for="checkboxpAbreProjeto">Abre em atividades</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" id="checkboxIncluiFaturavel" checked >
                                        <label class="text-left" for="checkboxIncluiFaturavel">Inclui não faturável</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" id="checkboxSoServico" >
                                        <label class="text-left" for="checkboxSoServico">Só serviço</label>  
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" id="checkboxpPjtEmExecucao" checked >
                                        <label class="text-left" for="checkboxpPjtEmExecucao">Status de Execução</label>  
                                    </div>
                                    
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="buttonRelatorio"> Listar indicadores</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divRelatorio">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Indicadores </h4>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableRelatorio">
                                        <thead>
                                            <tr>

                                                <th id='col01descr'> Descrição</th>
                                                <th id='col02famil'> Família</th>
                                                <th id='col03esfor'> Esfco<br/>(h)*</th>
                                                <th id='col04ok'> Ok<br/>(%) </th>
                                                <th id='col05traba'> Trlho<br/>(h)</th>
                                                <th id='col06escrga'> Escrga<br/>(dias)</th>
                                                <th id='col07ev'> EV</th>
                                                <th id='col08preco'> Preço<br/>(R$)</th>
                                                <th id='col09custo'> Custo<br/>(R$)</th>
                                                <th id='col10lucra'> Lucrdde<br/>(%)</th>
                                                <th id='col11copia'> <i class="fas fa-copy"></i> </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                    <font face="tahoma" size="1">
                                        (*) Considera-se na lista e cálculos, apenas o esforço estimado nas atividades.
                                    </font>
                                    <br />
                                    <b>Versão: 01.20 - 23/03/2021</b><br/>
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
    <?php $this->load->view('modal/modalRelatorioApontamentoHora') ?>

    <script type="text/javascript">
        removeSpinner();
        setInputTextHints();

        $('#liGpo').addClass('selected');
        $('#liListaCeckPpd').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divRelatorio').hide();

        var arrayRelatorio = [];
        var table = $('#tableRelatorio').DataTable();
        var selectedPjt = null;

        $('#buttonRelatorio').click(function() {

            selectedPjt = ($('#comboboxPPx')[0].selectedIndex == 0) ? null : $('#comboboxPPx').val();
            
            var pAbreAtividade = $('#checkboxpAbreProjeto').is(":checked") ? 1 : 0;
            var pNaoFaturavel = $('#checkboxIncluiFaturavel').is(":checked") ? 1 : 0;
            var pSoServico = $('#checkboxSoServico').is(":checked") ? 1 : 0;
            var pPjtEmExecucao = $('#checkboxpPjtEmExecucao').is(":checked") ? 1 : 0;
            

            loadSpinner();
            $('#tableRelatorio').DataTable().clear().destroy();
            table = $('#tableRelatorio').DataTable({
                dom: 'Bfrtip',
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

                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/RelatorioPjtCheckPointPpd/fetchRelatorioPjtCheckPointPpd",
                    type: 'POST',
                    data: {
                        selectedPjt: selectedPjt,
                        pAbreAtividade: pAbreAtividade,
                        pNaoFaturavel: pNaoFaturavel,
                        pSoServico: pSoServico,
                        pPjtEmExecucao: pPjtEmExecucao
                    },
                    complete: function(response) {
                        arrayRelatorio = JSON.parse(response.responseText);
                        $('#divRelatorio').show();
                    }
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [1, "asc"]
                ],
                rowId: 'ID1',
                columns: [
                    {
                        "data": "DESCRICAO",
                        "defaultContent": ""
                    },
                    {
                        "data": "FAMILIA",
                        "defaultContent": ""
                    },
                    {
                        "data": "ESFCO (h)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "OK (%)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "TRLHO (h)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "ESCORREGA",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "EV",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "PRECO (R$)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "CUSTO (R$)",
                        "defaultContent": "",
                        className: "text-right"
                        // number_format($numero, 2, ',','.');
                    },
                    {
                        "data": "LUCRDDE (%)",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "TXT",
                        "defaultContent": "",
                        'render': function (data, type, row) {
                            var copyTapped = "copyTapped('" + row.TXT + "')";
                            return '<button class="btn btn-clear" id="' + row.id +'" onclick="' + copyTapped + '"> <i class="fas fa-copy"></i> </button>';
                        },
                        className: "text-right"
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
               
                columnDefs: [
                    {
                        'orderable': false,
                        'targets': 0
                    },
                    {
                        "width": "25%",
                        "targets": [0],

                    },
                    {
                        "width": "2%",
                        "targets": [10],

                    },
                ],
            });
        });
        
        function copyTapped(txt) {
            var $temp = $("<textarea>");
            $("body").append($temp);
            $temp.val(txt.replace(/\QQ/g, '\n')).select();
            document.execCommand("copy");
            $temp.remove();
            
            Swal.fire(
                'Aviso',
                'Linha copiada!',
                'success'
            )
        }

        function setInputTextHints() {
            $('#checkboxpAbreProjeto').prop('title', 'Deixe marcado se você selecionou um PPD e quiser listar as atividades dele.');
            $('#comboboxPPx').prop('title', 'Selecione um PPD específico para ver os indicadores apenas dele ou deixe em Listar todos.');
            $('#checkboxIncluiFaturavel').prop('title', 'Marque se quiser incluir as atividades setadas como isentas de faturamento na listagem.');
            $('#buttonRelatorio').prop('title', 'Clique para listar - clique também após cada alteração nas opções do cabeçalho.');
            $('#checkboxSoServico').prop('title', 'Marque se quiser excluir da listagem as atividades que não são de execução de serviços (gestão etc).');
            $('#checkboxpPjtEmExecucao').prop('title', 'Marque se quiser que apenas projetos em extatus de execução estejam na lista. Desmarque se quiser projetos em todos os status na lista, incluindo os concluídos');

            $('#col01descr').prop('title', 'Apelido do PPS ou Descrição da Atividade - dependendo da opção "Abre em atividades"');
            $('#col02famil').prop('title', 'Coluna da família: família da atividade.')        
            $('#col03esfor').prop('title', 'Coluna do esforço: esforço em horas estimado para o trabalho.');
            $('#col04ok').prop('title', 'Coluna do índice de aprontamento: percentual de aprontamento estimado.');
            $('#col05traba').prop('title', 'Coluna do trabalho: número de horas trabalhadas.');
            $('#col06escrga').prop('title', 'Coluna da taxa de escorregamento: dias de atraso entre o último dia trabalhado e a maior data prevista para término da atividade');
            $('#col07ev').prop('title', 'Coluna do índice de valor agregado: trabalho / esforço aprontado. \nPor convenção:\n- EV entre 0,75 e 1,25, indica andamento ideal do serviço;\n- EV menor que 0,75 indica provável atraso do serviço;\n- EV maior que 1,25 indica provável gasto demasiado no serviço.');
            $('#col08preco').prop('title', 'Coluna do preço: esforço X preço hora vendido para o cliente (investimento).');
            $('#col09custo').prop('title', 'Coluna do custo: trabalho X remuneração hora.');
            $('#col10lucra').prop('title', 'Coluna do índice da lucratividade: trabalho X remuneração hora / esforço X preço hora vendido.');
            $('#col11copia').prop('title', 'Clique no ícone da linha para copiá-la para a área de transferência');

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