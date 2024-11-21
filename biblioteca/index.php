<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Biblioteca</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <style>
      .tab-content {
         margin-top: 20px;
      }
   </style>
</head>

<body>
   <div class="container mt-4">
      <h2>Gerenciamento de Biblioteca</h2>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <!-- Abas dos Formulários -->
         <li class="nav-item">
            <a class="nav-link active" id="formulario-livro-tab" data-toggle="tab" href="#formulario-livro" role="tab"
               aria-controls="formulario-livro" aria-selected="true">Cadastrar Livro</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="formulario-emprestimo-tab" data-toggle="tab" href="#formulario-emprestimo"
               role="tab" aria-controls="formulario-emprestimo" aria-selected="false">Cadastrar Empréstimo</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="formulario-usuario-tab" data-toggle="tab" href="#formulario-usuario" role="tab"
               aria-controls="formulario-usuario" aria-selected="false">Cadastrar Usuário</a>
         </li>

         <!-- Abas dos Relatórios -->
         <li class="nav-item">
            <a class="nav-link" id="relatorio-livros-tab" data-toggle="tab" href="#relatorio-livros" role="tab"
               aria-controls="relatorio-livros" aria-selected="false">Relatório de Livros</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="relatorio-emprestimos-tab" data-toggle="tab" href="#relatorio-emprestimos"
               role="tab" aria-controls="relatorio-emprestimos" aria-selected="false">Relatório de Empréstimos</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="relatorio-usuarios-tab" data-toggle="tab" href="#relatorio-usuarios" role="tab"
               aria-controls="relatorio-usuarios" aria-selected="false">Relatório de Usuários</a>
         </li>
      </ul>
      <div class="tab-content mt-4" id="myTabContent">
         <!-- Aba Cadastrar Livro -->
         <div class="tab-pane fade show active" id="formulario-livro" role="tabpanel"
            aria-labelledby="formulario-livro-tab">
            <h3>Cadastrar Livro</h3>
            <form id="form-cadastrar-livro" action="processar_cadastro_livro.php" method="post">
               <div class="form-group">
                  <label for="titulo">Título:</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" required>
               </div>
               <div class="form-group">
                  <label for="autor">Autor:</label>
                  <input type="text" class="form-control" id="autor" name="autor" required>
               </div>
               <div class="form-group">
                  <label for="categoria">Categoria:</label>
                  <input type="text" class="form-control" id="categoria" name="categoria" required>
               </div>
               <div class="form-group">
                  <label for="data_publicacao">Data de Publicação:</label>
                  <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" required>
               </div>
               <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
            <div id="resultado-cadastro-livro" class="mt-3"></div>
         </div>

         <!-- Aba Cadastrar Empréstimo -->
         <div class="tab-pane fade" id="formulario-emprestimo" role="tabpanel"
            aria-labelledby="formulario-emprestimo-tab">
            <h3>Cadastrar Empréstimo</h3>
            <form id="form-cadastrar-emprestimo" action="processar_cadastro_emprestimo.php" method="post">
               <div class="form-group">
                  <label for="livro_id">ID do Livro:</label>
                  <input type="number" class="form-control" id="livro_id" name="livro_id" required>
               </div>
               <div class="form-group">
                  <label for="usuario_id">ID do Usuário:</label>
                  <input type="number" class="form-control" id="usuario_id" name="usuario_id" required>
               </div>
               <div class="form-group">
                  <label for="data_emprestimo">Data de Empréstimo:</label>
                  <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" required>
               </div>
               <button type="submit" class="btn btn-primary">Cadastrar Empréstimo</button>
            </form>
            <div id="resultado-cadastro-emprestimo" class="mt-3"></div>
         </div>

         <!-- Aba Cadastrar Usuário -->
         <div class="tab-pane fade" id="formulario-usuario" role="tabpanel" aria-labelledby="formulario-usuario-tab">
            <h3>Cadastrar Usuário</h3>
            <form id="form-cadastrar-usuario" action="processar_cadastro_usuario.php" method="post">
               <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" class="form-control" id="nome" name="nome" required>
               </div>
               <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" required>
               </div>
               <div class="form-group">
                  <label for="telefone">Telefone:</label>
                  <input type="text" class="form-control" id="telefone" name="telefone" required>
               </div>
               <div class="form-group">
                  <label for="data_cadastro">Data de Cadastro:</label>
                  <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" required>
               </div>
               <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
            </form>
            <div id="resultado-cadastro-usuario" class="mt-3"></div>
         </div>

         <!-- Relatório de Livros Disponíveis -->
         <div class="tab-pane fade" id="relatorio-livros" role="tabpanel" aria-labelledby="relatorio-livros-tab">
            <?php include 'relatorio_livros_disponiveis.php'; ?>
         </div>

         <!-- Relatório de Livros Emprestados -->
         <div class="tab-pane fade" id="relatorio-emprestimos" role="tabpanel"
            aria-labelledby="relatorio-emprestimos-tab">
            <?php include 'relatorio_livros_emprestados.php'; ?>
         </div>

         <!-- Relatório de Usuários Cadastrados -->
         <div class="tab-pane fade" id="relatorio-usuarios" role="tabpanel" aria-labelledby="relatorio-usuarios-tab">
            <?php include 'relatorio_usuarios_cadastrados.php'; ?>
         </div>
      </div>
   </div>

   <!-- Scripts necessários para o funcionamento do Bootstrap e jQuery -->
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script>
      $(document).ready(function () {
         // Verificar se há mensagem na URL
         const urlParams = new URLSearchParams(window.location.search);
         const message = urlParams.get('message');

         if (message) {
            // Exibir alerta com a mensagem
            alert(decodeURIComponent(message));
         }
      });
   </script>
</body>

</html>