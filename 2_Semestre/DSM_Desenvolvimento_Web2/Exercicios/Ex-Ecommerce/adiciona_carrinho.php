<?php
    session_start();


    file_put_contents("log.txt", print_r($_POST, true));

    $produto_id = $_POST['produto_id'] ?? null;
    $qtde = intval($_POST['qtde'] ?? 0);

    if (!$produto_id || $qtde < 1) {
        echo "Erro ao adicionar.";
        exit;
    }

    // Inicia o carrinho se não existir
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Adiciona ou atualiza o item no carrinho
    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id] += $qtde;
    } else {
        $_SESSION['carrinho'][$produto_id] = $qtde;
    }

    echo "Produto $produto_id adicionado com quantidade $qtde.";
