<?php
    $valor = array(1, 2, 3, 4, 5);
    echo "Valor da primeira posição do vetor: " .$valor[0]."</p>";
    //$v = $_POST['nome'];

    $vetor = [1, 2, 3, 4, 5];
    //Funçao para exibir valores do vetor
    var_dump($vetor);
    echo "<br/>";
    print_r($vetor);

    $vetor[4]=6;
    echo "<p>Novo Valor da Posição:".$vetor[4]."</p>";
    $vetor['nome'] = "Vanessa";
    print_r($vetor);

    $valores = [
        'nome' => 'Mateus',
        'sobrenome' => 'Artero',
        'idade' => 29];

    foreach($valores as $v){
        echo "<p>$v</p>";}


    foreach($valores as $c => $v){
        echo "<p>Posição: $c = Valor $v </p>";}