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
$usuario_id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// Atualizar dados no banco
$sql = 'UPDATE usuarios SET nome = ?, email = ?, telefone = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$nome, $email, $telefone, $usuario_id]);
    $message = 'Usuário atualizado com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao atualizar o usuário: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
