<?php

// Select para listar os atendentes
//$sql_atendentes = "SELECT * FROM atendente";
//$resultado = mysqli_query($connect, $sql_atendentes);

$sql = "select * from cliente";
$resultado = mysqli_query($connect, $sql);
?>