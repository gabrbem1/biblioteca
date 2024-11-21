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

// Obter o ID do empréstimo a ser excluído
$emprestimo_id = $_GET['id'];

// Excluir o empréstimo
$sql = 'DELETE FROM emprestimos WHERE id = ?';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$emprestimo_id]);
    $message = 'Empréstimo excluído com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao excluir o empréstimo: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
