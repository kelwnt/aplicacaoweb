<?php
// alert.php

// Exibindo erros de login, se houver
if (!empty($erros)):
    foreach($erros as $erro):
?>
<div class="alert-danger rounded" role="alert">
    <p class="text-xl-center"><?php echo $erro; ?></p>
</div>
<?php
    endforeach;
endif;
?>