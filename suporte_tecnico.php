<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suporte Técnico</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-dark text-white">Contato de Suporte Técnico</div>
          <div class="card-body">
            <form action="#" method="post">
              <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
              </div>
              <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
              </div>
              <button type="submit" class="btn btn-dark btn-block">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
