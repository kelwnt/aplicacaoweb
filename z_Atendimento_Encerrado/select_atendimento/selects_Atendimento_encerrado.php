<?php
			
			$sql = "select * from atendimento where ativo = 'C' or ativo =  'D'";
			$resultado = mysqli_query($connect, $sql);
	?>