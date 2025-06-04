<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/styleCadastro.css" />
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <title>Sorteador de alunos</title>
</head>

<body>
  <div class="center">
    <div class="left">
      <img src="../img/logosesc.webp" alt="Logo do Sesc" class="logo-sesc" />
    </div>
    <div class="right">
      <div class="form">
        <h1>Cadastrar</h1>
        <form action="../pages/login.php" method="POST">
          <div class="input-box">
            <i class="bi bi-person-fill"></i><input type="text" name="nome" placeholder="Nome" required />
          </div>
          <div class="input-box">
            <i class="bi bi-envelope-fill"></i>
            <input type="email" name="email" placeholder="Seu e-mail" required />
          </div>
          <div class="input-box">
            <i class="bi bi-lock-fill"></i>
            <input type="password" name="senha" placeholder="Senha" required />
          </div>
          <button type="submit" class="btn-form">Cadastrar</button>
          <div class="form-link">
            Já tem uma conta? <a href="login.php">Entrar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>