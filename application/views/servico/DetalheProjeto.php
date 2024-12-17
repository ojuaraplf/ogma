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

    <style type="text/css">
        .spanDetalheProjetoTitulo {
            font-size: 14px;
            font-weight: bold;
        }

        .spanDetalheProjetoConteudo {
            font-size: 14px;
        }

        .rowProjeto {
            cursor: pointer;
        }

        html {
            visibility: hidden;
        }
    </style>
</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">


        <?php $this->load->view('include/navbarProjeto') ?>
        <?php $this->load->view('include/asidebar') ?>


        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Plano de Serviço <span id="spanNumeroProjeto"> - </span></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('listaProjeto/'); ?>">Planos de Serviço</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detalhe Plano de Serviço</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">


                                <div class="row mb-3">

                                    <div class="col-10">
                                        <h4 class="card-title" id="spanPJT_APELIDO"> - </h4>
                                        <!-- <h4 class="card-title">Detalhes do Projeto</h4>	 -->
                                    </div>
                                    <div class="col-2 text-right">
                                        <!-- <button class="btn btn-primary" id="btnImprimirProjeto">Imprimir</button> -->
                                        <button class="btn btn-primary" id="btnEditarProjeto">Editar</button>
                                    </div>

                                </div>

                                <!-- <br /> -->
                                <div class="border-top"></div>
                                <br />

                                <div class="row">
                                    <div class="col-6">
                                        <span class="spanDetalheProjetoTitulo" id="labelCSI_AcronimoPlanoServico"> - </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_TITULO"> - </span>
                                    </div>
                                    <div class="col-2">
                                        <span class="spanDetalheProjetoTitulo"> Cliente: </span><br /><span class="spanDetalheProjetoConteudo" id="spanCLI_NOMEFANTASIA"> - </span>
                                        <br />
                                    </div>
                                    <div class="col-2">
                                        <span class="spanDetalheProjetoTitulo"> Data Início: </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATAINICIO"> - </span>
                                    </div>
                                    <div class="col-2">
                                        <span class="spanDetalheProjetoTitulo"> Data Término: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_DATATERMINO"> - </span>
                                    </div>
                                    <!-- <div class="col-6">
                  <span class="spanDetalheProjetoTitulo"> Apelido: </span><br /> <span class="spanDetalheProjetoTitulo" id="spanPJT_APELIDO"> - </span>
                </div> -->
                                </div>
                                <br />
                                <div class="border-top"></div>
                                <br />
                                <div class="row">
                                    <div class="col-4">
                                        <span class="spanDetalheProjetoTitulo"> Gestor da Conta: </span> <br /><span class="spanDetalheProjetoConteudo" id="spanCBR_CODIGO"> - </span>
                                    </div>
                                    <!-- <div class="col-4">
                    <span class="spanDetalheProjetoTitulo"> Tecnologia BI: </span><br /><span class="spanDetalheProjetoConteudo" id="spanPJT_TECNOLOGIA"> - </span>
                  </div> -->
                                    <div class="col-4">
                                        <span class="spanDetalheProjetoTitulo"> Esforço (h): </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_QTHORA"> - </span>
                                    </div>
                                    <div class="col-4">
                                        <span class="spanDetalheProjetoTitulo"> Vr. Hora: </span> <br /><span class="spanDetalheProjetoConteudo" id="spanPJT_VRHORA"> - </span>
                                    </div>
                                </div>

                                <br />
                                <!-- <div class="border-top"></div> -->
                                <!-- <br />
                <div class="row">
                  <div class="col-12">
                    <span class="spanDetalheProjetoTitulo"> Pano de comunicação: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanPJT_PLACOMUNICACAO"> - </span>
                  </div>
                </div>


                <br /> -->
                                <div class="border-top"></div>
                                <br />


                                <div class="row">
                                    <div class="col-12">
                                        <span class="spanDetalheProjetoTitulo"> Total de horas já apontadas: </span><br /> <span class="spanDetalheProjetoConteudo" id="spanTotalHorasApontadas"> - </span>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-10">
                                        <h4 class="card-title">Fase(s)</h4>
                                    </div>


                                    <div class="col-2 text-right">
                                        <button class="btn btn-primary" id="btnModalNovaFase">Nova Fase</button>

                                    </div>

                                </div>


                                <br />
                                <div class="table-responsive">
                                    <table id="tableFaseProjeto" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Fase</th>
                                                <th>Identificação</th>
                                                <th>Inicio</th>
                                                <th>Término</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                © 2019 wDiscovery Ltda.
            </footer>
        </div>


    </div>


    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>
    <?php $this->load->view('modal/modalNovaFase') ?>


    <script type="text/javascript">
        // PROJETO	IDFASE	IDENTIFICACAOFASE	AtividadeID	Descricao atividade	QTDADE	PERCENTUAL


        $('#liServico').addClass('selected');
        $('#liServicoProjeto').addClass('active');
        $('#ulServico').addClass('in');

        var lastFaseDate = null;
        loadSpinner();



        $("#btnImprimirProjeto").click(function() {
            $('#modalImprimirProjeto').modal('show');

            // $('#main-wrapper').hide();
            // $('#pageToPrint').removeAttr('hidden');

            // window.open('<?php echo base_url('adicionarEditarFase/'); ?>' + <?php echo $this->uri->segment(2); ?> , '_self');
        });


        $('#spanNumeroProjeto').text(<?php echo $this->uri->segment(2); ?>);

        $.when(fetchProjetoCreated(), fetchFaseProjeto(), fetchTotalHorasApontadas()).done(function(r1, r2, r3) {


            var json_array_ogm_catalogoservicoitem = JSON.parse(localStorage.array_ogm_catalogoservicoitem);
            $('#labelCSI_AcronimoPlanoServico').text("Nome do " + json_array_ogm_catalogoservicoitem[getArrayIndexForKey(json_array_ogm_catalogoservicoitem, "CSI_CODIGO", r1[0].PJT_ITEMCAS)].CSI_AcronimoPlanoServico + ":");





            $('#spanPJT_TITULO').text(r1[0].PJT_TITULO);
            $('#spanPJT_APELIDO').text(r1[0].PJT_APELIDO);
            $('#spanCBR_CODIGO').text(r1[0].COLABORADOR);
            // $('#spanPJT_TECNOLOGIA').text(r1[0].PJT_TECNOLOGIA);
            $('#spanPJT_QTHORA').text(r1[0].PJT_QTHORA);


            if (r3[0] != "") {
                $('#spanTotalHorasApontadas').text(r3[0]);
            }



            if (r1[0].PJT_VRHORA != null) {
                $('#spanPJT_VRHORA').text('R$ ' + r1[0].PJT_VRHORA.replace('.', ','));
            }

            if (r1[0].PJT_DATATERMINO != null) {
                $('#spanPJT_DATATERMINO').text(r1[0].PJT_DATATERMINO.split("-").reverse().join("/"));
            }
            if (r1[0].PJT_DATAINICIO != null) {
                $('#spanPJT_DATAINICIO').text(r1[0].PJT_DATAINICIO.split("-").reverse().join("/"));
            }
            $('#spanCLI_CODIGO').text(r1[0].a004_razao_social);
            $('#spanCLI_NOMEFANTASIA').text(r1[0].a004_nm_fantasia);
            // $('#spanPJT_PLACOMUNICACAO').text(r1[0].PJT_PLACOMUNICACAO);

            var html = "";
            for (var i = r2[0].length - 1; i >= 0; i--) {
                html += '<tr class="rowProjeto" id="' + r2[0][i].PJF_CODIGO + '">';
                html += '<td>' + r2[0][i].PJF_ORDEMFASE + '</td>';
                html += '<td>' + r2[0][i].PJF_IDENTIFICACAOFASE + '</td>';

                if (r2[0][i].PJF_DATAINICIO == null) {
                    html += '<td> - </td>';
                } else {
                    html += '<td>' + r2[0][i].PJF_DATAINICIO.split("-").reverse().join("/") + '</td>';
                }
                if (r2[0][i].PJF_DATATERMINO == null) {
                    html += '<td> - </td>';
                } else {
                    html += '<td>' + r2[0][i].PJF_DATATERMINO.split("-").reverse().join("/") + '</td>';
                }
                html += '<td>  </td>';
                html += '<tr>';

                lastFaseDate = r2[0][i].PJF_DATATERMINO;
            }
            $('#tableFaseProjeto tbody').html(html)

            removeSpinner();
        });


        $('#btnVoltarParaLista').click(function() {
            window.open('<?php echo base_url("listaProjeto/"); ?>', '_self');
        });


        $("#btnEditarProjeto").click(function() {
            window.open('<?php echo base_url("editarProjeto/"); ?>' + <?php echo $this->uri->segment(2); ?>, '_self');
        });


        $(document).on('click', '.rowProjeto', function() {
            window.open('<?php echo base_url("editarFase/") ?>' + <?php echo $this->uri->segment(2); ?> + '/' + $(this).attr("id"), '_self');
        });

        $("#btnModalNovaFase").click(function() {


            $('#modalNovaFase').modal('show');
        });


        function fetchFaseProjeto() {
            return $.ajax({
                url: "<?php echo base_url(); ?>detalheProjeto/fetchFaseProjeto",
                type: 'POST',
                dataType: 'json',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                }

            });
        }

        function fetchTotalHorasApontadas() {
            return $.ajax({
                url: "<?php echo base_url(); ?>detalheProjeto/fetchTotalHorasApontadas",
                type: 'POST',
                dataType: 'text',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                }

            });
        }


        function fetchProjetoCreated() {
            return $.ajax({
                url: "<?php echo base_url(); ?>detalheProjeto/fetchProjetoCreated",
                type: 'POST',
                data: {
                    PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
                },
                dataType: "json"
            });
        }

        function mascaraValor(valor) {
            valor = valor.toString().replace(/\D/g, "");
            valor = valor.toString().replace(/(\d)(\d{8})$/, "$1.$2");
            valor = valor.toString().replace(/(\d)(\d{5})$/, "$1.$2");
            valor = valor.toString().replace(/(\d)(\d{2})$/, "$1,$2");
            return valor
        }
    </script>
</body>

</html> 