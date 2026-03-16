<?php
    session_start();
    include "admin/conexao.php";

    if(!isset($_SESSION["nome"])) {
        header("Location: index.php");
    }

    $id = intval(htmlspecialchars($_GET["id"]));

    $sql = "SELECT * FROM produtos WHERE id = ?";
    $comando = $pdo->prepare($sql);
    $comando->execute([$id]);
    $produto = $comando->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Miner's Shopping</title>
        <link rel="stylesheet" href="css/pagProductStyle.css">
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
            
            <h1><?= $produto["nome"]; ?></h1>

            <section id="showProduct">          
                <img src="Midias/<?= $produto["id"]; ?>.png" alt="Imagem do produto">
                <div id="infos">
                    <h2>Sobre o Produto</h2>
                    <p><?= $produto["descricao"]; ?></p>
                    <span id="precoParcelado">Em até 8x de <?= "R$ " . number_format(($produto["preco"]/12), 2 , ",", "."); ?> sem juros</span>
                    <p>ou <span id="precoTotal"><?= "R$ " . number_format($produto["preco"], 2 , ",", "."); ?></span> à vista</p>

                    <form>

                        <input type="hidden" name="id" id="id" value="<?= $produto["id"]; ?>">
                        <input type="hidden" name="preco" id="preco" value="<?= $produto["preco"]; ?>">

                        <div id="qtdeItensControl">
                                <button type="button" id="rmvItem">-</button>
                                <input type="number" name="qtde" id="qtdeItem" value="1" min="1">
                                <button type="button" id="addItem">+</button>
                        </div>

                        <p>Total a Pagar:</p>
                        <span id="precoFinal">R$ 0,00</span><br>

                        <button type="button" onclick="comprarAgora()">Comprar Agora</button>
                    </form>
                    
                    <button onclick="adicionarAoCarrinho()">Adicionar ao Carrinho</button>
                </div>
            </section>
        </main>
        <footer>
            <address>Av. Agosto de Deus, 444 - Marília, SP</address>
        </footer>
        <div id="glassEffect"></div>

        <script defer src="js/script.js" type="text/javascript"></script>
    </body>
</html>