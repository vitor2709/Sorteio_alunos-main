<?php
$usuarioNome = "Samantha";
$usuarioEmail = "samantha@email.com";
$perfilNome = "Alexa Rawles";
$perfilEmail = "alexarawles@gmail.com";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylePerfil.css" />
    <style>
        .formulario input,
        .formulario select {
            background-color: #ffffff !important;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
        }

        .formulario input:focus,
        .formulario select:focus {
            background-color: #ffffff !important;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .formulario input::placeholder {
            color: #999;
            opacity: 1;
        }

        .campo-erro {
            border-color: #dc3545 !important;
        }

        .campo-sucesso {
            border-color: #28a745 !important;
        }
    </style>
</head>

<body>
    <div class="d-md-none bg-primary p-2 text-white d-flex justify-content-between align-items-center">
        <strong>Perfil</strong>
        <button class="btn btn-outline-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#menuMobile">☰</button>
    </div>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <aside class="sidebar d-none d-md-block col-md-3 col-lg-2">
                <div class="perfil">
                    <img src="../img/Profile.png" alt="Foto de perfil">
                    <div class="user-info">
                        <strong>Samantha</strong>
                        <p>samantha@email.com</p>
                    </div>
                </div>
                <nav class="menu">
                    <a href="perfil.php" class="active">Perfil</a>
                    <a href="formulario.php">Formulário</a>
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
                        <a href="perfil.php" class="active">Perfil</a>
                        <a href="formulario.php">Formulário</a>
                        <a href="ListaSorteio.php">Lista de Sorteados</a>
                        <a href="ListaEspera.php">Lista de Espera</a>
                        <a href="sorteio.php">Sorteio</a>
                    </nav>
                </div>
            </div>
            <main class="conteudo col-md-9 col-lg-10">
                <div class="alert alert-info alert-dismissible fade show" role="alert" id="mensagemPerfil">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Bem-vindo(a)!</strong> Por favor, preencha todas as informações do seu perfil abaixo para completar o seu cadastro.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="topo-perfil">
                    <div class="usuario">
                        <img src="../img/Profile.png" alt="Alexa">
                        <div>
                            <h2>Samantha</h2>
                            <p>samantha@email.com</p>
                        </div>
                    </div>
                </div>

                <form class="formulario">
                    <div class="linha">
                        <div class="campo">
                            <label>Seu Nome Completo</label>
                            <input type="text" id="nome_completo" placeholder="Digite seu nome completo" />
                        </div>
                        <div class="campo">
                            <label>CPF</label>
                            <input type="text" id="cpf" placeholder="000.000.000-00" maxlength="14" />
                        </div>
                    </div>
                    <div class="linha">
                        <div class="campo">
                            <label>Data de Nascimento</label>
                            <input type="text" id="data_nascimento" placeholder="DD/MM/AAAA" maxlength="10" />
                        </div>
                        <div class="campo">
                            <label>Telefone</label>
                            <input type="text" id="telefone" placeholder="(00) 00000-0000" maxlength="15" />
                        </div>
                    </div>
                    <div class="linha">
                        <div class="campo">
                            <label>Sexo</label>
                            <select id="sexo" class="form-select">
                                <option value="">Selecione...</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        <div class="campo">
                            <label>CEP</label>
                            <input type="text" id="cep" placeholder="00000-000" maxlength="9" />
                        </div>
                    </div>
                    <div class="linha">
                        <div class="campo">
                            <label>Rua</label>
                            <input type="text" id="rua" placeholder="Nome da rua, número" />
                        </div>
                        <div class="campo">
                            <label>Cidade</label>
                            <input type="text" id="cidade" placeholder="Nome da cidade" />
                        </div>
                    </div>
                    <div class="email-sec">
                        <label>Meu E-mail</label>
                        <div class="email-item">
                            <img src="../img/message.png" alt="ícone email">
                            <div>
                                <p>samantha@email.com</p>
                                <span>1 month ago</span>
                            </div>
                        </div>
                        <button class="btn-add" type="button">+ Add Email Address</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.addEventListener('load', function() {
            const mensagem = document.getElementById('mensagemPerfil');
            if (mensagem) {
                setTimeout(function() {
                    const alert = bootstrap.Alert.getOrCreateInstance(mensagem);
                    alert.close();
                }, 8000);
            }
        });


        function aplicarMascaraCEP(valor) {
            valor = valor.replace(/\D/g, ''); // Remove caracteres não numéricos
            valor = valor.replace(/^(\d{5})(\d)/, '$1-$2'); // Adiciona hífen
            return valor;
        }

        function aplicarMascaraCPF(valor) {
            valor = valor.replace(/\D/g, ''); // Remove caracteres não numéricos
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2'); // Primeiro ponto
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2'); // Segundo ponto
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Hífen
            return valor;
        }

        function aplicarMascaraTelefone(valor) {
            valor = valor.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (valor.length <= 10) {
                // Telefone fixo: (00) 0000-0000
                valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
                valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
            } else {
                // Celular: (00) 00000-0000
                valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
                valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
            }

            return valor;
        }

        function aplicarMascaraData(valor) {
            valor = valor.replace(/\D/g, ''); // Remove caracteres não numéricos
            valor = valor.replace(/(\d{2})(\d)/, '$1/$2'); // Primeira barra
            valor = valor.replace(/(\d{2})\/(\d{2})(\d)/, '$1/$2/$3'); // Segunda barra
            return valor;
        }

        // VALIDAÇÕES

        // Validar CPF
        function validarCPF(cpf) {
            cpf = cpf.replace(/\D/g, '');

            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
                return false;
            }

            // Validação do primeiro dígito
            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let resto = 11 - (soma % 11);
            let digito1 = resto < 2 ? 0 : resto;

            // Validação do segundo dígito
            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            resto = 11 - (soma % 11);
            let digito2 = resto < 2 ? 0 : resto;

            return digito1 === parseInt(cpf.charAt(9)) && digito2 === parseInt(cpf.charAt(10));
        }

        // Buscar endereço pelo CEP
        async function buscarEnderecoPorCEP(cep) {
            const cepLimpo = cep.replace(/\D/g, '');

            if (cepLimpo.length === 8) {
                try {
                    // Mostrar loading
                    const cidadeInput = document.getElementById('cidade');
                    const ruaInput = document.getElementById('rua');

                    cidadeInput.value = 'Buscando...';
                    ruaInput.value = 'Buscando...';

                    const response = await fetch(`https://viacep.com.br/ws/${cepLimpo}/json/`);
                    const dados = await response.json();

                    if (!dados.erro) {
                        // Preencher os campos
                        ruaInput.value = dados.logradouro || '';
                        cidadeInput.value = dados.localidade || '';

                        // Adicionar classe de sucesso
                        document.getElementById('cep').classList.remove('campo-erro');
                        document.getElementById('cep').classList.add('campo-sucesso');
                    } else {
                        // CEP não encontrado
                        ruaInput.value = '';
                        cidadeInput.value = '';
                        document.getElementById('cep').classList.add('campo-erro');
                        alert('CEP não encontrado!');
                    }
                } catch (error) {
                    console.error('Erro ao buscar CEP:', error);
                    document.getElementById('rua').value = '';
                    document.getElementById('cidade').value = '';
                    document.getElementById('cep').classList.add('campo-erro');
                    alert('Erro ao buscar CEP. Tente novamente.');
                }
            }
        }

        // Formatação de nome (primeira letra maiúscula)
        function formatarNome(valor) {
            return valor.toLowerCase().replace(/\b\w/g, function(letra) {
                return letra.toUpperCase();
            });
        }

        // APLICAR EVENTOS AOS CAMPOS
        document.addEventListener('DOMContentLoaded', function() {

                    // Campo CEP
                    const cepInput = document.getElementById('cep');
                    cepInput.addEventListener('input', function(e) {
                        this.value = aplicarMascaraCEP(this.value);
                    });
                    cepInput.addEventListener('blur', function() {
                        if (this.value.length === 9) {
                            buscarEnderecoPorCEP(this.value);
                        }
                    });
                    // Permitir apenas números
                    cepInput.addEventListener('keypress', function(e) {
                        if (!/[0-9]/.test(String.fromCharCode(e.which))) {
                            e.preventDefault();
                        }
                    });

                    // Campo CPF
                    const cpfInput = document.getElementById('cpf');
                    cpfInput.addEventListener('input', function(e) {
                        this.value = aplicarMascaraCPF(this.value);
                    });
                    cpfInput.