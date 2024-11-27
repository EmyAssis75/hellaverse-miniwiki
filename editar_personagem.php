<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado e se é administrador
if (!isset($_SESSION['login']) || $_SESSION['user_role'] != 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        $stmt = $pdo->prepare('SELECT * FROM personagens WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $personagem = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$personagem) {
            echo 'Personagem não encontrado.';
            exit;
        }
    } catch (PDOException $e) {
        die('Erro ao acessar o banco de dados: ' . htmlspecialchars($e->getMessage()));
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $idade = intval($_POST['idade']);
    $especie = $_POST['especie'];
    $anel_origem = $_POST['anel_origem'];
    $sobre = $_POST['sobre'];
    $oficial = isset($_POST['oficial']) ? 1 : 0;

    try {
        $stmt = $pdo->prepare(
            'UPDATE personagens SET nome = :nome, idade = :idade, especie = :especie, anel_origem = :anel_origem, sobre = :sobre, oficial = :oficial WHERE id = :id'
        );
        $stmt->execute([
            ':nome' => $nome,
            ':idade' => $idade,
            ':especie' => $especie,
            ':anel_origem' => $anel_origem,
            ':sobre' => $sobre,
            ':oficial' => $oficial,
            ':id' => $id
        ]);
        header('Location: admin_personagens.php');
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao atualizar personagem: ' . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Personagem</title>
</head>
<body>
    <h1>Editar Personagem</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($personagem['id']) ?>">
        <label>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($personagem['nome']) ?>" required></label><br>
        <label>Idade: <input type="number" name="idade" value="<?= htmlspecialchars($personagem['idade']) ?>" required></label><br>
        <label>Espécie: <input type="text" name="especie" value="<?= htmlspecialchars($personagem['especie']) ?>" required></label><br>
        <label>Anel de Origem:
            <select name="anel_origem" required>
                <option <?= $personagem['anel_origem'] == 'Pride' ? 'selected' : '' ?>>Pride</option>
                <option <?= $personagem['anel_origem'] == 'Envy' ? 'selected' : '' ?>>Envy</option>
                <option <?= $personagem['anel_origem'] == 'Wrath' ? 'selected' : '' ?>>Wrath</option>
                <option <?= $personagem['anel_origem'] == 'Lust' ? 'selected' : '' ?>>Lust</option>
                <option <?= $personagem['anel_origem'] == 'Greed' ? 'selected' : '' ?>>Greed</option>
                <option <?= $personagem['anel_origem'] == 'Gluttony' ? 'selected' : '' ?>>Gluttony</option>
                <option <?= $personagem['anel_origem'] == 'Sloth' ? 'selected' : '' ?>>Sloth</option>
            </select>
        </label><br>
        <label>Sobre: <textarea name="sobre" required><?= htmlspecialchars($personagem['sobre']) ?></textarea></label><br>
        <label>Oficial: <input type="checkbox" name="oficial" <?= $personagem['oficial'] ? 'checked' : '' ?>></label><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
