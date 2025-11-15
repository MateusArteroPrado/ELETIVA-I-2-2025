<?php
require("cabecalho.php");
require("conexao.php");

$moradores = [];
$veiculo = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $placa_get = $_GET['placa'] ?? null;
        if (!$placa_get) throw new Exception("Placa do veículo não fornecida.");

        $stmt_veiculo = $pdo->prepare("SELECT * FROM veiculo WHERE placa = ?");
        $stmt_veiculo->execute([$placa_get]);
        $veiculo = $stmt_veiculo->fetch(PDO::FETCH_ASSOC);
        if (!$veiculo) throw new Exception("Veículo não encontrado.");

        $stmt_moradores = $pdo->query("SELECT * FROM morador ORDER BY nome");
        $moradores = $stmt_moradores->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $id_morador = $_POST['id_morador'];

    try {
        $stmt = $pdo->prepare("UPDATE veiculo SET modelo = ?, cor = ?, morador_id_morador = ? WHERE placa = ?");

        if ($stmt->execute([$modelo, $cor, $id_morador, $placa])) {
            header('location: veiculos.php?editar=true');
            exit;
        } else {
            header('location: veiculos.php?editar=false');
            exit;
        }
    } catch (\Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro ao editar: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Editar Veículo</h2>

                    <?php if (!empty($veiculo)): ?>
                        <form method="post">

                            <div class="mb-3">
                                <label for="placa" class="form-label">Placa (Não editável):</label>
                                <input type="text" id="placa" name="placa" class="form-control"
                                    value="<?= htmlspecialchars($veiculo['placa'] ?? '') ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo:</label>
                                <input value='<?= htmlspecialchars($veiculo['modelo'] ?? '') ?>' type="text" id="modelo" name="modelo" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="cor" class="form-label">Cor:</label>
                                <input value='<?= htmlspecialchars($veiculo['cor'] ?? '') ?>' type="text" id="cor" name="cor" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="id_morador" class="form-label">Proprietário (Morador):</label>
                                <select id="id_morador" name="id_morador" class="form-select" required>
                                    <option value="">Selecione um morador</option>
                                    <?php foreach ($moradores as $morador): ?>
                                        <?php
                                        $selected = ($morador['id_morador'] == $veiculo['morador_id_morador']) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $morador['id_morador'] ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($morador['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Salvar Alterações</button>
                            <a href="veiculos.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">Veículo não encontrado.</div>
                        <a href="veiculos.php" class="btn btn-secondary">Voltar para a Lista</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("rodape.php"); ?>