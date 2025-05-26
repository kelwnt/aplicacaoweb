<?php
session_start();

include_once '../../php_action/db_connect.php';

if (isset($_POST['btn-cadastrar'])) {
    // Proteção contra SQL Injection
    $nome = mysqli_real_escape_string($connect, $_POST['nome']);
    $login = mysqli_real_escape_string($connect, $_POST['login']);
    $senha = mysqli_real_escape_string($connect, $_POST['senha']);
    $tipo_acesso = mysqli_real_escape_string($connect, $_POST['tipo_acesso']);
    $ativo = 'A';

    
   $senha_hash = md5($senha);

    $stmt = mysqli_prepare($connect, "INSERT INTO atendente (login, senha, nome, tipo_acesso, ativo) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssss', $login, $senha_hash, $nome, $tipo_acesso, $ativo);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['mensagem'] = "Erro ao preparar a query!";
    }

    header('Location: ../atendente.php');
    exit;
}
?>
