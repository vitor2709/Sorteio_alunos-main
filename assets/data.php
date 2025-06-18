<?php
// Configurações do banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "sorteio_main";

// Criar conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verificar conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Definir charset para UTF-8
mysqli_set_charset($conexao, "utf8");
?>
