<?php
// Função para formatar CNPJ no padrão 00.000.000/0000-00
function formatar_CNPJ($cnpj) {
    $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
    if (strlen($cnpj) !== 14) return false;

    return substr($cnpj, 0, 2) . '.' .
           substr($cnpj, 2, 3) . '.' .
           substr($cnpj, 5, 3) . '/' .
           substr($cnpj, 8, 4) . '-' .
           substr($cnpj, 12, 2);
}

// Função para formatar telefone no padrão (99) 9999 - 9999
function telephone($number) {
    $number = preg_replace("/[^0-9]/", "", $number);
    return "(" . substr($number, 0, 2) . ") " . 
           substr($number, 2, -4) . " - " . 
           substr($number, -4);
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#cnpj").inputmask("99.999.999/9999-99");
        $("#telefone").inputmask("(99) 9999-9999");
    });
</script>

<script>
    function myFunction(p1, p2) {
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
