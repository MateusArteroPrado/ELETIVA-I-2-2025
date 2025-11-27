<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Acesso ao Sistema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
  </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
  <div class="d-flex flex-column align-items-center">

    <div class="text-center mb-4">
      <img src="condcontrol_logo.png" alt="CondControl Logo" class="img-fluid" style="max-width: 250px;">
    </div>

    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
      <div class="card-body">
        <?php
        if (isset($_GET['cadastro'])) {
          $cadastro = $_GET['cadastro'];
          if ($cadastro == 'true') {
            echo "<p class='text-success text-center'>Cadastro realizado com sucesso! Faça login abaixo.</p>";
          } else {
            echo "<p class='text-danger text-center'>Erro ao realizar o cadastro!</p>";
          }
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          require('conexao.php');
          $email = $_POST['email'];
          $senha = $_POST['senha'];
          try {
            $stmt = $pdo->prepare("SELECT * FROM usuario where email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(pdo::FETCH_ASSOC);
            if ($usuario && password_verify($senha, $usuario['senha'])) {
              session_start();
              $_SESSION['acesso'] = true;
              $_SESSION['nome'] = $usuario['nome'];
              header('location: principal.php');
            } else {
              echo "<p class='text-danger text-center'>Credenciais inválidas</p>";
            }
          } catch (\Exception $e) {
            echo "Erro: " . $e->getMessage();
          }
        }
        ?>
        <h2 class="card-title text-center mb-4 mt-2">Acesso ao Sistema</h2>
        <form action="index.php" method="POST">
          <div class="mb-3">
            <label for="emailLogin" class="form-label">Email</label>
            <input type="email" class="form-control" id="emailLogin" name="email" placeholder="Digite seu email" required />
          </div>
          <div class="mb-3">
            <label for="senhaLogin" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senhaLogin" name="senha" placeholder="Digite sua senha" required />
          </div>
          <button type="submit" class="btn btn-primary w-100 mt-2">Entrar</button>
        </form>
        <p class="mt-3 text-center">
          Ainda não tem uma conta?
          <a href="cadastro.php">Cadastre-se aqui!</a>
        </p>
      </div>
    </div>
  </div>
</body>

</html>