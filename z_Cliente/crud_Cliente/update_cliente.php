<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if (isset ($_POST['btn-editar'])):


	$id = mysqli_escape_string($connect, $_POST['id']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);

	$telefone = mysqli_escape_string($connect, $_POST['telefone']);
	$ativo = 1;

	
	$telefone = limpa_CNPJ_telefone($telefone);


	$sql = "update cliente set nome = '$nome', telefone = '$telefone' where id_cliente = '$id'";

	if (mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Cliente " .$nome. " alterado com sucesso!";
		//$_SESSION['mensagem'] = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
		header('location: ../cliente.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao alterar o cliente: " .$nome;
		header('location: ../cliente.php');
	endif;
endif;
?>