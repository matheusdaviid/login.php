<?php
$id = $_GET['id'];

$dsn = 'mysql:dbname=db_login;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $banco = new PDO($dsn, $user, $password);
    $stmt = $banco->prepare('SELECT * FROM tb_usuario JOIN tb_pessoa ON tb_usuario.id_pessoa = tb_pessoa.id WHERE tb_usuario.id = :id');
    $stmt->execute(['id' => $id]);
    $usuario = $stmt->fetch();
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Usuário</title>
    <style>
        body {
            background-color: #0e0e0e;
            color: #f2f2f2;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Detalhes do Usuário</h1>
    <?php if ($usuario): ?>
        <p>ID: <?php echo $usuario['id']; ?></p>
        <p>Nome: <?php echo $usuario['nome']; ?></p>
        <p>Ano de Nascimento: <?php echo $usuario['ano_nascimento']; ?></p>
        <p>CPF: <?php echo $usuario['cpf']; ?></p>
        <p>Telefone 1: <?php echo $usuario['telefone_1']; ?></p>
        <p>Telefone 2: <?php echo $usuario['telefone_2']; ?></p>
        <p>Logradouro: <?php echo $usuario['logradouro']; ?></p>
        <p>Número da Casa: <?php echo $usuario['n_casa']; ?></p>
        <p>Bairro: <?php echo $usuario['bairro']; ?></p>
        <p>Cidade: <?php echo $usuario['cidade']; ?></p>
        <p>Usuário: <?php echo $usuario['usuario']; ?></p>
    <?php else: ?>
        <p>Usuário não encontrado.</p>
    <?php endif; ?>
    <a href="usuarios.php">Voltar</a>
</body>
</html>