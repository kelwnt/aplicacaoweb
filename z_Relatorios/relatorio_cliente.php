<?php
session_start();
include_once '../php_action/db_connect.php';
include_once '../functions.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3 class="text-center">Relatório de Clientes</h3>
        <form method="GET" action="">
            <div class="input-group mb-3">
                <span class="input-group-text">Buscar por:</span>
                <select class="form-select" name="searchBy">
                    <option value="nome">Todos</option>
                    <option value="cnpj">Nome</option>
                    <option value="nome">CNPJ</option>
                </select>
                <span class="input-group-text">Termo:</span>
                <input type="text" name="term" class="form-control">
                <button type="submit" class="btn btn-info">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </div>
        </form>

        <table class="table table-striped text-center mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th><th>Nome</th><th>CNPJ</th><th>Telefone</th><th>Ativo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM cliente";
                $_SESSION['rel_cliente'] = $sql;

                if (!empty($_GET['searchBy']) && !empty($_GET['term'])) {
                    $searchBy = $_GET['searchBy'];
                    $term = $searchBy === 'cnpj' ? preg_replace("/[^0-9]/", "", $_GET['term']) : addslashes($_GET['term']);
                    $sql .= " WHERE $searchBy LIKE '%$term%'";
                    $_SESSION['rel_cliente'] = $sql;
                }

                $resultado = mysqli_query($connect, $sql);

                if (mysqli_num_rows($resultado) > 0):
                    while ($dados = mysqli_fetch_assoc($resultado)):
                ?>
                        <tr>
                            <td><?= htmlspecialchars($dados['id_cliente']) ?></td>
                            <td><?= htmlspecialchars($dados['nome']) ?></td>
                            <td><?= formatar_CNPJ($dados['cnpj']) ?></td>
                            <td><?= telephone($dados['telefone']) ?></td>
                            <td><?= $dados['ativo'] ? 'Sim' : 'Não' ?></td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr><td colspan="5">Nenhum cliente encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <form method="post" action="gerar_pdf_clientes.php" target="_blank">
            <button type="submit" class="btn btn-danger float-end">
                <i class="bi bi-file-earmark-pdf"></i> Gerar PDF
            </button>
        </form>
    </div>
</body>
</html>
