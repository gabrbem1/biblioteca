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

// Obter dados do formulário
$emprestimo_id = $_POST['id'];
$livro_id = $_POST['livro_id'];
$usuario_id = $_POST['usuario_id'];
$data_emprestimo = $_POST['data_emprestimo'];
$data_devolucao = $_POST['data_devolucao'];  // Se for necessário

// Atualizar dados no banco
$sql = 'UPDATE emprestimos SET livro_id = ?, usuario_id = ?, data_emprestimo = ?, data_devolucao = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$livro_id, $usuario_id, $data_emprestimo, $data_devolucao, $emprestimo_id]);
    $message = 'Empréstimo atualizado com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao atualizar o empréstimo: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
