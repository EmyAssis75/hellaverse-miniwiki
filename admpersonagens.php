<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado e se é administrador
if (!isset($_SESSION['login']) || $_SESSION['user_role'] != 'admin') {
    header('Location: login.php');
    exit;
}

try {
    // Busca os personagens cadastrados
    $stmt = $pdo->query('SELECT * FROM personagens');
    $personagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erro ao acessar o banco de dados: ' . htmlspecialchars($e->getMessage()));
}

// Deletar personagem
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    try {
        $stmt = $pdo->prepare('DELETE FROM personagens WHERE id = :id');
        $stmt->execute([':id' => $delete_id]);
        header('Location: admin_personagens.php');
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao deletar personagem: ' . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Personagens</title>
</head>
<body>
    <h1>Gerenciamento de Personagens</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Espécie</th>
            <th>Anel de Origem</th>
            <th>Sobre</th>
            <th>Oficial</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($personagens as $personagem): ?>
            <tr>
                <td><?= htmlspecialchars($personagem['id']) ?></td>
                <td><?= htmlspecialchars($personagem['nome']) ?></td>
                <td><?= htmlspecialchars($personagem['idade']) ?></td>
                <td><?= htmlspecialchars($personagem['especie']) ?></td>
                <td><?= htmlspecialchars($personagem['anel_origem']) ?></td>
                <td><?= htmlspecialchars($personagem['sobre']) ?></td>
                <td><?= htmlspecialchars($personagem['oficial'] ? 'Sim' : 'Não') ?></td>
                <td>
                    <form action="editar_personagem.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($personagem['id']) ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($personagem['id']) ?>">
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este personagem?')">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
