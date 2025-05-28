<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-deletar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
		
	//$sql = "delete from atendimento where id_atendimento = '$id'";
	$sql = "update atendimento set ativo = 'D' where id_atendimento = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atendimento " .$id. " finalizado com sucesso!";
		header('location: ../atendimento.php');
	else:
		$_SESSION['mensagem'] = "Erro ao fechar o atendimento";	
		header('location: ../atendimento.php');
	endif;
endif;
?>

