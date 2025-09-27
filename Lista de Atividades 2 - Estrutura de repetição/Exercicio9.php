<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 9</h1>
    <p class='text-center'>Calculando o fatorial de um número</p>
    <form method="post">
        <div class="mb-3">
            <label for="numero" class="form-label">Numero</label>
            <input type="number" id="numero" name="numero" class="form-control" required="" placeholder="Insira aqui o numero para calcular o fatorial">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
        if($numero>=1){
            $contador = 1;
            $fatorial = 1;
            while($contador<=$numero){
                $fatorial = $fatorial * $contador;
                $contador ++;
            }
            echo "<p class='text-center'>O fatorial de ".$numero." é ".$fatorial. "!</p>";}
        else{
            echo "<p class='text-center'>É necessário usar um valor acima de 0.</p>";
        }
        }
include('rodape.php') ?>