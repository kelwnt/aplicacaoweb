<?php
session_start();
require_once '../../php_action/db_connect.php';

if (isset($_POST['btn-reativar'])) {
    $id = mysqli_real_escape_string($connect, $_POST['id']);

    // Atualiza o campo ativo para 'A'
    $sql = "UPDATE atendente SET ativo = 'A' WHERE id_atendente = ?";
    $stmt = mysqli_prepare($connect, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['mensagem'] = "Atendente ID $id reativado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao reativar atendente!";
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['mensagem'] = "Erro!";
    }

    header('Location: ../atendente.php');
    exit;
}
?>
