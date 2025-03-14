<?php
// Pega o valor do campo 'user' do formulário enviado pelo método POST
$userForm = $_POST['user'];

// Pega o valor do campo 'password' do formulário enviado pelo método POST
$passwordForm = $_POST['password'];

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

    // Prepara a consulta SQL para buscar um usuário com o nome e senha fornecidos
    // ':user' e ':password' são placeholders que serão substituídos pelos valores reais
    $consultaUsuarioSenha = 'SELECT * FROM tb_usuario WHERE usuario = :user AND senha = :password';

    // Prepara a consulta SQL para ser executada
    $stmt = $banco->prepare($consultaUsuarioSenha);

    // Executa a consulta, substituindo os placeholders pelos valores do formulário
    $stmt->execute(['user' => $userForm, 'password' => $passwordForm]);

    // Pega o resultado da consulta (se houver)
    $resultado = $stmt->fetch();

    // Verifica se a consulta retornou algum resultado
    if ($resultado) {
        // Se o usuário e senha estiverem corretos, redireciona para a página 'usuarios.php'
        header('Location: usuarios.php');
    } else {
        // Se não encontrar o usuário ou a senha estiver errada, exibe uma mensagem de erro
        echo 'Usuário ou senha incorretos.';
    }
} catch (PDOException $e) {
    // Se ocorrer algum erro na conexão com o banco de dados, exibe a mensagem de erro
    echo 'Erro de conexão: ' . $e->getMessage();
}
