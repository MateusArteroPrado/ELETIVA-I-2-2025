<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercicio 2</h1>
    <p class='text-center'>Colocando sua palavra (ou texto) maiuscula e minuscula.</p>
    <form method="post">
        <div class="mb-3">
            <label for="palavra" class="form-label">Palavra:</label>
            <input type="text" id="palavra" name="palavra" class="form-control" required="" placeholder="Insira aqui a palavra (ou texto)">
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['palavra'];
    echo "<p class='text-center'> Sua palavra (ou texto) em maíusculo: " .mb_strtoupper($texto). "</p>";
    echo "<p class='text-center'> Sua palavra (ou texto) em minúsculo: " .mb_strtolower($texto). "</p>";
        }
include('rodape.php') ?>