<?php
require("cabecalho.php");
require("conexao.php");

// Adicionando 'no-print' nas mensagens de feedback
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
    echo "<div class='alert alert-danger no-print'>Erro: " . $e->getMessage() . "</div>";
    $dados = [];
}
?>

<div class="d-flex flex-column align-items-center mt-3">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 90%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Veículos</h2>
            
            <!-- NOVO CONTÊINER DE ALINHAMENTO -->
            <div class="d-flex justify-content-between mb-3 no-print">
                <!-- Botão Novo Registro (Esquerda) -->
                <a href="novo_veiculo.php" class="btn btn-success">Novo Registro</a>
                
                <!-- Botão Imprimir (Direita) -->
                <button class='btn btn-secondary' onclick="window.print()">
                    Imprimir
                </button>
            </div>
            <!-- FIM DO CONTÊINER DE ALINHAMENTO -->

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Cor</th>
                        <th>Proprietário</th>
                        <!-- Adicionando no-print na coluna Ações -->
                        <th class="no-print">Ações</th>
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
                                <!-- Adicionando no-print na coluna Ações -->
                                <td class="d-flex gap-2 no-print">
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