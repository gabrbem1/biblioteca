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
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$data_cadastro = $_POST['data_cadastro'];

// Inserir dados no banco
$sql = 'INSERT INTO usuarios (nome, email, telefone, data_cadastro) VALUES (?, ?, ?, ?)';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$nome, $email, $telefone, $data_cadastro]);
    $message = 'Usuário cadastrado com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao cadastrar o usuário: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
