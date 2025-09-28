<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-10 border ">
    <h1 class='text-center'>Exercicio 2</h1>
    <p class='text-center'>Lista de contatos.</p>
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <p> - Aluno <?= $i ?> - </p>
            <div class="row inline-row mb-3">
                <div class="col-md-9">
                    <label for="nomes[]" class="form-label">Nome</label>
                    <input type="text" id="nomes[]" name="nomes[]" class="form-control">
                </div>
                <div class="col-md-1">
                    <label for="nota1[]" class="form-label">Nota 1</label>
                    <input type="number" id="nota1[]" name="nota1[]" class="form-control">
                </div>
                <div class="col-md-1">
                    <label for="nota2[]" class="form-label">Nota 2</label>
                    <input type="number" id="nota2[]" name="nota2[]" class="form-control">
                </div>
                <div class="col-md-1">
                    <label for="nota3[]" class="form-label">Nota 3</label>
                    <input type="number" id="nota3[]" name="nota3[]" class="form-control" required="">
                </div>
            </div>
        <?php endfor; ?>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nomes'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];
    $alunos = [];

    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $media = (($nota1[$i]+$nota2[$i]+$nota3[$i])/3);

        if (isset($alunos[$nome])){
            echo "<p class='text-danger text-center'>O aluno {$nome} foi inserido mais de uma vez e registrado apenas a primeira.</p>";
        } else {
            $alunos[$nome] = $media;
        }
    }

    arsort($alunos);
    echo "<p class='text-center fw-bold'>Lista de contatos</p>";
    foreach ($alunos as $nome => $media) {
        echo "<p class='text-center'>{$nome} - {$media}<p>";
    }
}
include('rodape.php') ?>