<?php
    include("cabecalho.php");
// -----------------------------------------------------


    //operadores matematicos
    // > < >= <= != == === (esse ultimo é o identico)
    // && (e) || (ou) !(não)
    $valor = 10;
    if ($valor > 20 && ($valor < 30)) {
        echo "Valor maior que 20 e menor que 30!";
    } else {
        echo "Valor menor ou igual a 20!";
    }
// -----------------------------------------------------
    include("rodape.php");
?>