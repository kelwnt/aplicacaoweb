<?php

include_once '../php_action/db_connect.php';


include_once '../functions.php';

// sessão
session_start();

if (!isset ($_SESSION['LOGADO'])):
	header('location: logout.php');
endif;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Atendimentos</title>

	<!-- CSS do Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
	<div class="container mt-4">
		<div class="row">
			<div class="col-12 col-md-8 offset-md-2">
				<div class="p-3 mb-3 bg-dark text-white rounded">
					<h3 class="text-center">Novo Atendente</h3>
				</div>

				<?php if (isset($_SESSION['mensagem'])): ?>
					<div class="alert alert-info text-center">
						<?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
					</div>
				<?php endif; ?>

				<form action="crud_Atendente/create_atendente.php" method="POST">
					<div class="border border-secondary rounded p-3">

						<div class="mb-3">
							<label for="nome" class="form-label">Nome</label>
							<input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome" minlength="3" required>
						</div>

						<div class="mb-3">
							<label for="login" class="form-label">Login</label>
							<input type="text" name="login" id="login" class="form-control" placeholder="Digite o login" required>
						</div>

						<div class="mb-3">
							<label for="senha" class="form-label">Senha</label>
							<input type="password" name="senha" id="senha" class="form-control" placeholder="********" required>
						</div>

						<div class="mb-3">
							<label for="tipo_acesso" class="form-label">Tipo de Acesso</label>
							<select class="form-select" id="tipo_acesso" name="tipo_acesso" required>
								<option value="" selected disabled>Selecione</option>
								<option value="A">Administrador</option>
								<option value="C">Atendente</option>
							</select>
						</div>

						<input type="hidden" name="ativo" value="A">

						<div class="d-flex justify-content-end mt-4">
							<a href="atendente.php" class="btn btn-success me-2"></i> Voltar</a>
							<button type="submit" name="btn-cadastrar" class="btn btn-info"><i class="bi bi-plus"></i> Cadastrar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
