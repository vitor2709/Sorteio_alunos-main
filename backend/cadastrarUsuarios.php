<?php
session_start();
include_once('../assets/data.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

if (mysqli_query($conexao, $sql)) {
    echo "Usuário cadastrado com sucesso!";
    header("Location: ../pages/login.php");
} else {
    echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
}

mysqli_close($conexao);

$conn = new mysqli("localhost", "usuario", "senha", "banco");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nome = $_POST["nome"];
$email = $_POST['email'];
$senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

$sql = "INSERT INTO nomes (nome, senha) VALUES ('$nome', '$emial', '$senha')";
$conn->query($sql);
echo "Cadastro realizado com sucesso!";
}



?>

