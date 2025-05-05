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





<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
login: <input type="text" name="login"><br>
Senha: <input type="password" name="senha"><br>
<button type="submit" name="btn-entrar">Entrar</button> 
</form>

</body>
</html>