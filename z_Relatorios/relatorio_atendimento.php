<?php
session_start();

// Conexão com o banco de dados
include_once '../php_action/db_connect.php';
include_once '../functions.php';

// Carregar clientes para o filtro
$sql_clientes = "SELECT * FROM cliente ORDER BY nome ASC";
$resultado_clientes = mysqli_query($connect, $sql_clientes);

// Captura dos filtros
$filtro_status = isset($_GET['status']) ? $_GET['status'] : '';
$filtro_cliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';

// Montagem da SQL base
$sql = "SELECT * FROM atendimento WHERE 1=1";

// Aplica filtro de status
if (!empty($filtro_status)) {
    $sql .= " AND ativo = '$filtro_status'";
}

// Aplica filtro de cliente
if (!empty($filtro_cliente)) {
    $sql .= " AND id_cliente = '$filtro_cliente'";
}

$_SESSION['rel_atendimento'] = $sql;
$resultado = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório de Atendimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="row mt-4">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="p-2 mb-3 bg-dark text-white rounded border border-light">
            <h3 class="text-center">Relatórios de Atendimentos</h3>
        </div>

        <!-- Filtros -->
        <form method="GET" action="">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Filtrar por Cliente:</label>
                    <select class="form-select" name="cliente">
                        <option value="">Todos os Clientes</option>
                        <?php while ($cli = mysqli_fetch_assoc($resultado_clientes)): ?>
                            <option value="<?= $cli['id_cliente'] ?>" <?= ($filtro_cliente == $cli['id_cliente']) ? 'selected' : '' ?>>
                                <?= $cli['nome'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Filtrar por Status:</label>
                    <select class="form-select" name="status">
                        <option value="">Todos</option>
                        <option value="A" <?= ($filtro_status == 'A') ? 'selected' : '' ?>>Ativo</option>
                        <option value="C" <?= ($filtro_status == 'C') ? 'selected' : '' ?>>Concluído</option>
                        <option value="D" <?= ($filtro_status == 'D') ? 'selected' : '' ?>>Deletado</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-info w-100"><i class="bi bi-search"></i> Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Tabela -->
        <div class="rounded border border-secondary p-3">
            <table class="table table-striped text-center">
                <thead>
                <tr class="table-primary">
                    <th>Código</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Cliente</th>
                    <th>Detalhes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($resultado) > 0):
                    while ($dados = mysqli_fetch_assoc($resultado)):
                        $id_cliente = $dados['id_cliente'];
                        $id_tipo = $dados['id_tipo_atendimento'];
                        $id_atendente = $dados['id_atendente'];

                        // Buscar dados relacionados
                        $dados_cliente = mysqli_fetch_assoc(mysqli_query($connect, "SELECT nome FROM cliente WHERE id_cliente = '$id_cliente'"));
                        $dados_tipo = mysqli_fetch_assoc(mysqli_query($connect, "SELECT tipo_atendimento FROM tipo_atendimento WHERE id_tipo_atendimento = '$id_tipo'"));
                        $dados_atendente = mysqli_fetch_assoc(mysqli_query($connect, "SELECT nome FROM atendente WHERE id_atendente = '$id_atendente'"));
                        ?>
                        <tr>
                            <td><?= $dados['id_atendimento'] ?></td>
                            <td><?= date('d/m/Y', strtotime($dados['dt_inicio'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($dados['dt_fim'])) ?></td>
                            <td><?= $dados_cliente['nome'] ?></td>
                            <td>
                                <button class="btn btn-success" data-bs-toggle="collapse"
                                        data-bs-target="#details-<?= $dados['id_atendimento'] ?>">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </td>
                        </tr>
                        <tr id="details-<?= $dados['id_atendimento'] ?>" class="collapse">
                            <td colspan="5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th>Tipo Atendimento</th>
                                        <th>Nome Atendente</th>
                                        <th>Descrição</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?= $dados_tipo['tipo_atendimento'] ?></td>
                                        <td><?= $dados_atendente['nome'] ?></td>
                                        <td><?= $dados['descricao'] ?></td>
                                        <td>
                                            <?php
                                            $status = $dados['ativo'];
                                            echo match ($status) {
                                                'A' => '<i class="bi bi-check-circle-fill text-success" title="Ativo"></i>',
                                                'D' => '<i class="bi bi-x-circle-fill text-danger" title="Deletado"></i>',
                                                'C' => '<i class="bi bi-check-circle-fill text-info" title="Concluído"></i>',
                                                default => $status
                                            };
                                            ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr><td colspan="5" class="text-center">Nenhum atendimento encontrado.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Botão de Exportação -->
        <form method="post" action="export_csv.php">
            <button type="submit" name="export" class="btn btn-secondary mt-3 float-end">
                <i class="bi bi-download"></i> Gerar CSV
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
