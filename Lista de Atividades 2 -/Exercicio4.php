<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercicio 4</h1>
    <p class='text-center'>Reajustando preços, se for maior que 100 reais sofre 15% de desconto.</p>
    <form method="post">
        <div class="mb-3">
            <label for="valor" class="form-label">Preço</label>
            <input type="number" id="valor" name="valor" class="form-control" required="" placeholder="Insira o preço do produto">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor = (float)$_POST['valor'];
    if($valor>100){
        $valor = $valor*0.85;
        echo"<p class='text-center'>O valor era maior que R$100,00 portanto recebeu 15% de desconto!\n 
        Seu novo preço agora é R$". number_format($valor, 2, ',', '.') . "!</p>";
    }else{
        echo"<p class='text-center'>O valor se mantém a R$". number_format($valor, 2, ',', '.') .".</p>";
    }
}

include('rodape.php') ?>