<?php
session_start();
include_once('../assets/data.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $stmt = mysqli_prepare($conexao, "SELECT * FROM usuarios WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($senha, $row['senha'])) {
        $_SESSION['id'] = $row['id_usuarios'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['mensagem'] = 'Login bem sucedido.';
        header('Location: ../pages/formulario.php');
        exit();
    } else {
        $_SESSION['mensagem'] = 'Usuário ou senha inválidos.';
        header('Location: ../pages/login.php');
        exit();
    }
} else {
    $_SESSION['mensagem'] = 'Preencha todos os campos.';
    header('Location: ../pages/login.php');
    exit();
}

mysqli_close($conexao);
?>
