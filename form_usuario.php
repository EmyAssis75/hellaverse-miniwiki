<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="usuario_cadastrar.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br><br>

        <button type="submit">Cadastrar Usuário</button>
    </form>
</body>
</html>
