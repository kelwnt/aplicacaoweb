<?php
session_start();
//conexao
include_once '../php_action/db_connect.php';
//header

include_once '../functions.php';

if (isset ($_GET['id_atendente'])):
	$id = mysqli_escape_string($connect, $_GET['id_atendente']);

	$sql = "select * from atendente where id_atendente = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);
endif;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Atendimentos</title>
	<!-- CSS do Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-..." crossorigin="anonymous">
	<!-- Ícones do Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	<!-- Bootstrap Icons -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<!-- Adicione aqui seus outros estilos CSS -->

	<!-- JavaScript do Bootstrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-..." crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Inputmask.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>



<body>

<script type="text/javascript">
	$(document).ready(function () {
		$("#telefone").inputmask("(99) 9999-9999");
	});
</script>

	<div class="row mt-4">
		<div class="col-12 col-md-8 offset-md-2">

			<div class="p-1 mb-3 bg-dark text-white rounded border border-light">
				<h3 class="text-center">Editar Atendente</h3>
			</div>

			<form action="crud_Atendente/update_atendente.php" method="POST">
				<div class="rounded border border-secondary p-3">
					<input type="hidden" name="id" id="id" value="<?php echo $dados['id_atendente']; ?>">

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Nome</span>
						<input type="text" name="nome" id="nome" class="form-control"
							value="<?php echo $dados['nome']; ?>" minlength="8" required>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Login</span>
						<input type="text" name="login" id="login" class="form-control"
							value="<?php echo $dados['login']; ?>" required>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Senha</span>
						<input type="password" name="senha" id="senha" class="form-control" value="" required>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Acesso</span>
						<select class="form-select" id="tipo_acesso" name="tipo_acesso" required>
							<option value="" disabled>Selecione o tipo de acesso</option>
							<option value="a" <?php echo ($dados['tipo_acesso'] == 'a') ? 'selected' : ''; ?>>
								Administrador</option>
							<option value="c" <?php echo ($dados['tipo_acesso'] == 'c') ? 'selected' : ''; ?>>Atendente
							</option>
						</select>
					</div>
				</div>

				<button type="submit" name="btn-editar" class="btn btn-info mt-3 float-end"><i
						class="fas fa-sync-alt"></i> Atualizar</button>
				<!--<button type="submit" name="btn-editar" class="btn"> Atualizar </button>-->
				<a href="atendente.php" class="btn btn-success mt-3 float-end me-2"></i>Voltar</a>

			</form>

		</div>
	</div>
	</div>

	<!-- JavaScript do Bootstrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-..." crossorigin="anonymous"></script>

</body>

</html>