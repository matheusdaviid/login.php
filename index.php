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
    <title>Login</title>
    <!-- Define o título da página (aparece na aba do navegador) -->

    <style>
        /* Estilos CSS para a página */
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