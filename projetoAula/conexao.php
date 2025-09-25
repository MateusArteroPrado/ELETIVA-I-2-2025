<?php

    $dominio = "mysql:host=localhost;dbname=projetophp"; //começa informando o modelo do banco e aonde está alocado
    $usuario = "root";
    $senha = "";

    try{
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e) {
        die();
    }