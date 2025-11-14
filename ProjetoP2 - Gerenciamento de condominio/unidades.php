<?php
require("cabecalho.php");
require("conexao.php");
try {
    $stmt = $pdo->query("SELECT * FROM unidade");
    $dados = $stmt->fetchAll();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}
if (isset($_GET['cadastro']) && $_GET['cadastro']) {
    echo "<p class='text-success'>CADASTRO REALIZADO</p>";
} else if (isset($_GET['cadastro']) && !$_GET['cadastro']) {
    echo "<p class='text-danger'>ERRO AO CADASTRAR</p>";
}
if (isset($_GET['editar']) && $_GET['editar']) {
    echo "<p class='text-success'>CADASTRO EDITADO</p>";
} else if (isset($_GET['editar']) && !$_GET['editar']) {
    echo "<p class='text-danger'>ERRO AO EDITAR</p>";
}
if (isset($_GET['excluir']) && $_GET['excluir']) {
    echo "<p class='text-success'>CADASTRO EXCLUIDO</p>";
} else if (isset($_GET['excluir']) && !$_GET['excluir']) {
    echo "<p class='text-danger'>ERRO AO EXCLUIR</p>";
}
?>

<div class="d-flex flex-column align-items-center">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 90%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Unidades</h2>
            <a href="nova_unidade.php" class="btn btn-success mb-3">Novo Registro</a>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $d): ?>
                        <tr>
                            <td><?= $d['id'] ?></td>
                            <td><?= $d['nome'] ?></td>
                            <td class="d-flex gap-2">
                                <a href="editar_unidade.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="apagar_unidade.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-info">Apagar</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php require("rodape.php") ?>