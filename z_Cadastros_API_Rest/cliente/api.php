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
    $sql = "SELECT * FROM cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input) {
    $sql = "INSERT INTO cliente (nome, cpf, telefone, ativo) VALUES (:nome, :cpf, :telefone, :ativo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $input['nome'], 'cpf' => $input['cpf'], 'telefone' => $input['telefone'], 'ativo' => $input['ativo']]);
    echo json_encode(['message' => 'Atendente inserido com sucesso']);
}

function handlePut($pdo, $input) {
    $sql = "UPDATE cliente SET nome = :nome, cpf = :cpf, telefone = :telefone, ativo = :ativo WHERE id_cliente = :id_cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $input['nome'], 'cpf' => $input['cpf'], 'telefone' => $input['telefone'], 'ativo' => $input['ativo'],  'id_cliente' => $input['id_cliente']]);
    echo json_encode(['message' => 'Cliente atualizado com sucesso']);
}

function handleDelete($pdo, $input) {
    $sql = "DELETE FROM cliente WHERE id_cliente = :id_cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_cliente' => $input['id_cliente']]);
    echo json_encode(['message' => 'Cliente excluído com sucesso']);
}
?>