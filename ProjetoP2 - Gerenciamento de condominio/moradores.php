<?php
require("cabecalho.php");
require("conexao.php");

if (isset($_GET['cadastro'])) {
    $msg = $_GET['cadastro'] == 'true'
        ? "<div class='alert alert-success no-print'>CADASTRO REALIZADO</div>"
        : "<div class='alert alert-danger no-print'>ERRO AO CADASTRAR</div>";
    echo $msg;
}
if (isset($_GET['editar'])) {
    $msg = $_GET['editar'] == 'true'
        ? "<div class='alert alert-success no-print'>CADASTRO EDITADO</div>"
        : "<div class='alert alert-danger no-print'>ERRO AO EDITAR</div>";
    echo $msg;
}
if (isset($_GET['excluir'])) {
    $msg = $_GET['excluir'] == 'true'
        ? "<div class='alert alert-success no-print'>CADASTRO EXCLUÍDO</div>"
        : "<div class='alert alert-danger no-print'>ERRO AO EXCLUIR</div>";
    echo $msg;
}

try {
    // JOIN para buscar o endereço da unidade vinculado ao morador
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
    echo "<div class='alert alert-danger no-print'>Erro: " . $e->getMessage() . "</div>";
    $dados = [];
}
?>

<div class="d-flex flex-column align-items-center mt-3">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 90%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Moradores</h2>
            <div class="d-flex justify-content-between mb-3 no-print">
                <a href="novo_morador.php" class="btn btn-success">Novo Registro</a>

                <button class='btn btn-secondary' onclick="window.print()">
                    Imprimir
                </button>
            </div>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade (Endereço)</th>
                        <th class="no-print">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dados) > 0): ?>
                        <?php foreach ($dados as $d): ?>
                            <tr>
                                <td><?= htmlspecialchars($d['id_morador']) ?></td>
                                <td><?= htmlspecialchars($d['nome']) ?></td>
                                <td><?= htmlspecialchars($d['complemento'] . ' - ' . $d['numero']) ?></td>
                                <td class="d-flex gap-2 no-print">
                                    <a href="editar_morador.php?id=<?= $d['id_morador'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="apagar_morador.php?id=<?= $d['id_morador'] ?>" class="btn btn-sm btn-info">Apagar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhum morador encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require("rodape.php") ?>