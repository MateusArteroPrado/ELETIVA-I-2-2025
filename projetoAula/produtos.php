<?php 
require("cabecalho.php");
require("conexao.php");

try{
    $stmt = $pdo->query("SELECT c.nome, p.* FROM produto p INNER JOIN categoria c ON c.id = p.categoria_id");
    $dados = $stmt->fetchAll();
} catch(\Exception $e){
    echo "Erro: ".$e->getMessage();
}

if(isset($_GET['cadastro']) && $_GET['cadastro']){
    echo "<p class='text-success'>CADASTRO REALIZADO</p>";
} else if(isset($_GET['cadastro']) && !$_GET['cadastro']){
    echo "<p class='text-danger'>ERRO AO CADASTRAR</p>";
}
if(isset($_GET['editar']) && $_GET['editar']){
    echo "<p class='text-success'>CADASTRO EDITADO</p>";
} else if(isset($_GET['editar']) && !$_GET['editar']){
    echo "<p class='text-danger'>ERRO AO EDITAR</p>";
}
if(isset($_GET['excluir']) && $_GET['excluir']){
    echo "<p class='text-success'>CADASTRO EXCLUIDO</p>";
} else if(isset($_GET['excluir']) && !$_GET['excluir']){
    echo "<p class='text-danger'>ERRO AO EXCLUIR</p>";
}
?>


<h2>Produtos</h2>
<a href="novo_produto.php" class="btn btn-success mb-3">Novo Registro</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $d): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['descricao'] ?></td>
            <td><?= $d['nome'] ?></td>
            <td class="d-flex gap-2">
                <a href="editar_produto.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_produto.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>


<?php require("rodape.php") ?>