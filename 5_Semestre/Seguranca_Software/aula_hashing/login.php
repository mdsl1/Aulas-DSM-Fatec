<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <main style="display: flex; flex-direction: column; width:100%; height: 100vh; align-items: center; justify-content: center; text-align: center;">
        <h1>Faça login no sistema</h1>
        <form action="validar_login.php" method="post" style="display: flex; flex-direction: column; width: 40%; height: 50vh; gap: 10px; padding: 10px 50px;">
            <label for="login" style="font-size: 25px;">E-mail:</label>
            <input type="text" style="padding: 10px 20px; font-size: 18px;" name="login" id="login" placeholder="Seu melhor e-mail (teste@teste.com)">

            <label for="senha" style="font-size: 25px;">Senha:</label>
            <input type="password" style="padding: 10px 20px; font-size: 18px;" name="senha" id="senha" placeholder="Sua senha segura (senhasegura123)">

            <button type="submit">Acessar</button>
        </form>
    </main>

</body>
</html>