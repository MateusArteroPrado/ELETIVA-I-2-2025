<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercicio 1</h1>
    <p class='text-center'>Contador do número de caracteres</p>
    <form method="post">
        <div class="mb-3">
            <label for="palavra" class="form-label">Palavra:</label>
            <input type="text" id="palavra" name="palavra" class="form-control" required="" placeholder="Insira aqui a palavra">
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['palavra'];
    $tamanho = mb_strlen($texto);
    echo "<p class='text-center'> O número de caracteres da palavra " .$texto." é ".$tamanho. "</p>";
        }
include('rodape.php') ?>