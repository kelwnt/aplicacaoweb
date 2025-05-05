<?php
//conexao ECHO $_SESSION['mensagem'];
include_once '../php_action/db_connect.php';
//header
//include_once 'includes/header.php';



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

	<!-- JavaScript do Bootstrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-..." crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Inputmask.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>


</head>

<body>
<?php 
	include_once '../functions.php';
	?>

	<div class="row mt-4">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="p-1 mb-3 bg-dark text-white rounded border border-light">
				<h3 class="text-center">Novo Atendimento</h3>
			</div>
			<form action="crud_Atendimento/create_atendimento.php" method="POST">
				<div class="rounded border border-secondary p-3">

					<!--Data final e inicial-->
					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Data
							Inicial</span>
						<input type="date" name="dt_inicio" id="dt_inicio" class="form-control"
							placeholder="Digite o nome" minlength="8" required>

						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Data
							Final</span>
						<input type="date" name="dt_fim" id="dt_fim" class="form-control" placeholder="Digite o nome"
							minlength="8" required>
					</div>

					<!-- dados do atendente que está realizando o atendimento. Nem seria necessario mostrar em tela-->
					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 5%;">Id
							Atendente</span>
						<input readonly="true" type="text" name="id_atendente" id="id_atendente" class="form-control" placeholder="n"
							value="<?php echo $_SESSION['id_atendente']; ?>">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Nome
							Atendente</span>
						<input readonly="true" type="text" name="nome_atendente" id="nome_atendente"
							class="form-control" value="<?php echo $_SESSION['nome']; ?>">
					</div>

					<!-- Traz os tipos de atendimento ativos-->
					<div class="input-group mb-3">
						<span class="input-group-text" style="min-width: 10%;">Tipo de Atendimento</span>
						<select class="form-select" name="id_tipo_atendimento" id="id_tipo_atendimento"
							aria-label="Id Tipo de Atendimento" required>
							<option value=""></option>
							<?php include_once 'select_atendimento/select_tipo_atendimento.php' ?>
							
						</select>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 5%;">Id
							Cliente</span>
						<input type="text" name="id_cliente" id="id_cliente" class="form-control" 
							value="" readonly="true">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Nome
							Cliente</span>
						<input readonly="true" type="text" name="nome_cliente" id="nome_cliente"
							class="form-control" value="" >
						<button type="button" class="btn btn-success"
							data-bs-toggle="modal" data-bs-target="#modal_cliente" >
							<i class="bi bi-search"></i> Pesquisar Cliente
						</button>
					</div>


					
					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 5%;">Descrição do Adtendimento
							</span>
						<input type="text" name="descricao" id="descricao" class="form-control" 
							value="" >
					</div>
				</div>

				<button type="submit" name="btn-cadastrar" onclick="valida()"
					class="btn btn-secondary mt-3 float-end"><i class="bi bi-plus"></i> Cadastrar</button>
				<a href="atendimento.php" class="btn btn-success mt-3 float-end me-2"><i class="fas fa-list"></i>
					Lista de atendentes</a>

			</form>

		</div>

		<?php include_once 'modal_atendimento/modal_Atendimento_cliente.php';
			include_once 'modal_atendimento/modal_falta_dados.php';
			?>

		<!-- JavaScript do Bootstrap 5 -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-..." crossorigin="anonymous"></script>

</body>

</html>