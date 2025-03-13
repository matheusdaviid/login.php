<?php
$id = $_GET['id'];

$dsn = 'mysql:dbname=db_login;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $banco = new PDO($dsn, $user, $password);

    // Obter o id_pessoa para excluir também da tabela tb_pessoa
    $stmt = $banco->prepare('SELECT id_pessoa FROM tb_usuario WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Excluir da tabela tb_usuario
        $stmtUsuario = $banco->prepare('DELETE FROM tb_usuario WHERE id = :id');
        $stmtUsuario->execute(['id' => $id]);

        // Excluir da tabela tb_pessoa
        $stmtPessoa = $banco->prepare('DELETE FROM tb_pessoa WHERE id = :id_pessoa');
        $stmtPessoa->execute(['id_pessoa' => $usuario['id_pessoa']]);

        header('Location: usuarios.php');
    } else {
        echo 'Usuário não encontrado.';
    }
} catch (PDOException $e) {
    echo 'Erro ao excluir: ' . $e->getMessage();
}
?>