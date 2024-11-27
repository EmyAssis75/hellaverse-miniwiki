<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personagens</title>
</head>
<body>
    <h2>Lista de Personagens</h2>
    <?php
    require('conect.php');
    $stmt = $pdo->query('SELECT * FROM personagens ORDER BY nome ASC');
    ?>

    <table border="1" width="80%" style="margin: auto;">
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Espécie</th>
            <th>Anel de Origem</th>
            <th>Sobre</th>
            <th>Imagem</th>
            <th>Oficial</th>
        </tr>
        <?php while ($personagem = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($personagem['nome']) ?></td>
                <td><?= htmlspecialchars($personagem['idade']) ?></td>
                <td><?= htmlspecialchars($personagem['especie']) ?></td>
                <td><?= htmlspecialchars($personagem['anel_origem']) ?></td>
                <td><?= htmlspecialchars($personagem['sobre']) ?></td>
                <td>
                    <img src="<?= htmlspecialchars($personagem['imagem']) ?>" width="100" alt="Imagem do personagem">
                </td>
                <td><?= $personagem['oficial'] ? 'Sim' : 'Não' ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
