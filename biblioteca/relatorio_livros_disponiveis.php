<?php
// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'biblioteca';
$user = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexão falhou: ' . $e->getMessage();
    exit;
}

// Consultar os livros
$sql = 'SELECT * FROM livros';
$stmt = $pdo->query($sql);

// Exibir a tabela de livros
echo "<h3>Relatório de Livros</h3>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>ID</th><th>Título</th><th>Autor</th><th>Categoria</th><th>Data de Publicação</th><th>Ações</th></tr></thead>";
echo "<tbody>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
    echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
    echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
    echo "<td>" . htmlspecialchars($row['data_publicacao']) . "</td>";
    // Botões de ação: Editar e Excluir
    echo "<td>
            <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal' 
                data-id='" . $row['id'] . "' 
                data-titulo='" . $row['titulo'] . "' 
                data-autor='" . $row['autor'] . "' 
                data-categoria='" . $row['categoria'] . "' 
                data-data_publicacao='" . $row['data_publicacao'] . "'>Editar</button>
            <a href='delete_livro.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' 
                onclick='return confirm(\"Você tem certeza que deseja excluir este livro?\");'>Excluir</a>
          </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Livro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editForm" action="update_livro.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
          </div>
          <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" required>
          </div>
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
          </div>
          <div class="form-group">
            <label for="data_publicacao">Data de Publicação</label>
            <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" required>
          </div>
          <input type="hidden" name="id" id="livro_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts do Bootstrap e jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
  // Preencher o modal com os dados do livro
  $('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botão que abriu o modal
    var livroId = button.data('id');
    var titulo = button.data('titulo');
    var autor = button.data('autor');
    var categoria = button.data('categoria');
    var dataPublicacao = button.data('data_publicacao');
    
    // Preencher os campos do formulário no modal
    var modal = $(this);
    modal.find('#livro_id').val(livroId);
    modal.find('#titulo').val(titulo);
    modal.find('#autor').val(autor);
    modal.find('#categoria').val(categoria);
    modal.find('#data_publicacao').val(dataPublicacao);
  });
</script>
