<?php

$dominio = "mysql:host=localhost;dbname=condominio";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO($dominio, $usuario, $senha);
} catch (Exception $e) {
    die("Erro ao conectar ao banco!" . $e->getMessage());
}
