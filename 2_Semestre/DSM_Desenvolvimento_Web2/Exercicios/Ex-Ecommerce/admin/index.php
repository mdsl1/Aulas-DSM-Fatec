<?php
    session_start();

    if(!isset($_SESSION["admin"])) {
        header("Location: login_admin.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Área Administrativa</title>
        <link href="../css/admHubStyle.css" rel="stylesheet">
    </head>
    <body>
        <video autoplay muted loop id="backgroundVideo">
            <source src="../Midias/background_login.mp4" type="video/mp4">
        </video>
        <main>
            <h1>Área Administrativa - Miner's Shopping</h1>
            <h2>Bem vindo(a), <?= $_SESSION["admin"]; ?></h2>

            <section>
                <p>Lista de funções:</p>
                <ul>
                    <li><a href="form_cadastro_produto.php">Cadastrar produto</a></li>
                    <li><a href="listar_produtos.php">Listar produtos cadastrados</a></li>
                    <li><a href="listar_vendas.php">Histórico de Vendas</a></li>
                    <li><a class="logout" href="logout.php">Sair do sistema</a></li>
                </ul>
            </section>
        </main>
    </body>
</html>