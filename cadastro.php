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
    <form action="processar_cadastro.php" method="post">
        <h1>Cadastro</h1>
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Ano de Nascimento:</label>
        <input type="text" name="ano_nascimento" required>
        <label>CPF:</label>
        <input type="text" name="cpf" required>
        <label>Telefone 1:</label>
        <input type="text" name="telefone_1" required>
        <label>Telefone 2:</label>
        <input type="text" name="telefone_2">
        <label>Logradouro:</label>
        <input type="text" name="logradouro" required>
        <label>Número da Casa:</label>
        <input type="text" name="n_casa" required>
        <label>Bairro:</label>
        <input type="text" name="bairro" required>
        <label>Cidade:</label>
        <input type="text" name="cidade" required>
        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>