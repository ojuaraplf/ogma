<!-- Modal -->
<div class="modal fade" id="modalApontamentoHoraSucesso" tabindex="-1" role="dialog" aria-labelledby="modalApontamentoHoraSucessoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalApontamentoHoraSucessoLabel">Concluido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Seu apontamento de horas foi realizado com sucesso!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  

  
  $('#modalApontamentoHoraSucesso').on('hidden.bs.modal', function () {  
    
    $('#inputTextLCT_HORAINICIO').val("");
    $('#inputTextLCT_HORAFIM').val("");
		$('#inputTextLCT_CODCHAMADO').val("");
    $('#textareaLCT_DESCRICAO').val("");
    fetchApondamentoDia($('#inputTextLCT_DATA').val());

  })






</script>