<?php
include_once '../assets/data.php';

$mensagem = "";

// Debug: verificar se está recebendo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "POST recebido<br>";
    
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    // Debug: mostrar dados recebidos
    echo "Nome: " . $nome . "<br>";
    echo "Email: " . $email . "<br>";
    
    // Verificar se os campos não estão vazios
    if (empty($email) || empty($nome) || empty($senha)) {
        $mensagem = "Todos os campos são obrigatórios";
        echo $mensagem . "<br>";
    } else {
        // Verificar se o email já existe no banco de dados
        $sql_verificar = "SELECT COUNT(*) as total FROM usuarios WHERE email = ?";
        
        if ($stmt_verificar = $conexao->prepare($sql_verificar)) {
            $stmt_verificar->bind_param("s", $email);
            $stmt_verificar->execute();
            $resultado = $stmt_verificar->get_result();
            $row = $resultado->fetch_assoc();
            
            echo "Total encontrado: " . $row['total'] . "<br>";
            
            if ($row['total'] > 0) {
                $mensagem = "Email já cadastrado";
                echo $mensagem . "<br>";
            } else {
                // Se o email não existe, proceder com o cadastro
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                $sql_inserir = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                
                if ($stmt_inserir = $conexao->prepare($sql_inserir)) {
                    $stmt_inserir->bind_param("sss", $nome, $email, $senha_hash);
                    
                    if ($stmt_inserir->execute()) {
                        $mensagem = "Usuário cadastrado com sucesso";
                        echo $mensagem . "<br>";
                    } else {
                        $mensagem = "Erro ao cadastrar usuário: " . $conexao->error;
                        echo $mensagem . "<br>";
                    }
                    
                    $stmt_inserir->close();
                } else {
                    $mensagem = "Erro na preparação da query de inserção: " . $conexao->error;
                    echo $mensagem . "<br>";
                }
            }
            
            $stmt_verificar->close();
        } else {
            $mensagem = "Erro na preparação da query de verificação: " . $conexao->error;
            echo $mensagem . "<br>";
        }
    }
} else {
    echo "Nenhum POST recebido<br>";
}

echo "Mensagem final: " . $mensagem . "<br>";

?>
