<?php
//conexao
include_once '../php_action/db_connect.php';
//header

//select

if (isset ($_GET['id_tipo_atendimento'])):
	$id = mysqli_escape_string($connect, $_GET['id_tipo_atendimento']);

	$sql = "select * from tipo_atendimento where id_tipo_atendimento = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);
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
				<h3 class="text-center">Editar Tipo de Atendimento</h3>
			</div>

			<form action="crud_Tipo_Atendimento/update_tipo_atendimento.php" method="POST">
				<div class="rounded border border-secondary p-3">
					<input type="hidden" name="id_tipo_atendimento" id="id_tipo_atendimento"
						value="<?php echo $dados['id_tipo_atendimento']; ?>">

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Nome</span>
						<input type="text" name="tipo_atendimento" id="tipo_atendimento" class="form-control"
							value="<?php echo $dados['tipo_atendimento']; ?>" minlength="8" required>
					</div>

					<!--<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Ativo</span>
						<input type="text" name="ativo" id="ativo" class="form-control"
							value="<?php echo $dados['ativo']; ?>" maxlength="1" required>
					</div>-->
					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Acesso</span>
						<select class="form-select" id="ativo" name="ativo" required>
							<option value="" disabled>Selecione o tipo de acesso</option>
							<option value="A" <?php echo ($dados['ativo'] == 'A') ? 'selected' : ''; ?>>
								Ativo</option>
							<option value="D" <?php echo ($dados['ativo'] == 'D') ? 'selected' : ''; ?>>Inativo
							</option>
						</select>
					</div>
					
				</div>



				<button type="submit" name="btn-editar" class="btn btn-secondary mt-3 float-end"><i
						class="fas fa-sync-alt"></i> Atualizar</button>
				<!--<button type="submit" name="btn-editar" class="btn"> Atualizar </button>-->
				<a href="tipo_atendimento.php" class="btn btn-success mt-3 float-end me-2"><i class="fas fa-list"></i>
					Lista de
					atendentes</a>
			</form>
		</div>
	</div>


	<!-- JavaScript do Bootstrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-..." crossorigin="anonymous"></script>

</body>

</html>