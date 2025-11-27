<?php
require("cabecalho.php");
require("conexao.php");

// Lógica de Feedback
$feedback = '';
if (isset($_GET['cadastro'])) {
    $feedback = $_GET['cadastro'] == 'true'
        ? "<div class='alert alert-success no-print'>MOVIMENTAÇÃO REGISTRADA</div>"
        : "<div class='alert alert-danger no-print'>ERRO AO REGISTRAR</div>";
}
if (isset($_GET['excluir'])) {
    $feedback = $_GET['excluir'] == 'true'
        ? "<div class='alert alert-success no-print'>REGISTRO EXCLUÍDO</div>"
        : "<div class='alert alert-danger no-print'>ERRO AO EXCLUIR</div>";
}

try {
    $stmt = $pdo->prepare("SELECT 
                                mov.id_movimentacao, 
                                mov.tipo,
                                DATE_FORMAT(mov.data_hora, '%d/%m/%Y às %H:%i') AS data_formatada,
                                m.nome AS nome_morador,
                                v.placa AS placa_veiculo,
                                v.modelo AS modelo_veiculo 
                           FROM movimentacao mov
                           JOIN morador m ON mov.morador_id_morador = m.id_morador
                           LEFT JOIN veiculo v ON mov.veiculo_placa = v.placa
                           ORDER BY mov.data_hora DESC");
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

            <!-- CONTÊINER DE ALINHAMENTO PARA BOTÕES -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title mb-0">Registro de Movimentações</h2>
                <div class="d-flex gap-2 no-print">
                    <!-- Botões de Ação (Entrada/Saída) -->
                    <a href="nova_movimentacao.php?tipo=Entrada" class="btn btn-success">➡️ Entrada</a>
                    <a href="nova_movimentacao.php?tipo=Saida" class="btn btn-danger">⬅️ Saída</a>
                    <!-- Botão Imprimir -->
                    <button class='btn btn-secondary' onclick="window.print()">
                        Imprimir
                    </button>
                </div>
            </div>

            <?= $feedback ?>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Data/Hora</th>
                        <th>Morador</th>
                        <th>Veículo (Placa - Marca/Modelo)</th>
                        <th class="no-print">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dados) > 0): ?>
                        <?php foreach ($dados as $d): ?>
                            <tr>
                                <td>
                                    <?php if ($d['tipo'] == 'Entrada'): ?>
                                        <span class="badge bg-success">Entrada</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Saída</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($d['data_formatada']) ?></td>
                                <td><?= htmlspecialchars($d['nome_morador']) ?></td>

                                <td>
                                    <?php if ($d['placa_veiculo'] !== null): ?>
                                        <?= htmlspecialchars($d['placa_veiculo'] . ' - ' . $d['modelo_veiculo']) ?>
                                    <?php else: ?>
                                        Sem veículo
                                    <?php endif; ?>
                                </td>

                                <td class="no-print">
                                    <a href="apagar_movimentacao.php?id=<?= $d['id_movimentacao'] ?>" class="btn btn-sm btn-info">Apagar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma movimentação registrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require("rodape.php") ?>