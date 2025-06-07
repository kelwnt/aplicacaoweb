<?php

require_once 'login_validation.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - Sistema</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f5ffff, #f5ffff);
            color:rgb(0, 0, 0);
            height: 100vh;
        }

        .card {
            background-color: #0c81cd;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
        }

        .form-control {
            background-color: #aec7e4;
            color: #000000;
            border: none;
        }

        .form-control:focus {
            background-color: #aec7e4;
            color: #000000;
            box-shadow: none;
        }

        .input-group-text {
            background-color: #aec7e4;
            color: #000000;
            border: none;
        }

        .btn-login {
            background-color: #aec7e4;
            color: #000000;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #004184;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-4"><i class="fas fa-user-shield"></i>Bem-vindo ao Sistema de Atendimentos</h3>

                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="login" id="login" class="form-control" placeholder="Usuário">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                        </div>
                    </div>

                    <?php require_once 'alert.php'; ?>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="lembrar-me">
                            <label class="form-check-label" for="lembrar-me">Lembrar-me</label>
                        </div>
                        
                    </div>

                    <button type="submit" name="btn-entrar" class="btn btn-login w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
