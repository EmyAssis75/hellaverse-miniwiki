<?php
require('conect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografia da senha

    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, senha) VALUES (:nome, :senha)");
        $stmt->execute([':nome' => $nome, ':senha' => $senha]);
        echo "UsuÃ¡rio cadastrado com sucesso!";
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
}
?>
