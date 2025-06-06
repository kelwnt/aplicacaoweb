<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../dompdf/autoload.inc.php';
include_once '../php_action/db_connect.php';
include_once '../functions.php';

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

$sql = $_SESSION['rel_cliente'] ?? "SELECT * FROM cliente";
$resultado = mysqli_query($connect, $sql);

// Configura DomPDF
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);

// Gera HTML
$html = '<h2 style="text-align: center;">Relatório de Clientes</h2>
<table border="1" width="100%" style="border-collapse: collapse; font-size: 12px;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>ID</th><th>Nome</th><th>CNPJ</th><th>Telefone</th><th>Ativo</th>
        </tr>
    </thead>
    <tbody>';

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($dados = mysqli_fetch_assoc($resultado)) {
        $html .= '<tr>
            <td>' . htmlspecialchars($dados['id_cliente']) . '</td>
            <td>' . htmlspecialchars($dados['nome']) . '</td>
            <td>' . formatar_CNPJ($dados['cnpj']) . '</td>
            <td>' . telephone($dados['telefone']) . '</td>
            <td>' . ($dados['ativo'] ? 'Sim' : 'Não') . '</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="5">Nenhum cliente encontrado.</td></tr>';
}

$html .= '</tbody></table>';

// Gera o PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("relatorio_clientes.pdf", ["Attachment" => false]);
exit;
