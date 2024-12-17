<!-- Modal -->
<div class="modal fade" id="modalNovoProjeto" tabindex="-1" role="dialog" aria-labelledby="modalNovoProjetoLabel"
     aria-hidden="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNovoProjetoLabel"> Abertura do Plano de serviço </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputTextPJT_TITULO" class="col-form-label">Nome do Plano de serviço:</label>
          <textarea class="form-control" rows="2" id="inputTextPJT_TITULO"></textarea>
        </div>
        <div class="form-group">
          <label> Serviço: </label>
          <select class="form-control" id="comboboxCatalogoServico"></select>
        </div>
        <div class="alert alert-light" role="alert" id="divAlertReturn"> &nbsp;</div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="btnNewProject"> Abrir Plano de serviço</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    fetchCatalogoServico();
    var arrayCatalogoServico = [];

    function fetchCatalogoServico() {
        $.ajax({
            url: "<?php echo base_url(); ?>listaProjeto/fetchCatalogoServico",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                arrayCatalogoServico = data;
                var html = [];
                html.push('<option> </option>');
                for (var i = data.length - 1; i >= 0; i--) {
                    html.push('<option value="' + data[i].CSI_CODIGO + '">' + data[i].CSI_SERVTITULO + '</option>');
                }
                $('#comboboxCatalogoServico').append(html.join(''));
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    }

    $('#modalNovoProjeto').on('hidden.bs.modal', function (e) {
        $('#divAlertReturn').attr("class", "alert alert-light");
    });

    var PJT_ITEMCAS = null;

    function novoProjeto() {
        
        var PJT_TITULO = $('#inputTextPJT_TITULO').val();
        PJT_ITEMCAS = $('#comboboxCatalogoServico').val();

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;

        var PJT_DATAINICIO = today;
        var PJT_APELIDO = arrayCatalogoServico[getArrayIndexForKey(arrayCatalogoServico, "CSI_CODIGO", PJT_ITEMCAS)].CSI_AcronimoPlanoServico;


        return $.ajax({
            url: "<?php echo base_url(); ?>listaProjeto/newProjeto",
            type: 'POST',
            data: {
                PJT_TITULO: PJT_TITULO,
                PJT_APELIDO: PJT_APELIDO,
                PJT_DATAINICIO: PJT_DATAINICIO,
                PJT_ITEMCAS: PJT_ITEMCAS,
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });


    }


    $('#btnNewProject').click(function () {
        if ($('#inputTextPJT_TITULO').val() == "" || $('#comboboxCatalogoServico').val() == "") {
            $('#divAlertReturn').attr("class", "alert alert-danger");
            $('#divAlertReturn').text("Necessário preencher todos os campos um novo projeto!");
            return
        }

        $('#divAlertReturn').attr("class", "alert alert-primary");
        $('#divAlertReturn').text("Carregando...");

        $.when(novoProjeto()).done(function (idProjeto) {
            // console.log(idProjeto);
            // var indexCasItem = getArrayIndexForKey(arrayCatalogoServico, "CSI_CODIGO", PJT_ITEMCAS);
            window.open('<?php echo base_url('editarProjeto/'); ?>' + idProjeto, '_self');

        });


    });

    function insertTemplatePlanoDeDados(PJT_CODIGO, CSI_CODIGO) {
        return $.ajax({
            url: "<?php echo base_url(); ?>listaProjeto/insertTemplatePlanoDeDados",
            type: 'POST',
            data: {
                PJT_CODIGO: PJT_CODIGO,
                CSI_CODIGO: CSI_CODIGO
            }
        });

    }

    function insertTemplateChecklist(PJT_CODIGO) {
        return $.ajax({
            url: "<?php echo base_url(); ?>listaProjeto/insertTemplateChecklist",
            type: 'POST',
            data: {
                PJT_CODIGO: PJT_CODIGO
            }
        });

    }


    function insertTemplateANS(PJT_CODIGO) {
        return $.ajax({
            url: "<?php echo base_url(); ?>listaProjeto/insertTemplateANS",
            type: 'POST',
            data: {
                PJT_CODIGO: PJT_CODIGO
            }

        });

    }


</script>