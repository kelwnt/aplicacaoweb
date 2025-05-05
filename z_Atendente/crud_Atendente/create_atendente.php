<?php
//sessao
session_start();

//conexao
include_once '../../php_action/db_connect.php';

if(isset($_POST['btn-cadastrar'])):


//função para tirar os caracteres especiais do CPF
function limpaCPF_CNPJ($valor){
$valor = preg_replace('/[^0-9]/', '', $valor);
   return $valor;
}
//fecha função para tirar os caracteres do CPF



	//pegamos o que vem do post e preparamos para enviar para o banco
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = md5(mysqli_escape_string($connect, $_POST['senha']));
	$cpf = mysqli_escape_string($connect, $_POST['cpf']);
	$tipo_acesso = mysqli_escape_string($connect, $_POST['tipo_acesso']);
	$ativo = 1;
	
	$cpf = limpaCPF_CNPJ($cpf);

	//Fechamos o pegamos o que vem do post e preparamos para enviar para o banco
	
	//Enviamos apra o banco 
	
$sql = "insert into atendente ( login, senha, nome, cpf, tipo_acesso, ativo) VALUES ('$login', '$senha', '$nome','$cpf', '$tipo_acesso', '$ativo')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('location: ../atendente.php');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";	
		header('location: ../atendente.php');
	endif;
endif;
?>

