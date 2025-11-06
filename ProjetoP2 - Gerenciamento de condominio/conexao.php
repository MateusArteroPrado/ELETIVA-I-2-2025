<?php

    $dominio = "mysql:host=localhost;dbname=condominio"; //começa informando o modelo do banco e aonde está alocado
    $usuario = "root";
    $senha = "";

    try{
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e) {
        die("Erro ao conectar ao banco!" .$e->getMessage());
    }