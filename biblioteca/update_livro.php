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
$livro_id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria = $_POST['categoria'];
$data_publicacao = $_POST['data_publicacao'];

// Atualizar dados no banco
$sql = 'UPDATE livros SET titulo = ?, autor = ?, categoria = ?, data_publicacao = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$titulo, $autor, $categoria, $data_publicacao, $livro_id]);
    $message = 'Livro atualizado com sucesso!';
} catch (PDOException $e) {
    $message = 'Erro ao atualizar o livro: ' . $e->getMessage();
}

// Redirecionar com mensagem
header("Location: index.php?message=" . urlencode($message));
exit;
?>
