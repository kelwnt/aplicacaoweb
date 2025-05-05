<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-reativar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	
	
	//echo "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
	
	//$sql = "delete from atendente where id_atendente = '$id'";

	//$ativo = 1;
	//$sql = "update cliente set ativo = '$ativo' where id_cliente = '$id'";

	$sql = "update tipo_atendimento set ativo = 'A' where id_tipo_atendimento = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Tipo de Atendimento " .$id. " reativado com sucesso!";
		//$_SESSION['mensagem'] = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
		header('location: ../tipo_atendimento.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao reativar Tipo de Atendimento!";	
		header('location: ../tipo_atendimento.php');
	endif;
endif;
?>

