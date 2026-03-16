<?php
    include "conexao.php";

    $sql = "SELECT * FROM vw_historico_vendas";
    $comando = $pdo->prepare($sql);
    $comando->execute();
    $result = $comando->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>ADM - Listagem de Produtos</title>
        <meta charset="utf-8">
        <style>
            * {
                font-family: monocraft, monospace, serif;
                margin: 0;
                padding: 0;
            }
            #backgroundVideo{
                position: fixed;
                bottom: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                z-index: -999;
            }
            body {
                width: 100vw;
                height: 100vh;
                overflow: hidden;
            }

            main {
                width: 100vw;
                height: 100vh;
                display: flex;
                flex-flow: column nowrap;
                align-items: center;
                background-color: #212121a4;
                backdrop-filter: blur(10px);
            }

            h1 {
                text-align: center;
                margin: 5%;
                color: #ff6200;
            }
            div {
                width: 90%;
                border: #ff6200 5px double;
                height: 60vh;
                overflow-y: scroll;
                display: flex;

            }
            #mainTable {
                width: 100%;
                color: #000;
                border-collapse: collapse;
                background-color: #ffffffcc;
                border-radius: 5px;
                text-align: baseline;
            }
            #mainTable th{
                border: #ff6200 5px double;
                padding: 10px;
            }
            #mainTable td {
                font-size: 0.8rem;
                border: #ff6200 2px solid;
                padding: 6px;
            }
            #mainTable tr:nth-child(even) {
                background-color:#ffac59cc;
            }
            a, a:visited {
                margin: 2% auto 0 auto;
                color: #ffbe95;
                text-decoration: none;
            }
            a:hover {
                color:#ff6200;
            }
            table:not(#mainTable) th {
                color:#ffbe9500;
                padding: 10px;
            }
            table:not(#mainTable) td {
                color: #f00;
                padding: 6px;
            }
        </style>
    </head>
    <body>
        <video autoplay muted loop id="backgroundVideo">
            <source src="../Midias/background_login.mp4" type="video/mp4">
        </video>
        <main>
            <h1>Área Administrativa - Histórico de Vendas</h1>
            <div>
                <table id="mainTable">
                    <tr>
                        <th>ID do Pedido</th>
                        <th>Nome Cliente</th>
                        <th>Nome Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                        <th>Data do Pedido</th>
                        <th>Total do Pedido</th>
                    </tr>
                <?php foreach($result as $pedido) { ?>
                    <tr>
                        <td><?= $pedido["pedido_id"]; ?></td>
                        <td><?= $pedido["nome_cliente"]; ?></td>
                        <td><?= $pedido["nome_produto"]; ?></td>
                        <td><?= $pedido["quantidade"]; ?></td>
                        <td><?= "R$ " . number_format($pedido["preco_unitario"], 2,",","."); ?></td>
                        <td><?= "R$ " . number_format($pedido["subtotal"], 2,",","."); ?></td>
                        <td><?= $pedido["data_pedido"]; ?></td>
                        <td><?= "R$ " . number_format($pedido["total"], 2,",","."); ?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <a href="index.php">Voltar à pagina inicial</a>
        </main>
    </body>
</html>