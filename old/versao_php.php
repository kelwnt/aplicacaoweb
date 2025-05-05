<?php

//Abrinco conexao com o banco de dados, dentro do arquivo db_connect tem mais explicações do seu funciomanebnto
require_once 'php_action/db_connect.php';

// Iniciando sessão - funcao do PHP para controle de sessão.
session_start();

//botao enviar - Regra de validação do banco de dados, se o usuário existe e se a senha está correta, enviado em MD5. Usuario de teste, senha teste
if(isset($_POST['btn-entrar'])):
	$erros = array();
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	//echo $login;
	//echo $senha;
	
	if (empty($login) or empty($senha)):
		$erros[] = "<li> O campo Login/Senha precisa ser preenchido </li>";
	else:
		$sql = "select login from atendente where login = '" .$login. "'";
		$resultado = mysqli_query($connect, $sql);
		//echo $sql;
		//echo $resultado;
		if(mysqli_num_rows($resultado) > 0):
			$senha = md5($senha);
			$sql = "select * from atendente where login = '$login' and senha = '$senha'";
			$resultado = mysqli_query($connect, $sql);
			
			//Abaixo se caso tudo der certo vamos para a pagina tamplate.php, que é onde esta localizado todo o funcionamento da nossa aplicaçaõ. 
			
				if(mysqli_num_rows($resultado) == 1):
					$dados = mysqli_fetch_array($resultado);
					$_SESSION['LOGADO'] = true;
					$_SESSION['id_atendente'] = $dados['id_atendente'];
					$_SESSION['nome'] = $dados['nome'];
					$_SESSION['login'] = $dados['login'];
					header('Location: tamplate.php');
					
					
				else:
					$erros[] = "<li> Usuaário  e senha nao conferem</li>";
				endif;
			
		else:
			$erros[] = "<li> Usuário inexistente </li>";
		endif;
	endif;	
	
endif;
?>

<html>


	<head>
	<title>Login</title>
	<meta charset="utf-8">
	
	<!-- Abaixo carregamos o framowrk boostrap, e algumas funções especificas de javascript --> 
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
	
	</head>
	<!-- Estilo CSS so para configuração e parametrização da tela de LOGIN --> 
	
	<style>
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
	
	
<body>



<! -- HTMl com os campos de login e senha --> 
<div class="login-form">
	
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
			<h2 class="text-center">Sistema Cadastro Registro</h2>
			<div class="form-group">
				 <input type="text" class="form-control" name="login" placeholder="Login" required="required">
			</div>
			
			<div class="form-group">
			 <input type="password" name="senha" class="form-control" placeholder="Senha" required="required">
			 
			</div>
			
			
			
				<?php
				//php que pega o vetor de erros e mostra em tela com estilização do CSS
					
			if (!empty($erros)):
				foreach($erros as $erro):
				?>
				<div class="alert alert-danger" role="alert">
				<?php
					echo 'Current PHP version: ' . phpversion();
					//echo $erro;
				?>
				
				</div>
				<?php
				endforeach;
			endif;
			
				//php que pega o vetor de erros e mostra em tela com estilização do CSS
			?>
			
						
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" name="btn-entrar">Log in</button> 
			</div>
		
			

			
		</form>

</div>



</body>
</html>