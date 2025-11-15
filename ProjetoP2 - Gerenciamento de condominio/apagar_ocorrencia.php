<?php
require("cabecalho.php");
require("conexao.php");

$ocorrencia = [];

// GET: Busca os dados para confirmação
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $id_ocorrencia_get = $_GET['id'] ?? null;
        if (!$id_ocorrencia_get) throw new Exception("ID da ocorrência não fornecido.");

        // Busca o título para confirmação
        $stmt = $pdo->prepare("SELECT titulo FROM ocorrencia WHERE id_ocorrencia = ?");
        $stmt->execute([$id_ocorrencia_get]);
        $ocorrencia = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$ocorrencia) throw new Exception("Ocorrência não encontrada.");
        
    } catch (Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}

// POST: Executa a exclusão
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_ocorrencia = $_POST['id_ocorrencia'];
    try {
        $stmt = $pdo->prepare("DELETE FROM ocorrencia WHERE id_ocorrencia = ?");
        if ($stmt->execute([$id_ocorrencia])) {
            header('location: ocorrencias.php?excluir=true');
            exit;
        } else {
            header('location: ocorrencias.php?excluir=false');
            exit;
        }
    } catch (\PDOException $e) {
         // Erro genérico
         header('location: ocorrencias.php?excluir=false&erro=' . urlencode($e->getMessage()));
         exit;
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Apagar Ocorrência</h2>
                    
                    <div class="alert alert-danger" role="alert">
                        <strong>Atenção!</strong> Você tem certeza que deseja excluir permanentemente esta ocorrência?
                    </div>

                    <?php if (!empty($ocorrencia)): ?>
                        <form method="post">
                            <input type="hidden" name='id_ocorrencia' value='<?= htmlspecialchars($_GET['id'] ?? '') ?>'>
                            
                            <div class="mb-3">
                                <label class="form-label">Título da Ocorrência:</label>
                                <input disabled value='<?= htmlspecialchars($ocorrencia['titulo'] ?? '') ?>' type="text" class="form-control">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                                <a href="ocorrencias.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">Ocorrência não encontrada.</div>
                        <a href="ocorrencias.php" class="btn btn-secondary">Voltar ao Mural</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php require("rodape.php"); ?>