<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-reativar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	
	
	//echo "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
	
	//$sql = "delete from atendimento where id_atendimento = '$id'";
	$sql = "update atendimento set ativo = 'A' where id_atendimento = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atendimento " .$id. " reaberto com sucesso!";
		//$_SESSION['mensagem'] = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
		header('location: ../atendimento_encerrado.php');
	else:
		$_SESSION['mensagem'] = "Erro ao reabrir o atendimento";	
		header('location: ../atendimento_encerrado.php');
	endif;
endif;
?>

