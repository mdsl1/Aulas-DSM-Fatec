<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Cliente</title>
</head>
<body>
    <h1>Faça seu Login</h1>
    <form action="validar_login.php" method="POST">
        <label for="email">Seu E-mail:</label>
        <input type="email" name="email">
        <label for="senha">Sua Senha:</label>
        <input type="password" name="senha">
        <button>Enviar</button>
    </form>
    <p>Ainda não se cadastrou? <a href="form_cadastrar_cliente.php">Clique aqui.</a></p>
</body>
</html>