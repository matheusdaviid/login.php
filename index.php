<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <form action="auxlogin.php" method="post">
        <h1>Login</h1>
        <label>Usuário:</label>
        <input type="text" name="user" required>
        <label>Senha:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Enviar">
        <button type="button" onclick="window.location.href='cadastro.php'">Cadastrar</button>
        <button type="button" onclick="window.location.href='esqueci_senha.php'">Esqueci a Senha</button>
    </form>
</body>
</html>