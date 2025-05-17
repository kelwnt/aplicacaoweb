<?php
session_start();
include_once '../../php_action/db_connect.php';

if (isset($_POST['btn-cadastrar'])):

    function formatar_CNPJ($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) !== 14) return false;
        $formatado = substr($cnpj, 0, 2) . '.' .
                     substr($cnpj, 2, 3) . '.' .
                     substr($cnpj, 5, 3) . '/' .
                     substr($cnpj, 8, 4) . '-' .
                     substr($cnpj, 12, 2);
        return strlen($formatado) === 18 ? $formatado : false;
    }

    function limpaTelefone($telefone) {
        return preg_replace('/[^0-9]/', '', $telefone);
    }

    $nome     = mysqli_real_escape_string($connect, $_POST['nome']);
    $cnpj_raw = $_POST['cnpj'];
    $telefone = limpaTelefone($_POST['telefone']);
    $ativo    = 'A';

    $cnpj = formatar_CNPJ($cnpj_raw);

    if (!$cnpj) {
        $_SESSION['MENSAGEM'] = "CNPJ inválido. Deve ter exatamente 18 caracteres com pontuação.";
        header('Location: ../cliente.php');
        exit;
    }

    $sql = "INSERT INTO cliente (nome, cnpj, telefone, ativo) 
            VALUES ('$nome', '$cnpj', '$telefone', '$ativo')";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['MENSAGEM'] = "Cliente \"$nome\" incluído com sucesso!";
    } else {
        $_SESSION['MENSAGEM'] = "Erro ao incluir o cliente \"$nome\": " . mysqli_error($connect);
    }

    header('Location: ../cliente.php');
    exit;

endif;
?>
