<?php
// login_validation.php

require_once 'php_action/db_connect.php';
session_start();

if (isset($_POST['btn-entrar'])):
    $erros = array();
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if (empty($login) || empty($senha)):
        $erros[] = "Os campos Login e Senha devem ser preenchidos.";
    else:
        $senhaCriptografada = md5($senha);

        // Verifica login, senha e se o atendente está ATIVO
        $sql = "SELECT * FROM atendente 
                WHERE login = '$login' 
                  AND senha = '$senhaCriptografada' 
                  AND ativo = 'A'";

        $resultado = mysqli_query($connect, $sql);

        if (mysqli_num_rows($resultado) === 1):
            $dados = mysqli_fetch_array($resultado);
            $_SESSION['LOGADO'] = true;
            $_SESSION['id_atendente'] = $dados['id_atendente'];
            $_SESSION['nome'] = $dados['nome'];
            $_SESSION['login'] = $dados['login'];
            $_SESSION['tipo_acesso'] = $dados['tipo_acesso'];

            header('Location: tamplate.php');
            exit();
        else:
            $erros[] = "Usuário, senha incorretos.";
        endif;
    endif;

    // Armazena erros na sessão para exibir no alert.php, se houver
    $_SESSION['erros_login'] = $erros;
endif;
?>
