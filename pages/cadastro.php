<?php
include_once('../assets/data.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha_original = $_POST['senha'];
        $senha_hash = password_hash($senha_original, PASSWORD_DEFAULT);
        try {
            $verifica_sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $conexao->prepare($verifica_sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado->num_rows > 0) {
                echo "Este e-mail já está cadastrado.";
            } else {
                $inserir_sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($inserir_sql);
                $stmt->bind_param("sss", $nome, $email, $senha_hash);
                
                if ($stmt->execute()) {
                    echo "Usuário cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar usuário.";
                }
            }
        } catch (Exception $e) {
            echo "Erro no servidor: " . $e->getMessage();
        }
    } else {
        echo "Preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styleCadastro.css" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <form action="cadastro.php" method="POST">
                    <div class="input-box">
                        <i class="bi bi-person-fill"></i>
                        <input type="text" name="nome" placeholder="Nome completo"
                            value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>"
                            required />
                    </div>
                    <div class="input-box">
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" name="email" placeholder="Seu e-mail"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                            required />
                    </div>
                    <div class="input-box">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" name="senha" placeholder="Senha segura" required />
                    </div>
                    <div id="validacao-senha" class="mt-3" style="display: none;"></div>
                    <button type="submit" class="btn-form">
                        <i class="bi bi-person-plus me-2"></i>Cadastrar
                    </button>
                    <div class="form-link">
                        Já tem uma conta? <a href="login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/validar.js"></script>


</body>

</html>