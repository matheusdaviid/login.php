<?php
// Pega o valor do parâmetro 'id' da URL (usando o método GET)
$id = $_GET['id'];

// Configura a conexão com o banco de dados MySQL
// 'dbname=db_login' é o nome do banco de dados
// 'host=127.0.0.1' é o endereço do servidor (local)
$dsn = 'mysql:dbname=db_login;host=127.0.0.1';

// Usuário do banco de dados (no caso, 'root')
$user = 'root';

// Senha do banco de dados (vazia no exemplo)
$password = '';

// Tenta conectar ao banco de dados
try {
    // Cria uma nova conexão com o banco de dados usando PDO
    $banco = new PDO($dsn, $user, $password);

    // Prepara uma consulta SQL para buscar o 'id_pessoa' associado ao usuário
    // Isso é necessário porque o usuário está relacionado a uma pessoa na tabela 'tb_pessoa'
    $stmt = $banco->prepare('SELECT id_pessoa FROM tb_usuario WHERE id = :id');
    $stmt->execute(['id' => $id]);

    // Pega o resultado da consulta (se houver)
    $usuario = $stmt->fetch();

    // Verifica se o usuário foi encontrado
    if ($usuario) {
        // Se o usuário existir, prepara e executa a exclusão na tabela 'tb_usuario'
        $stmtUsuario = $banco->prepare('DELETE FROM tb_usuario WHERE id = :id');
        $stmtUsuario->execute(['id' => $id]);

        // Prepara e executa a exclusão na tabela 'tb_pessoa' usando o 'id_pessoa' obtido anteriormente
        $stmtPessoa = $banco->prepare('DELETE FROM tb_pessoa WHERE id = :id_pessoa');
        $stmtPessoa->execute(['id_pessoa' => $usuario['id_pessoa']]);

        // Redireciona para a página 'usuarios.php' após a exclusão
        header('Location: usuarios.php');
    } else {
        // Se o usuário não for encontrado, exibe uma mensagem de erro
        echo 'Usuário não encontrado.';
    }
} catch (PDOException $e) {
    // Se ocorrer algum erro durante a execução, exibe a mensagem de erro
    echo 'Erro ao excluir: ' . $e->getMessage();
}
?>