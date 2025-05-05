<?php
//conexao ECHO $_SESSION['mensagem'];
include_once '../php_action/db_connect.php';
//header
//include_once 'includes/header.php';

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
	<title>RAtendimento</title>
	<!-- CSS do Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-..." crossorigin="anonymous">
	<!-- Ícones do Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	<!-- Bootstrap Icons -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<!-- Adicione aqui seus outros estilos CSS -->


</head>

<body>
	<div class="row mt-4">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="p-1 mb-3 bg-dark text-white rounded border border-light">
				<h3 class="text-center">Novo Atendente</h3>
			</div>
			<form action="crud_Atendente/create_atendente.php" method="POST">
				<div class="rounded border border-secondary p-3">
					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Nome</span>
						<input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome"
							minlength="8" required>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Login</span>
						<input type="text" name="login" id="login" class="form-control" placeholder="Digite o Login"
							required>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Senha</span>
						<input type="password" name="senha" id="senha" class="form-control" placeholder="***********"
							required>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">CPF</span>
						<input type="text" name="cpf" id="cpf" class="form-control" placeholder="Ex.: 000.000.000-00"
							minlength="8" required>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Acesso</span>

						<select class="form-select" id="tipo_acesso" name="tipo_acesso" required>
							<option value="" selected disabled>Selecione o tipo de acesso</option>
							<option value="a">Administrador</option>
							<option value="c">Atendente</option>
						</select>
					</div>




				</div>

				<button type="submit" name="btn-cadastrar" class="btn btn-secondary mt-3 float-end"><i
						class="bi bi-plus"></i> Cadastrar</button>
				<a href="atendente.php" class="btn btn-success mt-3 float-end me-2"><i class="fas fa-list"></i> Lista de
					atendentes</a>

			</form>

		</div>
	</div>

	<!-- JavaScript do Bootstrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-..." crossorigin="anonymous"></script>

</body>

</html>