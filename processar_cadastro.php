<?php
$nome = $_POST['nome'];
$ano_nascimento = $_POST['ano_nascimento'];
$cpf = $_POST['cpf'];
$telefone_1 = $_POST['telefone_1'];
$telefone_2 = $_POST['telefone_2'];
$logradouro = $_POST['logradouro'];
$n_casa = $_POST['n_casa'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$dsn = 'mysql:dbname=db_login;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $banco = new PDO($dsn, $user, $password);

    // Inserir na tabela tb_pessoa
    $stmtPessoa = $banco->prepare('INSERT INTO tb_pessoa (nome, ano_nascimento, cpf, telefone_1, telefone_2, logradouro, n_casa, bairro, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmtPessoa->execute([$nome, $ano_nascimento, $cpf, $telefone_1, $telefone_2, $logradouro, $n_casa, $bairro, $cidade]);
    $id_pessoa = $banco->lastInsertId();

    // Inserir na tabela tb_usuario
    $stmtUsuario = $banco->prepare('INSERT INTO tb_usuario (usuario, senha, id_pessoa) VALUES (?, ?, ?)');
    $stmtUsuario->execute([$usuario, $senha, $id_pessoa]);

    header('Location: index.php');
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>