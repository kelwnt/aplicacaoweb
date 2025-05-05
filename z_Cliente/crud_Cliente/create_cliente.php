<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-cadastrar'])):

function limpaCPF_CNPJ_telefone($valor){
$valor = preg_replace('/[^0-9]/', '', $valor);
   return $valor;
}


	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$cpf = mysqli_escape_string($connect, $_POST['cpf']);
	$telefone = mysqli_escape_string($connect, $_POST['telefone']);
	$ativo = 1;
	
	
	$cpf = limpaCPF_CNPJ_telefone($cpf);
	$telefone = limpaCPF_CNPJ_telefone($telefone);
	
$sql = "insert into cliente ( nome, cpf, telefone, ativo) VALUES ( '$nome','$cpf', '$telefone', '$ativo')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Cliente " .$nome. " incluido com sucesso!";
		header('location: ../cliente.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao alterar o cliente: " .$nome;
		header('location: ../cliente.php');
	endif;
endif;
?>

