<?php
header("Content-Type: application/json");
include 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Requisição Inválida']);
        break;
}

function handleGet($pdo) {
    $sql = "SELECT * FROM tipo_atendimento";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input) {
    $sql = "INSERT INTO tipo_atendimento (tipo_atendimento, ativo) VALUES (:tipo_atendimento, :ativo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['tipo_atendimento' => $input['tipo_atendimento'], 'ativo' => $input['ativo']]);
    echo json_encode(['message' => 'Tipo de Atendimento inserido com sucesso']);
}

function handlePut($pdo, $input) {
    $sql = "UPDATE tipo_atendimento SET tipo_atendimento = :tipo_atendimento, ativo = :ativo WHERE id_tipo_atendimento = :id_tipo_atendimento";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['tipo_atendimento' => $input['tipo_atendimento'], 'ativo' => $input['ativo'], 'id_tipo_atendimento' => $input['id_tipo_atendimento']]);
    echo json_encode(['message' => 'Tipo de Atendimento atualizado com sucesso']);
}

function handleDelete($pdo, $input) {
    $sql = "DELETE FROM tipo_atendimento WHERE id_tipo_atendimento = :id_tipo_atendimento";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_tipo_atendimento' => $input['id_tipo_atendimento']]);
    echo json_encode(['message' => 'Tipo de Atendimento excluído com sucesso']);
}
?>