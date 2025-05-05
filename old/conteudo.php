<?php
$pagina = isset( $_GET['acessando'] ) ? $_GET['acessando'] : '';
if($pagina=='')
  include ('principal.html');
elseif(file_exists($pagina.'.html')){
  include ($pagina.'.html');
}		
elseif(file_exists($pagina.'.php')){
  include ($pagina.'.php');
}
else 
  include ('principal.html');
?>