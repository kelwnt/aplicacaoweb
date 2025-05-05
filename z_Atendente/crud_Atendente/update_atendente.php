<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-editar'])):


function limpaCPF_CNPJ($valor){
$valor = preg_replace('/[^0-9]/', '', $valor);
   return $valor;
}

	$id = mysqli_escape_string($connect, $_POST['id']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = md5(mysqli_escape_string($connect, $_POST['senha']));
	$cpf = mysqli_escape_string($connect, $_POST['cpf']);
	$tipo_acesso = mysqli_escape_string($connect, $_POST['tipo_acesso']);
	$ativo = 1;
	
	
	$cpf = limpaCPF_CNPJ($cpf);
	
	//echo "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
	
	
	
	$sql = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Atendente " . $login . " alterado com sucesso!";
		//$_SESSION['mensagem'] = "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";
		header('location: ../atendente.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao alterar o Atendente: " .$login;	
		header('location: ../atendente.php');
	endif;
endif;
?>

