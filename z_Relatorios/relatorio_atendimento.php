<?php
session_start();
include_once '../php_action/db_connect.php';
include_once '../functions.php';

// FILTROS
$filtro_cliente = $_GET['cliente'] ?? '';
$filtro_status = $_GET['status'] ?? '';
$filtro_tipo = $_GET['tipo'] ?? '';
$data_inicio = $_GET['data_inicio'] ?? '';
$data_fim = $_GET['data_fim'] ?? '';

// PREPARAÇÃO DE COMBOS
$clientes_result = mysqli_query($connect, "SELECT id_cliente, nome FROM cliente ORDER BY nome ASC");
$tipos_result = mysqli_query($connect, "SELECT id_tipo_atendimento, tipo_atendimento FROM tipo_atendimento ORDER BY tipo_atendimento ASC");

// CONSULTA BASE
$sql = "SELECT * FROM atendimento WHERE 1=1";

// APLICA FILTROS
if (!empty($filtro_cliente)) {
    $id_cliente = mysqli_real_escape_string($connect, $filtro_cliente);
    $sql .= " AND id_cliente = '$id_cliente'";
}
if (!empty($filtro_status)) {
    $status = mysqli_real_escape_string($connect, $filtro_status);
    $sql .= " AND ativo = '$status'";
}
if (!empty($filtro_tipo)) {
    $tipo = mysqli_real_escape_string($connect, $filtro_tipo);
    $sql .= " AND id_tipo_atendimento = '$tipo'";
}
if (!empty($data_inicio)) {
    $data = mysqli_real_escape_string($connect, $data_inicio);
    $sql .= " AND dt_inicio >= '$data'";
}
if (!empty($data_fim)) {
    $data = mysqli_real_escape_string($connect, $data_fim);
    $sql .= " AND dt_inicio <= '$data'";
}

$resultado = mysqli_query($connect, $sql);
$_SESSION['rel_cliente'] = $sql;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
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

        <!-- FORMULÁRIO DE FILTRO -->
        <form method="GET" class="mb-3 row g-2">
            <div class="col-md-3">
                <label class="form-label">Cliente:</label>
                <select name="cliente" class="form-select">
                    <option value="">Todos</option>
                    <?php while ($c = mysqli_fetch_assoc($clientes_result)): ?>
                        <option value="<?= $c['id_cliente'] ?>" <?= ($filtro_cliente == $c['id_cliente']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nome']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select">
                    <option value="">Todos</option>
                    <option value="A" <?= ($filtro_status == 'A') ? 'selected' : '' ?>>Ativo</option>
                    <option value="C" <?= ($filtro_status == 'C') ? 'selected' : '' ?>>Concluído</option>
                    <option value="D" <?= ($filtro_status == 'D') ? 'selected' : '' ?>>Deletado</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Tipo Atendimento:</label>
                <select name="tipo" class="form-select">
                    <option value="">Todos</option>
                    <?php while ($t = mysqli_fetch_assoc($tipos_result)): ?>
                        <option value="<?= $t['id_tipo_atendimento'] ?>" <?= ($filtro_tipo == $t['id_tipo_atendimento']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($t['tipo_atendimento']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Data Início:</label>
                <input type="date" name="data_inicio" value="<?= htmlspecialchars($data_inicio) ?>" class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label">Data Fim:</label>
                <input type="date" name="data_fim" value="<?= htmlspecialchars($data_fim) ?>" class="form-control">
            </div>

            <div class="col-md-12 mt-2 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel-fill"></i> Filtrar
                </button>
            </div>
        </form>

        <div class="rounded border border-secondary p-3">
            <table class="table table-striped text-center">
                <thead>
                    <tr class="table-header">
                        <th>Código</th>
                        <th>Data Início</th>
                        <th>Data Fim</th>
                        <th>Cliente</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($resultado) > 0): ?>
                    <?php while ($dados = mysqli_fetch_assoc($resultado)):
                        $tipo = mysqli_fetch_assoc(mysqli_query($connect, "SELECT tipo_atendimento FROM tipo_atendimento WHERE id_tipo_atendimento = '{$dados['id_tipo_atendimento']}'"));
                        $cliente = mysqli_fetch_assoc(mysqli_query($connect, "SELECT nome FROM cliente WHERE id_cliente = '{$dados['id_cliente']}'"));
                        $atendente = mysqli_fetch_assoc(mysqli_query($connect, "SELECT nome FROM atendente WHERE id_atendente = '{$dados['id_atendente']}'"));
                    ?>
                        <tr>
                            <td><?= $dados['id_atendimento'] ?></td>
                            <td><?= date('d/m/Y', strtotime($dados['dt_inicio'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($dados['dt_fim'])) ?></td>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td>
                                <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#details-<?= $dados['id_atendimento'] ?>">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </td>
                        </tr>
                        <tr id="details-<?= $dados['id_atendimento'] ?>" class="collapse">
                            <td colspan="5">
                                <table class="table table-bordered text-center">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Tipo Atendimento</th>
                                            <th>Atendente</th>
                                            <th>Descrição</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= htmlspecialchars($tipo['tipo_atendimento']) ?></td>
                                            <td><?= htmlspecialchars($atendente['nome']) ?></td>
                                            <td><?= htmlspecialchars($dados['descricao']) ?></td>
                                            <td>
                                                <?php
                                                echo match ($dados['ativo']) {
                                                    'A' => '<i class="bi bi-check-circle-fill text-success"></i>',
                                                    'C' => '<i class="bi bi-check-circle-fill text-info"></i>',
                                                    'D' => '<i class="bi bi-x-circle-fill text-danger"></i>',
                                                    default => 'Desconhecido'
                                                };
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Nenhum atendimento encontrado.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <form method="post" action="export_pdf.php" target="_blank">
            <button type="submit" name="export" value="pdf export" class="btn btn-danger mt-3 float-end">
                <i class="bi bi-file-earmark-pdf"></i> Gerar PDF
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
