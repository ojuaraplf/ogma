<!-- Modal -->
<div class="modal fade" id="modalDetalhesGrupoAtividades" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesGrupoAtividadesLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetalhesGrupoAtividadesLabel"> Detalhes Atividade </h5>



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="form-group">



          <div class="row">
            <div class="col-10">
              <label for="textareaATG_DESCRICAO" class="col-form-label"> Descrição da atividade: </label>
            </div>
            <div class="col-2 text-right">
              <button class="btn btn-outline-success" id="btnChecklistMUC" data-toggle="tooltip"> MUC</button>
            </div>

          </div>

          <br />


          <div class="row">
            <div class="col-12">
              <textarea class="form-control" rows="2" id="textareaATG_DESCRICAO" disabled>  </textarea>
            </div>

            <!-- <div class="col-2 text-right">
              <button class="btn btn-outline-success" id="btnChecklistMUC" data-toggle="tooltip"> MUC</button>
            </div> -->



          </div>

          <br />

          <div class="row">
            <div class="col-6">

              <label> Família da atividade </label>
              <div class="input-group">
                <select class="form-control" id="comboboxATG_ATFCodigo">
                </select>

                <button type="button" class="btn btn-primary" id="buttonMUC" disabled>MUC</button>
                <!-- <div class="input-group-text">MUC</div> -->

              </div>
              <!-- <button type="button" class="btn btn-secondary" disabled>MUC</button> -->
            </div>
            <!-- <div class="col-1">
              <label> &nbsp; </label>
              <button type="button" class="btn btn-secondary" disabled>MUC</button>

            </div> -->


            <div class="col-6">
              <label> Classe da atividade </label>
              <select class="form-control" id="comboboxATG_ATCCodigo">

              </select>
            </div>

          </div>

          <br />

          <div class="row">
            <div class="col-12">
              <label> Responsável </label>
              <select class="form-control" id="comboboxATG_CBRCodigo">

              </select>
            </div>
          </div>




          <br />


          <div class="row">
            <div class="col-6">
              <label for="inputTextATG_MomInicExecucaoInformado" class="col-form-label"> Data de Inicio Informado: </label>
              <input type="text" class="form-control" id="inputTextATG_MomInicExecucaoInformado" />

            </div>
            <div class="col-6">
              <label for="inputTextATG_MomFinalExecucaoInformado" class="col-form-label"> Data de Fim Informado: </label>
              <input type="text" class="form-control" id="inputTextATG_MomFinalExecucaoInformado" />

            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-4">
              <label for="inputTextATG_MomInicExecucao" class="col-form-label"> Momento de início: </label>
              <input type="text" class="form-control" id="inputTextATG_MomInicExecucao" />

            </div>

            <div class="col-3">
              <label for="" class="col-form-label"> Esforço (h): </label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputTextPJT_QTHORA" />
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" id="btnButtonPert">PERT</button>
                </div>
              </div>
            </div>
            <!-- <div class="col-1">
            <label for="" class="col-form-label"> &nbsp; </label>
              <button type="button" class="btn btn-primary">PERT</button>
            </div> -->

            <div class="col-5">
              <label for="inputTextATG_MomVctoANS" class="col-form-label"> Momento Vencimento: </label>
              <input type="text" class="form-control" id="inputTextATG_MomVctoANS" disabled />

            </div>
          </div>


          <br />

          <div class="row">
            <div class="col-12">
              <label for="textareaATG_DetalheDescritivo" class="col-form-label"> Detalhe descritiva atividade: </label>
              <textarea class="form-control" rows="2" id="textareaATG_DetalheDescritivo"></textarea>
            </div>
          </div>



          <div class="row" style="text-align: center;">
            <div class="col-12">

              <br />

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="checkboxATG_FlgPrioridadeEstrategica">
                <label class="form-check-label" for="checkboxATG_FlgPrioridadeEstrategica">
                  Prioridade estratégica
                </label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="checkboxATG_FlgAtividadeAuditoriaRealizada" disabled>
                <label class="form-check-label" for="checkboxATG_FlgAtividadeAuditoriaRealizada">
                  Auditoria realizada
                </label>
              </div>



              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="checkboxIsenta">
                <label class="form-check-label" for="checkboxIsenta">
                  Não faturável
                </label>
              </div>


              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="checkboxATG_FlgConcluida">
                <label class="form-check-label" for="checkboxATG_FlgConcluida" style="font-weight: bold; text-decoration: underline;">
                  Atividade Concluida
                </label>
              </div>



            </div>
          </div>

          <br />

          <div class="form-group">
            <label for="comboboxEquipeAlocada"> Equipe alocada para a execução da atividade. </label>
            <select multiple="multiple" class="form-control" id="comboboxEquipeAlocada">

            </select>
          </div>


        </div>

        <div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
        <div class="modal-footer">



          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" id="btnSalvarDetalheAtividade">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  // FETCHING CLASSE ATIVIDADE ---------------------------------------------------------------------------
  var htmlComboboxClasseAtividade = [];
  var jsonArrayClasseAtividade = JSON.parse(localStorage.arrayClasseAtividade);
  for (var i = jsonArrayClasseAtividade.length - 1; i >= 0; i--) {
    htmlComboboxClasseAtividade.push('<option value="' + jsonArrayClasseAtividade[i].ATC_Codigo + '">' + jsonArrayClasseAtividade[i].ATC_Descricao + '</option>');
  }
  $('#comboboxATG_ATCCodigo').append("<option value='0'> Selecione... </option>");
  $('#comboboxATG_ATCCodigo').append(htmlComboboxClasseAtividade);
  // -----------------------------------------------------------------------------------------------------
  // FETCHING FAMILIA ATIVIDADE --------------------------------------------------------------------------
  var jsonArrayFamiliaAtividade = JSON.parse(localStorage.arrayFamiliaAtividade);
  var htmlFamiliaAtividade = [];
  htmlFamiliaAtividade.push('<option value="0"> Selecione... </option>')
  for (var i = jsonArrayFamiliaAtividade.length - 1; i >= 0; i--) {
    htmlFamiliaAtividade.push('<option value="' + jsonArrayFamiliaAtividade[i].ATF_Codigo + '">' + jsonArrayFamiliaAtividade[i].ATF_Descricao + '</option>');
  }
  $('#comboboxATG_ATFCodigo').append(htmlFamiliaAtividade);

  console.log(jsonArrayFamiliaAtividade);

  $("#comboboxATG_ATFCodigo").change(function() {
    var selectedItemIndex = getArrayIndexForKey(jsonArrayClasseAtividade, "ATF_Codigo", this.value);
    if (jsonArrayClasseAtividade[selectedItemIndex].ATF_FlgAssocianteMuc == 0) {
      $('#buttonMUC').prop('disabled', true);
    }
  });
  // -----------------------------------------------------------------------------------------------------

  $('#btnChecklistMUC').click(function() {

    selectedCKL_ProcedCodigoAcro = "MUC";
    selectedCKL_CGOCodigo = 6;
    selectedCKL_ProcedCodigo = <?php echo $this->uri->segment(3); ?>;

    $('#modalChecklist').modal('show');

  });


  $('#checkboxATG_FlgPrioridadeEstrategica').change(function() {
        if(this.checked) {
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').attr('disabled', false)
        } else {
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').prop('checked', false);
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').attr('disabled', true)
        }
    });


  
            



  $('#inputTextATG_MomInicExecucaoInformado, #inputTextATG_MomFinalExecucaoInformado').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: "dd/mm/yyyy",
    orientation: "bottom",
    maxViewMode: 1
  });

  $('#inputTextATG_MomInicExecucaoInformado, #inputTextATG_MomFinalExecucaoInformado').datepicker().on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation(); 
});


  $('#buttonMUC').click(function() {
    $('#modalDetalhesGrupoAtividadesAssociadas').modal('show');

  });
  $('#btnButtonPert').click(function() {
    $('#modalEsforcoPERT').modal('show');

  });
  $('#btnButtonPert').hover(function() {
    $(this).css("cursor", "pointer");
  });



  $('#comboboxEquipeAlocada').focus();


  var isEquipeAlocadaChanged = false;

  $('#btnSalvarDetalheAtividade').click(function() {

    $('#divAlertReturn').attr("class", "alert alert-primary");
    $('#divAlertReturn').text("Salvando...");




    if (isEquipeAlocadaChanged == true) {
      $.when(saveGrupoAtividadesDetalhes(), saveEquipeAlocada()).done(function(r1, r2) {
        $('#divAlertReturn').attr("class", "alert alert-success");
        $('#divAlertReturn').text("Salvo!");
        $('#modalDetalhesGrupoAtividades').modal('hide');

      });
    } else {
      $.when(saveGrupoAtividadesDetalhes()).done(function(r1) {


        $('#divAlertReturn').attr("class", "alert alert-success");
        $('#divAlertReturn').text("Salvo!");

        $('#modalDetalhesGrupoAtividades').modal('hide');

      });
    }


  });

  function saveGrupoAtividadesDetalhes() {

    var checkboxIsentaIsChecked = 0;
    if ($('#checkboxIsenta').is(':checked') == true) {
      checkboxIsentaIsChecked = 1;
    }

    var checkboxATG_FlgAtividadeAuditoriaRealizadaChecked = 0;
    if ($('#checkboxATG_FlgAtividadeAuditoriaRealizada').is(':checked') == true) {
      checkboxATG_FlgAtividadeAuditoriaRealizadaChecked = 1;
    }

    var checkboxATG_FlgConcluidaIsChecked = 0;
    if ($('#checkboxATG_FlgConcluida').is(':checked') == true) {
      checkboxATG_FlgConcluidaIsChecked = 1;
    }


    var ATG_FlgPrioridadeEstrategica = 0;
    if ($('#checkboxATG_FlgPrioridadeEstrategica').is(':checked') == true) {
      ATG_FlgPrioridadeEstrategica = 1;
    }

    var ATG_MomInicExecucaoDateTime = $('#inputTextATG_MomInicExecucao').val().split(" ");
    var ATG_MomInicExecucao = ATG_MomInicExecucaoDateTime[0].split("/").reverse().join("-") + " " + ATG_MomInicExecucaoDateTime[1] + ":00";

    var ATG_MomVctoANSDateTime = $('#inputTextATG_MomVctoANS').val().split(" ");
    var ATG_MomVctoANS = ATG_MomVctoANSDateTime[0].split("/").reverse().join("-") + " " + ATG_MomVctoANSDateTime[1] + ":00";


    var ATG_MomVctoANS = ATG_MomVctoANSDateTime[0].split("/").reverse().join("-") + " " + ATG_MomVctoANSDateTime[1] + ":00";

    var ATG_MomInicExecucaoInformado = $('#inputTextATG_MomInicExecucaoInformado').val().split("/").reverse().join("-");
    var ATG_MomFinalExecucaoInformado = $('#inputTextATG_MomFinalExecucaoInformado').val().split("/").reverse().join("-");


    return $.ajax({
      url: "<?php echo base_url(); ?>editarFase/saveGrupoAtividadesDetalhes",
      type: 'POST',
      data: {
        ATG_CODIGO: selectedDetalheAtividade["ATG_CODIGO"],
        ATG_ISENTA: checkboxIsentaIsChecked,
        ATG_FlgAtividadeAuditoriaRealizada: checkboxATG_FlgAtividadeAuditoriaRealizadaChecked,
        ATG_ATFCodigo: $('#comboboxATG_ATFCodigo').val(),
        ATG_ATCCodigo: $('#comboboxATG_ATCCodigo').val(),
        ATG_CBRCodigo: $('#comboboxATG_CBRCodigo').val(),
        ATG_QTHORA: $('#inputTextPJT_QTHORA').val(),
        ATG_MomInicExecucaoInformado: ATG_MomInicExecucaoInformado,
        ATG_MomFinalExecucaoInformado: ATG_MomFinalExecucaoInformado,
        ATG_MomInicExecucao: ATG_MomInicExecucao,
        ATG_MomViradaStatus: ATG_MomInicExecucao,
        ATG_MomVctoANS: ATG_MomVctoANS,
        ATG_FlgPrioridadeEstrategica: ATG_FlgPrioridadeEstrategica,
        ATG_FlgConcluida: checkboxATG_FlgConcluidaIsChecked,
        ATG_DetalheDescritivo: $('#textareaATG_DetalheDescritivo').val()
      },
      error: function(request, status, error) {
        console.log(request.responseText);
      }
    });
  }

  function saveEquipeAlocada() {
    return $.ajax({
      url: "<?php echo base_url(); ?>editarFase/saveEquipeAlocada",
      type: 'POST',
      data: {
        arrayEquipeAlocada: arrayValues,
        ATG_CODIGO: selectedDetalheAtividade["ATG_CODIGO"]
      },

    });
  }

  $('#inputTextATG_MomInicExecucao').datetimepicker({

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
  $('#inputTextATG_MomInicExecucao').focusout(function() {
    if ($(this).val() != "") {
      fetchDataFinal();
    }
  });


  $('#inputTextPJT_QTHORA').focusout(function() {
    if ($("#inputTextATG_MomInicExecucao").val() != "") {
      fetchDataFinal();
    }
  });




  function fetchDataFinal() {

    var ATG_MomInicExecucaoDateTime = $('#inputTextATG_MomInicExecucao').val().split(" ");
    var ATG_MomInicExecucao = ATG_MomInicExecucaoDateTime[0].split("/").reverse().join("-") + " " + ATG_MomInicExecucaoDateTime[1] + ":00";

    $.ajax({
      url: "<?php echo base_url(); ?>editarFase/fetchDataFinal",
      type: 'POST',
      data: {
        ATG_MomInicExecucao: ATG_MomInicExecucao,
        ATG_QTHORA: $('#inputTextPJT_QTHORA').val()
      },
      dataType: 'text',
      success: function(data) {

        var ATG_MomVctoANSDateTime = data.split(" ");
        var ATG_MomVctoANS = ATG_MomVctoANSDateTime[0].split("-").reverse().join("/") + " " + ATG_MomVctoANSDateTime[1];

        $('#inputTextATG_MomVctoANS').val(ATG_MomVctoANS);



      }
    });
  }

  $('#modalDetalhesGrupoAtividades').on('show.bs.modal', function() {

    console.log('AQUI');
    console.log(selectedDetalheAtividade);
    console.log(jsonArrayFamiliaAtividade);
    console.log('AQUI');
    // if (jsonArrayFamiliaAtividade[getArrayIndexForKey(jsonArrayFamiliaAtividade, "ATF_Codigo", selectedDetalheAtividade["ATG_ATFCodigo"])].ATF_FlgRequerChamado = 1) {



    // }



    isEquipeAlocadaChanged = false;

    $('#divAlertReturn').attr("class", "alert alert-primary");
    $('#divAlertReturn').text("Carregando...");

    $('[id^=textareaATG_DESCRICAO]').text(selectedDetalheAtividade["ATG_DESCRICAO"]);

    $('#textareaATG_DetalheDescritivo').text(selectedDetalheAtividade["ATG_DetalheDescritivo"]);


   

    // $('#checkboxATG_FlgAtividadeAuditoriaRealizada').prop('checked', selectedDetalheAtividade["ATG_FlgAtividadeAuditoriaRealizada"] == 1);











    fetchGrupoAtividadesDetalhes();
    fetchEquipeAlocadaAtividade();

  })

  $('#modalDetalhesGrupoAtividades').on('hidden.bs.modal', function() {

    $("#inputTextATG_MomInicExecucao").attr('disabled', false);
    $("#inputTextPJT_QTHORA").attr('disabled', false);
    $("#btnButtonPert").attr('disabled', false);
    $("#comboboxATG_CBRCodigo").attr('disabled', false);
    $("#comboboxATG_ATFCodigo").attr('disabled', false);
    $("#textareaATG_DetalheDescritivo").attr('disabled', true);
    $("#comboboxEquipeAlocada").attr('disabled', false);
    $("#comboboxATG_ATCCodigo").attr('disabled', false);
    $("#inputTextATG_MomInicExecucaoInformado").attr('disabled', false);
    $("#inputTextATG_MomFinalExecucaoInformado").attr('disabled', false);


    isEquipeAlocadaChanged = false;
    $('#checkboxIsenta').prop('checked', false);
    $('#checkboxATG_FlgConcluida').prop('checked', false);
    $('#checkboxATG_FlgPrioridadeEstrategica').prop('checked', false);
    $('#textareaATG_DESCRICAO').text("");
    $('#textareaATG_DetalheDescritivo').val("");

    $('#buttonMUC').prop('disabled', true);

    $('#inputTextATG_MomInicExecucao').val("");

    $('#inputTextATG_MomVctoANS').val("");
    $('#inputTextATG_MomInicExecucaoInformado').val("");
    $('#inputTextATG_MomFinalExecucaoInformado').val("");


    $('#comboboxEquipeAlocada').val([]);
    $('#comboboxATG_ATFCodigo').val(0);
    $('#comboboxATG_ATCCodigo').val(0);
    $('#comboboxATG_CBRCodigo').val(0);
    arrayValues = [];
  })

  $("#comboboxEquipeAlocada").click(function() {

    isEquipeAlocadaChanged = true;

    var idSelected = $("#comboboxEquipeAlocada option:selected").val();
    if (arrayValues.includes(idSelected) == true) {
      arrayValues = $.grep(arrayValues, function(value) {
        return value != idSelected;
      });
    } else {
      arrayValues.push(idSelected);
    }
    $('#comboboxEquipeAlocada').val(arrayValues);
    $('#comboboxEquipeAlocada').change();
    $('#comboboxEquipeAlocada').focus();
  });


  var arrayValues = [];
  var json_array_ogm_catalogoservicoitem = JSON.parse(localStorage.array_ogm_catalogoservicoitem);

  function fetchGrupoAtividadesDetalhes() {
    $.ajax({
      url: "<?php echo base_url(); ?>editarFase/fetchGrupoAtividadesDetalhes",
      type: 'POST',
      data: {
        ATG_CODIGO: selectedDetalheAtividade["ATG_CODIGO"]
      },
      dataType: 'json',
      success: function(data) {

        console.log(data);

        if (data["ATG_ISENTA"] == 1) {
          $('#checkboxIsenta').prop('checked', true);
        }
        $('#textareaATG_DetalheDescritivo').val(data["ATG_DetalheDescritivo"]);

        if (data["ATG_MomInicExecucaoInformado"] != null) {
          var ATG_MomInicExecucaoInformadoDateTime = data["ATG_MomInicExecucaoInformado"].split(" ");
          $('#inputTextATG_MomInicExecucaoInformado').val(ATG_MomInicExecucaoInformadoDateTime[0].split("-").reverse().join("/"));
        }

        if (data["ATG_MomFinalExecucaoInformado"] != null) {
          var ATG_MomFinalExecucaoInformadoDateTime = data["ATG_MomFinalExecucaoInformado"].split(" ");
          $('#inputTextATG_MomFinalExecucaoInformado').val(ATG_MomFinalExecucaoInformadoDateTime[0].split("-").reverse().join("/"));
        }

        if (data["ATG_ATFCodigo"] != null) {
          $('#comboboxATG_ATFCodigo').val(data["ATG_ATFCodigo"]);
        }


        if (data["ATG_FlgConcluida"] == 1) {
          $('#checkboxATG_FlgConcluida').prop('checked', true);
          $("#inputTextATG_MomInicExecucao").attr('disabled', true);
          $("#inputTextPJT_QTHORA").attr('disabled', true);
          $("#btnButtonPert").attr('disabled', true);
          $("#comboboxATG_CBRCodigo").attr('disabled', true);
          $("#comboboxATG_ATFCodigo").attr('disabled', true);
          $("#textareaATG_DetalheDescritivo").attr('disabled', true);
          $("#inputTextATG_MomFinalExecucaoInformado").attr('disabled', true);
          $("#inputTextATG_MomInicExecucaoInformado").attr('disabled', true);

          $("#checkboxIsenta").attr('disabled', true);
          $("#checkboxATG_FlgPrioridadeEstrategica").attr('disabled', true);
          $("#comboboxEquipeAlocada").attr('disabled', true);
          $("#comboboxATG_ATCCodigo").attr('disabled', true);


        }
        if (data["ATG_FlgAtividadeAuditoriaRealizada"] == 1) {
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').prop('checked', true);
        }

        if (data["ATG_FlgPrioridadeEstrategica"] == 1) {
          $('#checkboxATG_FlgPrioridadeEstrategica').prop('checked', true);
        }

        if (data["ATG_ATCCodigo"] != null) {
          $('#comboboxATG_ATCCodigo').val(data["ATG_ATCCodigo"]);
        }

        if(data["ATG_FlgPrioridadeEstrategica"] == 1) {
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').attr('disabled', false)
        } else {
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').attr('disabled', true)
        }

        // if (json_array_ogm_catalogoservicoitem[getArrayIndexForKey(json_array_ogm_catalogoservicoitem, "CSI_CODIGO", selectedProject.PJT_ITEMCAS)].CSI_FlgCHDgeraATG == 1) {

        //   $("#inputTextATG_MomInicExecucao").attr('disabled', true);
        //   $("#inputTextPJT_QTHORA").attr('disabled', true);
        //   $("#btnButtonPert").attr('disabled', true);
        //   $("#comboboxATG_CBRCodigo").attr('disabled', true);
        //   $("#comboboxATG_ATFCodigo").attr('disabled', true);

        // }


        console.log("HEHEHE");
        console.log(data["ATG_ATFCodigo"]);
        console.log("HEHEHE");


        $('#inputTextPJT_QTHORA').val(data["ATG_QTHORA"]);
        if (data["ATG_ATFCodigo"] != null) {
          if (jsonArrayFamiliaAtividade[getArrayIndexForKey(jsonArrayFamiliaAtividade, "ATF_Codigo", data["ATG_ATFCodigo"])].ATF_FlgAssocianteMuc == 1) {
            $('#buttonMUC').prop('disabled', false);
          } else {
            $('#buttonMUC').prop('disabled', true);
          }
        }

        if (data["ATG_MomVctoANS"] != null) {
          var ATG_MomVctoANSDateTime = data["ATG_MomVctoANS"].split(" ");
          $('#inputTextATG_MomVctoANS').val(ATG_MomVctoANSDateTime[0].split("-").reverse().join("/") + " " + ATG_MomVctoANSDateTime[1]);
        }
        if (data["ATG_MomInicExecucao"] != null) {
          var ATG_MomInicExecucaoDateTime = data["ATG_MomInicExecucao"].split(" ");
          $('#inputTextATG_MomInicExecucao').val(ATG_MomInicExecucaoDateTime[0].split("-").reverse().join("/") + " " + ATG_MomInicExecucaoDateTime[1]);
        }
        if (data["ATG_CBRCodigo"] != null) {
          $('#comboboxATG_CBRCodigo').val(data["ATG_CBRCodigo"]);
        }
      },
    });
  }

  function fetchEquipeAlocadaAtividade() {
    $.ajax({
      url: "<?php echo base_url(); ?>editarFase/fetchEquipeAlocadaAtividade",
      type: 'POST',
      data: {
        ATG_CODIGO: selectedDetalheAtividade["ATG_CODIGO"]
      },
      dataType: 'json',
      success: function(data) {
        if (data.length != 0) {
          for (var i = 0; i < data.length; i++) {
            arrayValues.push(data[i].AEA_CBRCODIGO);
          }
        }


        $('#divAlertReturn').attr("class", "alert alert-light");
        $('#divAlertReturn').html("&nbsp;");

        $('#comboboxEquipeAlocada').val(arrayValues);
        $('#comboboxEquipeAlocada').change();
        $('#comboboxEquipeAlocada').focus();
      },
    });
  }
</script>