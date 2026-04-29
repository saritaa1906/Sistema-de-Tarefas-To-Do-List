<?php
session_start();
require 'conexao.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->execute([$usuario, $senha]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];

        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
        🔐 Login
    </h2>

    <?php if (!empty($erro)) { ?>
        <div class="bg-red-200 text-red-800 p-2 rounded mb-4 text-sm text-center">
            <?= $erro ?>
        </div>
    <?php } ?>

    <form method="POST" class="flex flex-col gap-4">

        <input type="text" name="usuario" placeholder="Usuário"
               class="border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400"
               required>

        <input type="password" name="senha" placeholder="Senha"
               class="border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400"
               required>

        <button class="bg-purple-600 hover:bg-purple-700 text-white p-3 rounded-lg font-semibold shadow-md transition">
            Entrar
        </button>

    </form>

    <p class="text-xs text-gray-400 text-center mt-4">
        Use: admin / 123456
    </p>

</div>

</body>
</html>