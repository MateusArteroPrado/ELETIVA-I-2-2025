<?php
require("cabecalho.php");
require("conexao.php");

$unidades = [];
$morador = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $id_morador_get = $_GET['id'] ?? null;
        if (!$id_morador_get) throw new Exception("ID do morador não fornecido.");

        $stmt_morador = $pdo->prepare("SELECT * FROM morador WHERE id_morador = ?");
        $stmt_morador->execute([$id_morador_get]);
        $morador = $stmt_morador->fetch(PDO::FETCH_ASSOC);
        if (!$morador) throw new Exception("Morador não encontrado.");

        $stmt_unidades = $pdo->query("SELECT * FROM unidade ORDER BY complemento, numero");
        $unidades = $stmt_unidades->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $id_unidade = $_POST['id_unidade'];
    $id_morador = $_POST['id_morador'];

    try {
        $stmt = $pdo->prepare("UPDATE morador SET nome = ?, unidade_id_unidade = ? WHERE id_morador = ?");

        if ($stmt->execute([$nome, $id_unidade, $id_morador])) {
            header('location: moradores.php?editar=true');
            exit;
        } else {
            header('location: moradores.php?editar=false');
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
                    <h2 class="card-title text-center mb-4">Editar Morador</h2>

                    <?php if (!empty($morador)): ?>
                        <form method="post">
                            <input type="hidden" name='id_morador' value='<?= htmlspecialchars($morador['id_morador'] ?? '') ?>'>

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo:</label>
                                <input value='<?= htmlspecialchars($morador['nome'] ?? '') ?>' type="text" id="nome" name="nome" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="id_unidade" class="form-label">Unidade (Casa/Apto):</label>
                                <select id="id_unidade" name="id_unidade" class="form-select" required>
                                    <option value="">Selecione uma unidade</option>
                                    <?php foreach ($unidades as $unidade): ?>
                                        <?php
                                        $selected = ($unidade['id_unidade'] == $morador['unidade_id_unidade']) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $unidade['id_unidade'] ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($unidade['complemento'] . ' - ' . $unidade['numero']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Salvar Alterações</button>
                            <a href="moradores.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">Morador não encontrado.</div>
                        <a href="moradores.php" class="btn btn-secondary">Voltar para a Lista</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("rodape.php"); ?>