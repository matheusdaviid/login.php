<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            background-color: #0e0e0e;
            color: #f2f2f2;
            padding-top: 50px;
        }
        form {
            width: 300px;
        }
        input {
            margin-bottom: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
    <form action="processar_esqueci_senha.php" method="post">
        <h1>Esqueci a Senha</h1>
        <label>Usuário:</label>
        <input type="text" name="user" required>
        <label>CPF:</label>
        <input type="text" name="cpf" required>
        <label>Nova Senha:</label>
        <input type="password" name="nova_senha" required>
        <input type="submit" value="Alterar Senha">
    </form>
</body>
</html>