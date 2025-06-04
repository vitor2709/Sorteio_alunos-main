<?php
session_start();
$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    
    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="../css/styleLogin.css" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    
    <title>Sorteador de alunos</title>
</head>

<body>
    <div class="center">
        <div class="right">
            <div class="form">
                
                <!-- Alerta acima do título Login -->
                <?php if (!empty($mensagem)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <?php echo htmlspecialchars($mensagem); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
