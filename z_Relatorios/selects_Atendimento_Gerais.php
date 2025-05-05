<?php
			
            $id_tipo_atendimento = $dados['id_tipo_atendimento'];
			
			$sql_tipo_atendimento = "select * from tipo_atendimento where id_tipo_atendimento = '$id_tipo_atendimento'" ;
			$resultado_tipo_atendimento = mysqli_query($connect, $sql_tipo_atendimento);
			$dados_tipo_atendimento = mysqli_fetch_array($resultado_tipo_atendimento);
			
			$id_atendente = $_SESSION['id_atendente'];
			
			$sql_atendente = "select * from atendente where id_atendente = '$id_atendente'" ;
			$resultado_atendente = mysqli_query($connect, $sql_atendente);
			$dados_atendente = mysqli_fetch_array($resultado_atendente);
			
			$id_cliente = $dados['id_cliente'];
			
			$sql_cliente = "select * from cliente where id_cliente = '$id_cliente'" ;
			$resultado_cliente = mysqli_query($connect, $sql_cliente);
			$dados_cliente = mysqli_fetch_array($resultado_cliente);