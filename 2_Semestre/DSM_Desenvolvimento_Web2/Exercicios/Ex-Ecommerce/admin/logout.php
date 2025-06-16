<?php
    session_start();

    // Opção mais pesada: Destroi a sessão por completo
    // session_destroy();

    // Opção mais leve: limpa as variaveis de sessão
    $_SESSION = array();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Desconectar</title>
        <link href="../css/admLogoutStyle.css" rel="stylesheet">
    </head>
    <body>
        <video autoplay muted loop id="backgroundVideo">
            <source src="../Midias/background_login.mp4" type="video/mp4">
        </video>
        <div id="logoutContainer">
            <h1>Desconectado com sucesso.</h1>
            <p>Caso queira entrar novamente <a href="login_admin.php">Clique aqui</a></p>
        </div>
    </body>
</html>