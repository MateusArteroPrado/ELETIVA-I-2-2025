<?php
require("cabecalho.php");
require("conexao.php");

if (isset($_GET['cadastro'])) {
    $msg = $_GET['cadastro'] == 'true'
        ? "<div class='alert alert-success'>CADASTRO REALIZADO</div>"
        : "<div class='alert alert-danger'>ERRO AO CADASTRAR</div>";
    echo $msg;
}
if (isset($_GET['editar'])) {
    $msg = $_GET['editar'] == 'true'
        ? "<div class='alert alert-success'>CADASTRO EDITADO</div>"
        : "<div class='alert alert-danger'>ERRO AO EDITAR</div>";
    echo $msg;
}
if (isset($_GET['excluir'])) {
    $msg = $_GET['excluir'] == 'true'
        ? "<div class='alert alert-success'>CADASTRO EXCLUÍDO</div>"
        : "<div class='alert alert-danger'>ERRO AO EXCLUIR</div>";
    echo $msg;
}

try {
    $stmt = $pdo->prepare("SELECT 
                                v.placa, 
                                v.modelo, 
                                v.cor, 
                                m.nome AS nome_morador 
                           FROM veiculo v
                           JOIN morador m ON v.morador_id_morador = m.id_morador
                           ORDER BY v.modelo");
    $stmt->execute();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    $dados = [];
}
?>

<div class="d-flex flex-column align-items-center mt-3">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 90%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Veículos</h2>
            <a href="novo_veiculo.php" class="btn btn-success mb-3">Novo Registro</a>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Cor</th>
                        <th>Proprietário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dados) > 0): ?>
                        <?php foreach ($dados as $d): ?>
                            <tr>
                                <td><?= htmlspecialchars($d['placa']) ?></td>
                                <td><?= htmlspecialchars($d['modelo']) ?></td>
                                <td><?= htmlspecialchars($d['cor']) ?></td>
                                <td><?= htmlspecialchars($d['nome_morador']) ?></td>
                                <td class="d-flex gap-2">
                                    <a href="editar_veiculo.php?placa=<?= $d['placa'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="apagar_veiculo.php?placa=<?= $d['placa'] ?>" class="btn btn-sm btn-info">Apagar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhum veículo encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require("rodape.php") ?>