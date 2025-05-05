<html>
	<head>
	<title>Login</title>
	<meta charset="utf-8">
	<!-- Abaixo carregamos o framowrk boostrap, e algumas funções especificas de javascript --> 
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>

<body>
<?php
//--------------------Conexao com o banco de dados
$servername = "localhost";
$username = "root";
$passowrd = "";
$db_name = "ratendimento";

$connect = mysqli_connect($servername, $username, $passowrd, $db_name);

if (mysqli_connect_error()):
	echo "<p>falha na conexão: " .mysqli_connect_error()."</p>";
	else:
	echo "<p>conectou: </p>"; 	
	endif;
//--------------------Conexao com o banco de dados
?>

<div class="row">
	<div class="col 12 m8 push-m2 ">
	
	<h3 class="ligth" > Professores </h3>
	
	<table class="striped">
		<thead>
			<tr>
				<th>Código: </th>
				<th></th>
				<th>Nome do Professor: </th>
				<th></th>
				<th>Disciplina: </th>
				<th></th>
				<th>Curso: </th>
				<th></th>
				<th>Excluir: </th>
			</tr>
		</thead>
		
		<tbody>
		
				
			<?php
			
			$sql = "select * from tipo_atendimento"; // select em uma tabela
			$resultado = mysqli_query($connect, $sql); //Coloca todo resultado na variavel resutlado
			
			if(mysqli_num_rows($resultado) > 0):
			
			// [id_tipo_ATENDIMENTO] > [1], [TIPO_ATENDIMENTO] > CONSULTA
			// [id_tipo_ATENDIMENTO] > [2], [TIPO_ATENDIMENTO] > CONSULTA
			// [id_tipo_ATENDIMENTO] > [3], [TIPO_ATENDIMENTO] > CONSULTA			
									
			while($dados = mysqli_fetch_array($resultado)):
			// [id_tipo_atendimento] > [1], [tipo_atendimento] > CONSULTA, [ativo] > ATIVO
			?>
				
			<tr>
			<td><?php echo $dados['id_tipo_atendimento']; ?> <td/>
			<td><?php echo $dados['tipo_atendimento']; ?>  <td/>
			<td><?php echo $dados['ativo']; ?>  <td/>
			</tr>			
			<?php endwhile;			
			else: ?>
			
			<td><td/>
			<td><td/>
			<td><td/>
			<td><td/>
			<td><td/>
			<td><td/>			
			<?php
			endif;
			?>
			
		</tbody>
	</table>
		<br>
					
	
	</div>
</div>

</body>
</html>