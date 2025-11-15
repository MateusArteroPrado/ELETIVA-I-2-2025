<?php
require("cabecalho.php");
require("conexao.php");

$moradores = [];
try {
    $stmt_moradores = $pdo->query("SELECT id_morador, nome FROM morador ORDER BY nome");
    $moradores = $stmt_moradores->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "<div class='container mt-3 alert alert-danger'>Erro ao carregar moradores: " . $e->getMessage() . "</div>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $placa = strtoupper(trim($_POST['placa']));
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $id_morador = $_POST['id_morador'];

    if (empty($placa) || empty($id_morador) || empty($modelo)) {
        echo "<div class='container mt-3 alert alert-danger'>Placa, Modelo e Proprietário são obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO veiculo (placa, modelo, cor, morador_id_morador) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$placa, $modelo, $cor, $id_morador])) {
                header('location: veiculos.php?cadastro=true');
                exit;
            } else {
                header('location: veiculos.php?cadastro=false');
                exit;
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == '23000') {
                echo "<div class='container mt-3 alert alert-danger'>Erro: A placa <strong>$placa</strong> já está cadastrada no sistema.</div>";
            } else {
                echo "<div class='container mt-3 alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
            }
        }
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Novo Veículo</h2>
                    <form method="post">

                        <div class="mb-3">
                            <label for="placa" class="form-label">Placa:</label>
                            <input type="text" id="placa" name="placa" class="form-control" placeholder="Ex: ABC1234" maxlength="7" style="text-transform:uppercase" required>
                        </div>

                        <div class="mb-3">
                            <label for="modelo" class="form-label">Marca/Modelo:</label>
                            <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ex: VW Gol" required>
                        </div>

                        <div class="mb-3">
                            <label for="cor" class="form-label">Cor:</label>
                            <input type="text" id="cor" name="cor" class="form-control" placeholder="Ex: Prata" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_morador" class="form-label">Proprietário (Morador):</label>
                            <select id="id_morador" name="id_morador" class="form-select" required>
                                <option value="" selected disabled>Selecione um morador</option>
                                <?php foreach ($moradores as $morador): ?>
                                    <option value="<?= $morador['id_morador'] ?>">
                                        <?= htmlspecialchars($morador['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Salvar Veículo</button>
                        <a href="veiculos.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require("rodape.php")
?>