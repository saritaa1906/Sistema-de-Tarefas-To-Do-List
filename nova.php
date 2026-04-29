<?php
require 'conexao.php';
session_start();

if(!isset($_SESSION["usuario_id"])){
    header("Location: login.php");
    exit;
}

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $data_tarefa = $_POST["data_tarefa"] ?? null;

    if (empty($data_tarefa)) {
        $erro = "Selecione uma data";
    } else {
        $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao, data_tarefa, usuario_id) VALUES (?,?,?,?)");
        $stmt->execute([$titulo, $descricao, $data_tarefa, $_SESSION["usuario_id"]]);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Nova Tarefa</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center">

<div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
         Nova Tarefa
    </h2>

    <?php if (!empty($erro)) { ?>
        <div class="bg-red-200 text-red-800 p-2 rounded mb-4 text-sm text-center">
            <?= $erro ?>
        </div>
    <?php } ?>

    <form method="POST" class="flex flex-col gap-4">

        <input type="text" name="titulo" placeholder="Título"
               class="border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400"
               required>

        <textarea name="descricao" placeholder="Descrição"
                  class="border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400"></textarea>

        <input type="date" name="data_tarefa"
               class="border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400"
               required>

        <button class="bg-purple-600 hover:bg-purple-700 text-white p-3 rounded-lg font-semibold shadow-md transition">
            Salvar
        </button>

        <a href="index.php" class="text-center text-sm text-gray-500 hover:underline">
            ← Voltar
        </a>

    </form>

</div>

</body>
</html>