<?php
session_start();
include_once '../php_action/db_connect.php';
include_once '../functions.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Atendimento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="row mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="p-1 mb-3 bg-dark text-white rounded border border-light">
                <h3 class="text-center">Relatório de Clientes</h3>
            </div>
            <div class="rounded border border-secondary p-3">
                <form method="GET" action="">
                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="min-width: 10%;">Buscar por:</span>
                            <select class="form-select" id="searchBy" name="searchBy">
                                <option value="nome">Nome</option>
                                <option value="cnpj">CNPJ</option>
                            </select>
                            <span class="input-group-text" style="min-width: 5%;">Termo de Busca</span>
                            <input type="text" name="term" id="term" class="form-control" value="">
                            <button type="submit" class="btn btn-info">
                                <i class="bi bi-search"></i> Pesquisar
                            </button>
                        </div>
                    </div>
                </form>

                <table class="table table-striped text-center mt-3">
                    <thead>
                        <tr>
                            <th>ID Cliente</th>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>Telefone</th>
                            <th>Ativo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM cliente";
                        $_SESSION['rel_cliente'] = $sql;

                        if (isset($_GET['searchBy'], $_GET['term']) && !empty($_GET['term'])) {
                            $searchBy = $_GET['searchBy'];
                            $term = $_GET['term'];

                            if ($searchBy == 'cnpj') {
                                echo "<p class='text-muted'>Buscando por CNPJ. Não é necessário formatar.</p>";
                                $term = str_replace(['.', '/', '-'], '', $term);
                            } else {
                                $term = addslashes($term);
                            }

                            $sql .= " WHERE $searchBy LIKE '%$term%'";
                            $_SESSION['rel_cliente'] = $sql;
                        }

                        $resultado = mysqli_query($connect, $sql);

                        if (mysqli_num_rows($resultado) > 0) :
                            while ($dados = mysqli_fetch_array($resultado)) :
                        ?>
                                <tr>
                                    <td><?php echo $dados['id_cliente']; ?></td>
                                    <td><?php echo $dados['nome']; ?></td>
                                    <td><?php echo formatar_CNPJ($dados['cnpj']); ?></td>
                                    <td><?php echo telephone($dados['telefone']); ?></td>
                                    <td><?php echo $dados['ativo']; ?></td>
                                </tr>
                            <?php endwhile;
                        else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Nenhum cliente encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <form method="post" action="gerar_pdf_clientes.php" target="_blank">
                <button type="submit" class="btn btn-danger mt-3 float-end">
                    <i class="bi bi-file-earmark-pdf"></i> Gerar PDF
                </button>
            </form>
        </div>
    </div>
</body>

</html>
