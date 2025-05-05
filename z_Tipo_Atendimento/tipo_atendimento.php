<?php

// Conexão com o banco de dados
include_once '../php_action/db_connect.php';

// Inclui o cabeçalho
//include_once 'includes/header.php';

// Inclui as mensagens
//include_once 'includes/mensagens.php';

include_once 'selects_Tipo_Atendimento.php';

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
		function setReativaId(id) {
			document.getElementById('reativaId').value = id;
		}
	</script>

</head>

<body>
	<div class="row mt-4">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="p-1 mb-3 bg-dark text-white rounded border border-light">
				<h3 class="text-center">Tipo de Atendimento</h3>
			</div>
			<div class="rounded border border-secondary p-3">
				<table class="table table-striped text-center">
					<thead>
						<tr class="table-header">
							<th class="align-middle">Código: </th>
							<th class="align-middle">Nome do tipo: </th>
							<th class="align-middle">Ativo: </th>
							<th class="align-middle">Editar: </th>
							<th class="align-middle">Excluir: </th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						<?php
						//$sql = "select * from tipo_atendimento";
						//$resultado = mysqli_query($connect, $sql);
						if (mysqli_num_rows($resultado) > 0):
							while ($dados = mysqli_fetch_array($resultado)):
								?>
								<tr>
									<td class="table-cell align-middle">
										<?php echo $dados['id_tipo_atendimento']; ?>
									</td>
									<td class="table-cell align-middle">
										<?php echo $dados['tipo_atendimento']; ?>
									</td>
									<td class="table-cell align-middle">
															<?php
															$status = $dados['ativo'];
															if ($status == 'A') {
																echo '<i class="bi bi-check-circle-fill text-success"></i>'; // Ícone de ativo
															} elseif ($status == 'D') {
																echo '<i class="bi bi-x-circle-fill text-danger"></i>'; // Ícone de deletado
															} else {
																// Se o status não corresponder a nenhum dos valores esperados, exiba apenas o valor do status
																echo $status;
															}
															?>
														</td>
									<td class="table-cell align-middle">
										<a href="editar_Tipo_Atendimento.php?id_tipo_atendimento=<?php echo $dados['id_tipo_atendimento']; ?>"
											class="btn btn-warning" role="button">
											<i class="bi bi-pencil"></i> Editar
										</a>
									</td>

									<td class="table-cell align-middle">
										<?php if ($dados['ativo'] == 'A'): ?>
											<button onclick="setDeleteId(<?php echo $dados['id_tipo_atendimento']; ?>)"
												class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete">
												<i class="bi bi-trash"></i> Deletar
											</button>
										<?php elseif ($dados['ativo'] == 'D'): ?>
											<button onclick="setReativaId(<?php echo $dados['id_tipo_atendimento']; ?>)"
												class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_reativar">
												<i class="bi bi-check"></i> Reativar
											</button>
										<?php endif; ?>
										</td>

								</tr>

							<?php endwhile;
						else: ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
								<?php
						endif;
						?>

						</tbody>
					</table>
					</div>				
				<a href="adicionar_tipo_atendimento.php" class="btn btn-secondary mt-3 float-end"> <i class="bi bi-plus"></i>
				Adicionar Tipo Atendimento</a>
			</div>				
		</div>

		<?php
		// carregamos alguma mensagem em tela.
		include_once 'modal_Tipo_Atendimento.php';		
		include_once 'modal_Tipo_Atendimento_Reativar.php';
		include_once '../mensagem.php';
		?>

		<!-- JavaScript do Bootstrap 5 -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-..." crossorigin="anonymous"></script>
</body>

</html>