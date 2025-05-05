<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-cadastrar'])):


	$tipo_atendimento = mysqli_escape_string($connect, $_POST['tipo_atendimento']);
	$ativo = mysqli_escape_string($connect, $_POST['ativo']);
	
	
	
$sql = "insert into tipo_atendimento ( tipo_atendimento, ativo) VALUES ( '$tipo_atendimento', '$ativo')";

echo $sql;

	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Cadastrado com sucesso!";
		header('location: ../tipo_atendimento.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao cadastrar!";	
		header('location: ../tipo_atendimento.php');
	endif;
endif;
?>

