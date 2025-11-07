<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      /* Mantém o mesmo fundo do login */
    }
  </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
  <div class="d-flex flex-column align-items-center">
    <div class="text-center mb-4">
      <img src="condcontrol_logo.png" alt="CondControl Logo" class="img-fluid" style="max-width: 250px;">
    </div>
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Cadastro de Usuário</h2>
        <form method="POST">
          <div class="mb-3">
            <label for="nomeCadastro" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nomeCadastro" name="nome" placeholder="Digite seu nome completo" required />
          </div>
          <div class="mb-3">
            <label for="emailCadastro" class="form-label">Email</label>
            <input type="email" class="form-control" id="emailCadastro" name="email" placeholder="Digite seu email" required />
          </div>
          <div class="mb-3">
            <label for="senhaCadastro" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senhaCadastro" name="senha" placeholder="Digite uma senha" required />
          </div>
          <button type="submit" class="btn btn-success w-100 mt-2">Cadastrar</button>
        </form>
        <p class="mt-3 text-center">
          Já tem uma conta?
          <a href="index.php">Então faça login</a>
        </p>
      </div>
    </div>
    <?php
    // Bloco PHP de lógica (Manter o seu código original aqui)
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      require("conexao.php");
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
      try {
        $stmt = $pdo->prepare("INSERT INTO USUARIO (nome, email, senha) VALUES (? , ? , ?)");
        if ($stmt->execute([$nome, $email, $senha])) {
          header("location: index.php?cadastro=true");
        } else {
          header("location: index.php?cadastro=false");
        }
      } catch (Exception $e) {
        echo "Erro ao executar o comando SQL: " . $e->getMessage();
      }
    }
    ?>
</body>
</html>