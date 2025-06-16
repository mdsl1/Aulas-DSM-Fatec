<?php
    include "conexao.php";

    // Variaveis que vão receber o título e descrição do projeto
    $nome =  htmlspecialchars(trim($_POST['nome']));
    $descricao = htmlspecialchars(trim($_POST['descricao']));
    $preco = floatval(htmlspecialchars($_POST['preco']));
    // Caminho onde o arquivo será guardado
    $diretorio = '../Midias/';

    // Se existir um arquivo e ele tiver sido recebido sem erros, renomeia e passa para a segunda validação
    if (isset($_FILES['imgProduto']) && $_FILES['imgProduto']['error'] === UPLOAD_ERR_OK) {
        
        // Armazena o arquivo em uma variável temporária
        $arquivo_tmp = $_FILES['imgProduto']['tmp_name'];

        $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco]);

        // Pega o ID gerado automaticamente
        $id = $pdo->lastInsertId();

        // Define a extensão do arquivo original (ex: .jpg, .png, .pdf)
        $extensao = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);

        // Define o novo nome com o ID e a extensão
        $nome_img = $id . "." . $extensao;

        // Caminho final do arquivo
        $caminho_arquivo = $diretorio . $nome_img;

        // Move o arquivo
        if (move_uploaded_file($arquivo_tmp, $caminho_arquivo)) {
            header("Location: listar_produtos.php");
        }
        else {
            echo "<h1 style='color: #f00'>Erro ao mover o arquivo.</h1>";
        }
    }
    else {
        echo "<h1 style='color: #f00'>Arquivo não enviado ou com erro.<h1>";
    }
?>
<a href="index.php">Clique aqui para voltar à tela inicial</a>
    
