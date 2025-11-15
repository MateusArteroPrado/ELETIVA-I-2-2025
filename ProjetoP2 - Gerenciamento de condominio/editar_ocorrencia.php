<?php
require("cabecalho.php");
require("conexao.php");

$moradores = [];
$ocorrencia = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $id_ocorrencia_get = $_GET['id'] ?? null;
        if (!$id_ocorrencia_get) throw new Exception("ID da ocorrência não fornecido.");

        $stmt_ocorrencia = $pdo->prepare("SELECT * FROM ocorrencia WHERE id_ocorrencia = ?");
        $stmt_ocorrencia->execute([$id_ocorrencia_get]);
        $ocorrencia = $stmt_ocorrencia->fetch(PDO::FETCH_ASSOC);
        if (!$ocorrencia) throw new Exception("Ocorrência não encontrada.");

        $stmt_moradores = $pdo->query("SELECT * FROM morador ORDER BY nome");
        $moradores = $stmt_moradores->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $id_morador = $_POST['id_morador'];
    $id_ocorrencia = $_POST['id_ocorrencia'];

    try {
        $stmt = $pdo->prepare("UPDATE ocorrencia SET titulo = ?, descricao = ?, morador_id_morador = ? 
                               WHERE id_ocorrencia = ?");

        if ($stmt->execute([$titulo, $descricao, $id_morador, $id_ocorrencia])) {
            header('location: ocorrencias.php?editar=true');
            exit;
        } else {
            header('location: ocorrencias.php?editar=false');
            exit;
        }
    } catch (\Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro ao editar: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Editar Ocorrência</h2>
                    <?php if (!empty($ocorrencia)): ?>
                        <form method="post">
                            <input type="hidden" name='id_ocorrencia' value='<?= htmlspecialchars($ocorrencia['id_ocorrencia'] ?? '') ?>'>

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título:</label>
                                <input value='<?= htmlspecialchars($ocorrencia['titulo'] ?? '') ?>' type="text" id="titulo" name="titulo" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição (O Acontecimento):</label>
                                <textarea id="descricao" name="descricao" class="form-control" rows="5" required><?= htmlspecialchars($ocorrencia['descricao'] ?? '') ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="id_morador" class="form-label">Relator (Morador):</label>
                                <select id="id_morador" name="id_morador" class="form-select" required>
                                    <option value="">Selecione quem está relatando</option>
                                    <?php foreach ($moradores as $morador): ?>
                                        <?php
                                        $selected = ($morador['id_morador'] == $ocorrencia['morador_id_morador']) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $morador['id_morador'] ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($morador['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Salvar Alterações</button>
                            <a href="ocorrencias.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">Ocorrência não encontrada.</div>
                        <a href="ocorrencias.php" class="btn btn-secondary">Voltar para o Mural</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("rodape.php"); ?>