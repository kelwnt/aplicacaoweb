<?php

//Abrinco conexao com o banco de dados, dentro do arquivo db_connect tem mais explicações do seu funciomanebnto
include_once '../php_action/db_connect.php';

	
// Inclui a função de formatação do CPF/CPNJ
include_once '../functions.php';


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

    <script>
		// Função para armazenar o ID do atendente quando o botão de deletar é clicado
		function setReativaId(id) {
			document.getElementById('reativarId').value = id;
		}
	</script>

</head>

<body>
    <div class="row mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="p-1 mb-3 bg-dark text-white rounded border border-light">
                <h3 class="text-center">Atendimentos Encerrados</h3>
            </div>
            <div class="rounded border border-secondary p-3">
                <table class="table table-striped text-center">
                    <thead>
					<tr class="table-header">
						<th class="align-middle">id_cliente</th>							
						<th class="align-middle">Nome</th>
						<th class="align-middle">CPF</th>
						<th class="align-middle">Telefone</th>
						<th class="align-middle">ativo</th>														
					</tr>
					<tr>
						<?php
						
						
			$sql = "select * from cliente";
			$resultado = mysqli_query($connect, $sql);
			
			if (mysqli_num_rows($resultado) > 0):
				while ($dados = mysqli_fetch_array($resultado)):
					?>
					<tr>
						<td class="table-cell align-middle">
							<?php echo $dados['id_cliente']; ?>
						</td>
						<td class="table-cell align-middle">
							<?php echo $dados['nome']; ?>
						</td>
						<td class="table-cell align-middle">
							<?php echo formatar_CPF_CNPJ($dados['cpf']); ?>
						</td>
						<td class="table-cell align-middle">
							<?php echo telephone($dados['telefone']); ?>
						</td>
						<td class="table-cell align-middle">
							<?php echo $dados['ativo']; ?>
						</td>

						
						
						</td>
					</tr>

				<?php endwhile;

			else:
				?>
				<tr>
					<td colspan="8" class="text-center">Nenhum atendente encontrado.</td>
				</tr>
				<?php
			endif;
			?>
		</tbody>
	</table>
</div>
			<form method="post" action="teste_export.php" >						
					<button type="submit" name="export" value="csv export" class="btn btn-secondary mt-3 float-end"><i
						class="bi bi-plus"></i>Gerar CSV</button>
				</form>
			
			

</body>
</html>