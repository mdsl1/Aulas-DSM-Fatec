<?php
    session_start();
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login de Administrador</title>
        <link href="../css/admLoginStyle.css" rel="stylesheet">
    </head>
    <body>
        <video autoplay muted loop id="backgroundVideo">
            <source src="../Midias/background_login.mp4" type="video/mp4">
        </video>
        <div id="loginContainer">
            <h1>Área Administrativa - Entrar</h1>
            <form action="validar_admin.php" method="POST">
                <div class="inputSection">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required autocomplete="off">
                </div>
                <div class="inputSection">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required autocomplete="off">
                </div>
                <button id="loginSubmit">Entrar</button>
            </form>
            <?php 
                if(isset($_SESSION["logado"]) && !$_SESSION["logado"]) {
                    echo "<p class='wrongPassword'>Senha incorreta, tente novamente</p>";
                }
            ?>
        </div>
    </body>
</html>