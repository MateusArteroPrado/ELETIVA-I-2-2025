<?php
require("cabecalho.php");
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $id_unidade_get = $_GET['id'] ?? null;
        if (!$id_unidade_get) {
            throw new Exception("ID da unidade não fornecido.");
        }

        $stmt = $pdo->prepare("SELECT * FROM unidade WHERE id_unidade = ?");
        $stmt->execute([$id_unidade_get]);
        $unidade = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$unidade) {
            throw new Exception("Unidade não encontrada.");
        }
    } catch (Exception $e) {
        echo "Erro ao consultar unidade: " . $e->getMessage();
        $unidade = [];
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $complemento = $_POST['complemento'];
    $numero = $_POST['numero'];
    $id_unidade = $_POST['id_unidade'];

    try {
        $stmt = $pdo->prepare("UPDATE unidade SET complemento = ?, numero = ? WHERE id_unidade = ?");

        if ($stmt->execute([$complemento, $numero, $id_unidade])) {
            header('location: unidades.php?editar=true');
        } else {
            header('location: unidades.php?editar=false');
        }
    } catch (\Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Editar Unidade</h2>

                    <?php if (!empty($unidade)): ?>
                        <form method="post">
                            <input type="hidden" name='id_unidade' value='<?= htmlspecialchars($unidade['id_unidade'] ?? '') ?>'>
                            <div class="mb-3">
                                <label for="complemento" class="form-label">Endereço (Rua/Bloco):</label>
                                <input value='<?= htmlspecialchars($unidade['complemento'] ?? '') ?>' type="text" id="complemento" name="complemento" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número (Casa/Apto):</label>
                                <input value='<?= htmlspecialchars($unidade['numero'] ?? '') ?>' type="number" id="numero" name="numero" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2">Salvar Alterações</button>
                            <a href="unidades.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">Unidade não encontrada ou ID inválido.</div>
                        <a href="unidades.php" class="btn btn-secondary">Voltar para a Lista</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require("rodape.php")
?>