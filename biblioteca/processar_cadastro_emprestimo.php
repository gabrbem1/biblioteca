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
$livro_id = $_POST['livro_id'];
$usuario_id = $_POST['usuario_id'];
$data_emprestimo = $_POST['data_emprestimo'];

// Inserir dados no banco
$sql = 'INSERT INTO emprestimos (livro_id, usuario_id, data_emprestimo) VALUES (?, ?, ?)';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$livro_id, $usuario_id, $data_emprestimo]);
    $message = 'Empréstimo cadastrado com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao cadastrar o empréstimo: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
