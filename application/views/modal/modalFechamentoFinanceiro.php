<!-- Modal -->
<div class="modal fade" id="modalFechamentoFinanceiro" tabindex="-1" role="dialog"
     aria-labelledby="modalFechamentoFinanceiroLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="modalFechamentoFinanceiroLabel"> Fechamento Financeiro </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">
        <div class="form-group">
          <div class="row mb-3">
            <div class="col-3">
              <label for="inputTextPEF_Codigo" class="text-left control-label col-form-label">COD</label>
              <input type="text" class="form-control" id="inputTextPEF_Codigo" disabled/>
            </div>
            <div class="col-3">
              <label for="inputTextLCT_DATA" class="text-left control-label col-form-label">Data</label>
              <input type="text" class="form-control" id="inputTextLCT_DATA" disabled/>
            </div>
            <div class="col-2">
              <label for="inputTextLCT_HORAINICIO" class="text-left control-label col-form-label"> Valor </label>
              <input type="text" class="form-control" id="inputTextLCT_HORAINICIO"/>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <label for="" class="text-left control-label col-form-label">Atividade</label>
              <select class="form-control" id="comboboxAtividadesColaborador">
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <label for="" class="text-left control-label col-form-label"> Descrição </label>
              <textarea rows="2" class="form-control" id="textAreaLCT_GlosaJustificativa"> </textarea>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <button type="button" class="btn btn-primary" id="btnAdicionarLancamentoHoras">Adicionar Lançamento de
                Horas
              </button>
            </div>
          </div>


          <table id="tableSelectedLCT" class="table table-bordered table-sm">
            <thead>
            <tr>
              <th style="width: 10%;"> Data</th>
              <th style="width: 8%;"> Tempo</th>
              <th style="width: 77%;"> Descrição</th>
              <th style="width: 5%;"></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>


        </div>
        <div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSalvarPEF">Adicionar Pendência Financeira</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    $('#modalFechamentoFinanceiro').on('show.bs.modal', function () {
        console.log("ABRIU O MODAL");
    });

    $('#modalFechamentoFinanceiro').on('hide.bs.modal', function () {
        console.log("FECHOU O MODAL");
        arraySelectedLancamentoHora = [];
        $('#tableSelectedLCT > tbody').html('');
        loadingLCTTable();

    });


    $('#btnAdicionarLancamentoHoras').click(function () {
        $('#modalSelecionarApontamentoHorasFechamentoFinanceiro').modal('show');
    });


    $('#btnSalvarPEF').click(function () {
        console.log(arraySelectedLancamentoHora);
    });

    function fetchSelectedLancamentoTable() {
        $('#tableSelectedLCT > tbody').html('');
        arraySelectedLancamentoHora.forEach(function (item) {
            var htmlSelectedLancamentoHoras = [];
            htmlSelectedLancamentoHoras.push('<tr id="' + item["LCT_CODIGO"] + '">');
            htmlSelectedLancamentoHoras.push('<td>' + item["LCT_DATA"] + '</td>');
            htmlSelectedLancamentoHoras.push('<td>' + item["LCT_TEMPO"] + '</td>');
            htmlSelectedLancamentoHoras.push('<td>' + item["LCT_DESCRICAO"] + '</td>');
            htmlSelectedLancamentoHoras.push('<td id="delete"> <i class="fas fa-trash-alt"></i> </td>');
            htmlSelectedLancamentoHoras.push('</tr>');
            $('#tableSelectedLCT').append(htmlSelectedLancamentoHoras.join(''));
        });
    }

    $(document).on('click', '#delete', function () {
        var index = getArrayIndexForKey(arraySelectedLancamentoHora, "LCT_CODIGO", $(this).parent().attr('id'));
        var rowSelected = tableLCT.row('#' + $(this).parent().attr('id')).node();
        $(rowSelected).toggleClass('selected');
        arraySelectedLancamentoHora.splice(index, 1);
        $(this).parent().remove();
    });


</script>