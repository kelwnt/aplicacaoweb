<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if (isset ($_POST['btn-editar'])):

	function limpaCPF_CNPJ_telefone($valor)
	{
		$valor = preg_replace('/[^0-9]/', '', $valor);
		return $valor;
	}

	$id = mysqli_escape_string($connect, $_POST['id']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$cpf = mysqli_escape_string($connect, $_POST['cpf']);
	$telefone = mysqli_escape_string($connect, $_POST['telefone']);
	$ativo = 1;

	//echo "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
	$cpf = limpaCPF_CNPJ_telefone($cpf);
	$telefone = limpaCPF_CNPJ_telefone($telefone);


	$sql = "update cliente set nome = '$nome', cpf = '$cpf', telefone = '$telefone' where id_cliente = '$id'";

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