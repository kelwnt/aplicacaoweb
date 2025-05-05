<?php
session_start();

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


</head>

<body>
    <div class="row mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="p-1 mb-3 bg-dark text-white rounded border border-light">
                <h3 class="text-center">Relatório de Clientes</h3>
            </div>
            <div class="rounded border border-secondary p-3">
                <form method="GET" action="">
                    <div class="row mb-3">
                        <div class="input-group mb-3">
						<span class="input-group-text" style="min-width: 10%;">Buscar por:</span>
                        <select class="form-select" id="searchBy" name="searchBy">
                                <option value="nome">Nome</option>
                                <option value="cpf">CPF</option>
                            </select>                            
                            <span class="input-group-text" id="inputGroup-sizing-sm" style="min-width: 5%;">Termo de Busca
							</span>
                            <input type="text" name="term" id="term" class="form-control" 
							value="" >						
                           
                            <button type="submit" class="btn btn-secondary">
    <i class="bi bi-search"></i> Pesquisar
</button>
					    </div>                        
                    </div>
                    
                </form>
                <table class="table table-striped text-center mt-3">
                    <thead>
                        <tr class="table-header">
                            <th class="align-middle">id_cliente</th>
                            <th class="align-middle">Nome</th>
                            <th class="align-middle">CPF</th>
                            <th class="align-middle">Telefone</th>
                            <th class="align-middle">ativo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Abrindo conexao com o banco de dados, dentro do arquivo db_connect tem mais explicações do seu funcionamento
                        include_once '../php_action/db_connect.php';
                        // Inclui a função de formatação do CPF/CPNJ
                        include_once '../functions.php';

                        $sql = "SELECT * FROM cliente";
						$_SESSION['rel_cliente'] = $sql;

                        // Se o campo de pesquisa e o termo de busca estiverem preenchidos
						if (isset($_GET['searchBy'], $_GET['term']) && !empty($_GET['term'])) {
                            $searchBy = $_GET['searchBy'];
                            $term = $_GET['term'];
                            // Adiciona a cláusula WHERE na consulta SQL
                            if ($searchBy == 'cpf') {
                                echo "<p class='text-muted'>Buscando por CPF. Não é necessário formatar.</p>";
                                $term = str_replace(array('.', '-'), '', $term); // Remove formatação do CPF
                            } else {
                                $term = addslashes($term);
                            }
                            $sql .= " WHERE $searchBy LIKE '%$term%'";
							$_SESSION['rel_cliente'] = $sql;
                        }

                        $resultado = mysqli_query($connect, $sql);

                        if (mysqli_num_rows($resultado) > 0) :
                            while ($dados = mysqli_fetch_array($resultado)) :
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
                                </tr>
                            <?php endwhile;
                        else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Nenhum atendente encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <form method="post" action="export_csv.php">
                <button type="submit" name="export" value="csv export" class="btn btn-secondary mt-3 float-end"><i
                        class="bi bi-plus"></i>Gerar CSV</button>
            </form>
        </div>
    </div>

</body>

</html>
