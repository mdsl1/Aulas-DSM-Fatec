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

    if($result) {
        echo "<h1>Usuário criado com sucesso</h1>";
    }
    else {
        echo "<h1>Erro ao cadastrar o usuário</h1>";
    }
?>
