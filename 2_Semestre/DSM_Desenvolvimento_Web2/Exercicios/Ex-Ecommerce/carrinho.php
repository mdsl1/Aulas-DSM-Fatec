<?php
session_start();
include "admin/conexao.php";

// Processa atualização ou remoção de produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizar'])) {
        $id = $_POST['id'];
        $qtde = max(1, intval($_POST['qtde'])); // impede qtde < 1
        $_SESSION['carrinho'][$id] = $qtde;
    }

    if (isset($_POST['remover'])) {
        $id = $_POST['id'];
        unset($_SESSION['carrinho'][$id]);
    }
}

if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) { ?>
        <head>
            <meta charset="utf-8">
            <title>Miner's Shopping</title>
            <link rel="stylesheet" href="css/cartStyle.css">
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
                    <li><a href="logout_cliente.php">Sair</a></li>
                </ul>
            </nav>
            <main style="text-align: center;">
                <h1>Carrinho de Compras</h1>
                <h2>Seu carrinho está vazio 😢</h2>
                <p><a href="index.php">Clique aqui para voltar à loja</a></p>
            </main>
            <footer>
                <address>Av. Agosto de Deus, 444 - Marília, SP</address>
            </footer>
            <div id="glassEffect"></div>
        </body>
<?php         
    exit;
} 

$ids = array_keys($_SESSION['carrinho']);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$sql = "SELECT * FROM produtos WHERE id IN ($placeholders)";
$stmt = $pdo->prepare($sql);
$stmt->execute($ids);
$produtos = $stmt->fetchAll();

$totalGeral = 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Miner's Shopping</title>
        <link rel="stylesheet" href="css/cartStyle.css">
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

            <h1>Carrinho de Compras</h1>
            
            <?php
            // Exibe o carrinho
            if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) { ?>
                <h2>Carrinho vazio!</h2>
                <a href="index.php" id="finish">Voltar</a>
            <?php } else { ?>
                <table>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>

                    <?php foreach ($produtos as $produto): 
                        $id = $produto['id'];
                        $nome = $produto['nome'];
                        $preco = $produto['preco'];
                        $qtde = $_SESSION['carrinho'][$id];
                        $subtotal = $preco * $qtde;
                        $totalGeral += $subtotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($nome) ?></td>
                        <td>R$ <?= number_format($preco, 2, ',', '.') ?></td>
                        <td>
                            <form method="post" class="inline-form">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="number" name="qtde" value="<?= $qtde ?>" min="1">
                                <button type="submit" name="atualizar">Atualizar</button>
                            </form>
                        </td>
                        <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                        <td>
                            <form method="post" class="inline-form">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" name="remover">Remover</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td colspan="3"><strong>Total Geral:</strong></td>
                        <td colspan="2"><strong>R$ <?= number_format($totalGeral, 2, ',', '.') ?></strong></td>
                    </tr>
                </table>

                <form action="finalizar_pedido.php" method="post">
                    <button type="submit" id="finish">Finalizar Pedido</button>
                </form>
            <?php } ?>
        </main>
        <footer>
            <address>Av. Agosto de Deus, 444 - Marília, SP</address>
        </footer>
        <div id="glassEffect"></div>
    </body>
</html>
