<?php
require("cabecalho.php");
require("conexao.php");

// Mensagens de feedback
$feedback = '';
if (isset($_GET['cadastro'])) {
    $feedback = $_GET['cadastro'] ? "<div class='alert alert-success'>CADASTRO REALIZADO</div>" : "<div class='alert alert-danger'>ERRO AO CADASTRAR</div>";
}
// ... (pode adicionar 'editar' e 'excluir' aqui também) ...

try {
    // Consulta CORRIGIDA com JOIN para buscar o nome do morador
    $stmt = $pdo->prepare("SELECT 
                                v.placa, 
                                v.modelo, 
                                v.cor, 
                                m.nome AS nome_morador 
                           FROM veiculo v
                           JOIN morador m ON v.morador_id_morador = m.id_morador
                           ORDER BY v.placa");
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
                        <h2 class="card-title">Veículos</h2>
                        <a href="novo_veiculo.php" class="btn btn-success">Novo Registro</a>
                    </div>
                    
                    <?= $feedback ?> <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Placa</th>
                                <th>Modelo</th>
                                <th>Cor</th>
                                <th>Proprietário (Morador)</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados as $d): ?>
                                <tr>
                                    <td><?= htmlspecialchars($d['placa']) ?></td>
                                    <td><?= htmlspecialchars($d['modelo']) ?></td>
                                    <td><?= htmlspecialchars($d['cor']) ?></td>
                                    <td><?= htmlspecialchars($d['nome_morador']) ?></td>
                                    <td class="d-flex gap-2">
                                        <a href="editar_veiculo.php?placa=<?= $d['placa'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                        <a href="apagar_veiculo.php?placa=<?= $d['placa'] ?>" class="btn btn-sm btn-danger">Apagar</a>
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