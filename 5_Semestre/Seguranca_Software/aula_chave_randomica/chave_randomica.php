<?php 
    $msg = "MINHA CRIPTOGRAFIA EH SEGURA";
    $chave = rand(10,30);

    $result = "";

    foreach(str_split($msg) as $l) {
        $val = (ord($l) ^ $chave) + 30;
        $result .= chr($val);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>Criptografia</h4>
    <p><?= $result ?></p>

    <h4>Descriptografia</h4>
    <p><?php
        foreach(str_split($result) as $l) {
            echo chr((ord($l) - 30) ^ $chave);
        }
    ?></p>
</body>
</html>
