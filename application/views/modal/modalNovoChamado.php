<!-- Modal -->

<div class="modal fade" id="modalNovoChamado" tabindex="-1" role="dialog" aria-labelledby="modalNovoChamadoLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoChamadoLabel"> Chamado </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">

                    <!-- <div class="row">
            <div class="col-12 text-right">
              <button class="btn btn-outline-success" id="btnChecklistCHV" data-toggle="tooltip"> CHV</button>
            </div>
          </div> -->

                    <div class="row mb-3">
                        <div class="col-2">
                            <label for="" class="text-left control-label col-form-label"> COD </label>
                            <input type="text" class="form-control" id="inputTextCHD_Codigo" disabled />
                        </div>

                        <div class="col-10">
                            <label for="" class="text-left control-label col-form-label">Descrição</label>
                            <input type="text" class="form-control" id="inputTextCHD_Descricao" />
                        </div>


                    </div>

                    <div class="row mb-3">
                        <div class="col-9">
                            <label for="" class="text-left control-label col-form-label"> Projeto / Fase </label>
                            <select class="form-control" id="comboboxCHD_PJFCodigo">
                            </select>
                        </div>

                        <div class="col-3">
                            <label for="" class="text-left control-label col-form-label"> Data Abertura </label>
                            <input type="text" class="form-control" id="inputTextCHD_MomAbertura" />
                        </div>
                    </div>

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

                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="" class="text-left control-label col-form-label"> Responsável Chamado </label>
                            <select class="form-control" id="comboboxCHD_CBRCodigo">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="inputTextCHD_QtHora" class="text-left control-label col-form-label"> Esforço previsto (horas) </label>
                            <input type="number" class="form-control" id="inputTextCHD_QtHora" />
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="" class="text-left control-label col-form-label"> Texto Solicitação </label>
                            <textarea class="form-control" rows="2" id="textAreaCHD_TextoSolicitacao"> </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6 ">
                            <label for="" class="text-left control-label col-form-label"> Fornecedor de Requisitos </label>
                            <select class="form-control" id="comboboxCHD_PFR_Codigo">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="" class="text-left control-label col-form-label"> Chamado Associado </label>
                            <input type="text" class="form-control" id="inputTextCHD_CHDCodigoAssociado" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="inputTextCHD_MomNovoStatus" class="text-left control-label col-form-label"> Momento Novo
                                Status </label>
                            <input type="text" class="form-control" id="inputTextCHD_MomNovoStatus" />
                        </div>

                        <div class="col-6">
                            <label for="inputTextCHD_MomAprvcao" class="text-left control-label col-form-label"> Momento Aprovação Serviço </label>
                            <input type="text" class="form-control" id="inputTextCHD_MomAprvcao" />
                        </div>

                    </div>


                    <div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarChamado">Salvar</button>
                </div>

            </div>
        </div>
    </div>


    <script type="text/javascript">
        // $('#btnChecklistCHV').click(function() {

        //   selectedCKL_ProcedCodigoAcro = "CHV";
        //   selectedCKL_CGOCodigo = 8;
        //   selectedCKL_ProcedCodigo = selectedChamado["CHD_Codigo"];

        //   $('#modalChecklist').modal('show');

        // });

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

        // function fetchContatoDetalhe() {
        //     return $.ajax({
        //         url: "<?php echo base_url(); ?>defaults/defaults/fetchContatoDetalhe",
        //         dataType: 'json'
        //     });
        // }

        function fetchFasesDetalhes() {
            return $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/fetchFasesDetalhes",
                dataType: 'json'

            });
        }

         // FETCHING fetchogma_PES_Selecao02  --------------------------------------------------------------------------------------
        var jsonArrayogma_PES_Selecao02 = JSON.parse(localStorage.arrayogma_PES_Selecao02);
        var htmlogma_PES_Selecao02 = [];
        htmlogma_PES_Selecao02.push('<option>Selecione um fornecedor de requisito...</option>');
        for (var i = 0; i <= jsonArrayogma_PES_Selecao02.length - 1; i++) {
        htmlogma_PES_Selecao02.push('<option value="' + jsonArrayogma_PES_Selecao02[i].CODIGO + '">' + jsonArrayogma_PES_Selecao02[i].PESSOA + '</option>');
        }
        optionsogma_PES_Selecao02 = htmlogma_PES_Selecao02;
        // -----------------------------------------------------------------------------------------------------

        $('#inputTextCHD_MomNovoStatus, #inputTextCHD_MomAbertura, #inputTextCHD_MomAprvcao').datetimepicker({

            ownerDocument: document,
            contentWindow: window,

            value: '',
            rtl: false,

            format: 'd/m/Y H:i',
            formatTime: 'H:i',
            formatDate: 'd/m/Y',

            startDate: false, // new Date(), '1986/12/08', '-1970/01/05','-1970/01/05',
            step: 30,
            monthChangeSpinner: true,

            closeOnDateSelect: false,
            closeOnTimeSelect: true,
            closeOnWithoutClick: true,
            closeOnInputClick: true,
            openOnFocus: true,

            timepicker: true,
            datepicker: true,
            weeks: false,

            defaultTime: false, // use formatTime format (ex. '10:00' for formatTime: 'H:i')
            defaultDate: false, // use formatDate format (ex new Date() or '1986/12/08' or '-1970/01/05' or '-1970/01/05')

            minDate: false,
            maxDate: false,
            minTime: false,
            maxTime: false,
            minDateTime: false,
            maxDateTime: false,

            allowTimes: [],
            opened: false,
            initTime: true,
            inline: false,
            theme: '',
            touchMovedThreshold: 5,

            onSelectDate: function() {},
            onSelectTime: function() {},
            onChangeMonth: function() {},
            onGetWeekOfYear: function() {},
            onChangeYear: function() {},
            onChangeDateTime: function() {},
            onShow: function() {},
            onClose: function() {},
            onGenerate: function() {},

            withoutCopyright: true,
            inverseButton: false,
            hours12: false,
            next: 'xdsoft_next',
            prev: 'xdsoft_prev',
            dayOfWeekStart: 0,
            parentID: 'body',
            timeHeightInTimePicker: 25,
            // timepicker<a href="https://www.jqueryscript.net/tags.php?/Scroll/">Scroll</a>bar: true,
            todayButton: true,
            prevButton: true,
            nextButton: true,
            defaultSelect: true,

            scrollMonth: true,
            scrollTime: true,
            scrollInput: true,

            lazyInit: false,
            mask: false,
            validateOnBlur: true,
            allowBlank: true,
            yearStart: 1950,
            yearEnd: 2050,
            monthStart: 0,
            monthEnd: 11,
            style: '',
            id: '',
            fixed: false,
            roundTime: 'round', // ceil, floor
            className: '',
            weekends: [],
            highlightedDates: [],
            highlightedPeriods: [],
            allowDates: [],
            allowDateRe: null,
            disabledDates: [],
            disabledWeekDays: [],
            yearOffset: 0,
            beforeShowDay: null,

            enterLikeTab: true,
            showApplyButton: false
        });


        $("#comboboxCHD_PJFCodigo").change(function() {

            fetchCBRFase($(this).val());
            $('#comboboxCHD_CBRCodigo').val("none");

        });

        function fetchCBRFase(PJF_CODIGO) {

            $('#divAlertReturn').attr("class", "alert alert-primary");
            $('#divAlertReturn').text("Carregando colaboradores alocados...");

            $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/fetchCBRFase",
                type: 'POST',
                dataType: 'json',
                data: {
                    PJF_CODIGO: PJF_CODIGO

                },
                success: function(data) {
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
                error: function(request, status, error) {
                    console.log(request);
                }
            });
        }

        $('#modalNovoChamado').on('hidden.bs.modal', function(e) {

            $('#inputTextCHD_Codigo').val("");
            $('#inputTextCHD_Descricao').val("");
            $('#comboboxCHD_PJFCodigo').val("none");
            $('#inputTextCHD_MomAbertura').val("");

            $('#inputTextCHD_QtHora').val("");

            $('#comboboxCHD_CHPCodigo').val("none");

            $('#comboboxCHD_CHCCodigo').val("none");
            $('#comboboxCHD_STCCodigo').val("none");
            $('#textAreaCHD_TextoSolicitacao').val("");

            $('#inputTextCHD_MomNovoStatus').val("");
            $('#inputTextCHD_MomAprvcao').val("");

            $('#comboboxCHD_PFR_Codigo').val("none");
            $('#comboboxCHD_CBRCodigo').val("none");
            // $('#inputTextCHD_AvalGrauSatisfacao').val("");
            // $('#inputTextCHD_AvalParecer').val("");
            $('#inputTextCHD_CHDCodigoAssociado').val("");

            $('#divAlertReturn').attr("class", "alert alert-light");
            $('#divAlertReturn').html("&nbsp;");
        });

        $('#modalNovoChamado').on('show.bs.modal', function(e) {
            var htmlComboboxCBR = [];
            htmlComboboxCBR.push('<option value="none"> Selecione </option>');
            $('#comboboxCHD_CBRCodigo').html(htmlComboboxCBR);

        });


        $.when(fetchStatusChamado(), fetchPrioridadeChamado(), fetchCategoriaChamado(), fetchColaboradores(), fetchFasesDetalhes()).done(function(r1, r2, r3, r4, r6) {

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


            // var htmlFornecedorRequisito = [];
            // htmlFornecedorRequisito.push('<option value="none"> Selecione </option>');
            // htmlFornecedorRequisito.push('<optgroup label="Pessoa wD">');
            // for (var i = r4[0].length - 1; i >= 0; i--) {
            //     htmlFornecedorRequisito.push('<option value="' + r4[0][i].CODIGO + '">' + r4[0][i].COLABORADOR + '</option>');
            // }
            // htmlFornecedorRequisito.push('</optgroup>');
            // htmlFornecedorRequisito.push('<optgroup label="Credenciado do Cliente">');
            // for (var i = r5[0].length - 1; i >= 0; i--) {
            //     htmlFornecedorRequisito.push('<option value="' + r5[0][i].a006_cd_contato + '">' + r5[0][i].a006_nm_contato + '</option>');
            // }
            // htmlFornecedorRequisito.push('</optgroup>');
            // $('#comboboxCHD_PFR_Codigo').html(htmlFornecedorRequisito);
            $('#comboboxCHD_PFR_Codigo').html(optionsogma_PES_Selecao02);

            var htmlComboboxFasesChamado = [];
            htmlComboboxFasesChamado.push('<option value="none"> Selecione </option>');
            for (var i = 0; i <= r6[0].length - 1; i++) {
                htmlComboboxFasesChamado.push('<option value="' + r6[0][i].PJF_CODIGO + '">' + r6[0][i].PJT_CODIGO + ' / ' + r6[0][i].PJF_ORDEMFASE + ' - ' + r6[0][i].PJT_APELIDO + '</option>');
            }
            $('#comboboxCHD_PJFCodigo').html(htmlComboboxFasesChamado)
        });
        //
        // $('#inputTextCHD_MomAbertura').datepicker({
        //     autoclose: true,
        //     todayHighlight: true,
        //     format: "dd/mm/yyyy",
        //     orientation: "bottom",
        //     maxViewMode: 1
        // });

        $('#btnSalvarChamado').click(function() {

            var CHD_CBRCodigo = $('#comboboxCHD_CBRCodigo').val();
            var CHD_Codigo = $('#inputTextCHD_Codigo').val();
            var CHD_Descricao = $('#inputTextCHD_Descricao').val();
            var CHD_PJFCodigo = $('#comboboxCHD_PJFCodigo').val();
            var CHD_QtHora = $('#inputTextCHD_QtHora').val();

            var CHD_MomAbertura = "";

            if ($('#inputTextCHD_MomAbertura').val() != "") {
                var CHD_MomAberturaDateTime = $('#inputTextCHD_MomAbertura').val().split(" ");
                CHD_MomAbertura = CHD_MomAberturaDateTime[0].split("/").reverse().join("-") + " " + CHD_MomAberturaDateTime[1] + ":00";
            }

            var CHD_CHPCodigo = $('#comboboxCHD_CHPCodigo').val();
            var CHD_CHCCodigo = $('#comboboxCHD_CHCCodigo').val();
            var CHD_STCCodigo = $('#comboboxCHD_STCCodigo').val();
            var CHD_TextoSolicitacao = $('#textAreaCHD_TextoSolicitacao').val();


            var CHD_MomNovoStatus = null;
            if ($('#inputTextCHD_MomNovoStatus').val() != "") {
                var CHD_MomNovoStatusDateTime = $('#inputTextCHD_MomNovoStatus').val().split(" ");
                CHD_MomNovoStatus = CHD_MomNovoStatusDateTime[0].split("/").reverse().join("-") + " " + CHD_MomNovoStatusDateTime[1] + ":00";
            }
            
            // var CHD_MomNovoStatusDateTime = $('#inputTextCHD_MomNovoStatus').val().split(" ");
            // var CHD_MomNovoStatus = CHD_MomNovoStatusDateTime[0].split("/").reverse().join("-") + " " + CHD_MomNovoStatusDateTime[1] + ":00";

            var CHD_MomAprvcao = null;
            if ($('#inputTextCHD_MomAprvcao').val() != "") {
                var CHD_MomAprvcaoDateTime = $('#inputTextCHD_MomAprvcao').val().split(" ");
                CHD_MomAprvcao = CHD_MomAprvcaoDateTime[0].split("/").reverse().join("-") + " " + CHD_MomAprvcaoDateTime[1] + ":00";
            }
            
            
            // var CHD_MomAprvcaoDateTime = $('#inputTextCHD_MomAprvcao').val().split(" ");
            // var CHD_MomAprvcao = CHD_MomAprvcaoDateTime[0].split("/").reverse().join("-") + " " + CHD_MomAprvcaoDateTime[1] + ":00";

            var CHD_PFR_Codigo = $('#comboboxCHD_PFR_Codigo').val();
            // var CHD_AvalGrauSatisfacao = $('#inputTextCHD_AvalGrauSatisfacao').val();
            // var CHD_AvalParecer = $('#inputTextCHD_AvalParecer').val();
            var CHD_CHDCodigoAssociado = $('#inputTextCHD_CHDCodigoAssociado').val();

            var CHD_USUCodigo = "<?= $this->session->userdata('userCodigo'); ?>";


            if (CHD_Descricao == "" || CHD_PJFCodigo == "none" || CHD_MomAbertura == "" ||
                CHD_CHPCodigo == "none" || CHD_CHCCodigo == "none" || CHD_STCCodigo == "none" ||
                CHD_TextoSolicitacao == "" || CHD_PFR_Codigo == "none") {

                $('#divAlertReturn').attr("class", "alert alert-danger");
                $('#divAlertReturn').text("Necessário preencher os campos obrigatórios!");
                return;
            }

            $('#divAlertReturn').attr("class", "alert alert-primary");
            $('#divAlertReturn').text("Carregando...");


            $.ajax({
                url: "<?php echo base_url(); ?>defaults/defaults/updateChamado",
                type: 'POST',
                data: {
                    CHD_Codigo: CHD_Codigo,
                    CHD_Descricao: CHD_Descricao,
                    CHD_PJFCodigo: CHD_PJFCodigo,
                    CHD_MomAbertura: CHD_MomAbertura,
                    CHD_CHPCodigo: CHD_CHPCodigo,
                    CHD_CHCCodigo: CHD_CHCCodigo,
                    CHD_STCCodigo: CHD_STCCodigo,
                    CHD_TextoSolicitacao: CHD_TextoSolicitacao,
                    CHD_PFR_Codigo: CHD_PFR_Codigo,
                    CHD_MomNovoStatus: CHD_MomNovoStatus,
                    CHD_MomAprvcao: CHD_MomAprvcao,
                    CHD_CBRCodigo: CHD_CBRCodigo,
                    CHD_QtHora: CHD_QtHora,
                    CHD_CHDCodigoAssociado: CHD_CHDCodigoAssociado,
                    CHD_USUCodigo: CHD_USUCodigo

                },
                success: function(data) {
                    $('#divAlertReturn').attr("class", "alert alert-success");
                    $('#divAlertReturn').text("Salvo!");
                    $('#modalNovoChamado').modal('hide');
                    // table.ajax.reload();
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }

            });


        });
    </script> 