<?php
// login_validation.php

// Incluindo o arquivo de conexão com o banco de dados
require_once 'php_action/db_connect.php';

// Iniciando sessão
session_start();

// Verificando se o botão de login foi pressionado
if(isset($_POST['btn-entrar'])):
	$erros = array();
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);

	// Verificando se os campos de login e senha foram preenchidos
	if (empty($login) or empty($senha)):
		$erros[] = "Os campo Login/Senha precisam ser preenchidos";
	else:
		$sql = "select login from atendente where login = '" .$login. "'";
		$resultado = mysqli_query($connect, $sql);

		// Verificando se o usuário existe no banco de dados
		if(mysqli_num_rows($resultado) > 0):
			//cripografa a senha
			$senha = md5($senha);
			//faz uma validação no banco através de select
			$sql = "select * from atendente where login = '$login' and senha = '$senha'";
			$resultado = mysqli_query($connect, $sql);

			// Verificando se a senha está correta
			if(mysqli_num_rows($resultado) == 1):
				//cria variaveis de sessao, pq o login deu certo e direciona para a página tamplate.php
				$dados = mysqli_fetch_array($resultado);
				$_SESSION['LOGADO'] = true;
				//$_SESSION['MENSAGEM'] = 'teste';				
				$_SESSION['id_atendente'] = $dados['id_atendente'];
				$_SESSION['nome'] = $dados['nome'];
				$_SESSION['login'] = $dados['login'];
				$_SESSION['tipo_acesso'] = $dados['tipo_acesso'];
				header('Location: tamplate.php');
			else:
				$erros[] = "Usuário e senha não conferem";
			endif;
		else:
			$erros[] = "Usuário inexistente";
		endif;
	endif;	
endif;
?>
