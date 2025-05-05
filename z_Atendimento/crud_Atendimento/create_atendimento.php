<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-cadastrar'])):

	$dt_inicio = mysqli_escape_string($connect, $_POST['dt_inicio']);
	$dt_fim = mysqli_escape_string($connect, $_POST['dt_fim']);
	$id_tipo_atendimento = mysqli_escape_string($connect, $_POST['id_tipo_atendimento']);
	$id_atendente = mysqli_escape_string($connect, $_POST['id_atendente']);
	$id_cliente = mysqli_escape_string($connect, $_POST['id_cliente']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$ativo = "A";
	
	
	echo $dt_inicio;
	echo $dt_fim;
	echo $id_tipo_atendimento; 
	echo $id_atendente;
	echo $id_cliente; 
	echo $descricao; 
	echo $ativo; 
	
$sql = "insert into atendimento ( dt_fim, dt_inicio, id_tipo_atendimento, id_atendente, id_cliente, descricao, ativo) 
							VALUES ( '$dt_fim','$dt_inicio', '$id_tipo_atendimento', '$id_atendente', '$id_cliente', '$descricao', '$ativo')";
	
	

//$sql = "insert into atendimento ( dt_fim, dt_inicio, id_tipo_atendimento, id_atendente, id_cliente, descricao, ativo) 
//							VALUES ( '$dt_fim','$dt_inicio', '$id_tipo_atendimento', '$id_atendente', '$id_cliente', '$$descricao', '$ativo')";
							
//$sql = "insert into atendente ( login, senha, nome, cpf, tipo_acesso, ativo) VALUES ('$login', '$senha', '$nome','$cpf', '$tipo_acesso', '$ativo')";


	if(mysqli_query($connect, $sql)):
		$_SESSION['MENSAGEM'] = "Atendimento Cadastrado com sucesso!";
		header('location: ../atendimento.php');
	else:
		/*$_SESSION['mensagem'] = "$dt_inicio, $dt_fim, $id_tipo_atendimento, $id_tipo_atendimento, $id_atendente, $id_cliente, $descricao, $ativo";*/
		$_SESSION['mensagem'] = "Falha ao adicionar Atendimento";
		echo $_SESSION['MENSAGEM'];
		header('location: ../atendimento.php');
	endif;
endif;
?>

