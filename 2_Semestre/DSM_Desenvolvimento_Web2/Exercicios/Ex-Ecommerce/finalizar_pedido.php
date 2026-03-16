<?php
session_start();
    date_default_timezone_set('America/Sao_Paulo');
include "admin/conexao.php";

// Verifica se carrinho existe
if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
    die("Carrinho vazio.");
}

$id_cliente = $_SESSION['id'] ?? null; // exemplo: se você guarda o ID do cliente na sessão

if (!$id_cliente) {
    die("Você precisa estar logado para finalizar o pedido.");
}

// Cria o pedido
$data = date("Y-m-d H:i:s");
$sql = "INSERT INTO pedidos (id_cliente, data, total) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);

// Calcula o total
$total = 0;
foreach ($_SESSION['carrinho'] as $id => $qtde) {
    $stmtProduto = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
    $stmtProduto->execute([$id]);
    $produto = $stmtProduto->fetch();
    $total += $produto['preco'] * $qtde;
}

$stmt->execute([$id_cliente, $data, $total]);
$id_pedido = $pdo->lastInsertId();

// Insere os itens
foreach ($_SESSION['carrinho'] as $id => $qtde) {
    $stmtItem = $pdo->prepare("INSERT INTO itens_pedido (id_pedido, id_produto, qtde) VALUES (?, ?, ?)");
    $stmtItem->execute([$id_pedido, $id, $qtde]);
}

// Limpa o carrinho
unset($_SESSION['carrinho']);

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pedido Finalizado</title>
        <link href="css/admLogoutStyle.css" rel="stylesheet">
    </head>
    <body>
        <video autoplay muted loop id="backgroundVideo">
            <source src="Midias/background_login.mp4" type="video/mp4">
        </video>
        <div id="logoutContainer">
            <h1>Pedido finalizado com sucesso!</h1>
            <p>Caso queira voltar à loja <a href="index.php">Clique aqui</a></p>
        </div>
    </body>
</html>