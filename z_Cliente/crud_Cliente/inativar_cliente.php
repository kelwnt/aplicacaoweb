<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-deletar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	
	$ativo = 2;
	$sql = "update cliente set ativo = '$ativo' where id_cliente = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Cliente de ID ".$id. " inativado com sucesso!";
		//$_SESSION['mensagem'] = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
		header('location: ../cliente.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao Deletar o id:" .$id;	
		header('location: ../cliente.php');
	endif;
endif;
?>

