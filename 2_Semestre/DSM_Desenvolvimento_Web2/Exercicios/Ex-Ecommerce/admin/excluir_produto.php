<?php
    include "conexao.php";

    $id = intval(htmlspecialchars($_GET["id"]));
    $caminhoImg = "../Midias/" . $id .".png";

    $sql = "DELETE FROM produtos WHERE id = ?";
    $comando = $pdo->prepare($sql);
    $result = $comando->execute([$id]);

    if (file_exists($caminhoImg)) {
        unlink($caminhoImg); // Apaga o arquivo
    }

    if($result) {
        header("Location: listar_produtos.php");
    }
?>
<h1 style="color: #f00">Erro ao excluir o produto</h1>
<a href="index.php">Clique aqui para voltar à tela inicial</a>
