<?php 
$host = "localhost" ; 
$user = "root" ; 
$password = "" ; 
$dbname = "ratendimento" ; 

/*$servername = "localhost";
$username = "root";
$passowrd = "";
$db_name = "ratendimento";
*/

try { 
    $pdo = new  PDO ( "mysql:host=$host;dbname=$dbname" , $user , $password ); 
    $pdo -> setAttribute (PDO:: ATTR_ERRMODE , PDO:: ERRMODE_EXCEPTION ); 
} catch (PDOException $e ) { 
    die ( "Falha na conexão: " . $e -> getMessage ()); 
} 
?>