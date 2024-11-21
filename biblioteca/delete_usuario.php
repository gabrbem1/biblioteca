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

// Obter o ID do usuário a ser excluído
$usuario_id = $_GET['id'];

// Excluir o usuário
$sql = 'DELETE FROM usuarios WHERE id = ?';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$usuario_id]);
    $message = 'Usuário excluído com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao excluir o usuário: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
