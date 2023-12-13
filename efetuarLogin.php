<?php

$host = 'localhost';
$dbname = 'User';
$user = 'postgres';
$pass = '19122002';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Conexão bem-sucedida!';

    // Verifica se a variável 'id' está definida e é um número inteiro
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o ID existe antes de tentar deletar
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email AND senha = :senha");
    $stmt_check->bindParam(':email', $email);
    $stmt_check->bindParam(':senha', $senha);
    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        echo "Usuario logado com sucesso";
        //navegar para a tela index.php
        header("refresh:0, index.php");
    } else {
        echo "Usuario inexistente";
        header("refresh:10, login.php");
    }
} catch (PDOException $e) {
    echo "Erro de conexão ou inserção: " . $e->getMessage();
    header("refresh:20, login.php");
}
