<?php
$host = 'localhost'; // ou o endereço do seu banco de dados
$dbname = 'User';    // nome do seu banco de dados
$user = 'postgres'; // seu nome de usuário
$pass = '19122002';   // sua senha

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}

// Consulta SQL para obter os dados da tabela 'users'
$sql = "SELECT * FROM users";

try {
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erro na consulta: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <title>Meu Site</title>
</head>

<body>
    <!-- <div class="container">
        <h1>
            <?php echo "Aqui tera uma tabela do Banco de Dados"; ?>
        </h1>
    </div> -->

    <div class="formulario">
        <fieldset class="form">
            <legend>Seus Dados</legend>
            <form action="salvarUser.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome" required>

                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required>

                <button class="buttonForm" type="submit">Enviar</button>
            </form>
        </fieldset>
    </div>

    <div class="divTable">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Idade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['sobrenome']; ?></td>
                        <td class="tdIdade">
                            <?php echo $row['idade']; ?>
                            <div>
                                <form action="excluirUser.php" method="post" class="formexcluir">
                                    <button type="submit" value='<?php echo $row['id'] ?>' name="id" class="buttonformexcluir">
                                        <img src="assets/trash.png" alt="Excluir">
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>