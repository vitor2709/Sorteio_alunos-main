<?php
include_once('../assets/data.php');

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conexao, $sql)) {
        header("Location: ../pages/login.php");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
} else {
    echo "Método de requisição inválido.";
}
?>
