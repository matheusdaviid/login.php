<?php
// Pega os dados enviados pelo formulário usando o método POST
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

    // Prepara e executa a inserção dos dados na tabela 'tb_pessoa'
    $stmtPessoa = $banco->prepare('INSERT INTO tb_pessoa (nome, ano_nascimento, cpf, telefone_1, telefone_2, logradouro, n_casa, bairro, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmtPessoa->execute([$nome, $ano_nascimento, $cpf, $telefone_1, $telefone_2, $logradouro, $n_casa, $bairro, $cidade]);

    // Pega o ID gerado automaticamente para a pessoa que acabou de ser inserida
    $id_pessoa = $banco->lastInsertId();

    // Prepara e executa a inserção dos dados na tabela 'tb_usuario'
    // O 'id_pessoa' é usado para relacionar o usuário à pessoa cadastrada
    $stmtUsuario = $banco->prepare('INSERT INTO tb_usuario (usuario, senha, id_pessoa) VALUES (?, ?, ?)');
    $stmtUsuario->execute([$usuario, $senha, $id_pessoa]);

    // Redireciona para a página inicial (index.php) após o cadastro
    header('Location: index.php');
} catch (PDOException $e) {
    // Se ocorrer algum erro durante a execução, exibe a mensagem de erro
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>