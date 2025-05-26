<?php

$servername = "localhost";
$username = "root";
$passowrd = "";
$db_name = "sistema";

$connect = mysqli_connect($servername, $username, $passowrd, $db_name);

if (mysqli_connect_error()):
	echo "falha na conexão: " .mysqli_connect_error();
	endif;

?>