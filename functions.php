<?php
// Função para formatar CPF
function formatar_CPF($cpf) {
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
}

// Função para formatar CNPJ
function formatar_CNPJ($cnpj) {
    $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
    return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4);
}

function telephone($number)
{
    $number = "(" . substr($number, 0, 2) . ") " . substr($number, 2, -4) . " - " . substr($number, -4);
    // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
    return $number;
}

function formatar_CPF_CNPJ($doc)
{

    $doc = preg_replace("/[^0-9]/", "", $doc);

    if (strlen($doc) === 11) {
        $docFormatado = substr($doc, 0, 3) . '.' .
            substr($doc, 3, 3) . '.' .
            substr($doc, 6, 3) . '-' .
            substr($doc, 9, 2);
    } else {
        $docFormatado = substr($doc, 0, 2) . '.' .
            substr($doc, 2, 3) . '.' .
            substr($doc, 5, 3) . '/' .
            substr($doc, 8, 4);
    }

    return $docFormatado;
}
?>

<script type="text/javascript">
	$(document).ready(function () {
		$("#cpf").inputmask("999.999.999-99");
		$("#telefone").inputmask("(99) 9999-9999");
	});
</script>

<script>
	function myFunction(p1, p2) {
		//var x = p1 + p2;


		document.getElementById("id_cliente").value = p2;
		document.getElementById("nome_cliente").value = p1;

	}
</script>

<script language="javascript">
    function valida() {
        var comboNome = document.getElementById("id_tipo_atendimento");
        if (comboNome.options[comboNome.selectedIndex].value == "") {
            var alertModal = new bootstrap.Modal(document.getElementById('modal_alerta'));
            alertModal.show();
        }
    }
</script>