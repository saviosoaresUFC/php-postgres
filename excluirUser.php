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
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];

        // Verifica se o ID existe antes de tentar deletar
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE id = :id");
        $stmt_check->bindParam(':id', $id);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            // Se o ID existir, proceda com a exclusão
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Registro deletado com sucesso";
        } else {
            echo "ID não encontrado no banco de dados";
        }
    } else {
        echo "ID inválido";
    }

    header("refresh:0, index.php");
} catch (PDOException $e) {
    echo "Erro de conexão ou inserção: " . $e->getMessage();
    header("refresh:20, index.php");
}
?>
