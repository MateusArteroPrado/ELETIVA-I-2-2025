<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 3</h1>
    <p class='text-center'>Ordenando os números</p>
    <form method="post">
        <div class="mb-3">
            <label for="valor_a" class="form-label">Valor A</label>
            <input type="number" id="valor_a" name="valor_a" class="form-control" required="" placeholder="Insira o primeiro numero">
        </div>
        <div class="mb-3">
            <label for="valor_b" class="form-label">Valor B</label>
            <input type="number" id="valor_b" name="valor_b" class="form-control"placeholder="Insira o segundo numero">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$valor_a = (int)$_POST['valor_a'];
$valor_b = (int)$_POST['valor_b'];
if($valor_a!=$valor_b){
    if($valor_a>$valor_b){
        echo "<p class='text-center'>Na ordem crescente: ". $valor_b ." ". $valor_a. "</p>";
    }else{
        echo "<p class='text-center'>Na ordem crescente: ". $valor_a ." ". $valor_b. "</p>";
    }      
}else{
    echo "<p class='text-center'>Os valores são iguais: ".$valor_a."</p>";
}}

include('rodape.php') ?>