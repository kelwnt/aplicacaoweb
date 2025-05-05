<?php
//conexao com o banco de dados, abaixo assamos o usuario, a senha e o banco em qual vamos conectar. Quando chamamos o comando require_once 'php_action/db_connect.php';, 
//estamos comecando uma conexao o banco de dados no inicio da nossa página PHP

$servername = "localhost";
$username = "root";
$passowrd = "";
$db_name = "ratendimento";

$connect = mysqli_connect($servername, $username, $passowrd, $db_name);

if (mysqli_connect_error()):
	echo "falha na conexão: " .mysqli_connect_error();
	endif;

?>