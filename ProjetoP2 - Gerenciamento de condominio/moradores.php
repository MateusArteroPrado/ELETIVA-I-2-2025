<?php
require("cabecalho.php");
require("conexao.php");

// Mensagens de feedback (movidas para dentro do container)
$feedback = '';
if (isset($_GET['cadastro'])) {
    $feedback = $_GET['cadastro'] ? "<div class='alert alert-success'>CADASTRO REALIZADO</div>" : "<div class='alert alert-danger'>ERRO AO CADASTRAR</div>";
}
if (isset($_GET['editar'])) {
    $feedback = $_GET['editar'] ? "<div class='alert alert-success'>CADASTRO EDITADO</div>" : "<div class='alert alert-danger'>ERRO AO EDITAR</div>";
}
if (isset($_GET['excluir'])) {
    $feedback = $_GET['excluir'] ? "<div class='alert alert-success'>CADASTRO EXCLUÍDO</div>" : "<div class='alert alert-danger'>ERRO AO EXCLUIR</div>";
}

try {
    // Consulta CORRIGIDA com JOIN para buscar o nome da unidade
    $stmt = $pdo->prepare("SELECT 
                                m.id_morador, 
                                m.nome, 
                                u.numero, 
                                u.complemento 
                           FROM morador m 
                           JOIN unidade u ON m.unidade_id_unidade = u.id_unidade 
                           ORDER BY m.nome");
    $stmt->execute();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
    $dados = [];
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="card-title">Moradores</h2>
                        <a href="novo_morador.php" class="btn btn-success">Novo Registro</a>
                    </div>
                    
                    <?= $feedback ?> <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Unidade</th> <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados as $d): ?>
                                <tr>
                                    <td><?= htmlspecialchars($d['id_morador']) ?></td>
                                    <td><?= htmlspecialchars($d['nome']) ?></td>
                                    <td><?= htmlspecialchars($d['complemento'] . ' - ' . $d['numero']) ?></td>
                                    <td class="d-flex gap-2">
                                        <a href="editar_morador.php?id=<?= $d['id_morador'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                        <a href="apagar_morador.php?id=<?= $d['id_morador'] ?>" class="btn btn-sm btn-danger">Apagar</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("rodape.php") ?>  