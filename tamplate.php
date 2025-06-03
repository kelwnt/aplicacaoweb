<?php
// Início da sessão
session_start();
require_once 'php_action/db_connect.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['LOGADO'])) {
    header('Location: logout.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
         body {
            padding-top: 60px;
            background: linear-gradient(to right,rgb(62, 160, 230),rgb(207, 74, 74));
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        iframe {
            border: none;
            width: 100%;
            height: calc(100vh - 50px);
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand i {
            font-size: 1.5rem;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-text {
            font-weight: 500;
        }

        .btn-outline-light {
            transition: 0.3s;
        }

        .btn-outline-light:hover {
            background-color:rgb(42, 135, 223);
            color: #0d6efd;
        }

        .dropdown:hover > .dropdown-menu {
            display: block;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu {
            margin-top: 0;
            border-radius: 0 0 0.5rem 0.5rem;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="centro.php" target="iframe_a"><i class="bi bi-house-door-fill"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <!-- Dropdown: Cadastros -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">Cadastros</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="z_Cliente/cliente.php" target="iframe_a"><i class="fas fa-users"></i> Clientes</a></li>
                            <li><a class="dropdown-item" href="z_Tipo_Atendimento/tipo_atendimento.php" target="iframe_a"><i class="fas fa-folder"></i> Tipo Atendimento</a></li>
                            <?php if ($_SESSION['tipo_acesso'] === 'A'): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="z_Atendente/atendente.php" target="iframe_a"><i class="bi bi-person"></i> Atendentes</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <!-- Dropdown: Atendimentos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">Atendimentos</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="z_Atendimento/atendimento.php" target="iframe_a"><i class="fas fa-plus-circle"></i> Novo Atendimento</a></li>
                            <li><a class="dropdown-item" href="z_Atendimento_encerrado/atendimento_encerrado.php" target="iframe_a"><i class="bi bi-dash-square-fill"></i> Encerrados</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown: Relatórios -->
                    <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" role="button">Relatórios</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="z_Relatorios/relatorio_cliente.php" target="iframe_a"><i class="fas fa-list"></i> Clientes</a></li>
                            <li><a class="dropdown-item" href="z_Relatorios/relatorio_atendimento.php" target="iframe_a"><i class="fas fa-list"></i> Atendimentos</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown: Administrativo -->
                    <?php if ($_SESSION['tipo_acesso'] === 'A'): ?>
                        <li class="nav-item dropdown">
                            
                            <ul class="dropdown-menu">
                                
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Usuário e Logout -->
                <span class="navbar-text me-3 text-white">
                    Usuário: <?php echo $_SESSION['nome']; ?>
                </span>
                <a class="btn btn-outline-light btn-sm" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
        </div>
    </nav>

    <!-- Área principal com iframe -->
    <main class="container-fluid">
        <iframe src="centro.php" name="iframe_a"></iframe>
    </main>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>