<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        .header {
            display: flex;
            justify-content: space-around;
            padding: 10px;
            background-color: #f4f4f4;
        }
        .header a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .header a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="index.php">Ver Personagens</a>
        <a href="criar_personagem.php">Criar Personagem</a>
        <?php if (isset($_SESSION['login'])): ?>
            <?php if ($_SESSION['user_role'] == 'admin'): ?>
                <a href="admin_personagens.php">Gerenciar Personagens</a>
            <?php endif; ?>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="login.php">Entrar</a>
        <?php endif; ?>
    </div>
</body>
</html>
