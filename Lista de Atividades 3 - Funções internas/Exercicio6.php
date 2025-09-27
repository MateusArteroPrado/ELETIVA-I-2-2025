<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercicio 6</h1>
    <p class='text-center'>Insira um número com decimal e receba-o arredondado.</p>
    <form method="post">
        <div class="mb-3">
            <label for="numero" class="form-label">Numero:</label>
            <input type="number" id="numero" name="numero" class="form-control" required="" placeholder="Insira aqui o numero" step="any">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
    function arredonda($numero){
        echo "<p class='text-center'>A versão arredondada de ".$numero." é ".round($numero)."</p>";
    }
    arredonda($numero);
}
include('rodape.php') ?>