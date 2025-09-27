<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercicio 5</h1>
    <p class='text-center'>Descubra a raiz quadrada de um numero</p>
    <form method="post">
        <div class="mb-3">
            <label for="numero" class="form-label">Numero:</label>
            <input type="number" id="numero" name="numero" class="form-control" required="" placeholder="Insira aqui o numero">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
    function raizquadrada($numero){
        $raiz = sqrt($numero);
        echo "<p class='text-center'>A raiz de {$numero} é {$raiz}.</p>";
    }
    raizquadrada($numero);
}
include('rodape.php') ?>