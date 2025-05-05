<?php

$sql = "select * from tipo_atendimento where ativo = 'A'";
$resultado = mysqli_query($connect, $sql);
while ($dados_tipo = mysqli_fetch_array($resultado)): ?>
	<option value="<?php echo $dados_tipo['id_tipo_atendimento']; ?>">
		<?php echo $dados_tipo['tipo_atendimento']; ?>
	</option>
<?php endwhile; ?>
