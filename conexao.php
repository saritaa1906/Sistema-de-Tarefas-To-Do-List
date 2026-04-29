<?php

$host = "127.0.0.1";
$porta = "3306";
$db = "tarefas"; 
$user = "root";
$password = "ceub123456";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$porta;dbname=$db;charset=utf8",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

?>