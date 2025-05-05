<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-editar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	
	
	
	$dt_fim = mysqli_escape_string($connect, $_POST['dt_fim']);
	$dt_inicio = mysqli_escape_string($connect, $_POST['dt_inicio']);
	$id_tipo_atendimento = mysqli_escape_string($connect, $_POST['id_tipo_atendimento']);
	$id_atendente = mysqli_escape_string($connect, $_POST['id_atendente']);
	$id_cliente = mysqli_escape_string($connect, $_POST['id_cliente']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$ativo = mysqli_escape_string($connect, $_POST['ativo']);

	
	//echo "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
	
	echo $id_tipo_atendimento; 
	
	
	$sql = "update atendimento set dt_inicio = '$dt_inicio', dt_fim = '$dt_fim', id_tipo_atendimento = '$id_tipo_atendimento', 
			id_atendente = '$id_atendente', id_cliente = '$id_cliente', descricao = '$descricao', ativo = '$ativo' where id_atendimento = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atendimento " .$id. " atualizado com sucesso com Sucesso";
		//$_SESSION['mensagem'] = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
		header('location: ../atendimento.php');
	else:
		$_SESSION['mensagem'] = "Erro ao alterar o atendimento " .$id;
		header('location: ../atendimento.php');
	endif;
endif;
?>

