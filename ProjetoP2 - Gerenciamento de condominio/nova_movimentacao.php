<?php
require("cabecalho.php");
require("conexao.php");

// Aqui captura se é entrada ou saída (depende do botão que clicou)
$tipo_selecionado = $_GET['tipo'] ?? null;
if (!$tipo_selecionado || ($tipo_selecionado != 'Entrada' && $tipo_selecionado != 'Saida')) {
    header('location: movimentacoes.php');
    exit;
}

$moradores = [];
try {
    $stmt_moradores = $pdo->query("SELECT id_morador, nome FROM morador ORDER BY nome");
    $moradores = $stmt_moradores->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}

$veiculos = [];
try {
    $stmt_veiculos = $pdo->query("SELECT v.placa, v.modelo, m.nome 
                                   FROM veiculo v 
                                   JOIN morador m ON v.morador_id_morador = m.id_morador 
                                   ORDER BY m.nome, v.modelo");
    $veiculos = $stmt_veiculos->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tipo = $_POST['tipo'];
    $id_morador = $_POST['id_morador'];
    $placa = !empty($_POST['placa']) ? $_POST['placa'] : null;

    if (empty($tipo) || empty($id_morador)) {
        echo "<div class='container mt-3 alert alert-danger'>Tipo e Morador são obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO movimentacao (tipo, data_hora, morador_id_morador, veiculo_placa) 
                                   VALUES (?, NOW(), ?, ?)");

            if ($stmt->execute([$tipo, $id_morador, $placa])) {
                header('location: movimentacoes.php?cadastro=true');
                exit;
            } else {
                header('location: movimentacoes.php?cadastro=false');
                exit;
            }
        } catch (\Exception $e) {
            echo "<div class='container mt-3 alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">

                    <h2 class="card-title text-center mb-4">
                        Registrar <?= htmlspecialchars($tipo_selecionado) ?>
                    </h2>

                    <form method="post">

                        <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo_selecionado) ?>">

                        <div class="mb-3">
                            <label for="id_morador" class="form-label">Morador:</label>
                            <select id="id_morador" name="id_morador" class="form-select" required>
                                <option value="">Selecione o morador</option>
                                <?php foreach ($moradores as $morador): ?>
                                    <option value="<?= $morador['id_morador'] ?>">
                                        <?= htmlspecialchars($morador['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="placa" class="form-label">Veículo (Opcional):</label>
                            <select id="placa" name="placa" class="form-select">
                                <option value="">Sem veículo</option>
                                <?php foreach ($veiculos as $veiculo): ?>
                                    <option value="<?= $veiculo['placa'] ?>">
                                        <?= htmlspecialchars($veiculo['placa'] . ' - ' . $veiculo['modelo'] . ' (' . $veiculo['nome'] . ')') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Registrar</button>
                        <a href="movimentacoes.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require("rodape.php")
?>