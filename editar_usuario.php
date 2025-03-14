<?php
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
} catch (PDOException $e) {
    // Se ocorrer algum erro na conexão, exibe a mensagem de erro e para a execução do script
    echo 'Erro de conexão: ' . $e->getMessage();
    exit();
}

// Verifica se o ID do usuário foi passado na URL
if (!isset($_GET['id'])) {
    // Se o ID não foi fornecido, exibe uma mensagem de erro e para a execução do script
    echo 'ID do usuário não fornecido.';
    exit();
}

// Pega o ID do usuário da URL
$id = $_GET['id'];

// Prepara e executa uma consulta SQL para buscar os dados do usuário
// A consulta usa JOIN para unir as tabelas 'tb_usuario' e 'tb_pessoa' usando o 'id_pessoa'
$stmt = $banco->prepare('SELECT * FROM tb_usuario JOIN tb_pessoa ON tb_usuario.id_pessoa = tb_pessoa.id WHERE tb_usuario.id = :id');
$stmt->execute(['id' => $id]);

// Pega o resultado da consulta (se houver)
$usuario = $stmt->fetch();

// Se o usuário não for encontrado, exibe uma mensagem de erro e para a execução do script
if (!$usuario) {
    echo 'Usuário não encontrado.';
    exit();
}

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $senha = $_POST['senha'];
    $logradouro = $_POST['logradouro'];
    $n_casa = $_POST['n_casa'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $telefone_1 = $_POST['telefone_1'];
    $telefone_2 = $_POST['telefone_2'];

    try {
        // Atualiza a senha na tabela 'tb_usuario'
        $stmtUsuario = $banco->prepare('UPDATE tb_usuario SET senha = :senha WHERE id = :id');
        $stmtUsuario->execute(['senha' => $senha, 'id' => $id]);

        // Atualiza os dados na tabela 'tb_pessoa'
        $stmtPessoa = $banco->prepare('UPDATE tb_pessoa SET logradouro = :logradouro, n_casa = :n_casa, bairro = :bairro, cidade = :cidade, telefone_1 = :telefone_1, telefone_2 = :telefone_2 WHERE id = :id_pessoa');
        $stmtPessoa->execute([
            'logradouro' => $logradouro,
            'n_casa' => $n_casa,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'telefone_1' => $telefone_1,
            'telefone_2' => $telefone_2,
            'id_pessoa' => $usuario['id_pessoa']
        ]);

        // Redireciona para a página 'usuarios.php' após a atualização
        header('Location: usuarios.php');
        exit();
    } catch (PDOException $e) {
        // Se ocorrer algum erro durante a atualização, exibe a mensagem de erro
        echo 'Erro ao atualizar: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<!-- Define o tipo de documento como HTML5 -->
<html lang="pt-br">
<!-- Inicia o documento HTML e define o idioma como português do Brasil -->

<head>
    <!-- Área de configurações da página -->
    <meta charset="UTF-8">
    <!-- Define o conjunto de caracteres como UTF-8 (permite acentos e caracteres especiais) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Configura a página para se ajustar ao tamanho da tela do dispositivo -->
    <title>Editar Usuário</title>
    <!-- Define o título da página (aparece na aba do navegador) -->

    <style>
        /* Estilos CSS para a página */
        body {
            background-color: #0e0e0e; /* Cor de fundo preta */
            color: #f2f2f2; /* Cor do texto branca */
            padding: 20px; /* Espaço interno ao redor do conteúdo */
            font-family: Arial, sans-serif; /* Fonte usada no texto */
        }
        form {
            max-width: 500px; /* Largura máxima do formulário */
            margin: 0 auto; /* Centraliza o formulário na página */
        }
        label {
            display: block; /* Faz cada label ocupar uma linha inteira */
            margin-bottom: 5px; /* Espaço abaixo de cada label */
        }
        input {
            width: 100%; /* Largura total para os campos de entrada */
            padding: 8px; /* Espaço interno dentro dos campos */
            margin-bottom: 15px; /* Espaço abaixo de cada campo */
            border: 1px solid #ccc; /* Borda dos campos */
            border-radius: 4px; /* Bordas arredondadas */
            background-color: #333; /* Cor de fundo dos campos */
            color: #f2f2f2; /* Cor do texto nos campos */
        }
        input[type="submit"] {
            background-color: #28a745; /* Cor de fundo do botão de enviar */
            color: white; /* Cor do texto do botão */
            border: none; /* Remove a borda do botão */
            cursor: pointer; /* Muda o cursor para o estilo de "clique" */
        }
        input[type="submit"]:hover {
            background-color: #218838; /* Cor de fundo do botão ao passar o mouse */
        }
        a {
            color: #007bff; /* Cor do link */
            text-decoration: none; /* Remove o sublinhado do link */
        }
        a:hover {
            text-decoration: underline; /* Adiciona sublinhado ao passar o mouse */
        }
    </style>
</head>

<body>
    <!-- Corpo da página (o que aparece na tela) -->
    <h1>Editar Usuário</h1>
    <!-- Título da página -->

    <?php if ($usuario): ?>
        <!-- Se o usuário for encontrado, exibe o formulário de edição -->
        <form method="post">
            <!-- Formulário que envia os dados usando o método POST -->
            <label>Senha:</label>
            <input type="password" name="senha" value="<?php echo $usuario['senha']; ?>" required>
            <!-- Campo para editar a senha (obrigatório) -->

            <label>Logradouro:</label>
            <input type="text" name="logradouro" value="<?php echo $usuario['logradouro']; ?>" required>
            <!-- Campo para editar o logradouro (obrigatório) -->

            <label>Número da Casa:</label>
            <input type="text" name="n_casa" value="<?php echo $usuario['n_casa']; ?>" required>
            <!-- Campo para editar o número da casa (obrigatório) -->

            <label>Bairro:</label>
            <input type="text" name="bairro" value="<?php echo $usuario['bairro']; ?>" required>
            <!-- Campo para editar o bairro (obrigatório) -->

            <label>Cidade:</label>
            <input type="text" name="cidade" value="<?php echo $usuario['cidade']; ?>" required>
            <!-- Campo para editar a cidade (obrigatório) -->

            <label>Telefone 1:</label>
            <input type="text" name="telefone_1" value="<?php echo $usuario['telefone_1']; ?>" required>
            <!-- Campo para editar o primeiro telefone (obrigatório) -->

            <label>Telefone 2:</label>
            <input type="text" name="telefone_2" value="<?php echo $usuario['telefone_2']; ?>">
            <!-- Campo para editar o segundo telefone (opcional) -->

            <input type="submit" value="Salvar Alterações">
            <!-- Botão para enviar o formulário -->
        </form>
    <?php else: ?>
        <!-- Se o usuário não for encontrado, exibe uma mensagem de erro -->
        <p>Usuário não encontrado.</p>
    <?php endif; ?>

    <br>
    <!-- Link para voltar à lista de usuários -->
    <a href="usuarios.php">Voltar para a lista de usuários</a>
</body>
</html>