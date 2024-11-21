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

// Obter o ID do livro a ser excluído
$livro_id = $_GET['id'];

// Excluir o livro
$sql = 'DELETE FROM livros WHERE id = ?';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$livro_id]);
    $message = 'Livro excluído com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao excluir o livro: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
