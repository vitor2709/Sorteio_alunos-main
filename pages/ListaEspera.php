<?php
$usuarioNome = "Samantha";
$usuarioEmail = "samantha@email.com";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Espera</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleEspera.css" />
</head>

<body>
    <div class="d-md-none bg-primary p-2 text-white d-flex justify-content-between align-items-center">
        <strong>Lista de Espera</strong>
        <button class="btn btn-outline-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#menuMobile">☰</button>
    </div>
    <div class="container-fluid">
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
                    <a href="formulario.php">Formulário</a>
                    <a href="ListaSorteio.php">Lista de Sorteados</a>
                    <a href="ListaEspera.php" class="active">Lista de Espera</a>
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
                        <a href="formulario.php">Formulário</a>
                        <a href="ListaSorteio.php">Lista de Sorteados</a>
                        <a href="ListaEspera.php" class="active">Lista de Espera</a>
                        <a href="sorteio.php">Sorteio</a>
                    </nav>
                </div>
            </div>
            <main class="conteudo col-md-9 col-lg-10">
                <div class="header-message">
                    Infelizmente você não foi sorteado!
                </div>
                <div class="winners-list-section">
                    <h2>Lista de Sorteados</h2>
                
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>