
<?php

$host = 'localhost'; // ou o endereço do seu banco de dados
$dbname = 'User';    // nome do seu banco de dados
$user = 'postgres'; // seu nome de usuário
$pass = '19122002';   // sua senha

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Conexão bem-sucedida!';
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $idade = $_POST['idade'];

    $sql = "INSERT INTO users(
            nome,
            sobrenome,
            idade
        )
        VALUES(
            :nome,
            :sobrenome,
            :idade
        )";
    $stmt = $pdo->prepare($sql);

    // Substitua as variáveis pelos valores reais
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':sobrenome', $sobrenome);
    $stmt->bindParam(':idade', $idade);

    // Execute a consulta preparada
    $stmt->execute();

    echo "Registro inserido com sucesso";
    header("refresh:0, index.php");
}catch (PDOException $e) {
    echo "Erro de conexao ou insercao: " . $e->getMessage();
    header("refresh:20, index.php");
}
?>

