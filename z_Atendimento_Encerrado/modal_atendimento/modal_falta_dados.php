 <!-- Modal de confirmação selecionar o cliente -->
 <div class="modal fade" id="modal_alerta" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alerta!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Todos os dados precisam estar preenchidos</p>
                </div>
                <div class="modal-footer">
                    <form action="crud_Atendimento/fechar_atendimento.php" method="post">                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </form>
                </div>
            </div>
        </div>
    </div>