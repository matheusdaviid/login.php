<?php
$userForm = $_POST['user'];
$passwordForm = $_POST['password'];

$dsn = 'mysql:dbname=db_login;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $banco = new PDO($dsn, $user, $password);
    $consultaUsuarioSenha = 'SELECT * FROM tb_usuario WHERE usuario = :user AND senha = :password';
    $stmt = $banco->prepare($consultaUsuarioSenha);
    $stmt->execute(['user' => $userForm, 'password' => $passwordForm]);
    $resultado = $stmt->fetch();

    if ($resultado) {
        header('Location: usuarios.php');
    } else {
        echo 'Usuário ou senha incorretos.';
    }
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>