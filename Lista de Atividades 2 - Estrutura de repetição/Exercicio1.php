<?php
include("cabecalho.php");
?>

<h1>Encontre o menor valor e sua posição.</h1>
<form method="post">
    <div class="row inline-row mb-3">
        <div class="col-md-1">
            <label for="num1" class="form-label">Numero 1</label>
            <input type="number" id="num1" name="num1" class="form-control" required>
        </div>
        <div class="col-md-1">
            <label for="num2" class="form-label">Numero 2</label>
            <input type="number" id="num2" name="num2" class="form-control" required>
        </div>
        <div class="col-md-1">
            <label for="num3" class="form-label">Numero 3</label>
            <input type="number" id="num3" name="num3" class="form-control" required>
        </div>
        <div class="col-md-1">
            <label for="num4" class="form-label">Numero 4</label>
            <input type="number" id="num4" name="num4" class="form-control" required>
        </div>
        <div class="col-md-1">
            <label for="num5" class="form-label">Numero 5</label>
            <input type="number" id="num5" name="num5" class="form-control" required>
        </div>
        <div class="col-md-1">
            <label for="num6" class="form-label">Numero 6</label>
            <input type="number" id="num6" name="num6" class="form-control" required>
        </div>
        <div class="col-md-1">
            <label for="num7" class="form-label">Numero 7</label>
            <input type="number" id="num7" name="num7" class="form-control" required>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Encontrar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$num1 = (int)$_POST['num1'];
$num2 = (int)$_POST['num2'];
$num3 = (int)$_POST['num3'];
$num4 = (int)$_POST['num4'];
$num5 = (int)$_POST['num5'];
$num6 = (int)$_POST['num6'];
$num7 = (int)$_POST['num7'];
//Aqui eu inicializo supondo que o menor já seja o primeiro
$menor = $num1;
$posicao = 1;
//Ai aqui começa a comparação input por input
if($menor>$num2){
    $menor = $num2;
    $posicao = 2;
}
if($menor>$num3){
    $menor = $num3;
    $posicao = 3;
}
if($menor>$num4){
    $menor = $num4;
    $posicao = 4;
}
if($menor>$num5){
    $menor = $num5;
    $posicao = 5;
}
if($menor>$num6){
    $menor = $num6;
    $posicao = 6;
}
if($menor>$num7){
    $menor = $num7;
    $posicao = 7;
}
echo "<p>O menor valor identificado é ". $menor ." e sua posição é ". $posicao .".</p>";
}
include("rodape.php");
?>