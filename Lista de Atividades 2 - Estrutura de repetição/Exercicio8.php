<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 8</h1>
    <p class='text-center'>Contagem regressiva do numero inserido até o 1</p>
    <form method="post">
        <div class="mb-3">
            <label for="numero" class="form-label">Numero limite</label>
            <input type="number" id="numero" name="numero" class="form-control" required="" placeholder="Insira aqui o numero inicial da contagem regressiva">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
    if ($numero >= 1) {
        do {
            echo "<p class='text-center'>" . $numero . "</p>";
            $numero--;
        } while ($numero > 0);
    } else {
        echo "<p class='text-center'>É necessário usar um valor acima de 0.</p>";
    }
}
include('rodape.php') ?>