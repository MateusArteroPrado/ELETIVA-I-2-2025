<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercicio 3</h1>
    <p class='text-center'>Confira se uma palavra está contida na outra</p>
    <form method="post">
        <div class="mb-3">
            <label for="palavra1" class="form-label">Palavra 1 (A que pode conter)</label>
            <input type="text" id="palavra1" name="palavra1" class="form-control" required="" placeholder="Insira aqui a 1ª palavra">
        </div>
        <div class="mb-3">
            <label for="palavra2" class="form-label">Palavra 2 (A que pode estar contida)</label>
            <input type="text" id="palavra2" name="palavra2" class="form-control" required="" placeholder="Insira aqui a 2ª palavra">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $palavra1 = $_POST['palavra1'];
    $palavra2 = $_POST['palavra2'];
    function contida($palavra1,$palavra2){
        if (str_contains($palavra1, $palavra2)) {
            echo "<p class='text-center'>A palavra '{$palavra2}' está presente em '{$palavra1}'.</p>";
        } else {
            echo "<p class='text-center'>A palavra '{$palavra2}' não está presente em '{$palavra1}'.</p>";
        } //Professora, eu estava concatenando do jeito mais dificil e não sabia
    }
    contida($palavra1,$palavra2);
}
include('rodape.php') ?>