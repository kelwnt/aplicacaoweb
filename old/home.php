<?php
//conexao
require_once 'db_connect.php';

// sessão
session_start();

//verificação

if (!isset($_SESSION['LOGADO'])):
	header('location: index.php');
endif;

//dados
$id = $_SESSION['id_atendente'];
echo $_SESSION['id_atendente'];
$sql = "select * from atendente where id_atendente = '$id' ";
echo "select * from atendente where id_atendente = '$id' ";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($connect); 
?>

<html>
	<head>
	<title>Teste Home</title>
	<meta charset="utf-8">
	</head>
<body>

<h1> Olá <?php echo $dados['nome']; ?> </h1>
<a href="logout.php">Sair</a>


</body>
</html>