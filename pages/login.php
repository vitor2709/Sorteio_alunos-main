<?php
session_start();
$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}

$mensagem_sucesso = '';
if (isset($_GET['success']) && $_GET['success'] == '1') {
    $mensagem_sucesso = 'Cadastro realizado com sucesso! Faça seu login.';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../css/styleLogin.css" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Sorteador de alunos</title>
</head>

<body>
    <div class="center">
        <div class="right">
            <div class="form">
                <?php if (!empty($mensagem_sucesso)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Sucesso!</strong> <?php echo $mensagem_sucesso; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <h1>Login</h1>
                <form action="../backend/loginAutenticar.php" method="POST">
                    <div class="input-box">
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" placeholder="Seu e-mail" name="email" required />
                    </div>
                    <div class="input-box">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" placeholder="Senha" name="senha" required />
                    </div>
                    <button type='submit' class="btn-form">Login</button>
                    <div class="form-link">
                        Não tem uma conta? <a href="cadastro.php">Cadastrar</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="left">
            <img src="../img/logosesc.webp" alt="Logo Sesc" class="logo-sesc" />
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>