<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>To-Do List</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<nav class="bg-blue-600 p-4 flex justify-between items-center">
    <span class="text-white text-lg font-bold">To-Do List</span>

    <div class="flex items-center gap-4">
        <?php if (isset($_SESSION["usuario"])): ?>
            <span class="text-white">
                <?= $_SESSION["usuario"] ?>
            </span>
            <a href="logout.php" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                Sair
            </a>
        <?php else: ?>
            <a href="login.php" class="bg-white text-blue-600 px-3 py-1 rounded hover:bg-gray-200">
                Login
            </a>
        <?php endif; ?>
    </div>
</nav>

<div class="max-w-4xl mx-auto mt-6 px-4">