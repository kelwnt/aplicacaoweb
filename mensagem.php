<?php if(isset($_SESSION['MENSAGEM']) && !empty($_SESSION['MENSAGEM'])): ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sucesso!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $_SESSION['MENSAGEM']; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para acionar a modal automaticamente -->
    <script>
        // Espera o documento HTML ser completamente carregado
        document.addEventListener("DOMContentLoaded", function() {
            // Aciona a modal
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        });
    </script>
<?php endif; ?>


<?php unset($_SESSION['MENSAGEM']); // Limpar a mensagem após exibi-la ?>


