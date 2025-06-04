<?php

$usuarioNome = "Samantha";
$usuarioEmail = "samantha@email.com";
$perfilNome = "Alexa Rawles";
$perfilEmail = "alexarawles@gmail.com";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 bg-light p-3">
                <div class="text-center mb-4">
                    <img src="../img/Profile.png" class="rounded-circle mb-2" width="100" alt="Foto de perfil">
                    <h5><?= $usuarioNome ?></h5>
                    <p class="text-muted"><?= $usuarioEmail ?></p>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="perfil.php">Perfil</a>
                    <a class="nav-link" href="formulario.php">Formulário</a>
                    <a class="nav-link" href="ListaSorteio.php">Lista de Sorteados</a>
                    <a class="nav-link" href="ListaEspera.php">Lista de Espera</a>
                    <a class="nav-link" href="sorteio.php">Sorteio</a>
                </nav>
            </aside>

            <!-- Conteúdo principal -->
            <main class="col-md-9 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <img src="../img/Profile.png" class="rounded-circle me-3" width="80" alt="Alexa">
                        <div>
                            <h4><?= $perfilNome ?></h4>
                            <p class="text-muted mb-0"><?= $perfilEmail ?></p>
                        </div>
                    </div>
                    <button class="btn btn-primary">Editar</button>
                </div>

                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Seu Nome Completo</label>
                            <input type="text" class="form-control" value="Samantha Silva" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="text" class="form-control" value="27/09/1999" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Sexo</label>
                            <input type="text" class="form-control" value="Masculino" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CEP</label>
                            <input type="text" class="form-control" value="12345-678" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Rua</label>
                            <input type="text" class="form-control" value="Rua das Flores" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cidade</label>
                            <input type="text" class="form-control" value="São Paulo" disabled>
                        </div>
                    </div>

                    <!-- Email container -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <strong>Meu E-mail</strong>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Email Icon" width="40" class="me-3">
                            <div>
                                <p class="mb-0"><?= $perfilEmail ?></p>
                                <small class="text-muted">1 month ago</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-outline-primary btn-sm">+ Adicionar E-mail</a>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>
