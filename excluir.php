<?php
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

// Verifica se o ID foi passado pela URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Deleta apenas a tarefa do usuário logado (segurança)
    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$id, $_SESSION["usuario_id"]]);
}

// Redireciona de volta para a lista
header("Location: index.php");
exit;
?>