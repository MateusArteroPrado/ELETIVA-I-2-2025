<?php
require("cabecalho.php");
require("conexao.php");

$movimentacao = [];

// GET: Busca os dados para confirmação
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $id_mov_get = $_GET['id'] ?? null;
        if (!$id_mov_get) throw new Exception("ID da movimentação não fornecido.");

        // Busca os dados (JOIN para pegar o nome do morador)
        $stmt = $pdo->prepare("SELECT 
                                   mov.tipo, 
                                   DATE_FORMAT(mov.data_hora, '%d/%m/%Y %H:%i') as data,
                                   m.nome as nome_morador
                               FROM movimentacao mov
                               JOIN morador m ON mov.morador_id_morador = m.id_morador
                               WHERE mov.id_movimentacao = ?");
        $stmt->execute([$id_mov_get]);
        $movimentacao = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$movimentacao) throw new Exception("Movimentação não encontrada.");
        
    } catch (Exception $e) {
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}

// POST: Executa a exclusão
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_movimentacao = $_POST['id_movimentacao'];
    try {
        $stmt = $pdo->prepare("DELETE FROM movimentacao WHERE id_movimentacao = ?");
        if ($stmt->execute([$id_movimentacao])) {
            header('location: movimentacoes.php?excluir=true');
            exit;
        } else {
            header('location: movimentacoes.php?excluir=false');
            exit;
        }
    } catch (\PDOException $e) {
         header('location: movimentacoes.php?excluir=false&erro=' . urlencode($e->getMessage()));
         exit;
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Apagar Registro de Movimentação</h2>
                    
                    <div class="alert alert-danger" role="alert">
                        <strong>Atenção!</strong> Você tem certeza que deseja excluir permanentemente este registro?
                    </div>

                    <?php if (!empty($movimentacao)): ?>
                        <form method="post">
                            <input type="hidden" name='id_movimentacao' value='<?= htmlspecialchars($_GET['id'] ?? '') ?>'>
                            
                            <div class="mb-3">
                                <label class="form-label">Tipo:</label>
                                <input disabled value='<?= htmlspecialchars($movimentacao['tipo'] ?? '') ?>' type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data/Hora:</label>
                                <input disabled value='<?= htmlspecialchars($movimentacao['data'] ?? '') ?>' type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Morador:</label>
                                <input disabled value='<?= htmlspecialchars($movimentacao['nome_morador'] ?? '') ?>' type="text" class="form-control">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                                <a href="movimentacoes.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">Registro não encontrado.</div>
                        <a href="movimentacoes.php" class="btn btn-secondary">Voltar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php require("rodape.php"); ?>