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
    $sql = "SELECT * FROM atendente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input) {
    $sql = "INSERT INTO atendente (login, senha, nome, cpf, tipo_acesso, ativo) VALUES (:login, :senha, :nome, :cpf, :tipo_acesso, :ativo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['login' => $input['login'], 'senha' => $input['senha'], 'nome' => $input['nome'], 'cpf' => $input['cpf'], 'tipo_acesso' => $input['tipo_acesso'], 'ativo' => $input['ativo']]);
    echo json_encode(['message' => 'Atendente inserido com sucesso']);
}

function handlePut($pdo, $input) {
    $sql = "UPDATE atendente SET login = :login, nome = :nome, senha = :senha, cpf = :cpf, tipo_acesso = :tipo_acesso, ativo = :ativo WHERE id_atendente = :id_atendente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['login' => $input['login'], 'senha' => $input['senha'], 'nome' => $input['nome'], 'cpf' => $input['cpf'], 'tipo_acesso' => $input['tipo_acesso'], 'ativo' => $input['ativo'],  'id_atendente' => $input['id_atendente']]);
    echo json_encode(['message' => 'Atendente atualizado com sucesso']);
}

function handleDelete($pdo, $input) {
    $sql = "DELETE FROM atendente WHERE id_atendente = :id_atendente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_atendente' => $input['id_atendente']]);
    echo json_encode(['message' => 'Atendente excluído com sucesso']);
}
?>