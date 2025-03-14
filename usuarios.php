<?php
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

    // Executa uma consulta SQL para buscar todos os usuários e suas informações relacionadas
    // A consulta usa JOIN para unir as tabelas 'tb_usuario' e 'tb_pessoa' usando o 'id_pessoa'
    $stmt = $banco->query('SELECT * FROM tb_usuario JOIN tb_pessoa ON tb_usuario.id_pessoa = tb_pessoa.id');

    // Pega todos os resultados da consulta e armazena na variável $usuarios
    $usuarios = $stmt->fetchAll();
} catch (PDOException $e) {
    // Se ocorrer algum erro na conexão, exibe a mensagem de erro
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

    <style>
        body {
            background-color: #0e0e0e; /* Cor de fundo preta */
            color: #f2f2f2; /* Cor do texto branca */
            padding: 20px; /* Espaço interno ao redor do conteúdo */
        }
        table {
            width: 100%; /* Largura total da tabela */
            border-collapse: collapse; /* Remove espaços entre as células da tabela */
        }
        th, td {
            padding: 10px; /* Espaço interno nas células da tabela */
            border: 1px solid #f2f2f2; /* Borda das células */
        }
    </style>
</head>

<body>
    <!-- Corpo da página (o que aparece na tela) -->
    <h1>Lista de Usuários</h1>
    <!-- Título da página -->

    <!-- Tabela para exibir a lista de usuários -->
    <table>
        <tr>
            <th>ID</th> <!-- Cabeçalho da coluna ID -->
            <th>Nome</th> <!-- Cabeçalho da coluna Nome -->
            <th>Usuário</th> <!-- Cabeçalho da coluna Usuário -->
            <th>Ações</th> <!-- Cabeçalho da coluna Ações -->
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <!-- Loop para exibir cada usuário na tabela -->
        <tr>
            <td><?php echo $usuario['id']; ?></td> <!-- Exibe o ID do usuário -->
            <td><?php echo $usuario['nome']; ?></td> <!-- Exibe o nome do usuário -->
            <td><?php echo $usuario['usuario']; ?></td> <!-- Exibe o nome de usuário -->
            <td>
                <!-- Links para ações (Abrir, Editar, Excluir) -->
                <a href="detalhes_usuario.php?id=<?php echo $usuario['id']; ?>">Abrir</a> <!-- Link para ver detalhes do usuário -->
                <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>">Editar</a> <!-- Link para editar o usuário -->
                <a href="excluir_usuario.php?id=<?php echo $usuario['id']; ?>">Excluir</a> <!-- Link para excluir o usuário -->
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- Fim do loop -->
    </table>
</body>
</html>