<?php
require_once '../dompdf/autoload.inc.php';
include_once '../php_action/db_connect.php';
include_once '../functions.php';

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

// Recupera a consulta usada na visualização
$sql = $_SESSION['rel_cliente'] ?? "SELECT * FROM cliente";
$resultado = mysqli_query($connect, $sql);

// Configura o DomPDF
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

// Gera o conteúdo HTML
$html = '
<h2 style="text-align: center;">Relatório de Clientes</h2>
<table border="1" width="100%" style="border-collapse: collapse; font-size: 12px;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>ID</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Telefone</th>
            <th>Ativo</th>
        </tr>
    </thead>
    <tbody>';

if (mysqli_num_rows($resultado) > 0) {
    while ($dados = mysqli_fetch_array($resultado)) {
        $html .= '<tr>
            <td>' . $dados['id_cliente'] . '</td>
            <td>' . $dados['nome'] . '</td>
            <td>' . formatar_CNPJ($dados['cnpj']) . '</td>
            <td>' . telephone($dados['telefone']) . '</td>
            <td>' . $dados['ativo'] . '</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="5">Nenhum cliente encontrado.</td></tr>';
}

$html .= '</tbody></table>';

// Renderiza o PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Exibe o PDF no navegador
$dompdf->stream("relatorio_clientes.pdf", ["Attachment" => false]);
exit;
