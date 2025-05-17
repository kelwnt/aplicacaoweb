<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-reativar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	
	
	
	//$sql = "delete from atendente where id_atendente = '$id'";

	$ativo = 1;
	$sql = "update cliente set ativo = '$ativo' where id_cliente = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Cliente " .$id. " reativado com sucesso!";
		header('location: ../cliente.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao Reativar Atendente!";	
		header('location: ../cliente.php');
	endif;
endif;
?>

