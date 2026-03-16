<?php
    session_start();
    include "admin/conexao.php";

    $sql = "SELECT * FROM produtos ORDER BY preco";
    $comando = $pdo->prepare($sql);
    $comando->execute();
    $result = $comando->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Miner's Shopping</title>
        <link rel="stylesheet" href="css/shoppingStyle.css">
    </head>
    <body>
        <header>
            <img id="logo" src="Midias/logo.png" alt="Logo do site">
            <h1>Miner's Shopping</h1>
            <p>A loja favorita dos mineiros. Ô trem baum!</p>
        </header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li>Ofertas</li>
                <li><a href="carrinho.php">Carrinho</a></li>
                <li>Sobre Nós</li>
                <li>
                    <?php if(!isset($_SESSION["nome"])) { ?>
                        <a href="login_cliente.php">Entrar</a>
                    <?php } else { ?>
                        <a href="logout_cliente.php">Sair</a>
                    <?php } ?>
                </li>
            </ul>
        </nav>
        <main>

            <?php if(!isset($_SESSION["nome"])) { ?>
                <h1>Bem vindo(a) forasteiro.</h1>
                <span>Clique em "Entrar" para fazer login.</span>
            <?php } else { ?>
                <h1>Bem vindo(a) de volta, <?= $_SESSION["nome"]; ?></h1>
            <?php } ?>

            <section id="highlights">                
                <?php foreach($result as $produto) { ?>
                    <div class="card">
                        <div class="cardHeader">
                            <img class="cardImg" src="Midias/<?= $produto["id"]; ?>.png" alt="Imagem do produto">
                        </div>
                        <div class="line"></div>
                        <h2 class="cardTitle"><?= $produto["nome"]; ?></h2>
                        <span class="price"><?= "R$ " . number_format($produto["preco"], 2 , ",", "."); ?></span>
                        <?php $pode_comprar = (!isset($_SESSION["nome"])) ? "#" : "pagina_produto.php?id=".$produto["id"]; ?>
                        <a class="buyBtn" href="<?= $pode_comprar; ?>">Comprar</a>
                    </div>
                <?php } ?>
            </section>
        </main>
        <footer>
            <address>Av. Agosto de Deus, 444 - Marília, SP</address>
        </footer>
        <div id="glassEffect"></div>
    </body>
</html>