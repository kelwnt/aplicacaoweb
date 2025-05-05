 <!-- Modal de confirmação para deletar -->
 <div class="modal fade" id="modal_reativar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja reativar este cliente?</p>
                </div>
                <div class="modal-footer">
                    <form action="crud_Cliente/reativar_cliente.php" method="post">
                        <input type="hidden" id="reativaId" name="id" value="">
                        <button type="submit" name="btn-reativar" class="btn btn-danger">Sim, quero reativar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>