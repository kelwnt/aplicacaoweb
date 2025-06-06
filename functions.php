<?php
// Formata CNPJ para 00.000.000/0000-00
function formatar_CNPJ($cnpj) {
    $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
    if (strlen($cnpj) !== 14) return "CNPJ Inválido";
    return substr($cnpj, 0, 2) . '.' .
           substr($cnpj, 2, 3) . '.' .
           substr($cnpj, 5, 3) . '/' .
           substr($cnpj, 8, 4) . '-' .
           substr($cnpj, 12, 2);
}

// Formata telefone para (99) 9999-9999 ou (99) 99999-9999
function telephone($number) {
    $number = preg_replace("/[^0-9]/", "", $number);
    if (strlen($number) === 10) {
        return "(" . substr($number, 0, 2) . ") " . substr($number, 2, 4) . "-" . substr($number, 6);
    } elseif (strlen($number) === 11) {
        return "(" . substr($number, 0, 2) . ") " . substr($number, 2, 5) . "-" . substr($number, 7);
    }
    return "Telefone Inválido";
}
?>
