<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <style>
    
        body {
            display: flex;
            justify-content: center;
            background-color: #0e0e0e; /* Cor de fundo preta */
            color: #f2f2f2; /* Cor do texto branca */
            padding-top: 50px; /* Espaço no topo da página */
        }
        form {
            width: 300px; /* Largura do formulário */
        }
        input {
            margin-bottom: 10px; /* Espaço entre os campos do formulário */
            width: 100%; /* Largura total para os campos de entrada */
        }
    </style>
</head>

<body>
    <!-- Corpo da página (o que aparece na tela) -->
    <form action="processar_cadastro.php" method="post">
        <!-- Cria um formulário que envia os dados para "processar_cadastro.php" usando o método POST -->
        <h1>Cadastro</h1>
        <!-- Título do formulário -->

        <!-- Campos do formulário -->
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <!-- Campo para digitar o nome (obrigatório) -->

        <label>Ano de Nascimento:</label>
        <input type="text" name="ano_nascimento" required>
        <!-- Campo para digitar o ano de nascimento (obrigatório) -->

        <label>CPF:</label>
        <input type="text" name="cpf" required>
        <!-- Campo para digitar o CPF (obrigatório) -->

        <label>Telefone 1:</label>
        <input type="text" name="telefone_1" required>
        <!-- Campo para digitar o primeiro telefone (obrigatório) -->

        <label>Telefone 2:</label>
        <input type="text" name="telefone_2">
        <!-- Campo para digitar o segundo telefone (opcional) -->

        <label>Logradouro:</label>
        <input type="text" name="logradouro" required>
        <!-- Campo para digitar o logradouro (obrigatório) -->

        <label>Número da Casa:</label>
        <input type="text" name="n_casa" required>
        <!-- Campo para digitar o número da casa (obrigatório) -->

        <label>Bairro:</label>
        <input type="text" name="bairro" required>
        <!-- Campo para digitar o bairro (obrigatório) -->

        <label>Cidade:</label>
        <input type="text" name="cidade" required>
        <!-- Campo para digitar a cidade (obrigatório) -->

        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <!-- Campo para digitar o nome de usuário (obrigatório) -->

        <label>Senha:</label>
        <input type="password" name="senha" required>
        <!-- Campo para digitar a senha (obrigatório, o texto fica oculto) -->

        <input type="submit" value="Cadastrar">
        <!-- Botão para enviar o formulário -->
    </form>
</body>
</html>