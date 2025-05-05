<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if (isset ($_POST['btn-editar'])):



	$id_tipo_atendimento = mysqli_escape_string($connect, $_POST['id_tipo_atendimento']);
	$tipo_atendimento = mysqli_escape_string($connect, $_POST['tipo_atendimento']);
	$ativo = mysqli_escape_string($connect, $_POST['ativo']);

	echo $id_tipo_atendimento;
	echo $tipo_atendimento;
	echo $ativo;

	//echo "update atendente set nome = '$nome', login = '$login', senha = '$senha', cpf = '$cpf', tipo_acesso = '$tipo_acesso' where id_atendente = '$id'";

	$sql = "update tipo_atendimento set tipo_atendimento = '$tipo_atendimento', ativo = '$ativo' where id_tipo_atendimento = '$id_tipo_atendimento'";



	if (mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Tipo de Atendimento " . $tipo_atendimento . " Alterado com sucesso!";
		//$_SESSION['mensagem'] = "update tipo_atendimento set tipo_atendimento = '$tipo_atendimento', ativo = '$ativo' where id_tipo_atendimento = '$id_tipo_atendimento'";
		header('location: ../tipo_atendimento.php');
	else:
		$_SESSION['MENSAGEM'] = "Erro ao alterar o tipo de atendimento!";
		header('location: ../tipo_atendimento.php');
	endif;
endif;
?>