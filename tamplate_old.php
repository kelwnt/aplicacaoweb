<?php
// Conexão com o banco


session_start();

//echo $_SESSION['nome'];
//echo $_SESSION['MENSAGEM'];
//echo $_SESSION['MENSAGEM'];
require_once 'php_action/db_connect.php';

//echo $_SESSION['tipo_acesso'];
// Sessão com as variaveis de ssao


// Verificação se há um usuário logado. Se não houver, redireciona para a página de logout, olhando para as variaveis de sessao
if (!isset ($_SESSION['LOGADO'])):
  header('location: logout.php');

endif;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RAtendimento</title>
  <!-- CSS do Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-... (hash do arquivo)" crossorigin="anonymous">
  <!-- Ícones do Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Chama um icone de uma biblioteca especifica.-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="centro.php" target="iframe_a"><i class="bi bi-house-fill display-6"></i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <!--dropdown de cadastros-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownCadastros" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
            <ul class="dropdown-menu " aria-labelledby="navbarDropdownCadastros">
              <li><a class="dropdown-item" href="index_bootstrap.php" target="iframe_a"><i
                    class="fas fa-sign-in-alt"></i> Joga pro Login item aleatório</a></li>
              <?php
              // Verifica se a variável de sessão 'tipo_acesso' está definida e é igual a 'A'
              if (isset ($_SESSION['tipo_acesso']) && $_SESSION['tipo_acesso'] === 'A') {
                ?>
                <li><a class="dropdown-item" href="z_Atendente/atendente.php" target="iframe_a"><i
                      class="bi bi-person"></i> Cadastro de Atendente</a></li>
                <?php
              }
              ?>
              <li><a class="dropdown-item" href="z_Cliente/cliente.php" target="iframe_a"><i class="fas fa-users"></i>
                  Cadastro de Cliente</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="z_Tipo_Atendimento/tipo_atendimento.php" target="iframe_a"><i
                    class="fas fa-folder"></i> Cadastro de Tipo de Atendimento</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownAtendimento" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">Atendimentos</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAtendimento">
              <li><a class="dropdown-item" href="z_Atendimento/atendimento.php" target="iframe_a"> <i
                    class="fas fa-plus-circle"></i> Cadastro de Atendimento</a></li>
              <li><a class="dropdown-item" href="z_Atendimento_encerrado/atendimento_encerrado.php" target="iframe_a"><i
                    class="bi bi-dash-square-fill"></i> Atendimentos Encerrados</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-life-ring"></i> Nada aqui</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="suporte_tecnico.php" target="iframe_a"><i
                    class="fas fa-info-circle"></i> Suporte Técnico</a></li>
            </ul>
          </li>0
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownRelatorios" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">Relatórios</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRelatorios">
              <li><a class="dropdown-item" href="z_Relatorios/relatorio_cliente.php" target="iframe_a"><i
                    class="fas fa-list"></i> Relatório de Clientes</a></li>
              <li><a class="dropdown-item" href="z_Relatorios/relatorio_atendente.php" target="iframe_a"><i
                    class="fas fa-list"></i> Relatório de Atendentes</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#"> <i class="fas fa-list"></i> Relatório de Suporte</a></li>
              <li><a class="dropdown-item" href="z_Relatorios/relatorio_atendimento.php" target="iframe_a"><i
                    class="fas fa-list"></i> Relatório de Atendimento</a></li>
            </ul>
          </li>
          <?php
          // Verifica se a variável de sessão 'tipo_acesso' está definida e é igual a 'A'
          if (isset ($_SESSION['tipo_acesso']) && $_SESSION['tipo_acesso'] === 'A') {
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownAdministrativo" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">Menu Administrativo</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdministrativo">
                <li><a class="dropdown-item" href="#" target="iframe_a"><i class="fas fa-list"></i> Menu Administrativo
                    1</a></li>
                <li><a class="dropdown-item" href="#" target="iframe_a"><i class="fas fa-list"></i> Menu Administrativo
                    2</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"> <i class="fas fa-list"></i> Menu Administrativo 3</a></li>
                <li><a class="dropdown-item" href="#" target="iframe_a"><i class="fas fa-list"></i> Menu Administrativo
                    4</a></li>
              </ul>
            </li>
            <?php
          }
          ?>


          <!-- desativado para exemplo-->
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Desativado</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://pt.wikipedia.org/wiki/Wikip%C3%A9dia:P%C3%A1gina_principal"
              target="iframe_a">Link Aleatório</a>
          </li>
        </ul>
        <div class="navbar-brand text-white text-sm " style="font-size: 14px;">
          <?php echo "Usuário: ";
          echo $_SESSION['nome']; ?>
        </div>
        <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-in-alt fa-2x"></i> <span
            class="sr-only">(página atual)</span></a>
      </div>
    </div>
  </nav>


  <!-- IFrame -->
  <div class="main">
    <iframe src="centro.php" name="iframe_a" height="900" width="100%" title="Iframe Example" allowfullscreen=""
      frameborder="0"></iframe>
  </div>

  <!-- Scripts do Bootstrap 5 (jQuery, Popper.js e Bootstrap JS) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-..."
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-..."
    crossorigin="anonymous"></script>

</body>

</html>