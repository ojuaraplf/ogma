<!-- Modal -->
<div class="modal fade" id="modalConfirmarAssociacaoAtividades" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarAssociacaoAtividadesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmarAssociacaoAtividadesLabel">ALERTA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                As informações alteradas nas atividades MUCadas não poderão ser redefinidias, tem certeza que deseja prosseguir?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarAssociacaoAtividades"> Confirmar </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#btnConfirmarAssociacaoAtividades').click(function() {
        $('#modalConfirmarAssociacaoAtividades').modal('hide');

        $('#divAlertReturnAssoc').attr("class", "alert alert-primary");
        $('#divAlertReturnAssoc').text("Salvando...");

        $.when(salvarAtividadesAssociadas()).done(function(r1) {
            $('#divAlertReturnAssoc').attr("class", "alert alert-success");
            $('#divAlertReturnAssoc').text("Salvo!");

            $('#modalDetalhesGrupoAtividadesAssociadas').modal('hide');

            $('#divAlertReturnAssoc').attr("class", "alert alert-light");
            $('#divAlertReturnAssoc').html("&nbsp;");
        })



    });
</script>