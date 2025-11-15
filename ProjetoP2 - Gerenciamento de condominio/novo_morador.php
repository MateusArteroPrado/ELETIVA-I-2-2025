<?php
require("cabecalho.php");
require("conexao.php");

// 1. Buscar todas as unidades para o dropdown
$unidades = [];
try {
    $stmt_unidades = $pdo->query("SELECT id_unidade, numero, complemento FROM unidade ORDER BY complemento, numero");
    $unidades = $stmt_unidades->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "<div class='container mt-3 alert alert-danger'>Erro ao carregar unidades: " . $e->getMessage() . "</div>";
}

// 2. Tratar o POST (Cadastro do Morador)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $id_unidade = $_POST['id_unidade']; // ID que vem do <select>

    if (empty($nome) || empty($id_unidade)) {
        echo "<div class='container mt-3 alert alert-danger'>Nome e Unidade são obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO morador (nome, unidade_id_unidade) VALUES (?, ?)");
            if ($stmt->execute([$nome, $id_unidade])) {
                header('location: moradores.php?cadastro=true');
                exit;
            } else {
                header('location: moradores.php?cadastro=false');
                exit;
            }
        } catch (\Exception $e) {
            // Exibe erro genérico ou de duplicidade
            echo "<div class='container mt-3 alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Novo Morador</h2>
                    <form method="post">

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo:</label>
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Ex: João da Silva" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_unidade" class="form-label">Unidade (Casa/Apto):</label>
                            <select id="id_unidade" name="id_unidade" class="form-select" required>
                                <option value="">Selecione uma unidade</option>
                                <?php foreach ($unidades as $unidade): ?>
                                    <option value="<?= $unidade['id_unidade'] ?>">
                                        <?= htmlspecialchars($unidade['complemento'] . ' - ' . $unidade['numero']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Salvar Morador</button>
                        <a href="moradores.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require("rodape.php")
?>