<?php
require("cabecalho.php");
require("conexao.php");

// Lógica de Feedback
$feedback = '';
if (isset($_GET['cadastro'])) {
    $feedback = $_GET['cadastro'] == 'true' 
        ? "<div class='alert alert-success'>OCORRÊNCIA REGISTRADA</div>" 
        : "<div class='alert alert-danger'>ERRO AO REGISTRAR</div>";
}
if (isset($_GET['editar'])) {
    $feedback = $_GET['editar'] == 'true' 
        ? "<div class='alert alert-success'>OCORRÊNCIA EDITADA</div>" 
        : "<div class='alert alert-danger'>ERRO AO EDITAR</div>";
}
if (isset($_GET['excluir'])) {
    $feedback = $_GET['excluir'] == 'true' 
        ? "<div class='alert alert-success'>OCORRÊNCIA EXCLUÍDA</div>" 
        : "<div class='alert alert-danger'>ERRO AO EXCLUIR</div>";
}

try {
    // Busca todos os campos, incluindo a descrição completa
    $stmt = $pdo->prepare("SELECT 
                                o.id_ocorrencia, 
                                o.titulo,
                                o.descricao, 
                                DATE_FORMAT(o.data_hora, '%d/%m/%Y às %H:%i') AS data_formatada,
                                m.nome AS nome_morador 
                           FROM ocorrencia o
                           JOIN morador m ON o.morador_id_morador = m.id_morador
                           ORDER BY o.data_hora DESC");
    $stmt->execute();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    $dados = [];
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
        
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Mural de Ocorrências</h2>
                <a href="nova_ocorrencia.php" class="btn btn-success">Registrar Nova</a>
            </div>

            <?= $feedback ?>

            <?php if (count($dados) > 0): ?>
                <?php foreach ($dados as $d): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><?= htmlspecialchars($d['titulo']) ?></h5>
                            <small class="text-muted"><?= htmlspecialchars($d['data_formatada']) ?></small>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= nl2br(htmlspecialchars($d['descricao'])) ?></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">Relator: <strong><?= htmlspecialchars($d['nome_morador']) ?></strong></small>
                            <div class="d-flex gap-2">
                                <a href="editar_ocorrencia.php?id=<?= $d['id_ocorrencia'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="apagar_ocorrencia.php?id=<?= $d['id_ocorrencia'] ?>" class="btn btn-sm btn-info">Apagar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info text-center">Nenhuma ocorrência registrada.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require("rodape.php") ?>