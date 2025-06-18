<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validar_senha']) && isset($_POST['senha'])) {
    header('Content-Type: application/json');
    echo validarSenhaJSON($_POST['senha']);
    exit();
}
// Função para validar senha
function validarSenha($senha) {
        $validacao = [
        'comprimento' => [
            'valido' => strlen($senha) >= 8,
            'mensagem' => 'Pelo menos 8 caracteres',
            'status' => strlen($senha) >= 8 ? 'ok' : 'pendente'
        ],
        'maiuscula' => [
            'valido' => preg_match('/[A-Z]/', $senha),
            'mensagem' => 'Uma letra maiúscula (A-Z)',
            'status' => preg_match('/[A-Z]/', $senha) ? 'ok' : 'pendente'
        ],
        'minuscula' => [
            'valido' => preg_match('/[a-z]/', $senha),
            'mensagem' => 'Uma letra minúscula (a-z)',
            'status' => preg_match('/[a-z]/', $senha) ? 'ok' : 'pendente'
        ],
        'numero' => [
            'valido' => preg_match('/[0-9]/', $senha),
            'mensagem' => 'Um número (0-9)',
            'status' => preg_match('/[0-9]/', $senha) ? 'ok' : 'pendente'
        ],
        'especial' => [
            'valido' => preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $senha),
            'mensagem' => 'Um caractere especial (!@#$%...)',
            'status' => preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $senha) ? 'ok' : 'pendente'
        ]
    ];
    
    // Verificar se todos os critérios são válidos
    $todos_validos = true;
    $erros = [];
    
    foreach ($validacao as $criterio => $dados) {
        if (!$dados['valido']) {
            $todos_validos = false;
            $erros[] = $dados['mensagem'];
        }
    }
    
    return [
        'todos_validos' => $todos_validos,
        'criterios' => $validacao,
        'erros' => $erros
    ];
}

// Função para validar senha e retornar JSON (para AJAX)
function validarSenhaJSON($senha) {
    $resultado = validarSenha($senha);
    return json_encode($resultado);
}

// Função para validar email duplicado
function verificarEmailExistente($email, $conexao) {
    $email = mysqli_real_escape_string($conexao, $email);
    $sql_verificar = "SELECT COUNT(*) as total FROM usuarios WHERE email = '$email'";
    $resultado_verificar = mysqli_query($conexao, $sql_verificar);
    $row = mysqli_fetch_assoc($resultado_verificar);
    
    return $row['total'] > 0;
}

// Função para cadastrar usuário
function cadastrarUsuario($nome, $email, $senha, $conexao) {
    $nome = mysqli_real_escape_string($conexao, $nome);
    $email = mysqli_real_escape_string($conexao, $email);
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
    
    return mysqli_query($conexao, $sql);
}
?>
