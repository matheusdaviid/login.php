<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>

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
    <form action="processar_esqueci_senha.php" method="post">
        <!-- Cria um formulário que envia os dados para "processar_esqueci_senha.php" usando o método POST -->
        <h1>Esqueci a Senha</h1>
        <!-- Título do formulário -->

        <!-- Campos do formulário -->
        <label>Usuário:</label>
        <input type="text" name="user" required>
        <!-- Campo para digitar o nome de usuário (obrigatório) -->

        <label>CPF:</label>
        <input type="text" name="cpf" required>
        <!-- Campo para digitar o CPF (obrigatório) -->

        <label>Nova Senha:</label>
        <input type="password" name="nova_senha" required>
        <!-- Campo para digitar a nova senha (obrigatório, o texto fica oculto) -->

        <input type="submit" value="Alterar Senha">
        <!-- Botão para enviar o formulário -->
    </form>
</body>
</html>