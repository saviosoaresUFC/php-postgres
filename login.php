<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>LOGIN</title>
</head>

<body>
    <div class="login">
        <form class="form" action="efetuarLogin.php" method="post">
            <h1>Login</h1>
            <input type="email" name="email" id="email" placeholder="Email" require>
            <input type="password" name="senha" id="senha" placeholder="Senha" require>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>