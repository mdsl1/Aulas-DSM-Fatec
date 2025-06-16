<?php
    session_start();

    include "admin/conexao.php";

    $email = htmlspecialchars($_POST["email"]);
    $senha = hash('sha256', htmlspecialchars($_POST["senha"]));

    $sql = "SELECT * FROM clientes WHERE email = ? AND senha = ?";
    $comando = $pdo->prepare($sql);
    $comando->execute([$email, $senha]);
    $result = $comando->fetch();

    if(isset($result["nome"])) {
        // Email e senha estavam corretos
        $_SESSION["id"] = $result["id"];
        $_SESSION["nome"] = $result["nome"];

        header("Location: index.php");
    }
?>
<h1>E-mail ou senha inválidos!</h1>
<p>Caso não possua cadastro, <a href="form_cadastrar_cliente.php">clique aqui</a></p>
<p>Caso queira tentar logar novamente, <a href="login_cliente.php">clique aqui</a></p>
