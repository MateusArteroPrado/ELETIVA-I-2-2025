<?php
require("cabecalho.php");
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM unidade WHERE id_unidade = ?");
        $stmt->execute([$_GET['id']]);
        $unidade = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erro ao consultar unidade: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_unidade = $_POST['id_unidade'];

    try {
        $stmt = $pdo->prepare("DELETE FROM unidade WHERE id_unidade = ?");

        if ($stmt->execute([$id_unidade])) {
            header('location: unidades.php?excluir=true');
            exit();
        } else {
            header('location: unidades.php?excluir=false');
            exit();
        }
    } catch (\Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<h1>Excluir unidade</h1>
<form method="post">
    <input type="hidden" name='id_unidade' value='<?= $unidade['id_unidade'] ?? $_GET['id'] ?>'>
    <div class="mb-3">
        <label for="complemento" class="form-label">Rua / Bloco:</label>
        <input disabled value='<?= $unidade['complemento'] ?>' type="text" id="complemento" name="complemento" class="form-control" required="">
        <label for="numero" class="form-label">Numero / Apartamento:</label>
        <input disabled value='<?= $unidade['numero'] ?>' type="int" id="numero" name="numero" class="form-control" required="">
    </div>
    <p>Deseja excluir esse registro?</p>
    <button type="submit" class="btn btn-danger">Excluir</button>
    <button onclick="history.back();" type="button" class="btn btn-secondary">Voltar</button>
</form>

<?php
require("rodape.php");
?>