<?php
//conexao
require_once 'db_connect.php';

// sessão
session_start();

//botao enviar
if(isset($_POST['btn-entrar'])):
	$erros = array();
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	echo $login;
	echo $senha;
	
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
			
				if(mysqli_num_rows($resultado) == 1):
					$dados = mysqli_fetch_array($resultado);
					$_SESSION['LOGADO'] = true;
					$_SESSION['id_atendente'] = $dados['id_atendente'];
					header('Location: home.php');
				else:
					$erros[] = "<li> Usuaário  e senha nao conferem</li>";
				endif;
			
		else:
			$erros[] = "<li> Usuaário inexistente </li>";
		endif;
	endif;	
	
endif;
?>

<html>
	<head>
	<title>Login</title>
	<meta charset="utf-8">
	</head>
	
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

<h1> Login </h1>
<?php
if (!empty($erros)):
	foreach($erros as $erro):
		echo $erro;
	endforeach;
endif;
?>
<hr>





<div class="login-form">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
<h2 class="text-center">Sistema Cadastro Registro</h2>    

<div class="form-group">
<input type="text" class="form-control" name="login" placeholder="Login" required="required">
</div>

<div class="form-group">
 <input type="password" name="login" class="form-control" placeholder="Senha" required="required">
</div>

<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="btn-entrar">Log in</button>
        </div>

</form>

</body>
</html>