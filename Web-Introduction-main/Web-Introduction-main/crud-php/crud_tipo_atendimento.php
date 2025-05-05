

<?php
// Conexão com o banco
$pdo = new PDO('mysql:host=localhost;dbname=ratendimento', 'root', '');

// Criar tabela se não existir
$pdo->exec("CREATE TABLE IF NOT EXISTS tipo_atendimento (
    id_tipo_atendimento INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo_atendimento VARCHAR(45) NOT NULL,
    ativo VARCHAR(1) NOT NULL DEFAULT 'S'
)");

// Processar ações
$acao = $_GET['acao'] ?? '';
$id = $_GET['id'] ?? '';

if ($acao === 'salvar') {
    $tipo = $_POST['tipo_atendimento'];
    $id_editar = $_POST['id'] ?? '';

    if ($id_editar) {
        $stmt = $pdo->prepare("UPDATE tipo_atendimento SET tipo_atendimento = ? WHERE id_tipo_atendimento = ?");
        $stmt->execute([$tipo, $id_editar]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO tipo_atendimento (tipo_atendimento, ativo) VALUES (?, 'S')");
        $stmt->execute([$tipo]);
    }
    header('Location: crud_tipo_atendimento.php');
    exit;
}

if ($acao === 'editar' && $id) {
    $stmt = $pdo->prepare("SELECT * FROM tipo_atendimento WHERE id_tipo_atendimento = ?");
    $stmt->execute([$id]);
    $registro = $stmt->fetch();
}

if ($acao === 'inativar' && $id) {
    $stmt = $pdo->prepare("UPDATE tipo_atendimento SET ativo = 'N' WHERE id_tipo_atendimento = ?");
    $stmt->execute([$id]);
    header('Location: crud_tipo_atendimento.php');
    exit;
}

if ($acao === 'reativar' && $id) {
    $stmt = $pdo->prepare("UPDATE tipo_atendimento SET ativo = 'S' WHERE id_tipo_atendimento = ?");
    $stmt->execute([$id]);
    header('Location: crud_tipo_atendimento.php');
    exit;
}

// Listar tudo
$stmt = $pdo->query("SELECT * FROM tipo_atendimento");
$tipos = $stmt->fetchAll();
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> <!-- Seu arquivo CSS personalizado -->
</head>

<h2>Tipo de Atendimento</h2>
<form method="POST" action="?acao=salvar">
    <input type="hidden" name="id" value="<?= $registro['id_tipo_atendimento'] ?? '' ?>">
    <label>Tipo:</label>
    <input type="text" name="tipo_atendimento" value="<?= $registro['tipo_atendimento'] ?? '' ?>" required>
    <button type="submit">Salvar</button>
</form>

<h3>Lista de Tipos</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Ativo</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($tipos as $tipo): ?>
    <tr>
        <td><?= $tipo['id_tipo_atendimento'] ?></td>
        <td><?= $tipo['tipo_atendimento'] ?></td>
        <td><?= $tipo['ativo'] === 'S' ? 'Sim' : 'Não' ?></td>
        <td>
            <a href="?acao=editar&id=<?= $tipo['id_tipo_atendimento'] ?>">Editar</a> |
            <?php if ($tipo['ativo'] === 'S'): ?>
                <a href="?acao=inativar&id=<?= $tipo['id_tipo_atendimento'] ?>">Inativar</a>
            <?php else: ?>
                <a href="?acao=reativar&id=<?= $tipo['id_tipo_atendimento'] ?>">Reativar</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


