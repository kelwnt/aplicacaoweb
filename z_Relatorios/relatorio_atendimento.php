<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../dompdf/autoload.inc.php';
include_once '../php_action/db_connect.php';
include_once '../functions.php'; // caso tenha funções úteis

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

// Pega SQL salvo na sessão, ou default
$sql = $_SESSION['rel_atendimento'] ?? "SELECT * FROM atendimento ORDER BY id_atendimento DESC";
$resultado = mysqli_query($connect, $sql);

// Configura DomPDF
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);

// Monta o HTML do PDF
$html = '
<h2 style="text-align: center; color:#003366; border-bottom: 2px solid #003366; padding-bottom: 10px;">Relatório de Atendimentos</h2>
<table border="1" width="100%" style="border-collapse: collapse; font-size: 12px;">
    <thead style="background-color: #f0f0f0;">
        <tr>
            <th>Código</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody>';

// Loop dos atendimentos
if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($dados = mysqli_fetch_assoc($resultado)) {
        $id_cliente = $dados['id_cliente'];
        $id_tipo = $dados['id_tipo_atendimento'];
        $id_atendente = $dados['id_atendente'];

        // Busca dados relacionados (cliente, tipo, atendente)
        $cliente_query = mysqli_query($connect, "SELECT nome FROM cliente WHERE id_cliente = '$id_cliente'");
        $tipo_query = mysqli_query($connect, "SELECT tipo_atendimento FROM tipo_atendimento WHERE id_tipo_atendimento = '$id_tipo'");
        $atendente_query = mysqli_query($connect, "SELECT nome FROM atendente WHERE id_atendente = '$id_atendente'");

        $nome_cliente = mysqli_fetch_assoc($cliente_query)['nome'] ?? 'N/D';
        $nome_tipo = mysqli_fetch_assoc($tipo_query)['tipo_atendimento'] ?? 'N/D';
        $nome_atendente = mysqli_fetch_assoc($atendente_query)['nome'] ?? 'N/D';

        $status_texto = match ($dados['ativo']) {
            'A' => 'Ativo',
            'C' => 'Concluído',
            'D' => 'Deletado',
            default => 'Desconhecido'
        };

        $html .= '
        <tr>
            <td style="text-align:center;">' . $dados['id_atendimento'] . '</td>
            <td style="text-align:center;">' . date('d/m/Y', strtotime($dados['dt_inicio'])) . '</td>
            <td style="text-align:center;">' . date('d/m/Y', strtotime($dados['dt_fim'])) . '</td>
            <td>' . htmlspecialchars($nome_cliente) . '</td>
        </tr>
        <tr>
            <td colspan="4" style="padding: 0;">
                <table class="subtable" border="1" width="100%" style="border-collapse: collapse; font-size: 11px;">
                    <thead style="background-color: #f9f9f9;">
                        <tr>
                            <th>Tipo Atendimento</th>
                            <th>Atendente</th>
                            <th>Descrição</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>' . htmlspecialchars($nome_tipo) . '</td>
                            <td>' . htmlspecialchars($nome_atendente) . '</td>
                            <td>' . htmlspecialchars($dados['descricao']) . '</td>
                            <td style="text-align:center;">' . $status_texto . '</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="4" style="text-align:center;">Nenhum atendimento encontrado.</td></tr>';
}

$html .= '
    </tbody>
</table>
<p style="text-align:center; font-size:10px; color:#666; margin-top: 20px;">
    Relatório gerado em ' . date('d/m/Y \à\s H:i') . '
</p>';

// Renderiza PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("relatorio_atendimentos.pdf", ["Attachment" => false]);
exit;
