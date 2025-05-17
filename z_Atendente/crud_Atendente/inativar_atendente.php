<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-deletar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	
	
	
	//$sql = "delete from atendente where id_atendente = '$id'";

	$ativo = 2;
	$sql = "update atendente set ativo = '$ativo' where id_atendente = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Atendente " .$id. " deletado com sucesso!";
		header('location: ../atendente.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao Deletar!";	
		header('location: ../atendente.php');
	endif;
endif;
?>

