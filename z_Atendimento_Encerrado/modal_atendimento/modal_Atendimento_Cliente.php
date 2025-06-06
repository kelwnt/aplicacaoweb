<!-- Modal de confirmação para deletar -->
<div class="modal fade" id="modal_cliente" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecionar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="table-primary">
                            <th class="align-middle">Código: </th>
                            <th class="align-middle">Nome: </th>
                            <th class="align-middle">CNPJ: </th>
                            <th class="align-middle">Selecionar: </th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sql_cliente = "select * from cliente";
                        $resultado_cliente = mysqli_query($connect, $sql_cliente);

                        //$sql_cliente = "select * from cliente";
                        //$resultado_cliente = mysqli_query($connect, $sql_cliente);
                        
                        if (mysqli_num_rows($resultado_cliente) > 0):
                            while ($dados_cliente = mysqli_fetch_array($resultado_cliente)):
                                ?>
                                <tr>
                                    <td class="table-cell align-middle">
                                        <?php echo $dados_cliente['id_cliente']; ?>
                                    </td>
                                    <td class="table-cell align-middle">
                                        <?php echo $dados_cliente['nome']; ?>
                                    </td>
                                    <td class="table-cell align-middle">
                                        <?php
                                        $cnpj = $dados_cliente['cnpj'];
                                        echo substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
                                        ?>
                                    </td>
                                    <td class="table-cell align-middle">
                                        <button
                                            onclick="myFunction(' <?php echo $dados_cliente['nome']; ?>', <?php echo $dados_cliente['id_cliente']; ?>)"
                                            type="button" class="btn btn-success" data-bs-dismiss="modal"><i
                                                class="fas fa-check"></i></button>
                                    </td>



                                </tr>

                            <?php endwhile;
                        else; ?>

                            <?php
                        endif;
                        ?>

                    </tbody>
                </table>
            </div>


        </div>
        <!--<div class="modal-footer">
            <form action="crud_Atendimento/fechar_atendimento.php" method="post">
                <input type="hidden" id="deleteId" name="id" value="">
                <button type="submit" name="btn-deletar" class="btn btn-danger">Sim, quero deletar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </form>
        </div>-->
    </div>
</div>
</div>