<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-cadastrar'])):






	//pegamos o que vem do post e preparamos para enviar para o banco
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = md5(mysqli_escape_string($connect, $_POST['senha']));
	$tipo_acesso = mysqli_escape_string($connect, $_POST['tipo_acesso']);
	$ativo = 1;
	
	

	//Fechamos o pegamos o que vem do post e preparamos para enviar para o banco
	
	//Enviamos apra o banco 
	
$sql = "insert into atendente ( login, senha, nome, tipo_acesso, ativo) VALUES ('$login', '$senha', '$nome', '$tipo_acesso', '$ativo')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('location: ../atendente.php');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";	
		header('location: ../atendente.php');
	endif;
endif;
?>

