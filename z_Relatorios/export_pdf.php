<?php
require_once '../dompdf/autoload.inc.php';
require_once '../php_action/db_connect.php';

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

date_default_timezone_set('America/Sao_Paulo');

// Usa a última consulta com filtros
$sql = $_SESSION['rel_cliente'] ?? "SELECT * FROM atendimento";
$result = mysqli_query($connect, $sql);

// Cabeçalho do HTML
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


$html .= '<h2>Relatório de Atendimentos</h2>';
$html .= '<table><thead>
<tr>
    <th>Código</th>
    <th>Data Início</th>
    <th>Data Fim</th>
    <th>Cliente</th>
    <th>Tipo Atendimento</th>
    <th>Atendente</th>
    <th>Descrição</th>
    <th>Status</th>
</tr>
</thead><tbody>';

// Preenche os dados da tabela
while ($row = mysqli_fetch_assoc($result)) {
    $cliente = mysqli_fetch_assoc(mysqli_query($connect, "SELECT nome FROM cliente WHERE id_cliente = '{$row['id_cliente']}'"));
    $tipo = mysqli_fetch_assoc(mysqli_query($connect, "SELECT tipo_atendimento FROM tipo_atendimento WHERE id_tipo_atendimento = '{$row['id_tipo_atendimento']}'"));
    $atendente = mysqli_fetch_assoc(mysqli_query($connect, "SELECT nome FROM atendente WHERE id_atendente = '{$row['id_atendente']}'"));

    $status = match($row['ativo']) {
        'A' => 'Ativo',
        'C' => 'Concluído',
        'D' => 'Deletado',
        default => 'Desconhecido'
    };

    $html .= "<tr>
        <td>{$row['id_atendimento']}</td>
        <td>" . date('d/m/Y', strtotime($row['dt_inicio'])) . "</td>
        <td>" . date('d/m/Y', strtotime($row['dt_fim'])) . "</td>
        <td>" . htmlspecialchars($cliente['nome']) . "</td>
        <td>" . htmlspecialchars($tipo['tipo_atendimento']) . "</td>
        <td>" . htmlspecialchars($atendente['nome']) . "</td>
        <td>" . htmlspecialchars($row['descricao']) . "</td>
        <td>$status</td>
    </tr>";
}


$html .= '</tbody></table>';
$html .= '<footer><p style="text-align:right; font-size:10px; margin-top:20px;">Gerado em: ' . date('d/m/Y H:i') . '</p></footer>';
$html .= '</body></html>';

// Gera o PDF
$options = new Options();
$options->set('isRemoteEnabled', true); // para permitir imagens externas se necessário
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("relatorio_atendimentos.pdf", ["Attachment" => false]);
exit;
