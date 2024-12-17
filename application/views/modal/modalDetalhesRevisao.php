<!-- Modal -->
<div class="modal fade" id="modalDetalhesRevisao" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesRevisaoLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetalhesRevisaoLabel"> Detalhes Monitoramento </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">

          <div class="row">
            <div class="col-6">
              <label for="inputTextPJM_DataDaAgendaRevisao" class="col-form-label"> Data: </label>
              <input type="text" class="form-control" id="inputTextPJM_DataDaAgendaRevisao" disabled />
            </div>
            <div class="col-6">
              <label for="" class="col-form-label"> Espécie: </label>
              <input type="text" class="form-control" id="inputTextPJM_ERMCodigo" disabled />
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="" class="col-form-label"> Descrição: </label>
              <input type="text" class="form-control" id="inputTextPJM_mDescricaoDaRevisao" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="textAreaIndicadores" class="col-form-label"> Indicadores: </label>
              <textarea class="form-control" rows="5" id="textAreaIndicadores" disabled></textarea>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-8">
              <button type="button" class="btn btn-primary" id="buttonGerarIndicadores"> Gerar Indicadores</button>
              <button type="button" class="btn btn-primary" id="buttonConcluirRevisao"> Concluir Revisão</button>
            </div>

            <div class="col-4 text-right">
              <button class="btn btn-outline-success" id="btnChecklistMON" data-toggle="tooltip"> MON</button>
              <button class="btn btn-outline-success" id="btnChecklistMAR" data-toggle="tooltip"> MAR</button>
            </div>
          </div>


          <div class="row">
            <div class="col-6">
              <label for="textAreaPJM_ParecerGQ" class="col-form-label"> Parecer GQ: </label>
              <textarea class="form-control" rows="4" id="textAreaPJM_ParecerGQ"></textarea>
            </div>
            <div class="col-6">
              <label for="textAreaPJM_ParecerGP" class="col-form-label"> Parecer GP: </label>
              <textarea class="form-control" rows="4" id="textAreaPJM_ParecerGP"></textarea>
            </div>
          </div>


        </div>

        <div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" id="btnSalvarDetalheRevisao">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  fetchChecklistDescricao();

  // $('#btnChecklistMON').prop('title', "KKKKKKK");

  function fetchChecklistDescricao() {
    $.ajax({
      url: "<?php echo base_url(); ?>defaults/defaults/fetchChecklistDescricao",
      dataType: 'json',
      type: 'POST',
      data: {
        arrayProcedimento: [
          ['MON', '00.00'],
          ['MAR', '00.00']
        ],
      },
      success: function(data) {
        console.log(data);
        $("#btnChecklistMON").attr('data-original-title', data["MON"]);
        $("#btnChecklistMAR").attr('data-original-title', data["MAR"]);


      },
      error: function (request, status, error) {
        console.log(request.responseText);
    }
    });

  }
  // setInputTextHints();
  // function setInputTextHints() {
  //       $('#btnChecklistMON').prop('title', 'Uma identificação do projeto que lhe dê personalidade. Um texto contendo a essência do serviço a ser prestado e para quem. Compô-lo em duas partes, uma mais genérica e outra específica, pode ajudar. Por exemplo: Painéis Tableau PRALIM: indicadores para o setor de compras.');
  //       $('#btnChecklistMAR').prop('title', 'Um apelido que o identifique univocamente – seu Id descritivo – no formato: “0000 PPx CLIRED TITRED” – onde: “0000” é o código do projeto, o número sequencial que o identifica no OGMA; “PPx” é o acrônimo que identifica o tipo de serviço (item do Catálogo de Serviços): projeto de Desenvolvimento (PPD), de Service Desk (PPS) ou de Treinamento (PPT); “CLIRED” é o nome reduzido do cliente – bem reduzido; “TITRED” é o título reduzido do projeto – bem reduzido.');
        

  //       $('[data-toggle="tooltip"]').tooltip({
  //         placement: "bottom",
  //         boundary: 'window',
  //         animation: true,
  //         trigger: "hover"


  //       });
  //     }

  $('#modalDetalhesGrupoAtividades').on('show.bs.modal', function() {

  });
  //
  $('#modalDetalhesRevisao').on('hidden.bs.modal', function() {
    $('#inputTextPJM_DataDaAgendaRevisao').text("");
    $('#inputTextPJM_ERMCodigo').text("");
    $('#inputTextPJM_mDescricaoDaRevisao').text("");
    $('#textAreaIndicadores').val("");
    $('#textAreaPJM_ParecerGQ').text("");
    $('#textAreaPJM_ParecerGP').text("");

    $("#textAreaPJM_ParecerGQ").attr("disabled", false);
    $("#buttonGerarIndicadores").attr("disabled", false);
    $("#textAreaPJM_ParecerGP").attr("disabled", false);
    $("#buttonConcluirRevisao").attr("disabled", false);

    $('[id^=divAlertReturn]').attr("class", "alert alert-light");
    $('[id^=divAlertReturn]').html("&nbsp;");

  });
  $('#btnChecklistMON').click(function() {

    selectedCKL_ProcedCodigoAcro = "MON";
    selectedCKL_CGOCodigo = 8;
    selectedCKL_ProcedCodigo = selectedDetalheRevisao["PJM_Codigo"];

    $('#modalChecklist').modal('show');

  });
  $('#btnChecklistMAR').click(function() {

    selectedCKL_ProcedCodigoAcro = "MAR";
    selectedCKL_CGOCodigo = 8;
    selectedCKL_ProcedCodigo = selectedDetalheRevisao["PJM_Codigo"];

    $('#modalChecklist').modal('show');

  });


  $('#buttonGerarIndicadores').click(function() {
    //var PJM_PJTCodigo = <?php //echo $this->uri->segment(2); 
                          ?>//;
    var PJM_PJTCodigo = selectedDetalheRevisao["PJM_PJTCodigo"];
    var PJM_Codigo = selectedDetalheRevisao["PJM_Codigo"];
    var CSI_Codigo = currentProject["PJT_ITEMCAS"];


    console.log(CSI_Codigo);

    $.ajax({
      url: "<?php echo base_url(); ?>editarProjeto/gerarIndicadores",
      type: 'POST',
      dataType: 'text',
      data: {
        PJM_PJTCodigo: PJM_PJTCodigo,
        PJM_Codigo: PJM_Codigo,
        CSI_Codigo: CSI_Codigo

      },
      success: function(data, textStatus) {

        // return v.replace('-', '-<br />');
        arrayMonitoramento[getArrayIndexForKey(arrayMonitoramento, "PJM_Codigo", selectedDetalheRevisao["PJM_Codigo"])].PJM_mMomentoDaRevisao = "aa";
        var formattedString = data.replace(/\;/g, '\n');
        $('#textAreaIndicadores').val(formattedString);


      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest);
      }
    });
  });
  $('#buttonConcluirRevisao').click(function() {
    $('#modalConfirmarConcluirRevisao').modal('show');

  });

  //
  function updateParecerGQ() {
    $('[id^=divAlertReturn]').attr("class", "alert alert-primary");
    $('[id^=divAlertReturn]').text("Salvando...");

    arrayMonitoramento[getArrayIndexForKey(arrayMonitoramento, "PJM_Codigo", selectedDetalheRevisao["PJM_Codigo"])].PJM_ParecerGQ = $('#textAreaPJM_ParecerGQ').val();
    arrayMonitoramento[getArrayIndexForKey(arrayMonitoramento, "PJM_Codigo", selectedDetalheRevisao["PJM_Codigo"])].PJM_ParecerGP = $('#textAreaPJM_ParecerGP').val();

    var PJM_ParecerGQ = $('#textAreaPJM_ParecerGQ').val();
    var PJM_ParecerGP = $('#textAreaPJM_ParecerGP').val();

    $.ajax({
      url: "<?php echo base_url(); ?>editarProjeto/updateParecerGQ",
      type: 'POST',
      data: {
        PJM_Codigo: selectedDetalheRevisao["PJM_Codigo"],
        PJM_ParecerGQ: PJM_ParecerGQ,
        PJM_ParecerGP: PJM_ParecerGP

      },
      success: function(data) {
        $('[id^=divAlertReturn]').attr("class", "alert alert-success");
        $('[id^=divAlertReturn]').text("Salvo!");

        $('#modalDetalhesRevisao').modal('hide');
      }
    });
  }

  $('#btnSalvarDetalheRevisao').click(function() {

    updateParecerGQ();

  });
</script>