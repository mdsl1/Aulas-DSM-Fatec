<?php 
    session_start();
    include "admin/conexao.php";

    $nome = htmlspecialchars($_POST["nome"]);
    $endereco = htmlspecialchars($_POST["endereco"]);
    $cidade = htmlspecialchars($_POST["cidade"]);
    $estado = htmlspecialchars($_POST["estado"]);
    $email = htmlspecialchars($_POST["email"]);
    $senha = hash('sha256', htmlspecialchars($_POST["senha"]));

    $sql = "INSERT INTO clientes (nome, endereco, cidade, estado, email, senha) VALUES( ?, ?, ?, ?, ?, ?)";
    $comando = $pdo->prepare($sql);
    $result = $comando->execute([$nome, $endereco, $cidade, $estado, $email, $senha]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
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

            <div id="loginContainer">
            <?php if($result) { ?>
                <h1>Usuário criado com sucesso</h1>
                <form action="validar_login.php" method="POST">
                    <input type="hidden" name="email" value="<?= $email; ?>">
                    <input type="hidden" name="senha" value="<?= $_POST["senha"]; ?>">
                    <button>Entrar</button>
                </form>
            <?php } else { ?>
                <h1>Erro ao cadastrar o usuário</h1>
            <?php } ?>
            </div>
        </main>
        <footer id="footerCadastro">
            <address>Av. Agosto de Deus, 444 - Marília, SP</address>
        </footer>
        <div id="glassEffect"></div>
</body>
</html>
