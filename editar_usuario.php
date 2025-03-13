<?php
// Conexão com o banco de dados
$dsn = 'mysql:dbname=db_login;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $banco = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit();
}

// Verifica se o ID do usuário foi passado na URL
if (!isset($_GET['id'])) {
    echo 'ID do usuário não fornecido.';
    exit();
}

$id = $_GET['id'];

// Busca os dados do usuário no banco de dados
$stmt = $banco->prepare('SELECT * FROM tb_usuario JOIN tb_pessoa ON tb_usuario.id_pessoa = tb_pessoa.id WHERE tb_usuario.id = :id');
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    echo 'Usuário não encontrado.';
    exit();
}

// Processamento do formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $senha = $_POST['senha'];
    $logradouro = $_POST['logradouro'];
    $n_casa = $_POST['n_casa'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $telefone_1 = $_POST['telefone_1'];
    $telefone_2 = $_POST['telefone_2'];

    try {
        // Atualiza a senha na tabela tb_usuario
        $stmtUsuario = $banco->prepare('UPDATE tb_usuario SET senha = :senha WHERE id = :id');
        $stmtUsuario->execute(['senha' => $senha, 'id' => $id]);

        // Atualiza os dados na tabela tb_pessoa
        $stmtPessoa = $banco->prepare('UPDATE tb_pessoa SET logradouro = :logradouro, n_casa = :n_casa, bairro = :bairro, cidade = :cidade, telefone_1 = :telefone_1, telefone_2 = :telefone_2 WHERE id = :id_pessoa');
        $stmtPessoa->execute([
            'logradouro' => $logradouro,
            'n_casa' => $n_casa,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'telefone_1' => $telefone_1,
            'telefone_2' => $telefone_2,
            'id_pessoa' => $usuario['id_pessoa']
        ]);

        // Redireciona para a lista de usuários após a atualização
        header('Location: usuarios.php');
        exit();
    } catch (PDOException $e) {
        echo 'Erro ao atualizar: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            background-color: #0e0e0e;
            color: #f2f2f2;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #333;
            color: #f2f2f2;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Editar Usuário</h1>
    <?php if ($usuario): ?>
        <form method="post">
            <label>Senha:</label>
            <input type="password" name="senha" value="<?php echo $usuario['senha']; ?>" required>

            <label>Logradouro:</label>
            <input type="text" name="logradouro" value="<?php echo $usuario['logradouro']; ?>" required>

            <label>Número da Casa:</label>
            <input type="text" name="n_casa" value="<?php echo $usuario['n_casa']; ?>" required>

            <label>Bairro:</label>
            <input type="text" name="bairro" value="<?php echo $usuario['bairro']; ?>" required>

            <label>Cidade:</label>
            <input type="text" name="cidade" value="<?php echo $usuario['cidade']; ?>" required>

            <label>Telefone 1:</label>
            <input type="text" name="telefone_1" value="<?php echo $usuario['telefone_1']; ?>" required>

            <label>Telefone 2:</label>
            <input type="text" name="telefone_2" value="<?php echo $usuario['telefone_2']; ?>">

            <input type="submit" value="Salvar Alterações">
        </form>
    <?php else: ?>
        <p>Usuário não encontrado.</p>
    <?php endif; ?>
    <br>
    <a href="usuarios.php">Voltar para a lista de usuários</a>
</body>
</html>