<?php
require("cabecalho.php");
require("conexao.php");

try {
    $total_unidades = $pdo->query("SELECT COUNT(*) FROM unidade")->fetchColumn();
    $total_moradores = $pdo->query("SELECT COUNT(*) FROM morador")->fetchColumn();
    $total_veiculos = $pdo->query("SELECT COUNT(*) FROM veiculo")->fetchColumn();
    $total_ocorrencias = $pdo->query("SELECT COUNT(*) FROM ocorrencia")->fetchColumn();
} catch (Exception $e) {
    $total_unidades = $total_moradores = $total_veiculos = $total_ocorrencias = 0;
}

?>


<div class="container mt-4">
    <h1 class="text-center">Métricas Gerais do Condomínio</h1>
    <p class="lead text-center">Visão geral dos cadastros e atividades.</p>
    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">Unidades Cadastradas</h5>
                    <p class="card-text fs-2 text-center"><?= $total_unidades ?></p>
                    <a href="unidades.php" class="text-white small">Ver detalhes</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">Moradores Ativos</h5>
                    <p class="card-text fs-2 text-center"><?= $total_moradores ?></p>
                    <a href="moradores.php" class="text-white small">Ver detalhes</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary  shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">Veículos Registrados</h5>
                    <p class="card-text fs-2 text-center"><?= $total_veiculos ?></p>
                    <a href="veiculos.php" class="text-white small">Ver detalhes</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">Total de Ocorrências</h5>
                    <p class="card-text fs-2 text-center"><?= $total_ocorrencias ?></p>
                    <a href="ocorrencias.php" class="text-white small">Ver mural</a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php require("rodape.php"); ?>