<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 5</h1>
    <p class='text-center'>Insira um número de 1 a 12 e receba o mês respectivo.</p>
    <form method="post">
        <div class="mb-3">
            <label for="mes" class="form-label">Numero (1 - 12)</label>
            <input type="number" id="mes" name="mes" class="form-control" required="" placeholder="Insira aqui um número de um até 12">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mes = $_POST['mes'];
    switch ($mes) {
        case 1:
            echo "<p class='text-center'>Janeiro</p>";
            break;
        case 2:
            echo "<p class='text-center'>Fevereiro</p>";
            break;
        case 3:
            echo "<p class='text-center'>Março</p>";
            break;
        case 4:
            echo "<p class='text-center'>Abril</p>";
            break;
        case 5:
            echo "<p class='text-center'>Maio</p>";
            break;
        case 6:
            echo "<p class='text-center'>Junho</p>";
            break;
        case 7:
            echo "<p class='text-center'>Julho</p>";
            break;
        case 8:
            echo "<p class='text-center'>Agosto</p>";
            break;
        case 9:
            echo "<p class='text-center'>Setembro</p>";
            break;
        case 10:
            echo "<p class='text-center'>Outubro</p>";
            break;
        case 11:
            echo "<p class='text-center'>Novembro</p>";
            break;
        case 12:
            echo "<p class='text-center'>Dezembro</p>";
            break;
        default:
            echo "<p class='text-center'>Valor invalido! Insira um numero de 1 a 12</p>";
    }
}
include('rodape.php') ?>