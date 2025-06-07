<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../dompdf/autoload.inc.php';
include_once '../php_action/db_connect.php';
include_once '../functions.php';

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

date_default_timezone_set('America/Sao_Paulo');

$sql = $_SESSION['rel_cliente'] ?? "SELECT * FROM cliente";
$resultado = mysqli_query($connect, $sql);

// Configura DomPDF
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);

// Gera HTML
$html = '  
    <html><head><style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { text-align: center; color: #333; }
    .logo { text-align: center; margin-bottom: 20px; }
    .logo img { height: 60px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ccc; padding: 6px; text-align: center; }
    th { background-color: #f2f2f2; }
    tfoot td { border: none; text-align: right; font-size: 10px; color: #777; }
</style></head><body>';

$html .= '<div class="logo"><img src="../img/logo.png" alt="Logo da Empresa"></div>';
$html .= '<h2>Relatório de Clientes</h2>';
$html .= '<table><thead>
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
$html .= '<footer><p style="text-align:right; font-size:10px; margin-top:20px;">Gerado em: ' . date('d/m/Y H:i') . '</p></footer>';
$html .= '</body></html>';

// Gera o PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("relatorio_clientes.pdf", ["Attachment" => false]);
exit;
