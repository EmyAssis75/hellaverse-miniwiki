<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Personagem</title>
</head>
<body>
    <?php session_start(); ?>
    <?php if (isset($_SESSION['login'])): ?>
        <h2>Cadastro de Personagem</h2>
        <form action="personagem_cadastrar.php" method="post" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br><br>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" required>
            <br><br>

            <label for="especie">Espécie:</label>
            <input type="text" id="especie" name="especie" required>
            <br><br>

            <label for="anel_origem">Anel de Origem:</label>
            <select id="anel_origem" name="anel_origem" required>
                <option value="Luxúria">Luxúria</option>
                <option value="Gula">Gula</option>
                <option value="Avareza">Avareza</option>
                <option value="Preguiça">Preguiça</option>
                <option value="Ira">Ira</option>
                <option value="Inveja">Inveja</option>
                <option value="Orgulho">Orgulho</option>
            </select>
            <br><br>

            <label for="sobre">Sobre:</label>
            <textarea id="sobre" name="sobre" rows="4" cols="50" required></textarea>
            <br><br>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>
            <br><br>

            <label for="oficial">Personagem Oficial:</label>
            <select id="oficial" name="oficial">
                <option value="0">Não</option>
                <option value="1">Sim (Apenas Administradores)</option>
            </select>
            <br><br>

            <button type="submit">Cadastrar Personagem</button>
        </form>
    <?php else: ?>
        <p>Você precisa estar logado para cadastrar personagens.</p>
    <?php endif; ?>
</body>
</html>
