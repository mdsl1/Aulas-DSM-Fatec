<?php 
    $estadosBR = ["","AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB", "PR","PE","PI","RJ","RN", "RS","RO","RR", "SC","SP","SE","TO"]; 
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
                <li><a href="cart.html">Carrinho</a></li>
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
            <h1>Formulário de Cadastro de Cliente</h1>
            <form action="cadastrar_cliente.php" method="POST">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required autocomplete="off">
                </div>
                <div>
                    <label for="endereco">Endereço:</label>
                    <input type="text" name="endereco" required autocomplete="off">
                </div>
                <div>
                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" required autocomplete="off">
                </div>
                <div>
                    <label for="estado">Estado:</label>
                    <select name="estado">
                        <?php foreach($estadosBR as $uf) { ?>
                            <option value="<?= $uf; ?>"><?= $uf; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" required autocomplete="off">
                </div>
                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" required>
                </div>
                <button>Cadastrar</button>
            </form>
        </main>
        <footer>
            <address>Av. Agosto de Deus, 444 - Marília, SP</address>
        </footer>
    </body>
</html>