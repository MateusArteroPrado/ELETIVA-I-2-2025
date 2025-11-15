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
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $id_morador = $_POST['id_morador'];

    if (empty($titulo) || empty($descricao) || empty($id_morador)) {
        echo "<div class='container mt-3 alert alert-danger'>Título, Descrição e Relator são obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO ocorrencia (titulo, descricao, data_hora, morador_id_morador) 
                                   VALUES (?, ?, NOW(), ?)");

            if ($stmt->execute([$titulo, $descricao, $id_morador])) {
                header('location: ocorrencias.php?cadastro=true');
                exit;
            } else {
                header('location: ocorrencias.php?cadastro=false');
                exit;
            }
        } catch (\Exception $e) {
            echo "<div class='container mt-3 alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Registrar Nova Ocorrência</h2>
                    <form method="post">

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título:</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ex: Barulho excessivo" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição (O Acontecimento):</label>
                            <textarea id="descricao" name="descricao" class="form-control" rows="5" placeholder="Descreva detalhadamente o que aconteceu..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="id_morador" class="form-label">Relator (Morador):</label>
                            <select id="id_morador" name="id_morador" class="form-select" required>
                                <option value="">Selecione quem está relatando</option>
                                <?php foreach ($moradores as $morador): ?>
                                    <option value="<?= $morador['id_morador'] ?>">
                                        <?= htmlspecialchars($morador['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Registrar</button>
                        <a href="ocorrencias.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require("rodape.php")
?>