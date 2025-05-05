<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-deletar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	
	
	//echo "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
	
	//$sql = "delete from tipo_atendimento where id_tipo_atendimento = '$id'";

	$sql = "update tipo_atendimento set ativo = 'D' where id_tipo_atendimento = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Inativado com sucesso!";
		//$_SESSION['mensagem'] = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
		header('location: ../tipo_atendimento.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao Deletar!";	
		header('location: ../tipo_atendimento.php');
	endif;
endif;
?>

