<?php
$usuarioNome = "Samantha";
$usuarioEmail = "samantha@email.com";

$sorteado = null;

// Array of students in the waiting list (extracted from ListaEspera.php)
$listaEspera = [
    "Samantha",
    "Marcelo",
    "Ana",
    "Lara",
    "Julia",
    "Cassius",
    "Felipe",
    "Biel",
    "Gustavo"
];

$nomeSorteado = null;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sortear"])) {
    $de = isset($_POST["de"]) ? (int)$_POST["de"] : 50;
    $de = max(1, $de);
    $sorteado = rand(1, $de);

    // Get the student name from the waiting list if the number is within the list range
    if ($sorteado >= 1 && $sorteado <= count($listaEspera)) {
        $nomeSorteado = $listaEspera[$sorteado - 1];
    } else {
        $nomeSorteado = "Número fora da lista de espera";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sorteador de Alunos</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleSorteio.css" />
</head>

<body>
    <div class="d-md-none bg-primary p-2 text-white d-flex justify-content-between align-items-center">
        <strong>Sorteador de Alunos</strong>
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
                    <a href="ListaEspera.php">Lista de Espera</a>
                    <a href="sorteio.php" class="active">Sorteio</a>
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
                        <a href="ListaEspera.php">Lista de Espera</a>
                        <a href="sorteio.php" class="active">Sorteio</a>
                    </nav>
                </div>
            </div>
            <main class="conteudo col-md-9 col-lg-10">
                <div class="header">
                    <h1><strong>SORTEADOR</strong><br>DE ALUNOS</h1>
                    <img src="../img/logosesc.webp" alt="Logo Sesc" class="logo-sesc">
                </div>
                <p class="descricao">
                    Defina o intervalo e a quantidade de números, <br />
                    escolha um número que você deseje.
                </p>
                <div class="sorteio-box">
<h2 class="sortear">SORTEAR NÚMERO DO ALUNO:</h2>
<form method="POST">
    <div class="inputs">
        <div>
            <label>NÚMEROS</label>
            <input type="number" name="numero" value="1" min="1" readonly>
        </div>
        <div>
            <label>DE</label>
            <input type="number" name="de" value="50" min="1">
        </div>
    </div>
    <button type="submit" name="sortear" class="btn-sortear">Sortear</button>
</form>

<?php if ($sorteado !== null): ?>
    <div class="resultado-sorteio">
        <strong>Número sorteado:</strong> <span><?php echo $sorteado; ?></span><br>
        <strong>Aluno sorteado:</strong> <span><?php echo htmlspecialchars($nomeSorteado); ?></span>
    </div>
<?php endif; ?>

                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>