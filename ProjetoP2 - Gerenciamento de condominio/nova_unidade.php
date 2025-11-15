<?php
require("cabecalho.php");
require("conexao.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $complemento = $_POST['complemento'];
    $numero = $_POST['numero'];
    try{
        $stmt = $pdo->prepare("INSERT INTO unidade (complemento,numero) VALUES (?, ?)");
        if($stmt->execute([$complemento, $numero])){
            header('location: unidades.php?cadastro=true');
        }else{
            header('location: unidades.php?cadastro=false');
        }
    }catch(\Exception $e){
        // Tratar erro de duplicidade (se houver UNIQUE constraints) ou outros
        echo "Erro: ".$e->getMessage(); 
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Nova Unidade</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label for="complemento" class="form-label">Endereço (Rua/Bloco):</label>
                            <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Ex: Bloco A" required>
                        </div>
                        <div class="mb-3">
                            <label for="numero" class="form-label">Número (Casa/Apto):</label>
                            <input type="number" id="numero" name="numero" class="form-control" placeholder="Ex: 101" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Salvar Unidade</button>
                        <a href="unidades.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require("rodape.php")
?>