<?php
// login_interface.php
// Incluindo o arquivo de validação de login
require_once 'login_validation.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<!-- Bootstrap 5 CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Chama um icone de uma biblioteca especifica.-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!-- Bootstrap Icons -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
	<div class="container mb-5">
		<div class="row justify-content-center" style="margin-top: 12vh;">
			<div class="col-md-4">				
				<div class="card mt-5 shadow rounded bg-dark text-white"
					style="box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.9);">					
					<div class="card-body" style="box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.9); shadow">
						<h2 class="text-center mb-4"><i class="fas fa-headset"></i> RA - Registros de Atendimento</h2>
						<!--Chama uma função PHP para validar no banco o determinado login-->
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="form-group mb-3">
								<div class="input-group">								
									<span class="input-group-text"><i class="bi bi-person-fill"></i></span>									
									<!-- O campo de login é necessário para identificar o usuário -->
									<input type="text" class="form-control" name="login" id="login" placeholder="Login">
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
									<!-- O campo de senha é necessário para autenticar o usuário -->
									<input type="password" name="senha" id="senha" class="form-control"
										placeholder="Senha">
								</div>
							</div>

							<?php
							// Incluindo o arquivo de alerta
							require_once 'alert.php';
							?>

							<div class="form-group mt-4 d-flex align-items-center">
								<!-- Checkbox para lembrar -->
								<div class="mr-3">
									<label for="lembrar" class="ml-2">Lembrar-me</label>
									<input type="checkbox" id="lembrar-me">
								</div>
								<!-- O botão de login inicia o processo de autenticação, vai para o arquivo login_validation-->
								<button type="submit" class="btn btn-secondary" style="flex-grow: 1;"
									name="btn-entrar">Login</button>
								<!-- Cor de fundo ajustada para um cinza escuro -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap 5 JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
</body>

</html>