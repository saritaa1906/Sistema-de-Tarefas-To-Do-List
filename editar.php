<?php
require 'conexao.php';
session_start();

if(!isset($_SESSION["usuario_id"])){
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id=?");
$stmt->execute([$id]);
$tarefa = $stmt->fetch();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status = $_POST["status"];

    $stmt = $pdo->prepare("UPDATE tarefas SET titulo=?, descricao=?, status=? WHERE id=?");
    $stmt->execute([$titulo, $descricao, $status, $id]);

    header("Location: index.php");
}

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

?>

<?php include 'layout.php'; ?>

<div class="bg-white p-6 rounded shadow max-w-md mx-auto">
<h2 class="text-xl font-bold mb-4">Editar Tarefa</h2>

<form method="POST" class="flex flex-col gap-3">
<input type="text" name="titulo" value="<?php echo $tarefa["titulo"]; ?>" class="border p-2 rounded">

<textarea name="descricao" class="border p-2 rounded"><?php echo $tarefa["descricao"]; ?></textarea>

<select name="status" class="border p-2 rounded">
<option value="pendente" <?php if($tarefa["status"]=="pendente") echo "selected"; ?>>Pendente</option>
<option value="concluida" <?php if($tarefa["status"]=="concluida") echo "selected"; ?>>Concluída</option>
</select>

<button class="bg-blue-500 text-white p-2 rounded">Atualizar</button>
</form>
</div>

</div>
</body>
</html>