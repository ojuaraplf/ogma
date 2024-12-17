<!-- Modal -->
<div class="modal fade" id="modalDetalhesGrupoAtividadesAssociadas" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesGrupoAtividadesAssociadasLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetalhesGrupoAtividadesAssociadasLabel"> Atividades mudadas/corrigidas </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <label for="textareaATG_DESCRICAO" class="col-form-label"> Descrição da atividade: </label>
            <textarea class="form-control" rows="2" id="textareaATG_DESCRICAO" disabled>  </textarea>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-12">
            <label> Tipo de MUC </label>
            <select class="form-control" id="comboboxMUT_Codigo">
            </select>

          </div>

        </div>
        <br />
        <div class="row">
          <div class="col-5">
            <select name="from" class="form-control" id="multiselect" size="8" multiple="multiple">
            </select>
          </div>
          <div class="col-1">
            <button type="button" id="multiselect_rightAll" class="btn btn-block btn-outline-primary"><i class="fas fa-angle-double-right"></i></button>
            <button type="button" id="multiselect_rightSelected" class="btn btn-block btn-outline-primary"><i class="fas fa-angle-right"></i></button>
            <button type="button" id="multiselect_leftSelected" class="btn btn-block btn-outline-primary"><i class="fas fa-angle-left"></i></button>
            <button type="button" id="multiselect_leftAll" class="btn btn-block btn-outline-primary"><i class="fas fa-angle-double-left"></i></button>
          </div>
          <div class="col-6">
            <select name="to" id="multiselect_to" class="form-control" size="8" multiple="multiple">
            </select>
          </div>
        </div>


        <br />

        <div class="alert alert-light" role="alert" id="divAlertReturnAssoc"> &nbsp;</div>
        <div class="modal-footer">




          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" id="btnSalvarAtividadesAssociadas">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  // FETCHING TIPO MUDANÇA ATIVIDADE ---------------------------------------------------------------------------
  var htmlComboboxTipoMudancaCorrecao = [];
  var jsonArrayTipoMudancaCorrecao = JSON.parse(localStorage.arrayTipoMudancaCorrecao);
  for (var i = jsonArrayTipoMudancaCorrecao.length - 1; i >= 0; i--) {
    htmlComboboxTipoMudancaCorrecao.push('<option value="' + jsonArrayTipoMudancaCorrecao[i].MUT_Codigo + '">' + jsonArrayTipoMudancaCorrecao[i].MUT_Descricao + '</option>');
  }
  $('#comboboxMUT_Codigo').append(htmlComboboxTipoMudancaCorrecao);




  function fetchAtividadesAssociadas() {

    return $.ajax({
      url: "<?php echo base_url(); ?>editarFase/fetchAtividadesAssociadas",
      dataType: 'json',
      type: 'POST',
      data: {
        AMC_ATGMucanteCod: selectedDetalheAtividade.ATG_CODIGO
      }
    });
  }

  function updateMultiselect() {
    var htmlComboboxAtividadesAssociadas = [];
    for (var i = 0; i <= arrayAtividades.length - 1; i++) {

      if (arrayAtividades[i].ATF_FlgDeExecucao == 1 && arrayAtividades[i].ATF_FlgAssocianteMuc == 0 && arrayAtividades[i].ATG_TemMucante == 0) {
        htmlComboboxAtividadesAssociadas.push('<option value="' + arrayAtividades[i].ATG_CODIGO + '">' + arrayAtividades[i].ATG_CODIGO + " - " + arrayAtividades[i].ATG_DESCRICAO + '</option>');
      }
    }
    $('#multiselect').append(htmlComboboxAtividadesAssociadas);

  }
  $('#modalDetalhesGrupoAtividadesAssociadas').on('hide.bs.modal', function() {
    console.log("FECHANDO MODAL");

    $('#multiselect_to').html('');
    $('#multiselect').html('');



  });


  $('#modalDetalhesGrupoAtividadesAssociadas').on('show.bs.modal', function() {

    $('#divAlertReturnAssoc').attr("class", "alert alert-primary");
    $('#divAlertReturnAssoc').text("Carregando...");

    updateMultiselect();

    $.when(fetchAtividadesAssociadas()).done(function(r1) {
      for (var i = 0; i <= r1.length - 1; i++) {

        var atividadeIndex = getArrayIndexForKey(arrayAtividades, "ATG_CODIGO", r1[i].AMC_ATGMucadaCod);
        var tipoMUCIndex = getArrayIndexForKey(jsonArrayTipoMudancaCorrecao, "MUT_Codigo", r1[i].AMC_MUTCodigo);

        if ($('#multiselect_to').find("optgroup[id='" + r1[i].AMC_MUTCodigo + "']").length == 0) {
          $('#multiselect_to').append($('<optgroup label="' + jsonArrayTipoMudancaCorrecao[tipoMUCIndex].MUT_Descricao + '" id="' + r1[i].AMC_MUTCodigo + '">'));
        }
        $('#multiselect_to').eq(0).children('#' + r1[i].AMC_MUTCodigo).append('<option value="' + arrayAtividades[atividadeIndex].ATG_CODIGO + '">' + arrayAtividades[atividadeIndex].ATG_CODIGO + " - " + arrayAtividades[atividadeIndex].ATG_DESCRICAO + '</option>');
      }
      $('#divAlertReturnAssoc').attr("class", "alert alert-light");
      $('#divAlertReturnAssoc').html("&nbsp;");




      $('#multiselect').multiselect({
        rightSelected: '#multiselect_rightSelected',
        leftSelected: '#multiselect_leftSelected',
        rightAll: '#multiselect_rightAll',
        leftAll: '#multiselect_leftAll',

        moveToRight: function(Multiselect, options, event, silent, skipStack) {
          var button = $(event.currentTarget).attr('id');

          var selectedComboboxMUTID = $("#comboboxMUT_Codigo option:selected").val();
          var selectedComboboxMUTDesc = $("#comboboxMUT_Codigo option:selected").text();

          if (Multiselect.$right.find("optgroup[id='" + selectedComboboxMUTID + "']").length == 0) {
            Multiselect.$right.append($('<optgroup label="' + selectedComboboxMUTDesc + '" id="' + selectedComboboxMUTID + '">'));
          }
          if (button == 'multiselect_rightSelected') {
            var $left_options = Multiselect.$left.find('> option:selected');
          } else if (button == 'multiselect_rightAll') {
            var $left_options = Multiselect.$left.children(':visible');
          }
          Multiselect.$right.eq(0).children('#' + selectedComboboxMUTID).append($left_options);
        },
        moveToLeft: function(Multiselect, $options, event, silent, skipStack) {
          var button = $(event.currentTarget).attr('id');

          var selectedComboboxMUTID = $("#comboboxMUT_Codigo option:selected").val();
          var selectedComboboxMUTDesc = $("#comboboxMUT_Codigo option:selected").text();


          if (button == 'multiselect_leftSelected') {
            var $right_options = Multiselect.$right.find('option:selected');
          } else if (button == 'multiselect_leftAll') {
            var $right_options = Multiselect.$right.find('option:visible');
          }

          Multiselect.$left.append($right_options);

        }
      });
    });
  });




  $('#btnSalvarAtividadesAssociadas').click(function() {

    $('#modalConfirmarAssociacaoAtividades').modal('show');
    // $('#divAlertReturnAssoc').attr("class", "alert alert-primary");
    // $('#divAlertReturnAssoc').text("Salvando...");

    // $.when(salvarAtividadesAssociadas()).done(function(r1) {
    //   $('#divAlertReturnAssoc').attr("class", "alert alert-success");
    //   $('#divAlertReturnAssoc').text("Salv o!");

    //   $('#modalDetalhesGrupoAtividadesAssociadas').modal('hide');

    //   $('#divAlertReturnAssoc').attr("class", "alert alert-light");
    //   $('#divAlertReturnAssoc').html("&nbsp;");
    // })

  });

  function salvarAtividadesAssociadas() {
    var arrayAtividadesAssociadas = [];
    $('#multiselect_to').find('option').each(function() {
      arrayAtividadesAssociadas.push([selectedDetalheAtividade.ATG_CODIGO, $(this).val(), $(this).parent().attr('id')]);
    });

    return $.ajax({
      url: "<?php echo base_url(); ?>editarFase/updateAtividadesAssociadas",
      type: 'POST',
      data: {
        AMC_ATGMucanteCod: selectedDetalheAtividade.ATG_CODIGO,
        arrayAtividadesAssociadas: arrayAtividadesAssociadas
      },
      error: function(request, status, error) {
        console.log(request.responseText);
      }
    });
  }
</script>