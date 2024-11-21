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

// Consultar empréstimos
$sql = 'SELECT e.id, l.titulo, u.nome AS usuario, e.data_emprestimo
        FROM emprestimos e
        JOIN livros l ON e.livro_id = l.id
        JOIN usuarios u ON e.usuario_id = u.id
        WHERE e.data_devolucao IS NULL';
$stmt = $pdo->query($sql);

// Exibir a tabela de empréstimos
echo "<h3>Relatório de Livros Emprestados</h3>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>ID</th><th>Título do Livro</th><th>Usuário</th><th>Data de Empréstimo</th><th>Ações</th></tr></thead>";
echo "<tbody>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
    echo "<td>" . htmlspecialchars($row['usuario']) . "</td>";
    echo "<td>" . htmlspecialchars($row['data_emprestimo']) . "</td>";
    // Botões de ação: Editar e Excluir
    echo "<td>
            <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editEmprestimoModal' 
                data-id='" . $row['id'] . "' 
                data-titulo='" . $row['titulo'] . "' 
                data-usuario='" . $row['usuario'] . "' 
                data-data_emprestimo='" . $row['data_emprestimo'] . "'>Editar</button>
            <a href='delete_emprestimo.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' 
                onclick='return confirm(\"Você tem certeza que deseja excluir este empréstimo?\");'>Excluir</a>
          </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>

<!-- Modal Editar Empréstimo -->
<div class="modal fade" id="editEmprestimoModal" tabindex="-1" role="dialog" aria-labelledby="editEmprestimoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmprestimoModalLabel">Editar Empréstimo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editEmprestimoForm" action="update_emprestimo.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="livro">Livro</label>
            <input type="text" class="form-control" id="livro" name="livro" readonly>
          </div>
          <div class="form-group">
            <label for="usuario">Usuário</label>
            <input type="text" class="form-control" id="usuario" name="usuario" readonly>
          </div>
          <div class="form-group">
            <label for="data_emprestimo">Data de Empréstimo</label>
            <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" required>
          </div>
          <input type="hidden" name="id" id="emprestimo_id">
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
  // Preencher o modal com os dados do empréstimo
  $('#editEmprestimoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botão que abriu o modal
    var emprestimoId = button.data('id');
    var titulo = button.data('titulo');
    var usuario = button.data('usuario');
    var dataEmprestimo = button.data('data_emprestimo');
    
    // Preencher os campos do formulário no modal
    var modal = $(this);
    modal.find('#emprestimo_id').val(emprestimoId);
    modal.find('#livro').val(titulo);
    modal.find('#usuario').val(usuario);
    modal.find('#data_emprestimo').val(dataEmprestimo);
  });
</script>
