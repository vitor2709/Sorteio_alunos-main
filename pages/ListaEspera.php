<?php
session_start();
require_once '../assets/data.php';

$stmt = mysqli_prepare($conexao, "SELECT * FROM usuarios");
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

echo $row['nome'];






?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styleEspera.css" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Lista de Sorteados</title>
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
                <a href="formulario.php">Formulário</a>
                <a href="ListaSorteio.php" >Lista de Sorteados</a>
                <a href="ListaEspera.php" class="active">Lista de Espera</a>
                <a href="sorteio.php">Sorteio</a>
            </nav>
        </aside>

        <main class="conteudo">
            <div class="header-message">
                Infelizmente você não foi sorteado!
            </div>

            <div class="winners-list-section">
                <h2>Lista de Sorteados</h2>
                <div class="winner-item">
                    <span>1º</span> Nome*usuario
                </div>
                <div class="winner-item">
                    <span>2º</span> Marcelo
                </div>
                <div class="winner-item">
                    <span>3º</span> Ana
                </div>
                <div class="winner-item">
                    <span>4º</span> Lara
                </div>
                <div class="winner-item">
                    <span>5º</span> Julia
                </div>
                <div class="winner-item">
                    <span>6º</span> Cassius
                </div>
                <div class="winner-item">
                    <span>7º</span> Felipe
                </div>
                <div class="winner-item">
                    <span>8º</span> Biel
                </div>
                <div class="winner-item">
                    <span>9º</span> Gustavo
                </div>
            </div>

            <div class="instructions">
                <strong>Infelizmente você não foi sorteado!</strong> Lista de espera da escola
                A escola sorteia 20 nomes para preencher as vagas. Quem não for sorteado entra automaticamente na lista
                de espera, em ordem do sorteio. Se algum dos 20 selecionados desistir ou não fizer a matrícula, a vaga é
                oferecida ao próximo da lista. Por isso, mesmo quem não for sorteado ainda pode ser chamado. Fique
                atento aos prazos!
            </div>
        </main>
    </div>
</body>

</html>