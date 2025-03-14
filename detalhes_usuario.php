<?php
// Pega o valor do parâmetro 'id' da URL (usando o método GET)
$id = $_GET['id'];

// Configura a conexão com o banco de dados MySQL
$dsn = 'mysql:dbname=db_login;host=127.0.0.1';

// Usuário do banco de dados (no caso, 'root')
$user = 'root';

// Senha do banco de dados (vazia no exemplo)
$password = '';

// Tenta conectar ao banco de dados
try {
    // Cria uma nova conexão com o banco de dados usando PDO
    $banco = new PDO($dsn, $user, $password);

    // Prepara uma consulta SQL para buscar informações do usuário e da pessoa associada
    // A consulta usa JOIN para unir as tabelas 'tb_usuario' e 'tb_pessoa' usando o 'id_pessoa'
    $stmt = $banco->prepare('SELECT * FROM tb_usuario JOIN tb_pessoa ON tb_usuario.id_pessoa = tb_pessoa.id WHERE tb_usuario.id = :id');

    // Executa a consulta, substituindo o placeholder ':id' pelo valor da variável $id
    $stmt->execute(['id' => $id]);

    // Pega o resultado da consulta (se houver)
    $usuario = $stmt->fetch();
} catch (PDOException $e) {
    // Se ocorrer algum erro na conexão com o banco de dados, exibe a mensagem de erro
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
            /* Cor de fundo preta */
            color: #f2f2f2;
            /* Cor do texto branca */
            padding: 20px;
            /* Espaço interno ao redor do conteúdo */
        }
    </style>
</head>

<body>
    <!-- Corpo da página (o que aparece na tela) -->
    <h1>Detalhes do Usuário</h1>
    <!-- Título da página -->

    <?php if ($usuario): ?>
        <!-- Se o usuário for encontrado no banco de dados, exibe os detalhes -->
        <p>ID: <?php echo $usuario['id']; ?></p>
        <!-- Exibe o ID do usuário -->
        <p>Nome: <?php echo $usuario['nome']; ?></p>
        <!-- Exibe o nome do usuário -->
        <p>Ano de Nascimento: <?php echo $usuario['ano_nascimento']; ?></p>
        <!-- Exibe o ano de nascimento do usuário -->
        <p>CPF: <?php echo $usuario['cpf']; ?></p>
        <!-- Exibe o CPF do usuário -->
        <p>Telefone 1: <?php echo $usuario['telefone_1']; ?></p>
        <!-- Exibe o primeiro telefone do usuário -->
        <p>Telefone 2: <?php echo $usuario['telefone_2']; ?></p>
        <!-- Exibe o segundo telefone do usuário (se existir) -->
        <p>Logradouro: <?php echo $usuario['logradouro']; ?></p>
        <!-- Exibe o logradouro do endereço do usuário -->
        <p>Número da Casa: <?php echo $usuario['n_casa']; ?></p>
        <!-- Exibe o número da casa do usuário -->
        <p>Bairro: <?php echo $usuario['bairro']; ?></p>
        <!-- Exibe o bairro do usuário -->
        <p>Cidade: <?php echo $usuario['cidade']; ?></p>
        <!-- Exibe a cidade do usuário -->
        <p>Usuário: <?php echo $usuario['usuario']; ?></p>
        <!-- Exibe o nome de usuário -->
    <?php else: ?>
        <!-- Se o usuário não for encontrado, exibe uma mensagem de erro -->
        <p>Usuário não encontrado.</p>
    <?php endif; ?>

    <!-- Link para voltar à página de usuários -->
    <a href="usuarios.php">Voltar</a>
</body>

</html>