<!-- Modal -->
<div class="modal fade" id="modalChecklist" tabindex="-1" role="dialog" aria-labelledby="modalChecklistLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalChecklistLabel"> Checklist </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <div class="form-group">
          <table id="tableChecklist" class="table table-bordered table-sm">
            <thead> 
              <tr>
                <th style="width: 15%;"> Ordem</th>
                <th style="width: 75%;"> Descrição</th>
                <th style="width: 5%;"> Feito</th>
                <th style="width: 5%;"> </th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>


        </div>


        <div class="alert alert-light" role="alert" id="divAlertReturn2"> &nbsp</div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSalvarChecklist"> Salvar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  var selectedCKL_ProcedCodigoAcro = "";
  var selectedCKL_CGOCodigo = 0;
  var selectedCKL_ProcedCodigo = 0;
  var arrayChecklist = [];


  $('#modalChecklist').on('show.bs.modal', function(e) {

    $('#divAlertReturn2').attr("class", "alert alert-primary");
    $('#divAlertReturn2').text("Carregando...");


    $.when(fetchCheckList()).done(function(r1) {
      $('#divAlertReturn2').attr("class", "alert alert-light");
      $('#divAlertReturn2').text("");
      arrayChecklist = r1;

      for (var i = 0; i <= r1.length - 1; i++) {
        var htmlChecklist = [];
        htmlChecklist.push('<tr id="' + r1[i].CKL_Codigo + '">');
        htmlChecklist.push('<td> <input type="text" class="form-control" id="inputTextOrdem" value="' + r1[i].CKL_ProcedOrdem + '" disabled /> </td>');
        htmlChecklist.push('<td> <input type="text" class="form-control" id="inputTextDescricao" value="' + r1[i].CKL_ProcedDescricao + '" disabled /> </td>');
        htmlChecklist.push('<td style="text-align: center;"> <input type="checkbox" class="" id="checkboxFeito' + i + '" /> </td>');
        htmlChecklist.push('<td style="text-align: center;"> <i id="detalheItemChecklist" class="fas fa-info-circle"></i> </td>');
        htmlChecklist.push('</tr>');
        $('#tableChecklist').append(htmlChecklist.join(''));
        if (r1[i].CKL_CheckFeito == 1) {
          $('#checkboxFeito' + i).prop('checked', true);
        }


      }
      $('[id=detalheItemChecklist]').hover(function() {
        $(this).css("cursor", "pointer");
      });

    });

  });
  $('#modalChecklist').on('hidden.bs.modal', function() {
    selectedCKL_ProcedCodigoAcro = "";
    selectedCKL_CGOCodigo = 0;
    selectedCKL_ProcedCodigo = 0;
    $('#tableChecklist > tbody').html("");
  });


  function fetchCheckList() {
    return $.ajax({
      url: "<?php echo base_url(); ?>defaults/defaults/fetchCheckList",
      type: 'POST',
      data: {
        CKL_ProcedCodigoAcro: selectedCKL_ProcedCodigoAcro,
        CKL_CGOCodigo: selectedCKL_CGOCodigo,
        CKL_ProcedCodigo: selectedCKL_ProcedCodigo
      },
      dataType: 'json',
      error: function(request, status, error) {
        console.log(request.responseText);
      }
    });
  }


  $('#btnSalvarChecklist').click(function() {
    $('#divAlertReturn2').attr("class", "alert alert-primary");
    $('#divAlertReturn2').text("Salvando...");
    var arrayChecklist = [];
    $('#tableChecklist').find('tr').slice(1).each(function(i, el) {
      var $tds = $(this).find('td');
      var CKL_CheckFeito = 0;
      if ($tds.eq(2).find('input').is(':checked') == true) {
        CKL_CheckFeito = 1;
      }
      var CKL_Codigo = $(this).attr('id');
      arrayChecklist.push([CKL_Codigo, CKL_CheckFeito]);
    });
    $.ajax({
      url: "<?php echo base_url(); ?>defaults/defaults/updateChecklist",
      type: 'POST',
      data: {
        arrayChecklist: arrayChecklist
      },
      success: function(data) {
        $('#divAlertReturn2').attr("class", "alert alert-success");
        $('#divAlertReturn2').text("Salvo!");

        $('#modalChecklist').modal('hide');
      }
    });
  });






  $(document).on('click', '#detalheItemChecklist', function() {


    selectedDetalheItemChecklist = arrayChecklist[$(this).parent().parent().index()];


    $('#modalChecklistItemDetalhes').modal('show');


    $('#inputTextCKL_ProcedDescricao').val(selectedDetalheItemChecklist["CKL_ProcedDescricao"]);
    $('#textareaCKL_ProcedExplicacao').val(selectedDetalheItemChecklist["CKL_ProcedExplicacao"]);




  });
</script>