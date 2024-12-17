<!-- Modal -->
<div class="modal fade" id="modalConfirmarConcluirRevisao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarConcluirRevisaoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConfirmarConcluirRevisaoLabel">Concluir Revisão de Monitoramento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Deseja mesmo concluir a Revisão de monitoramento?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-danger" id="btnConfirmarConcluirMonitoramento"> Concluir </button>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">



    $('#btnConfirmarConcluirMonitoramento').click(function () {
        $('#modalConfirmarConcluirRevisao').modal('hide');
        $('[id^=divAlertReturn]').attr("class", "alert alert-primary");
        $('[id^=divAlertReturn]').text("Salvando...");

        var PJM_Codigo = selectedDetalheRevisao["PJM_Codigo"];
        arrayMonitoramento[getArrayIndexForKey(arrayMonitoramento, "PJM_Codigo", selectedDetalheRevisao["PJM_Codigo"])].PJM_FlgRevisaoConcluida = 1;
        $.ajax({
            url: "<?php echo base_url(); ?>consultoria/revisaoMonitoramento/concluirRevisao",
            type: 'POST',
            dataType: 'text',
            data: {
                PJM_Codigo: PJM_Codigo,
            },
            success: function(data, textStatus ){
                console.log("Feito");
                console.log(data);
                $('#modalDetalhesRevisao').modal('hide');
                location.reload();
            }
        });


    });




</script>
