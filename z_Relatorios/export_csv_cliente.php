<?php
session_start();
include_once '../php_action/db_connect.php';
include_once '../functions.php';

header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=relatorio_clientes_" . date('Y-m-d') . ".csv");

ob_clean();
flush();

echo "\xEF\xBB\xBF";

$sql = $_SESSION['rel_cliente'] ?? "SELECT * FROM cliente";
$result = mysqli_query($connect, $sql);

if (!$result) {
    echo "Erro na consulta.";
    exit;
}

echo "ID Cliente;Nome;CNPJ;Telefone;Status\n";

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['id_cliente'] . ';';
    echo $row['nome'] . ';';
    echo formatar_CNPJ($row['cnpj']) . ';';
    echo telephone($row['telefone']) . ';';
    echo ($row['ativo'] === 'A' ? 'Ativo' : 'Inativo') . "\n";
}
exit;
?>