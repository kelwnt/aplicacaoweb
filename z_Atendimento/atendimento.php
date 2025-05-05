<?php

// Conexão com o banco de dados
include_once '../php_action/db_connect.php';

// Inclui o cabeçalho
//include_once 'includes/header.php';

// Inclui as mensagens
//include_once 'includes/mensagens.php';

include_once 'select_atendimento/selects_Atendimento.php';

// Inclui a função de formatação do CPF/CPNJ
include_once '../functions.php';

//sessao
session_start();
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

	<!-- Adicione aqui seus outros estilos CSS -->

	<script>
		// Função para armazenar o ID do atendente quando o botão de deletar é clicado
		function setDeleteId(id) {
			document.getElementById('deleteId').value = id;
		}

		function setConcluirId(id) {
			document.getElementById('concluirId').value = id;
		}
	</script>

</head>

<body>
	<div class="row mt-4">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="p-1 mb-3 bg-dark text-white rounded border border-light">
				<h3 class="text-center">Atendimentos</h3>
			</div>
			<div class="rounded border border-secondary p-3">
				<table class="table table-striped text-center">
					<thead>
						<tr class="table-header">
							<th class="align-middle">Código: </th>
							<th class="align-middle">Data Inicio: </th>
							<th class="align-middle">Data Fim: </th>
							<!--<th class="align-middle">Tipo Atendimento: </th>-->
							<!--<th class="align-middle">ID Atendente: </th>-->
							<!--<th class="align-middle">ID Cliente: </th>-->
							<th class="align-middle">Nome Cliente: </th>
							<th class="align-middle">Alterar: </th>
							<th class="align-middle">Concluir: </th>
							<th class="align-middle">Excluir: </th>
							<th class="align-middle">Detalhes: </th>
						</tr>
					</thead>

					<tbody>
						<?php
						//$sql = "select * from atendimento where ativo = 'A'";
						//$resultado = mysqli_query($connect, $sql);			
						if (mysqli_num_rows($resultado) > 0):
							while ($dados = mysqli_fetch_array($resultado)):
								include_once 'select_atendimento/selects_Atendimento_Gerais.php';
								?>

								<tr>
									<td class="table-cell align-middle">
										<?php echo $dados['id_atendimento']; ?>
									</td>
									<td class="table-cell align-middle">
										<?php echo date('d/m/Y', strtotime($dados['dt_inicio'])); ?>
									</td>
									<td class="table-cell align-middle">
										<?php echo date('d/m/Y', strtotime($dados['dt_fim'])); ?>
									</td>
									<!--<td class="table-cell align-middle">
										<?php echo $dados['id_atendente']; ?>
									</td>-->
									<!--<td class="table-cell align-middle">
										<?php echo $dados['id_cliente']; ?>
									</td>-->
									<td class="table-cell align-middle">
										<?php echo $dados['id_cliente']; ?>
									</td>

									<td class="table-cell align-middle">
										<a href="editar_atendimento.php?id_atendimento=<?php echo $dados['id_atendimento']; ?>"
											class="btn btn-warning" role="button">
											<i class="bi bi-pencil"></i></a>
									</td>

									<td class="table-cell align-middle">
										<button onclick="setConcluirId(<?php echo $dados['id_atendimento']; ?>)"
											class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_concluir">
											<i class="bi bi-check"></i></button>
									</td>

									<td class="table-cell align-middle">
										<button onclick="setDeleteId(<?php echo $dados['id_atendimento']; ?>)"
											class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete">
											<i class="bi bi-trash"></i></button>
									</td>

									<td class="table-cell align-middle">
										<button class="btn btn-success" data-bs-toggle="collapse"
											data-bs-target="#details-<?php echo $dados['id_atendimento']; ?>">
											<i class="bi bi-chevron-down"></i>
										</button>
									</td>

								<tr id="details-<?php echo $dados['id_atendimento']; ?>" class="collapse">
									<td colspan="11">
										<div class="table-responsive">
											<table class="table text-center">
												<thead>
													<tr class="table-header">
														<th class="align-middle">Tipo Atendimento</th>
														<th class="align-middle">Nome Atendente</th>
														<th class="align-middle">Descrição</th>
														<th class="align-middle">Ativo</th>
													</tr>
												</thead>
												<tbody>
												<?php
			
            $id_tipo_atendimento = $dados['id_tipo_atendimento'];
			//log($id_tipo_atendimento);
			$sql_tipo_atendimento = "select * from tipo_atendimento where id_tipo_atendimento = '$id_tipo_atendimento'" ;
			$resultado_tipo_atendimento = mysqli_query($connect, $sql_tipo_atendimento);
			$dados_tipo_atendimento = mysqli_fetch_array($resultado_tipo_atendimento);
			
			$id_atendente = $_SESSION['id_atendente'];
			
			$sql_atendente = "select * from atendente where id_atendente = '$id_atendente'" ;
			$resultado_atendente = mysqli_query($connect, $sql_atendente);
			$dados_atendente = mysqli_fetch_array($resultado_atendente);
			
			$id_cliente = $dados['id_cliente'];
			
			$sql_cliente = "select * from cliente where id_cliente = '$id_cliente'" ;
			$resultado_cliente = mysqli_query($connect, $sql_cliente);
			$dados_cliente = mysqli_fetch_array($resultado_cliente);

			?>
													<tr>
														<td class="table-cell align-middle">
															<?php echo $dados_tipo_atendimento['tipo_atendimento']; ?>
														</td>
														<td class="table-cell align-middle">
															<?php echo $dados_atendente['nome']; ?>
														</td>
														<td class="table-cell align-middle">
															<?php echo $dados['descricao']; ?>
														</td>
														<td class="table-cell align-middle">
															<?php
															$status = $dados['ativo'];
															if ($status == 'A') {
																echo '<i class="bi bi-check-circle-fill text-success"></i>'; // Ícone de ativo
															} elseif ($status == 'D') {
																echo '<i class="bi bi-x-circle-fill text-danger"></i>'; // Ícone de deletado
															} elseif ($status == 'C') {
																echo '<i class="bi bi-check-circle-fill text-info"></i>'; // Ícone de concluído
															} else {
																// Se o status não corresponder a nenhum dos valores esperados, exiba apenas o valor do status
																echo $status;
															}
															?>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</td>
								</tr>



								</tr>

							<?php endwhile;
						else:
							?>
							<tr>
								<td colspan="8" class="text-center">Nenhum Atendimento encontrado.</td>
							</tr>
							<?php
						endif;
						?>
					</tbody>
				</table>
			</div>
			<a href="adicionar_Atendimento.php" class="btn btn-secondary mt-3 float-end"> <i class="bi bi-plus"></i>
				Adicionar Atendimento</a>
		</div>
	</div>


	<?php
	// carregamos alguma mensagem em tela.
	include_once 'modal_atendimento/modal_Atendimento.php';
	include_once 'modal_atendimento/modal_Atendimento_concluir.php';
	include_once '../mensagem.php';
	?>

	<!-- JavaScript do Bootstrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-..." crossorigin="anonymous"></script>

</body>

</html>