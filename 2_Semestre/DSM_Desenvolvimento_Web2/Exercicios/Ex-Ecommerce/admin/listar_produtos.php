<?php
    include "conexao.php";

    $sql = "SELECT * FROM produtos";
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
            <h1>Área Administrativa - Produtos Cadastrados</h1>
            <div>
                <table id="mainTable">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                <?php foreach($result as $produto) { ?>
                    <tr>
                        <td><?= $produto["id"]; ?></td>
                        <td><?= $produto["nome"]; ?></td>
                        <td><?= $produto["descricao"]; ?></td>
                        <td><?= "R$ " . number_format($produto["preco"], 2,",","."); ?></td>
                        <td><a href="excluir_produto.php?id=<?= $produto["id"]; ?>">🗑️</a> | <a href="form_alterar_produto.php?id=<?= $produto["id"]; ?>">📝</a></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <a href="index.php">Voltar à pagina inicial</a>
        </main>
    </body>
</html>