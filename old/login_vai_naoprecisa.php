<?php
// Conexão com o banco de dados
$link = mysqli_connect("localhost", "root", "", "ratendimento");
 
if (!$link) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
 
echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;
 



// Inicia sessões
session_start();

// Recupera o login
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
// Recupera a senha, a criptografando em MD5
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

// Usuário não forneceu a senha ou o login
if(!$login || !$senha)
{
	echo "Você deve digitar sua senha e login!";
	exit;
}

/**
* Executa a consulta no banco de dados.
* Caso o número de linhas retornadas seja 1 o login é válido,
* caso 0, inválido.
*/
$sql = "SELECT id_atendente, nome, login, senha FROM atendente WHERE login = '" . $login . "'";
/**$sql = "select * from atendente"*/

echo "$sql";


$result_id = $link->query($sql);



/**$result_id = mysql_query($sql) or die("Erro no banco de dados!");*/
$total = mysqli_num_rows($result_id);

echo $total;
// Caso o usuário tenha digitado um login válido o número de linhas será 1..
if($total)
{
	// Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão
	$dados = @mysql_fetch_array($result_id);

	// Agora verifica a senha
	if(!strcmp($senha, $dados["senha"]))
	{
		// TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
		$_SESSION["id_usuario"]= $dados["id"];
		$_SESSION["nome_usuario"] = stripslashes($dados["nome"]);
		$_SESSION["permissao"]= $dados["postar"];
		header("Location: index.php");
		exit;
	}
	// Senha inválida
	else
	{
	 "Senha inválida!";
	exit;
	}
}
	// Login inválido
else
{
	echo "O login fornecido por você é inexistente!";
	exit;
}
?>