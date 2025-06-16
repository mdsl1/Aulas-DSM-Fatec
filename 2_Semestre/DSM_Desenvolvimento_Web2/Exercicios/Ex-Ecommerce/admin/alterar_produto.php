<?php
    include "conexao.php";

    $id = intval(htmlspecialchars($_POST['id']));
    $nome =  htmlspecialchars(trim($_POST['nome']));
    $descricao = htmlspecialchars(trim($_POST['descricao']));
    $preco = floatval(htmlspecialchars($_POST['preco']));

    // Se existir um arquivo e ele tiver sido recebido sem erros, renomeia e passa para a segunda validação
    if (isset($_FILES['imgProduto']) && $_FILES['imgProduto']['error'] === UPLOAD_ERR_OK) {
        // Caminho para adicionar arquivos caso seja preciso
        $diretorio = '../Midias/';

        // Armazena o arquivo em uma variável temporária
        $arquivo_tmp = $_FILES['imgProduto']['tmp_name'];

        // Define a extensão do arquivo original (ex: .jpg, .png, .pdf)
        $extensao = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);

        // Define o novo nome com o ID e a extensão
        $nome_img = $id . "." . $extensao;

        // Caminho final do arquivo
        $caminho_arquivo = $diretorio . $nome_img;

        // Verifica se existe uma imagem para excluir
        $oldImg = $diretorio . $id .".png";
        if (file_exists($oldImg)) {
            unlink($oldImg);
        }
        // Move a nova imagem
        move_uploaded_file($arquivo_tmp, $caminho_arquivo);
    }

    $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?";

    $comando = $pdo->prepare($sql);
    $result = $comando->execute([$nome, $descricao, $preco, $id]);

    if($result) {
        header("Location: listar_produtos.php");
    }
?>
<h1 style="color: #f00">Erro ao alterar o produto</h1>
<a href="index.php">Clique aqui para voltar à tela inicial</a>