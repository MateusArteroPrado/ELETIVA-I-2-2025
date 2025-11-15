<?php
require("cabecalho.php");
require("conexao.php");

$veiculo = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $placa_get = $_GET['placa'] ?? null;
        if (!$placa_get) throw new Exception("Placa não fornecida.");

        $stmt = $pdo->prepare("SELECT v.placa, v.modelo, m.nome 
                               FROM veiculo v
                               JOIN morador m ON v.morador_id_morador = m.id_morador
                               WHERE v.placa = ?");
        $stmt->execute([$placa_get]);
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$veiculo) throw new Exception("Veículo não encontrado.");
    } catch (Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $placa = $_POST['placa'];
    try {
        $stmt = $pdo->prepare("DELETE FROM veiculo WHERE placa = ?");
        if ($stmt->execute([$placa])) {
            header('location: veiculos.php?excluir=true');
            exit;
        } else {
            header('location: veiculos.php?excluir=false');
            exit;
        }
    } catch (\PDOException $e) {
        if ($e->getCode() == '23000') {
            $erro_msg = "Não é possível excluir: este veículo possui registros de movimentação.";
            header('location: veiculos.php?excluir=false&erro=' . urlencode($erro_msg));
        } else {
            header('location: veiculos.php?excluir=false&erro=' . urlencode($e->getMessage()));
        }
        exit;
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Apagar Veículo</h2>

                    <div class="alert alert-danger" role="alert">
                        <strong>Atenção!</strong> Você tem certeza que deseja excluir o registro abaixo?
                        <br>
                        <small>Nota: A exclusão falhará se houver registros de movimentação deste veículo.</small>
                    </div>

                    <?php if (!empty($veiculo)): ?>
                        <form method="post">
                            <input type="hidden" name='placa' value='<?= htmlspecialchars($_GET['placa'] ?? '') ?>'>

                            <div class="mb-3">
                                <label class="form-label">Placa:</label>
                                <input disabled value='<?= htmlspecialchars($veiculo['placa'] ?? '') ?>' type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Modelo:</label>
                                <input disabled value='<?= htmlspecialchars($veiculo['modelo'] ?? '') ?>' type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Proprietário:</label>
                                <input disabled value='<?= htmlspecialchars($veiculo['nome'] ?? '') ?>' type="text" class="form-control">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                                <a href="veiculos.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                            </div>
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