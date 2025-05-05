<?php
//sessao
session_start();

if(isset($_SESSION['mensagem'])): ?>

	<script>
	//Mensagem
	 window.onload = function(){
		 M.toast({html: '<?php ECHO $_SESSION['mensagem']; ?>'});
	}; 
</script>
	
<?php	
endif;

unset($_SESSION['mensagem']);

//session_unset();
?>