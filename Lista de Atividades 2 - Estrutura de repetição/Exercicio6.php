<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 6</h1>
    <p class='text-center'>Insira um número e receba uma lista de 1 até ele</p>
    <form method="post">
        <div class="mb-3">
            <label for="numero" class="form-label">Numero limite</label>
            <input type="number" id="numero" name="numero" class="form-control" required="" placeholder="Insira aqui o numero onde a contagem vai parar">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
    if($numero>=1){
    for($i = 1;$i<=$numero; $i++){
        echo "<p class='text-center'>". $i . "</p>";
    }}else{
        echo "<p class='text-center'>O numero deve ser maior que zero!</p>";
    }
}
include('rodape.php') ?>