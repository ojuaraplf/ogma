<!-- Modal -->
<div class="modal fade" id="modalDetalhesGrupoAtividades" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesGrupoAtividadesLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
   
      <div class="modal-body">
        <div class="form-group">

          <div class="card" style="background-color: #eeeeee;">
            <div class="col-12">
              <h5 class="btn float-left" style="font-size: 20px; color: #000000;" id="modalDetalhesGrupoAtividadesLabel"> Detalhes Atividade </h5>
              <button class="btn float-right" style="font-size: 20px; color: #000000; background-color: #DCDCDC;" id="btnFechar" > <i class="mdi mdi-exit-to-app"></i> </button>
              <button class="btn float-right" style="font-size: 20px; color: #FFD700; background-color: #000000;" id="btnSalvar" > <i class="mdi mdi-content-save"></i> </button>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12">
              <label for="textareaATG_DESCRICAO" class="text-left control-label col-form-label">Descrição da atividade: </label>
              <textarea class="form-control" rows="2" id="textareaATG_DESCRICAO" disabled>  </textarea>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12">
              <label for="textareaATG_DetalheDescritivo" class="text-left control-label col-form-label">Detalhes/descritivo da atividade: </label>
              <textarea class="form-control" rows="3" id="textareaATG_DetalheDescritivo" disabled>  </textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="" class="col-form-label"> Esforço (h): </label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputTextPJT_QTHORA" />
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" id="btnButtonPert">PERT</button>
                </div>
              </div>
            </div>
            <div class="col-8">
              <label for="comboboxATG_ATFCodigo" class="col-form-label"> Família da atividade </label>
              <select class="form-control" id="comboboxATG_ATFCodigo">
              </select>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-4">
              <label for="inputTextATG_MomInicExecucaoInformado" class="col-form-label"> Inicio da Execução: </label>
              <input type="Date" class="form-control" id="inputTextATG_MomInicExecucaoInformado" />
            </div>
            <div class="col-2">
              <label for="inputTextATG_MomInicTime" class="col-form-label"> h: </label>
              <input type="Time" class="form-control" id="inputTextATG_MomInicTime" />
            </div>
            <div class="col-4">
              <label for="inputTextATG_MomFinalExecucaoInformado" class="col-form-label"> Término da Execução: </label>
              <input type="Date" class="form-control" id="inputTextATG_MomFinalExecucaoInformado" />
            </div>
            <div class="col-2">
              <label for="inputTextATG_MomFinalTime" class="col-form-label"> h: </label>
              <input type="Time" class="form-control" id="inputTextATG_MomFinalTime" />
            </div>
          </div>

          <br/>

          <div class="row" style="text-align: center;">
            <div class="col-12">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="checkboxATG_FlgTemporaria" disabled>
                <label class="form-check-label" for="checkboxATG_FlgTemporaria">
                  Atividade Temporária: limitar apontamentos no período.
                </label>
              </div>
            </div>
          </div>          
                    
          <HR/>

          <div class="row">
            <div class="col-12">
              <label> Equipe: Responsável </label>
              <select class="form-control" id="comboboxATG_CBRCodigo">
              </select>
            </div>
          </div>

          <br/>

          <div class="form-group">
            <label for="comboboxEquipeAlocada"> Equipe: Membros </label>
            <select multiple="multiple" class="form-control" id="comboboxEquipeAlocada">
            </select>
          </div>
        </div>

        <hr>

        <div class="row" style="text-align: center;">
          <div class="col-12">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" value="" id="checkboxATG_FlgPrioridadeEstrategica">
              <label class="form-check-label" for="checkboxATG_FlgPrioridadeEstrategica">
                Prioridade estratégica
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

        <div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  
  // FETCHING FAMILIA ATIVIDADE --------------------------------------------------------------------------
  var jsonArrayFamiliaAtividade = JSON.parse(localStorage.arrayFamiliaAtividade);
  var htmlFamiliaAtividade = [];
  htmlFamiliaAtividade.push('<option value="0"> Selecione... </option>')
  for (var i = jsonArrayFamiliaAtividade.length - 1; i >= 0; i--) {
    htmlFamiliaAtividade.push('<option value="' + jsonArrayFamiliaAtividade[i].ATF_Codigo + '">' + jsonArrayFamiliaAtividade[i].ATF_Descricao + '</option>');
  }
  $('#comboboxATG_ATFCodigo').append(htmlFamiliaAtividade);

  $("#comboboxATG_ATFCodigo").change(function() {
    var selectedItemIndex = getArrayIndexForKey(jsonArrayClasseAtividade, "ATF_Codigo", this.value);
  });
  // -----------------------------------------------------------------------------------------------------

  /*
  
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
*/

  $('#btnButtonPert').click(function() {
    $('#modalEsforcoPERT').modal('show');

  });
  $('#btnButtonPert').hover(function() {
    $(this).css("cursor", "pointer");
  });

  $('#comboboxEquipeAlocada').focus();
  var isEquipeAlocadaChanged = false;

  $('#btnSalvar').click(function() {

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

    var checkboxATG_FlgTemporariaIsChecked = 0;
    if ($('#checkboxATG_FlgTemporaria').is(':checked') == true) {
      checkboxATG_FlgTemporariaIsChecked = 1;
    }

    var checkboxATG_FlgConcluidaIsChecked = 0;
    if ($('#checkboxATG_FlgConcluida').is(':checked') == true) {
      checkboxATG_FlgConcluidaIsChecked = 1;
    }

    var ATG_FlgPrioridadeEstrategica = 0;
    if ($('#checkboxATG_FlgPrioridadeEstrategica').is(':checked') == true) {
      ATG_FlgPrioridadeEstrategica = 1;
    }

    // var ATG_MomInicExecucaoInformado = $('#inputTextATG_MomInicExecucaoInformado').val().split("/").reverse().join("-");
    var ATG_MomInicExecucaoInformado = $('#inputTextATG_MomInicExecucaoInformado').val() + ' ' + $('#inputTextATG_MomInicTime').val();

    // var ATG_MomFinalExecucaoInformado = $('#inputTextATG_MomFinalExecucaoInformado').val().split("/").reverse().join("-");
    var ATG_MomFinalExecucaoInformado = $('#inputTextATG_MomFinalExecucaoInformado').val() + ' ' + $('#inputTextATG_MomFinalTime').val();

    return $.ajax({
      url: "<?php echo base_url(); ?>editarFase/saveGrupoAtividadesDetalhes",
      type: 'POST',
      data: {
        ATG_CODIGO: selectedDetalheAtividade["ATG_CODIGO"],
        ATG_ISENTA: checkboxIsentaIsChecked,
        ATG_ATFCodigo: $('#comboboxATG_ATFCodigo').val(),
        ATG_CBRCodigo: $('#comboboxATG_CBRCodigo').val(),
        ATG_QTHORA: $('#inputTextPJT_QTHORA').val(),
        ATG_MomInicExecucaoInformado: ATG_MomInicExecucaoInformado,
        ATG_MomFinalExecucaoInformado: ATG_MomFinalExecucaoInformado,
        ATG_FlgPrioridadeEstrategica: ATG_FlgPrioridadeEstrategica,
        ATG_FlgTemporaria: checkboxATG_FlgTemporariaIsChecked,
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

  $('#modalDetalhesGrupoAtividades').on('show.bs.modal', function() {
    
    isEquipeAlocadaChanged = false;
    $('#divAlertReturn').attr("class", "alert alert-primary");
    $('#divAlertReturn').text("Carregando...");
    $('[id^=textareaATG_DESCRICAO]').text(selectedDetalheAtividade["ATG_DESCRICAO"]);
    $('#textareaATG_DetalheDescritivo').text(selectedDetalheAtividade["ATG_DetalheDescritivo"]);

    fetchGrupoAtividadesDetalhes();
    fetchEquipeAlocadaAtividade();

  })

  $('#modalDetalhesGrupoAtividades').on('hidden.bs.modal', function() {

    $("#inputTextPJT_QTHORA").attr('disabled', false);
    $("#btnButtonPert").attr('disabled', false);
    $("#comboboxATG_CBRCodigo").attr('disabled', false);
    $("#comboboxATG_ATFCodigo").attr('disabled', false);
    $("#textareaATG_DetalheDescritivo").attr('disabled', true);
    $("#comboboxEquipeAlocada").attr('disabled', false);
    $("#inputTextATG_MomInicExecucaoInformado").attr('disabled', false);
    $("#inputTextATG_MomFinalExecucaoInformado").attr('disabled', false);
    $("#inputTextATG_MomInicTime").attr('disabled', false);
    $("#inputTextATG_MomFinalTime").attr('disabled', false);
    isEquipeAlocadaChanged = false;
    $('#checkboxIsenta').prop('checked', false);
    $('#checkboxATG_FlgConcluida').prop('checked', false);
    $('#checkboxATG_FlgTemporaria').prop('checked', false);
    $('#checkboxATG_FlgPrioridadeEstrategica').prop('checked', false);
    $('#textareaATG_DESCRICAO').text("");
    $('#textareaATG_DetalheDescritivo').val("");
    $('#inputTextATG_MomVctoANS').val("");
    $('#inputTextATG_MomInicExecucaoInformado').val("");
    $('#inputTextATG_MomFinalExecucaoInformado').val("");
    $('#inputTextATG_MomInicTime').val("");
    $('#inputTextATG_MomFinalTime').val("");
    $('#comboboxEquipeAlocada').val([]);
    $('#comboboxATG_ATFCodigo').val(0);
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

        if (data["ATG_ISENTA"] == 1) {
          $('#checkboxIsenta').prop('checked', true);
        }
        $('#textareaATG_DetalheDescritivo').val(data["ATG_DetalheDescritivo"]);

        if (data["ATG_MomInicExecucaoInformado"] != null) {
          var ATG_MomInicExecucaoInformadoDateTime = data["ATG_MomInicExecucaoInformado"].split(" ");
          $('#inputTextATG_MomInicExecucaoInformado').val(ATG_MomInicExecucaoInformadoDateTime[0]);
          $('#inputTextATG_MomInicTime').val(ATG_MomInicExecucaoInformadoDateTime[1]);
        }      

        if (data["ATG_MomFinalExecucaoInformado"] != null) {
          var ATG_MomFinalExecucaoInformadoDateTime = data["ATG_MomFinalExecucaoInformado"].split(" ");
          // $('#inputTextATG_MomFinalExecucaoInformado').val(ATG_MomFinalExecucaoInformadoDateTime[0].split("-").reverse().join("/"));
          $('#inputTextATG_MomFinalExecucaoInformado').val(ATG_MomFinalExecucaoInformadoDateTime[0]);
          $('#inputTextATG_MomFinalTime').val(ATG_MomFinalExecucaoInformadoDateTime[1]);
        }

        if (data["ATG_ATFCodigo"] != null) {
          $('#comboboxATG_ATFCodigo').val(data["ATG_ATFCodigo"]);
        }

        if (data["ATG_FlgConcluida"] == 1) {
          $('#checkboxATG_FlgConcluida').prop('checked', true);
          $("#inputTextPJT_QTHORA").attr('disabled', true);
          $("#btnButtonPert").attr('disabled', true);
          $("#comboboxATG_CBRCodigo").attr('disabled', true);
          $("#comboboxATG_ATFCodigo").attr('disabled', true);
          $("#textareaATG_DetalheDescritivo").attr('disabled', true);
          $("#inputTextATG_MomFinalExecucaoInformado").attr('disabled', true);
          $("#inputTextATG_MomInicExecucaoInformado").attr('disabled', true);
          $("#inputTextATG_MomInicTime").attr('disabled', true);
          $("#inputTextATG_MomFinalTime").attr('disabled', true);          
          $("#checkboxIsenta").attr('disabled', true);
          $("#checkboxATG_FlgPrioridadeEstrategica").attr('disabled', true);
          $("#checkboxATG_FlgTemporaria").attr('disabled', true);          
          $("#comboboxEquipeAlocada").attr('disabled', true);
        }
        if (data["ATG_FlgTemporaria"] == 1) {
          $('#checkboxATG_FlgTemporaria').prop('checked', true);
        }

        if (data["ATG_FlgPrioridadeEstrategica"] == 1) {
          $('#checkboxATG_FlgPrioridadeEstrategica').prop('checked', true);
        }

        if(data["ATG_FlgPrioridadeEstrategica"] == 1) {
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').attr('disabled', false)
        } else {
          $('#checkboxATG_FlgAtividadeAuditoriaRealizada').attr('disabled', true)
        }

        $('#inputTextPJT_QTHORA').val(data["ATG_QTHORA"]);
        
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

  $('#btnFechar').click(function () {
		$('#modalDetalhesGrupoAtividades').modal('hide');
  });

</script>