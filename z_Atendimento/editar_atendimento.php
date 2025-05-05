<?php
session_start();
//conexao
include_once '../php_action/db_connect.php';
//header




//echo $_SESSION['id_atendente'];
//echo $_SESSION['LOGADO'];
//echo $_SESSION['id_atendente'];
//echo $_SESSION['nome'];
//echo $_SESSION['login'];

if (!isset ($_SESSION['LOGADO'])):
	header('location: logout.php');
endif;


if (isset ($_GET['id_atendimento'])):
	$id = mysqli_escape_string($connect, $_GET['id_atendimento']);

	$sql = "select * from atendimento where id_atendimento = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);

	$id_tipo_atendimento = $dados['id_tipo_atendimento'];

	$sql_tipo_atendimento = "select * from tipo_atendimento where id_tipo_atendimento = '$id_tipo_atendimento'";
	$resultado_tipo_atendimento = mysqli_query($connect, $sql_tipo_atendimento);
	$dados_tipo_atendimento = mysqli_fetch_array($resultado_tipo_atendimento);

	$id_atendente = $_SESSION['id_atendente'];

	$sql_atendente = "select * from atendente where id_atendente = '$id_atendente'";
	$resultado_atendente = mysqli_query($connect, $sql_atendente);
	$dados_atendente = mysqli_fetch_array($resultado_atendente);

	$id_atendente = $dados['id_cliente'];

	$sql_cliente = "select * from cliente where id_cliente = '$id_atendente'";
	$resultado_cliente = mysqli_query($connect, $sql_cliente);
	$dados_cliente = mysqli_fetch_array($resultado_cliente);


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
				<h3 class="text-center">Editar Atendimento</h3>
			</div>
			<form action="crud_Atendimento/update_atendimento.php" method="POST">
				<div class="rounded border border-secondary p-3">

					<input type="hidden" name="id" id="id" value="<?php echo $dados['id_atendimento']; ?>">
					<!--Data final e inicial-->
					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Data
							Inicial</span>
						<?php
						// Convertendo a data para o formato "yyyy-MM-dd"
						$dt_inicio = date('Y-m-d', strtotime($dados['dt_inicio']));
						?>
						<input type="date" name="dt_inicio" id="dt_inicio" class="form-control"
							placeholder="Digite o nome" minlength="8" required value="<?php echo $dt_inicio; ?>">

						<?php
						// Convertendo a data para o formato "yyyy-MM-dd"
						$dt_fim = date('Y-m-d', strtotime($dados['dt_fim']));
						?>
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Data
							Final</span>
						<input type="date" name="dt_fim" id="dt_fim" class="form-control" placeholder="Digite o nome"
							minlength="8" required value="<?php echo $dt_fim; ?>">
					</div>

					<div class="input-group mb-3">
						<span class="input-group-text" style="min-width: 10%;">Tipo de Atendimento</span>
						<select class="form-select" name="id_tipo_atendimento" id="id_tipo_atendimento"
							aria-label="Id Tipo de Atendimento" required>
							<option value="<?php echo $dados_tipo_atendimento['id_tipo_atendimento']; ?>">
								<?php echo $dados_tipo_atendimento['tipo_atendimento']; ?>
							</option>
							<?php include_once 'select_atendimento/select_tipo_atendimento.php' ?>
						</select>
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

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 5%;">Id
							Cliente</span>
						<input type="text" name="id_cliente" id="id_cliente" class="form-control" 
							readonly="true" value="<?php echo $dados_cliente['id_cliente']; ?>">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 10%;">Nome
							Cliente</span>
						<input readonly="true" type="text" name="nome_cliente" id="nome_cliente" class="form-control"
						value=<?php echo $dados_cliente['nome']; ?>>
						<button type="button" class="btn btn-success" data-bs-toggle="modal"
							data-bs-target="#modal_cliente">
							<i class="bi bi-search"></i> Pesquisar Cliente
						</button>
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 5%;">Descrição do Adtendimento
							</span>
						<input type="text" name="descricao" id="descricao" class="form-control" 
							value=<?php echo $dados['descricao']; ?> >
					</div>

					<div class="input-group input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 5%;">Adtendimento Aberto
							</span>
						<input type="text" name="ativo" id="ativo" class="form-control" 
							value=<?php echo $dados['ativo']; ?> >
					</div>

				</div>

				<button type="submit" name="btn-editar" onclick="valida()"
					class="btn btn-secondary mt-3 float-end"><i class="bi bi-plus"></i>Atualizar</button>
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