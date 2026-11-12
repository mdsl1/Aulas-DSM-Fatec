<?php
    require_once "connection.php";

    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

    $user = $_POST["user"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE login = '$user' and senha = '$senha'";

    $stmt = $conn->query($sql);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($usuario["nome"])){
        echo "Login efetuado com sucesso";
    }
    else {
        echo "Erro ao efetuar o login";
    }
    echo "<br><br>";
    echo "SQL utilizado: $sql";    
    echo "<br><br>";

    echo "Retorno da consulta:<br>";
    foreach ($usuario as $u) {
        echo $u . "<br>";
    }
?>