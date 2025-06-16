<?php 
    include "conexao.php";

    $id = intval(htmlspecialchars($_GET["id"]));

    $sql = "SELECT * FROM produtos WHERE id = ?";
    $comando = $pdo->prepare($sql);
    $comando->execute([$id]);
    $produto = $comando->fetch();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>ADM - Alteração de Produtos</title>
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

            h1,h2 {
                text-align: center;
                color: #fff;
            }
            h1 {
                margin: 2%;
                color: #ff6200;
            }
            h2 {
                margin: 0 0 2% 0;
            }
            form {
                background-color: #ffffffcc;
                width: 600px;
                border: 1px #000 solid;
                border-radius: 5px;
                margin: 0 auto;
                padding: 3%;
                display: flex;
                flex-flow: column nowrap;
                justify-content: center;
            }
            form div {
                margin: 0;
                padding: 12px;
                display: flex;
                align-items: center;
            }
            form label {
                width: 150px;
                text-align: right;
                display: inline-block;
                margin-right: 8px;
                vertical-align: top;
            }
            form input, form textarea {
                width: 80%;
                height: 100%;
                padding-left: 10px;
            }
            form textarea {
                padding-top: 10px;
            }
            form button {
                font-size: 1.1rem;
                padding: 2%;
                background-color: #e95900;
                border: #000 1px solid;
                border-radius: 5px;
                transition: 0.2s;
            }
            form button:hover{
                background-color: #e0be00;
                color: #000;
                font-weight: bold;
                transform: scale(1.1);
                cursor: pointer;
            }
            #btnDiv {
                display: flex;
                justify-content: center;
                text-align: center;
            }
            a, a:visited {
                margin: 2% auto 0 auto;
                color:#bb4800;
                text-decoration: none;
            }
            a:hover {
                color:#ff6200;
            }
        </style>
    </head>
    <body>
        <video autoplay muted loop id="backgroundVideo">
            <source src="../Midias/background_login.mp4" type="video/mp4">
        </video>
        <main>
            <h1>Área Administrativa - Alteração de Produtos</h1>
            <h2>Formulário de alteração</h2>
            <form method="POST" action="alterar_produto.php" enctype="multipart/form-data">
                <div>
                    <label for="nome">Nome do Produto:</label>
                    <input type="text" id="nome" name="nome" value="<?= $produto["nome"]; ?>" required autocomplete="off" size="50" maxlength="100">
                    <input type="hidden" name="id" id="id" value="<?= $produto["id"]; ?>">
                </div>
                <div>
                    <label for="descricao">Descrição do Produto:</label>
                    <textarea id="descricao" name="descricao" required autocomplete="off" rows="5" cols="40"><?= $produto["descricao"]; ?></textarea>
                </div>
                <div>
                    <label for="preco">Preço do Produto:</label>
                    <input type="number" step="any" id="preco" name="preco" value="<?= $produto["preco"]; ?>" required autocomplete="off">
                </div>
                <div>
                    <label for="imgProduto">Imagem do Produto:</label>
                    <input type="file" name="imgProduto" accept=".png">
                </div>
                <div id="btnDiv">
                    <button>Alterar</button>
                </div>
            </form>
            <a href="index.php">Voltar à pagina inicial</a>
        </main>
    </body>
</html>