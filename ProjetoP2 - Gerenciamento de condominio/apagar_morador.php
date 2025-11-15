<?php
require("cabecalho.php");
require("conexao.php");

$morador = [];

// GET: Busca os dados para confirmação
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $id_morador_get = $_GET['id'] ?? null;
        if (!$id_morador_get) throw new Exception("ID do morador não fornecido.");

        // JOIN para mostrar o nome e a unidade do morador
        $stmt = $pdo->prepare("SELECT m.nome, u.complemento, u.numero 
                               FROM morador m 
                               JOIN unidade u ON m.unidade_id_unidade = u.id_unidade
                               WHERE m.id_morador = ?");
        $stmt->execute([$id_morador_get]);
        $morador = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$morador) throw new Exception("Morador não encontrado.");
        
    } catch (Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}

// POST: Executa a exclusão
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_morador = $_POST['id_morador'];
    try {
        $stmt = $pdo->prepare("DELETE FROM morador WHERE id_morador = ?");
        if ($stmt->execute([$id_morador])) {
            header('location: moradores.php?excluir=true');
            exit;
        } else {
            header('location: moradores.php?excluir=false');
            exit;
        }
    } catch (\PDOException $e) {
        // Erro de violação de Foreign Key (ex: morador tem veículo)
         if ($e->getCode() == '23000') {
             $erro_msg = "Não é possível excluir: este morador possui veículos ou ocorrências vinculados.";
             header('location: moradores.php?excluir=false&erro=' . urlencode($erro_msg));
         } else {
             header('location: moradores.php?excluir=false&erro=' . urlencode($e->getMessage()));
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
                    <h2 class="card-title text-center mb-4">Apagar Morador</h2>
                    
                    <div class="alert alert-danger" role="alert">
                        <strong>Atenção!</strong> Você tem certeza que deseja excluir o registro abaixo?
                        <br>
                        <small>Nota: A exclusão falhará se houver veículos ou ocorrências vinculados a este morador.</small>
                    </div>

                    <?php if (!empty($morador)): ?>
                        <form method="post">
                            <input type="hidden" name='id_morador' value='<?= htmlspecialchars($_GET['id'] ?? '') ?>'>
                            
                            <div class="mb-3">
                                <label class="form-label">Nome:</label>
                                <input disabled value='<?= htmlspecialchars($morador['nome'] ?? '') ?>' type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Unidade:</label>
                                <input disabled value='<?= htmlspecialchars($morador['complemento'] . ' - ' . $morador['numero']) ?>' type="text" class="form-control">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                                <a href="moradores.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                            </div>
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