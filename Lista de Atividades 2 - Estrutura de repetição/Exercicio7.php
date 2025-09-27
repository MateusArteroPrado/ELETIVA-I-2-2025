<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 7</h1>
    <p class='text-center'>Insira um número e somaremos todos de 1 até ele.</p>
    <form method="post">
        <div class="mb-3">
            <label for="numero" class="form-label">Numero limite</label>
            <input type="number" id="numero" name="numero" class="form-control" required="" placeholder="Insira aqui o numero até onde vamos somar.">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
        if($numero>=1){
            $contador = 1;
            $soma = 0;
            while($contador<=$numero){
                $soma = $soma + $contador;
                $contador ++;
            }
            echo "<p class='text-center'>A soma dos valores é ".$soma."</p>";}
        else{
            echo "<p class='text-center'>É necessário usar um valor acima de 0.</p>";
        }
        }
include('rodape.php') ?>