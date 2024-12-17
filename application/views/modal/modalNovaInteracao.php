<!-- Modal -->

<div class="modal fade" id="modalNovaInteracao" tabindex="-1" role="dialog" aria-labelledby="modalNovaInteracaoLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovaInteracaoLabel"> Interação </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row mb-4">
                        <div class="col-4">
                            <label for="" class="text-left control-label col-form-label"> Prioridade </label>
                            <select class="form-control" id="comboboxCHD_CHPCodigo">
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="text-left control-label col-form-label"> Categoria </label>
                            <select class="form-control" id="comboboxCHD_CHCCodigo">
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="comboboxCHD_STCCodigo" class="text-left control-label col-form-label"> Status Chamado </label>
                            <select class="form-control" id="comboboxCHD_STCCodigo">
                            </select>
                        </div>
                    </div>

        </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="" class="text-left control-label col-form-label"> Responsável Chamado </label>
                            <select class="form-control" id="comboboxCHD_CBRCodigo">
                            </select>
                        </div>
                        <div class="col-6 ">
                            <label for="" class="text-left control-label col-form-label"> Fornecedor de Requisitos </label>
                            <select class="form-control" id="comboboxCHD_PFR_Codigo">
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6 ">
                            <label for="" class="text-left control-label col-form-label"> Esforço previsto/orçamento </label>
                            <input type="number" class="form-control" id="inputTextCHI_QtHora" />
                        </div>
                    </div>



                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="" class="text-left control-label col-form-label"> Texto Solicitação </label>
                            <textarea class="form-control" rows="2" id="textAreaCHI_TextoSolicitacao"> </textarea>
                        </div>
                    </div>
                    <div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnNovaInteracao">Salvar</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
       
        function fetchStatusChamado() {
            return $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/fetchStatusChamado",
                dataType: 'json'
            });
        }

        function fetchPrioridadeChamado() {
            return $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/fetchPrioridadeChamado",
                dataType: 'json'
            });
        }

        function fetchCategoriaChamado() {
            return $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/fetchCategoriaChamado",
                dataType: 'json'
            });
        }

        function fetchColaboradores() {
            return $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/fetchColaboradores",
                dataType: 'json'
            });
        }

        function fetchCBRFase(PJF_CODIGO) {

            $('#divAlertReturn').attr("class", "alert alert-primary");
            $('#divAlertReturn').text("Carregando colaboradores alocados...");
            console.log('CAIU AQUI');
            $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/fetchCBRFase",
                type: 'POST',
                dataType: 'json',
                data: {
                    PJF_CODIGO: PJF_CODIGO

                },
                success: function(data) {

                    // console.log(data);
                    // console.log('CAIU AQUI');

                    var htmlComboboxCBR = [];
                    htmlComboboxCBR.push('<option value="none"> Selecione </option>');
                    for (var i = 0; i <= data.length - 1; i++) {
                        htmlComboboxCBR.push('<option value="' + data[i].CODIGO + '">' + data[i].NOME + '</option>');
                    }
                    $('#comboboxCHD_CBRCodigo').html(htmlComboboxCBR);

                    if (selectedChamado.CHD_CBRCodigo == null) {
                        $('#comboboxCHD_CBRCodigo').val("none");
                    } else {
                        $('#comboboxCHD_CBRCodigo').val(selectedChamado.CHD_CBRCodigo);
                    }


                    $('#comboboxCHD_CBRCodigo').change();

                    $('#divAlertReturn').attr("class", "alert alert-light");
                    $('#divAlertReturn').text("\xa0");

                },
                error: function(x) {
                    console.log(x.responseText);
                }
            });
        }


        $('#modalNovaInteracao').on('hidden.bs.modal', function(e) {

            $('#comboboxCHD_CHPCodigo').val();
            $('#comboboxCHD_CHCCodigo').val();
            $('#comboboxCHD_STCCodigo').val();
            $('#comboboxCHD_CBRCodigo').val();
            $('#comboboxCHD_PFR_Codigo').val();
            $('#comboboxCHI_USUCodigo').val();


            $('#inputTextCHI_QtHora').val("");
            $('#textAreaCHI_TextoSolicitacao').val("");
            $('#inputTextCHI_MomentoInteracao').val("");

            $('#divAlertReturn').attr("class", "alert alert-light");
            $('#divAlertReturn').html("&nbsp;");
        });


        $.when(fetchStatusChamado(), fetchPrioridadeChamado(), fetchCategoriaChamado(), fetchColaboradores()).done(function(r1, r2, r3, r4) {

            var htmlComboboxStatus = [];
            htmlComboboxStatus.push('<option value="none"> Selecione </option>');
            for (var i = 0; i <= r1[0].length - 1; i++) {
                htmlComboboxStatus.push('<option value="' + r1[0][i].STC_Codigo + '">' + r1[0][i].STC_Descricao + '</option>');
            }
            $('#comboboxCHD_STCCodigo').html(htmlComboboxStatus);


            var htmlComboboxPrioridade = [];
            htmlComboboxPrioridade.push('<option value="none"> Selecione </option>');
            for (var i = 0; i <= r2[0].length - 1; i++) {
                htmlComboboxPrioridade.push('<option value="' + r2[0][i].CHP_Codigo + '">' + r2[0][i].CHP_Descricao + '</option>');
            }
            $('#comboboxCHD_CHPCodigo').html(htmlComboboxPrioridade);


            var htmlComboboxCategoria = [];
            htmlComboboxCategoria.push('<option value="none"> Selecione </option>');
            for (var i = 0; i <= r3[0].length - 1; i++) {
                htmlComboboxCategoria.push('<option value="' + r3[0][i].CHC_Codigo + '">' + r3[0][i].CHC_Descricao + '</option>');
            }
            $('#comboboxCHD_CHCCodigo').html(htmlComboboxCategoria);
        });

        $('#inputTextCHI_MomentoInteracao').change(function() {
            $('#inputTextCHI_MomentoInteracao').removeClass('is-invalid');
        });

        $('#btnNovaInteracao').click(function() {
            var CHD_CHPCodigo = $('#comboboxCHD_CHPCodigo').val();
            var CHD_CHCCodigo = $('#comboboxCHD_CHCCodigo').val();
            var CHD_STCCodigo = $('#comboboxCHD_STCCodigo').val();
            var CHD_CBRCodigo = $('#comboboxCHD_CBRCodigo').val();
            var CHD_PFR_Codigo = $('#comboboxCHD_PFR_Codigo').val();
            var CHI_TextoSolicitacao = $('#textAreaCHI_TextoSolicitacao').val();
            var CHI_QtHora = $('#inputTextCHI_QtHora').val();
            var CHI_USUCodigo = "<?= $this->session->userdata('userCodigo'); ?>";

            if ($('#inputTextCHI_MomentoInteracao').val() == "") {
                $('#inputTextCHI_MomentoInteracao').addClass('is-invalid');
                return;
            }

            $('#divAlertReturn').attr("class", "alert alert-primary");
            $('#divAlertReturn').text("Carregando...");

            $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/novaInteracao",
                type: 'POST',
                data: {
                    CHD_CHPCodigo: CHD_CHPCodigo,
                    CHD_CHCCodigo: CHD_CHCCodigo,
                    CHD_STCCodigo: CHD_STCCodigo,
                    CHD_CBRCodigo: CHD_CBRCodigo,
                    CHD_PFR_Codigo: CHD_PFR_Codigo,
                    CHI_QtHora: CHI_QtHora,
                    CHI_USUCodigo: CHI_USUCodigo,
                    CHI_CHDCodigo: <?php echo $this->uri->segment(2); ?>,
                    CHI_TextoSolicitacao: CHI_TextoSolicitacao,
                },
                success: function(data) {
                    $('#divAlertReturn').attr("class", "alert alert-success");
                    $('#divAlertReturn').text("Salvo!");

                    $.when(fetchChamado(), fetchChamadoInteracao()).done(function(r1, r2) {
                        $("#divCabecalhoChamado").html(Handlebars.compile($('#cabecalhoChamado').html())({
                            chamado: r1[0]
                        }));
                        $("#divInteracoes").html(Handlebars.compile($('#cellInteracao').html())({
                            interacoes: r2[0]
                        }));
                        $('#modalNovaInteracao').modal('hide')
                    });
                }
            });
        });
    </script> 