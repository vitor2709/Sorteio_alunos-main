<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styleFormulario.css" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Perfil</title>
</head>

<body>
    <div class="container"> 
        <aside class="sidebar">
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
        <main class="conteudo">
            <form class="formulario-aluno">
                <h2>Informações do aluno</h2>
                <div class="campo">
                    <label for="nome-completo">Nome completo</label>
                    <input type="text" id="nome-completo" value="Samantha">
                </div>
                <div class="campo">
                    <label for="data-nascimento">Data de nascimento</label>
                    <input type="text" id="data-nascimento" value="06/05/2019">
                </div>
                <div class="campo">
                    <label for="sexo">Sexo</label>
                    <select id="sexo">
                        <option value="feminino" selected>Feminino</option>
                        <option value="masculino">Masculino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" value="123.456.786-00">
                </div>
                <h2 class="enderecoResidencial">Endereço residencial</h2>
                <div class="campo rua">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" value="Rua das Flores">
                </div>
                <div class="campo numero">
                    <label for="numero">Número</label>
                    <input type="text" id="numero" value="123">
                </div>
                <div class="campo cidade">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" value="São Paulo">
                </div>
                <div class="campo estado">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" value="SP">
                </div>
                <a href="formulario2.php" class="btn-form">Enviar Formulario</a>
                <div class="form-link">
                </div>
            </form>
        </main>
    </div>
</body>

</html>