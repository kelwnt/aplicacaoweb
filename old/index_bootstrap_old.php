<?php
//botao enviar
if(isset($_POST['btn-entrar'])):
	echo "clicou";
	endif;
?>

<html>
	<head>
	<title>Login</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
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
	
	</head>
<body>

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
</div>
</body>
</html>