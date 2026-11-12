<?php
    $login_default = "teste@teste.com";
    $senha_hash_default = hash('sha256', "senhasegura123");

    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $senha_hash = hash('sha256', $senha);

    if (hash_equals($senha_hash, $senha_hash_default)){
        echo "Logado com sucesso";
        echo "<br><br>";
        echo "Senha enviada pelo cliente: " . $senha;
        echo "<br>";
        echo "hash gerado pela senha do cliente: " . $senha_hash;
        echo "<br>";
        echo "hash default: " . $senha_hash_default;
        echo "<br>";
        
    }
    else {
        echo "Login ou senha incorretos";
        echo "<br><br>";
        echo "Senha enviada pelo cliente: " . $senha;
        echo "<br>";
        echo $senha_hash;
        echo "<br>";
        echo $senha_hash_default;
        echo "<br>";
    }
?>