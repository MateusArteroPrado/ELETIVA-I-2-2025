<?php
require("cabecalho.php");
require("conexao.php");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $complemento = $_POST['complemento'];
    $numero = $_POST['numero'];
    try{
        $stmt = $pdo->prepare("INSERT INTO unidade (complemento,numero) VALUES (?, ?)");
        if($stmt->execute([$complemento, $numero])){
            header('location: unidades.php?cadastro=true');
        }else{
            header('location: unidades.php?cadastro=false');
        }
    }catch(\Exception $e){
            echo "Erro: ".$e->getMessage(); 
    }
}
?>

<h1>Nova unidade</h1>
<form method="post">
<div class="mb-3">
              <label for="complemento" class="form-label">Informe o complemento da unidade:</label>
              <input type="text" id="complemento" name="complemento" class="form-control" required="">
            </div>
<div class="mb-3">
              <label for="numero" class="form-label">Informe o numero da unidade:</label>
              <input type="int" id="numero" name="numero" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php

require("rodape.php")
?>