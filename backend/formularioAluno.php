<?php
include_once('../assets/data.php');

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estado = $_POST['estado'];
    $nome_completo = $_POST['nome_completo'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $cpf = $_POST['cpf'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];

    var_dump($estado);
    die();

    $sql = "INSERT INTO alunos (nome_completo, estado, data_nascimento, sexo, cpf, rua, numero, cidade) VALUES ('$estado', '$nome_completo', '$data_nascimento', '$sexo', '$rua', '$numero', '$cidade', '$cpf')";

    if (mysqli_query($conexao, $sql)) {
        header("Location: ../pages/formulario.php");
        exit();
    } else {
        echo "Erro ao enviar formulário: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
} else {
    echo "Método de requisição inválido.";
}
?>


// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Receber e sanitizar os dados do formulário
    $nome = trim($_POST['nome']);
    $data_nascimento = trim($_POST['data_nascimento']);
    $sexo = trim($_POST['sexo']);
    $cpf = preg_replace('/\D/', '', $_POST['cpf']); // Remove formatação do CPF
    $rua = trim($_POST['rua']);
    $numero = trim($_POST['numero']);
    $cidade = trim($_POST['cidade']);
    $estado = trim($_POST['estado']);
    
    // Array para armazenar erros
    $erros = [];
    
    // Validações
    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    } elseif (strlen($nome) < 3) {
        $erros[] = "Nome deve ter pelo menos 3 caracteres";
    }
    
    if (empty($data_nascimento)) {
        $erros[] = "Data de nascimento é obrigatória";
    } else {
        // Validar formato da data DD/MM/AAAA
        if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $data_nascimento)) {
            $erros[] = "Data deve estar no formato DD/MM/AAAA";
        } else {
            // Verificar se a data é válida
            $data_parts = explode('/', $data_nascimento);
            if (!checkdate($data_parts[1], $data_parts[0], $data_parts[2])) {
                $erros[] = "Data de nascimento inválida";
            }
        }
    }
    
    if (empty($sexo)) {
        $erros[] = "Sexo é obrigatório";
    } elseif (!in_array($sexo, ['M', 'F'])) {
        $erros[] = "Sexo deve ser M ou F";
    }
    
    if (empty($cpf)) {
        $erros[] = "CPF é obrigatório";
    } elseif (strlen($cpf) !== 11) {
        $erros[] = "CPF deve ter 11 dígitos";
    } elseif (!validarCPF($cpf)) {
        $erros[] = "CPF inválido";
    }
    
    if (empty($rua)) {
        $erros[] = "Rua é obrigatória";
    }
    
    if (empty($cidade)) {
        $erros[] = "Cidade é obrigatória";
    }
    
    if (empty($estado)) {
        $erros[] = "Estado é obrigatório";
    }
    
    // Verificar se CPF já existe no banco
    if (empty($erros)) {
        $sql_verificar = "SELECT COUNT(*) as total FROM alunos WHERE cpf = ?";
        if ($stmt_verificar = $conexao->prepare($sql_verificar)) {
            $stmt_verificar->bind_param("s", $cpf);
            $stmt_verificar->execute();
            $resultado = $stmt_verificar->get_result();
            $row = $resultado->fetch_assoc();
            
            if ($row['total'] > 0) {
                $erros[] = "CPF já cadastrado no sistema";
            }
            $stmt_verificar->close();
        } else {
            $erros[] = "Erro ao verificar CPF no banco de dados";
        }
    }
    
    // Se não há erros, inserir no banco
    if (empty($erros)) {
        // Converter data para formato MySQL (YYYY-MM-DD)
        $data_parts = explode('/', $data_nascimento);
        $data_mysql = $data_parts[2] . '-' . $data_parts[1] . '-' . $data_parts[0];
        
        // Preparar query de inserção
        $sql_inserir = "INSERT INTO alunos (nome, data_nascimento, sexo, cpf, rua, numero, cidade, estado, data_cadastro, status_sorteio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'pendente')";
        
        if ($stmt_inserir = $conexao->prepare($sql_inserir)) {
            $stmt_inserir->bind_param("ssssssss", $nome, $data_mysql, $sexo, $cpf, $rua, $numero, $cidade, $estado);
            
            if ($stmt_inserir->execute()) {
                $id_aluno = $conexao->insert_id;
                
                // Redirecionar com mensagem de sucesso
                header("Location: ../pages/formulario.php?status=sucesso&id=" . $id_aluno);
                exit();
            } else {
                $erros[] = "Erro ao cadastrar aluno: " . $conexao->error;
            }
            
            $stmt_inserir->close();
        } else {
            $erros[] = "Erro na preparação da query: " . $conexao->error;
        }
    }
    
    // Se há erros, redirecionar com os erros
    if (!empty($erros)) {
        $mensagem_erro = implode("|", $erros);
        header("Location: ../pages/formulario.php?status=erro&mensagem=" . urlencode($mensagem_erro));
        exit();
    }
    
} else {
    // Se não foi enviado via POST, redirecionar
    header("Location: ../pages/formulario.php");
    exit();
}

// Função para validar CPF
function validarCPF($cpf) {
    // Elimina possível formatação
    $cpf = preg_replace('/\D/', '', $cpf);
    
    // Verifica se tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }
    
    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    // Calcula os dígitos verificadores
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    
    return true;
}

// Fechar conexão
if (isset($conexao)) {
    $conexao->close();
}
?>