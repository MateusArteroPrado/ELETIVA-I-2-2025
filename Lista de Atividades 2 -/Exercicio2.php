<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 2</h1>
    <p class='text-center'>Calcular a soma dos diferentes ou triplo do valor se iguais</p>
    <form method="post">
        <div class="mb-3">
            <label for="primeiro" class="form-label">Primeiro</label>
            <input type="number" id="primeiro" name="primeiro" class="form-control" required="" placeholder="Insira o primeiro valor.">
        </div>
        <div class="mb-3">
            <label for="segundo" class="form-label">Segundo</label>
            <input type="number" id="segundo" name="segundo" class="form-control"placeholder="Insira o segundo valor.">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$primeiro = (int)$_POST['primeiro'];
$segundo = (int)$_POST['segundo'];
if($primeiro!=$segundo){
    $valor=$primeiro+$segundo;
    echo "<p class='text-center'>Os valores são diferentes e o resultado da soma deles é ".$valor.".</p>";
}else{
    $valor=$primeiro*3;
    echo "<p class='text-center'>Os valores são iguais então o triplo do valor ".$primeiro." é ".$valor.".</p>";
}}

include('rodape.php') ?>