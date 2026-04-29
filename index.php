<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE usuario_id = ?");
$stmt->execute([$_SESSION["usuario_id"]]);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>To-Do App</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen">

<!-- NAVBAR -->
<div class="flex justify-between items-center p-6">

    <h1 class="text-2xl font-bold text-gray-800">
     Minhas Tarefas
    </h1>

<div class="flex items-center gap-4">

    <!-- BLOCO DO USUÁRIO -->
    <div class="flex items-center gap-3 bg-white/20 px-4 py-1 rounded-full backdrop-blur">

        <!-- Avatar -->
        <div class="w-8 h-8 flex items-center justify-center bg-purple-500 text-white rounded-full font-bold">
            <?= strtoupper(substr($_SESSION["usuario"], 0, 1)) ?>
        </div>

        <!-- Nome -->
        <span class="text-gray-900 text-sm font-medium">
    Olá, <?= $_SESSION["usuario"] ?> 👋
        </span>

    </div>

    <!-- BOTÃO SAIR -->
    <a href="logout.php" 
       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
       Sair
    </a>

</div>

</div>

<!-- BOTÃO -->
<div class="px-6">
<a href="nova.php"
   class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl shadow-lg">
   + Nova tarefa
</a>
</div>

<!-- LISTA EM CARDS -->
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

<?php while ($tarefa = $stmt->fetch(PDO::FETCH_ASSOC)) { 

    $hoje = date("Y-m-d");
    $atrasada = !empty($tarefa["data_tarefa"]) && $tarefa["data_tarefa"] < $hoje;
?>

<div class="bg-white rounded-2xl shadow-lg p-5 hover:scale-105 transition">

    <!-- Título -->
    <h2 class="text-lg font-bold text-gray-800 mb-2">
        <?= $tarefa["titulo"] ?>
    </h2>

    <!-- Status -->
    <?php if ($tarefa["status"] == "concluida") { ?>
        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
            ✔ Concluída
        </span>
    <?php } else { ?>
        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
            ⏳ Pendente
        </span>
    <?php } ?>

    <!-- Data -->
    <p class="mt-3 text-sm <?= $atrasada ? 'text-red-500 font-bold' : 'text-gray-500' ?>">
        📅 <?= !empty($tarefa["data_tarefa"]) 
            ? date("d/m/Y", strtotime($tarefa["data_tarefa"])) 
            : "Sem data" ?>
    </p>

    <!-- Data de hoje -->
    <p class="text-xs text-gray-400 mt-1">
        Hoje: <?= date("d/m/Y") ?>
    </p>

    <!-- Ações -->
    <div class="flex gap-2 mt-4">

        <a href="editar.php?id=<?= $tarefa["id"] ?>"
           class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">
           Editar
        </a>

        <a href="concluir.php?id=<?= $tarefa["id"] ?>"
           class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs">
           ✔
        </a>

        <a href="excluir.php?id=<?= $tarefa["id"] ?>"
           onclick="return confirm('Tem certeza?')"
           class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">
           ✖
        </a>

    </div>

</div>

<?php } ?>

</div>

</body>
</html>