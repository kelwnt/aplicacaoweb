<?php
			
			$sql = "select * from atendimento where ativo = 'A'";
			$resultado = mysqli_query($connect, $sql);

			$sql_cliente = "select * from cliente";
            $resultado_cliente = mysqli_query($connect, $sql_cliente);
	?>