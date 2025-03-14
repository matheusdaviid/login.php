<?php
// Pega os dados enviados pelo formulário usando o método POST
$user = $_POST['user']; // Nome de usuário
$cpf = $_POST['cpf']; // CPF do usuário
$nova_senha = $_POST['nova_senha']; // Nova senha que o usuário deseja cadastrar

// Configura a conexão com o banco de dados MySQL
// 'dbname=db_login' é o nome do banco de dados
// 'host=127.0.0.1' é o endereço do servidor (local)
$dsn = 'mysql:dbname=db_login;host=127.0.0.1';

// Usuário do banco de dados (no caso, 'root')
$userDB = 'root';

// Senha do banco de dados (vazia no exemplo)
$passwordDB = '';

// Tenta conectar ao banco de dados
try {
    // Cria uma nova conexão com o banco de dados usando PDO
    $banco = new PDO($dsn, $userDB, $passwordDB);

    // Prepara e executa uma consulta SQL para verificar se o usuário e CPF correspondem
    // A consulta usa JOIN para unir as tabelas 'tb_usuario' e 'tb_pessoa' usando o 'id_pessoa'
    $stmt = $banco->prepare('SELECT * FROM tb_usuario JOIN tb_pessoa ON tb_usuario.id_pessoa = tb_pessoa.id WHERE usuario = :user AND cpf = :cpf');
    $stmt->execute(['user' => $user, 'cpf' => $cpf]);

    // Pega o resultado da consulta (se houver)
    $resultado = $stmt->fetch();

    // Verifica se o usuário e CPF foram encontrados
    if ($resultado) {
        // Se o usuário e CPF estiverem corretos, prepara e executa a atualização da senha
        $stmtUpdate = $banco->prepare('UPDATE tb_usuario SET senha = :nova_senha WHERE usuario = :user');
        $stmtUpdate->execute(['nova_senha' => $nova_senha, 'user' => $user]);

        // Exibe uma mensagem de sucesso
        echo 'Senha alterada com sucesso.';
    } else {
        // Se o usuário ou CPF estiverem incorretos, exibe uma mensagem de erro
        echo 'Usuário ou CPF incorretos.';
    }
} catch (PDOException $e) {
    // Se ocorrer algum erro durante a execução, exibe a mensagem de erro
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>