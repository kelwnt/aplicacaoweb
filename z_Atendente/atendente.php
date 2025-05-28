<?php


include_once '../php_action/db_connect.php';

include_once 'selects_Atendente.php';

include_once '../functions.php';

//sessao
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atendentes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <div class="bg-dark text-white text-center py-3 rounded mb-4">
            <h4>Atendentes</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Código</th>
                        <th>Login</th>
                        <th>Nome</th>
                        <th>Tipo de Acesso</th>
                        <th>Ativo</th>
                        <th>Alterar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM atendente";
                    $resultado = mysqli_query($connect, $sql);

                    while ($dados = mysqli_fetch_array($resultado)):
                    ?>
                        <tr>
                            <td><?= $dados['id_atendente']; ?></td>
                            <td><?= $dados['login']; ?></td>
                            <td><?= $dados['nome']; ?></td>
                            <td>
                                <?php
                                echo strtoupper($dados['tipo_acesso']) === 'A'
                                    ? '<i class="fas fa-user-shield text-primary"></i> Admin'
                                    : '<i class="fas fa-headset text-info"></i> Atendente';
                                ?>
                            </td>
                            <td>
                                <?php
                                echo strtoupper($dados['ativo']) === 'A'
                                    ? '<i class="bi bi-check-circle-fill text-success"></i>'
                                    : '<i class="bi bi-x-circle-fill text-danger"></i>';
                                ?>
                            </td>
                            <td>
                                <a href="editar_atendente.php?id_atendente=<?php echo $dados['id_atendente']; ?>"
								    class="btn btn-warning" role="button">
								    <i class="bi bi-pencil"></i> Editar
								</a>
                            </td>

                            <td class="table-cell align-middle">
                                <?php if (strtoupper($dados['ativo']) === 'A'): ?>
                                    <form method="POST" action="crud_Atendente/inativar_atendente.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $dados['id_atendente']; ?>">
                                        <button type="submit" name="btn-deletar" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Deletar
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form method="POST" action="crud_Atendente/reativar_atendente.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $dados['id_atendente']; ?>">
                                        <button type="submit" name="btn-reativar" class="btn btn-info btn-sm">
                                            <i class="bi bi-arrow-clockwise"></i> Reativar
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <a href="adicionar_atendente.php" class="btn btn-secondary">
                <i class="bi bi-plus"></i> Adicionar Atendente
            </a>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
