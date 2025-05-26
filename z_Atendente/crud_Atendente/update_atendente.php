<?php
session_start();
require_once '../../php_action/db_connect.php';

if (isset($_POST['btn-editar'])) {
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $nome = mysqli_real_escape_string($connect, $_POST['nome']);
    $login = mysqli_real_escape_string($connect, $_POST['login']);
    $senha = trim(mysqli_real_escape_string($connect, $_POST['senha']));
    $tipo_acesso = mysqli_real_escape_string($connect, $_POST['tipo_acesso']);

    if (!empty($senha)) {
        $senha_hash = md5($senha);
        $sql = "UPDATE atendente SET nome = ?, login = ?, senha = ?, tipo_acesso = ? WHERE id_atendente = ?";
        $stmt = mysqli_prepare($connect, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssi", $nome, $login, $senha_hash, $tipo_acesso, $id);
        }
    } else {
        $sql = "UPDATE atendente SET nome = ?, login = ?, tipo_acesso = ? WHERE id_atendente = ?";
        $stmt = mysqli_prepare($connect, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $nome, $login, $tipo_acesso, $id);
        }
    }

    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['mensagem'] = "Atendente '$login' atualizado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar o atendente '$login'.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['mensagem'] = "Erro ao preparar a atualização.";
    }

    header('Location: ../atendente.php');
    exit;
}
?>
