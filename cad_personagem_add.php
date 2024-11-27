<?php
session_start();
require('conect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $especie = $_POST['especie'];
    $anel_origem = $_POST['anel_origem'];
    $sobre = $_POST['sobre'];
    $imagem = $_POST['imagem'];
    $oficial = ($_SESSION['is_admin'] && isset($_POST['oficial'])) ? 1 : 0;
    $criado_por = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("
            INSERT INTO personagem (nome, idade, especie, anel_origem, sobre, imagem, oficial, criado_por)
            VALUES (:nome, :idade, :especie, :anel_origem, :sobre, :imagem, :oficial, :criado_por)
        ");
        $stmt->execute([
            ':nome' => $nome,
            ':idade' => $idade,
            ':especie' => $especie,
            ':anel_origem' => $anel_origem,
            ':sobre' => $sobre,
            ':imagem' => $imagem,
            ':oficial' => $oficial,
            ':criado_por' => $criado_por
        ]);
        echo "Personagem cadastrado com sucesso!";
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
}
?>
