<?php
$user = $_POST['user'];
$cpf = $_POST['cpf'];
$nova_senha = $_POST['nova_senha'];

$dsn = 'mysql:dbname=db_login;host=127.0.0.1';
$userDB = 'root';
$passwordDB = '';

try {
    $banco = new PDO($dsn, $userDB, $passwordDB);

    // Verificar se o usuário e CPF correspondem
    $stmt = $banco->prepare('SELECT * FROM tb_usuario JOIN tb_pessoa ON tb_usuario.id_pessoa = tb_pessoa.id WHERE usuario = :user AND cpf = :cpf');
    $stmt->execute(['user' => $user, 'cpf' => $cpf]);
    $resultado = $stmt->fetch();

    if ($resultado) {
        // Atualizar a senha
        $stmtUpdate = $banco->prepare('UPDATE tb_usuario SET senha = :nova_senha WHERE usuario = :user');
        $stmtUpdate->execute(['nova_senha' => $nova_senha, 'user' => $user]);
        echo 'Senha alterada com sucesso.';
    } else {
        echo 'Usuário ou CPF incorretos.';
    }
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>