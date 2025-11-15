<?php
require("cabecalho.php");
require("conexao.php");

$feedback = '';
if (isset($_GET['cadastro'])) {
    $feedback = $_GET['cadastro'] == 'true'
        ? "<div class='alert alert-success'>CADASTRO REALIZADO</div>"
        : "<div class='alert alert-danger'>ERRO AO CADASTRAR</div>";
}
if (isset($_GET['editar'])) {
    $feedback = $_GET['editar'] == 'true'
        ? "<div class='alert alert-success'>CADASTRO EDITADO</div>"
        : "<div class='alert alert-danger'>ERRO AO EDITAR</div>";
}
if (isset($_GET['excluir'])) {
    $feedback = $_GET['excluir'] == 'true'
        ? "<div class='alert alert-success'>CADASTRO EXCLUÍDO</div>"
        : "<div class='alert alert-danger'>ERRO AO EXCLUIR</div>";
}

try {
    $stmt = $pdo->query("SELECT * FROM unidade ORDER BY complemento, numero");
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    $dados = [];
}
?>

<div class="d-flex flex-column align-items-center mt-3">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 90%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Unidades</h2>

            <?= $feedback ?>

            <a href="nova_unidade.php" class="btn btn-success mb-3">Novo Registro</a>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Complemento (rua/bloco)</th>
                        <th>Número (Casa/Apto)</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dados) > 0): ?>
                        <?php foreach ($dados as $d): ?>
                            <tr>
                                <td><?= htmlspecialchars($d['id_unidade']) ?></td>
                                <td><?= htmlspecialchars($d['complemento']) ?></td>
                                <td><?= htmlspecialchars($d['numero']) ?></td>
                                <td class="d-flex gap-2">
                                    <a href="editar_unidade.php?id=<?= $d['id_unidade'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="apagar_unidade.php?id=<?= $d['id_unidade'] ?>" class="btn btn-sm btn-info">Apagar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhuma unidade cadastrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require("rodape.php") ?>