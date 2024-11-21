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

// Consultar usuários
$sql = 'SELECT * FROM usuarios';
$stmt = $pdo->query($sql);

// Exibir a tabela de usuários
echo "<h3>Relatório de Usuários Cadastrados</h3>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Data de Cadastro</th><th>Ações</th></tr></thead>";
echo "<tbody>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
    echo "<td>" . htmlspecialchars($row['data_cadastro']) . "</td>";
    // Botões de ação: Editar e Excluir
    echo "<td>
            <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editUsuarioModal' 
                data-id='" . $row['id'] . "' 
                data-nome='" . $row['nome'] . "' 
                data-email='" . $row['email'] . "' 
                data-telefone='" . $row['telefone'] . "'
                data-data-cadastro='" . $row['data_cadastro'] . "'>Editar</button>
            <a href='delete_usuario.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' 
                onclick='return confirm(\"Você tem certeza que deseja excluir este usuário?\");'>Excluir</a>
          </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>

<!-- Modal de Edição de Usuário -->
<div class="modal fade" id="editUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUsuarioModalLabel">Editar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="update_usuario.php" method="POST">
        <div class="modal-body">
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
          <!-- Campo não editável de Data de Cadastro -->
          <div class="form-group">
            <label for="data_cadastro">Data de Cadastro:</label>
            <input type="text" class="form-control" id="data_cadastro" name="data_cadastro" readonly>
          </div>
          <input type="hidden" name="id" id="usuario_id">
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
  // Preencher o modal com os dados do usuário
  $('#editUsuarioModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botão que abriu o modal
    var usuarioId = button.data('id');
    var nome = button.data('nome');
    var email = button.data('email');
    var telefone = button.data('telefone');
    var dataCadastro = button.data('data-cadastro');
    
    // Preencher os campos do formulário no modal
    var modal = $(this);
    modal.find('#usuario_id').val(usuarioId);
    modal.find('#nome').val(nome);
    modal.find('#email').val(email);
    modal.find('#telefone').val(telefone);
    modal.find('#data_cadastro').val(dataCadastro);
  });
</script>
