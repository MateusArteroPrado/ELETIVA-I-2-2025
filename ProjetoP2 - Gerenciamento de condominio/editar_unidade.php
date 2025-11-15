<?php
require("cabecalho.php");
require("conexao.php");

// GET: Busca os dados atuais da unidade para preencher o formulário
if($_SERVER['REQUEST_METHOD']=="GET"){
    try{
        $stmt = $pdo->prepare("SELECT * FROM unidade WHERE id_unidade = ?");
        $stmt->execute([$_GET['id']]); // Recebe o ID pela URL
        $unidade = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch (Exception $e){
        echo "Erro ao consultar unidade: ".$e->getMessage();
        $unidade = [];
    }
}

// POST: Atualiza os dados no banco
if($_SERVER['REQUEST_METHOD']=="POST"){
    $complemento = $_POST['complemento'];
    $numero = $_POST['numero'];
    $id_unidade = $_POST['id_unidade'];

    try{
        $stmt = $pdo->prepare("UPDATE unidade SET complemento = ?, numero = ? WHERE id_unidade = ?");
        
        if($stmt->execute([$complemento, $numero, $id_unidade])){
            header('location: unidades.php?editar=true');
        }else{
            header('location: unidades.php?editar=false');
        }
    }catch(\Exception $e){
            echo "Erro: ".$e->getMessage(); 
    }
}
?>

<div class="container mt-3">
    <h1>Editar Unidade</h1>
    <form method="post">
        <input type="hidden" name='id_unidade' value='<?= $unidade['id_unidade'] ?? '' ?>'>

        <div class="mb-3">
            <label for="complemento" class="form-label">Endereço (Rua/Bloco):</label>
            <input value='<?= htmlspecialchars($unidade['complemento'] ?? '') ?>' type="text" id="complemento" name="complemento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Número (Casa/Apto):</label>
            <input value='<?= htmlspecialchars($unidade['numero'] ?? '') ?>' type="number" id="numero" name="numero" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="unidades.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
require("rodape.php")
?>