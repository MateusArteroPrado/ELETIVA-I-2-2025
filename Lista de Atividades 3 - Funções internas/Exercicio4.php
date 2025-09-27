<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercicio 4</h1>
    <p class='text-center'>Formatador de data</p>
    <form method="post">
        <div class="mb-3">
            <label for="dia" class="form-label">Dia</label>
            <input type="number" id="dia" name="dia" class="form-control" required="" placeholder="Insira o dia (1-31)">
        </div>
        <div class="mb-3">
            <label for="mes" class="form-label">Mês</label>
            <input type="number" id="mes" name="mes" class="form-control" required="" placeholder="Insira o mês (1-12)">
        </div>
        <div class="mb-3">
            <label for="ano" class="form-label">Ano</label>
            <input type="number" id="ano" name="ano" class="form-control" required="" placeholder="Insira o ano (0 - 9999)">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    
}
include('rodape.php') ?>