<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            display: flex;
            justify-content: center; /* Centraliza o conteúdo na horizontal */
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
    <form action="auxlogin.php" method="post">
        <!-- Cria um formulário que envia os dados para "auxlogin.php" usando o método POST -->
        <h1>Login</h1>
        <!-- Título do formulário -->

        <!-- Campos do formulário -->
        <label>Usuário:</label>
        <input type="text" name="user" required>
        <!-- Campo para digitar o nome de usuário (obrigatório) -->

        <label>Senha:</label>
        <input type="password" name="password" required>
        <!-- Campo para digitar a senha (obrigatório, o texto fica oculto) -->

        <input type="submit" value="Enviar">
        <!-- Botão para enviar o formulário -->

        <!-- Botão para redirecionar para a página de cadastro -->
        <button type="button" onclick="window.location.href='cadastro.php'">Cadastrar</button>

        <!-- Botão para redirecionar para a página de recuperação de senha -->
        <button type="button" onclick="window.location.href='esqueci_senha.php'">Esqueci a Senha</button>
    </form>
</body>
</html>