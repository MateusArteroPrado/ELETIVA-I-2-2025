<?php
require("cabecalho.php");
require("conexao.php");

// GET: Busca os dados para confirmação
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM unidade WHERE id_unidade = ?");
        $stmt->execute([$_GET['id']]);
        $unidade = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erro ao consultar unidade: " . $e->getMessage();
        $unidade = [];
    }
}

// POST: Executa a exclusão
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_unidade = $_POST['id_unidade'];
    try {
        $stmt = $pdo->prepare("DELETE FROM unidade WHERE id_unidade = ?");
        if ($stmt->execute([$id_unidade])) {
            header('location: unidades.php?excluir=true');
        } else {
            header('location: unidades.php?excluir=false');
        }
    } catch (\Exception $e) {
        // Captura o erro (ex: se um morador estiver vinculado a esta unidade)
        header('location: unidades.php?excluir=false&erro=' . urlencode($e->getMessage()));
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Excluir Unidade</h2>

                    <div class="alert alert-danger" role="alert">
                        <strong>Atenção!</strong> Você tem certeza que deseja excluir o registro abaixo?
                        <br>
                        <small>Nota: A exclusão falhará se houver moradores vinculados a esta unidade.</small>
                    </div>

                    <?php if (!empty($unidade)): ?>
                        <form method="post">
                            <input type="hidden" name='id_unidade' value='<?= htmlspecialchars($unidade['id_unidade'] ?? '') ?>'>
                            <div class="mb-3">
                                <label class="form-label">Endereço (Rua / Bloco):</label>
                                <input disabled value='<?= htmlspecialchars($unidade['complemento'] ?? '') ?>' type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Número (Casa / Apto):</label>
                                <input disabled value='<?= htmlspecialchars($unidade['numero'] ?? '') ?>' type="number" class="form-control">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                                <a href="unidades.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">Unidade não encontrada.</div>
                        <a href="unidades.php" class="btn btn-secondary">Voltar para a Lista</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require("rodape.php");
?>