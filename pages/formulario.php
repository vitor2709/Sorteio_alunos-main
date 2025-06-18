<?php
// Incluir arquivo de conexão
include_once('../assets/data.php');

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




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulário</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleFormulario.css" />
</head>

<body>
    <div class="d-md-none bg-primary p-2 text-white d-flex justify-content-between align-items-center">
        <strong>Formulário</strong>
        <button class="btn btn-outline-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#menuMobile">☰</button>
    </div>
    <div class="container-fluid ">
        <div class="row flex-nowrap">
            <aside class="sidebar d-none d-md-block col-md-3 col-lg-2" style="height: 100vh;">
                <div class="perfil">
                    <img src="../img/Profile.png" alt="Foto de perfil">
                    <div class="user-info">
                        <strong>Samantha</strong>
                        <p>samantha@email.com</p>
                    </div>
                </div>
                <nav class="menu">
                    <a href="perfil.php">Perfil</a>
                    <a href="formulario.php" class="active">Formulário</a>
                    <a href="ListaSorteio.php">Lista de Sorteados</a>
                    <a href="ListaEspera.php">Lista de Espera</a>
                    <a href="sorteio.php">Sorteio</a>
                </nav>
            </aside>
            <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="menuMobile">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body sidebar">
                    <div class="perfil">
                        <img src="../img/Profile.png" alt="Foto de perfil">
                        <div class="user-info">
                            <strong>Samantha</strong>
                            <p>samantha@email.com</p>
                        </div>
                    </div>
                    <nav class="menu">
                        <a href="perfil.php">Perfil</a>
                        <a href="formulario.php" class="active">Formulário</a>
                        <a href="ListaSorteio.php">Lista de Sorteados</a>
                        <a href="ListaEspera.php">Lista de Espera</a>
                        <a href="sorteio.php">Sorteio</a>
                    </nav>
                </div>
            </div>
            <main class="conteudo col-md-9 col-lg-10">
                <form action="../backend/formularioAluno.php" method="POST" class="formulario-aluno">
                    <h2>Informações do aluno</h2>
                    <div class="linha">
                        <div class="campo">
                            <label for="nome-completo">Nome completo</label>
                            <input type="text" id="nome-completo" value="" name="nome_completo" placeholder="Nome Do Aluno">
                        </div>
                        <div class="campo">
                            <label for="data-nascimento">Data de nascimento</label>
                            <input type="text" id="data-nascimento" value="" name="data_nascimento" placeholder="DD/MM/AAAA" maxlength="10" >
                        </div>
                    </div>
                    <div class="linha">
                        <div class="campo">
                            <label for="sexo">Sexo</label>
                            <select id="sexo" name="sexo">
                                <option value="">Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="campo">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" value="" name="cpf" placeholder="000.000.000-00" maxlength="14">
                        </div>
                    </div>
                    <h2 class="enderecoResidencial">Endereço residencial</h2>
                    <div class="linha">
                        <div class="campo">
                            <label for="rua">Rua</label>
                            <input type="text" id="rua" value="" name="rua">
                        </div>
                        <div class="campo">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" value="" name="numero">
                        </div>
                    </div>
                    <div class="linha">
                        <div class="campo">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" value="" name="cidade">
                        </div>
                        <div class="campo">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado">
                                <option value="">Selecione</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-form">Enviar Formulário</button>
                </form>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Função para formatar CPF
        function formatarCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); // Remove tudo que não é dígito
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca ponto após o terceiro dígito
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca ponto após o sexto dígito
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Coloca hífen após o nono dígito
            return cpf;
        }

        // Função para formatar data
        function formatarData(data) {
            data = data.replace(/\D/g, ''); // Remove tudo que não é dígito
            data = data.replace(/(\d{2})(\d)/, '$1/$2'); // Coloca barra após o segundo dígito
            data = data.replace(/(\d{2})(\d)/, '$1/$2'); // Coloca barra após o quarto dígito
            return data;
        }

        // Aplicar formatação ao CPF
        document.getElementById('cpf').addEventListener('input', function(e) {
            e.target.value = formatarCPF(e.target.value);
        });

        // Aplicar formatação à data de nascimento
        document.getElementById('data-nascimento').addEventListener('input', function(e) {
            e.target.value = formatarData(e.target.value);
        });

        // Permitir apenas números no CPF
        document.getElementById('cpf').addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 0) {
                e.preventDefault();
            }
        });

        // Permitir apenas números na data
        document.getElementById('data-nascimento').addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 0) {
                e.preventDefault();
            }
        });

        // Validação básica do formulário
        document.querySelector('.formulario-aluno').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const cpf = document.getElementById('cpf').value;
            const nome = document.getElementById('nome-completo').value;
            const dataNascimento = document.getElementById('data-nascimento').value;
            
            if (!nome.trim()) {
                alert('Por favor, preencha o nome completo.');
                return;
            }
            
            if (cpf.length !== 14) {
                alert('Por favor, preencha o CPF completo.');
                return;
            }
            
            if (dataNascimento.length !== 10) {
                alert('Por favor, preencha a data de nascimento completa.');
                return;
            }
            
            alert('Formulário enviado com sucesso!');
            // Aqui você pode adicionar o código para enviar os dados para o backend
        });
    </script>
</body>

</html>
