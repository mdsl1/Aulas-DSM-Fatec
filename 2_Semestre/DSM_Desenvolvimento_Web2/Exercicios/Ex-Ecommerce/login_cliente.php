<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Cliente</title>
    <link rel="stylesheet" href="css/clienteLoginStyle.css">
</head>
<body>
    <div id="loginContainer">
        <h1>Miner's Shopping - Entrar</h1>
        <form action="validar_login.php" method="POST">
            <label for="email">E-mail:</label>
            <input type="email" name="email" required autocomplete="off">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required autocomplete="off">
            <button>Enviar</button>
        </form>
        <p>Ainda não se cadastrou? <a href="form_cadastrar_cliente.php">Clique aqui.</a></p>
    </div>
</body>
</html>