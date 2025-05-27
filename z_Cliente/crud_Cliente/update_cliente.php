<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if (isset($_POST['btn-editar'])):

    $id = mysqli_escape_string($connect, $_POST['id_cliente']);
    $nome = mysqli_escape_string($connect, $_POST['cliente']);
    $telefone = mysqli_escape_string($connect, $_POST['telefone']);
    $telefone = limpa_CNPJ_telefone($telefone);
	$ativo = 'A';

	$sql = "UPDATE cliente SET nome = '$nome', telefone = '$telefone', ativo = '$ativo' WHERE id_cliente = '$id'";

	if (mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Cliente " .$nome. " alterado com sucesso!";
		header('location: ../cliente.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao alterar o cliente: " .$nome;
		header('location: ../cliente.php');
	endif;
endif;
?>